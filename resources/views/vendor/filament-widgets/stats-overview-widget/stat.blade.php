@php
    use Filament\Support\Enums\IconPosition;
    use Filament\Support\Facades\FilamentView;

    $url = $getUrl();
    $tag = $url ? 'a' : 'div';
    $dataChecksum = $generateDataChecksum();
    $label = (string) $getLabel();
    $labelNormalized = strtoupper(trim($label));
    $icon = $getIcon();
    $description = $getDescription();
    $descriptionIcon = $getDescriptionIcon();
    $descriptionIconPosition = $getDescriptionIconPosition();
    $chart = $getChart();
    $chartColor = $getChartColor() ?? 'gray';

    $accentConfig = match ($labelNormalized) {
        'BARU' => [
            'iconBadge' => 'bg-sky-50 text-sky-600 border-sky-200/80 dark:bg-sky-950/40 dark:text-sky-400 dark:border-sky-900/50',
            'hoverBorder' => 'hover:border-sky-300 dark:hover:border-sky-700',
            'indicatorDot' => 'bg-sky-500',
        ],
        'PROSES' => [
            'iconBadge' => 'bg-amber-50 text-amber-600 border-amber-200/80 dark:bg-amber-950/40 dark:text-amber-400 dark:border-amber-900/50',
            'hoverBorder' => 'hover:border-amber-300 dark:hover:border-amber-700',
            'indicatorDot' => 'bg-amber-500',
        ],
        'TERBANG' => [
            'iconBadge' => 'bg-emerald-50 text-emerald-600 border-emerald-200/80 dark:bg-emerald-950/40 dark:text-emerald-400 dark:border-emerald-900/50',
            'hoverBorder' => 'hover:border-emerald-300 dark:hover:border-emerald-700',
            'indicatorDot' => 'bg-emerald-500',
        ],
        'PENDING' => [
            'iconBadge' => 'bg-indigo-50 text-indigo-600 border-indigo-200/80 dark:bg-indigo-950/40 dark:text-indigo-400 dark:border-indigo-900/50',
            'hoverBorder' => 'hover:border-indigo-300 dark:hover:border-indigo-700',
            'indicatorDot' => 'bg-indigo-500',
        ],
        'UNFIT' => [
            'iconBadge' => 'bg-rose-50 text-rose-600 border-rose-200/80 dark:bg-rose-950/40 dark:text-rose-400 dark:border-rose-900/50',
            'hoverBorder' => 'hover:border-rose-300 dark:hover:border-rose-700',
            'indicatorDot' => 'bg-rose-500',
        ],
        'MD' => [
            'iconBadge' => 'bg-zinc-100 text-zinc-600 border-zinc-200 dark:bg-zinc-900 dark:text-zinc-400 dark:border-zinc-800',
            'hoverBorder' => 'hover:border-zinc-400 dark:hover:border-zinc-700',
            'indicatorDot' => 'bg-zinc-500',
        ],
        default => [
            'iconBadge' => 'bg-zinc-100 text-zinc-700 border-zinc-200/80 dark:bg-zinc-800/60 dark:text-zinc-300 dark:border-zinc-700',
            'hoverBorder' => 'hover:border-zinc-300 dark:hover:border-zinc-700',
            'indicatorDot' => 'bg-zinc-400',
        ],
    };
@endphp

<{!! $tag !!}
    @if ($url) {{ \Filament\Support\generate_href_html($url, $shouldOpenUrlInNewTab()) }} @endif
    {{ $getExtraAttributeBag()->class([
        'fi-wi-stats-overview-stat group relative flex flex-col justify-between overflow-hidden rounded-xl border border-zinc-200/80 bg-white p-5 text-zinc-950 shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-50 ' . $accentConfig['hoverBorder'],
    ]) }}
>
    {{-- Card Header: Metric Label and Icon --}}
    <div class="flex items-center justify-between gap-3">
        <div class="flex items-center gap-2">
            <span class="h-1.5 w-1.5 rounded-full {{ $accentConfig['indicatorDot'] }}"></span>
            <span class="text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">
                {{ $label }}
            </span>
        </div>

        @if ($icon)
            <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg border text-xs shadow-xs transition-transform duration-200 group-hover:scale-110 {{ $accentConfig['iconBadge'] }}">
                <x-filament::icon :icon="$icon" class="h-4 w-4" />
            </div>
        @endif
    </div>

    {{-- Card Body: Numeric Metric Value --}}
    <div class="mt-3 flex items-baseline justify-between">
        <div class="text-2xl font-bold tracking-tight font-mono tabular-nums text-zinc-900 dark:text-zinc-50 sm:text-3xl">
            {{ $getValue() }}
        </div>
        <div class="flex items-center gap-0.5 text-[11px] font-medium text-zinc-400 opacity-0 transition-all duration-200 group-hover:opacity-100 group-hover:text-zinc-700 dark:group-hover:text-zinc-300">
            <span>Detail</span>
            <svg class="h-3 w-3 transition-transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
            </svg>
        </div>
    </div>

    {{-- Card Footer: Description Subtext --}}
    @if ($description)
        <div class="mt-2.5 flex items-center gap-1.5 text-xs text-zinc-500 dark:text-zinc-400">
            @if ($descriptionIcon && in_array($descriptionIconPosition, [IconPosition::Before, 'before']))
                <x-filament::icon :icon="$descriptionIcon" class="h-3.5 w-3.5 shrink-0 text-zinc-400 dark:text-zinc-500" />
            @endif

            <span class="truncate">{{ $description }}</span>

            @if ($descriptionIcon && in_array($descriptionIconPosition, [IconPosition::After, 'after']))
                <x-filament::icon :icon="$descriptionIcon" class="h-3.5 w-3.5 shrink-0 text-zinc-400 dark:text-zinc-500" />
            @endif
        </div>
    @endif

    {{-- Optional Mini Chart in Stat --}}
    @if ($chart)
        <div x-data="{ statsOverviewStatChart: function() {} }" class="mt-3 -mx-5 -mb-5 border-t border-zinc-100 pt-1 dark:border-zinc-800/60">
            <div
                @if (FilamentView::hasSpaMode()) ax-load="visible" @else ax-load @endif
                ax-load-src="{{ \Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('stats-overview/stat/chart', 'filament/widgets') }}"
                x-data="statsOverviewStatChart({
                    dataChecksum: @js($dataChecksum),
                    labels: @js(array_keys($chart)),
                    values: @js(array_values($chart)),
                })"
                class="fi-wi-stats-overview-stat-chart overflow-hidden rounded-b-xl"
            >
                <canvas x-ref="canvas" height="40"></canvas>
            </div>
        </div>
    @endif
</{!! $tag !!}>
