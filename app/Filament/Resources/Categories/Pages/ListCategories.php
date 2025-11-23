<?php

namespace App\Filament\Resources\Categories\Pages;

use Filament\Actions\CreateAction;
use Filament\Support\Icons\Heroicon;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\Categories\CategoryResource;

class ListCategories extends ListRecords
{
   protected static string $resource = CategoryResource::class;

   protected function getHeaderActions(): array
   {
      return [
         CreateAction::make()
            ->icon(Heroicon::OutlinedPlusCircle),
      ];
   }
}
