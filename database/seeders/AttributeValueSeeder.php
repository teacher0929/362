<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attributes = [
            ['name' => 'COLOR', 'values' => [
                'White', 'Grey', 'Black', 'Blue', 'Brown',
                'Red', 'Orange', 'Beige', 'Green', 'Yellow',
            ]],
            ['name' => 'CPU', 'values' => [
                'Intel Core i3', 'Intel Core i5', 'Intel Core i7', 'Intel Core i9',
                'AMD RYZEN 5', 'AMD RYZEN 7', 'AMD RYZEN 9',
            ]],
            ['name' => 'SDD', 'values' => [
                '128 GB', '256 GB', '512 GB', '1 TB',
            ]],
            ['name' => 'RAM', 'values' => [
                '4 GB', '8 GB', '16 GB', '32 GB',
            ]],
        ];

        for ($i = 0; $i < count($attributes); $i++) {
            $a = Attribute::create([
                'name' => $attributes[$i]['name'],
                'sort_order' => $i + 1,
            ]);

            for ($j = 0; $j < count($attributes[$i]['values']); $j++) {
                AttributeValue::create([
                    'attribute_id' => $a->id,
                    'name' => $attributes[$i]['values'][$j],
                    'sort_order' => $j + 1,
                ]);
            }
        }
    }
}
