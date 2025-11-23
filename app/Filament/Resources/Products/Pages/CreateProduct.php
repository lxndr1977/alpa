<?php

namespace App\Filament\Resources\Products\Pages;

use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\Products\ProductResource;
use App\Filament\Traits\HasCustomFormActions;

class CreateProduct extends CreateRecord
{
   use HasCustomFormActions;
   
   protected static string $resource = ProductResource::class;

   protected function getCreatedNotification(): ?Notification
   {
      return Notification::make()
         ->success()
         ->title('Produto adicionado')
         ->body('O produto foi adicionado com sucesso.');
   }
}
