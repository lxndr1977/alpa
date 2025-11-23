<?php

namespace App\Filament\Resources\Segments\Schemas;

use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;

class SegmentForm
{
   public static function configure(Schema $schema): Schema
   {
      return $schema
         ->components([
            Section::make('Segmento')
               ->description('Informações do segmento')
               ->icon(Heroicon::OutlinedDocumentText)
               ->schema([
                  TextInput::make('name')
                     ->label('Nome do segmento')
                     ->columnSpanFull()
                     ->required()
                     ->maxLength(255),

                  Textarea::make('description')
                     ->label('Descrição')
                     ->columnSpan(2)
                     ->columnSpanFull()
                     ->rows(5),

                  Toggle::make('is_active')
                     ->label('Exibir no site'),

                  Toggle::make('is_featured')
                     ->label('Destacar no site'),
               ])
               ->columns(2)
               ->columnSpanFull(),

            Section::make('SEO e Metadados')
               ->description('Informações para indexação nos mecanismos de buscas')
               ->icon(Heroicon::OutlinedChartBar)
               ->schema([
                  TextInput::make('slug')
                     ->label('Slug')
                     ->required()
                     ->maxLength(255)
                     ->unique('segments', 'slug', ignoreRecord: true)
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
