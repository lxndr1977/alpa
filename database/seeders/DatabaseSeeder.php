<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
   /**
    * Seed the application's database.
    */
   public function run(): void
   {
      // User::factory(10)->create();

      User::factory()->create([
         'name' => 'Alexandre Pereira',
         'email' => 'pereira.alexandre@gmail.com',
         'password' => Hash::make('e1x25fx0'),
      ]);

      $this->call([
         SegmentSeeder::class,
         CategorySeeder::class,
         ProductSeeder::class,
         ProductSegmentSeeder::class,
         ProductCategorySeeder::class,
      ]);
   }
}
