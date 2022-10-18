<?php

namespace Modules\Blog\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Blog\Contracts\CategoryRepositoryInterface;
use Modules\Blog\Models\Category;
use Modules\Core\Repositories\BaseRepository;

class CategoryRepo extends BaseRepository implements CategoryRepositoryInterface
{
    protected $model = Category::class;

    public function getAll()
    {
        return $this->query->latest()->get();
    }

    public function store(array $data)
    {
       return $this->query->create([
            'name' => $data['name'],
            'description' => $data['description'],
            'image' => $data['image'],
            'status' => $data['status'],
        ]);
    }

    public function update(int $id, array $data)
    {
        $model = $this->findById($id);
        $model->update([
            'name' => $data['name'],
            'description' => $data['description'],
            'image' => $data['image'],
            'status' => $data['status'],
        ]);
    }

    public function getAllWithSpecialSlug($slug): array|Collection
    {
        $category =  $this->query->where('slug' , $slug)->firstOrFail();
        return  $category->posts()->with(['category' , 'author'])->get();
    }

    public function updateImageById($id , $data)
    {
        $model = $this->findById($id);
        $model->image = $data;
        $model->save();
    }

}
