<?php

namespace Modules\Slide\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Core\Repositories\BaseRepository;
use Modules\Slide\Contracts\SlideRepositoryInterface;
use Modules\Slide\Enums\SlideStatus;
use Modules\Slide\Enums\SlideType;
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
            'image' => $data['image_name'],
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
            'image' => $data['image_name'],
            'btn_text' => $data['btn_text'],
        ]);
    }

    public function getSliders(): array|Collection
    {
       return $this->query->where('status' , SlideStatus::ACTIVE->value)
            ->where('type' , SlideType::SLIDER->value)
            ->orderBy('priority' , 'asc')->get();
    }

    public function getTopPageBanners(): array|Collection
    {
        return $this->query->where('status' , SlideStatus::ACTIVE->value)
            ->where('type' , SlideType::BANNER_TOP_LEFT->value)
            ->orderBy('priority' , 'asc')->get();
    }

    public function getBottomPageBanners(): array|Collection
    {
        return $this->query->where('status' , SlideStatus::ACTIVE->value)
            ->where('type' , SlideType::BANNER_BOTTOM->value)
            ->orderBy('priority' , 'asc')->get();
    }

}
