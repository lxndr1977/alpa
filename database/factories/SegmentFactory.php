<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Segment>
 */
class SegmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       $name = $this->faker->words(2, true);

        return [
            'name' => $name,
            'description' => $this->faker->sentence(),
            'is_active' => $this->faker->boolean(90), 
            'is_featured' => $this->faker->boolean(30), 
            'slug' => Str::slug($name),
            'meta_title' => $this->faker->sentence(3),
            'meta_description' => $this->faker->sentence(8),
            'meta_keywords' => implode(',', $this->faker->words(5)),
        ];
    }
}
