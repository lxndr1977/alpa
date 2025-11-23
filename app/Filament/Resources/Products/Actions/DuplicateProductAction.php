<?php

namespace App\Filament\Resources\Products\Actions;

use App\Models\Product;
use Filament\Actions\Action;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Notifications\Notification;
use App\Filament\Resources\Products\ProductResource;
use App\Filament\Resources\Products\Schemas\Components\ProductNameInput;
use App\Filament\Resources\Products\Schemas\Components\ProductSlugInput;

class DuplicateProductAction
{
   public static function make(): Action
   {
      return Action::make('duplicate')
         ->label('Duplicar produto')
         ->icon('heroicon-o-document-duplicate')
         ->color('gray')
         ->modalSubmitActionLabel('Duplicar')
         ->modalCancelActionLabel('Cancelar')
         ->fillForm(function (Product $product) {
            $baseSlug = \Illuminate\Support\Str::slug($product->name . ' copia');
            $slug = $baseSlug;

            if (\App\Models\Product::where('slug', $slug)->exists()) {
               $slug = $baseSlug . '-' . substr(uniqid(), -6);
            }

            return [
               'name' => $product->name . ' (Cópia)',
               'slug' => $slug,
               'duplicate_images' => true,
               'duplicate_categories' => true,
               'duplicate_segments' => true,
            ];
         })
         ->schema([
            ProductNameInput::make(generateSlug: true),

            ProductSlugInput::make(),

            Group::make()
               ->schema([
                  Toggle::make('duplicate_images')
                     ->label('Duplicar imagens da galeria')
                     ->default(false),

                 Toggle::make('duplicate_categories')
                     ->label('Duplicar categorias')
                     ->default(false),

                  Toggle::make('duplicate_segments')
                     ->label('Duplicar segmentos')
                     ->default(false),
               ])
               ->columns(3),
         ])
         ->action(function (Product $product, array $data) {
            $newProduct = $product->replicate();
            $newProduct->name = $data['name'];
            $newProduct->slug = $data['slug'];

            // Gerar novo código único
            $newProduct->code = $product->code . '-' . substr(uniqid(), -6);
            $newProduct->save();

            // Duplicar categorias se solicitado
            if ($data['duplicate_categories'] ?? false) {
               $newProduct->categories()->sync($product->categories->pluck('id'));
            }

            // Duplicar segmentos se solicitado
            if ($data['duplicate_segments'] ?? false) {
               $newProduct->segments()->sync($product->segments->pluck('id'));
            }

            // Duplicar imagens se solicitado
            if ($data['duplicate_images'] ?? false) {
               foreach ($product->getMedia('gallery') as $media) {
                  $media->copy($newProduct, 'gallery');
               }
            }

            Notification::make()
               ->success()
               ->title('Produto duplicado')
               ->body('O produto foi duplicado com sucesso.')
               ->send();

            return redirect()->to(ProductResource::getUrl('edit', ['record' => $newProduct->id]));
         });
   }
}
