<?php

namespace App\Filament\Widgets;

use App\Models\ProsesCpmi;
use EightyNine\FilamentAdvancedWidget\AdvancedStatsOverviewWidget as BaseWidget;
use EightyNine\FilamentAdvancedWidget\AdvancedStatsOverviewWidget\Stat as AdvancedStatsOverviewWidgetStat;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class StatusOverviewWidget extends BaseWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = 1;
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        // Mengambil filter tanggal dan kantor dari halaman
        $start = $this->filters['startDate'] ?? null;
        $end = $this->filters['endDate'] ?? null;
        $kantor = $this->filters['kantor'] ?? null;

        $baruCount = ProsesCpmi::when($start, fn ($query) => $query->whereDate('created_at', '>=', $start))
            ->when($end, fn ($query) => $query->whereDate('created_at', '<=', $end))
            ->when($kantor, fn ($query) => $query->whereHas('pendaftaran', function ($query) use ($kantor) {
                $query->where('kantor_id', $kantor);
            }))
            ->where('status_id', 1)
            ->count();

        $prosesCount = ProsesCpmi::when($start, fn ($query) => $query->whereDate('created_at', '>=', $start))
            ->when($end, fn ($query) => $query->whereDate('created_at', '<=', $end))
            ->when($kantor, fn ($query) => $query->whereHas('pendaftaran', function ($query) use ($kantor) {
                $query->where('kantor_id', $kantor);
            }))
            ->where('status_id', 2)
            ->count();

        $terbangCount = ProsesCpmi::when($start, fn ($query) => $query->whereDate('created_at', '>=', $start))
            ->when($end, fn ($query) => $query->whereDate('created_at', '<=', $end))
            ->when($kantor, fn ($query) => $query->whereHas('pendaftaran', function ($query) use ($kantor) {
                $query->where('kantor_id', $kantor);
            }))
            ->where('status_id', 3)
            ->count();

        $pendingCount = ProsesCpmi::when($start, fn ($query) => $query->whereDate('created_at', '>=', $start))
            ->when($end, fn ($query) => $query->whereDate('created_at', '<=', $end))
            ->when($kantor, fn ($query) => $query->whereHas('pendaftaran', function ($query) use ($kantor) {
                $query->where('kantor_id', $kantor);
            }))
            ->where('status_id', 4)
            ->count();

        $unfitCount = ProsesCpmi::when($start, fn ($query) => $query->whereDate('created_at', '>=', $start))
            ->when($end, fn ($query) => $query->whereDate('created_at', '<=', $end))
            ->when($kantor, fn ($query) => $query->whereHas('pendaftaran', function ($query) use ($kantor) {
                $query->where('kantor_id', $kantor);
            }))
            ->where('status_id', 5)
            ->count();

        $mdCount = ProsesCpmi::when($start, fn ($query) => $query->whereDate('created_at', '>=', $start))
            ->when($end, fn ($query) => $query->whereDate('created_at', '<=', $end))
            ->when($kantor, fn ($query) => $query->whereHas('pendaftaran', function ($query) use ($kantor) {
                $query->where('kantor_id', $kantor);
            }))
            ->where('status_id', 6)
            ->count();

        $totalActive = max(1, $baruCount + $prosesCount + $terbangCount + $pendingCount + $unfitCount + $mdCount);

        return [
            AdvancedStatsOverviewWidgetStat::make('BARU', $baruCount)
                ->description('Total CPMI Baru')
                ->icon('heroicon-o-user-plus')
                ->progress(round(($baruCount / $totalActive) * 100))
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'onclick' => "window.open('/admin/proses-cpmis?tableFilters[Status][values][0]=1')",
                ]),

            AdvancedStatsOverviewWidgetStat::make('PROSES', $prosesCount)
                ->description('Total CPMI On Proses')
                ->icon('heroicon-o-arrow-path')
                ->progress(round(($prosesCount / $totalActive) * 100))
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'onclick' => "window.open('/admin/proses-cpmis?tableFilters[Status][values][0]=2')",
                ]),

            AdvancedStatsOverviewWidgetStat::make('TERBANG', $terbangCount)
                ->description('Total CPMI Terbang')
                ->icon('heroicon-o-paper-airplane')
                ->progress(round(($terbangCount / $totalActive) * 100))
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'onclick' => "window.open('/admin/proses-cpmis?tableFilters[Status][values][0]=3')",
                ]),

            AdvancedStatsOverviewWidgetStat::make('PENDING', $pendingCount)
                ->description('Total CPMI Pending')
                ->icon('heroicon-o-clock')
                ->progress(round(($pendingCount / $totalActive) * 100))
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'onclick' => "window.open('/admin/proses-cpmis?tableFilters[Status][values][0]=4')",
                ]),

            AdvancedStatsOverviewWidgetStat::make('UNFIT', $unfitCount)
                ->description('Total CPMI UNFIT')
                ->icon('heroicon-o-beaker')
                ->progress(round(($unfitCount / $totalActive) * 100))
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'onclick' => "window.open('/admin/proses-cpmis?tableFilters[Status][values][0]=5')",
                ]),

            AdvancedStatsOverviewWidgetStat::make('MD', $mdCount)
                ->description('Total CPMI Mengundurkan Diri')
                ->icon('heroicon-o-user-minus')
                ->progress(round(($mdCount / $totalActive) * 100))
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'onclick' => "window.open('/admin/proses-cpmis?tableFilters[Status][values][0]=6')",
                ]),
        ];
    }
}
