<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Segment;
use App\Models\ProductSegment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSegmentSeeder extends Seeder
{
   /**
    * Run the database seeds.
    */
   public function run(): void
   {
      $products = Product::all();
      $segments = Segment::all();

      foreach ($products as $product) {
         $segmentIds = $segments->random(rand(1, 3))->pluck('id');
         $product->segments()->syncWithoutDetaching($segmentIds);
      }
   }
}
