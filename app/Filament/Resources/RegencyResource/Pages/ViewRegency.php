<?php

namespace App\Filament\Resources\RegencyResource\Pages;

use App\Filament\Resources\RegencyResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRegency extends ViewRecord
{
    protected static string $resource = RegencyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
