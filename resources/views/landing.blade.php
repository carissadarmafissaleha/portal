<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title class="notranslate" translate="no">{{ env('COMPANY_NAME', 'PT. Nusantara Portal Inc.') }} | Portal Resmi Penempatan Pekerja Migran Indonesia</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="Perusahaan Penempatan Pekerja Migran Indonesia (P3MI) resmi, profesional, dan terpercaya. Layanan penempatan kerja ke luar negeri sektor formal dan informal.">
    <meta name="keywords" content="pekerja migran, tenaga kerja luar negeri, P3MI, BP2MI, kemnaker, agency, formal, informal, karir luar negeri, migrant worker, job placement">
    <meta name="author" content="{{ env('COMPANY_NAME', 'PT. Nusantara Portal Inc.') }}">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="{{ env('COMPANY_NAME', 'PT. Nusantara Portal Inc.') }}">
    <meta property="og:description" content="Penyedia tenaga kerja Indonesia berkualitas, terlatih, dan berizin resmi untuk penempatan luar negeri.">
    <meta property="og:image" content="/images/logo.png">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">

    <!-- Favicon -->
    <link rel="icon" href="/images/favicon.svg" type="image/x-icon">

    <!-- Google Fonts: Plus Jakarta Sans & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- Google Material Symbols -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- Tailwind CSS (via Tailwind CDN v3) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb', // Royal Blue Accent
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                            950: '#172554',
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        display: ['Outfit', 'sans-serif'],
                    },
                    boxShadow: {
                        'glow': '0 0 25px -5px rgba(37, 99, 235, 0.4)',
                        'glow-lg': '0 0 40px -10px rgba(37, 99, 235, 0.5)',
                    }
                }
            }
        }
    </script>

    <style>
        /* Modern Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        .dark ::-webkit-scrollbar-track {
            background: #0f172a;
        }
        ::-webkit-scrollbar-thumb {
            background: #2563eb;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #1d4ed8;
        }

        /* Glassmorphism helpers */
        .glass-panel {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.4);
        }
        .dark .glass-panel {
            background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        /* Ambient Hero Glow (Blue Accent) */
        .ambient-glow {
            position: absolute;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(37, 99, 235, 0.12) 0%, rgba(37, 99, 235, 0) 70%);
            pointer-events: none;
            z-index: 0;
        }

        /* Bento Grid Card Hover */
        .bento-card {
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .bento-card:hover {
            transform: translateY(-4px);
        }

        /* Modal Overlay & Transitions */
        .modal {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
            padding: 1rem;
        }
        .modal.active {
            opacity: 1;
            visibility: visible;
        }
        .modal-box {
            transform: scale(0.95) translateY(10px);
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            max-height: 90vh;
        }
        .modal.active .modal-box {
            transform: scale(1) translateY(0);
        }
        /* Carousel Utilities */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .carousel-dot {
            cursor: pointer;
        }

        /* Seamless Marquee Loop Left */
        @keyframes marqueeLoopLeft {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-50%);
            }
        }
        .animate-marquee-loop,
        .animate-marquee-sync {
            display: flex;
            width: max-content;
            animation: marqueeLoopLeft 28s linear infinite;
        }
        .animate-marquee-talent {
            display: flex;
            width: max-content;
            animation: marqueeLoopLeft 36s linear infinite;
        }
        .animate-marquee-loop:hover,
        .animate-marquee-sync:hover,
        .animate-marquee-talent:hover {
            animation-play-state: paused;
        }
    </style>
</head>

<body class="bg-slate-50 dark:bg-slate-950 text-slate-800 dark:text-slate-100 font-sans antialiased selection:bg-brand-500 selection:text-white transition-colors duration-300">

    <!-- Main Navigation Header -->
    <header class="sticky top-0 z-50 bg-white/90 dark:bg-slate-900/90 backdrop-blur-md border-b border-slate-200/60 dark:border-slate-800/60 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-18 py-3">
                <!-- Brand Logo & Title -->
                <a href="/" class="flex items-center gap-3 group">
                    <img src="/images/logo.png" alt="Logo" class="h-9 sm:h-10 w-auto object-contain transition-transform group-hover:scale-105" />
                    <span class="font-display font-bold text-sm sm:text-base tracking-tight text-slate-900 dark:text-white uppercase group-hover:text-brand-600 dark:group-hover:text-brand-400 transition-colors" translate="no">
                        {{ env('COMPANY_NAME', 'PT. NUSANTARA PORTAL INC.') }}
                    </span>
                </a>

                <!-- Clean Desktop Navigation Links -->
                <nav class="hidden lg:flex items-center gap-7 text-sm font-medium text-slate-600 dark:text-slate-300">
                    <a href="/" class="text-brand-600 dark:text-brand-400 font-semibold transition-colors" data-i18n="nav_home">
                        Beranda
                    </a>
                    <button type="button" data-modal="modal-1" class="hover:text-brand-600 dark:hover:text-brand-400 transition-colors" data-i18n="nav_company">
                        Perusahaan
                    </button>
                    <button type="button" data-modal="modal-3" class="hover:text-brand-600 dark:hover:text-brand-400 transition-colors" data-i18n="nav_formal">
                        Formal
                    </button>
                    <button type="button" data-modal="modal-4" class="hover:text-brand-600 dark:hover:text-brand-400 transition-colors" data-i18n="nav_informal">
                        Informal
                    </button>
                    <button type="button" data-modal="modal-2" class="hover:text-brand-600 dark:hover:text-brand-400 transition-colors" data-i18n="nav_about">
                        Tentang Kami
                    </button>
                    <button type="button" data-modal="modal-5" class="hover:text-brand-600 dark:hover:text-brand-400 transition-colors" data-i18n="nav_contact">
                        Kontak
                    </button>
                </nav>

                <!-- Actions: Language Switcher, Theme Switcher & Login Dropdown -->
                <div class="flex items-center gap-2 sm:gap-3">
                    <!-- Native Multi-Language Switcher Dropdown -->
                    <div class="relative" id="langDropdownContainer">
                        <button id="langDropdownBtn" type="button" aria-label="Pilih Bahasa" class="flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg text-xs font-semibold text-slate-600 dark:text-slate-300 hover:text-brand-600 dark:hover:text-brand-400 hover:bg-slate-100 dark:hover:bg-slate-800 border border-slate-200/70 dark:border-slate-700/70 transition-colors">
                            <i class="fa-solid fa-globe text-sm text-brand-600 dark:text-brand-400"></i>
                            <span id="currentLangLabel">ID</span>
                            <i id="langChevron" class="fa-solid fa-chevron-down text-[9px] opacity-70 transition-transform"></i>
                        </button>

                        <!-- Language Dropdown Menu -->
                        <div id="langDropdownMenu" class="hidden absolute right-0 mt-2 w-48 p-1.5 rounded-xl bg-white dark:bg-slate-900 shadow-xl border border-slate-200 dark:border-slate-800 z-50 text-xs font-semibold">
                            <div class="space-y-0.5">
                                <button type="button" onclick="setAppLanguage('id')" class="w-full flex items-center justify-between px-3 py-2 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-200 transition-colors">
                                    <span class="flex items-center gap-2"><span>🇮🇩</span> Bahasa Indonesia</span>
                                    <span class="text-[10px] text-brand-600 dark:text-brand-400 font-bold">ID</span>
                                </button>
                                <button type="button" onclick="setAppLanguage('en')" class="w-full flex items-center justify-between px-3 py-2 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-200 transition-colors">
                                    <span class="flex items-center gap-2"><span>🇬🇧</span> English</span>
                                    <span class="text-[10px] text-slate-400">EN</span>
                                </button>
                                <button type="button" onclick="setAppLanguage('zh')" class="w-full flex items-center justify-between px-3 py-2 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-200 transition-colors">
                                    <span class="flex items-center gap-2"><span>🇹🇼</span> 繁體中文</span>
                                    <span class="text-[10px] text-slate-400">TW/HK</span>
                                </button>
                                <button type="button" onclick="setAppLanguage('cn')" class="w-full flex items-center justify-between px-3 py-2 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-200 transition-colors">
                                    <span class="flex items-center gap-2"><span>🇨🇳</span> 简体中文</span>
                                    <span class="text-[10px] text-slate-400">CN</span>
                                </button>
                                <button type="button" onclick="setAppLanguage('ja')" class="w-full flex items-center justify-between px-3 py-2 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-200 transition-colors">
                                    <span class="flex items-center gap-2"><span>🇯🇵</span> 日本語</span>
                                    <span class="text-[10px] text-slate-400">JA</span>
                                </button>
                                <button type="button" onclick="setAppLanguage('ko')" class="w-full flex items-center justify-between px-3 py-2 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-200 transition-colors">
                                    <span class="flex items-center gap-2"><span>🇰🇷</span> 한국어</span>
                                    <span class="text-[10px] text-slate-400">KO</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Dark/Light Mode Switcher -->
                    <button id="themeToggleBtn" type="button" aria-label="Toggle Theme" class="w-9 h-9 rounded-lg text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800 flex items-center justify-center transition-colors">
                        <span id="themeToggleIcon" class="material-symbols-outlined text-[20px]">dark_mode</span>
                    </button>

                    <!-- Portal Login Dropdown (Desktop) -->
                    <div class="relative hidden sm:block">
                        <button id="portalDropdownBtn" type="button" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg font-semibold text-xs text-white bg-brand-600 hover:bg-brand-700 shadow-sm transition-colors">
                            <span data-i18n="nav_login">LOGIN</span>
                            <i id="portalChevron" class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="portalDropdownMenu" class="hidden absolute right-0 mt-2 w-64 p-2 rounded-xl bg-white dark:bg-slate-900 shadow-xl border border-slate-200 dark:border-slate-800 z-50 transition-all">
                            <a href="/admin" class="flex items-center gap-3 p-2.5 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 text-xs font-semibold text-slate-700 dark:text-slate-200 transition-colors">
                                <i class="fa-solid fa-user-tie text-brand-600 w-4 text-center"></i>
                                <span data-i18n="login_staff">LOGIN STAFF</span>
                            </a>
                            <a href="/admin/workers" class="flex items-center gap-3 p-2.5 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 text-xs font-semibold text-slate-700 dark:text-slate-200 transition-colors">
                                <i class="fa-solid fa-building-columns text-blue-600 w-4 text-center"></i>
                                <span data-i18n="login_agency">LOGIN AGENCY</span>
                            </a>
                            <a href="/admin/proses" class="flex items-center gap-3 p-2.5 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 text-xs font-semibold text-slate-700 dark:text-slate-200 transition-colors">
                                <i class="fa-solid fa-id-card-clip text-amber-600 w-4 text-center"></i>
                                <span data-i18n="login_cpmi">LOGIN CPMI</span>
                            </a>
                        </div>
                    </div>

                    <!-- Mobile Menu Toggle Button -->
                    <button id="mobileMenuToggle" type="button" class="lg:hidden w-9 h-9 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 flex items-center justify-center transition-colors">
                        <i id="mobileMenuIcon" class="fa-solid fa-bars text-lg"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer Menu -->
        <div id="mobileDrawer" class="hidden lg:hidden border-t border-slate-200 dark:border-slate-800 bg-white/95 dark:bg-slate-900/95 backdrop-blur-lg px-4 py-4 space-y-3">
            <nav class="flex flex-col space-y-1 text-sm font-medium text-slate-700 dark:text-slate-200">
                <a href="/" class="px-3 py-2 rounded-lg text-brand-600 dark:text-brand-400 font-semibold" data-i18n="nav_home">
                    Beranda
                </a>
                <button type="button" data-modal="modal-1" class="text-left px-3 py-2 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800" data-i18n="nav_company">
                    Perusahaan
                </button>
                <button type="button" data-modal="modal-3" class="text-left px-3 py-2 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800" data-i18n="nav_formal">
                    Formal
                </button>
                <button type="button" data-modal="modal-4" class="text-left px-3 py-2 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800" data-i18n="nav_informal">
                    Informal
                </button>
                <button type="button" data-modal="modal-2" class="text-left px-3 py-2 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800" data-i18n="nav_about">
                    Tentang Kami
                </button>
                <button type="button" data-modal="modal-5" class="text-left px-3 py-2 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800" data-i18n="nav_contact">
                    Kontak
                </button>
            </nav>

            <!-- Mobile Language Selection -->
            <div class="px-2 pt-2 border-t border-slate-200 dark:border-slate-800">
                <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2 flex items-center gap-1.5">
                    <i class="fa-solid fa-globe text-brand-600"></i>
                    <span data-i18n="lang_select_title">Pilihan Bahasa</span>
                </div>
                <div class="grid grid-cols-3 gap-1.5 text-xs font-semibold">
                    <button type="button" onclick="setAppLanguage('id')" class="px-2 py-1.5 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-200 hover:bg-brand-50 hover:text-brand-600 text-center">
                        🇮🇩 ID
                    </button>
                    <button type="button" onclick="setAppLanguage('en')" class="px-2 py-1.5 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-200 hover:bg-brand-50 hover:text-brand-600 text-center">
                        🇬🇧 EN
                    </button>
                    <button type="button" onclick="setAppLanguage('zh')" class="px-2 py-1.5 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-200 hover:bg-brand-50 hover:text-brand-600 text-center">
                        🇹🇼 TW
                    </button>
                    <button type="button" onclick="setAppLanguage('cn')" class="px-2 py-1.5 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-200 hover:bg-brand-50 hover:text-brand-600 text-center">
                        🇨🇳 CN
                    </button>
                    <button type="button" onclick="setAppLanguage('ja')" class="px-2 py-1.5 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-200 hover:bg-brand-50 hover:text-brand-600 text-center">
                        🇯🇵 JA
                    </button>
                    <button type="button" onclick="setAppLanguage('ko')" class="px-2 py-1.5 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-200 hover:bg-brand-50 hover:text-brand-600 text-center">
                        🇰🇷 KO
                    </button>
                </div>
            </div>

            <div class="pt-2 border-t border-slate-200 dark:border-slate-800 space-y-1.5">
                <a href="/admin" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-800">
                    <i class="fa-solid fa-user-tie text-brand-600 w-4"></i>
                    <span data-i18n="login_staff">LOGIN STAFF</span>
                </a>
                <a href="/admin/workers" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-800">
                    <i class="fa-solid fa-building-columns text-blue-600 w-4"></i>
                    <span data-i18n="login_agency">LOGIN AGENCY</span>
                </a>
                <a href="/admin/proses" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-800">
                    <i class="fa-solid fa-id-card-clip text-amber-600 w-4"></i>
                    <span data-i18n="login_cpmi">LOGIN CPMI</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative overflow-hidden pt-12 pb-20 lg:pt-16 lg:pb-28">
        <!-- Ambient Background Glows -->
        <div class="ambient-glow top-0 left-1/4 -translate-x-1/2"></div>
        <div class="ambient-glow bottom-0 right-10 translate-x-1/4 opacity-70"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Headline & Hero Header -->
            <div class="max-w-3xl mx-auto text-center mb-14">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-semibold bg-brand-50 dark:bg-brand-950/60 text-brand-700 dark:text-brand-300 border border-brand-200/80 dark:border-brand-800/80 mb-6 shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-brand-500 animate-pulse"></span>
                    <span data-i18n="hero_badge">Perusahaan Penempatan Resmi & Terakreditasi BP2MI</span>
                </div>
                
                <h1 class="font-display font-extrabold text-3xl sm:text-4xl lg:text-5xl tracking-tight text-slate-900 dark:text-white leading-[1.15]">
                    <span data-i18n="hero_title_1">Menjembatani Peluang Karir Global yang</span> <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 via-indigo-600 to-sky-500" data-i18n="hero_title_2">Aman, Legal & Bermartabat</span>
                </h1>
                
                <p class="mt-5 text-base sm:text-lg text-slate-600 dark:text-slate-300 leading-relaxed font-normal" data-i18n="hero_desc">
                    Penyalur resmi Pekerja Migran Indonesia (P3MI) ke negara-negara tujuan Asia Pasifik. Memberikan pembekalan kejuruan, kepastian hukum, dan perlindungan menyeluruh dari pra-pemberangkatan hingga selesai kontrak.
                </p>

                <!-- Quick Hero CTA Buttons -->
                <div class="mt-8 flex flex-wrap items-center justify-center gap-3.5">
                    <a href="#featured-showcase" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl font-bold text-sm text-white bg-brand-600 hover:bg-brand-700 shadow-lg shadow-brand-500/30 hover:shadow-glow transition-all duration-200">
                        <span data-i18n="hero_btn_explore">Jelajahi Program Penempatan</span>
                        <i class="fa-solid fa-arrow-down text-xs"></i>
                    </a>
                    
                    <a href="https://wa.me/62112345678" target="_blank" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl font-bold text-sm text-slate-800 dark:text-white bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 hover:border-brand-500 dark:hover:border-brand-400 shadow-sm hover:shadow-md transition-all duration-200">
                        <i class="fa-brands fa-whatsapp text-emerald-500 text-base"></i>
                        <span data-i18n="hero_btn_wa">Konsultasi Cepat (WhatsApp)</span>
                    </a>

                    <button type="button" data-modal="modal-1" class="inline-flex items-center gap-2 px-5 py-3.5 rounded-xl font-bold text-sm text-brand-700 dark:text-brand-300 bg-brand-50/80 dark:bg-brand-950/40 hover:bg-brand-100 dark:hover:bg-brand-900/60 border border-brand-200 dark:border-brand-800 transition-all duration-200">
                        <i class="fa-solid fa-circle-info text-xs"></i>
                        <span data-i18n="hero_btn_legal">Legalitas & Izin Kami</span>
                    </button>
                </div>

                <!-- Stats Highlights -->
                <div class="mt-12 grid grid-cols-2 md:grid-cols-4 gap-4 p-4 rounded-2xl glass-panel shadow-sm border border-slate-200/80 dark:border-slate-800/80">
                    <div class="p-3 text-center border-r border-slate-200/60 dark:border-slate-800/60 last:border-0">
                        <div class="font-display font-extrabold text-2xl lg:text-3xl text-brand-600 dark:text-brand-400">10+</div>
                        <div class="text-[12px] font-semibold text-slate-500 dark:text-slate-400 mt-0.5" data-i18n="stat_exp">Tahun Pengalaman</div>
                    </div>
                    <div class="p-3 text-center border-r border-slate-200/60 dark:border-slate-800/60 last:border-0">
                        <div class="font-display font-extrabold text-2xl lg:text-3xl text-slate-900 dark:text-white">100%</div>
                        <div class="text-[12px] font-semibold text-slate-500 dark:text-slate-400 mt-0.5" data-i18n="stat_legal">Resmi BP2MI & Kemnaker</div>
                    </div>
                    <div class="p-3 text-center border-r border-slate-200/60 dark:border-slate-800/60 last:border-0">
                        <div class="font-display font-extrabold text-2xl lg:text-3xl text-brand-600 dark:text-brand-400">6+</div>
                        <div class="text-[12px] font-semibold text-slate-500 dark:text-slate-400 mt-0.5" data-i18n="stat_countries">Negara Tujuan Utama</div>
                    </div>
                    <div class="p-3 text-center">
                        <div class="font-display font-extrabold text-2xl lg:text-3xl text-slate-900 dark:text-white">Ribuan+</div>
                        <div class="text-[12px] font-semibold text-slate-500 dark:text-slate-400 mt-0.5" data-i18n="stat_workers">Tenaga Kerja Ditempatkan</div>
                    </div>
                </div>
            </div>

            <!-- Bento Grid Showcase (The 5 Core Pillars) -->
            <div id="featured-showcase" class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-5">
                
                <!-- Card 1: Profil Perusahaan (Spans 2 columns & 2 rows on large screens) -->
                <div data-modal="modal-1" class="bento-card cursor-pointer group md:col-span-2 lg:col-span-2 lg:row-span-2 relative rounded-3xl overflow-hidden min-h-[380px] lg:min-h-[460px] shadow-xl border border-slate-200/80 dark:border-slate-800/80">
                    <img src="/images/perusahaan.jpg" alt="Profil Perusahaan" class="absolute inset-0 w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700 ease-out" />
                    <!-- Gradient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/60 to-transparent"></div>
                    <div class="absolute inset-0 bg-brand-900/20 mix-blend-overlay"></div>

                    <!-- Content -->
                    <div class="relative h-full flex flex-col justify-between p-6 sm:p-8 z-10 text-white">
                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-brand-500/90 text-white backdrop-blur-md shadow-sm">
                                <i class="fa-solid fa-award text-xs"></i> <span data-i18n="card1_badge">PROFIL UTAMA</span>
                            </span>
                            <div class="w-10 h-10 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center text-white group-hover:bg-brand-500 group-hover:rotate-45 transition-all duration-300">
                                <i class="fa-solid fa-arrow-up-right-from-square text-sm"></i>
                            </div>
                        </div>

                        <div>
                            <span class="text-brand-300 text-xs font-bold tracking-widest uppercase" data-i18n="card1_sub">Perusahaan Penempatan Terverifikasi</span>
                            <h2 class="font-display font-extrabold text-2xl sm:text-3xl text-white mt-1 leading-snug" translate="no">
                                {{ strtoupper(env('COMPANY_NAME', 'PT. NUSANTARA PORTAL INC.')) }}
                            </h2>
                            <p class="mt-3 text-sm text-slate-300 line-clamp-3 leading-relaxed" data-i18n="card1_desc">
                                Memiliki komitmen tinggi terhadap regulasi ketenagakerjaan, menjunjung kepatuhan hukum, dan memberikan pendampingan karir komprehensif bagi calon pekerja migran Indonesia.
                            </p>
                            <div class="mt-4 pt-4 border-t border-white/15 flex items-center gap-4 text-xs font-semibold text-brand-300">
                                <span class="flex items-center gap-1.5"><i class="fa-solid fa-certificate"></i> <span data-i18n="card1_f1">Berizin BP2MI</span></span>
                                <span class="flex items-center gap-1.5"><i class="fa-solid fa-building-shield"></i> <span data-i18n="card1_f2">Terdaftar OSS</span></span>
                                <span class="flex items-center gap-1.5"><i class="fa-solid fa-users"></i> <span data-i18n="card1_f3">Mitra Internasional</span></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Sektor Formal -->
                <div data-modal="modal-3" class="bento-card cursor-pointer group relative rounded-3xl overflow-hidden min-h-[220px] shadow-lg border border-slate-200/80 dark:border-slate-800/80">
                    <img src="/images/formal.jpg" alt="Sektor Formal" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out" />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/70 to-slate-950/20"></div>

                    <div class="relative h-full flex flex-col justify-between p-6 z-10 text-white">
                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-blue-500/90 text-white backdrop-blur-md">
                                <i class="fa-solid fa-briefcase text-[10px]"></i> <span data-i18n="card2_badge">FORMAL</span>
                            </span>
                            <div class="w-8 h-8 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center text-white group-hover:bg-blue-500 transition-all">
                                <i class="fa-solid fa-arrow-right text-xs"></i>
                            </div>
                        </div>

                        <div>
                            <h3 class="font-display font-bold text-xl text-white group-hover:text-blue-300 transition-colors" data-i18n="card2_title">SEKTOR FORMAL</h3>
                            <p class="text-xs text-slate-300 mt-1 line-clamp-2" data-i18n="card2_desc">Manufaktur, Tenaga Medis, IT, Hospitality, dan Konstruksi.</p>
                            <div class="mt-3 flex items-center gap-1.5 text-[11px] font-medium text-blue-200">
                                <span>🇯🇵 Jepang</span> • <span>🇰🇷 Korea</span> • <span>🇹🇼 Taiwan</span> • <span>🇸🇬 SG</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Sektor Informal -->
                <div data-modal="modal-4" class="bento-card cursor-pointer group relative rounded-3xl overflow-hidden min-h-[220px] shadow-lg border border-slate-200/80 dark:border-slate-800/80">
                    <img src="/images/informal.jpg" alt="Sektor Informal" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out" />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/70 to-slate-950/20"></div>

                    <div class="relative h-full flex flex-col justify-between p-6 z-10 text-white">
                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-emerald-500/90 text-white backdrop-blur-md">
                                <i class="fa-solid fa-hand-holding-heart text-[10px]"></i> <span data-i18n="card3_badge">INFORMAL</span>
                            </span>
                            <div class="w-8 h-8 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center text-white group-hover:bg-emerald-500 transition-all">
                                <i class="fa-solid fa-arrow-right text-xs"></i>
                            </div>
                        </div>

                        <div>
                            <h3 class="font-display font-bold text-xl text-white group-hover:text-emerald-300 transition-colors" data-i18n="card3_title">SEKTOR INFORMAL</h3>
                            <p class="text-xs text-slate-300 mt-1 line-clamp-2" data-i18n="card3_desc">Caregiver Lansia, Housekeeping, Layanan Makanan, & Pertanian.</p>
                            <div class="mt-3 flex items-center gap-1.5 text-[11px] font-medium text-emerald-200">
                                <span>🇭🇰 HK</span> • <span>🇹🇼 Taiwan</span> • <span>🇸🇬 Singapura</span> • <span>🇲🇾 MY</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 4: Tentang Kami -->
                <div data-modal="modal-2" class="bento-card cursor-pointer group relative rounded-3xl overflow-hidden min-h-[220px] shadow-lg border border-slate-200/80 dark:border-slate-800/80">
                    <img src="/images/tentangkami.jpg" alt="Tentang Kami" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out" />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/70 to-slate-950/20"></div>

                    <div class="relative h-full flex flex-col justify-between p-6 z-10 text-white">
                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-amber-500/90 text-white backdrop-blur-md">
                                <i class="fa-solid fa-building text-[10px]"></i> <span data-i18n="card4_badge">PROFIL</span>
                            </span>
                            <div class="w-8 h-8 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center text-white group-hover:bg-amber-500 transition-all">
                                <i class="fa-solid fa-arrow-right text-xs"></i>
                            </div>
                        </div>

                        <div>
                            <h3 class="font-display font-bold text-xl text-white group-hover:text-amber-300 transition-colors" data-i18n="card4_title">TENTANG KAMI</h3>
                            <p class="text-xs text-slate-300 mt-1 line-clamp-2" data-i18n="card4_desc">Rekam jejak 10+ tahun dengan standar perekrutan profesional & etis.</p>
                            <div class="mt-3 text-[11px] font-medium text-amber-200 flex items-center gap-1.5">
                                <i class="fa-solid fa-check-double"></i> <span data-i18n="card4_link">Visi, Misi & Komitmen Perusahaan</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 5: Kontak & Hotline -->
                <div data-modal="modal-5" class="bento-card cursor-pointer group relative rounded-3xl overflow-hidden min-h-[220px] shadow-lg border border-slate-200/80 dark:border-slate-800/80">
                    <img src="/images/hubungi.jpg" alt="Kontak & Hotline" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out" />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/70 to-slate-950/20"></div>

                    <div class="relative h-full flex flex-col justify-between p-6 z-10 text-white">
                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-blue-600/90 text-white backdrop-blur-md">
                                <i class="fa-solid fa-phone text-[10px]"></i> <span data-i18n="card5_badge">LAYANAN 24/7</span>
                            </span>
                            <div class="w-8 h-8 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center text-white group-hover:bg-blue-600 transition-all">
                                <i class="fa-solid fa-arrow-right text-xs"></i>
                            </div>
                        </div>

                        <div>
                            <h3 class="font-display font-bold text-xl text-white group-hover:text-blue-300 transition-colors" data-i18n="card5_title">HUBUNGI KAMI</h3>
                            <p class="text-xs text-slate-300 mt-1 line-clamp-2" data-i18n="card5_desc">Hotline Darurat (SOS), Konsultasi Pendaftaran & Alamat Kantor.</p>
                            <div class="mt-3 text-[11px] font-medium text-blue-200 flex items-center gap-1.5">
                                <i class="fa-brands fa-whatsapp text-emerald-400"></i> <span data-i18n="card5_link">WhatsApp & Konsultasi Online</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Government Synchronization & Accreditations (Sinkronisasi Resmi) -->
    <section class="py-14 bg-white dark:bg-slate-900 border-y border-slate-200/70 dark:border-slate-800/70 transition-colors relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
                <div>
                    <span class="text-xs font-bold text-brand-600 dark:text-brand-400 tracking-wider uppercase" data-i18n="sync_badge">Sistem Resmi Terintegrasi</span>
                    <h3 class="font-display font-extrabold text-xl sm:text-2xl text-slate-900 dark:text-white mt-1" data-i18n="sync_title">
                        Sinkronisasi & Kepatuhan Regulasi Pemerintah
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-2 max-w-2xl" data-i18n="sync_desc">
                        Operasional penempatan kami terdaftar secara sah dan terhubung langsung dengan ekosistem ketenagakerjaan Republik Indonesia.
                    </p>
                </div>
                <!-- Carousel Navigation Arrows (Left & Right) -->
                <div class="flex items-center gap-2 self-start md:self-end">
                    <button type="button" id="syncPrevBtn" aria-label="Slide Sebelumnya" class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-800 hover:bg-brand-600 hover:text-white text-slate-600 dark:text-slate-300 border border-slate-200/60 dark:border-slate-700/60 flex items-center justify-center transition-all duration-200 shadow-sm active:scale-95">
                        <i class="fa-solid fa-chevron-left text-xs"></i>
                    </button>
                    <button type="button" id="syncNextBtn" aria-label="Slide Selanjutnya" class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-800 hover:bg-brand-600 hover:text-white text-slate-600 dark:text-slate-300 border border-slate-200/60 dark:border-slate-700/60 flex items-center justify-center transition-all duration-200 shadow-sm active:scale-95">
                        <i class="fa-solid fa-chevron-right text-xs"></i>
                    </button>
                </div>
            </div>

            <!-- Carousel Track -->
            <div class="relative">
                <div id="syncCarouselTrack" class="flex gap-4 sm:gap-6 overflow-x-auto scroll-smooth snap-x snap-mandatory no-scrollbar py-2">
                    <!-- BP2MI -->
                    <div class="flex-none w-[200px] sm:w-[220px] md:w-[240px] snap-start flex flex-col items-center justify-center p-6 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200/60 dark:border-slate-700/60 hover:border-brand-500/50 hover:shadow-lg transition-all group select-none text-center">
                        <img src="/images/bp2mi.png" alt="BP2MI" class="h-12 w-auto object-contain transition-transform group-hover:scale-105" />
                        <span class="mt-3 text-xs font-bold text-slate-800 dark:text-slate-200">BP2MI</span>
                        <span class="text-[10px] text-slate-400 mt-0.5" data-i18n="sub_bp2mi">Badan Pelindungan PMI</span>
                    </div>

                    <!-- KEMNAKER RI -->
                    <div class="flex-none w-[200px] sm:w-[220px] md:w-[240px] snap-start flex flex-col items-center justify-center p-6 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200/60 dark:border-slate-700/60 hover:border-brand-500/50 hover:shadow-lg transition-all group select-none text-center">
                        <img src="/images/kemnaker.png" alt="Kemnaker" class="h-12 w-auto object-contain transition-transform group-hover:scale-105" />
                        <span class="mt-3 text-xs font-bold text-slate-800 dark:text-slate-200">KEMNAKER RI</span>
                        <span class="text-[10px] text-slate-400 mt-0.5" data-i18n="sub_kemnaker">Kementerian Ketenagakerjaan</span>
                    </div>

                    <!-- SIAPkerja -->
                    <div class="flex-none w-[200px] sm:w-[220px] md:w-[240px] snap-start flex flex-col items-center justify-center p-6 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200/60 dark:border-slate-700/60 hover:border-brand-500/50 hover:shadow-lg transition-all group select-none text-center">
                        <img src="/images/siapkerja.svg" alt="Siap Kerja" class="h-10 w-auto object-contain transition-transform group-hover:scale-105" />
                        <span class="mt-3 text-xs font-bold text-slate-800 dark:text-slate-200">SIAPkerja</span>
                        <span class="text-[10px] text-slate-400 mt-0.5" data-i18n="sub_siapkerja">Ekosistem Ketenagakerjaan</span>
                    </div>

                    <!-- Karirhub -->
                    <div class="flex-none w-[200px] sm:w-[220px] md:w-[240px] snap-start flex flex-col items-center justify-center p-6 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200/60 dark:border-slate-700/60 hover:border-brand-500/50 hover:shadow-lg transition-all group select-none text-center">
                        <img src="/images/karirhub.svg" alt="Karir Hub" class="h-10 w-auto object-contain transition-transform group-hover:scale-105" />
                        <span class="mt-3 text-xs font-bold text-slate-800 dark:text-slate-200">Karirhub</span>
                        <span class="text-[10px] text-slate-400 mt-0.5" data-i18n="sub_karirhub">Pusat Informasi Lowongan</span>
                    </div>

                    <!-- OSS - RBA -->
                    <div class="flex-none w-[200px] sm:w-[220px] md:w-[240px] snap-start flex flex-col items-center justify-center p-6 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200/60 dark:border-slate-700/60 hover:border-brand-500/50 hover:shadow-lg transition-all group select-none text-center">
                        <img src="/images/oss.svg" alt="OSS" class="h-10 w-auto object-contain transition-transform group-hover:scale-105" />
                        <span class="mt-3 text-xs font-bold text-slate-800 dark:text-slate-200">OSS - RBA</span>
                        <span class="text-[10px] text-slate-400 mt-0.5" data-i18n="sub_oss">Perizinan Berusaha Resmi</span>
                    </div>

                    <!-- APJATI / Asosiasi P3MI -->
                    <div class="flex-none w-[200px] sm:w-[220px] md:w-[240px] snap-start flex flex-col items-center justify-center p-6 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200/60 dark:border-slate-700/60 hover:border-brand-500/50 hover:shadow-lg transition-all group select-none text-center">
                        <div class="h-12 w-12 rounded-xl bg-brand-500/10 text-brand-600 dark:text-brand-400 flex items-center justify-center text-2xl group-hover:scale-105 transition-transform">
                            <i class="fa-solid fa-building-columns"></i>
                        </div>
                        <span class="mt-3 text-xs font-bold text-slate-800 dark:text-slate-200">ASOSIASI P3MI</span>
                        <span class="text-[10px] text-slate-400 mt-0.5" data-i18n="sub_apjati">Asosiasi Resmi Penempatan</span>
                    </div>

                    <!-- BNSP / UJK Sertifikasi -->
                    <div class="flex-none w-[200px] sm:w-[220px] md:w-[240px] snap-start flex flex-col items-center justify-center p-6 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200/60 dark:border-slate-700/60 hover:border-brand-500/50 hover:shadow-lg transition-all group select-none text-center">
                        <div class="h-12 w-12 rounded-xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-2xl group-hover:scale-105 transition-transform">
                            <i class="fa-solid fa-stamp"></i>
                        </div>
                        <span class="mt-3 text-xs font-bold text-slate-800 dark:text-slate-200">BNSP / LSP</span>
                        <span class="text-[10px] text-slate-400 mt-0.5" data-i18n="sub_bnsp">Badan Nasional Sertifikasi</span>
                    </div>
                </div>

                <!-- Carousel Dots Indicator -->
                <div id="syncDots" class="flex items-center justify-center gap-1.5 mt-5"></div>
            </div>
        </div>
    </section>

    <!-- Calon Pekerja Migran (Talent Pool Carousel) -->
    <section class="py-16 lg:py-24 bg-slate-50 dark:bg-slate-950 transition-colors relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
                <div>
                    <span class="text-xs font-bold text-brand-600 dark:text-brand-400 tracking-wider uppercase" data-i18n="cand_badge">Talenta & Tenaga Siap Kerja</span>
                    <h2 class="font-display font-extrabold text-2xl sm:text-3xl lg:text-4xl text-slate-900 dark:text-white mt-1" data-i18n="cand_title">
                        Kandidat Calon Pekerja Migran Terlatih
                    </h2>
                    <p class="text-sm text-slate-600 dark:text-slate-400 mt-2 max-w-xl" data-i18n="cand_desc">
                        Kandidat kami telah melewati seleksi kesehatan, pelatihan bahasa, dan pembekalan kejuruan di Balai Latihan Kerja (BLK) tersertifikasi.
                    </p>
                </div>
                <div class="flex items-center gap-3 self-start md:self-end">
                    <!-- Carousel Navigation Arrows (Left & Right) -->
                    <div class="flex items-center gap-2">
                        <button type="button" id="talentPrevBtn" aria-label="Kandidat Sebelumnya" class="w-10 h-10 rounded-xl bg-white dark:bg-slate-800 hover:bg-brand-600 hover:text-white text-slate-700 dark:text-slate-200 border border-slate-200 dark:border-slate-700 flex items-center justify-center transition-all duration-200 shadow-sm active:scale-95">
                            <i class="fa-solid fa-chevron-left text-xs"></i>
                        </button>
                        <button type="button" id="talentNextBtn" aria-label="Kandidat Selanjutnya" class="w-10 h-10 rounded-xl bg-white dark:bg-slate-800 hover:bg-brand-600 hover:text-white text-slate-700 dark:text-slate-200 border border-slate-200 dark:border-slate-700 flex items-center justify-center transition-all duration-200 shadow-sm active:scale-95">
                            <i class="fa-solid fa-chevron-right text-xs"></i>
                        </button>
                    </div>

                    <a href="/admin/workers" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-xs sm:text-sm text-brand-700 dark:text-brand-300 bg-brand-50 dark:bg-brand-950/60 hover:bg-brand-100 dark:hover:bg-brand-900/60 border border-brand-200 dark:border-brand-800 transition-colors">
                        <i class="fa-solid fa-users-viewfinder"></i>
                        <span data-i18n="cand_btn_agency">Akses Portal Agency</span>
                    </a>
                </div>
            </div>

            <!-- Talent Carousel Track -->
            <div class="relative">
                <div id="talentCarouselTrack" class="flex gap-5 overflow-x-auto scroll-smooth snap-x snap-mandatory no-scrollbar py-3 px-1">
                    @php
                        $validMarketing = $marketing->filter(function($item) {
                            return !empty($item->foto) && (Storage::disk('public')->exists($item->foto) || file_exists(public_path('storage/' . $item->foto)));
                        });
                    @endphp
                    @if ($validMarketing->count() > 0)
                        @foreach ($validMarketing as $item)
                        <div class="flex-none w-[220px] sm:w-[240px] md:w-[260px] snap-start group relative rounded-2xl overflow-hidden bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800/80 shadow-md hover:shadow-xl transition-all duration-300">
                            <div class="aspect-[3/4] overflow-hidden bg-slate-100 dark:bg-slate-800 relative">
                                <img src="{{ Storage::url($item->foto) }}" alt="Calon Pekerja" onerror="window.handleWorkerImageError(this)" class="worker-image w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500 pointer-events-none select-none" loading="lazy" />
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
                                <span class="absolute top-2.5 left-2.5 px-2 py-0.5 rounded-md text-[9px] font-bold bg-emerald-500 text-white shadow-sm" data-i18n="ready_status">
                                    Siap Kerja
                                </span>
                            </div>
                            <div class="p-3 text-center">
                                <h4 class="text-xs font-bold text-slate-800 dark:text-white truncate" data-i18n="cand_verified">CPMI Terverifikasi</h4>
                                <p class="text-[10px] text-slate-400 mt-0.5" data-i18n="cand_complete_docs">Dokumen Lengkap</p>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <!-- Fallback 8 Realistic Diverse Candidate Cards for Smooth Carousel -->
                        <div class="flex-none w-[220px] sm:w-[240px] md:w-[260px] snap-start group relative rounded-2xl overflow-hidden bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800/80 shadow-md hover:shadow-xl transition-all duration-300">
                            <div class="aspect-[3/4] overflow-hidden bg-slate-100 dark:bg-slate-800 relative">
                                <img src="/images/maids.jpg" alt="Caregiver Taiwan" onerror="window.handleWorkerImageError(this)" class="worker-image w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500 pointer-events-none select-none" />
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
                                <span class="absolute top-2.5 left-2.5 px-2 py-0.5 rounded-md text-[9px] font-bold bg-emerald-500 text-white shadow-sm" data-i18n="ready_status">
                                    Siap Kerja
                                </span>
                                <span class="absolute bottom-2.5 left-2.5 px-2 py-0.5 rounded-md text-[9px] font-bold bg-black/60 text-white backdrop-blur-sm">
                                    🇹🇼 Taiwan / 🇭🇰 HK
                                </span>
                            </div>
                            <div class="p-3 text-center">
                                <h4 class="text-xs font-bold text-slate-800 dark:text-white truncate" data-i18n="role_caregiver">Caregiver Lansia</h4>
                                <p class="text-[10px] text-brand-600 dark:text-brand-400 font-semibold mt-0.5" data-i18n="cand_complete_docs">Dokumen Lengkap</p>
                            </div>
                        </div>

                        <div class="flex-none w-[220px] sm:w-[240px] md:w-[260px] snap-start group relative rounded-2xl overflow-hidden bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800/80 shadow-md hover:shadow-xl transition-all duration-300">
                            <div class="aspect-[3/4] overflow-hidden bg-slate-100 dark:bg-slate-800 relative">
                                <img src="/images/contohfotomaids.jpg" alt="Housekeeper Singapura" onerror="window.handleWorkerImageError(this)" class="worker-image w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500 pointer-events-none select-none" />
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
                                <span class="absolute top-2.5 left-2.5 px-2 py-0.5 rounded-md text-[9px] font-bold bg-blue-500 text-white shadow-sm" data-i18n="trained_status">
                                    Pelatihan Selesai
                                </span>
                                <span class="absolute bottom-2.5 left-2.5 px-2 py-0.5 rounded-md text-[9px] font-bold bg-black/60 text-white backdrop-blur-sm">
                                    🇸🇬 Singapura / 🇲🇾 MY
                                </span>
                            </div>
                            <div class="p-3 text-center">
                                <h4 class="text-xs font-bold text-slate-800 dark:text-white truncate" data-i18n="role_housekeeper">Housekeeper</h4>
                                <p class="text-[10px] text-brand-600 dark:text-brand-400 font-semibold mt-0.5" data-i18n="cand_complete_docs">Dokumen Lengkap</p>
                            </div>
                        </div>

                        <div class="flex-none w-[220px] sm:w-[240px] md:w-[260px] snap-start group relative rounded-2xl overflow-hidden bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800/80 shadow-md hover:shadow-xl transition-all duration-300">
                            <div class="aspect-[3/4] overflow-hidden bg-slate-100 dark:bg-slate-800 relative">
                                <img src="/images/formal.jpg" alt="Teknisi Manufaktur" onerror="window.handleWorkerImageError(this)" class="worker-image w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500 pointer-events-none select-none" />
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
                                <span class="absolute top-2.5 left-2.5 px-2 py-0.5 rounded-md text-[9px] font-bold bg-purple-500 text-white shadow-sm" data-i18n="cert_status">
                                    Sertifikasi N4
                                </span>
                                <span class="absolute bottom-2.5 left-2.5 px-2 py-0.5 rounded-md text-[9px] font-bold bg-black/60 text-white backdrop-blur-sm">
                                    🇯🇵 Jepang / 🇰🇷 Korea
                                </span>
                            </div>
                            <div class="p-3 text-center">
                                <h4 class="text-xs font-bold text-slate-800 dark:text-white truncate" data-i18n="role_operator">Operator Pabrik</h4>
                                <p class="text-[10px] text-brand-600 dark:text-brand-400 font-semibold mt-0.5" data-i18n="cand_complete_docs">Dokumen Lengkap</p>
                            </div>
                        </div>

                        <div class="flex-none w-[220px] sm:w-[240px] md:w-[260px] snap-start group relative rounded-2xl overflow-hidden bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800/80 shadow-md hover:shadow-xl transition-all duration-300">
                            <div class="aspect-[3/4] overflow-hidden bg-slate-100 dark:bg-slate-800 relative">
                                <img src="/images/informal.jpg" alt="Perawat Medis" onerror="window.handleWorkerImageError(this)" class="worker-image w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500 pointer-events-none select-none" />
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
                                <span class="absolute top-2.5 left-2.5 px-2 py-0.5 rounded-md text-[9px] font-bold bg-emerald-500 text-white shadow-sm" data-i18n="ready_status">
                                    Siap Kerja
                                </span>
                                <span class="absolute bottom-2.5 left-2.5 px-2 py-0.5 rounded-md text-[9px] font-bold bg-black/60 text-white backdrop-blur-sm">
                                    🇹🇼 Taiwan / 🇸🇬 SG
                                </span>
                            </div>
                            <div class="p-3 text-center">
                                <h4 class="text-xs font-bold text-slate-800 dark:text-white truncate" data-i18n="role_nurse">Perawat Khusus</h4>
                                <p class="text-[10px] text-brand-600 dark:text-brand-400 font-semibold mt-0.5" data-i18n="cand_complete_docs">Dokumen Lengkap</p>
                            </div>
                        </div>

                        <div class="flex-none w-[220px] sm:w-[240px] md:w-[260px] snap-start group relative rounded-2xl overflow-hidden bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800/80 shadow-md hover:shadow-xl transition-all duration-300">
                            <div class="aspect-[3/4] overflow-hidden bg-slate-100 dark:bg-slate-800 relative">
                                <img src="/images/maids.jpg" alt="Staf Kuliner" onerror="window.handleWorkerImageError(this)" class="worker-image w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500 pointer-events-none select-none" />
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
                                <span class="absolute top-2.5 left-2.5 px-2 py-0.5 rounded-md text-[9px] font-bold bg-amber-500 text-white shadow-sm" data-i18n="exp_status">
                                    Berpengalaman
                                </span>
                                <span class="absolute bottom-2.5 left-2.5 px-2 py-0.5 rounded-md text-[9px] font-bold bg-black/60 text-white backdrop-blur-sm">
                                    🇲🇾 Malaysia / 🇸🇬 SG
                                </span>
                            </div>
                            <div class="p-3 text-center">
                                <h4 class="text-xs font-bold text-slate-800 dark:text-white truncate" data-i18n="role_culinary">Staf Restoran</h4>
                                <p class="text-[10px] text-brand-600 dark:text-brand-400 font-semibold mt-0.5" data-i18n="cand_complete_docs">Dokumen Lengkap</p>
                            </div>
                        </div>

                        <div class="flex-none w-[220px] sm:w-[240px] md:w-[260px] snap-start group relative rounded-2xl overflow-hidden bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800/80 shadow-md hover:shadow-xl transition-all duration-300">
                            <div class="aspect-[3/4] overflow-hidden bg-slate-100 dark:bg-slate-800 relative">
                                <img src="/images/contohfotomaids.jpg" alt="Perkebunan & Pertanian" onerror="window.handleWorkerImageError(this)" class="worker-image w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500 pointer-events-none select-none" />
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
                                <span class="absolute top-2.5 left-2.5 px-2 py-0.5 rounded-md text-[9px] font-bold bg-emerald-500 text-white shadow-sm" data-i18n="ready_status">
                                    Siap Kerja
                                </span>
                                <span class="absolute bottom-2.5 left-2.5 px-2 py-0.5 rounded-md text-[9px] font-bold bg-black/60 text-white backdrop-blur-sm">
                                    🇰🇷 Korea / 🇯🇵 Jepang
                                </span>
                            </div>
                            <div class="p-3 text-center">
                                <h4 class="text-xs font-bold text-slate-800 dark:text-white truncate" data-i18n="role_agriculture">Pertanian Modern</h4>
                                <p class="text-[10px] text-brand-600 dark:text-brand-400 font-semibold mt-0.5" data-i18n="cand_complete_docs">Dokumen Lengkap</p>
                            </div>
                        </div>

                        <div class="flex-none w-[220px] sm:w-[240px] md:w-[260px] snap-start group relative rounded-2xl overflow-hidden bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800/80 shadow-md hover:shadow-xl transition-all duration-300">
                            <div class="aspect-[3/4] overflow-hidden bg-slate-100 dark:bg-slate-800 relative">
                                <img src="/images/informal.jpg" alt="Caregiver Kaigo" onerror="window.handleWorkerImageError(this)" class="worker-image w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500 pointer-events-none select-none" />
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
                                <span class="absolute top-2.5 left-2.5 px-2 py-0.5 rounded-md text-[9px] font-bold bg-purple-500 text-white shadow-sm" data-i18n="cert_status">
                                    Sertifikasi N4
                                </span>
                                <span class="absolute bottom-2.5 left-2.5 px-2 py-0.5 rounded-md text-[9px] font-bold bg-black/60 text-white backdrop-blur-sm">
                                    🇯🇵 Jepang (Tokutei Ginou)
                                </span>
                            </div>
                            <div class="p-3 text-center">
                                <h4 class="text-xs font-bold text-slate-800 dark:text-white truncate" data-i18n="role_kaigo">Caregiver Kaigo</h4>
                                <p class="text-[10px] text-brand-600 dark:text-brand-400 font-semibold mt-0.5" data-i18n="cand_complete_docs">Dokumen Lengkap</p>
                            </div>
                        </div>

                        <div class="flex-none w-[220px] sm:w-[240px] md:w-[260px] snap-start group relative rounded-2xl overflow-hidden bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800/80 shadow-md hover:shadow-xl transition-all duration-300">
                            <div class="aspect-[3/4] overflow-hidden bg-slate-100 dark:bg-slate-800 relative">
                                <img src="/images/formal.jpg" alt="Teknisi Mekanik" onerror="window.handleWorkerImageError(this)" class="worker-image w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500 pointer-events-none select-none" />
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
                                <span class="absolute top-2.5 left-2.5 px-2 py-0.5 rounded-md text-[9px] font-bold bg-blue-500 text-white shadow-sm" data-i18n="trained_status">
                                    Pelatihan Selesai
                                </span>
                                <span class="absolute bottom-2.5 left-2.5 px-2 py-0.5 rounded-md text-[9px] font-bold bg-black/60 text-white backdrop-blur-sm">
                                    🇹🇼 Taiwan / 🇰🇷 Korea
                                </span>
                            </div>
                            <div class="p-3 text-center">
                                <h4 class="text-xs font-bold text-slate-800 dark:text-white truncate" data-i18n="role_technician">Teknisi & Konstruksi</h4>
                                <p class="text-[10px] text-brand-600 dark:text-brand-400 font-semibold mt-0.5" data-i18n="cand_complete_docs">Dokumen Lengkap</p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Talent Dots Indicator -->
                <div id="talentDots" class="flex items-center justify-center gap-1.5 mt-6"></div>
            </div>

            <!-- View More Candidates Link -->
            <div class="mt-10 text-center">
                <a href="/admin/workers" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-xl font-bold text-sm text-white bg-slate-900 dark:bg-brand-600 hover:bg-brand-600 dark:hover:bg-brand-500 shadow-md hover:shadow-glow transition-all duration-200">
                    <i class="fa-solid fa-list-check"></i>
                    <span data-i18n="cand_btn_more">Lihat Seluruh Database Kandidat di Portal Agency</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Why Choose Us / Keunggulan Kami -->
    <section class="py-16 bg-white dark:bg-slate-900 border-t border-slate-200/70 dark:border-slate-800/70 transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-14">
                <span class="text-xs font-bold text-brand-600 dark:text-brand-400 tracking-wider uppercase" data-i18n="why_badge">Standar Mutu & Perlindungan</span>
                <h2 class="font-display font-extrabold text-2xl sm:text-3xl lg:text-4xl text-slate-900 dark:text-white mt-1" data-i18n="why_title">
                    Mengapa Memilih Layanan Penempatan Kami?
                </h2>
                <p class="text-sm text-slate-600 dark:text-slate-400 mt-2" data-i18n="why_desc">
                    Kami memprioritaskan transparansi, kepatuhan hukum, dan martabat setiap pekerja migran Indonesia.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Feature 1 -->
                <div class="p-6 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200/70 dark:border-slate-700/70 hover:border-brand-500/50 hover:shadow-lg transition-all">
                    <div class="w-12 h-12 rounded-xl bg-brand-500/10 text-brand-600 dark:text-brand-400 flex items-center justify-center text-xl mb-4">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <h3 class="font-display font-bold text-base text-slate-900 dark:text-white" data-i18n="why_1_title">100% Legal & Terlindungi</h3>
                    <p class="text-xs text-slate-600 dark:text-slate-400 mt-2 leading-relaxed" data-i18n="why_1_desc">
                        Seluruh proses mengacu pada regulasi UU Ketenagakerjaan dan standar BP2MI dengan asuransi ketenagakerjaan resmi.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="p-6 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200/70 dark:border-slate-700/70 hover:border-brand-500/50 hover:shadow-lg transition-all">
                    <div class="w-12 h-12 rounded-xl bg-blue-500/10 text-blue-600 dark:text-blue-400 flex items-center justify-center text-xl mb-4">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                    <h3 class="font-display font-bold text-base text-slate-900 dark:text-white" data-i18n="why_2_title">Pelatihan Berstandar BLK</h3>
                    <p class="text-xs text-slate-600 dark:text-slate-400 mt-2 leading-relaxed" data-i18n="why_2_desc">
                        Pembekalan bahasa, adaptasi budaya, dan keahlian vokasi melalui instruktur kompeten di Balai Latihan Kerja resmi.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="p-6 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200/70 dark:border-slate-700/70 hover:border-brand-500/50 hover:shadow-lg transition-all">
                    <div class="w-12 h-12 rounded-xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-xl mb-4">
                        <i class="fa-solid fa-network-wired"></i>
                    </div>
                    <h3 class="font-display font-bold text-base text-slate-900 dark:text-white" data-i18n="why_3_title">Transparansi Digital</h3>
                    <p class="text-xs text-slate-600 dark:text-slate-400 mt-2 leading-relaxed" data-i18n="why_3_desc">
                        Pelacakan proses CPMI, verifikasi dokumen, dan komunikasi agensi secara real-time melalui portal terintegrasi.
                    </p>
                </div>

                <!-- Feature 4 -->
                <div class="p-6 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200/70 dark:border-slate-700/70 hover:border-brand-500/50 hover:shadow-lg transition-all">
                    <div class="w-12 h-12 rounded-xl bg-amber-500/10 text-amber-600 dark:text-amber-400 flex items-center justify-center text-xl mb-4">
                        <i class="fa-solid fa-headset"></i>
                    </div>
                    <h3 class="font-display font-bold text-base text-slate-900 dark:text-white" data-i18n="why_4_title">Dukungan & Hotline SOS</h3>
                    <p class="text-xs text-slate-600 dark:text-slate-400 mt-2 leading-relaxed" data-i18n="why_4_desc">
                        Layanan pendampingan advokasi dan saluran darurat aktif untuk memonitor keselamatan pekerja selama di negara penempatan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pelatihan, Sertifikasi, dan Rekanan Agency (Infinite Marquee Loop Left) -->
    <section class="py-16 bg-slate-50 dark:bg-slate-950 border-t border-slate-200/70 dark:border-slate-800/70 transition-colors relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-10">
                <span class="text-xs font-bold text-brand-600 dark:text-brand-400 tracking-wider uppercase" data-i18n="partner_badge">Ekosistem Kemitraan Global</span>
                <h2 class="font-display font-extrabold text-2xl sm:text-3xl text-slate-900 dark:text-white mt-1" data-i18n="partner_title">
                    Lembaga Pelatihan, Sertifikasi & Agensi Rekanan
                </h2>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 mt-2" data-i18n="partner_desc">
                    Bekerja sama dengan Balai Uji Kompetensi (UJK/LSP) dan Agensi Penempatan Internasional berlisensi terkemuka di luar negeri.
                </p>
            </div>

            <!-- Partners Infinite Scrolling Track Container with side gradient fades -->
            <div class="relative overflow-hidden py-4 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800/80 shadow-sm">
                <!-- Left gradient fade -->
                <div class="absolute left-0 top-0 bottom-0 w-16 sm:w-28 bg-gradient-to-r from-white dark:from-slate-900 to-transparent z-10 pointer-events-none"></div>
                <!-- Right gradient fade -->
                <div class="absolute right-0 top-0 bottom-0 w-16 sm:w-28 bg-gradient-to-l from-white dark:from-slate-900 to-transparent z-10 pointer-events-none"></div>

                <!-- Infinite Marquee Track (Double set for seamless -50% loop) -->
                <div class="animate-marquee-loop flex items-center gap-8 sm:gap-12 px-6">
                    <!-- SET 1 -->
                    <div class="flex items-center gap-8 sm:gap-12 flex-none">
                        @if (file_exists(public_path('images/agency/1.png')))
                        <div class="flex items-center justify-center h-14 px-5 py-2 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200/60 dark:border-slate-700/60 hover:border-brand-500/50 hover:shadow-md transition-all">
                            <img src="/images/agency/1.png" alt="Agency Partner" class="h-9 w-auto max-w-[130px] object-contain transition-transform hover:scale-105" />
                        </div>
                        @endif

                        @if (file_exists(public_path('images/agency/2.png')))
                        <div class="flex items-center justify-center h-14 px-5 py-2 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200/60 dark:border-slate-700/60 hover:border-brand-500/50 hover:shadow-md transition-all">
                            <img src="/images/agency/2.png" alt="Agency Partner" class="h-9 w-auto max-w-[130px] object-contain transition-transform hover:scale-105" />
                        </div>
                        @endif

                        @if (file_exists(public_path('images/agency/3.png')))
                        <div class="flex items-center justify-center h-14 px-5 py-2 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200/60 dark:border-slate-700/60 hover:border-brand-500/50 hover:shadow-md transition-all">
                            <img src="/images/agency/3.png" alt="Agency Partner" class="h-9 w-auto max-w-[130px] object-contain transition-transform hover:scale-105" />
                        </div>
                        @endif

                        @if (file_exists(public_path('images/ujk/1.png')))
                        <div class="flex items-center justify-center h-14 px-5 py-2 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200/60 dark:border-slate-700/60 hover:border-brand-500/50 hover:shadow-md transition-all">
                            <img src="/images/ujk/1.png" alt="UJK LSP Partner" class="h-10 w-auto max-w-[130px] object-contain transition-transform hover:scale-105" />
                        </div>
                        @endif

                        @if (file_exists(public_path('images/ujk/2.png')))
                        <div class="flex items-center justify-center h-14 px-5 py-2 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200/60 dark:border-slate-700/60 hover:border-brand-500/50 hover:shadow-md transition-all">
                            <img src="/images/ujk/2.png" alt="UJK LSP Partner" class="h-10 w-auto max-w-[130px] object-contain transition-transform hover:scale-105" />
                        </div>
                        @endif

                        <!-- Country Partner Pills -->
                        <div class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200/60 dark:border-slate-700/60">
                            <span class="text-base">🇹🇼</span>
                            <span class="text-xs font-bold text-slate-700 dark:text-slate-300">Taiwan Agency Alliance</span>
                        </div>

                        <div class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200/60 dark:border-slate-700/60">
                            <span class="text-base">🇭🇰</span>
                            <span class="text-xs font-bold text-slate-700 dark:text-slate-300">Hong Kong Partner Network</span>
                        </div>

                        <div class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200/60 dark:border-slate-700/60">
                            <span class="text-base">🇯🇵</span>
                            <span class="text-xs font-bold text-slate-700 dark:text-slate-300">Japan Tokutei & Kaigo Group</span>
                        </div>

                        <div class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200/60 dark:border-slate-700/60">
                            <span class="text-base">🇸🇬</span>
                            <span class="text-xs font-bold text-slate-700 dark:text-slate-300">Singapore MOM Accredited</span>
                        </div>

                        <div class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200/60 dark:border-slate-700/60">
                            <span class="text-base">🇲🇾</span>
                            <span class="text-xs font-bold text-slate-700 dark:text-slate-300">Malaysia Licensed Agency</span>
                        </div>
                    </div>

                    <!-- SET 2 (Duplicate for Seamless Infinite Marquee Loop) -->
                    <div class="flex items-center gap-8 sm:gap-12 flex-none" aria-hidden="true">
                        @if (file_exists(public_path('images/agency/1.png')))
                        <div class="flex items-center justify-center h-14 px-5 py-2 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200/60 dark:border-slate-700/60 hover:border-brand-500/50 hover:shadow-md transition-all">
                            <img src="/images/agency/1.png" alt="Agency Partner" class="h-9 w-auto max-w-[130px] object-contain transition-transform hover:scale-105" />
                        </div>
                        @endif

                        @if (file_exists(public_path('images/agency/2.png')))
                        <div class="flex items-center justify-center h-14 px-5 py-2 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200/60 dark:border-slate-700/60 hover:border-brand-500/50 hover:shadow-md transition-all">
                            <img src="/images/agency/2.png" alt="Agency Partner" class="h-9 w-auto max-w-[130px] object-contain transition-transform hover:scale-105" />
                        </div>
                        @endif

                        @if (file_exists(public_path('images/agency/3.png')))
                        <div class="flex items-center justify-center h-14 px-5 py-2 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200/60 dark:border-slate-700/60 hover:border-brand-500/50 hover:shadow-md transition-all">
                            <img src="/images/agency/3.png" alt="Agency Partner" class="h-9 w-auto max-w-[130px] object-contain transition-transform hover:scale-105" />
                        </div>
                        @endif

                        @if (file_exists(public_path('images/ujk/1.png')))
                        <div class="flex items-center justify-center h-14 px-5 py-2 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200/60 dark:border-slate-700/60 hover:border-brand-500/50 hover:shadow-md transition-all">
                            <img src="/images/ujk/1.png" alt="UJK LSP Partner" class="h-10 w-auto max-w-[130px] object-contain transition-transform hover:scale-105" />
                        </div>
                        @endif

                        @if (file_exists(public_path('images/ujk/2.png')))
                        <div class="flex items-center justify-center h-14 px-5 py-2 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200/60 dark:border-slate-700/60 hover:border-brand-500/50 hover:shadow-md transition-all">
                            <img src="/images/ujk/2.png" alt="UJK LSP Partner" class="h-10 w-auto max-w-[130px] object-contain transition-transform hover:scale-105" />
                        </div>
                        @endif

                        <!-- Country Partner Pills -->
                        <div class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200/60 dark:border-slate-700/60">
                            <span class="text-base">🇹🇼</span>
                            <span class="text-xs font-bold text-slate-700 dark:text-slate-300">Taiwan Agency Alliance</span>
                        </div>

                        <div class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200/60 dark:border-slate-700/60">
                            <span class="text-base">🇭🇰</span>
                            <span class="text-xs font-bold text-slate-700 dark:text-slate-300">Hong Kong Partner Network</span>
                        </div>

                        <div class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200/60 dark:border-slate-700/60">
                            <span class="text-base">🇯🇵</span>
                            <span class="text-xs font-bold text-slate-700 dark:text-slate-300">Japan Tokutei & Kaigo Group</span>
                        </div>

                        <div class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200/60 dark:border-slate-700/60">
                            <span class="text-base">🇸🇬</span>
                            <span class="text-xs font-bold text-slate-700 dark:text-slate-300">Singapore MOM Accredited</span>
                        </div>

                        <div class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200/60 dark:border-slate-700/60">
                            <span class="text-base">🇲🇾</span>
                            <span class="text-xs font-bold text-slate-700 dark:text-slate-300">Malaysia Licensed Agency</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 text-center">
                <button type="button" data-modal="modal-1" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl font-bold text-xs sm:text-sm text-brand-600 dark:text-brand-400 hover:text-brand-700 bg-brand-50 dark:bg-brand-950/40 hover:bg-brand-100 dark:hover:bg-brand-900/60 border border-brand-200 dark:border-brand-800 transition-colors">
                    <i class="fa-solid fa-handshake"></i>
                    <span data-i18n="partner_btn">Lihat Daftar Lengkap Rekanan Lembaga Pelatihan & Agensi</span>
                </button>
            </div>
        </div>
    </section>

    <!-- Modern Footer -->
    <footer class="bg-slate-900 text-slate-300 pt-16 pb-12 border-t border-slate-800 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 pb-12 border-b border-slate-800">
                
                <!-- Col 1: Company Profile (2 Cols) -->
                <div class="lg:col-span-2 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-slate-800 p-1.5 flex items-center justify-center border border-slate-700 shadow-md">
                            <img src="/images/logo-darkmode.png" alt="Logo" class="w-full h-full object-contain" />
                        </div>
                        <div>
                            <h3 class="font-display font-extrabold text-lg text-white tracking-tight" translate="no">
                                {{ strtoupper(env('COMPANY_NAME', 'PT. NUSANTARA PORTAL INC.')) }}
                            </h3>
                            <p class="text-[11px] font-semibold text-brand-400 uppercase tracking-wide" data-i18n="footer_sub">
                                Penempatan Pekerja Migran Indonesia Resmi
                            </p>
                        </div>
                    </div>

                    <p class="text-xs text-slate-400 leading-relaxed max-w-sm" data-i18n="footer_desc">
                        Berpengalaman lebih dari 10 tahun menyediakan layanan penempatan tenaga kerja profesional dan terlatih ke berbagai negara di Asia Pasifik dengan jaminan kepatuhan hukum dan perlindungan maksimal.
                    </p>

                    <div class="text-xs text-slate-400 pt-1 space-y-1">
                        <p class="flex items-start gap-2">
                            <i class="fa-solid fa-location-dot text-brand-400 mt-1"></i>
                            <span translate="no">{{ env('COMPANY_ADD', 'Jl. Sudirman No. 123, Jakarta Pusat, Indonesia 10210') }}</span>
                        </p>
                    </div>
                </div>

                <!-- Col 2: Navigasi Cepat -->
                <div>
                    <h4 class="font-display font-bold text-sm text-white uppercase tracking-wider mb-4" data-i18n="footer_col_nav">Navigasi Utama</h4>
                    <ul class="space-y-2.5 text-xs text-slate-400">
                        <li><a href="/" class="hover:text-brand-400 transition-colors" data-i18n="nav_home">Beranda</a></li>
                        <li><button type="button" data-modal="modal-1" class="hover:text-brand-400 transition-colors" data-i18n="nav_company">Profil Perusahaan</button></li>
                        <li><button type="button" data-modal="modal-3" class="hover:text-brand-400 transition-colors" data-i18n="nav_formal">Sektor Formal (Skilled)</button></li>
                        <li><button type="button" data-modal="modal-4" class="hover:text-brand-400 transition-colors" data-i18n="nav_informal">Sektor Informal (Care)</button></li>
                        <li><button type="button" data-modal="modal-2" class="hover:text-brand-400 transition-colors" data-i18n="nav_about">Tentang Kami</button></li>
                        <li><button type="button" data-modal="modal-5" class="hover:text-brand-400 transition-colors" data-i18n="nav_contact">Kontak & Lokasi Kantor</button></li>
                    </ul>
                </div>

                <!-- Col 3: Portal Login Sistem -->
                <div>
                    <h4 class="font-display font-bold text-sm text-white uppercase tracking-wider mb-4" data-i18n="footer_col_portal">Akses Portal</h4>
                    <ul class="space-y-2.5 text-xs text-slate-400">
                        <li>
                            <a href="/admin" class="hover:text-brand-400 transition-colors flex items-center gap-2">
                                <i class="fa-solid fa-user-tie text-[10px] text-brand-400"></i>
                                <span data-i18n="login_staff">Portal Staff Internal</span>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/workers" class="hover:text-brand-400 transition-colors flex items-center gap-2">
                                <i class="fa-solid fa-building-columns text-[10px] text-blue-400"></i>
                                <span data-i18n="login_agency">Portal Agency Luar Negeri</span>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/proses" class="hover:text-brand-400 transition-colors flex items-center gap-2">
                                <i class="fa-solid fa-id-card-clip text-[10px] text-amber-400"></i>
                                <span data-i18n="login_cpmi">Portal Tracking CPMI</span>
                            </a>
                        </li>
                    </ul>

                    <div class="mt-6 p-3 rounded-xl bg-slate-800/80 border border-slate-700/80">
                        <span class="text-[10px] font-bold text-rose-400 uppercase tracking-wider block" data-i18n="footer_sos">Hotline Darurat (SOS)</span>
                        <a href="tel:+622112345671" class="text-xs font-bold text-white hover:text-brand-400 mt-1 block">
                            +62 21 1234 5671
                        </a>
                    </div>
                </div>

                <!-- Col 4: Jam Operasional & Layanan -->
                <div>
                    <h4 class="font-display font-bold text-sm text-white uppercase tracking-wider mb-4" data-i18n="footer_col_hours">Jam Operasional</h4>
                    <div class="space-y-2 text-xs text-slate-400">
                        <div>
                            <span class="text-slate-300 font-semibold block" data-i18n="hours_weekday">Senin - Jumat</span>
                            <span>09:00 - 17:00 WIB</span>
                        </div>
                        <div>
                            <span class="text-slate-300 font-semibold block" data-i18n="hours_saturday">Sabtu</span>
                            <span>09:00 - 13:00 WIB</span>
                        </div>
                        <div>
                            <span class="text-slate-300 font-semibold block" data-i18n="hours_sunday">Minggu & Hari Libur</span>
                            <span class="text-slate-500" data-i18n="hours_closed">Tutup (Khusus Layanan Darurat Aktif)</span>
                        </div>
                    </div>

                    <div class="mt-5 flex items-center gap-3">
                        <a href="https://instagram.com" target="_blank" class="w-8 h-8 rounded-lg bg-slate-800 hover:bg-brand-600 text-slate-300 hover:text-white flex items-center justify-center transition-colors">
                            <i class="fa-brands fa-instagram text-sm"></i>
                        </a>
                        <a href="https://facebook.com" target="_blank" class="w-8 h-8 rounded-lg bg-slate-800 hover:bg-brand-600 text-slate-300 hover:text-white flex items-center justify-center transition-colors">
                            <i class="fa-brands fa-facebook-f text-sm"></i>
                        </a>
                        <a href="https://wa.me/62112345678" target="_blank" class="w-8 h-8 rounded-lg bg-slate-800 hover:bg-emerald-600 text-slate-300 hover:text-white flex items-center justify-center transition-colors">
                            <i class="fa-brands fa-whatsapp text-sm"></i>
                        </a>
                    </div>
                </div>

            </div>

            <!-- Copyright and Legal -->
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-4">
                <p translate="no">
                    &copy; {{ now()->year }} <strong class="text-slate-400">{{ env('COMPANY_NAME', 'PT. Nusantara Portal Inc.') }}</strong>. All Rights Reserved.
                </p>
                <div class="flex items-center gap-4 text-slate-400">
                    <span data-i18n="footer_lic">Sistem Terintegrasi P3MI</span>
                    <span>•</span>
                    <button type="button" data-modal="modal-1" class="hover:text-brand-400 transition-colors" data-i18n="footer_op">Izin Operasional</button>
                    <span>•</span>
                    <button type="button" data-modal="modal-5" class="hover:text-brand-400 transition-colors" data-i18n="nav_contact">Bantuan</button>
                </div>
            </div>
        </div>

        <!-- Background Image Accent -->
        <img src="/images/bg-footer.png" alt="Footer Background" class="absolute bottom-0 right-0 w-80 lg:w-96 opacity-10 pointer-events-none select-none" />
    </footer>

    <!-- MODAL 1: PERUSAHAAN (PROFIL, VISI, MISI, REKANAN) -->
    <div id="modal-1" class="modal" role="dialog" aria-modal="true">
        <div class="modal-box w-full max-w-4xl bg-white dark:bg-slate-900 rounded-3xl shadow-2xl border border-slate-200 dark:border-slate-800 overflow-hidden flex flex-col">
            <!-- Modal Header -->
            <div class="p-6 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between bg-slate-50/70 dark:bg-slate-800/40 sticky top-0 z-10 backdrop-blur-md">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-brand-500/10 text-brand-600 dark:text-brand-400 flex items-center justify-center text-lg">
                        <i class="fa-solid fa-building-flag"></i>
                    </div>
                    <div>
                        <h3 class="font-display font-extrabold text-lg text-slate-900 dark:text-white" translate="no">
                            {{ strtoupper(env('COMPANY_NAME', 'PT. NUSANTARA PORTAL INC.')) }}
                        </h3>
                        <p class="text-xs text-brand-600 dark:text-brand-400 font-semibold" data-i18n="m1_subtitle">Profil Lengkap, Visi Misi & Rekanan Resmi</p>
                    </div>
                </div>
                <button type="button" class="close-modal w-9 h-9 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-500 hover:text-slate-800 dark:hover:text-white flex items-center justify-center transition-colors">
                    <i class="fa-solid fa-xmark text-base"></i>
                </button>
            </div>

            <!-- Modal Content Scrollable -->
            <div class="p-6 sm:p-8 overflow-y-auto space-y-8 text-slate-700 dark:text-slate-300 text-sm">
                <!-- Logo & Headline -->
                <div class="flex flex-col sm:flex-row items-center gap-6 p-6 rounded-2xl bg-brand-50/60 dark:bg-brand-950/30 border border-brand-200/60 dark:border-brand-800/60">
                    <img src="/images/logo.png" alt="Logo" class="h-20 w-auto object-contain" />
                    <div>
                        <h4 class="font-display font-bold text-base text-slate-900 dark:text-white" data-i18n="m1_heading">Komitmen Mutu & Perlindungan Tenaga Kerja</h4>
                        <p class="text-xs text-slate-600 dark:text-slate-300 mt-1 leading-relaxed" data-i18n="m1_desc">
                            Perusahaan berfokus pada penyediaan tenaga kerja berkualitas tinggi ke pasar kerja internasional. Kami menjamin kepatuhan penuh terhadap regulasi ketenagakerjaan serta perlindungan menyeluruh hak-hak pekerja migran Indonesia.
                        </p>
                    </div>
                </div>

                <!-- Visi & Misi Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="p-5 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-800">
                        <div class="flex items-center gap-2.5 text-brand-600 dark:text-brand-400 font-bold mb-3">
                            <i class="fa-solid fa-bullseye text-base"></i>
                            <h4 class="font-display text-base" data-i18n="m1_visi_title">Visi Perusahaan</h4>
                        </div>
                        <p class="text-xs leading-relaxed text-slate-600 dark:text-slate-300" data-i18n="m1_visi_desc">
                            Menjadi perusahaan penempatan pekerja migran terkemuka yang mendukung kemandirian dan kesejahteraan tenaga kerja Indonesia di panggung global, serta berkontribusi nyata pada peningkatan perekonomian nasional melalui penempatan tenaga kerja berkualitas.
                        </p>
                    </div>

                    <div class="p-5 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-800">
                        <div class="flex items-center gap-2.5 text-brand-600 dark:text-brand-400 font-bold mb-3">
                            <i class="fa-solid fa-list-check text-base"></i>
                            <h4 class="font-display text-base" data-i18n="m1_misi_title">Misi Perusahaan</h4>
                        </div>
                        <ul class="text-xs space-y-2 text-slate-600 dark:text-slate-300">
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-check text-brand-500 mt-0.5"></i>
                                <span data-i18n="m1_m1">Menyediakan tenaga kerja terampil sesuai kebutuhan pasar kerja internasional.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-check text-brand-500 mt-0.5"></i>
                                <span data-i18n="m1_m2">Menjamin proses perekrutan transparan, adil, dan taat hukum pemerintah RI.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-check text-brand-500 mt-0.5"></i>
                                <span data-i18n="m1_m3">Memberikan perlindungan terpadu pra, selama, hingga purna penempatan kerja.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-check text-brand-500 mt-0.5"></i>
                                <span data-i18n="m1_m4">Membangun kemitraan strategis berkesinambungan dengan agensi tepercaya dunia.</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Izin Resmi Banner -->
                <div class="p-5 rounded-2xl bg-emerald-50 dark:bg-emerald-950/30 border border-emerald-200 dark:border-emerald-800/60 text-emerald-900 dark:text-emerald-200">
                    <div class="flex items-center gap-2 font-bold mb-1">
                        <i class="fa-solid fa-circle-check text-emerald-600 dark:text-emerald-400 text-base"></i>
                        <span data-i18n="m1_lic_title">Legalitas & Perizinan Berusaha Resmi</span>
                    </div>
                    <p class="text-xs leading-relaxed text-emerald-800 dark:text-emerald-300" data-i18n="m1_lic_desc">
                        Kami telah berizin resmi dari <strong>BP2MI</strong>, <strong>Kementerian Ketenagakerjaan Republik Indonesia</strong>, dan terdaftar dalam sistem <strong>Online Single Submission (OSS)</strong> untuk operasional perekrutan dan penempatan PMI ke luar negeri.
                    </p>
                </div>

                <!-- Partner Tables -->
                <div>
                    <h4 class="font-display font-bold text-base text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-handshake text-brand-500"></i>
                        <span data-i18n="m1_partner_heading">Daftar Rekanan Lembaga Pelatihan & Agensi Luar Negeri</span>
                    </h4>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Pelatihan Table -->
                        <div class="rounded-2xl border border-slate-200 dark:border-slate-800 overflow-hidden bg-white dark:bg-slate-900 shadow-sm flex flex-col">
                            <div class="px-4 py-3 bg-slate-100 dark:bg-slate-800 font-bold text-xs text-slate-800 dark:text-white uppercase tracking-wider flex items-center justify-between">
                                <span data-i18n="m1_tab_lpk">Lembaga Pelatihan & Sertifikasi (LPK/LSP)</span>
                                <span class="text-[10px] bg-brand-500 text-white px-2 py-0.5 rounded-full">{{ $pelatihan->count() }} Mitra</span>
                            </div>
                            <!-- 2 Baris Terbuka (Sharp & Clear) -->
                            <div class="divide-y divide-slate-100 dark:divide-slate-800">
                                @forelse ($pelatihan->take(2) as $item)
                                <div class="p-3 text-xs hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors">
                                    <div class="font-bold text-slate-800 dark:text-white flex items-center gap-1.5">
                                        <i class="fa-solid fa-circle-check text-brand-500 text-[10px]"></i>
                                        <span>{{ $item->nama }}</span>
                                    </div>
                                    <div class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5 pl-4">{{ $item->alamat }}</div>
                                </div>
                                @empty
                                <div class="p-4 text-xs text-slate-400 text-center" data-i18n="m1_no_lpk">Data mitra pelatihan belum tersedia.</div>
                                @endforelse
                            </div>

                            <!-- Sisanya di-blur (Blurred Preview Rows) -->
                            <div class="relative overflow-hidden border-t border-slate-100 dark:border-slate-800 min-h-[96px] flex items-center justify-center">
                                <div class="w-full divide-y divide-slate-100 dark:divide-slate-800 filter blur-[4px] opacity-35 select-none pointer-events-none p-1">
                                    @if($pelatihan->count() > 2)
                                        @foreach ($pelatihan->slice(2)->take(2) as $item)
                                        <div class="p-2.5 text-xs">
                                            <div class="font-bold text-slate-800 dark:text-white">{{ $item->nama }}</div>
                                            <div class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5">{{ $item->alamat }}</div>
                                        </div>
                                        @endforeach
                                    @else
                                        <div class="p-2.5 text-xs">
                                            <div class="font-bold text-slate-800 dark:text-white">LPK Pratama Mandiri International</div>
                                            <div class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5">Balai Diklat Bahasa & Keterampilan Vokasi Terpadu</div>
                                        </div>
                                        <div class="p-2.5 text-xs">
                                            <div class="font-bold text-slate-800 dark:text-white">LSP Tenaga Kerja Global Indonesia</div>
                                            <div class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5">Sentra Uji Kompetensi Teknis & Sertifikasi BNSP</div>
                                        </div>
                                    @endif
                                </div>
                                <!-- Frosted Overlay with Detail / Login CTA -->
                                <div class="absolute inset-0 bg-white/75 dark:bg-slate-900/75 backdrop-blur-[2px] flex flex-col items-center justify-center p-3 text-center">
                                    <div class="text-[11px] font-semibold text-slate-700 dark:text-slate-300 mb-1.5 flex items-center gap-1.5">
                                        <i class="fa-solid fa-lock text-brand-600 dark:text-brand-400 text-xs"></i>
                                        <span data-i18n="m1_blur_info">Daftar Lengkap Terkunci</span>
                                    </div>
                                    <a href="/admin" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg font-bold text-xs text-white bg-brand-600 hover:bg-brand-700 shadow-md shadow-brand-500/25 hover:scale-[1.02] active:scale-[0.98] transition-all">
                                        <i class="fa-solid fa-arrow-right-to-bracket text-xs"></i>
                                        <span data-i18n="m1_blur_btn">Detail (Login)</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Agency Table -->
                        <div class="rounded-2xl border border-slate-200 dark:border-slate-800 overflow-hidden bg-white dark:bg-slate-900 shadow-sm flex flex-col">
                            <div class="px-4 py-3 bg-slate-100 dark:bg-slate-800 font-bold text-xs text-slate-800 dark:text-white uppercase tracking-wider flex items-center justify-between">
                                <span data-i18n="m1_tab_agency">Agensi Penempatan Luar Negeri</span>
                                <span class="text-[10px] bg-blue-500 text-white px-2 py-0.5 rounded-full">{{ $agency->count() }} Mitra</span>
                            </div>
                            <!-- 2 Baris Terbuka (Sharp & Clear) -->
                            <div class="divide-y divide-slate-100 dark:divide-slate-800">
                                @forelse ($agency->take(2) as $item)
                                <div class="p-3 text-xs hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors">
                                    <div class="font-bold text-slate-800 dark:text-white flex items-center gap-1.5">
                                        <i class="fa-solid fa-circle-check text-blue-500 text-[10px]"></i>
                                        <span>{{ $item->nama }}</span>
                                    </div>
                                    <div class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5 pl-4">{{ $item->alamat }}</div>
                                </div>
                                @empty
                                <div class="p-4 text-xs text-slate-400 text-center" data-i18n="m1_no_agency">Data agensi belum tersedia.</div>
                                @endforelse
                            </div>

                            <!-- Sisanya di-blur (Blurred Preview Rows) -->
                            <div class="relative overflow-hidden border-t border-slate-100 dark:border-slate-800 min-h-[96px] flex items-center justify-center">
                                <div class="w-full divide-y divide-slate-100 dark:divide-slate-800 filter blur-[4px] opacity-35 select-none pointer-events-none p-1">
                                    @if($agency->count() > 2)
                                        @foreach ($agency->slice(2)->take(2) as $item)
                                        <div class="p-2.5 text-xs">
                                            <div class="font-bold text-slate-800 dark:text-white">{{ $item->nama }}</div>
                                            <div class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5">{{ $item->alamat }}</div>
                                        </div>
                                        @endforeach
                                    @else
                                        <div class="p-2.5 text-xs">
                                            <div class="font-bold text-slate-800 dark:text-white">Asia Pacific Manpower Resources Co., Ltd.</div>
                                            <div class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5">Central Business District Tower, Hong Kong</div>
                                        </div>
                                        <div class="p-2.5 text-xs">
                                            <div class="font-bold text-slate-800 dark:text-white">Formosa Caregiver & Placement Agency Ltd.</div>
                                            <div class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5">Zhongshan District, Taipei City, Taiwan</div>
                                        </div>
                                    @endif
                                </div>
                                <!-- Frosted Overlay with Detail / Login CTA -->
                                <div class="absolute inset-0 bg-white/75 dark:bg-slate-900/75 backdrop-blur-[2px] flex flex-col items-center justify-center p-3 text-center">
                                    <div class="text-[11px] font-semibold text-slate-700 dark:text-slate-300 mb-1.5 flex items-center gap-1.5">
                                        <i class="fa-solid fa-lock text-blue-600 dark:text-blue-400 text-xs"></i>
                                        <span data-i18n="m1_blur_info">Daftar Lengkap Terkunci</span>
                                    </div>
                                    <a href="/admin" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg font-bold text-xs text-white bg-blue-600 hover:bg-blue-700 shadow-md shadow-blue-500/25 hover:scale-[1.02] active:scale-[0.98] transition-all">
                                        <i class="fa-solid fa-arrow-right-to-bracket text-xs"></i>
                                        <span data-i18n="m1_blur_btn">Detail (Login)</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Notice Bar -->
                    <div class="mt-4 p-3 rounded-xl bg-slate-50 dark:bg-slate-800/40 border border-slate-200 dark:border-slate-800 text-center text-xs text-slate-500 dark:text-slate-400 flex flex-wrap items-center justify-center gap-2">
                        <i class="fa-solid fa-shield-halved text-brand-600 dark:text-brand-400 text-xs"></i>
                        <span data-i18n="m1_footer_notice">Untuk akses database lengkap kemitraan & legalitas kerja sama resmi, silakan</span>
                        <a href="/admin" class="font-bold text-brand-600 dark:text-brand-400 hover:underline inline-flex items-center gap-1">
                            <span data-i18n="m1_footer_login_link">Login ke Portal</span>
                            <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="p-4 bg-slate-50 dark:bg-slate-800/50 border-t border-slate-200 dark:border-slate-800 flex justify-end">
                <button type="button" class="close-modal px-5 py-2.5 rounded-xl font-bold text-xs text-white bg-brand-600 hover:bg-brand-700 transition-colors" data-i18n="btn_close">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- MODAL 2: TENTANG KAMI (SEJARAH, SAMBUTAN DIREKSI) -->
    <div id="modal-2" class="modal" role="dialog" aria-modal="true">
        <div class="modal-box w-full max-w-3xl bg-white dark:bg-slate-900 rounded-3xl shadow-2xl border border-slate-200 dark:border-slate-800 overflow-hidden flex flex-col">
            <!-- Modal Header -->
            <div class="p-6 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between bg-slate-50/70 dark:bg-slate-800/40 sticky top-0 z-10 backdrop-blur-md">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-500/10 text-amber-600 dark:text-amber-400 flex items-center justify-center text-lg">
                        <i class="fa-solid fa-landmark"></i>
                    </div>
                    <div>
                        <h3 class="font-display font-extrabold text-lg text-slate-900 dark:text-white" data-i18n="m2_title">Tentang Perusahaan Kami</h3>
                        <p class="text-xs text-amber-600 dark:text-amber-400 font-semibold" data-i18n="m2_subtitle">Sejarah, Integritas, dan Dedikasi</p>
                    </div>
                </div>
                <button type="button" class="close-modal w-9 h-9 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-500 hover:text-slate-800 dark:hover:text-white flex items-center justify-center transition-colors">
                    <i class="fa-solid fa-xmark text-base"></i>
                </button>
            </div>

            <!-- Modal Content Scrollable -->
            <div class="p-6 sm:p-8 overflow-y-auto space-y-6 text-slate-700 dark:text-slate-300 text-sm">
                <div class="text-center pb-4 border-b border-slate-100 dark:border-slate-800">
                    <img src="/images/logo.png" alt="Logo" class="h-20 w-auto mx-auto object-contain mb-3" />
                    <h4 class="font-display font-extrabold text-xl text-slate-900 dark:text-white" translate="no">
                        {{ strtoupper(env('COMPANY_NAME', 'PT. NUSANTARA PORTAL INC.')) }}
                    </h4>
                    <p class="text-xs text-brand-600 dark:text-brand-400 font-bold uppercase mt-1" data-i18n="m2_history_tag">
                        Dedikasi Lebih Dari 10 Tahun Membina Tenaga Kerja Unggul
                    </p>
                </div>

                <div class="prose dark:prose-invert max-w-none text-xs sm:text-sm space-y-4 leading-relaxed">
                    <p class="text-justify" data-i18n="m2_p1">
                        Kami adalah perusahaan yang memiliki lebih dari satu dekade pengalaman dalam menyediakan layanan penempatan tenaga kerja profesional ke berbagai negara di seluruh dunia. Dengan rekam jejak yang solid, kami fokus pada penyediaan tenaga kerja terlatih dan berkualitas tinggi, telah membantu ribuan pekerja Indonesia mendapatkan pekerjaan yang layak, aman, dan berpenghasilan kompetitif di luar negeri.
                    </p>
                    <p class="text-justify" data-i18n="m2_p2">
                        Kami menjalin kemitraan erat dengan agensi internasional resmi dan terakreditasi untuk memastikan seluruh alur perekrutan berlangsung secara jujur, adil, transparan, serta selaras dengan regulasi hukum yang berlaku. Setiap tahap penempatan didasarkan pada standar etika kerja tinggi dan perlindungan penuh hak-hak asasi pekerja migran.
                    </p>
                </div>

                <!-- Sambutan Direksi -->
                <div class="p-6 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-800">
                    <span class="text-[10px] font-bold text-brand-600 dark:text-brand-400 uppercase tracking-widest block mb-2" data-i18n="m2_director_tag">Pesan Direktur Utama</span>
                    <p class="text-xs sm:text-sm italic text-slate-600 dark:text-slate-300 leading-relaxed" data-i18n="m2_quote">
                        "Pekerja Migran Indonesia adalah pahlawan devisa sekaligus duta bangsa. Komitmen kami tidak sekadar memberangkatkan, namun memastikan setiap pekerja dibekali keterampilan yang mumpuni, dilindungi hak-haknya, dan pulang membawa kesejahteraan bagi keluarga tercinta."
                    </p>
                    <div class="mt-4 pt-4 border-t border-slate-200 dark:border-slate-700/80">
                        <div class="font-bold text-sm text-slate-900 dark:text-white" translate="no">{{ env('DIRECTUR', 'Pimpinan Direksi') }}</div>
                        <div class="text-xs text-slate-500" data-i18n="m2_position">Direktur Utama - {{ env('COMPANY_NAME', 'PT. Nusantara Portal Inc.') }}</div>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="p-4 bg-slate-50 dark:bg-slate-800/50 border-t border-slate-200 dark:border-slate-800 flex justify-end">
                <button type="button" class="close-modal px-5 py-2.5 rounded-xl font-bold text-xs text-white bg-brand-600 hover:bg-brand-700 transition-colors" data-i18n="btn_close">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- MODAL 3: SEKTOR FORMAL -->
    <div id="modal-3" class="modal" role="dialog" aria-modal="true">
        <div class="modal-box w-full max-w-3xl bg-white dark:bg-slate-900 rounded-3xl shadow-2xl border border-slate-200 dark:border-slate-800 overflow-hidden flex flex-col">
            <!-- Modal Header -->
            <div class="p-6 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between bg-slate-50/70 dark:bg-slate-800/40 sticky top-0 z-10 backdrop-blur-md">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-500/10 text-blue-600 dark:text-blue-400 flex items-center justify-center text-lg">
                        <i class="fa-solid fa-user-gear"></i>
                    </div>
                    <div>
                        <h3 class="font-display font-extrabold text-lg text-slate-900 dark:text-white" data-i18n="m3_title">Program Penempatan Sektor Formal</h3>
                        <p class="text-xs text-blue-600 dark:text-blue-400 font-semibold" data-i18n="m3_subtitle">Skilled & Professional Overseas Workforce</p>
                    </div>
                </div>
                <button type="button" class="close-modal w-9 h-9 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-500 hover:text-slate-800 dark:hover:text-white flex items-center justify-center transition-colors">
                    <i class="fa-solid fa-xmark text-base"></i>
                </button>
            </div>

            <!-- Modal Content Scrollable -->
            <div class="p-6 sm:p-8 overflow-y-auto space-y-6 text-slate-700 dark:text-slate-300 text-sm">
                <!-- Banner Image & Destinasi -->
                <div class="p-5 rounded-2xl bg-blue-50/70 dark:bg-blue-950/40 border border-blue-200/70 dark:border-blue-800/60">
                    <span class="text-[10px] font-bold text-blue-700 dark:text-blue-300 uppercase tracking-widest block mb-1" data-i18n="m_dest_title">Negara Tujuan Penempatan</span>
                    <div class="flex flex-wrap items-center gap-2 mt-2">
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-white dark:bg-slate-800 text-blue-900 dark:text-blue-200 shadow-sm border border-blue-100 dark:border-blue-900">🇯🇵 Jepang (Tokutei Ginou)</span>
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-white dark:bg-slate-800 text-blue-900 dark:text-blue-200 shadow-sm border border-blue-100 dark:border-blue-900">🇰🇷 Korea Selatan (E-9)</span>
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-white dark:bg-slate-800 text-blue-900 dark:text-blue-200 shadow-sm border border-blue-100 dark:border-blue-900">🇹🇼 Taiwan (Manufaktur)</span>
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-white dark:bg-slate-800 text-blue-900 dark:text-blue-200 shadow-sm border border-blue-100 dark:border-blue-900">🇸🇬 Singapura</span>
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-white dark:bg-slate-800 text-blue-900 dark:text-blue-200 shadow-sm border border-blue-100 dark:border-blue-900">🇲🇾 Malaysia</span>
                    </div>
                </div>

                <div>
                    <h4 class="font-display font-bold text-base text-slate-900 dark:text-white mb-3" data-i18n="m3_field_heading">Bidang Pekerjaan Sektor Formal:</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-800">
                            <h5 class="font-bold text-xs text-slate-900 dark:text-white flex items-center gap-2">
                                <i class="fa-solid fa-industry text-blue-500"></i> <span data-i18n="m3_f1_title">Manufaktur & Industri Pabrik</span>
                            </h5>
                            <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-1" data-i18n="m3_f1_desc">Perakitan elektronik, komponen otomotif, pengemasan, dan kontrol kualitas dengan standar K3 ketat.</p>
                        </div>

                        <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-800">
                            <h5 class="font-bold text-xs text-slate-900 dark:text-white flex items-center gap-2">
                                <i class="fa-solid fa-user-doctor text-blue-500"></i> <span data-i18n="m3_f2_title">Tenaga Medis & Perawat</span>
                            </h5>
                            <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-1" data-i18n="m3_f2_desc">Perawat rumah sakit, asisten fisioterapi, dan tenaga klinik dengan kualifikasi bahasa & ijazah relevan.</p>
                        </div>

                        <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-800">
                            <h5 class="font-bold text-xs text-slate-900 dark:text-white flex items-center gap-2">
                                <i class="fa-solid fa-hotel text-blue-500"></i> <span data-i18n="m3_f3_title">Perhotelan & Hospitality</span>
                            </h5>
                            <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-1" data-i18n="m3_f3_desc">Resepsionis, staf jamuan, administrasi perhotelan internasional, dan kuliner terakreditasi.</p>
                        </div>

                        <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-800">
                            <h5 class="font-bold text-xs text-slate-900 dark:text-white flex items-center gap-2">
                                <i class="fa-solid fa-laptop-code text-blue-500"></i> <span data-i18n="m3_f4_title">Teknologi & Jasa Profesional</span>
                            </h5>
                            <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-1" data-i18n="m3_f4_desc">Teknisi jaringan komputer, drafter teknik sipil, perbankan, dan pengolahan data.</p>
                        </div>
                    </div>
                </div>

                <div class="p-4 rounded-xl bg-slate-100 dark:bg-slate-800 text-xs text-slate-600 dark:text-slate-400" data-i18n="m3_advantage">
                    <strong class="text-slate-800 dark:text-slate-200">Keunggulan Sektor Formal:</strong> Kontrak kerja transparan, gaji kompetitif standar negara tujuan, tunjangan kesehatan penuh, dan jenjang karir yang jelas.
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="p-4 bg-slate-50 dark:bg-slate-800/50 border-t border-slate-200 dark:border-slate-800 flex justify-end">
                <button type="button" class="close-modal px-5 py-2.5 rounded-xl font-bold text-xs text-white bg-brand-600 hover:bg-brand-700 transition-colors" data-i18n="btn_close">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- MODAL 4: SEKTOR INFORMAL -->
    <div id="modal-4" class="modal" role="dialog" aria-modal="true">
        <div class="modal-box w-full max-w-3xl bg-white dark:bg-slate-900 rounded-3xl shadow-2xl border border-slate-200 dark:border-slate-800 overflow-hidden flex flex-col">
            <!-- Modal Header -->
            <div class="p-6 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between bg-slate-50/70 dark:bg-slate-800/40 sticky top-0 z-10 backdrop-blur-md">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-lg">
                        <i class="fa-solid fa-hands-holding-child"></i>
                    </div>
                    <div>
                        <h3 class="font-display font-extrabold text-lg text-slate-900 dark:text-white" data-i18n="m4_title">Program Penempatan Sektor Informal</h3>
                        <p class="text-xs text-emerald-600 dark:text-emerald-400 font-semibold" data-i18n="m4_subtitle">Caregiver, Asisten Rumah Tangga, & Pertanian</p>
                    </div>
                </div>
                <button type="button" class="close-modal w-9 h-9 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-500 hover:text-slate-800 dark:hover:text-white flex items-center justify-center transition-colors">
                    <i class="fa-solid fa-xmark text-base"></i>
                </button>
            </div>

            <!-- Modal Content Scrollable -->
            <div class="p-6 sm:p-8 overflow-y-auto space-y-6 text-slate-700 dark:text-slate-300 text-sm">
                <!-- Banner Image & Destinasi -->
                <div class="p-5 rounded-2xl bg-emerald-50/70 dark:bg-emerald-950/40 border border-emerald-200/70 dark:border-emerald-800/60">
                    <span class="text-[10px] font-bold text-emerald-700 dark:text-emerald-300 uppercase tracking-widest block mb-1" data-i18n="m_dest_title">Negara Tujuan Penempatan</span>
                    <div class="flex flex-wrap items-center gap-2 mt-2">
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-white dark:bg-slate-800 text-emerald-900 dark:text-emerald-200 shadow-sm border border-emerald-100 dark:border-emerald-900">🇭🇰 Hong Kong</span>
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-white dark:bg-slate-800 text-emerald-900 dark:text-emerald-200 shadow-sm border border-emerald-100 dark:border-emerald-900">🇹🇼 Taiwan</span>
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-white dark:bg-slate-800 text-emerald-900 dark:text-emerald-200 shadow-sm border border-emerald-100 dark:border-emerald-900">🇸🇬 Singapura</span>
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-white dark:bg-slate-800 text-emerald-900 dark:text-emerald-200 shadow-sm border border-emerald-100 dark:border-emerald-900">🇲🇾 Malaysia</span>
                    </div>
                </div>

                <div>
                    <h4 class="font-display font-bold text-base text-slate-900 dark:text-white mb-3" data-i18n="m4_field_heading">Bidang Pekerjaan Sektor Informal:</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-800">
                            <h5 class="font-bold text-xs text-slate-900 dark:text-white flex items-center gap-2">
                                <i class="fa-solid fa-heart-pulse text-emerald-500"></i> <span data-i18n="m4_f1_title">Caregiver & Pendamping Lansia</span>
                            </h5>
                            <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-1" data-i18n="m4_f1_desc">Perawatan lansia berdedikasi, bantuan aktivitas harian, terapi dasar, dan penanganan medis ringan bersertifikat.</p>
                        </div>

                        <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-800">
                            <h5 class="font-bold text-xs text-slate-900 dark:text-white flex items-center gap-2">
                                <i class="fa-solid fa-broom text-emerald-500"></i> <span data-i18n="m4_f2_title">Asisten Rumah Tangga (Housekeeper)</span>
                            </h5>
                            <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-1" data-i18n="m4_f2_desc">Pengelolaan rumah tangga profesional, memasak masakan khas negara tujuan, pemeliharaan kebersihan dan higienitas.</p>
                        </div>

                        <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-800">
                            <h5 class="font-bold text-xs text-slate-900 dark:text-white flex items-center gap-2">
                                <i class="fa-solid fa-seedling text-emerald-500"></i> <span data-i18n="m4_f3_title">Pertanian & Perkebunan</span>
                            </h5>
                            <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-1" data-i18n="m4_f3_desc">Budidaya tanaman holtikultura, kebun buah modern, dan agrikultur dengan perlindungan kerja resmi.</p>
                        </div>

                        <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-800">
                            <h5 class="font-bold text-xs text-slate-900 dark:text-white flex items-center gap-2">
                                <i class="fa-solid fa-fish text-emerald-500"></i> <span data-i18n="m4_f4_title">Perikanan & Kelautan</span>
                            </h5>
                            <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-1" data-i18n="m4_f4_desc">Awak kapal perikanan tangkap dan budidaya tambak dengan kontrak kerja laut resmi terverifikasi.</p>
                        </div>
                    </div>
                </div>

                <div class="p-4 rounded-xl bg-emerald-50 dark:bg-emerald-950/30 border border-emerald-200 dark:border-emerald-800/60 text-xs text-emerald-800 dark:text-emerald-300" data-i18n="m4_lang_standard">
                    <strong class="font-bold">Standar Pembekalan Bahasa:</strong> Seluruh CPMI sektor informal menjalani pelatihan intensif percakapan harian (Bahasa Kanton, Mandarin, Inggris) dan tata cara etika keluarga majikan.
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="p-4 bg-slate-50 dark:bg-slate-800/50 border-t border-slate-200 dark:border-slate-800 flex justify-end">
                <button type="button" class="close-modal px-5 py-2.5 rounded-xl font-bold text-xs text-white bg-brand-600 hover:bg-brand-700 transition-colors" data-i18n="btn_close">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- MODAL 5: KONTAK, HOTLINE SOS, DAN LOKASI -->
    <div id="modal-5" class="modal" role="dialog" aria-modal="true">
        <div class="modal-box w-full max-w-3xl bg-white dark:bg-slate-900 rounded-3xl shadow-2xl border border-slate-200 dark:border-slate-800 overflow-hidden flex flex-col">
            <!-- Modal Header -->
            <div class="p-6 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between bg-slate-50/70 dark:bg-slate-800/40 sticky top-0 z-10 backdrop-blur-md">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-500/10 text-blue-600 dark:text-blue-400 flex items-center justify-center text-lg">
                        <i class="fa-solid fa-headset"></i>
                    </div>
                    <div>
                        <h3 class="font-display font-extrabold text-lg text-slate-900 dark:text-white" data-i18n="m5_title">Pusat Bantuan & Kontak Kantor</h3>
                        <p class="text-xs text-blue-600 dark:text-blue-400 font-semibold" data-i18n="m5_subtitle">Saluran Resmi Informasi & Kemitraan</p>
                    </div>
                </div>
                <button type="button" class="close-modal w-9 h-9 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-500 hover:text-slate-800 dark:hover:text-white flex items-center justify-center transition-colors">
                    <i class="fa-solid fa-xmark text-base"></i>
                </button>
            </div>

            <!-- Modal Content Scrollable -->
            <div class="p-6 sm:p-8 overflow-y-auto space-y-6 text-slate-700 dark:text-slate-300 text-sm">
                <!-- SOS Emergency Callout -->
                <div class="p-5 rounded-2xl bg-rose-50 dark:bg-rose-950/40 border border-rose-200 dark:border-rose-800/60 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-rose-500 text-white flex items-center justify-center text-lg shadow-sm">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm text-rose-900 dark:text-rose-200" data-i18n="m5_sos_title">Hotline Bantuan Darurat (SOS PMI)</h4>
                            <p class="text-xs text-rose-700 dark:text-rose-300" data-i18n="m5_sos_desc">Siap melayani penanganan kendala pekerja di luar negeri 24 Jam.</p>
                        </div>
                    </div>
                    <a href="tel:+622112345671" class="px-4 py-2 rounded-xl bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold transition-colors" data-i18n="m5_sos_btn">
                        Hubungi SOS
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Alamat Kantor -->
                    <div class="p-5 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-800 space-y-3">
                        <div class="font-bold text-xs text-slate-900 dark:text-white uppercase tracking-wider flex items-center gap-2">
                            <i class="fa-solid fa-building text-brand-500"></i> <span data-i18n="m5_office_title">Alamat Kantor Resmi</span>
                        </div>
                        <p class="text-xs font-semibold text-slate-800 dark:text-white" translate="no">
                            {{ strtoupper(env('COMPANY_NAME', 'PT. NUSANTARA PORTAL INC.')) }}
                        </p>
                        <p class="text-xs text-slate-500 dark:text-slate-400" translate="no">
                            {{ env('COMPANY_ADD', 'Jl. Sudirman No. 123, Jakarta Pusat, Indonesia 10210') }}
                        </p>

                        <div class="pt-2 border-t border-slate-200 dark:border-slate-700 text-xs space-y-1">
                            <div class="text-slate-500" data-i18n="m5_hours_label">Jam Operasional Kantor:</div>
                            <div class="font-semibold text-slate-700 dark:text-slate-300" data-i18n="m5_hours_1">Senin - Jumat: 09:00 - 17:00 WIB</div>
                            <div class="font-semibold text-slate-700 dark:text-slate-300" data-i18n="m5_hours_2">Sabtu: 09:00 - 13:00 WIB</div>
                        </div>
                    </div>

                    <!-- Saluran Telepon & WhatsApp -->
                    <div class="p-5 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-800 space-y-3">
                        <div class="font-bold text-xs text-slate-900 dark:text-white uppercase tracking-wider flex items-center gap-2">
                            <i class="fa-brands fa-whatsapp text-emerald-500"></i> <span data-i18n="m5_phone_title">Telepon & WhatsApp</span>
                        </div>

                        <div class="space-y-2 text-xs">
                            <div class="flex items-center justify-between p-2 rounded-lg bg-white dark:bg-slate-900 border border-slate-200/60 dark:border-slate-700/60">
                                <div>
                                    <div class="font-bold text-slate-800 dark:text-white">+62 21 1234 5671</div>
                                    <div class="text-[10px] text-rose-500 font-semibold" data-i18n="m5_p1_tag">Saluran Darurat (SOS)</div>
                                </div>
                                <a href="https://wa.me/62112345678" target="_blank" class="text-emerald-600 hover:text-emerald-700 font-bold text-xs flex items-center gap-1">
                                    <i class="fa-brands fa-whatsapp"></i> Chat
                                </a>
                            </div>

                            <div class="flex items-center justify-between p-2 rounded-lg bg-white dark:bg-slate-900 border border-slate-200/60 dark:border-slate-700/60">
                                <div>
                                    <div class="font-bold text-slate-800 dark:text-white">+62 21 1234 5672</div>
                                    <div class="text-[10px] text-slate-400" data-i18n="m5_p2_tag">Pusat Informasi Pendaftaran</div>
                                </div>
                                <a href="https://wa.me/62112345678" target="_blank" class="text-emerald-600 hover:text-emerald-700 font-bold text-xs flex items-center gap-1">
                                    <i class="fa-brands fa-whatsapp"></i> Chat
                                </a>
                            </div>

                            <div class="flex items-center justify-between p-2 rounded-lg bg-white dark:bg-slate-900 border border-slate-200/60 dark:border-slate-700/60">
                                <div>
                                    <div class="font-bold text-slate-800 dark:text-white">+62 21 1234 5673</div>
                                    <div class="text-[10px] text-blue-500 font-semibold" data-i18n="m5_p3_tag">Kemitraan & Agensi Luar Negeri</div>
                                </div>
                                <a href="https://wa.me/62112345678" target="_blank" class="text-emerald-600 hover:text-emerald-700 font-bold text-xs flex items-center gap-1">
                                    <i class="fa-brands fa-whatsapp"></i> Chat
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="p-4 bg-slate-50 dark:bg-slate-800/50 border-t border-slate-200 dark:border-slate-800 flex justify-end">
                <button type="button" class="close-modal px-5 py-2.5 rounded-xl font-bold text-xs text-white bg-brand-600 hover:bg-brand-700 transition-colors" data-i18n="btn_close">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- Floating Action WhatsApp Button -->
    <a href="https://wa.me/62112345678" target="_blank" aria-label="Konsultasi WhatsApp" class="fixed bottom-8 right-6 z-40 flex items-center gap-2.5 px-4 py-3 rounded-full bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-xs shadow-xl shadow-emerald-500/30 hover:scale-105 transition-all duration-200 group">
        <i class="fa-brands fa-whatsapp text-xl"></i>
        <span class="hidden sm:inline" data-i18n="float_wa">Konsultasi Penempatan</span>
    </a>

    <!-- Native Client-Side Multilingual Dictionary & Logic -->
    <script>
        const appTranslations = {
            id: {
                nav_home: "Beranda",
                nav_company: "Perusahaan",
                nav_formal: "Formal",
                nav_informal: "Informal",
                nav_about: "Tentang Kami",
                nav_contact: "Kontak",
                nav_login: "LOGIN",
                login_staff: "LOGIN STAFF",
                login_agency: "LOGIN AGENCY",
                login_cpmi: "LOGIN CPMI",
                lang_select_title: "Pilihan Bahasa",
                hero_badge: "Perusahaan Penempatan Resmi & Terakreditasi BP2MI",
                hero_title_1: "Menjembatani Peluang Karir Global yang",
                hero_title_2: "Aman, Legal & Bermartabat",
                hero_desc: "Penyalur resmi Pekerja Migran Indonesia (P3MI) ke negara-negara tujuan Asia Pasifik. Memberikan pembekalan kejuruan, kepastian hukum, dan perlindungan menyeluruh dari pra-pemberangkatan hingga selesai kontrak.",
                hero_btn_explore: "Jelajahi Program Penempatan",
                hero_btn_wa: "Konsultasi Cepat (WhatsApp)",
                hero_btn_legal: "Legalitas & Izin Kami",
                stat_exp: "Tahun Pengalaman",
                stat_legal: "Resmi BP2MI & Kemnaker",
                stat_countries: "Negara Tujuan Utama",
                stat_workers: "Tenaga Kerja Ditempatkan",
                card1_badge: "PROFIL UTAMA",
                card1_sub: "Perusahaan Penempatan Terverifikasi",
                card1_desc: "Memiliki komitmen tinggi terhadap regulasi ketenagakerjaan, menjunjung kepatuhan hukum, dan memberikan pendampingan karir komprehensif bagi calon pekerja migran Indonesia.",
                card1_f1: "Berizin BP2MI",
                card1_f2: "Terdaftar OSS",
                card1_f3: "Mitra Internasional",
                card2_badge: "FORMAL",
                card2_title: "SEKTOR FORMAL",
                card2_desc: "Manufaktur, Tenaga Medis, IT, Hospitality, dan Konstruksi.",
                card3_badge: "INFORMAL",
                card3_title: "SEKTOR INFORMAL",
                card3_desc: "Caregiver Lansia, Housekeeping, Layanan Makanan, & Pertanian.",
                card4_badge: "PROFIL",
                card4_title: "TENTANG KAMI",
                card4_desc: "Rekam jejak 10+ tahun dengan standar perekrutan profesional & etis.",
                card4_link: "Visi, Misi & Komitmen Perusahaan",
                card5_badge: "LAYANAN 24/7",
                card5_title: "HUBUNGI KAMI",
                card5_desc: "Hotline Darurat (SOS), Konsultasi Pendaftaran & Alamat Kantor.",
                card5_link: "WhatsApp & Konsultasi Online",
                sync_badge: "Sistem Resmi Terintegrasi",
                sync_title: "Sinkronisasi & Kepatuhan Regulasi Pemerintah",
                sync_desc: "Operasional penempatan kami terdaftar secara sah dan terhubung langsung dengan ekosistem ketenagakerjaan Republik Indonesia.",
                sub_bp2mi: "Badan Pelindungan PMI",
                sub_kemnaker: "Kementerian Ketenagakerjaan",
                sub_siapkerja: "Ekosistem Ketenagakerjaan",
                sub_karirhub: "Pusat Informasi Lowongan",
                sub_oss: "Perizinan Berusaha Resmi",
                sub_apjati: "Asosiasi Resmi Penempatan",
                sub_bnsp: "Badan Nasional Sertifikasi",
                cand_badge: "Talenta & Tenaga Siap Kerja",
                cand_title: "Kandidat Calon Pekerja Migran Terlatih",
                cand_desc: "Kandidat kami telah melewati seleksi kesehatan, pelatihan bahasa, dan pembekalan kejuruan di Balai Latihan Kerja (BLK) tersertifikasi.",
                cand_btn_agency: "Akses Portal Agency",
                cand_btn_more: "Lihat Seluruh Database Kandidat di Portal Agency",
                ready_status: "Siap Kerja",
                trained_status: "Pelatihan Selesai",
                cert_status: "Sertifikasi N4",
                exp_status: "Berpengalaman",
                cand_verified: "CPMI Terverifikasi",
                cand_complete_docs: "Dokumen Lengkap",
                role_caregiver: "Caregiver Lansia",
                role_housekeeper: "Housekeeper",
                role_operator: "Operator Pabrik",
                role_nurse: "Perawat Khusus",
                role_culinary: "Staf Restoran",
                role_agriculture: "Pertanian Modern",
                role_kaigo: "Caregiver Kaigo",
                role_technician: "Teknisi & Konstruksi",
                why_badge: "Standar Mutu & Perlindungan",
                why_title: "Mengapa Memilih Layanan Penempatan Kami?",
                why_desc: "Kami memprioritaskan transparansi, kepatuhan hukum, dan martabat setiap pekerja migran Indonesia.",
                why_1_title: "100% Legal & Terlindungi",
                why_1_desc: "Seluruh proses mengacu pada regulasi UU Ketenagakerjaan dan standar BP2MI dengan asuransi ketenagakerjaan resmi.",
                why_2_title: "Pelatihan Berstandar BLK",
                why_2_desc: "Pembekalan bahasa, adaptasi budaya, dan keahlian vokasi melalui instruktur kompeten di Balai Latihan Kerja resmi.",
                why_3_title: "Transparansi Digital",
                why_3_desc: "Pelacakan proses CPMI, verifikasi dokumen, dan komunikasi agensi secara real-time melalui portal terintegrasi.",
                why_4_title: "Dukungan & Hotline SOS",
                why_4_desc: "Layanan pendampingan advokasi dan saluran darurat aktif untuk memonitor keselamatan pekerja selama di negara penempatan.",
                partner_badge: "Ekosistem Kemitraan Global",
                partner_title: "Lembaga Pelatihan, Sertifikasi & Agensi Rekanan",
                partner_desc: "Bekerja sama dengan Balai Uji Kompetensi (UJK/LSP) dan Agensi Penempatan Internasional berlisensi terkemuka di luar negeri.",
                partner_btn: "Lihat Daftar Lengkap Rekanan Lembaga Pelatihan & Agensi",
                footer_sub: "Penempatan Pekerja Migran Indonesia Resmi",
                footer_desc: "Berpengalaman lebih dari 10 tahun menyediakan layanan penempatan tenaga kerja profesional dan terlatih ke berbagai negara di Asia Pasifik dengan jaminan kepatuhan hukum dan perlindungan maksimal.",
                footer_col_nav: "Navigasi Utama",
                footer_col_portal: "Akses Portal",
                footer_sos: "Hotline Darurat (SOS)",
                footer_col_hours: "Jam Operasional",
                hours_weekday: "Senin - Jumat",
                hours_saturday: "Sabtu",
                hours_sunday: "Minggu & Hari Libur",
                hours_closed: "Tutup (Khusus Layanan Darurat Aktif)",
                footer_lic: "Sistem Terintegrasi P3MI",
                footer_op: "Izin Operasional",
                btn_close: "Tutup",
                float_wa: "Konsultasi Penempatan",
                m1_subtitle: "Profil Lengkap, Visi Misi & Rekanan Resmi",
                m1_heading: "Komitmen Mutu & Perlindungan Tenaga Kerja",
                m1_desc: "Perusahaan berfokus pada penyediaan tenaga kerja berkualitas tinggi ke pasar kerja internasional. Kami menjamin kepatuhan penuh terhadap regulasi ketenagakerjaan serta perlindungan menyeluruh hak-hak pekerja migran Indonesia.",
                m1_visi_title: "Visi Perusahaan",
                m1_visi_desc: "Menjadi perusahaan penempatan pekerja migran terkemuka yang mendukung kemandirian dan kesejahteraan tenaga kerja Indonesia di panggung global, serta berkontribusi nyata pada peningkatan perekonomian nasional melalui penempatan tenaga kerja berkualitas.",
                m1_misi_title: "Misi Perusahaan",
                m1_m1: "Menyediakan tenaga kerja terampil sesuai kebutuhan pasar kerja internasional.",
                m1_m2: "Menjamin proses perekrutan transparan, adil, dan taat hukum pemerintah RI.",
                m1_m3: "Memberikan perlindungan terpadu pra, selama, hingga purna penempatan kerja.",
                m1_m4: "Membangun kemitraan strategis berkesinambungan dengan agensi tepercaya dunia.",
                m1_lic_title: "Legalitas & Perizinan Berusaha Resmi",
                m1_lic_desc: "Kami telah berizin resmi dari BP2MI, Kementerian Ketenagakerjaan Republik Indonesia, dan terdaftar dalam sistem Online Single Submission (OSS) untuk operasional perekrutan dan penempatan PMI ke luar negeri.",
                m1_partner_heading: "Daftar Rekanan Lembaga Pelatihan & Agensi Luar Negeri",
                m1_tab_lpk: "Lembaga Pelatihan & Sertifikasi (LPK/LSP)",
                m1_tab_agency: "Agensi Penempatan Luar Negeri",
                m1_no_lpk: "Data mitra pelatihan belum tersedia.",
                m1_no_agency: "Data agensi belum tersedia.",
                m1_blur_info: "Daftar Lengkap Terkunci",
                m1_blur_btn: "Detail (Login)",
                m1_footer_notice: "Untuk akses database lengkap kemitraan & legalitas kerja sama resmi, silakan",
                m1_footer_login_link: "Login ke Portal",
                m2_title: "Tentang Perusahaan Kami",
                m2_subtitle: "Sejarah, Integritas, dan Dedikasi",
                m2_history_tag: "Dedikasi Lebih Dari 10 Tahun Membina Tenaga Kerja Unggul",
                m2_p1: "Kami adalah perusahaan yang memiliki lebih dari satu dekade pengalaman dalam menyediakan layanan penempatan tenaga kerja profesional ke berbagai negara di seluruh dunia. Dengan rekam jejak yang solid, kami fokus pada penyediaan tenaga kerja terlatih dan berkualitas tinggi, telah membantu ribuan pekerja Indonesia mendapatkan pekerjaan yang layak, aman, dan berpenghasilan kompetitif di luar negeri.",
                m2_p2: "Kami menjalin kemitraan erat dengan agensi internasional resmi dan terakreditasi untuk memastikan seluruh alur perekrutan berlangsung secara jujur, adil, transparan, serta selaras dengan regulasi hukum yang berlaku. Setiap tahap penempatan didasarkan pada standar etika kerja tinggi dan perlindungan penuh hak-hak asasi pekerja migran.",
                m2_director_tag: "Pesan Direktur Utama",
                m2_quote: "\"Pekerja Migran Indonesia adalah pahlawan devisa sekaligus duta bangsa. Komitmen kami tidak sekadar memberangkatkan, namun memastikan setiap pekerja dibekali keterampilan yang mumpuni, dilindungi hak-haknya, dan pulang membawa kesejahteraan bagi keluarga tercinta.\"",
                m2_position: "Direktur Utama",
                m3_title: "Program Penempatan Sektor Formal",
                m3_subtitle: "Skilled & Professional Overseas Workforce",
                m_dest_title: "Negara Tujuan Penempatan",
                m3_field_heading: "Bidang Pekerjaan Sektor Formal:",
                m3_f1_title: "Manufaktur & Industri Pabrik",
                m3_f1_desc: "Perakitan elektronik, komponen otomotif, pengemasan, dan kontrol kualitas dengan standar K3 ketat.",
                m3_f2_title: "Tenaga Medis & Perawat",
                m3_f2_desc: "Perawat rumah sakit, asisten fisioterapi, dan tenaga klinik dengan kualifikasi bahasa & ijazah relevan.",
                m3_f3_title: "Perhotelan & Hospitality",
                m3_f3_desc: "Resepsionis, staf jamuan, administrasi perhotelan internasional, dan kuliner terakreditasi.",
                m3_f4_title: "Teknologi & Jasa Profesional",
                m3_f4_desc: "Teknisi jaringan komputer, drafter teknik sipil, perbankan, dan pengolahan data.",
                m3_advantage: "Keunggulan Sektor Formal: Kontrak kerja transparan, gaji kompetitif standar negara tujuan, tunjangan kesehatan penuh, dan jenjang karir yang jelas.",
                m4_title: "Program Penempatan Sektor Informal",
                m4_subtitle: "Caregiver, Asisten Rumah Tangga, & Pertanian",
                m4_field_heading: "Bidang Pekerjaan Sektor Informal:",
                m4_f1_title: "Caregiver & Pendamping Lansia",
                m4_f1_desc: "Perawatan lansia berdedikasi, bantuan aktivitas harian, terapi dasar, dan penanganan medis ringan bersertifikat.",
                m4_f2_title: "Asisten Rumah Tangga (Housekeeper)",
                m4_f2_desc: "Pengelolaan rumah tangga profesional, memasak masakan khas negara tujuan, pemeliharaan kebersihan dan higienitas.",
                m4_f3_title: "Pertanian & Perkebunan",
                m4_f3_desc: "Budidaya tanaman holtikultura, kebun buah modern, dan agrikultur dengan perlindungan kerja resmi.",
                m4_f4_title: "Perikanan & Kelautan",
                m4_f4_desc: "Awak kapal perikanan tangkap dan budidaya tambak dengan kontrak kerja laut resmi terverifikasi.",
                m4_lang_standard: "Standar Pembekalan Bahasa: Seluruh CPMI sektor informal menjalani pelatihan intensif percakapan harian (Bahasa Kanton, Mandarin, Inggris) dan tata cara etika keluarga majikan.",
                m5_title: "Pusat Bantuan & Kontak Kantor",
                m5_subtitle: "Saluran Resmi Informasi & Kemitraan",
                m5_sos_title: "Hotline Bantuan Darurat (SOS PMI)",
                m5_sos_desc: "Siap melayani penanganan kendala pekerja di luar negeri 24 Jam.",
                m5_sos_btn: "Hubungi SOS",
                m5_office_title: "Alamat Kantor Resmi",
                m5_hours_label: "Jam Operasional Kantor:",
                m5_hours_1: "Senin - Jumat: 09:00 - 17:00 WIB",
                m5_hours_2: "Sabtu: 09:00 - 13:00 WIB",
                m5_phone_title: "Telepon & WhatsApp",
                m5_p1_tag: "Saluran Darurat (SOS)",
                m5_p2_tag: "Pusat Informasi Pendaftaran",
                m5_p3_tag: "Kemitraan & Agensi Luar Negeri",
            },
            en: {
                nav_home: "Home",
                nav_company: "Company",
                nav_formal: "Formal",
                nav_informal: "Informal",
                nav_about: "About Us",
                nav_contact: "Contact",
                nav_login: "LOGIN",
                login_staff: "STAFF LOGIN",
                login_agency: "AGENCY LOGIN",
                login_cpmi: "WORKER LOGIN",
                lang_select_title: "Select Language",
                hero_badge: "Official & BP2MI Accredited Placement Company",
                hero_title_1: "Bridging Global Career Opportunities that are",
                hero_title_2: "Safe, Legal & Dignified",
                hero_desc: "Official Indonesian Migrant Worker Placement Company (P3MI) connecting skilled talents to Asia-Pacific destinations with vocational training, legal certainty, and complete worker protection.",
                hero_btn_explore: "Explore Placement Programs",
                hero_btn_wa: "Quick Consultation (WhatsApp)",
                hero_btn_legal: "Licenses & Legal Accreditation",
                stat_exp: "Years of Experience",
                stat_legal: "BP2MI & Ministry Certified",
                stat_countries: "Major Destination Countries",
                stat_workers: "Workers Successfully Placed",
                card1_badge: "CORE PROFILE",
                card1_sub: "Verified Placement Company",
                card1_desc: "Committed to international labor standards, legal compliance, and full career guidance for Indonesian overseas workers.",
                card1_f1: "BP2MI Licensed",
                card1_f2: "OSS Registered",
                card1_f3: "Global Partners",
                card2_badge: "FORMAL",
                card2_title: "FORMAL SECTOR",
                card2_desc: "Manufacturing, Healthcare, IT, Hospitality, and Construction.",
                card3_badge: "INFORMAL",
                card3_title: "INFORMAL SECTOR",
                card3_desc: "Elderly Caregivers, Housekeeping, Food Services, and Agriculture.",
                card4_badge: "PROFILE",
                card4_title: "ABOUT US",
                card4_desc: "10+ years track record of ethical, professional recruitment standards.",
                card4_link: "Vision, Mission & Corporate Values",
                card5_badge: "24/7 SUPPORT",
                card5_title: "CONTACT US",
                card5_desc: "Emergency SOS Hotline, Registration Inquiries & Office Address.",
                card5_link: "WhatsApp & Online Inquiries",
                sync_badge: "Officially Integrated Systems",
                sync_title: "Government Compliance & System Synchronization",
                sync_desc: "Our placement operations are officially certified and directly synchronized with the Indonesian Ministry of Manpower ecosystem.",
                sub_bp2mi: "Indonesian Migrant Worker Protection Agency",
                sub_kemnaker: "Ministry of Manpower of the Republic of Indonesia",
                sub_siapkerja: "Digital Employment Ecosystem",
                sub_karirhub: "National Career Center Portal",
                sub_oss: "Official Business Licensing System",
                sub_apjati: "Official Placement Association",
                sub_bnsp: "National Professional Certification",
                cand_badge: "Qualified & Ready Talents",
                cand_title: "Certified Indonesian Candidate Pool",
                cand_desc: "Our candidates undergo strict medical checkups, language proficiency courses, and practical skill training in certified vocational training centers.",
                cand_btn_agency: "Access Agency Portal",
                cand_btn_more: "View Complete Candidate Database in Agency Portal",
                ready_status: "Ready to Work",
                trained_status: "Training Completed",
                cert_status: "Certified N4",
                exp_status: "Experienced",
                cand_verified: "Verified Candidate",
                cand_complete_docs: "Complete Documents",
                role_caregiver: "Elderly Caregiver",
                role_housekeeper: "Housekeeper",
                role_operator: "Factory Operator",
                role_nurse: "Specialized Nurse",
                role_culinary: "Restaurant Staff",
                role_agriculture: "Modern Agriculture",
                role_kaigo: "Kaigo Elderly Caregiver",
                role_technician: "Technician & Construction",
                why_badge: "Standards & Worker Protection",
                why_title: "Why Choose Our Placement Services?",
                why_desc: "We prioritize transparency, regulatory compliance, and the dignity of every Indonesian worker.",
                why_1_title: "100% Legal & Insured",
                why_1_desc: "Compliant with Manpower Regulations and BP2MI standards, including full official overseas employment insurance.",
                why_2_title: "Certified Training Centers",
                why_2_desc: "Intensive language training, cultural orientation, and practical vocational education led by certified instructors.",
                why_3_title: "Digital Transparency",
                why_3_desc: "Real-time candidate progress tracking, document verification, and overseas agency coordination through our online portal.",
                why_4_title: "24/7 SOS Emergency Support",
                why_4_desc: "Continuous advocacy and emergency helpline to ensure worker safety throughout their placement contract.",
                partner_badge: "Global Partnership Network",
                partner_title: "Training Institutes, Certifications & Overseas Agencies",
                partner_desc: "Partnering with Competency Certification Bodies (LSP) and premier licensed overseas employment agencies.",
                partner_btn: "View Complete Partner Directory of Institutes & Agencies",
                footer_sub: "Official Indonesian Migrant Worker Placement Agency",
                footer_desc: "Over 10 years of dedication providing skilled and professional overseas human resources with guaranteed legal compliance and maximum protection.",
                footer_col_nav: "Quick Navigation",
                footer_col_portal: "Portal Access",
                footer_sos: "Emergency Hotline (SOS)",
                footer_col_hours: "Office Hours",
                hours_weekday: "Monday - Friday",
                hours_saturday: "Saturday",
                hours_sunday: "Sunday & Holidays",
                hours_closed: "Closed (Emergency SOS Line Active)",
                footer_lic: "P3MI Integrated Platform",
                footer_op: "Operational Licenses",
                btn_close: "Close",
                float_wa: "Placement Inquiries",
                m1_subtitle: "Complete Profile, Vision, Mission & Official Partners",
                m1_heading: "Commitment to Quality & Worker Safety",
                m1_desc: "We focus on providing high-quality workforce to the international market while ensuring absolute compliance with labor regulations and full protection of workers' rights.",
                m1_visi_title: "Corporate Vision",
                m1_visi_desc: "To be the leading migrant worker placement company that fosters worker welfare on the global stage and elevates the national economy through skilled human capital.",
                m1_misi_title: "Corporate Mission",
                m1_m1: "Supplying trained and competent workers meeting global industry demands.",
                m1_m2: "Guaranteeing transparent, fair, and legally compliant recruitment processes.",
                m1_m3: "Delivering comprehensive pre-, during, and post-placement protection.",
                m1_m4: "Cultivating sustainable partnerships with trusted overseas agencies.",
                m1_lic_title: "Official Operating Licenses",
                m1_lic_desc: "Officially licensed by BP2MI, Ministry of Manpower RI, and registered on the Online Single Submission (OSS) system.",
                m1_partner_heading: "Registered Vocational Centers & Overseas Agencies",
                m1_tab_lpk: "Vocational & Certification Centers (LPK/LSP)",
                m1_tab_agency: "Overseas Placement Agencies",
                m1_no_lpk: "No training center data available.",
                m1_no_agency: "No agency data available.",
                m1_blur_info: "Full Directory Locked",
                m1_blur_btn: "Details (Log In)",
                m1_footer_notice: "To access the complete directory and verified partnership licenses, please",
                m1_footer_login_link: "Log In to Portal",
                m2_title: "About Our Company",
                m2_subtitle: "History, Integrity & Dedication",
                m2_history_tag: "Over 10 Years of Excellence in Human Resource Placement",
                m2_p1: "With over a decade of solid experience, we have helped thousands of Indonesian workers secure safe, decent, and prosperous jobs worldwide.",
                m2_p2: "We maintain close cooperation with international partners to ensure fair, transparent, and ethical recruitment at every single phase.",
                m2_director_tag: "President Director's Message",
                m2_quote: "\"Indonesian Migrant Workers are national ambassadors and economic heroes. Our mission is not merely placement, but ensuring every individual is equipped with certified skills, protected, and returns home with dignity and prosperity.\"",
                m2_position: "President Director",
                m3_title: "Formal Sector Placement Program",
                m3_subtitle: "Skilled & Professional Overseas Workforce",
                m_dest_title: "Destination Countries",
                m3_field_heading: "Formal Employment Sectors:",
                m3_f1_title: "Manufacturing & Factory Industry",
                m3_f1_desc: "Electronics assembly, automotive parts, packaging, and quality control under strict safety regulations.",
                m3_f2_title: "Healthcare & Nursing",
                m3_f2_desc: "Hospital nurses, physical therapists, and clinic staff with verified qualifications and language certificates.",
                m3_f3_title: "Hospitality & Tourism",
                m3_f3_desc: "Hotel receptionists, banquet crews, international hospitality management, and certified culinary chefs.",
                m3_f4_title: "IT & Professional Services",
                m3_f4_desc: "Network engineers, architectural drafters, banking specialists, and data operations.",
                m3_advantage: "Formal Sector Advantages: Clear contracts, competitive wages according to host country standards, health insurance, and defined career growth.",
                m4_title: "Informal Sector Placement Program",
                m4_subtitle: "Caregiver, Housekeeper & Agriculture",
                m4_field_heading: "Informal Employment Sectors:",
                m4_f1_title: "Elderly Caregiver & Companionship",
                m4_f1_desc: "Dedicated elder care, daily mobility support, primary physiotherapy, and certified first-aid assistance.",
                m4_f2_title: "Domestic Housekeeper",
                m4_f2_desc: "Professional home management, host-country cuisine preparation, hygiene, and household organization.",
                m4_f3_title: "Agriculture & Plantation",
                m4_f3_desc: "Horticulture cultivation, modern fruit orchards, and farming with regulated agricultural labor protections.",
                m4_f4_title: "Marine & Fisheries",
                m4_f4_desc: "Fishing vessel crews and aquaculture farming backed by verified maritime labor agreements.",
                m4_lang_standard: "Language Training Standard: All candidates undergo intensive conversational training (Cantonese, Mandarin, English) and host family cultural orientation.",
                m5_title: "Help Center & Office Inquiries",
                m5_subtitle: "Official Information & Partnership Channels",
                m5_sos_title: "Emergency Worker Hotline (SOS PMI)",
                m5_sos_desc: "Active 24/7 emergency response for worker protection in destination countries.",
                m5_sos_btn: "Call SOS",
                m5_office_title: "Headquarters Address",
                m5_hours_label: "Office Operational Hours:",
                m5_hours_1: "Monday - Friday: 09:00 - 17:00 WIB",
                m5_hours_2: "Saturday: 09:00 - 13:00 WIB",
                m5_phone_title: "Phone & WhatsApp Support",
                m5_p1_tag: "Emergency Hotline (SOS)",
                m5_p2_tag: "Candidate Registration Center",
                m5_p3_tag: "Overseas Agency Partnerships",
            },
            zh: {
                nav_home: "首頁",
                nav_company: "公司簡介",
                nav_formal: "正式技術",
                nav_informal: "家庭護理",
                nav_about: "關於我們",
                nav_contact: "聯絡我們",
                nav_login: "登入系統",
                login_staff: "內部員工登入",
                login_agency: "國外仲介登入",
                login_cpmi: "候選人進度登入",
                lang_select_title: "選擇語言",
                hero_badge: "印尼勞動部與BP2MI官方認證就業服務機構",
                hero_title_1: "搭建安全、合法且受尊重的",
                hero_title_2: "全球優質就業橋樑",
                hero_desc: "經印尼政府正式核准的海外就業安置機構(P3MI)，為亞太各國雇主媒合優秀印尼勞工，提供完整的語言技能培訓、法規遵循及跨國全程保障。",
                hero_btn_explore: "瀏覽就業派遣項目",
                hero_btn_wa: "線上即時洽詢 (WhatsApp)",
                hero_btn_legal: "官方執照與合法資格",
                stat_exp: "年跨國專業經驗",
                stat_legal: "BP2MI及勞動部認證",
                stat_countries: "主要派遣合作國家",
                stat_workers: "累計成功派遣人才",
                card1_badge: "公司核心",
                card1_sub: "政府審查合格派遣機構",
                card1_desc: "嚴格遵守國際跨國勞動法規，為雇主提供優質適任人才，為印尼勞工提供安全合法的工作權益保障與全程輔導。",
                card1_f1: "BP2MI合法執照",
                card1_f2: "OSS官方登記",
                card1_f3: "全球跨國夥伴",
                card2_badge: "技術行業",
                card2_title: "正式技術行業",
                card2_desc: "製造工廠、醫療護理、資訊科技、觀光餐旅與營建工程。",
                card3_badge: "家政照護",
                card3_title: "家庭與照護服務",
                card3_desc: "長者看護、家庭幫傭管家、餐飲服務與現代化農業。",
                card4_badge: "企業歷程",
                card4_title: "關於我們",
                card4_desc: "超過10年的專業誠信歷程，堅持最高標準的職業倫理與跨國服務品質。",
                card4_link: "公司願景、使命與經營承諾",
                card5_badge: "24小時服務",
                card5_title: "聯絡我們",
                card5_desc: "海外緊急求助熱線(SOS)、招募諮詢與總部地址。",
                card5_link: "WhatsApp線上客服諮詢",
                sync_badge: "官方數據即時同步",
                sync_title: "政府法規遵循與官方數據同步",
                sync_desc: "本機構所有海外派遣作業均依法登記，並與印尼官方就業生態系統即時連線，確保100%程序合法。",
                sub_bp2mi: "印尼海外移工保護局",
                sub_kemnaker: "印尼共和國勞動部",
                sub_siapkerja: "國家就業數位生態系統",
                sub_karirhub: "國家職缺求職資訊中心",
                sub_oss: "官方商業登記許可系統",
                sub_apjati: "官方海外就業服務協會",
                sub_bnsp: "國家職業技能考評認證",
                cand_badge: "考核合格即戰力人才",
                cand_title: "合格認證印尼候選人才庫",
                cand_desc: "所有候選人均通過嚴格健康檢查、語言能力考核與實務技能檢定，具備良好敬業態度與工作能力。",
                cand_btn_agency: "國外仲介專用系統",
                cand_btn_more: "前往仲介專用系統檢視完整人才履歷",
                ready_status: "可立即上工",
                trained_status: "培訓結業",
                cert_status: "日語N4認證",
                exp_status: "具工作經驗",
                cand_verified: "官方審核通過候選人",
                cand_complete_docs: "證件齊全",
                role_caregiver: "高齡長者看護",
                role_housekeeper: "家庭管家幫傭",
                role_operator: "工廠製造作業員",
                role_nurse: "專業護理人員",
                role_culinary: "餐飲服務專員",
                role_agriculture: "現代農業技術人員",
                role_kaigo: "專業機構介護員",
                role_technician: "工程技術與營造技工",
                why_badge: "品質標準與勞工保障",
                why_title: "為什麼選擇我們的派遣服務？",
                why_desc: "我們堅持透明誠信、嚴格守法，並致力維護每一位海外就業者與雇主的合法權益。",
                why_1_title: "100% 合法且全程受保",
                why_1_desc: "完全符合印尼勞動法與BP2MI規定，並享有官方全程海外勞工意外及醫療保險。",
                why_2_title: "標準專業職訓中心",
                why_2_desc: "於官方合格培訓中心由專業師資進行密集語言教學、文化適應指導與實務操作培訓。",
                why_3_title: "數位進度透明查詢",
                why_3_desc: "透過專屬數位系統，即時追蹤審件進度、簽證體檢狀況與海外仲介媒合流程。",
                why_4_title: "24小時緊急求助熱線",
                why_4_desc: "設有跨國緊急救援機制與法律倡導支援，在合約期間持續守護勞工人身安全與福祉。",
                partner_badge: "全球合作網絡",
                partner_title: "認證培訓機構、技能檢定中心與海外仲介",
                partner_desc: "長期與印尼國家技能檢定機構(LSP)及海外各國合法優良仲介緊密合作。",
                partner_btn: "檢視合作教育機構與國外仲介完整名錄",
                footer_sub: "印尼官方核准海外就業安置機構",
                footer_desc: "擁有十餘年豐富派遣經驗，提供素質優良、訓練有素之專業人力，深獲亞洲各國雇主信賴。",
                footer_col_nav: "網站導覽",
                footer_col_portal: "系統入口",
                footer_sos: "緊急求助專線 (SOS)",
                footer_col_hours: "服務時間",
                hours_weekday: "週一至週五",
                hours_saturday: "週六",
                hours_sunday: "週日與國定假日",
                hours_closed: "休息 (緊急SOS專線保持暢通)",
                footer_lic: "P3MI官方整合系統",
                footer_op: "營業許可",
                btn_close: "關閉",
                float_wa: "人才洽詢專線",
                m1_subtitle: "完整企業檔案、願景使命與官方合作夥伴",
                m1_heading: "堅持品質承諾與移工權益守護",
                m1_desc: "本機構專注於向國際市場輸送高素質人力，嚴格遵循兩國法令，全面保障勞工權益與雇主聘僱品質。",
                m1_visi_title: "公司願景",
                m1_visi_desc: "成為領先的跨國人才服務機構，協助印尼優秀勞工在國際舞台展現價值，帶動家庭繁榮與國家經濟發展。",
                m1_misi_title: "公司使命",
                m1_m1: "提供符合國際雇主標準的專業技能人才。",
                m1_m2: "確保招募過程公開、透明、公平與依法合規。",
                m1_m3: "提供出國前、在職中與返國後的完整跨國支援。",
                m1_m4: "與信譽卓著之海外仲介建立長期永續合作夥伴關係。",
                m1_lic_title: "官方營業執照與認證",
                m1_lic_desc: "已取得印尼BP2MI與勞動部正式核准證照，並於OSS政府商業登記系統合法備案。",
                m1_partner_heading: "合格合作職訓中心與海外仲介夥伴",
                m1_tab_lpk: "合格技能職訓中心 (LPK/LSP)",
                m1_tab_agency: "各國簽約合作海外仲介",
                m1_no_lpk: "尚無職訓中心資料。",
                m1_no_agency: "尚無海外仲介資料。",
                m1_blur_info: "完整名錄已鎖定",
                m1_blur_btn: "詳細資訊 (登入)",
                m1_footer_notice: "如需查看完整之合作機構名錄及官方授權合約，請",
                m1_footer_login_link: "登入系統",
                m2_title: "關於我們公司",
                m2_subtitle: "歷史信譽、誠信經營與堅持",
                m2_history_tag: "深耕海外人力服務超過十年的卓越歷程",
                m2_p1: "我們擁有超過十年的專業經驗，已成功協助數以萬計的印尼勞工在海外獲得穩定、安全且高所得的工作機會。",
                m2_p2: "我們堅持與國際信譽良好的機構對接，確保每位移工在海外均受到公平合法的對待與尊重。",
                m2_director_tag: "總經理的話",
                m2_quote: "「印尼移工是國家的親善大使與經濟英雄。我們的使命不僅是派遣出國，更在於確保每位勞工都學得一技之長，平安賺錢，尊榮返鄉。」",
                m2_position: "總經理",
                m3_title: "正式技術行業派遣方案",
                m3_subtitle: "技術工、專業人員與產業人力",
                m_dest_title: "主要派遣合作國家",
                m3_field_heading: "正式技術職缺類別：",
                m3_f1_title: "工廠製造與生產線作業",
                m3_f1_desc: "電子組裝、汽機車零件生產、包裝檢驗與符合嚴格工安標準的機械操作。",
                m3_f2_title: "醫療護理與臨床助理",
                m3_f2_desc: "醫院護士、復健治療助理與持有相關護理證照及語言證明之院所人員。",
                m3_f3_title: "飯店觀光與餐旅服務",
                m3_f3_desc: "國際飯店櫃檯接待、房務餐飲、宴會服務與專業主廚廚藝人員。",
                m3_f4_title: "資訊科技與工程專業",
                m3_f4_desc: "電腦網路技術員、工程製圖員、金融業務支援與後台資料處理員。",
                m3_advantage: "正式行業優勢：合約透明規範、符合當地法定工資保障、享有全額勞健保福利及良好職場升遷機會。",
                m4_title: "家庭與照護服務派遣方案",
                m4_subtitle: "長者看護、家庭管家幫傭與農漁業",
                m4_field_heading: "家庭服務工作項目：",
                m4_f1_title: "高齡長者專業看護",
                m4_f1_desc: "日常起居照料、輪椅移位協助、基礎復健動作及合格初級急救護理支援。",
                m4_f2_title: "家庭幫傭與管家清潔",
                m4_f2_desc: "專業家庭清潔整理、烹調符合當地口味之家庭料理及幼童日常生活照護。",
                m4_f3_title: "農場耕作與溫室農業",
                m4_f3_desc: "蔬果溫室栽植、現代果園培育與依法受到農業勞動法規保障的田間作業。",
                m4_f4_title: "海洋漁業與水產養殖",
                m4_f4_desc: "遠洋與近海合法漁船船員、水產魚塭養殖，並簽署標準海事勞動合約。",
                m4_lang_standard: "語言培訓標準：所有家庭看護均須完成嚴格口語會話培訓（粵語、國語、英語）及當地雇主家庭禮儀教育。",
                m5_title: "服務中心與總部聯絡窗口",
                m5_subtitle: "官方諮詢與各國雇主洽談通道",
                m5_sos_title: "移工海外緊急援助熱線 (SOS)",
                m5_sos_desc: "全年無休24小時待命，協助處理各國勞工突發急難事件。",
                m5_sos_btn: "立即撥打SOS",
                m5_office_title: "公司總部地址",
                m5_hours_label: "辦公室服務時間：",
                m5_hours_1: "週一至週五：09:00 - 17:00 (印尼西部時間)",
                m5_hours_2: "週六：09:00 - 13:00 (印尼西部時間)",
                m5_phone_title: "電話與WhatsApp聯繫管道",
                m5_p1_tag: "海外緊急求助專線 (SOS)",
                m5_p2_tag: "候選人招募諮詢中心",
                m5_p3_tag: "國外仲介與雇主合作洽談",
            },
            ja: {
                nav_home: "ホーム",
                nav_company: "企業情報",
                nav_formal: "専門・技術職",
                nav_informal: "介護・家庭職",
                nav_about: "私たちについて",
                nav_contact: "お問い合わせ",
                nav_login: "ログイン",
                login_staff: "スタッフログイン",
                login_agency: "監理団体・企業ログイン",
                login_cpmi: "候補者進捗ログイン",
                lang_select_title: "言語の選択",
                hero_badge: "インドネシア労働省・BP2MI公認 送出機関",
                hero_title_1: "安全・合法で誇りある",
                hero_title_2: "グローバル就労への架け橋",
                hero_desc: "インドネシア政府公認送出機関(P3MI)として、入国前徹底講習、コンプライアンス遵守、そして就労中の手厚いフォロー体制で優秀な人材をお届けします。",
                hero_btn_explore: "送出プログラム一覧",
                hero_btn_wa: "無料相談 (WhatsApp)",
                hero_btn_legal: "認可・ライセンス情報",
                stat_exp: "年以上の実績",
                stat_legal: "BP2MI・労働省公認",
                stat_countries: "主要派遣国",
                stat_workers: "累計派遣実績",
                card1_badge: "会社概要",
                card1_sub: "公認・適格送出機関",
                card1_desc: "各国の労働法規を遵守し、受入企業様に即戦力となる真面目な人材を、労働者に安心と成長の機会を提供します。",
                card1_f1: "BP2MI正規ライセンス",
                card1_f2: "OSS政府登録済",
                card1_f3: "世界各地の受入提携",
                card2_badge: "専門・技術職",
                card2_title: "特定技能・専門職",
                card2_desc: "製造・機械加工、医療・介護、IT、宿泊ホテル、建設業など。",
                card3_badge: "介護・サービス",
                card3_title: "介護・家庭サービス職",
                card3_desc: "高齢者介護、家事代行、飲食サービス、農業・食品加工。",
                card4_badge: "企業理念",
                card4_title: "私たちについて",
                card4_desc: "10年以上の信頼と実績。徹底した選考と高い職業倫理で高い定着率を実現。",
                card4_link: "経営理念・ミッション・社会的責任",
                card5_badge: "24時間サポート",
                card5_title: "お問い合わせ",
                card5_desc: "緊急SOSホットライン、受入相談、本社所在地。",
                card5_link: "WhatsApp・オンライン相談窓口",
                sync_badge: "政府公認連携システム",
                sync_title: "法令遵守とインドネシア政府公式連携",
                sync_desc: "当社の全事業は適法に認可を受け、インドネシア労働省の公式システムとリアルタイムで連動しています。",
                sub_bp2mi: "インドネシア海外労働者保護庁",
                sub_kemnaker: "インドネシア共和国労働省",
                sub_siapkerja: "国家デジタル雇用システム",
                sub_karirhub: "公式キャリア求人情報センター",
                sub_oss: "政府公式事業許認可システム",
                sub_apjati: "送出機関公認協会",
                sub_bnsp: "国家職業技能評価機構",
                cand_badge: "即戦力・研修修了人材",
                cand_title: "選考・研修修了済みインドネシア人材",
                cand_desc: "厳格な健康診断、日本語教育（N4/N3）、マナー研修を修了した意欲溢れる人材をご紹介します。",
                cand_btn_agency: "受入企業・組合ポータル",
                cand_btn_more: "人材データベース一覧を確認する",
                ready_status: "配属可能",
                trained_status: "講習修了",
                cert_status: "日本語N4取得済",
                exp_status: "実務経験あり",
                cand_verified: "公式適格審査済",
                cand_complete_docs: "申請書類一式完備",
                role_caregiver: "高齢者介護職員",
                role_housekeeper: "施設・家庭ハウスキーパー",
                role_operator: "工場製造オペレーター",
                role_nurse: "専門看護職",
                role_culinary: "調理・外食スタッフ",
                role_agriculture: "施設園芸・農業スタッフ",
                role_kaigo: "介護（特定技能）",
                role_technician: "建設・機械技術スタッフ",
                why_badge: "品質とサポート体制",
                why_title: "選ばれる4つの強み",
                why_desc: "法令遵守、透明な手続き、そして労働者一人ひとりの人権と未来を大切にしています。",
                why_1_title: "100% 合法・公的保険完備",
                why_1_desc: "労働法およびBP2MI規則に完全準拠し、公的な海外労働者保険に加入します。",
                why_2_title: "直営認定研修センターの講習",
                why_2_desc: "専任講師による徹底した語学訓練、日本のビジネスマナー、専門技術講習を実施。",
                why_3_title: "デジタル管理による透明性",
                why_3_desc: "オンラインポータルで候補者の申請進捗や書類審査をリアルタイム確認可能。",
                why_4_title: "24時間緊急SOS体制",
                why_4_desc: "配属後も安心して働けるよう、母国語での相談窓口と緊急時支援体制を完備。",
                partner_badge: "グローバル協業",
                partner_title: "認定教育機関・検定センター・提携監理団体",
                partner_desc: "国家技能評価機関（LSP）および各国の優良な受入機関・監理団体と強固に連携しています。",
                partner_btn: "提携教育機関・受入パートナー一覧を見る",
                footer_sub: "インドネシア政府公認 人材送出機関",
                footer_desc: "10年以上にわたり、確かな技術と誠実さを備えた優秀なインドネシア人材をアジア各地へ安定してお届けしています。",
                footer_col_nav: "サイトナビゲーション",
                footer_col_portal: "ポータルアクセス",
                footer_sos: "緊急SOSホットライン",
                footer_col_hours: "営業時間",
                hours_weekday: "月曜 - 金曜",
                hours_saturday: "土曜",
                hours_sunday: "日曜・祝日",
                hours_closed: "休業（緊急SOS窓口は年中無休）",
                footer_lic: "P3MI公式認可システム",
                footer_op: "事業許可情報",
                btn_close: "閉じる",
                float_wa: "受入・採用のお問い合わせ",
                m1_subtitle: "企業概要・経営理念・公式パートナー",
                m1_heading: "品質向上と労働者保護への誓い",
                m1_desc: "真面目でスキルの高い人材育成と、労働者の権利擁護・法令遵守を両立した送出事業を展開しています。",
                m1_visi_title: "企業ビジョン",
                m1_visi_desc: "優秀な人材を通じて国際社会と母国の架け橋となり、双方の持続的繁栄に貢献するリーディング送出機関を目指します。",
                m1_misi_title: "ミッション",
                m1_m1: "国際基準を満たす実践的な技能人材の育成。",
                m1_m2: "透明で公正、法令遵守の採用・選考プロセス。",
                m1_m3: "出国前・就労中・帰国後までの包括的保護。",
                m1_m4: "信頼できる受入パートナーとの永続的協業関係。",
                m1_lic_title: "公式許認可・法的登録",
                m1_lic_desc: "BP2MIおよびインドネシア労働省より正式認可を受け、OSS政府許認可システムに登録されています。",
                m1_partner_heading: "提携認定訓練校および受入機関一覧",
                m1_tab_lpk: "認定訓練センター (LPK/LSP)",
                m1_tab_agency: "海外受入パートナー機関",
                m1_no_lpk: "訓練校データは準備中です。",
                m1_no_agency: "パートナーデータは準備中です。",
                m1_blur_info: "全リストはロックされています",
                m1_blur_btn: "詳細 (ログイン)",
                m1_footer_notice: "提携機関の全リストと認定ライセンスを確認するには、",
                m1_footer_login_link: "ポータルにログイン",
                m2_title: "会社について",
                m2_subtitle: "沿革・信頼の歩み・経営方針",
                m2_history_tag: "10年以上にわたる確かな送出実績と信頼",
                m2_p1: "私たちは設立以来、数千人ものインドネシア人材を海外へ送り出し、受入企業様の発展と労働者の自立を支えてきました。",
                m2_p2: "不当な費用徴収を一切排除し、倫理的で公正なリクルートメント体制を徹底しています。",
                m2_director_tag: "代表挨拶",
                m2_quote: "「インドネシアの若者たちは国の誇りであり親善大使です。単に送り出すだけでなく、確かな技術を身につけ、笑顔で帰国できるよう全力で支援します。」",
                m2_position: "代表取締役",
                m3_title: "専門・技術職 送出プログラム",
                m3_subtitle: "特定技能・エンジニア・高度人材",
                m_dest_title: "主な受入国・地域",
                m3_field_heading: "主な対象職種：",
                m3_f1_title: "製造業・機械加工・組立",
                m3_f1_desc: "電子機器製造、自動車部品、梱包、品質管理など厳格な安全基準に対応。",
                m3_f2_title: "医療・看護・リハビリ",
                m3_f2_desc: "病院看護補助、リハビリ支援、語学資格保持者による医療現場サポート。",
                m3_f3_title: "ホテル・宿泊サービス",
                m3_f3_desc: "フロント業務、客室管理、国際ホテル基準の接客サービスと調理補助。",
                m3_f4_title: "IT技術・エンジニアリング",
                m3_f4_desc: "ネットワーク保守、CAD製図、バックオフィスデータ処理。",
                m3_advantage: "専門職の特長：明確な労働契約、受入国基準の適正給与、健康保険完備、キャリアアップの機会。",
                m4_title: "介護・家庭サービス 送出プログラム",
                m4_subtitle: "介護福祉・ハウスキーピング・第一次産業",
                m4_field_heading: "対象業務：",
                m4_f1_title: "高齢者施設・訪問介護",
                m4_f1_desc: "生活介助、移動補助、コミュニケーションケア、応急手当有資格者によるサポート。",
                m4_f2_title: "ハウスキーパー・家事支援",
                m4_f2_desc: "衛生的な住居管理、各国の食文化に合わせた調理、丁寧な日常清掃。",
                m4_f3_title: "現代農業・施設園芸",
                m4_f3_desc: "野菜・果樹栽培、ビニールハウス管理など労働環境の整った農業現場。",
                m4_f4_title: "水産業・養殖業",
                m4_f4_desc: "沿岸・遠洋漁業クルー、養殖管理。標準海員契約に準拠。",
                m4_lang_standard: "語学・生活適応講習：現地での円滑な生活のため、日常会話教育と受入国のマナー指導を徹底しています。",
                m5_title: "お問い合わせ・相談窓口",
                m5_subtitle: "公式情報・受入企業様ご相談窓口",
                m5_sos_title: "海外緊急SOSホットライン",
                m5_sos_desc: "配属後のトラブルに母国語で24時間迅速に対応します。",
                m5_sos_btn: "SOS窓口へ連絡",
                m5_office_title: "本社オフィス所在地",
                m5_hours_label: "受付時間：",
                m5_hours_1: "月曜 - 金曜：09:00 - 17:00 (WIB)",
                m5_hours_2: "土曜：09:00 - 13:00 (WIB)",
                m5_phone_title: "電話・WhatsApp相談窓口",
                m5_p1_tag: "緊急相談ホットライン (SOS)",
                m5_p2_tag: "候補者登録・選考センター",
                m5_p3_tag: "受入企業・監理団体専用窓口",
            },
            cn: {
                nav_home: "首页",
                nav_company: "企业概况",
                nav_formal: "正式技术",
                nav_informal: "家庭护理",
                nav_about: "关于我们",
                nav_contact: "联系我们",
                nav_login: "登录系统",
                login_staff: "员工登录",
                login_agency: "中介机构登录",
                login_cpmi: "候选人进度登录",
                lang_select_title: "选择语言",
                hero_badge: "印尼劳工部与BP2MI官方认证就业服务机构",
                hero_title_1: "搭建安全、合规且受尊重的",
                hero_title_2: "全球优质就业桥梁",
                hero_desc: "经印尼政府正式批准的海外就业安置机构(P3MI)，为亚太各国雇主匹配优秀印尼劳工，提供完整的行前培训、法规遵从及跨国全流程保障。",
                hero_btn_explore: "浏览就业派遣项目",
                hero_btn_wa: "在线即时咨询 (WhatsApp)",
                hero_btn_legal: "官方执照与资质",
                stat_exp: "年跨国专业经验",
                stat_legal: "BP2MI及劳工部认证",
                stat_countries: "主要派遣合作国家",
                stat_workers: "累计成功派遣人才",
                card1_badge: "核心概况",
                card1_sub: "政府审查合格派遣机构",
                card1_desc: "严格遵守国际跨国劳动法规，为雇主提供优质适岗人才，为印尼劳工提供安全合法的权益保障。",
                card1_f1: "BP2MI合法执照",
                card1_f2: "OSS官方登记",
                card1_f3: "全球跨国伙伴",
                card2_badge: "技术行业",
                card2_title: "正式技术行业",
                card2_desc: "制造工厂、医疗护理、信息技术、酒店餐饮与工程建筑。",
                card3_badge: "家政照护",
                card3_title: "家庭与照护服务",
                card3_desc: "长者照护、家庭管家帮佣、餐饮服务与现代农业。",
                card4_badge: "发展历程",
                card4_title: "关于我们",
                card4_desc: "超过10年的专业诚信历程，坚持最高标准的职业道德与跨国服务品质。",
                card4_link: "公司愿景、使命与经营承诺",
                card5_badge: "24小时服务",
                card5_title: "联系我们",
                card5_desc: "海外紧急求助热线(SOS)、招募咨询与总部地址。",
                card5_link: "WhatsApp在线客服咨询",
                sync_badge: "官方数据即时同步",
                sync_title: "政府法规遵从与官方数据同步",
                sync_desc: "本机构所有海外派遣业务均依法登记，并与印尼官方就业生态系统实时联网。",
                sub_bp2mi: "印尼海外劳工保护局",
                sub_kemnaker: "印尼共和国劳工部",
                sub_siapkerja: "国家就业数字生态系统",
                sub_karirhub: "国家招聘求职信息中心",
                sub_oss: "官方商业登记许可系统",
                sub_apjati: "官方海外就业服务协会",
                sub_bnsp: "国家职业技能考评认证",
                cand_badge: "考核合格即战力人才",
                cand_title: "认证印尼候选人才库",
                cand_desc: "所有候选人均通过严格体检、语言培训与技能考核，具备良好工作能力。",
                cand_btn_agency: "中介机构专用系统",
                cand_btn_more: "前往中介系统查看完整人才档案",
                ready_status: "可立即上岗",
                trained_status: "培训结业",
                cert_status: "日语N4认证",
                exp_status: "具工作经验",
                cand_verified: "官方审核通过候选人",
                cand_complete_docs: "证件齐全",
                role_caregiver: "高龄长者护理",
                role_housekeeper: "家庭管家帮佣",
                role_operator: "工厂制造作业员",
                role_nurse: "专业护理人员",
                role_culinary: "餐饮服务专员",
                role_agriculture: "现代农业技术人员",
                role_kaigo: "专业机构介护员",
                role_technician: "工程技术与营建技工",
                why_badge: "品质标准与劳工保障",
                why_title: "为什么选择我们的派遣服务？",
                why_desc: "我们坚持透明诚信、合规守法，维护每一位海外务工者与雇主的合法权益。",
                why_1_title: "100% 合法且全程参保",
                why_1_desc: "完全符合印尼劳工法与BP2MI规定，享有官方全程海外劳工保险。",
                why_2_title: "标准专业职训中心",
                why_2_desc: "在官方正规培训中心由专业师资开展密集语言教学与岗位实务培训。",
                why_3_title: "数字化进度透明查询",
                why_3_desc: "通过专属数字化平台，实时跟踪审批进度与海外中介对接流程。",
                why_4_title: "24小时紧急求助热线",
                why_4_desc: "设有跨国紧急救援机制，在合同期内持续守护劳工人身安全与福祉。",
                partner_badge: "全球合作网络",
                partner_title: "认证培训机构、技能考评中心与海外中介",
                partner_desc: "长期与印尼国家技能鉴定机构(LSP)及海外各国正规优良中介紧密合作。",
                partner_btn: "查看合作培训机构与海外中介完整名录",
                footer_sub: "印尼官方批准海外就业安置机构",
                footer_desc: "拥有十余年派遣经验，提供素质优良之专业人力，深得亚洲各国雇主信赖。",
                footer_col_nav: "网站导航",
                footer_col_portal: "系统入口",
                footer_sos: "紧急求助热线 (SOS)",
                footer_col_hours: "服务时间",
                hours_weekday: "周一至周五",
                hours_saturday: "周六",
                hours_sunday: "周日及法定节假日",
                hours_closed: "休息 (紧急SOS热线保持畅通)",
                footer_lic: "P3MI官方集成系统",
                footer_op: "营业许可",
                btn_close: "关闭",
                float_wa: "人才咨询专线",
                m1_subtitle: "完整企业档案、愿景使命与官方合作伙伴",
                m1_heading: "坚持品质承诺与移工权益守护",
                m1_desc: "本机构专注于向国际市场输出高素质人力，严格遵守两国法律法规，全面保障劳工权益。",
                m1_visi_title: "公司愿景",
                m1_visi_desc: "成为领先的跨国人才服务机构，协助印尼优秀劳工在国际舞台展现价值。",
                m1_misi_title: "公司使命",
                m1_m1: "提供符合国际雇主标准的专业技能人才。",
                m1_m2: "确保招募过程公开、透明、公平与依法合规。",
                m1_m3: "提供出境前、履约中与回国后的全流程跨国支持。",
                m1_m4: "与信誉卓著之海外中介建立长期合作关系。",
                m1_lic_title: "官方营业执照与认证",
                m1_lic_desc: "已取得印尼BP2MI与劳工部正式批准执照，并在OSS系统合法备案。",
                m1_partner_heading: "合作职训中心与海外中介伙伴",
                m1_tab_lpk: "合格技能职训中心 (LPK/LSP)",
                m1_tab_agency: "签约合作海外中介",
                m1_no_lpk: "暂无培训中心数据。",
                m1_no_agency: "暂无海外中介数据。",
                m1_blur_info: "完整名录已锁定",
                m1_blur_btn: "详细信息 (登录)",
                m1_footer_notice: "如需查看完整之合作机构名录及官方授权合约，请",
                m1_footer_login_link: "登录系统",
                m2_title: "关于我们公司",
                m2_subtitle: "历史信誉、诚信经营与坚持",
                m2_history_tag: "深耕海外人力服务超过十年的卓越历程",
                m2_p1: "我们拥有十余年专业经验，已协助数以万计的印尼劳工在海外获得体面稳定的工作。",
                m2_p2: "我们坚持与国际优质机构对接，确保每位劳工均获得公平合法的对待。",
                m2_director_tag: "总经理致辞",
                m2_quote: "「印尼劳工是国家的亲善大使与经济英雄。我们的使命不仅是派遣出境，更在于确保每位员工掌握实用技能，平安致富，尊荣回乡。」",
                m2_position: "总经理",
                m3_title: "正式技术行业派遣方案",
                m3_subtitle: "技术工、专业人员与产业人力",
                m_dest_title: "主要派遣合作国家",
                m3_field_heading: "正式技术岗位类别：",
                m3_f1_title: "工厂制造与生产线操作",
                m3_f1_desc: "电子组装、汽摩配件生产、包装质检与符合安全标准的机械操作。",
                m3_f2_title: "医疗护理与临床助理",
                m3_f2_desc: "医院护士、康复理疗助理与持有护士执照和语言证明之人员。",
                m3_f3_title: "酒店旅游与餐饮服务",
                m3_f3_desc: "国际酒店前台接待、客房餐饮、宴会服务与专业厨师人员。",
                m3_f4_title: "信息技术与工程专业",
                m3_f4_desc: "计算机网络技术员、工程绘图员、数据处理员。",
                m3_advantage: "正式行业优势：合同规范明确、法定工资保障、享有全额健康保险与良好职业晋升通道。",
                m4_title: "家庭与照护服务派遣方案",
                m4_subtitle: "长者护理、家庭管家帮佣与农渔业",
                m4_field_heading: "家庭服务工作项目：",
                m4_f1_title: "高龄长者专业护理",
                m4_f1_desc: "日常起居照料、轮椅转移协助、基础康复及应急救护支援。",
                m4_f2_title: "家庭帮佣与保洁管家",
                m4_f2_desc: "专业家庭保洁、烹饪符合当地口味之菜肴及幼儿日常照料。",
                m4_f3_title: "农场耕作与温室农业",
                m4_f3_desc: "果蔬温室种植、现代果园培育与依法受到保护的农田作业。",
                m4_f4_title: "海洋渔业与水产养殖",
                m4_f4_desc: "正规远洋及近海渔船船员、水产养殖，签署规范海事劳动合同。",
                m4_lang_standard: "语言培训标准：所有家庭护理人员均须通过严格日常口语培训及雇主家庭礼仪指导。",
                m5_title: "服务中心与总部联络窗口",
                m5_subtitle: "官方咨询与海外雇主洽谈通道",
                m5_sos_title: "海外劳工紧急援助热线 (SOS)",
                m5_sos_desc: "全年24小时待命，协助处理各类突发急难状况。",
                m5_sos_btn: "立即拨打SOS",
                m5_office_title: "公司总部地址",
                m5_hours_label: "办公室服务时间：",
                m5_hours_1: "周一至周五：09:00 - 17:00 (印尼西部时间)",
                m5_hours_2: "周六：09:00 - 13:00 (印尼西部时间)",
                m5_phone_title: "电话与WhatsApp联系渠道",
                m5_p1_tag: "海外紧急求助专线 (SOS)",
                m5_p2_tag: "候选人招募咨询中心",
                m5_p3_tag: "海外中介与雇主合作洽谈",
            },
            ko: {
                nav_home: "홈",
                nav_company: "회사소개",
                nav_formal: "전문・기술직",
                nav_informal: "간병・서비스직",
                nav_about: "회사소개",
                nav_contact: "문의하기",
                nav_login: "로그인",
                login_staff: "직원 로그인",
                login_agency: "파트너 에이전시 로그인",
                login_cpmi: "지원자 진행상황 로그인",
                lang_select_title: "언어 선택",
                hero_badge: "인도네시아 노동부 및 BP2MI 공인 송출기관",
                hero_title_1: "안전하고 합법적이며 자긍심 넘치는",
                hero_title_2: "글로벌 취업의 든든한 가교",
                hero_desc: "인도네시아 정부 공인 송출기관(P3MI)으로서, 사전 직무 교육, 철저한 법률 준수 및 출국부터 귀국까지 전 과정에 걸친 포괄적인 안전 관리를 제공합니다.",
                hero_btn_explore: "송출 프로그램 보기",
                hero_btn_wa: "빠른 상담 (WhatsApp)",
                hero_btn_legal: "공식 인허가 및 자격",
                stat_exp: "년 이상의 실무경력",
                stat_legal: "BP2MI・노동부 정식인증",
                stat_countries: "주요 송출 대상국",
                stat_workers: "누적 취업 연계 인원",
                card1_badge: "핵심 정보",
                card1_sub: "인증 완료 해외 송출 전문기관",
                card1_desc: "국제 노동 규정을 준수하여 해외 고용주에게는 검증된 우수 인재를, 구직자에게는 안전하고 보람찬 해외 일자리를 연결합니다.",
                card1_f1: "BP2MI 공식 인허가",
                card1_f2: "OSS 정부 등록 완료",
                card1_f3: "글로벌 협력 네트워크",
                card2_badge: "전문・기술직",
                card2_title: "전문 및 제조업 분야",
                card2_desc: "제조업 생산직, 의료・간호, IT, 호텔・서비스업 및 건설업.",
                card3_badge: "간병・가사",
                card3_title: "간병 및 가사 서비스",
                card3_desc: "어르신 간병 케어, 가사관리사, 외식업 서비스 및 현대 농업.",
                card4_badge: "기업 소개",
                card4_title: "회사 소개",
                card4_desc: "10년 이상의 신뢰와 전문성을 바탕으로 윤리적이고 공정한 인재 채용을 실천합니다.",
                card4_link: "기업 비전, 미션 및 경영 원칙",
                card5_badge: "24시간 지원",
                card5_title: "고객 지원 및 문의",
                card5_desc: "24시간 긴급 SOS 핫라인, 채용 상담 및 본사 주소.",
                card5_link: "WhatsApp 실시간 온라인 상담",
                sync_badge: "공식 연계 시스템",
                sync_title: "정부 규정 준수 및 공식 데이터 동기화",
                sync_desc: "당사의 모든 송출 업무는 적법하게 인가받았으며 인도네시아 노동부 공식 고용 시스템과 실시간으로 연동됩니다.",
                sub_bp2mi: "인도네시아 해외이주노동자보호청",
                sub_kemnaker: "인도네시아 공화국 노동부",
                sub_siapkerja: "국가 디지털 고용 생태계",
                sub_karirhub: "국가 취업 정보 포털",
                sub_oss: "정부 공식 인허가 등록 시스템",
                sub_apjati: "공인 해외송출협회",
                sub_bnsp: "국가직무능력표준원",
                cand_badge: "검증된 즉시 투입 가능 인재",
                cand_title: "직무 교육 수료 인도네시아 인재풀",
                cand_desc: "엄격한 건강검진, 한국어 어학 교육 및 공인 직업훈련센터의 실무 교육을 완료한 우수 인재들입니다.",
                cand_btn_agency: "에이전시 전용 포털",
                cand_btn_more: "에이전시 포털에서 전체 인재 데이터베이스 확인",
                ready_status: "배치 가능",
                trained_status: "교육 수료",
                cert_status: "어학 기준 충족",
                exp_status: "경력 보유",
                cand_verified: "공식 검증 완료 지원자",
                cand_complete_docs: "구비 서류 완료",
                role_caregiver: "어르신 전문 간병사",
                role_housekeeper: "가사관리사",
                role_operator: "제조공장 오퍼레이터",
                role_nurse: "전문 간호 인력",
                role_culinary: "외식 레스토랑 스태프",
                role_agriculture: "현대 농업 기술인력",
                role_kaigo: "개호 전문 간병사",
                role_technician: "기계 및 건설 기술인력",
                why_badge: "품질 기준 및 권익 보호",
                why_title: "왜 저희 송출 서비스를 선택해야 할까요?",
                why_desc: "저희는 투명한 절차, 철저한 법 준수, 그리고 모든 노동자의 존엄과 권리를 최우선으로 여깁니다.",
                why_1_title: "100% 합법 및 보험 완비",
                why_1_desc: "노동법 및 BP2MI 지침을 철저히 준수하며 공식 해외 근로자 전용 보험을 기본 제공합니다.",
                why_2_title: "공인 직업훈련센터 교육",
                why_2_desc: "전문 강사진을 통해 집중 어학 훈련, 현지 문화 적응 교육 및 실습 중심 직무 훈련을 진행합니다.",
                why_3_title: "투명한 디지털 관리",
                why_3_desc: "통합 포털을 통해 지원자의 심사 현황, 서류 인증 및 배치를 실시간으로 투명하게 파악합니다.",
                why_4_title: "24시간 긴급 SOS 대응",
                why_4_desc: "근무 기간 동안 근로자의 안전과 안정을 보장하기 위해 24시간 긴급 콜센터와 현지 지원을 가동합니다.",
                partner_badge: "글로벌 파트너십",
                partner_title: "공인 훈련기관, 자격검정센터 및 해외 협력사",
                partner_desc: "국가직무능력검정원(LSP) 및 해외 각국의 정식 인가 에이전시들과 긴밀히 협력하고 있습니다.",
                partner_btn: "협력 훈련기관 및 해외 에이전시 전체 목록 보기",
                footer_sub: "인도네시아 정부 공인 해외 취업 송출기관",
                footer_desc: "10년 이상의 노하우를 바탕으로 성실하고 우수한 인도네시아 전문 인재를 안정적으로 송출합니다.",
                footer_col_nav: "주요 메뉴",
                footer_col_portal: "시스템 포털",
                footer_sos: "긴급 핫라인 (SOS)",
                footer_col_hours: "운영 시간",
                hours_weekday: "월요일 - 금요일",
                hours_saturday: "토요일",
                hours_sunday: "일요일 및 공휴일",
                hours_closed: "휴무 (긴급 SOS 회선은 24시간 가동)",
                footer_lic: "P3MI 공인 통합 플랫폼",
                footer_op: "사업 인허가 정보",
                btn_close: "닫기",
                float_wa: "채용 및 송출 상담",
                m1_subtitle: "기업 상세 프로필, 비전, 미션 및 공식 파트너",
                m1_heading: "우수 인재 양성과 권익 보호에 대한 약속",
                m1_desc: "당사는 국제 기준에 부합하는 역량 있는 인재 양성과 관련 법규 준수에 앞장서고 있습니다.",
                m1_visi_title: "기업 비전",
                m1_visi_desc: "글로벌 무대에서 인도네시아 인재의 위상을 높이고 양국의 경제 발전에 기여하는 모범 송출기관으로 도약합니다.",
                m1_misi_title: "기업 미션",
                m1_m1: "해외 고용주의 요구에 부응하는 숙련된 인재 육성.",
                m1_m2: "공정하고 투명하며 법적으로 완벽한 선발 절차 준수.",
                m1_m3: "출국 전부터 귀국 후까지 전인적인 안전 및 권익 보호.",
                m1_m4: "해외 파트너사와의 굳건하고 지속 가능한 협력 구축.",
                m1_lic_title: "공식 사업 인허가",
                m1_lic_desc: "BP2MI 및 인도네시아 노동부의 정식 인가를 취득하고 OSS 정부 시스템에 등록되었습니다.",
                m1_partner_heading: "공인 훈련센터 및 해외 협력 에이전시",
                m1_tab_lpk: "직업훈련 및 자격검정센터 (LPK/LSP)",
                m1_tab_agency: "해외 협력 에이전시",
                m1_no_lpk: "등록된 훈련센터 데이터가 없습니다.",
                m1_no_agency: "등록된 협력사 데이터가 없습니다.",
                m1_blur_info: "전체 목록 잠김",
                m1_blur_btn: "상세보기 (로그인)",
                m1_footer_notice: "공식 파트너 기관 전체 목록 및 라이선스를 확인하려면",
                m1_footer_login_link: "포털 로그인",
                m2_title: "회사 소개",
                m2_subtitle: "역사와 전통, 정직과 신뢰",
                m2_history_tag: "10년 이상 이어온 인재 송출의 확고한 신뢰",
                m2_p1: "저희는 지난 10여 년간 수많은 인도네시아 인재들이 해외에서 안전하고 안정적인 일자리를 찾도록 지원해 왔습니다.",
                m2_p2: "엄격한 윤리 기준을 바탕으로 고용주와 근로자 모두가 만족할 수 있는 상생의 가교가 되겠습니다.",
                m2_director_tag: "대표이사 인사말",
                m2_quote: "\"해외에 파견되는 인재들은 국가를 대표하는 민간 외교관입니다. 철저한 사전 직무 훈련과 세심한 안전 관리를 통해 무사히 꿈을 이루고 귀국하도록 최선을 다하겠습니다.\"",
                m2_position: "대표이사",
                m3_title: "전문 및 기술직 송출 프로그램",
                m3_subtitle: "숙련 기술직, 전문 인력 및 산업 인력",
                m_dest_title: "주요 파견 대상국",
                m3_field_heading: "주요 기술직 분야:",
                m3_f1_title: "제조공장 및 생산설비 가동",
                m3_f1_desc: "전자 조립, 자동차 부품 가공, 포장 검수 및 산업안전 규정을 준수한 기계 조작.",
                m3_f2_title: "의료 간호 및 임상 보조",
                m3_f2_desc: "병원 간호보조, 물리치료 보조 및 어학 자격을 갖춘 의료 보조 인력.",
                m3_f3_title: "호텔 숙박 및 서비스업",
                m3_f3_desc: "국제 호텔 프런트 리셉션, 객실 룸메이드, 연회 서비스 및 조리 보조.",
                m3_f4_title: "IT 기술 및 엔지니어링",
                m3_f4_desc: "네트워크 관리, CAD 설계 도면 보조, 사무 데이터 처리.",
                m3_advantage: "전문직 특장점: 명확한 근로계약, 현지 최저임금 준수 경쟁력 있는 급여, 건강보험 완비 및 경력 개발 기회 제공.",
                m4_title: "간병 및 가사 서비스 송출 프로그램",
                m4_subtitle: "어르신 간병, 가사관리사 및 농축수산업",
                m4_field_heading: "서비스 직무 분야:",
                m4_f1_title: "어르신 전문 케어 및 간병",
                m4_f1_desc: "일상생활 케어 지원, 휠체어 이동 보조, 기초 물리 재활 및 응급처치 자격자 지원.",
                m4_f2_title: "가사관리 및 가정 클리닝",
                m4_f2_desc: "위생적인 가사 정리, 현지 맞춤형 가정식 조리 및 영유아 돌봄 지원.",
                m4_f3_title: "현대 농업 및 시설원예",
                m4_f3_desc: "시설 하우스 재배, 현대 과수원 관리 등 법적 보호를 받는 농업 현장.",
                m4_f4_title: "해양 어업 및 양식업",
                m4_f4_desc: "원양 및 연근해 어선 선원, 양식장 관리. 표준 선원 근로계약 체결.",
                m4_lang_standard: "어학 교육 기준: 모든 가사 간병 인력은 현지 적응을 위해 집중적인 일상 회화 교육과 가정 예절 교육을 이수합니다.",
                m5_title: "고객지원센터 및 본사 문의",
                m5_subtitle: "공식 상담 및 해외 고용주 제휴 채널",
                m5_sos_title: "해외 근로자 긴급 SOS 핫라인",
                m5_sos_desc: "해외 근무지에서 발생하는 긴급 상황에 대비하여 24시간 연중무휴 지원합니다.",
                m5_sos_btn: "SOS 연결",
                m5_office_title: "본사 사무소 주소",
                m5_hours_label: "사무소 운영 시간:",
                m5_hours_1: "월요일 - 금요일: 09:00 - 17:00 (현지시간)",
                m5_hours_2: "토요일: 09:00 - 13:00 (현지시간)",
                m5_phone_title: "전화 및 WhatsApp 상담",
                m5_p1_tag: "해외 긴급 지원 회선 (SOS)",
                m5_p2_tag: "지원자 접수 및 상담센터",
                m5_p3_tag: "해외 에이전시 및 기업 제휴",
            }
        };

        const langLabels = {
            id: '🇮🇩 ID',
            en: '🇬🇧 EN',
            zh: '🇹🇼 TW',
            cn: '🇨🇳 CN',
            ja: '🇯🇵 JA',
            ko: '🇰🇷 KO',
        };

        function setAppLanguage(lang) {
            if (!appTranslations[lang]) lang = 'id';
            localStorage.setItem('portal_lang', lang);

            const dict = appTranslations[lang];

            // Translate elements with data-i18n
            document.querySelectorAll('[data-i18n]').forEach(el => {
                const key = el.getAttribute('data-i18n');
                if (dict[key]) {
                    el.textContent = dict[key];
                }
            });

            // Update active label in header
            const labelEl = document.getElementById('currentLangLabel');
            if (labelEl) {
                labelEl.textContent = lang.toUpperCase();
            }

            // Close dropdown menu
            const menu = document.getElementById('langDropdownMenu');
            if (menu) menu.classList.add('hidden');
            const chevron = document.getElementById('langChevron');
            if (chevron) chevron.style.transform = 'rotate(0deg)';
        }

        // Apply saved language on initial load
        document.addEventListener('DOMContentLoaded', function() {
            const savedLang = localStorage.getItem('portal_lang') || 'id';
            setAppLanguage(savedLang);

            // Language Switcher Dropdown Toggle (Desktop)
            const langDropdownBtn = document.getElementById('langDropdownBtn');
            const langDropdownMenu = document.getElementById('langDropdownMenu');
            const langChevron = document.getElementById('langChevron');

            if (langDropdownBtn && langDropdownMenu) {
                langDropdownBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const isHidden = langDropdownMenu.classList.contains('hidden');
                    langDropdownMenu.classList.toggle('hidden', !isHidden);
                    if (langChevron) {
                        langChevron.style.transform = isHidden ? 'rotate(180deg)' : 'rotate(0deg)';
                    }
                });

                window.addEventListener('click', function(e) {
                    if (!langDropdownBtn.contains(e.target) && !langDropdownMenu.contains(e.target)) {
                        langDropdownMenu.classList.add('hidden');
                        if (langChevron) {
                            langChevron.style.transform = 'rotate(0deg)';
                        }
                    }
                });
            }

            // Dark / Light Theme Toggle
            const themeBtn = document.getElementById('themeToggleBtn');
            const themeIcon = document.getElementById('themeToggleIcon');

            let currentTheme = localStorage.getItem('theme');
            if (!currentTheme) {
                const hour = new Date().getHours();
                currentTheme = (hour < 6 || hour >= 18) ? 'dark' : 'light';
            }

            function applyTheme(theme) {
                if (theme === 'dark') {
                    document.documentElement.classList.add('dark');
                    if (themeIcon) themeIcon.textContent = 'light_mode';
                } else {
                    document.documentElement.classList.remove('dark');
                    if (themeIcon) themeIcon.textContent = 'dark_mode';
                }
            }

            applyTheme(currentTheme);

            if (themeBtn) {
                themeBtn.addEventListener('click', function() {
                    const isDark = document.documentElement.classList.contains('dark');
                    const newTheme = isDark ? 'light' : 'dark';
                    localStorage.setItem('theme', newTheme);
                    applyTheme(newTheme);
                });
            }

            // Portal Dropdown Toggle (Desktop)
            const portalDropdownBtn = document.getElementById('portalDropdownBtn');
            const portalDropdownMenu = document.getElementById('portalDropdownMenu');
            const portalChevron = document.getElementById('portalChevron');

            if (portalDropdownBtn && portalDropdownMenu) {
                portalDropdownBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const isHidden = portalDropdownMenu.classList.contains('hidden');
                    portalDropdownMenu.classList.toggle('hidden', !isHidden);
                    if (portalChevron) {
                        portalChevron.style.transform = isHidden ? 'rotate(180deg)' : 'rotate(0deg)';
                    }
                });

                window.addEventListener('click', function(e) {
                    if (!portalDropdownBtn.contains(e.target) && !portalDropdownMenu.contains(e.target)) {
                        portalDropdownMenu.classList.add('hidden');
                        if (portalChevron) {
                            portalChevron.style.transform = 'rotate(0deg)';
                        }
                    }
                });
            }

            // Mobile Menu Drawer Toggle
            const mobileMenuBtn = document.getElementById('mobileMenuToggle');
            const mobileDrawer = document.getElementById('mobileDrawer');
            const mobileMenuIcon = document.getElementById('mobileMenuIcon');

            if (mobileMenuBtn && mobileDrawer) {
                mobileMenuBtn.addEventListener('click', function() {
                    mobileDrawer.classList.toggle('hidden');
                    const isOpen = !mobileDrawer.classList.contains('hidden');
                    if (mobileMenuIcon) {
                        mobileMenuIcon.className = isOpen ? 'fa-solid fa-xmark text-lg' : 'fa-solid fa-bars text-lg';
                    }
                });
            }

            // Modal Handlers
            const modalTriggers = document.querySelectorAll('[data-modal]');
            const modals = document.querySelectorAll('.modal');
            const closeModalButtons = document.querySelectorAll('.close-modal');

            modalTriggers.forEach(trigger => {
                trigger.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('data-modal');
                    const targetModal = document.getElementById(targetId);
                    if (targetModal) {
                        targetModal.classList.add('active');
                        document.body.style.overflow = 'hidden';
                    }
                    if (mobileDrawer && !mobileDrawer.classList.contains('hidden')) {
                        mobileDrawer.classList.add('hidden');
                        if (mobileMenuIcon) mobileMenuIcon.className = 'fa-solid fa-bars text-lg';
                    }
                });
            });

            function closeAllModals() {
                modals.forEach(modal => modal.classList.remove('active'));
                document.body.style.overflow = '';
            }

            closeModalButtons.forEach(btn => {
                btn.addEventListener('click', closeAllModals);
            });

            modals.forEach(modal => {
                modal.addEventListener('click', function(e) {
                    if (e.target === this) {
                        closeAllModals();
                    }
                });
            });

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeAllModals();
                }
            });

            // Prevent right-click on candidate pictures
            document.querySelectorAll('.worker-image').forEach(img => {
                img.addEventListener('contextmenu', e => e.preventDefault());
            });

            // Gracefully handle broken candidate pictures by removing the card
            window.handleWorkerImageError = function(img) {
                if (!img) return;
                const card = img.closest('.snap-start') || img.closest('.flex-none');
                if (card) {
                    card.remove();
                    const track = document.getElementById('talentCarouselTrack');
                    if (track) {
                        track.dispatchEvent(new Event('scroll'));
                    }
                }
            };

            // Proactively check any broken image in talentCarouselTrack
            document.querySelectorAll('#talentCarouselTrack img').forEach(img => {
                img.addEventListener('error', function() {
                    window.handleWorkerImageError(this);
                });
                if (img.complete && img.naturalWidth === 0) {
                    window.handleWorkerImageError(img);
                }
            });

            // Generic Bidirectional Carousel Controller
            function initBidirectionalCarousel({ trackId, prevBtnId, nextBtnId, dotsId, autoInterval = 4500 }) {
                const track = document.getElementById(trackId);
                const prevBtn = document.getElementById(prevBtnId);
                const nextBtn = document.getElementById(nextBtnId);
                const dotsContainer = document.getElementById(dotsId);

                if (!track) return;

                let autoTimer = null;
                let isHovered = false;

                function getStep() {
                    const firstCard = track.querySelector(':scope > div');
                    if (!firstCard) return 260;
                    const style = window.getComputedStyle(track);
                    const gap = parseInt(style.gap) || 16;
                    return firstCard.offsetWidth + gap;
                }

                function scrollCarousel(direction) {
                    const step = getStep();
                    const maxScroll = track.scrollWidth - track.clientWidth;
                    if (direction === 'next') {
                        if (track.scrollLeft >= maxScroll - 15) {
                            track.scrollTo({ left: 0, behavior: 'smooth' });
                        } else {
                            track.scrollBy({ left: step, behavior: 'smooth' });
                        }
                    } else {
                        if (track.scrollLeft <= 15) {
                            track.scrollTo({ left: maxScroll, behavior: 'smooth' });
                        } else {
                            track.scrollBy({ left: -step, behavior: 'smooth' });
                        }
                    }
                }

                if (prevBtn) {
                    prevBtn.addEventListener('click', () => {
                        scrollCarousel('prev');
                        resetAuto();
                    });
                }

                if (nextBtn) {
                    nextBtn.addEventListener('click', () => {
                        scrollCarousel('next');
                        resetAuto();
                    });
                }

                // Render & Update Dots
                if (dotsContainer) {
                    const cards = track.querySelectorAll(':scope > div');
                    const dotCount = Math.min(cards.length, 6);
                    dotsContainer.innerHTML = '';
                    for (let i = 0; i < dotCount; i++) {
                        const dot = document.createElement('button');
                        dot.type = 'button';
                        dot.className = `carousel-dot h-2 transition-all duration-300 rounded-full ${i === 0 ? 'bg-brand-600 w-6' : 'bg-slate-300 dark:bg-slate-700 w-2 hover:bg-slate-400'}`;
                        dot.setAttribute('aria-label', `Slide ${i + 1}`);
                        dot.addEventListener('click', () => {
                            const maxScroll = track.scrollWidth - track.clientWidth;
                            const targetLeft = dotCount > 1 ? (maxScroll / (dotCount - 1)) * i : 0;
                            track.scrollTo({ left: targetLeft, behavior: 'smooth' });
                            resetAuto();
                        });
                        dotsContainer.appendChild(dot);
                    }
                }

                function updateDots() {
                    if (!dotsContainer) return;
                    const dots = dotsContainer.querySelectorAll('.carousel-dot');
                    if (dots.length === 0) return;
                    const maxScroll = track.scrollWidth - track.clientWidth;
                    if (maxScroll <= 0) return;
                    const activeIndex = Math.min(
                        dots.length - 1,
                        Math.max(0, Math.round((track.scrollLeft / maxScroll) * (dots.length - 1)))
                    );
                    dots.forEach((dot, idx) => {
                        if (idx === activeIndex) {
                            dot.classList.add('bg-brand-600', 'w-6');
                            dot.classList.remove('bg-slate-300', 'dark:bg-slate-700', 'w-2', 'hover:bg-slate-400');
                        } else {
                            dot.classList.remove('bg-brand-600', 'w-6');
                            dot.classList.add('bg-slate-300', 'dark:bg-slate-700', 'w-2', 'hover:bg-slate-400');
                        }
                    });
                }

                track.addEventListener('scroll', () => {
                    requestAnimationFrame(updateDots);
                });

                function startAuto() {
                    if (autoTimer) clearInterval(autoTimer);
                    autoTimer = setInterval(() => {
                        if (!isHovered) {
                            scrollCarousel('next');
                        }
                    }, autoInterval);
                }

                function resetAuto() {
                    startAuto();
                }

                track.addEventListener('mouseenter', () => { isHovered = true; });
                track.addEventListener('mouseleave', () => { isHovered = false; });
                track.addEventListener('touchstart', () => { isHovered = true; }, { passive: true });
                track.addEventListener('touchend', () => { isHovered = false; resetAuto(); });

                startAuto();
            }

            // Initialize Government Sync and Talent Pool Carousels
            initBidirectionalCarousel({
                trackId: 'syncCarouselTrack',
                prevBtnId: 'syncPrevBtn',
                nextBtnId: 'syncNextBtn',
                dotsId: 'syncDots',
                autoInterval: 4000
            });

            initBidirectionalCarousel({
                trackId: 'talentCarouselTrack',
                prevBtnId: 'talentPrevBtn',
                nextBtnId: 'talentNextBtn',
                dotsId: 'talentDots',
                autoInterval: 4500
            });
        });
    </script>

</body>

</html>