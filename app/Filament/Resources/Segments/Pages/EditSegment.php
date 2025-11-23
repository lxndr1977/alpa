<?php

namespace App\Filament\Resources\Segments\Pages;

use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Support\Icons\Heroicon;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Traits\HasCustomFormActions;
use App\Filament\Resources\Segments\SegmentResource;

class EditSegment extends EditRecord
{

   use HasCustomFormActions;

   protected static string $resource = SegmentResource::class;

   protected function getHeaderActions(): array
   {
      return [
         ActionGroup::make([
            DeleteAction::make()
               ->label('Excluir'),
         ])
            ->label('Mais ações')
            ->color('gray')
            ->outlined()
            ->button(),

         $this->getSaveFormAction()
            ->formId('form')
            ->icon(Heroicon::OutlinedCheckCircle),
      ];
   }

   protected function getSavedNotification(): ?Notification
   {
      return Notification::make()
         ->success()
         ->title('Segmento atualizado')
         ->body('O segmento foi atualizado com sucesso.');
   }
}
