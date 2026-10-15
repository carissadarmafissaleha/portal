@php
    use Filament\Support\Enums\MaxWidth;
@endphp

<x-filament-panels::layout.base :livewire="$livewire">
    @props([
        'after' => null,
        'heading' => null,
        'subheading' => null,
    ])

    <div class="fi-simple-layout relative flex min-h-screen flex-col items-center justify-center p-4 overflow-hidden bg-zinc-950 text-zinc-50 selection:bg-zinc-800 selection:text-white">
        {{-- Subtle modern shadcn background grid pattern --}}
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#27272a20_1px,transparent_1px),linear-gradient(to_bottom,#27272a20_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_50%,#000_70%,transparent_100%)] pointer-events-none"></div>

        {{-- Ambient radial background glow --}}
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[28rem] h-[28rem] bg-zinc-800/30 rounded-full blur-3xl pointer-events-none"></div>

        @if (($hasTopbar ?? true) && filament()->auth()->check())
            <div
                class="absolute end-0 top-0 flex h-16 items-center gap-x-4 pe-4 md:pe-6 lg:pe-8 z-20"
            >
                @if (filament()->hasDatabaseNotifications())
                    @livewire(Filament\Livewire\DatabaseNotifications::class, ['lazy' => true])
                @endif

                <x-filament-panels::user-menu />
            </div>
        @endif

        <div
            class="fi-simple-main-ctn relative z-10 flex w-full flex-grow items-center justify-center py-10"
        >
            <main
                @class([
                    'fi-simple-main w-full rounded-2xl border border-zinc-800/90 bg-zinc-900/80 p-8 shadow-2xl backdrop-blur-xl sm:p-10',
                    match ($maxWidth ?? null) {
                        MaxWidth::ExtraSmall, 'xs' => 'sm:max-w-xs',
                        MaxWidth::Small, 'sm' => 'sm:max-w-sm',
                        MaxWidth::Medium, 'md' => 'sm:max-w-md',
                        MaxWidth::ExtraLarge, 'xl' => 'sm:max-w-xl',
                        MaxWidth::TwoExtraLarge, '2xl' => 'sm:max-w-2xl',
                        MaxWidth::ThreeExtraLarge, '3xl' => 'sm:max-w-3xl',
                        MaxWidth::FourExtraLarge, '4xl' => 'sm:max-w-4xl',
                        MaxWidth::FiveExtraLarge, '5xl' => 'sm:max-w-5xl',
                        MaxWidth::SixExtraLarge, '6xl' => 'sm:max-w-6xl',
                        MaxWidth::SevenExtraLarge, '7xl' => 'sm:max-w-7xl',
                        default => 'sm:max-w-md',
                    },
                ])
            >
                {{ $slot }}

                <p class="mt-8 text-center text-xs text-zinc-500 leading-relaxed border-t border-zinc-800/60 pt-5">
                    Dengan melanjutkan, Anda menyetujui ketentuan akses sistem dan kebijakan privasi {{ config('app.name', 'Nusa Portal') }}.
                </p>
            </main>
        </div>

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::FOOTER, scopes: $livewire->getRenderHookScopes()) }}
    </div>
</x-filament-panels::layout.base>
