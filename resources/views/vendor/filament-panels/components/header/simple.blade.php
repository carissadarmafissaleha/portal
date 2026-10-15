@props([
    'heading' => null,
    'logo' => true,
    'subheading' => null,
])

<header class="fi-simple-header flex flex-col items-center mb-6">
    @if ($logo)
        <div class="mb-4 transition-transform duration-200 hover:scale-105">
            <x-filament-panels::logo />
        </div>
    @endif

    @if (filled($heading))
        <h1
            class="fi-simple-header-heading text-center text-2xl sm:text-3xl font-bold tracking-tight text-zinc-50"
        >
            {{ $heading }}
        </h1>
    @endif

    @if (filled($subheading))
        <p
            class="fi-simple-header-subheading mt-2 text-center text-sm text-zinc-400 max-w-sm"
        >
            {{ $subheading }}
        </p>
    @endif
</header>
