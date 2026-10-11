<?php

namespace App\Filament\Resources\TungguResource\Pages;

use App\Filament\Resources\TungguResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTunggus extends ListRecords
{
    protected static string $resource = TungguResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
