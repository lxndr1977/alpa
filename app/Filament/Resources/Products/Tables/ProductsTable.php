<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ProductsTable
{
   public static function configure(Table $table): Table
   {
      return $table
         ->columns([
            TextColumn::make('code')
               ->label('Código')
               ->searchable(),
               
            TextColumn::make('name')
               ->label('Nome do produto')
               ->searchable()
               ->sortable(),

            IconColumn::make('is_active')
               ->label('Ativo')
               ->boolean(),

            TextColumn::make('slug')
               ->label('Slug')
               ->searchable(),

            TextColumn::make('created_at')
               ->label('Criado')
               ->dateTime()
               ->sortable()
               ->toggleable(isToggledHiddenByDefault: true),

            TextColumn::make('updated_at')
               ->label('Atualizado')
               ->dateTime()
               ->sortable()
               ->toggleable(isToggledHiddenByDefault: true),
         ])
         ->defaultSort('name')
         ->filters([
            //
         ])
         ->recordActions([
            EditAction::make(),
         ])
         ->toolbarActions([
            BulkActionGroup::make([
               DeleteBulkAction::make(),
            ]),
         ]);
   }


   public function getTabs(): array
   {
      return [
         'all' => Tab::make('All customers'),
         'active' => Tab::make('Active customers')
            ->modifyQueryUsing(fn(Builder $query) => $query->where('is_active', true)),
         'inactive' => Tab::make('Inactive customers')
            ->modifyQueryUsing(fn(Builder $query) => $query->where('is_active', false)),
      ];
   }


}
