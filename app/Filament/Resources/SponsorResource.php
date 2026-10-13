<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SponsorResource\Pages;
use App\Filament\Resources\SponsorResource\RelationManagers;
use App\Models\Sponsor;
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

class SponsorResource extends Resource
{
    protected static ?string $model = Sponsor::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-s-squares-plus';
    protected static string | UnitEnum | null $navigationGroup = 'Modul';
    protected static ?string $navigationLabel = 'Sponsor-PL';
    protected static ?int $navigationSort = -8;
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('nama')->required(),
                TextInput::make('nomortelp')
                    ->label('Nomor Telepon'),
                TextInput::make('keterangan')
                    ->label('Keterangan')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID'),
                TextColumn::make('nama')->label('SPONSOR-PL'),
                TextColumn::make('nomortelp')->label('NOMOR TELEPON'),
                TextColumn::make('keterangan')->label('Keterangan'),
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
            'index' => Pages\ListSponsors::route('/'),
            'create' => Pages\CreateSponsor::route('/create'),
            'edit' => Pages\EditSponsor::route('/{record}/edit'),
        ];
    }
}
