<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            BrandSerieSeeder::class,
            AttributeValueSeeder::class,
        ]);

        Product::factory()
            ->count(500)
            ->create();

        User::factory()
            ->count(5)
            ->create();
    }
}
