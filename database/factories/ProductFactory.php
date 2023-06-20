<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Product::class;
    public function definition()
    {
        
        return [
            'name' =>fake()->text(60),
            'description' =>fake()->paragraph(),
            'price' => fake()->numberBetween(10, 9000),
            'manage_stock' => false,
            'in_stock' => fake()->boolean(),
            'slug' => fake()->slug(),
            'sku' => fake()->word(),
            'is_active' => fake()->boolean(),
    
        ];
    }
}
