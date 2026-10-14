<x-filament-panels::page class="fi-dashboard-page">
    @php
        $allWidgets = $this->getVisibleWidgets();
        $isCardWidget = function ($widget) {
            return is_a($widget, \EightyNine\FilamentAdvancedWidget\AdvancedStatsOverviewWidget::class, true)
                || is_a($widget, \Filament\Widgets\StatsOverviewWidget::class, true)
                || str_contains($widget, 'StatusOverview')
                || str_contains($widget, 'Stat');
        };

        $cardWidgets = array_filter($allWidgets, $isCardWidget);
        $otherWidgets = array_filter($allWidgets, fn ($widget) => ! $isCardWidget($widget));

        $widgetData = [
            ...(property_exists($this, 'filters') ? ['filters' => $this->filters] : []),
            ...$this->getWidgetData(),
        ];
    @endphp

    {{-- 1. Filter Periode & Kantor Cabang (Paling Atas) --}}
    @if (method_exists($this, 'filtersForm'))
        <div class="fi-dashboard-filters">
            {{ $this->filtersForm }}
        </div>
    @endif

    {{-- 2. Kartu Metrik Ringkasan (KPI Cards) tepat di bawah Filter --}}
    @if (count($cardWidgets))
        <div class="fi-dashboard-cards">
            <x-filament-widgets::widgets
                :columns="$this->getColumns()"
                :data="$widgetData"
                :widgets="$cardWidgets"
            />
        </div>
    @endif

    {{-- 3. Grafik Analitik & Tren --}}
    @if (count($otherWidgets))
        <div class="fi-dashboard-charts">
            <x-filament-widgets::widgets
                :columns="$this->getColumns()"
                :data="$widgetData"
                :widgets="$otherWidgets"
            />
        </div>
    @endif
</x-filament-panels::page>
