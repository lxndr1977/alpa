<?php

namespace Database\Seeders;

use App\Models\Segment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SegmentSeeder extends Seeder
{
   /**
    * Run the database seeds.
    */
   public function run(): void
   {
      Segment::factory()->count(10)->create();
   }
}
