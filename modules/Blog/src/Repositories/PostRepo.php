<?php

namespace Modules\Blog\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Blog\Contracts\PostRepositoryInterface;
use Modules\Blog\Models\Post;
use Modules\Core\Repositories\BaseRepository;

class PostRepo extends BaseRepository implements PostRepositoryInterface
{
    protected $model = Post::class;

    public function getAll()
    {
        return $this->query->latest()->with(['author' , 'category'])->get();
    }

    public function store(array $data)
    {
        $this->query->create([
            'title' => $data['title'],
            'summary' => $data['summary'],
            'body' => $data['body'],
            'image' => $data['image'],
            'status' => $data['status'],
            'is_commentable' => $data['is_commentable'],
            'published_at' => $data['published_at'],
            'author_id' => $data['author_id'],
            'category_id' => $data['category_id'],
            'tags' => $data['tags'],

        ]);
    }

    public function update(int $id, array $data)
    {
        $model = $this->findById($id);
        $model->update([
            'title' => $data['title'],
            'summary' => $data['summary'],
            'body' => $data['body'],
            'image' => $data['image'],
            'status' => $data['status'],
            'is_commentable' => $data['is_commentable'],
            'published_at' => $data['published_at'],
            'category_id' => $data['category_id'],
            'tags' => $data['tags'],
        ]);
    }

    public function findBySlug($slug)
    {
      return  $this->query->where('slug' , $slug)->firstOrFail();
    }

    public function getPostsByIds($ids): array|Collection
    {
        return $this->query->whereIn('id' , $ids )->get();
    }

    public function getLatest(): array|Collection
    {
        return $this->query->latest()->limit(3)->get();
    }

    public function incrementVisit($id)
    {
        $model = $this->findById($id);
        $model->vzt()->increment();
        return $model->vzt()->count();

    }

}
