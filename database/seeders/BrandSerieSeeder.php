<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Serie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSerieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            ['name' => 'APPLE', 'series' => [
                'MacBook Air', 'MacBook Pro', 'iMac',
            ]],
            ['name' => 'ASUS', 'series' => [
                'TUF', 'ROG', 'Zenbook', 'Vivobook',
            ]],
            ['name' => 'ACER', 'series' => [
                'Predator', 'Nitro', 'Aspire', 'Swift',
            ]],
            ['name' => 'LENOVO', 'series' => [
                'ThinkPad', 'Yoga', 'LOQ', 'IdeaPad',
            ]],
        ];

        foreach ($brands as $brand) {
            $b = Brand::create([
                'name' => $brand['name'],
            ]);

            foreach ($brand['series'] as $serie) {
                Serie::create([
                    'brand_id' => $b->id,
                    'name' => $serie,
                ]);
            }
        }
    }
}
