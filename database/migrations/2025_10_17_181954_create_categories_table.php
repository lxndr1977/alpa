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
      Schema::create('categories', function (Blueprint $table) {
         $table->id();
         $table->string('name', 100);
         $table->text('description')->nullable();
         $table->foreignId('parent_category_id')->nullable()->constrained('categories')->onDelete('cascade');
         $table->integer('order')->default(0);
         $table->boolean('is_active')->default(true);
         $table->boolean('is_featured')->default(false);

         $table->string('slug')->unique()->nullable();
         $table->string('meta_title')->nullable();
         $table->text('meta_description')->nullable();
         $table->text('meta_keywords')->nullable();

         $table->timestamps();

         $table->index('parent_category_id');
      });
   }

   /**
    * Reverse the migrations.
    */
   public function down(): void
   {
      Schema::dropIfExists('categories');
   }
};
