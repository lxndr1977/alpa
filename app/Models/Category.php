<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Category extends Model implements HasMedia
{
   /** @use HasFactory<\Database\Factories\CategoryFactory> */
   use HasFactory, InteractsWithMedia;

   protected $fillable = [
      'name',
      'description',
      'parent_category_id',
      'order',
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

   /*
    |--------------------------------------------------------------------------
    | RELACIONAMENTOS
    |--------------------------------------------------------------------------
    */

   // Pai (sem filtro)
   public function parent()
   {
      return $this->belongsTo(Category::class, 'parent_category_id');
   }

   // Pai ativo
   public function activeParent()
   {
      return $this->belongsTo(Category::class, 'parent_category_id')
         ->where('is_active', true);
   }

   // Filhos (sem filtro)
   public function children()
   {
      return $this->hasMany(Category::class, 'parent_category_id');
   }

   // Filhos ativos
   public function activeChildren()
   {
      return $this->hasMany(Category::class, 'parent_category_id')
         ->where('is_active', true)
         ->orderBy('order');
   }

   // Produtos
   public function products()
   {
      return $this->belongsToMany(Product::class, 'product_categories');
   }

   /*
    |--------------------------------------------------------------------------
    | ESCOPOS
    |--------------------------------------------------------------------------
    */

   // Escopo para filtrar categorias cujo pai é ativo
   public function scopeActiveParent(Builder $query)
   {
      return $query->whereHas('parent', fn($q) => $q->where('is_active', true));
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

   /*
    |--------------------------------------------------------------------------
    | MÉTODOS AUXILIARES
    |--------------------------------------------------------------------------
    */

   // Verifica se a categoria é raiz (não tem pai)
   public function isRoot(): bool
   {
      return $this->parent_category_id === null;
   }

   // Retorna o nível da categoria (1, 2 ou 3)
   public function getLevelAttribute(): int
   {
      if (!$this->parent_category_id) {
         return 1;
      }

      $parent = $this->parent;
      return $parent && $parent->parent_category_id ? 3 : 2;
   }


   public function registerMediaConversions(?Media $media = null): void
   {
      $this->addMediaConversion('responsive')
         ->fit(Fit::Crop, 1280, 1280)
         ->format('webp')
         ->withResponsiveImages()
         ->nonQueued();

      $this->addMediaConversion('thumbnail')
         ->fit(Fit::Crop, 150, 150)
         ->format('webp')
         ->nonQueued();
   }
}
