<?php

namespace App\Filament\Resources\Categories\Pages;

use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Traits\HasCustomFormActions;
use App\Filament\Resources\Categories\CategoryResource;

class CreateCategory extends CreateRecord
{
   use HasCustomFormActions;

   protected static string $resource = CategoryResource::class;

   protected function getCreatedNotification(): ?Notification
   {
      return Notification::make()
         ->success()
         ->title('Categoria adicionada')
         ->body('A categoria foi adicionada com sucesso.');
   }


   protected function mutateFormDataBeforeCreate(array $data): array
{
    $data['slug'] = \Illuminate\Support\Str::slug($data['name']) . '-' . substr(uniqid(), -6);
    return $data;
}
}
