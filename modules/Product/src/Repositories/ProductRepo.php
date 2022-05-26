<?php

namespace Modules\Product\Repositories;

use Modules\Core\Repositories\BaseRepository;
use Modules\Product\Contracts\ProductRepositoryInterface;
use Modules\Product\Models\Product;

class ProductRepo extends BaseRepository implements ProductRepositoryInterface
{
    protected $model = Product::class;

    public function getAll()
    {
        return $this->query->latest()->with(['brand' , 'category'])->get();
    }

    public function store(array $data)
    {
       $product =  $this->query->create([
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

        return $product;
    }

    public function update(int $id, array $data)
    {

    }

    public function saveProductImage($imageName ,Product $product , $isPrimary)
    {
        $product->images()->create([
            'name' => $imageName ,
            'is_primary' => $isPrimary
        ]);
    }
}
