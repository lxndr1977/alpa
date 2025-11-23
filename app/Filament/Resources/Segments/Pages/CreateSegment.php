<?php

namespace App\Filament\Resources\Segments\Pages;

use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Traits\HasCustomFormActions;
use App\Filament\Resources\Segments\SegmentResource;

class CreateSegment extends CreateRecord
{
   use HasCustomFormActions;

   protected static string $resource = SegmentResource::class;

   protected function getCreatedNotification(): ?Notification
   {
      return Notification::make()
         ->success()
         ->title('Segmento adicionado')
         ->body('O segmento foi adicionado com sucesso.');
   }
}
