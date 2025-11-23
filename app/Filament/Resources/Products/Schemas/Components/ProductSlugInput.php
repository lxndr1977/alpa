<?php

namespace App\Filament\Resources\Products\Schemas\Components;

use Filament\Forms\Components\TextInput;

class ProductSlugInput
{
    public static function make(): TextInput
    {
        return TextInput::make('slug')
            ->label('Slug')
            ->required()
            ->maxLength(255)
            ->unique('products', 'slug', ignoreRecord: true)
            ->helperText('URL gerada automaticamente. Se já existir, um código será adicionado.');
    }
}