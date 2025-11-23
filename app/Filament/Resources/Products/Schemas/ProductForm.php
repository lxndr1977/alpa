<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Filament\Resources\Products\Schemas\Components\ProductNameInput;
use App\Filament\Resources\Products\Schemas\Components\ProductSlugInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Support\Icons\Heroicon;

class ProductForm
{
   public static function configure(Schema $schema): Schema
   {
      return $schema
         ->components([

            Section::make('Informações')
               ->description('Informações de identificação do produto')
               ->icon(Heroicon::OutlinedCube)
               ->schema([
                  ProductNameInput::make(generateSlug: true)
                     ->columnSpan(2),

                  TextInput::make('code')
                     ->label('Código')
                     ->required()
                     ->unique(ignoreRecord: true)
                     ->maxLength(50),

                  TextInput::make('short_description')
                     ->label('Descrição curta')
                     ->columnSpanFull()
                     ->maxLength(500),

                  RichEditor::make('description')
                     ->label('Descrição')
                     ->columnSpanFull()
                     ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'bulletList',
                        'orderedList',
                        'link',
                        'h2',
                        'h3',
                     ])
                     ->extraInputAttributes(['style' => 'min-height: 300px; max-height: 300px; overflow-y: auto;']),

                  Toggle::make('is_active')
                     ->label('Exibir produto no site')
                     ->default(true),

                  Toggle::make('is_featured')
                     ->label('Destacar na home')
                     ->default(true),
               ])
               ->columnSpanFull()
               ->columns(3)
               ->collapsible(),

            Section::make('Fotos')
               ->description('Galeria de fotos do produto')
               ->icon(Heroicon::OutlinedPhoto)
               ->schema([
                  SpatieMediaLibraryFileUpload::make('products')
                     ->label('Fotos do Produto')
                     ->collection('products')
                     ->multiple()
                     ->reorderable()
                     ->maxFiles(10)
                     ->responsiveImages()
                     ->conversion('thumbnail')
                     ->conversion('responsive')
                     ->panelLayout('grid')
                     ->disk('public')
                     ->helperText('A primeira imagem será usada como imagem principal. Adicione até 10 imagens.')
                     ->columnSpanFull()
                     ->appendFiles(),
               ])
               ->columnSpanFull()
               ->collapsible(),

            // BLOCOS DE CONTEÚDO (importado)
            ContentBlocksSchema::make()
               ->columnSpanFull(),

            Section::make('Categorias e Segmentos')
               ->description('Relacione categorias e/ou segmentos ao produto')
               ->icon(Heroicon::OutlinedPhoto)
               ->schema([
                  Select::make('segments')
                     ->label('Segmentos')
                     ->relationship('segments', 'name')
                     ->multiple()
                     ->searchable()
                     ->preload(),

                  Select::make('categories')
                     ->label('Categorias')
                     ->relationship('categories', 'name')
                     ->multiple()
                     ->searchable()
                     ->preload()
                     ->getOptionLabelFromRecordUsing(function ($record) {
                        $labels = [];
                        $current = $record;

                        while ($current) {
                           array_unshift($labels, $current->name);
                           $current = $current->parent;
                        }

                        return implode(' → ', $labels);
                     })
                     ->getSearchResultsUsing(function (string $search) {
                        return \App\Models\Category::query()
                           ->where('name', 'like', "%{$search}%")
                           ->where('is_active', true)
                           ->get()
                           ->mapWithKeys(function ($category) {
                              $labels = [];
                              $current = $category;

                              while ($current) {
                                 array_unshift($labels, $current->name);
                                 $current = $current->parent;
                              }

                              return [$category->id => implode(' → ', $labels)];
                           });
                     }),
               ])
               ->columnSpanFull()
               ->columns(2)
               ->collapsible()
               ->collapsed(),

            Section::make('SEO e Metadados')
               ->description('Informações para indexação nos mecanismos de buscas')
               ->icon(Heroicon::OutlinedChartBar)
               ->schema([
                  ProductSlugInput::make(),

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
