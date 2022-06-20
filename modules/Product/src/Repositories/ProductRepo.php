<?php

namespace Modules\Product\Repositories;

use Modules\Core\Repositories\BaseRepository;
use Modules\Product\Contracts\ProductRepositoryInterface;
use Modules\Product\Enums\ProductStatus;
use Modules\Product\Models\Product;

class ProductRepo extends BaseRepository implements ProductRepositoryInterface
{
    protected $model = Product::class;

    public function getAll()
    {
        return $this->query->latest()->with(['brand', 'category'])->get();
    }

    public function store(array $data)
    {
        return $this->query->create([
            'name' => $data['name'],
            'category_id' => $data['category_id'],
            'brand_id' => $data['brand_id'],
            'description' => $data['description'],
            'price' => $data['price'],
            'quantity' => $data['quantity'],
            'special_price' => $data['special_price'],
            'special_price_start' => $data['special_price_start'],
            'special_price_end' => $data['special_price_end'],
            'is_active' => $data['is_active'],
        ]);
    }

    public function update(int $id, array $data)
    {
        return $this->query->where('id', $id)->update([
            'name' => $data['name'],
            'category_id' => $data['category_id'],
            'brand_id' => $data['brand_id'],
            'description' => $data['description'],
            'price' => $data['price'],
            'quantity' => $data['quantity'],
            'special_price' => $data['special_price'],
            'special_price_start' => $data['special_price_start'],
            'special_price_end' => $data['special_price_end'],
            'is_active' => $data['is_active'],
        ]);
    }

    public function saveProductImage($imageName, Product $product, $isPrimary)
    {
        $product->allImages()->create([
            'name' => $imageName,
            'is_primary' => $isPrimary
        ]);
    }

    public function deleteImageById($imageId, $product)
    {
        $product->allImages()->where('id', $imageId)->delete();
    }

    public function findByIdWithImages(int $id)
    {
        return $this->query->where('id', $id)->with('images')->firstOrFail();

    }

    public function findByIdWithRelations(int $id)
    {
        return $this->query->where('id', $id)->with(['brand', 'category', 'images'])->firstOrFail();

    }

    public function storeProductImage($name, $id, $isPrimary)
    {
        $this->findById($id)->images()->create([
            'name' => $name,
            'is_primary' => $isPrimary
        ]);
    }

    public function findImageById($id, $imageId)
    {
        $model = $this->findById($id);
        return $model->images()->where('id', $imageId)->firstOrFail();

    }

    public function deleteProductImage($image)
    {
        return $image->delete();
    }

    public function getProductImages($id)
    {
        $model = $this->findById($id);
        return $model->images;
    }

    public function deletePrimaryImage($id)
    {
        $this->findById($id)->primaryImage->delete();
    }

    public function attachAttributeWithValue($id, $attributes)
    {
        $product = $this->findById($id);
        $product->attributes()->detach();
        foreach ($attributes as $attributeId => $value) {
            $product->attributes()->attach($attributeId, ['value' => $value]);
        }
    }

    public function findByIdWithCategory($id)
    {
        return $this->query->where('id', $id)->with('category.attributeGroups')->firstOrFail();
    }

    public function destroy($id): void
    {
        $product = $this->findById($id);
        $product->attributes()->detach();
        $product->allImages()->delete();
        $product->delete();
    }

    public function getSelectedProducts()
    {
        return $this->query->where('is_active', ProductStatus::ACTIVE->value)->get();
    }

    public function getProductsOrderByRequest()
    {
        $query = $this->query->where('is_active', ProductStatus::ACTIVE->value);

        $query = $query->when(request()->order == 'newest', function ($q) {
            $q->latest();
        });

        $query = $query->when(request()->order == 'most-visited', function ($q) {
            $q->orderBy('view', 'desc');
        });

        $query = $query->when(request()->order == 'best-selling', function ($q) {
            $q->orderBy('sold', 'desc');
        });

        $query = $query->when(request()->order == 'cheapest', function ($q) {
            $q->orderBy('price');
        });

        $query = $query->when(request()->has('category'), function ($q) {
            $q->where('category_id', request()->category);
        });

        $query = $query->when(request()->has('only-available'), function ($q) {
            $q->where('quantity', '>', 0);
        });

        return $query->paginate();
    }


    public function findBySlug($slug)
    {
        return $this->query
            ->where('is_active', ProductStatus::ACTIVE->value)
            ->where('slug', $slug)
            ->firstOrFail();
    }

    public function addToWishlist($id, $userId)
    {
        $model = $this->findById($id);
        $model->wishlist()->create([
            'user_id' => $userId
        ]);
    }

    public function removeFromWishlist($id, $userId)
    {
        $model = $this->findById($id);
         $model->wishlist()->where('user_id' , $userId)->delete();
    }

    public function findProductInWishlist($id, $userId)
    {
        $model = $this->findById($id);
       return $model->wishlist()->where('user_id' , $userId)->first();
    }

    public function findProductByIds($ids)
    {
        return $this->query->whereIn('id' , $ids)->get();
    }

    public function findActiveById($id)
    {
        return $this->query->where('is_active' , ProductStatus::ACTIVE)
            ->where('id' , $id)->first();
    }

}
