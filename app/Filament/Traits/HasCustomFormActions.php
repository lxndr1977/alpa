<?php

namespace App\Filament\Traits;

use Filament\Actions;
use Filament\Support\Icons\Heroicon;

trait HasCustomFormActions
{

    protected function getCreateFormAction(): Actions\Action
    {
        return parent::getCreateFormAction()
            ->icon(Heroicon::OutlinedPlusCircle);
    }

    protected function getCreateAnotherFormAction(): Actions\Action
    {
        return parent::getCreateAnotherFormAction()
            ->icon(Heroicon::OutlinedSquaresPlus);
    }

    protected function getSaveFormAction(): Actions\Action
    {
        return parent::getSaveFormAction()
            ->icon(Heroicon::OutlinedCheckCircle);
    }

    protected function getCancelFormAction(): Actions\Action
    {
        return parent::getCancelFormAction()
            ->icon(Heroicon::OutlinedXCircle);
    }
}