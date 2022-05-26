<?php

namespace Modules\Product\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Product\Contracts\ProductRepositoryInterface;
use Modules\Core\Repositories\BaseRepository;
use Modules\Product\Models\Product;

class ProductRepo extends BaseRepository implements ProductRepositoryInterface
{
    protected $model = Product::class;

    public function getAll()
    {
        return $this->query->latest()->with('parent')->get();
    }

    public function store(array $data)
    {
        $this->query->create([
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

    }
}
