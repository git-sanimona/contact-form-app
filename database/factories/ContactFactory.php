<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class ContactFactory extends Factory
{
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'gender' => fake()->randomElement([1, 2, 3]),
            'email' => fake()->email(),
            'tel' => fake()->numerify('00000000000'),
            'address' => fake()->address(),
            'building' => fake()->secondaryAddress(),
            'detail' => fake()->sentence(),
        ];
    }
}
