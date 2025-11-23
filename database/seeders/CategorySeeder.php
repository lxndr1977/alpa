<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
   /**
    * Run the database seeds.
    */
   public function run(): void
   {

      $mainCategories = Category::factory()->count(20)->create();

      foreach ($mainCategories as $mainCategory) {
         $subCategories = Category::factory()->count(12)->make()->each(function ($subCategory) use ($mainCategory) {
            $subCategory->parent_category_id = $mainCategory->id;
            $subCategory->save();
         });
      }
   }
}
