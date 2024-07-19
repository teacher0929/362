<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Serie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = Category::inRandomOrder()->first();
        $serie = Serie::with('brand')->inRandomOrder()->first();
        $hasDiscount = fake()->boolean(30);
        return [
            'category_id' => $category->id,
            'brand_id' => $serie->brand->id,
            'serie_id' => $serie->id,
            'name' => $serie->brand->name . ' ' . $serie->name . ' ' . fake()->streetName(),
            'description' => fake()->paragraph(rand(3, 5)),
            'stock' => fake()->randomNumber(2),
            'price' => fake()->randomFloat(1, 100, 1000),
            'discount_percent' => $hasDiscount ? fake()->numberBetween(10, 50) : 0,
            'discount_start' => today(),
            'discount_end' => today()->addDays(3),
            'viewed' => fake()->randomNumber(2),
            'created_at' => fake()->dateTimeBetween('-6 months', 'now'),
        ];
    }
}
