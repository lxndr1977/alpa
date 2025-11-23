<?php

namespace App\Filament\Resources\Categories\Schemas;

use App\Models\Category;
use Illuminate\Support\Str;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class CategoryForm
{
   public static function configure(Schema $schema): Schema
   {
      return $schema
         ->components([
            Section::make('Categoria')
               ->description('Informações da categoria')
               ->icon(Heroicon::OutlinedDocumentText)
               ->schema([
                  TextInput::make('name')
                     ->label('Nome da categoria')
                     ->columnSpanFull()
                     ->required()
                     ->maxLength(255),

                  Textarea::make('description')
                     ->label('Descrição')
                     ->columnSpan(2)
                     ->columnSpanFull()
                     ->rows(5),

                  Select::make('parent_category_id')
                     ->label('Categoria Pai')
                     ->placeholder('Nenhuma (categoria raiz)')
                     ->relationship('parent', 'name')
                     ->searchable()
                     ->preload()
                     ->native(false)
                     ->getOptionLabelFromRecordUsing(
                        fn(Category $record) =>
                        $record->parent
                           ? "{$record->parent->name} > {$record->name}"
                           : $record->name
                     ),

                  TextInput::make('order')
                     ->label('Ordem')
                     ->required()
                     ->numeric()
                     ->default(0)
                     ->minValue(0),

                  Toggle::make('is_active')
                     ->label('Exibir produto no site')
                     ->default(true),

                  Toggle::make('is_featured')
                     ->label('Destacar na home')
                     ->default(true),
               ])
               ->columns(2)
               ->columnSpanFull(),


            Section::make('Foto')
               ->description('Imagem da categoria')
               ->icon(Heroicon::OutlinedPhoto)
               ->schema([
                  SpatieMediaLibraryFileUpload::make('categories')
                     ->label('Imagem da categoria')
                     ->collection('categories')
                     ->responsiveImages()
                     ->conversion('thumbnail')
                     ->conversion('responsive')
                     ->panelLayout('grid') 
                     ->helperText('Tamanho recomendado: 1280 x')
                     ->disk('public')
                     ->columnSpanFull(),
               ])
               ->columnSpanFull()
               ->collapsible(),

            Section::make('SEO e Metadados')
               ->description('Informações para indexação nos mecanismos de buscas')
               ->icon(Heroicon::OutlinedChartBar)
               ->schema([
                  TextInput::make('slug')
                     ->label('Slug')
                     ->required(fn (string $operation) => $operation === 'edit')
                     ->maxLength(255)
                     ->unique('categories', 'slug', ignoreRecord: true)
                     ->helperText('URL gerada automaticamente. Se já existir, um código será adicionado.'),

                  TextInput::make('meta_title')
                     ->label('Meta Title')
                     ->maxLength(60)
                     ->helperText('Ideal: 50-60 caracteres'),

                  Textarea::make('meta_description')
                     ->label('Meta Description')
                     ->maxLength(160)
                     ->rows(3)
                     ->helperText('Ideal: 150-160 caracteres')
                     ->columnSpanFull(),

                  Textarea::make('meta_keywords')
                     ->label('Meta Keywords')
                     ->rows(2)
                     ->helperText('Separadas por vírgula')
                     ->columnSpanFull(),
               ])
               ->columnSpanFull()
               ->columns(2)
               ->collapsible()
               ->collapsed(),
         ]);
   }
}
