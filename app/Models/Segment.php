<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Segment extends Model  implements HasMedia
{
   /** @use HasFactory<\Database\Factories\SegmentFactory> */
   use HasFactory, InteractsWithMedia;

   protected $fillable = [
      'name',
      'description',
      'is_active',
      'is_featured',
      'slug',
      'meta_title',
      'meta_description',
      'meta_keywords',
   ];

   protected $casts = [
      'is_active' => 'boolean',
      'is_featured' => 'boolean',

   ];

   public function products()
   {
      return $this->belongsToMany(Product::class, 'product_segments');
   }

   // Escopo para filtrar categorias ativas
   public function scopeActive(Builder $query)
   {
      return $query->where('is_active', true); 
   }

   public function scopeFeatured(Builder $query)
   {
      return $query->where('is_featured', true);
   }
}
