<?php

namespace Modules\Slide\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Slide\Enums\SlideStatus;
use Modules\Slide\Models\Slide;

class SlideSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $data = __('Slide::default-data');
        foreach ($data as $slideData) {
            $attributeGroup = Slide::query()->firstOrCreate([
                'status' => SlideStatus::ACTIVE,
                'title' => 'default',
                'type' => $slideData['type'],
                'link' => $slideData['link'],
                'image' => $slideData['image'],
            ], []);
        }
    }
}
