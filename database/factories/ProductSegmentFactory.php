<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Segment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductSegment>
 */
class ProductSegmentFactory extends Factory
{
   /**
    * Define the model's default state.
    *
    * @return array<string, mixed>
    */
   public function definition(): array
   {
      return [
         'product_id' => Product::inRandomOrder()->value('id') ?? Product::factory(),
         'segment_id' => Segment::inRandomOrder()->value('id') ?? Segment::factory(),
      ];
   }
}
