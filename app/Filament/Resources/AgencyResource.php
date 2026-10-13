<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AgencyResource\Pages;
use App\Filament\Resources\AgencyResource\RelationManagers;
use App\Models\Agency;
use Filament\Forms;
use BackedEnum;
use UnitEnum;
use Filament\Schemas\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AgencyResource extends Resource
{
    protected static ?string $model = Agency::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-s-squares-plus';
    protected static string | UnitEnum | null $navigationGroup = 'Modul';
    protected static ?string $navigationLabel = 'Agency';
    protected static ?int $navigationSort = -8;
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Fieldset::make('')
                    ->schema([
                        TextInput::make('nama')->required(),
                        TextInput::make('penanggungjawab')
                            ->label(__('Penanggung Jawab')),
                        TextInput::make('nomortelp')
                            ->label(__('Nomor Telepon')),
                        TextInput::make('alamat')
                            ->label(__('ALamat')),

                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label(__('ID')),
                TextColumn::make('nama')->label(__('NAMA AGENCY')),
                TextColumn::make('penanggungjawab')->label(__('PENANGGUNG JAWAB')),
                TextColumn::make('nomortelp')->label(__('NOMOR TELEPON')),
                TextColumn::make('alamat')->label(__('ALAMAT')),

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
            'index' => Pages\ListAgencies::route('/'),
            'create' => Pages\CreateAgency::route('/create'),
            'edit' => Pages\EditAgency::route('/{record}/edit'),
        ];
    }
}
