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
      Schema::create('product_segments', function (Blueprint $table) {
         $table->foreignId('product_id')->constrained()->onDelete('cascade');
         $table->foreignId('segment_id')->constrained()->onDelete('cascade');
         $table->boolean('is_active')->default(true);
         $table->boolean('is_featured')->default(false);

         $table->timestamps();
         
         $table->primary(['product_id', 'segment_id']);
      });
   }

   /**
    * Reverse the migrations.
    */
   public function down(): void
   {
      Schema::dropIfExists('product_segments');
   }
};
