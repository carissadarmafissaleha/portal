<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - {{ config('app.name', 'Nusa Portal') }}</title>
    <link rel="icon" href="{{ asset('images/icon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'system-ui', 'sans-serif'],
                        mono: ['JetBrains Mono', 'monospace'],
                    },
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            background-color: #09090b;
            color: #fafafa;
        }
    </style>
</head>
<body class="min-h-screen bg-zinc-950 text-zinc-100 flex items-center justify-center p-4 relative overflow-hidden antialiased selection:bg-zinc-800 selection:text-white">

    <div class="absolute inset-0 bg-[linear-gradient(to_right,#27272a20_1px,transparent_1px),linear-gradient(to_bottom,#27272a20_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_50%,#000_70%,transparent_100%)] pointer-events-none"></div>

    <main class="relative z-10 w-full max-w-lg rounded-2xl border border-zinc-800/90 bg-zinc-900/80 p-8 sm:p-10 text-center shadow-2xl backdrop-blur-xl">
        <div class="inline-flex items-center gap-2 rounded-full border border-zinc-800 bg-zinc-900 px-3.5 py-1 text-xs font-mono font-medium text-zinc-300 mb-6 shadow-xs">
            <span class="h-2 w-2 rounded-full bg-rose-500 animate-pulse"></span>
            <span>ERROR STATUS: @yield('code')</span>
        </div>

        <div class="text-7xl sm:text-8xl font-black font-mono tracking-tighter text-transparent bg-clip-text bg-gradient-to-b from-zinc-100 to-zinc-600 mb-3 select-none">
            @yield('code')
        </div>

        <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-zinc-100 mb-2">
            @yield('title')
        </h1>

        <p class="text-sm text-zinc-400 max-w-sm mx-auto mb-8 leading-relaxed">
            @yield('message')
        </p>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 w-full">
            <a href="{{ url('/admin') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 rounded-lg bg-zinc-100 hover:bg-zinc-200 text-zinc-950 font-semibold px-5 py-2.5 text-sm shadow-xs transition-all active:scale-95">
                Dashboard Admin
            </a>

            <button onclick="window.history.back()" type="button" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 rounded-lg border border-zinc-800 bg-zinc-900 hover:bg-zinc-800 text-zinc-200 font-medium px-5 py-2.5 text-sm shadow-xs transition-all active:scale-95">
                Kembali
            </button>
        </div>
    </main>
</body>
</html>
