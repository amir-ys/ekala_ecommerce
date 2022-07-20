<?php

namespace Modules\Setting\Repositories;

use Modules\Core\Repositories\BaseRepository;
use Modules\Setting\Contracts\SettingRepositoryInterface;
use Modules\Setting\Models\Setting;

class SettingRepo extends BaseRepository implements SettingRepositoryInterface
{
    protected string $model = Setting::class;

    public function storeAbout($data)
    {
        $this->query->updateOrCreate(
            [
                'name' => Setting::SETTING_ABOUT_US
            ],
            [
                'json' => [
                    'title' => $data['title'] ?? null,
                    'photo' => $data['photo_uploaded'],
                    'description' => $data['description'] ?? null,
                ]
            ]);
    }

    public function getAbout()
    {
       return $this->query->where('name' , Setting::SETTING_ABOUT_US)->first();
    }

    public function store(array $data)
    {
        // TODO: Implement store() method.
    }

    public function update(int $id, array $data)
    {
        // TODO: Implement update() method.
    }
}
