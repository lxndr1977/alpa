<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\Actions\DuplicateProductAction;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Support\Icons\Heroicon;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Filament\Schemas\Components\Section;
use App\Filament\Traits\HasCustomFormActions;
use App\Filament\Resources\Products\ProductResource;
use App\Filament\Resources\Products\Schemas\Components\ProductNameInput;
use App\Filament\Resources\Products\Schemas\Components\ProductSlugInput;

class EditProduct extends EditRecord
{
   use HasCustomFormActions;

   protected static string $resource = ProductResource::class;

   protected function getHeaderActions(): array
   {
      return [
         Action::make('view_public')
            ->label('Ver produto')
            ->icon(Heroicon::OutlinedComputerDesktop)
            ->color('gray')
            ->outlined()
            ->url(fn() => route('products.show', ['product' => $this->record->slug]))
            ->openUrlInNewTab(),

         ActionGroup::make([
            DuplicateProductAction::make(),

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
         ->title('Produto atualizado')
         ->body('O produto foi atualizado com sucesso.');
   }
}
