<?php

namespace App\Filament\Resources\TungguResource\Pages;

use App\Filament\Resources\TungguResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTunggu extends EditRecord
{
    protected static string $resource = TungguResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
