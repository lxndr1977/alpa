<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Nette\Utils\Random;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
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
         'parent_category_id' => null, 
         'order' => $this->faker->numberBetween(0, 100),
         'is_active' => $this->faker->boolean(90),
         'slug' => Str::slug($name) . Str::random(6),
         'meta_title' => $this->faker->sentence(3),
         'meta_description' => $this->faker->sentence(8),
         'meta_keywords' => implode(',', $this->faker->words(5)),
      ];
   }
}
