@props([
    'label' => null,
    'labelHidden' => false,
])

<fieldset
    {{
        $attributes->class([
            'fi-fieldset rounded-xl border border-zinc-200/80 bg-white/70 backdrop-blur-xs p-5 shadow-xs dark:border-zinc-800 dark:bg-zinc-950/70 transition-all duration-200',
        ])
    }}
>
    @if (filled($label))
        <legend
            @class([
                '-ms-2 px-2.5 py-0.5 text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400 bg-white dark:bg-zinc-950 rounded-md border border-zinc-200/80 dark:border-zinc-800 shadow-2xs',
                'sr-only' => $labelHidden,
            ])
        >
            {{ $label }}
        </legend>
    @endif

    {{ $slot }}
</fieldset>
