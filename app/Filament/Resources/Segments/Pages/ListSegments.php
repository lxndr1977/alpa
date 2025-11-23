<?php

namespace App\Filament\Resources\Segments\Pages;

use Filament\Actions\CreateAction;
use Filament\Support\Icons\Heroicon;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\Segments\SegmentResource;

class ListSegments extends ListRecords
{
   protected static string $resource = SegmentResource::class;

   protected function getHeaderActions(): array
   {
      return [
         CreateAction::make()
            ->icon(Heroicon::OutlinedPlusCircle),
      ];
   }
}
