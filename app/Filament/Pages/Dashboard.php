<?php

namespace App\Filament\Pages;

use App\Models\Kantor;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Illuminate\Contracts\View\View;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Actions\Action;
use Filament\Support\Enums\Alignment;

class Dashboard extends \Filament\Pages\Dashboard
{
    use HasPageShield;

    protected function getShieldRedirectPath(): string
    {
        return '/admin/proses'; // Redirect jika user tidak memiliki akses
    }

    protected static ?string $title = 'RINGKASAN';
    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-line';

    public function getSubheading(): ?string
    {
        return 'Ringkasan Operasional Penempatan, Status CPMI Terkini, Dan Analisis Performa.';
    }

    use HasFiltersForm;

    public ?string $startDate = null;
    public ?string $endDate = null;
    public ?string $kantor = null; // Properti untuk filter kantor

    protected function getHeaderActions(): array
    {
        return [
            Action::make('downloadPdf')
                ->label('Unduh Laporan')
                ->icon('heroicon-o-arrow-down-tray')
                ->modalHeading('Ekspor Laporan Periodik')
                ->modalDescription('Silahkan pilih rentang tanggal yang ingin diunduh dalam format PDF.')
                ->modalSubmitActionLabel('Unduh PDF')
                ->modalIcon('heroicon-o-arrow-down-tray')
                ->modalWidth('md')
                ->form([
                    DatePicker::make('startDate')
                        ->label('Tanggal Mulai')
                        ->prefixIcon('heroicon-o-calendar')
                        ->native(false)
                        ->required(),
                    DatePicker::make('endDate')
                        ->label('Tanggal Akhir')
                        ->prefixIcon('heroicon-o-calendar')
                        ->native(false)
                        ->required(),
                ])
                ->action(function (array $data) {
                    $this->redirectRoute('laporan.pdf.download', [
                        'startDate' => $data['startDate'],
                        'endDate' => $data['endDate'],
                        'kantor' => request('kantor'),
                    ]);
                })
                ->color('gray')
                ->modalAlignment(Alignment::Center),
        ];
    }

    public function filtersForm(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Filter Periode & Cabang')
                    ->description('Saring Ringkasan Statistik Dan Grafik Analitik Berdasarkan Rentang Tanggal Dan Kantor.')
                    ->icon('heroicon-o-funnel')
                    ->collapsible()
                    ->compact()
                    ->schema([
                        DatePicker::make('startDate')
                            ->label('Tanggal Mulai')
                            ->placeholder('Pilih tanggal awal')
                            ->prefixIcon('heroicon-o-calendar')
                            ->native(false),
                        DatePicker::make('endDate')
                            ->label('Tanggal Akhir')
                            ->placeholder('Pilih tanggal akhir')
                            ->prefixIcon('heroicon-o-calendar')
                            ->native(false),
                        Select::make('kantor')
                            ->label('Kantor Cabang')
                            ->placeholder('Semua Kantor Cabang')
                            ->prefixIcon('heroicon-o-building-office-2')
                            ->options(Kantor::all()->pluck('nama', 'id'))
                            ->searchable(),
                    ])
                    ->columns([
                        'default' => 1,
                        'sm' => 2,
                        'lg' => 3,
                    ]),
            ]);
    }

    public function getFooter(): ?View
    {
        return view('filament.settings.custom-footer');
    }
}
