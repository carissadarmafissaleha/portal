<?php

namespace App\Filament\Resources;

use BackedEnum;
use UnitEnum;
use App\Filament\Resources\ProsesCpmiResource\Pages;
use App\Filament\Resources\ProsesCpmiResource\RelationManagers;
use App\Models\ProsesCpmi;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use App\Models\Pendaftaran;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use Filament\Tables\Actions\Action;
use App\Filament\Exports\ProsesCpmiExporter;
use Filament\Schemas\Components\Fieldset;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Carbon\Carbon;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Tables\Actions\ExportAction;
use Tapp\FilamentAuditing\RelationManagers\AuditsRelationManager;

class ProsesCpmiResource extends Resource
{
    protected static ?string $model = ProsesCpmi::class;

    // protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-arrow-path-rounded-square';
    protected static ?string $navigationLabel = 'PROSES CPMI';
    protected static ?int $navigationSort = -1;
    protected static string | UnitEnum | null $navigationGroup = 'PROSES';


    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('PENDAFTARAN')
                    ->description('Data Pendaftaran')
                    ->icon('heroicon-m-check-badge')
                    ->schema([
                        Select::make('status_id',)
                            ->relationship('Status', 'nama')
                            ->required()
                            ->placeholder('Pilih Status CPMI')
                            ->label('Status CPMI'),
                        Select::make('tujuan_id',)
                            ->relationship('Tujuan', 'nama')
                            ->required()
                            ->placeholder('Pilih Negara Tujuan')
                            ->label('Negara Tujuan'),
                            Select::make('tunggu_id')
                            ->relationship('Tunggu', 'nama')
                                ->required()
                                ->placeholder('Pilih Status Tunggu')
                                ->label('Status Tunggu'),
                        Select::make('pendaftaran_id',)
                            ->relationship('Pendaftaran', 'nama')
                            ->getOptionLabelFromRecordUsing(fn(Pendaftaran $record) => "{$record->nama}")
                            ->label('Nama')
                            ->searchable()
                            ->disabled(),
                        Select::make('pendaftaran_id',)
                            ->relationship('Pendaftaran', 'nomor_ktp')
                            ->getOptionLabelFromRecordUsing(fn(Pendaftaran $record) => "{$record->nomor_ktp}")
                            ->label('E-KTP')
                            ->disabled(),
                    ])->columns(5),

                Section::make('SIAP KERJA / ID BP2MI')
                    ->description('Silahkan Input Akun SiapKerja')
                    ->icon('heroicon-o-briefcase')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                Fieldset::make('PRA BPJS DAN UJK')
                                    ->schema([
                                        DatePicker::make('tanggal_pra_bpjs')->label('Tanggal PRA BPJS')->placeholder('Pilih Tanggal')->native(false)->displayFormat('d/m/Y'),
                                        DatePicker::make('tanggal_ujk')->label('Tanggal UJK')->placeholder('Pilih Tanggal')->native(false)->displayFormat('d/m/Y'),

                                    ]),
                                DatePicker::make('tglsiapkerja')
                                    ->label('Tanggal SiapKerja')
                                    ->placeholder('Pilih Tanggal')->native(false)->displayFormat('d/m/Y'),
                                TextInput::make('email_siapkerja')
                                    ->label('Email  Akun SiapKerja')
                                    ->placeholder('Contoh. mario@gmail.com')
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255),
                                TextInput::make('password_siapkerja')
                                    ->label('Password Akun SiapKerja')
                                    ->placeholder('Password Akun SiapKerja')
                                    ->maxLength(255),
                                DatePicker::make('tgl_bp2mi')
                                    ->label('Tanggal ID BP2MI')
                                    ->placeholder('Pilih Tanggal')->native(false)->displayFormat('d/m/Y'),
                                TextInput::make('no_id_pmi')
                                    ->placeholder('Masukan NO ID CPMI')
                                    ->label('ID SISKO BP2MI'),
                                FileUpload::make('file_pp')->disk('public')->label('Perjanjian Penempatan')
                                    ->directory('datapmi/file_pp')
                                    ->loadingIndicatorPosition('right')
                                    ->removeUploadedFileButtonPosition('right')
                                    ->uploadButtonPosition('left')
                                    ->uploadProgressIndicatorPosition('left')
                                    ->openable()
                                    ->previewable()
                                    ->downloadable(),



                            ]),
                    ])->columns(4)->collapsed(),
                Section::make('INPUT PROSES')
                    ->description('Silahkan Update Proses CPMI')
                    ->icon('heroicon-o-arrow-path-rounded-square')
                    ->schema([
                        Fieldset::make('')
                            ->schema([
                                DatePicker::make('tanggal_medical_full')->label('TANGGAL MEDICAL FULL (2)')->placeholder('Pilih Tanggal')->native(false)->displayFormat('d/m/Y'),
                                FileUpload::make('file_medical_full')->disk('public')->label('Pilih File')
                                    ->directory('datapmi/file_pp')
                                    ->loadingIndicatorPosition('right')
                                    ->removeUploadedFileButtonPosition('right')
                                    ->uploadButtonPosition('left')
                                    ->uploadProgressIndicatorPosition('left')
                                    ->openable()
                                    ->previewable()
                                    ->downloadable(),
                            ])->columns(2),
                        Fieldset::make('')
                            ->schema([
                                DatePicker::make('tanggal_ec')->label('TANGGAL EC/KONTRAK (3)')->placeholder('Pilih Tanggal')->native(false)->displayFormat('d/m/Y'),
                                FileUpload::make('file_ec')->disk('public')->label('Pilih File')
                                    ->directory('datapmi/file_pp')
                                    ->loadingIndicatorPosition('right')
                                    ->removeUploadedFileButtonPosition('right')
                                    ->uploadButtonPosition('left')
                                    ->uploadProgressIndicatorPosition('left')
                                    ->openable()
                                    ->previewable()
                                    ->downloadable(),
                            ])->columns(2),
                        Fieldset::make('')
                            ->schema([
                                DatePicker::make('tanggal_visa')->label('TANGGAL VISA (4)')->placeholder('Pilih Tanggal')->native(false)->displayFormat('d/m/Y'),
                                FileUpload::make('file_visa')->disk('public')->label('Pilih File')
                                    ->directory('datapmi/file_pp')
                                    ->loadingIndicatorPosition('right')
                                    ->removeUploadedFileButtonPosition('right')
                                    ->uploadButtonPosition('left')
                                    ->uploadProgressIndicatorPosition('left')
                                    ->openable()
                                    ->previewable()
                                    ->downloadable(),
                            ])->columns(2),
                        Fieldset::make('')
                            ->schema([
                                DatePicker::make('tanggal_bpjs_purna')->label('TANGGAL BPJS PURNA (5)')->placeholder('Pilih Tanggal')->native(false)->displayFormat('d/m/Y'),
                                FileUpload::make('file_bpjs_purna')->disk('public')->label('Pilih File')
                                    ->directory('datapmi/file_pp')
                                    ->loadingIndicatorPosition('right')
                                    ->removeUploadedFileButtonPosition('right')
                                    ->uploadButtonPosition('left')
                                    ->uploadProgressIndicatorPosition('left')
                                    ->openable()
                                    ->previewable()
                                    ->downloadable(),
                            ])->columns(2),
                        Fieldset::make('')
                            ->schema([
                                DatePicker::make('tanggal_teto')->label('TANGGAL TETO (TAIWAN) (6)')->placeholder('Pilih Tanggal')->native(false)->displayFormat('d/m/Y'),
                                FileUpload::make('file_teto')->disk('public')->label('Pilih File')
                                    ->directory('datapmi/file_pp')
                                    ->loadingIndicatorPosition('right')
                                    ->removeUploadedFileButtonPosition('right')
                                    ->uploadButtonPosition('left')
                                    ->uploadProgressIndicatorPosition('left')
                                    ->openable()
                                    ->previewable()
                                    ->downloadable(),
                            ])->columns(2),
                        Fieldset::make('')
                            ->schema([
                                DatePicker::make('tanggal_pap')->label('TANGGAL PAP BP2MI (7)')->placeholder('Pilih Tanggal')->native(false)->displayFormat('d/m/Y'),
                                FileUpload::make('file_pap')->disk('public')->label('Pilih File')
                                    ->directory('datapmi/file_pp')
                                    ->loadingIndicatorPosition('right')
                                    ->removeUploadedFileButtonPosition('right')
                                    ->uploadButtonPosition('left')
                                    ->uploadProgressIndicatorPosition('left')
                                    ->openable()
                                    ->previewable()
                                    ->downloadable(),
                            ])->columns(2),
                        Fieldset::make('')
                            ->schema([
                                DatePicker::make('tanggal_penerbangan')->label('TANGGAL PENERBANGAN (8)')->placeholder('Pilih Tanggal')->native(false)->displayFormat('d/m/Y'),
                                FileUpload::make('file_penerbangan')->disk('public')->label('Pilih File')
                                    ->directory('datapmi/file_pp')
                                    ->loadingIndicatorPosition('right')
                                    ->removeUploadedFileButtonPosition('right')
                                    ->uploadButtonPosition('left')
                                    ->uploadProgressIndicatorPosition('left')
                                    ->openable()
                                    ->previewable()
                                    ->downloadable(),
                            ])->columns(2),
                        Fieldset::make('')
                            ->schema([
                                DatePicker::make('tanggal_in_toyo')->label('TANGGAL INVOICE TOYO (9)')->placeholder('Pilih Tanggal')->native(false)->displayFormat('d/m/Y'),
                                FileUpload::make('file_in_toyo')->disk('public')->label('Pilih File')
                                    ->directory('datapmi/file_pp')
                                    ->loadingIndicatorPosition('right')
                                    ->removeUploadedFileButtonPosition('right')
                                    ->uploadButtonPosition('left')
                                    ->uploadProgressIndicatorPosition('left')
                                    ->openable()
                                    ->previewable()
                                    ->downloadable(),
                            ])->columns(2),
                        Fieldset::make('')
                            ->schema([
                                DatePicker::make('tanggal_in_agency')->label('TANGGAL INVOICE AGENCY (10)')->placeholder('Pilih Tanggal')->native(false)->displayFormat('d/m/Y'),
                                FileUpload::make('file_in_agency')->disk('public')->label('Pilih File')
                                    ->directory('datapmi/file_pp')
                                    ->loadingIndicatorPosition('right')
                                    ->removeUploadedFileButtonPosition('right')
                                    ->uploadButtonPosition('left')
                                    ->uploadProgressIndicatorPosition('left')
                                    ->openable()
                                    ->previewable()
                                    ->downloadable(),
                            ])->columns(2),
                    ])->columns(2)->collapsed(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('PROGRESS')
                    ->label('PROGRESS')
                    ->getStateUsing(function ($record) {
                        if ($record->status_id == 3) {
                            return '100%';
                        }

                        if (!in_array($record->status_id, [1, 2])) {
                            return '0%';
                        }

                        $fields = [
                            'tanggal_pra_bpjs',
                            'tanggal_ujk',
                            'tglsiapkerja',
                            'tgl_bp2mi',
                            'tanggal_medical_full',
                            'tanggal_ec',
                            'tanggal_visa',
                            'tanggal_bpjs_purna',
                            'tanggal_pap',
                            'tanggal_penerbangan',
                        ];

                        if ($record->pendaftaran) {
                            $fields[] = 'pendaftaran.tanggal_pra_medical';
                            $fields[] = 'pendaftaran.data_lengkap';
                        }

                        $total = count($fields);

                        $filled = collect($fields)
                            ->reduce(function ($count, $field) use ($record) {
                                if (str_contains($field, '.')) {
                                    [$relation, $fieldName] = explode('.', $field);
                                    $value = $record->$relation->$fieldName ?? null;
                                    if ($fieldName === 'data_lengkap') {
                                        return $count + ($value === true ? 1 : 0);
                                    }
                                    return $count + (!is_null($value) ? 1 : 0);
                                }
                                return $count + (!is_null($record->$field) ? 1 : 0);
                            }, 0);

                        $progress = $total > 0 ? ($filled / $total) * 100 : 0;
                        return round($progress) . '%';
                    })
                    ->badge()
                    ->color(fn (?string $state): string => match (true) {
                        (int)$state >= 100 => 'success',
                        (int)$state >= 50 => 'info',
                        (int)$state > 0 => 'warning',
                        default => 'gray',
                    }),
                TextColumn::make('Status.nama')->label('STATUS')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'BARU' => 'warning',
                        'ON PROSES' => 'info',
                        'TERBANG' => 'success',
                        'PENDING' => 'danger',
                        'UNFIT' => 'gray',
                        'MD' => 'gray',
                        default => 'secondary',
                    })
                    ->icon(fn(string $state): string => match ($state) {
                        'BARU' => 'heroicon-o-bell',
                        'ON PROSES' => 'heroicon-o-arrow-path-rounded-square',
                        'TERBANG' => 'heroicon-o-paper-airplane',
                        'PENDING' => 'heroicon-o-clock',
                        'UNFIT' => 'heroicon-o-beaker',
                        'MD' => 'heroicon-o-x-circle',
                    })
                    ->copyable()
                    ->copyMessage('Salin Berhasil')
                    ->copyMessageDuration(1500),
                TextColumn::make('pendaftaran.nama') // Pastikan relasi ke Pendaftaran ada
                    ->label('CPMI')
                    ->weight('bold')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Salin Berhasil')
                    ->copyMessageDuration(1500)
                    ->description(
                        fn(ProsesCpmi $record): string =>
                        $record->pendaftaran->nomor_ktp
                            ? "{$record->pendaftaran->nomor_ktp} - " . ($record->pendaftaran->user ? $record->pendaftaran->user->email : 'Akun Tidak Terhubung')
                            : 'No KTP available'
                    ),
                TextColumn::make('Pendaftaran.nomor_ktp')->label('E-KTP')->color('primary')
                    ->copyable()
                    ->searchable()
                    ->copyMessage('Salin Berhasil')
                    ->copyMessageDuration(1500)
                    ->toggleable(isToggledHiddenByDefault: true),
                // ->limit(10),
                TextColumn::make('Pendaftaran.kantor.nama')->label('KANTOR')->color('success')
                    ->copyable()
                    ->copyMessage('Salin Berhasil')
                    ->copyMessageDuration(1500)->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('Tujuan.nama')->label('TUJUAN')->color('success')
                    ->copyable()
                    ->copyMessage('Salin Berhasil')
                    ->copyMessageDuration(1500),
                TextColumn::make('Pendaftaran.tanggal_pra_medical')->label('PRA MEDICAL')
                    ->copyable()
                    ->sortable()
                    ->copyMessage('Salin Berhasil')
                    ->copyMessageDuration(1500),
                TextColumn::make('Pelatihan.nama')->label('LPKS/BLK')->color('success')
                    ->copyable()
                    ->copyMessage('Salin Berhasil')
                    ->copyMessageDuration(1500),
                TextColumn::make('tgl_bp2mi')->label('TGL ID')
                    ->copyable()
                    ->sortable()
                    ->copyMessage('Salin Berhasil')
                    ->copyMessageDuration(1500),
                TextColumn::make('Pendaftaran.created_at')->label('LAMA PROSES')->color('warning')
                    ->since()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('Salin Berhasil')
                    ->copyMessageDuration(1500)->toggleable(isToggledHiddenByDefault: false),

            ])->defaultSort('updated_at', 'desc')
            ->filters([
                SelectFilter::make('Tujuan')
                    ->relationship('Tujuan', 'nama')
                    ->label('TUJUAN')
                    ->placeholder('SEMUA'),
                SelectFilter::make('kantor_id')
                    ->relationship('Pendaftaran.Kantor', 'nama')
                    ->label('KANTOR')
                    ->placeholder('SEMUA'),
                SelectFilter::make('Status')
                    ->relationship('Status', 'nama')
                    ->label('STATUS')
                    ->multiple()
                    ->optionsLimit(6)
                    ->preload()
                    ->placeholder('Pilih Satu Atau Beberapa'),
            ], layout: FiltersLayout::Modal)
            ->filtersTriggerAction(
                fn(Action $action) => $action
                    ->button()
                    ->label('FILTER'),
            )->filtersFormColumns(3)
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make()
                        ->label('Ubah')
                        ->color('primary'),
                    Tables\Actions\DeleteAction::make(),

                ])
            ])
            ->actionsPosition(
    Tables\Enums\ActionsPosition::BeforeColumns
)
            ->headerActions([
                ExportAction::make()
                    ->exporter(ProsesCpmiExporter::class)
                    ->columnMapping(true)
                    ->label('Unduh Data Proses CPMI')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->formats([
                        ExportFormat::Xlsx,
                    ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ExportAction::make()
                        ->exporter(ProsesCpmiExporter::class)
                        ->columnMapping(true)
                        ->label('Unduh Data Proses CPMI')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->formats([
                            ExportFormat::Xlsx,
                        ]),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            AuditsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProsesCpmis::route('/'),
            'create' => Pages\CreateProsesCpmi::route('/create'),
            'edit' => Pages\EditProsesCpmi::route('/{record}/edit'),
            'view' => Pages\ViewProsesCpmi::route('/{record}'),  // Tambahkan ini

        ];
    }
}
