<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\User\Models\City;
use Modules\User\Models\Province;

class ProvinceSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        foreach (Province::$provinces as $key =>  $province) {
            $province = Province::query()->firstOrCreate([
                'name' => $province
            ]);

            foreach (City::$cities[$key] as $city){
                $province->cities()->firstOrCreate([
                    'name' => $city
                ]);
            }
        }

    }
}
