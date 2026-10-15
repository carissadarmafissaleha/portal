<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - {{ config('app.name', 'Nusa Portal') }}</title>
    <link rel="icon" href="{{ asset('images/icon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['JetBrains Mono', 'monospace', 'sans-serif'],
                        mono: ['JetBrains Mono', 'monospace'],
                    },
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'JetBrains Mono', monospace, sans-serif;
            background-color: #09090b;
            color: #fafafa;
        }
        .tabular-mono {
            font-family: 'JetBrains Mono', monospace;
            font-feature-settings: "tnum" 1;
        }
    </style>
</head>
<body class="min-h-screen bg-zinc-950 text-zinc-100 flex items-center justify-center p-4 relative overflow-hidden antialiased selection:bg-zinc-800 selection:text-white">

    {{-- Subtle modern shadcn background grid pattern --}}
    <div class="absolute inset-0 bg-[linear-gradient(to_right,#27272a20_1px,transparent_1px),linear-gradient(to_bottom,#27272a20_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_50%,#000_70%,transparent_100%)] pointer-events-none"></div>

    {{-- Ambient radial background glow --}}
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-zinc-800/30 rounded-full blur-3xl pointer-events-none"></div>

    {{-- Floating shadcn/ui Card Container --}}
    <main class="relative z-10 w-full max-w-lg rounded-2xl border border-zinc-800/90 bg-zinc-900/80 p-8 sm:p-10 text-center shadow-2xl backdrop-blur-xl transition-all">
        
        {{-- Status Pill Badge --}}
        <div class="inline-flex items-center gap-2 rounded-full border border-zinc-800 bg-zinc-900/90 px-3.5 py-1 text-xs font-mono font-medium text-zinc-300 mb-6 shadow-xs">
            <span class="h-2 w-2 rounded-full @yield('badge-color', 'bg-rose-500') animate-pulse"></span>
            <span>ERROR STATUS: @yield('code')</span>
        </div>

        {{-- Big Monospace Number --}}
        <div class="text-7xl sm:text-8xl font-black font-mono tracking-tighter text-transparent bg-clip-text bg-gradient-to-b from-zinc-100 via-zinc-200 to-zinc-600 mb-3 select-none">
            @yield('code')
        </div>

        {{-- Title Heading --}}
        <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-zinc-100 mb-2">
            @yield('message-title')
        </h1>

        {{-- Description Text --}}
        <p class="text-sm text-zinc-400 max-w-sm mx-auto mb-8 leading-relaxed">
            @yield('message-desc')
        </p>

        {{-- Action Buttons in shadcn button variants --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 w-full">
            <a href="{{ url('/admin') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 rounded-lg bg-zinc-100 hover:bg-zinc-200 text-zinc-950 font-semibold px-5 py-2.5 text-sm shadow-xs transition-all active:scale-95">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                <span>Dashboard Admin</span>
            </a>

            <button onclick="window.history.back()" type="button" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 rounded-lg border border-zinc-800 bg-zinc-900 hover:bg-zinc-800 text-zinc-200 font-medium px-5 py-2.5 text-sm shadow-xs transition-all active:scale-95">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
                <span>Kembali</span>
            </button>
        </div>

        {{-- Secondary Action / Footer info --}}
        <div class="mt-8 pt-6 border-t border-zinc-800/80 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-zinc-500">
            <a href="{{ url('/') }}" class="hover:text-zinc-300 transition-colors inline-flex items-center gap-1">
                <span>Halaman Depan (Website)</span>
                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
                </svg>
            </a>

            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="hover:text-rose-400 text-zinc-500 transition-colors inline-flex items-center gap-1">
                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                    </svg>
                    <span>Keluar Akun (Logout)</span>
                </button>
            </form>
        </div>
    </main>
</body>
</html>
