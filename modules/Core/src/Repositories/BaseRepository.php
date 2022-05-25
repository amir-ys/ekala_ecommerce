<?php

namespace Modules\Core\Repositories;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected Builder|Model $query;
    public function __construct()
    {
        $this->query = (new $this->model);
    }

    public function getAll()
    {
        return $this->query->latest()->get();
    }

    public function findById(int $id)
    {
        return $this->query->findOrFail($id);
    }

    public function destroy(int $id): void
    {
        $model = $this->findById($id);
        $model->delete();
    }
}
