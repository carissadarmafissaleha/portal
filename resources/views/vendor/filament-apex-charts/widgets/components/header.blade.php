@props(['heading', 'subheading', 'filters', 'indicatorsCount', 'width', 'filterFormAccessible'])
<div class="filament-apex-charts-header mb-4">
    @if ($heading || $subheading || $filters || $filterFormAccessible)
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 border-b border-zinc-100 pb-3 dark:border-zinc-800/80">
            <div>
                @if ($heading)
                    <div class="filament-apex-charts-heading text-sm font-semibold tracking-tight text-zinc-900 dark:text-zinc-100 flex items-center gap-2">
                        <span class="inline-block h-2 w-2 rounded-full bg-zinc-900 dark:bg-zinc-100"></span>
                        {!! $heading !!}
                    </div>
                @endif

                @if ($subheading)
                    <div class="filament-apex-charts-subheading text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">
                        {!! $subheading !!}
                    </div>
                @endif
            </div>

            @if ($filters)
                <div>
                    <select wire:model="filter" class="apex-charts-single-filter h-8 rounded-md border border-zinc-200 bg-white px-2.5 py-1 text-xs text-zinc-800 shadow-xs outline-none transition focus:border-zinc-950 focus:ring-1 focus:ring-zinc-950 dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-200 dark:focus:border-zinc-300 dark:focus:ring-zinc-300">
                        @foreach ($filters as $value => $label)
                            <option value="{{ $value }}">
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif

            @if ($filterFormAccessible)
                <div>
                    <x-filament-apex-charts::filter-form :$indicatorsCount :$width>
                        {{ $filterForm }}
                    </x-filament-apex-charts::filter-form>
                </div>
            @endif
        </div>
    @endif
</div>
