<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
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
        return [
            'category_id' => Category::factory(),
            'title' => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'description' => $this->faker->paragraph,
        ];
    }
    public function configure()
    {
        return $this->afterCreating(function (Product $product) {

            $product->addMediaFromUrl('https://www.larazawestern.com/wp-content/uploads/89mon-1-scaled-e1681432403123-768x768.jpg')
                ->toMediaCollection('product_images');
        });
    }
}
