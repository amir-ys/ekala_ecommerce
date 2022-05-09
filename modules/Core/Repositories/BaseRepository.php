<?php

namespace Modules\Core\Repositories;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

trait BaseRepository
{
    public function getAllPaginate(): Paginator
    {
        return $this->query->latest()->paginate();
    }

    public function findById(int $id): Model|Collection|Builder|array|null
    {
        return $this->query->findOrFail($id);
    }

    public function destroy(int $id): void
    {
        $brand = $this->findById($id);
        $brand->delete();
    }
}
