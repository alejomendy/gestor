<?php

namespace App\Filament\Resources\DeclaracionJurada\Pages;

use App\Filament\Resources\DeclaracionJurada\DeclaracionJuradaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDeclaracion extends EditRecord
{
    protected static string $resource = DeclaracionJuradaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
