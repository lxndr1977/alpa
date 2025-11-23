<?php

namespace App\Filament\Resources\Products\Schemas\Components;

use Filament\Forms\Components\TextInput;
use Illuminate\Support\Str;

class ProductNameInput
{
   public static function make(bool $generateSlug = false): TextInput
   {
      $input = TextInput::make('name')
         ->label('Nome do produto')
         ->required()
         ->maxLength(200);

      if ($generateSlug) {
         $input->live(onBlur: true)
            ->afterStateUpdated(function (?string $operation = null, $state, $set) {
               if (($operation === 'create' || $operation === 'duplicate') && !empty($state)) {
                  $baseSlug = Str::slug($state);
                  $slug = $baseSlug;

                  if (\App\Models\Product::where('slug', $slug)->exists()) {
                     $slug = $baseSlug . '-' . substr(uniqid(), -6);
                  }

                  $set('slug', $slug);
               }
            });
      }

      return $input;
   }
}
