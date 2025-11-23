<?php

namespace App\Filament\Resources\Products\Pages;

use Filament\Actions\CreateAction;
use Filament\Support\Icons\Heroicon;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\Products\ProductResource;
use App\Filament\Resources\Products\Widgets\ProductStats;

class ListProducts extends ListRecords
{
   protected static string $resource = ProductResource::class;

   protected function getHeaderActions(): array
   {
      return [
         CreateAction::make()
            ->icon(Heroicon::OutlinedPlusCircle),
      ];
   }

   public function getTabs(): array
   {
      return [
         'active' => Tab::make('Ativos')
            ->icon(Heroicon::OutlinedCheckCircle)
            ->modifyQueryUsing(fn(Builder $query) => $query->where('is_active', true)),
         'inactive' => Tab::make('Inativos')
            ->icon(Heroicon::OutlinedXCircle)
            ->modifyQueryUsing(fn(Builder $query) => $query->where('is_active', false)),
         'all' => Tab::make('Todos')
            ->icon(Heroicon::OutlinedBars3),
      ];
   }
}
