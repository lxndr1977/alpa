<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   /**
    * Run the migrations.
    */
   public function up(): void
   {
      Schema::create('products', function (Blueprint $table) {
         $table->id();
         $table->string('code', 50)->unique();
         $table->string('name', 200);
         $table->string('short_description', 500)->nullable();
         $table->text('description')->nullable();
         $table->json('content_blocks')->nullable();
         $table->boolean('is_active')->default(true);
         $table->boolean('is_featured')->default(false);

         $table->string('slug')->unique()->nullable();
         $table->string('meta_title')->nullable();
         $table->text('meta_description')->nullable();
         $table->text('meta_keywords')->nullable();

         $table->timestamps();
      });
   }

   /**
    * Reverse the migrations.
    */
   public function down(): void
   {
      Schema::dropIfExists('products');
   }
};
