<footer class="mt-8 border-t border-zinc-200/80 pt-6 pb-4 text-xs text-zinc-500 dark:border-zinc-800 dark:text-zinc-400">
    <div class="flex flex-col sm:flex-row items-center justify-between gap-3 px-2">
        <div class="flex items-center gap-1.5 font-medium">
            <span class="inline-block h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
            <span>&copy; 2022 - {{ date('Y') }}</span>
            <a href="{{ env('APP_URL', '/') }}" target="_blank" class="font-semibold text-zinc-800 hover:text-zinc-950 dark:text-zinc-200 dark:hover:text-white transition-colors">
                {{ env('COMPANY_NAME', config('app.name')) }}
            </a>
            <span>&bull; All Rights Reserved</span>
        </div>

        <div class="flex items-center gap-2 text-[11px]">
            <span class="rounded-md border border-zinc-200 bg-zinc-50 px-2 py-0.5 dark:border-zinc-800 dark:bg-zinc-900 font-mono">
                v{{ config('app.version', '3.2') }}
            </span>
            <span>{{ env('APP_NAME') }}</span>
            @if(env('APP_MAKER'))
                <span class="text-zinc-400 dark:text-zinc-600">by</span>
                <a href="{{ env('APP_MAKER_LINK', '#') }}" target="_blank" class="font-medium text-zinc-700 hover:text-zinc-950 dark:text-zinc-300 dark:hover:text-white transition-colors">
                    {{ env('APP_MAKER') }}
                </a>
            @endif
        </div>
    </div>
</footer>
