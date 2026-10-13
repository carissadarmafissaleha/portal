<?php

namespace App\Providers\Filament;

use App\Filament\Resources\PendaftaranResource\Widgets\IDChart;
use App\Filament\Resources\PendaftaranResource\Widgets\JobChart;
use App\Filament\Resources\PendaftaranResource\Widgets\PendaftaranChart;
use App\Filament\Resources\PendaftaranResource\Widgets\PenerbanganChart;
use App\Filament\Resources\PendaftaranResource\Widgets\PraMedicalChart;
use App\Filament\Resources\PendaftaranResource\Widgets\SiapKerjaChart;
use App\Filament\Widgets\StatusOverviewWidget;
use Awcodes\Versions\VersionsPlugin;
use Awcodes\LightSwitch\Enums\Alignment;
use Awcodes\LightSwitch\LightSwitchPlugin;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Enums\ThemeMode;
use Filament\Forms\Components\FileUpload;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Auth\Pages\EditProfile;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Leandrocfe\FilamentApexCharts\FilamentApexChartsPlugin;
use Swis\Filament\Backgrounds\FilamentBackgroundsPlugin;
use Swis\Filament\Backgrounds\ImageProviders\MyImages;
use TomatoPHP\FilamentPWA\FilamentPWAPlugin;
use TomatoPHP\FilamentSettingsHub\FilamentSettingsHubPlugin;
use TomatoPHP\FilamentUsers\FilamentUsersPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->profile(EditProfile::class)
//            ->font('Montserrat')
            ->font('Inter')
            ->defaultThemeMode(ThemeMode::Light)
            ->registration()
            ->passwordReset()
            ->emailVerification()
            ->sidebarCollapsibleOnDesktop()
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->databaseNotifications()
            ->databaseNotificationsPolling('3s')
            ->brandLogo(asset('images/icon.png'))
            ->darkModeBrandLogo(asset('images/icon.png'))
            ->brandLogoHeight('3rem')
            ->favicon(asset('images/icon.png'))
            ->breadcrumbs(false)
            ->colors([
                'primary' => Color::Green,
            ])
            ->renderHook(
                \Filament\View\PanelsRenderHook::STYLES_AFTER,
                fn () => app(\Illuminate\Foundation\Vite::class)('resources/css/filament/admin/theme.css'),
            )
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                // Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                // Widgets\AccountWidget::class,
                StatusOverviewWidget::class,
                PendaftaranChart::class,
                PraMedicalChart::class,
                SiapKerjaChart::class,
                IDChart::class,
                JobChart::class,
                PenerbanganChart::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugins([
                VersionsPlugin::make(),
                LightSwitchPlugin::make()
                    ->position(Alignment::TopCenter),
                FilamentUsersPlugin::make(),
                FilamentShieldPlugin::make(),
                FilamentApexChartsPlugin::make(),
                FilamentPWAPlugin::make(),
                FilamentSettingsHubPlugin::make()
                    ->allowShield()
                    ->allowSiteSettings()
                    ->allowSocialMenuSettings(),
            ])
            ->navigationItems([
                NavigationItem::make('Lihat Website')
                    ->group('Settings')
                    ->url('/', shouldOpenInNewTab: true)
                    ->sort(30)
                    ->icon('heroicon-o-viewfinder-circle')
                    ->visible(fn (): bool => in_array(auth()->user()->id, [1, 2])),
                //-----------------------------------User Bukan Error------------
            ])

            ->navigationGroups([
                NavigationGroup::make()
                    ->label('PROSES')
                    ->icon('heroicon-o-arrow-path-rounded-square')
                    ->collapsible(false),
                NavigationGroup::make()
                    // ->icon('heroicon-s-squares-plus')
                    ->label('Modul')
                    ->collapsible(true),
                NavigationGroup::make()
                    // ->icon('heroicon-o-cog-6-tooth')
                    ->label('Settings')
                    ->collapsible(true),
                // NavigationGroup::make()
                //     ->label('blog')
                //     ->collapsible(true),
            ]);
    }
}
