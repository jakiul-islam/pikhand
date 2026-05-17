<?php

namespace Database\Factories;

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
      
        $name = fake()->unique()->productName(); 
      
        return [
            'name' => $name,
            'slug' => Str::slug($name), // ergonomic-wooden-chair
            'mata_title' =>  $name . ' - Best Price Online', // SEO title
            'category_id' => 1, // আপাতত 1 দিলাম। CategoryFactory থাকলে Category::factory() দিও
            'brand_id' => 1, // আপাতত 1 দিলাম
            'mata_description' => fake()->sentence(),
            'short_description' => fake()->sentence(15),
            'long_description' => fake()->paragraphs(3, true),
            'price' => fake()->numberBetween(100, 5000),
            'discount' => fake()->numberBetween(0, 50), // 0-50% discount
            'stock' => fake()->numberBetween(0, 200),
            'total_sales' => fake()->numberBetween(0, 500),
            'image' => 'https://placehold.co/600x400?text=' . urlencode($name), // আগের রিপ্লাই এর টিপস
            'product_code' => 'P' . fake()->unique()->numberBetween(1000, 9999),
            'sku' => 'SKU-' . fake()->unique()->bothify('??###??'),
            'weight' => fake()->randomFloat(2, 0.1, 20), // 0.10 থেকে 20.00 kg
            'dimensions' => fake()->numerify('##x## cm'),
            'color' => fake()->safeColorName(),
            'size' => fake()->randomElement(['S', 'M', 'L', 'XL']),
            'material' => fake()->randomElement(['Wood', 'Plastic', 'Metal', 'Cotton']),
            'warranty' => fake()->randomElement(['6 months', '1 year', '2 years']),
            'return_policy' => '7 days return policy',
            'rating' => fake()->randomFloat(1, 1, 5), // 1.0 থেকে 5.0
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }
}
