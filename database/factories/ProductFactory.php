<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'price_1' => $this->faker->numberBetween(1,10),
            'price_3' => $this->faker->numberBetween(2,20),
            'price_5' => $this->faker->numberBetween(3,30),
        ];
    }
}
