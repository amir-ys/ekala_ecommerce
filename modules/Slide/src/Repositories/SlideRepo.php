<?php

namespace Modules\Slide\Repositories;

use Modules\Core\Repositories\BaseRepository;
use Modules\Slide\Contracts\SlideRepositoryInterface;
use Modules\Slide\Models\Slide;

class SlideRepo extends BaseRepository implements SlideRepositoryInterface
{
    protected string $model = Slide::class;

    public function store(array $data)
    {
        $this->query->create([
            'title' => $data['title'],
            'priority' => $data['priority'],
            'status' => $data['status'],
            'type' => $data['type'],
            'link' => $data['link'],
            'photo' => $data['image_name'],
            'btn_text' => $data['btn_text'],
        ]);
    }

    public function update(int $id, array $data)
    {
        $model = $this->query->findOrFail($id);
        $model->update([
            'title' => $data['title'],
            'priority' => $data['priority'],
            'status' => $data['status'],
            'type' => $data['type'],
            'link' => $data['link'],
            'photo' => $data['image_name'],
            'btn_text' => $data['btn_text'],
        ]);
    }

}
