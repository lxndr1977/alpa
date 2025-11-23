<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Segment;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductCategorySeeder extends Seeder
{
   /**
    * Run the database seeds.
    */
   public function run(): void
   {
      $products = Product::all();
      $categories = Segment::all();

      foreach ($products as $product) {
         $segmentIds = $categories->random(rand(1, 3))->pluck('id');
         $product->categories()->syncWithoutDetaching($segmentIds);
      }
   }
}
