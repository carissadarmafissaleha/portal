<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TungguResource\Pages;
use App\Filament\Resources\TungguResource\RelationManagers;
use App\Models\Tunggu;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;


class TungguResource extends Resource
{
    protected static ?string $model = Tunggu::class;

    protected static ?string $navigationIcon = 'heroicon-s-squares-plus';
    protected static ?string $navigationGroup = 'Modul';
    protected static ?string $navigationLabel = 'Tunggu';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')->label('TUNGGU'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTunggus::route('/'),
            'create' => Pages\CreateTunggu::route('/create'),
            'edit' => Pages\EditTunggu::route('/{record}/edit'),
        ];
    }
}
