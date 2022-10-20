<?php

namespace Modules\Product\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Modules\Core\Repositories\BaseRepository;
use Modules\Product\Contracts\ProductRepositoryInterface;
use Modules\Product\Enums\ProductStatus;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductColor;

class  ProductRepo extends BaseRepository implements ProductRepositoryInterface
{
    protected $model = Product::class;

    public function activeAndMarketable()
    {
        return $this->query->where('is_active', ProductStatus::ACTIVE)
            ->where('is_marketable', Product::MARKETABLE);
    }

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
            'special_price' => $data['special_price'],
            'special_price_start' => $data['special_price_start'],
            'special_price_end' => $data['special_price_end'],
            'is_active' => $data['is_active'],
            'is_marketable' => $data['is_marketable'],
        ]);
    }

    public function update(int $id, array $data)
    {
        $model = $this->findById($id);

        $model->update([
            'name' => $data['name'],
            'category_id' => $data['category_id'],
            'brand_id' => $data['brand_id'],
            'description' => $data['description'],
            'price' => $data['price'],
            'special_price' => $data['special_price'],
            'special_price_start' => $data['special_price_start'],
            'special_price_end' => $data['special_price_end'],
            'is_active' => $data['is_active'],
            'is_marketable' => $data['is_marketable'],
        ]);

        return $model;
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
            'images' => $name,
            'is_primary' => $isPrimary
        ]);
    }

    public function deleteImageById($id, $imageId,)
    {
        $this->findById($id)->allImages()->where('id', $imageId)->delete();
    }

    public function findImageById($id, $imageId)
    {
        $model = $this->findById($id);
        return $model->images()->where('id', $imageId)->firstOrFail();

    }

    public function getImages($id)
    {
        $model = $this->findById($id);
        return $model->images;
    }

    public function deleteAllImages($id)
    {
        $this->findById($id)->allImages()->delete();
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
        $product->delete();
    }

    public function getProductsOrderByRequest($category = null): LengthAwarePaginator
    {
        $query = $this->activeAndMarketable();

        if (!is_null($category)) {
            $query = $query->where('category_id', $category);
        }

        $query = $query->when(request()->order == 'newest', function ($q) {
            $q->latest();
        });

        $query = $query->when(request()->order == 'most-visited', function ($q) {
            $query = getMostVisitedProductFromRedis();
        });

        $query = $query->when(request()->order == 'cheapest', function ($q) {
            $q->orderBy('price');
        });

        $query = $query->when(request()->order == 'best-selling', function ($q) {
            $q->with(['colors'])
                ->withSum('colors', 'sold_number')
                ->orderByDesc('colors_sum_sold_number');
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
        return $this->activeAndMarketable()
            ->where('slug', $slug)
            ->firstOrFail();
    }


    public function addOrRemoveProductFromWishlist($productId, $userId)
    {
        if ($this->findProductInWishlist($productId, $userId)) {
            $this->removeFromWishlist($productId, $userId);
        } else {
            $this->addToWishlist($productId, $userId);
        }
        return !!$this->findProductInWishlist($productId, $userId);
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
        $model->wishlist()->where('user_id', $userId)->delete();
    }

    public function findProductInWishlist($id, $userId)
    {
        $model = $this->findById($id);
        return $model->wishlist()->where('user_id', $userId)->first();
    }


    public function findProductByIds($ids)
    {
        return $this->query->whereIn('id', $ids)->get();
    }

    public function findActiveById($id)
    {
        return $this->activeAndMarketable()
            ->where('id', $id)->first();
    }

    public function getLatest(): array|Collection
    {
        return $this->activeAndMarketable()->with(['category', 'brand', 'primaryImage'])
            ->limit(6)
            ->latest()
            ->get();
    }

    public function getDiscounted(): array|Collection
    {
        return $this->activeAndMarketable()->whereNotNull('special_price')
            ->where('special_price_start', '<', now())
            ->where('special_price_end', '>', now())
            ->limit(6)
            ->get();
    }

    public function getBestSelling(): array|Collection
    {
        return $this->activeAndMarketable()
            ->withSum('colors', 'sold_number')
            ->orderByDesc('colors_sum_sold_number')
            ->limit(6)
            ->get();
    }

    public function getRelatedProducts($id)
    {
        $model = $this->findById($id);
        $query = $this->activeAndMarketable()
            ->whereNot('id' , $model->id)
            ->orWhere(function (Builder $q) use ($model) {
            $q->where('brand_id', $model->brand_id)
                ->orWhere('brand_id', $model->brand_id)
                ->orWhere('name', 'like', "%$model->name%");
        })->get();

        return $query;
    }

    /**
     * start product colors process
     */

    public function getProductColors($id)
    {
        $model = $this->findById($id);
        return $model->colors()->get();
    }


    public function findColorById($id, $colorId, $fail = false)
    {
        $model = $this->findById($id);
        $model = $model->colors()->where('id', $colorId);
        return $fail ? $model->firstOrFail() : $model->first();
    }

    public function storeColor($id, $data, $isPrimary = false)
    {
        $model = $this->findById($id);
        $model->colors()->update(['is_primary' => false]);
        $model->colors()->create([
            "color_name" => $data['color_name'],
            "color_value" => $data['color_value'],
            "price_increase" => $data['price_increase'],
            'quantity' => $data['quantity'],
            "is_primary" => $isPrimary,
        ]);
    }

    public function updateColor($id, $colorId, $data, $isPrimary = false)
    {
        $model = $this->findById($id);
        $model->colors()->update(['is_primary' => false]);
        $model->colors()->where('id', $colorId)->update([
            "color_name" => $data['color_name'],
            "color_value" => $data['color_value'],
            "price_increase" => $data['price_increase'],
            'quantity' => $data['quantity'],
            "is_primary" => $isPrimary,
        ]);

    }

    public function destroyColor($id, $colorId)
    {
        $model = $this->findById($id);
        return $model->colors()->where('id', $colorId)->delete();
    }

    /**
     * end product colors process
     */


    /**
     * start product warranties process
     */
    public function getProductWarranties($id)
    {
        $model = $this->findById($id);
        return $model->warranties()->get();
    }


    public function findWarrantyById($id, $warrantyId)
    {
        $model = $this->findById($id);
        return $model->warranties()->where('id', $warrantyId)->firstOrFail();
    }

    public function storeWarranty($id, $data)
    {
        $model = $this->findById($id);
        $model->warranties()->create([
            "name" => $data['name'],
            "price_increase" => $data['price_increase'],
        ]);
    }

    public function updateWarranty($id, $warrantyId, $data)
    {
        $model = $this->findById($id);
        $model->warranties()->where('id', $warrantyId)->update([
            "name" => $data['name'],
            "price_increase" => $data['price_increase'],
        ]);
    }

    public function destroyWarranty($id, $warrantyId)
    {
        $model = $this->findById($id);
        return $model->warranties()->where('id', $warrantyId)->delete();
    }

    /**
     * end product warranties process
     */

    public function incrementVisit($id)
    {
        $model = $this->findById($id);
        $model->vzt()->increment();
    }

    public function decrementQuantity($id, $colorId)
    {
        $model = $this->findById($id);
        $color = $model->colors()->where('id', $colorId)->first();
        $color->decrement('quantity');
        $color->increment('sold_number');
        $color->save();
    }

    public function incrementQuantity($id, $colorId)
    {
        $model = $this->findById($id);
        $color = $model->colors()->where('id', $colorId)->first();
        $color->increment('quantity');
        $color->decrement('sold_number');
        $color->save();
    }

    public function findDefaultProductColor($id)
    {
        $model = $this->findById($id);
        return $model->colors()->where('is_primary', true)->first();
    }
}
