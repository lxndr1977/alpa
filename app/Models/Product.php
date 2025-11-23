<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
   use HasFactory, InteractsWithMedia;

   protected $fillable = [
      'code',
      'name',
      'description',
      'short_description',
      'content_blocks',
      'is_active',
      'is_featured',
      'slug',
      'meta_title',
      'meta_description',
      'meta_keywords',
   ];

   protected $casts = [
      'content_blocks' => 'array',
      'is_active' => 'boolean',
      'is_featured' => 'boolean',
   ];

    // ============================================
    // EAGER LOADING COM ORDENAÇÃO
    // ============================================

   /**
    * Sempre carrega as mídias ordenadas
    */
   protected static function booted()
   {
      static::retrieved(function ($product) {
         if ($product->relationLoaded('media')) {
            $product->setRelation(
               'media',
               $product->media->sortBy('order_column')->values()
            );
         }
      });
   }

   // ============================================
   // RELACIONAMENTOS
   // ============================================

   public function categories(): BelongsToMany
   {
      return $this->belongsToMany(Category::class, 'product_categories')
         ->withTimestamps();
   }

   public function segments(): BelongsToMany
   {
      return $this->belongsToMany(Segment::class, 'product_segments')
         ->withTimestamps();
   }

   // ============================================
   // SPATIE MEDIA LIBRARY
   // ============================================

   public function registerMediaCollections(): void
   {
      // Galeria principal do produto
      $this->addMediaCollection('gallery')
         ->useFallbackUrl('/images/placeholder-product.png')
         ->useFallbackPath(public_path('/images/placeholder-product.png'));
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

    // ============================================
    // ACCESSORS & HELPERS
    // ============================================

   /**
    * Retorna apenas blocos visíveis
    */
   public function getVisibleContentBlocksAttribute(): array
   {
      return collect($this->content_blocks ?? [])
         ->filter(fn($block) => $block['visible'] ?? true)
         ->values()
         ->toArray();
   }

   /**
    * Retorna a primeira imagem da galeria como principal
    */
   public function getMainImageAttribute(): ?string
   {
      $firstMedia = $this->getFirstMedia('gallery');
      return $firstMedia?->getUrl('responsive');
   }

   /**
    * Retorna URL da thumbnail da primeira imagem
    */
   public function getThumbnailAttribute(): ?string
   {
      $firstMedia = $this->getFirstMedia('gallery');
      return $firstMedia?->getUrl('thumbnail');
   }

   /**
    * Verifica se o produto tem galeria
    */
   public function hasGallery(): bool
   {
      return $this->hasMedia('gallery');
   }

   // ============================================
   // SCOPES
   // ============================================


   public function scopeFeatured(Builder $query)
   {
      return $query->where('is_featured', true);
   }

   public function scopeActive($query)
   {
      return $query->where('is_active', true);
   }

   public function scopeWithCategory(Builder $query, $categoryId)
   {
      return $query->whereHas(
         'categories',
         fn($q) =>
         $q->where('categories.id', $categoryId)
      );
   }

   public function scopeWithSegment(Builder $query, $segmentId)
   {
      return $query->whereHas(
         'segments',
         fn($q) =>
         $q->where('segments.id', $segmentId)
      );
   }
}
