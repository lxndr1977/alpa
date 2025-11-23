<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms;
use Filament\Actions\Action;
use Filament\Support\Icons\Heroicon;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Repeater\TableColumn;

class ContentBlocksSchema
{
   public static function make(): Group
   {
      return Group::make([

         // BENEFÍCIOS
         Section::make('Benefícios e Características')
            ->icon(Heroicon::OutlinedStar)
            ->description('Destaque os principais benefícios e diferenciais do produto')
            ->collapsible()
            ->collapsed()
            ->columnSpanFull()
            ->schema([
               Forms\Components\Repeater::make('content_blocks.benefits.items')
                  ->label('Lista de Benefícios')
                  ->schema([
                     Forms\Components\Select::make('icon')
                        ->label('Ícone')
                        ->options([
                           'shield-check' => 'Proteção/Segurança',
                           'zap' => 'Rapidez/Eficiência',
                           'star' => 'Qualidade Premium',
                           'check-circle' => 'Garantia/Aprovação',
                           'award' => 'Excelência',
                           'clock' => 'Durabilidade',
                           'leaf' => 'Sustentabilidade',
                           'tool' => 'Facilidade',
                           'droplet' => 'Resistência',
                           'sun' => 'Resistência UV',
                        ])
                        ->searchable(),

                     Forms\Components\TextInput::make('title')
                        ->label('Título')
                        ->required()
                        ->placeholder('Ex: Alta Durabilidade'),

                     Forms\Components\Textarea::make('description')
                        ->label('Descrição')
                        ->rows(3)
                        ->columnSpanFull(),
                  ])
                  ->columns(2)
                  ->collapsible()
                  ->collapseAllAction(
                     fn(Action $action) => $action->hidden()
                  )
                  ->expandAllAction(
                     fn(Action $action) => $action->hidden()
                  )
                  ->collapsed()
                  ->itemLabel(fn(array $state) => $state['title'] ?? 'Novo benefício')
                  ->addActionLabel('Adicionar Benefício')
                  ->reorderable()
                  ->defaultItems(0)
                  ->columnSpanFull(),
            ]),

         // ESPECIFICAÇÕES TÉCNICAS
         Section::make('Especificações Técnicas')
            ->icon(Heroicon::OutlinedListBullet)
            ->description('Adicione grupos de especificações técnicas do produto')
            ->collapsible()
            ->collapsed()
            ->schema([
               Forms\Components\Repeater::make('content_blocks.specifications.sections')
                  ->label('Grupos de Especificações')
                  ->schema([
                     Forms\Components\TextInput::make('section_title')
                        ->label('Nome do Grupo')
                        ->placeholder('Ex: Características Gerais, Dimensões, Composição...')
                        ->required()
                        ->columnSpanFull(),

                     Forms\Components\Repeater::make('fields')
                        ->label('Especificações')
                        ->table([
                           TableColumn::make('Campo'),
                           TableColumn::make('Valor'),
                        ])
                        ->compact()
                        ->schema([
                           Forms\Components\TextInput::make('label')
                              ->label('Campo')
                              ->placeholder('Ex: Material, Espessura...')
                              ->required(),

                           Forms\Components\TextInput::make('value')
                              ->label('Valor')
                              ->placeholder('Ex: Alumínio 6063-T5')
                              ->required(),
                        ])
                        ->columns(2)
                        ->reorderable()
                        ->collapsible()
                        ->collapsed()
                        ->itemLabel(fn(array $state) => $state['label'] ?? 'Nova especificação')
                        ->addActionLabel('Adicionar campo')
                        ->deleteAction(
                           fn(Action $action) => $action->size('xs')->color('gray')
                        )
                        ->defaultItems(0)
                        ->columnSpanFull(),
                  ])
                  ->collapsible()
                  ->collapsed()
                  ->collapseAllAction(
                     fn(Action $action) => $action->hidden()
                  )
                  ->expandAllAction(
                     fn(Action $action) => $action->hidden()
                  )
                  ->itemLabel(fn(array $state) => $state['section_title'] ?? 'Novo grupo')
                  ->addActionLabel('Adicionar Grupo de Especificações')
                  ->reorderable()
                  ->defaultItems(0)
                  ->columnSpanFull(),
            ]),


         // DOWNLOADS
         Section::make('Arquivos para Download')
            ->icon(Heroicon::OutlinedDocumentText)
            ->description('Adicione catálogos, fichas técnicas e outros documentos')
            ->collapsible()
            ->collapsed()
            ->columnSpanFull()

            ->schema([
               Forms\Components\Repeater::make('content_blocks.downloads.files')
                  ->label('Arquivos')
                  ->schema([
                     Forms\Components\TextInput::make('name')
                        ->label('Nome do Arquivo')
                        ->required()
                        ->placeholder('Ex: Catálogo Técnico 2024'),

                     Forms\Components\Select::make('type')
                        ->label('Tipo')
                        ->options([
                           'catalog' => 'Catálogo',
                           'datasheet' => 'Ficha Técnica',
                           'manual' => 'Manual',
                           'certificate' => 'Certificado',
                           'standard' => 'Norma Técnica',
                           'other' => 'Outro',
                        ])
                        ->required(),

                     Forms\Components\FileUpload::make('file')
                        ->label('Arquivo PDF')
                        ->acceptedFileTypes(['application/pdf'])
                        ->maxSize(10240)
                        ->directory('products/downloads')
                        ->disk('public')
                        ->visibility('public')
                        ->columnSpanFull(),

                     Forms\Components\Textarea::make('description')
                        ->label('Descrição (opcional)')
                        ->rows(2)
                        ->columnSpanFull(),
                  ])
                  ->columns(2)
                  ->collapsible()
                  ->collapseAllAction(
                     fn(Action $action) => $action->hidden()
                  )
                  ->expandAllAction(
                     fn(Action $action) => $action->hidden()
                  )
                  ->collapsed()
                  ->itemLabel(fn(array $state) => $state['name'] ?? 'Novo arquivo')
                  ->addActionLabel('Adicionar Arquivo')
                  ->reorderable()
                  ->defaultItems(0)
                  ->columnSpanFull(),
            ]),

         // FAQ
         Section::make('Perguntas Frequentes')
            ->icon(Heroicon::OutlinedQuestionMarkCircle)
            ->description('Adicione as dúvidas mais comuns sobre o produto')
            ->collapsible()
            ->collapsed()
            ->columnSpanFull()

            ->schema([
               Forms\Components\Repeater::make('content_blocks.faq.questions')
                  ->label('Perguntas')
                  ->schema([
                     Forms\Components\TextInput::make('question')
                        ->label('Pergunta')
                        ->required()
                        ->placeholder('Ex: Qual a garantia deste produto?')
                        ->columnSpanFull(),

                     Forms\Components\Textarea::make('answer')
                        ->label('Resposta')
                        ->required()
                        ->rows(4)
                        ->columnSpanFull(),
                  ])
                  ->collapsible()
                  ->collapseAllAction(
                     fn(Action $action) => $action->hidden()
                  )
                  ->expandAllAction(
                     fn(Action $action) => $action->hidden()
                  )
                  ->collapsed()
                  ->itemLabel(fn(array $state) => $state['question'] ?? 'Nova pergunta')
                  ->addActionLabel('Adicionar Pergunta')
                  ->reorderable()
                  ->defaultItems(0)
                  ->columnSpanFull(),
            ]),
      ]);
   }
}
