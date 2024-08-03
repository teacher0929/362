<?php

namespace Database\Factories;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\Product;
use App\Models\Serie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Configure the model factory.
     */
    public function configure(): static
    {
        return $this->afterMaking(function (Product $product) {
            // ...
        })->afterCreating(function (Product $product) {
            $attributes = Attribute::orderBy('sort_order')
                ->get();

            $attributeValues = [];
            foreach ($attributes as $attribute) {
                $attributeValue = AttributeValue::where('attribute_id', $attribute->id)
                    ->inRandomOrder()
                    ->first();

                if ($attributeValue) {
                    $attributeValues[] = $attributeValue->id;
                }
            }

            $product->attributeValues()->sync($attributeValues);
        });
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = Category::inRandomOrder()->first();
        $serie = Serie::with('brand')->inRandomOrder()->first();
        $name = $serie->brand->name . ' ' . $serie->name . ' ' . fake()->streetName();
        $hasDiscount = fake()->boolean(30);
        return [
            'category_id' => $category->id,
            'brand_id' => $serie->brand->id,
            'serie_id' => $serie->id,
            'name' => $name,
            'slug' => str($name)->slug(),
            'description' => fake()->paragraph(rand(3, 5)),
            'stock' => fake()->randomNumber(1),
            'price' => fake()->randomFloat(1, 100, 1000),
            'discount_percent' => $hasDiscount ? fake()->numberBetween(10, 50) : 0,
            'discount_start' => today(),
            'discount_end' => today()->addDays(3),
            'viewed' => fake()->randomNumber(2),
            'favorites' => fake()->randomNumber(1),
            'created_at' => fake()->dateTimeBetween('-6 months', 'now'),
        ];
    }
}
