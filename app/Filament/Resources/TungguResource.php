<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TungguResource\Pages;
use App\Filament\Resources\TungguResource\RelationManagers;
use App\Models\Tunggu;
use BackedEnum;
use UnitEnum;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TungguResource extends Resource
{
    protected static ?string $model = Tunggu::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-s-squares-plus';
    protected static string | UnitEnum | null $navigationGroup = 'Modul';
    protected static ?string $navigationLabel = 'Tunggu';
    public static function form(Schema $schema): Schema
    {
        return $schema
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
