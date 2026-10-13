<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TujuanResource\Pages;
use App\Filament\Resources\TujuanResource\RelationManagers;
use App\Models\Tujuan;
use Filament\Forms;
use BackedEnum;
use UnitEnum;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TujuanResource extends Resource
{
    protected static ?string $model = Tujuan::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-s-squares-plus';
    protected static string | UnitEnum | null $navigationGroup = 'Modul';
    protected static ?string $navigationLabel = 'Tujuan';
    protected static ?int $navigationSort = -8;
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
                TextColumn::make('nama')->label('TUJUAN'),
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
            'index' => Pages\ListTujuans::route('/'),
            'create' => Pages\CreateTujuan::route('/create'),
            'edit' => Pages\EditTujuan::route('/{record}/edit'),
        ];
    }
}
