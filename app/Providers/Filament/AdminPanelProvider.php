<?php

namespace App\Providers\Filament;

use App\Filament\Resources\PendaftaranResource\Widgets\IDChart;
use App\Filament\Resources\PendaftaranResource\Widgets\JobChart;
use App\Filament\Resources\PendaftaranResource\Widgets\PendaftaranChart;
use App\Filament\Resources\PendaftaranResource\Widgets\PenerbanganChart;
use App\Filament\Resources\PendaftaranResource\Widgets\PraMedicalChart;
use App\Filament\Resources\PendaftaranResource\Widgets\SiapKerjaChart;
use App\Filament\Widgets\StatusOverviewWidget;
use Awcodes\FilamentVersions\VersionsPlugin;
use Awcodes\LightSwitch\Enums\Alignment;
use Awcodes\LightSwitch\LightSwitchPlugin;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use EightyNine\Approvals\ApprovalPlugin;
use Filament\Enums\ThemeMode;
use Filament\Forms\Components\FileUpload;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Pages\Auth\EditProfile;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Hasnayeen\Themes\Http\Middleware\SetTheme;
use Hasnayeen\Themes\ThemesPlugin;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Jeffgreco13\FilamentBreezy\BreezyCore;
use Leandrocfe\FilamentApexCharts\FilamentApexChartsPlugin;
use Njxqlus\FilamentProgressbar\FilamentProgressbarPlugin;
use Rupadana\FilamentAnnounce\FilamentAnnouncePlugin;
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
            ->font('JetBrains Mono')
            ->defaultThemeMode(ThemeMode::Dark)
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
            // ->brandLogo(asset('images/icon.png'))
            // ->darkModeBrandLogo(asset('images/icon.png'))
            // ->brandLogoHeight('3rem')
            ->favicon(asset('images/icon.png'))
            ->breadcrumbs(true)
            ->colors([
                'primary' => Color::Slate,
                'gray' => Color::Zinc,
            ])
            ->viteTheme('resources/css/filament/admin/theme.css')
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
                SetTheme::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugins([
                VersionsPlugin::make(),
                // ApprovalPlugin::make(),
                ThemesPlugin::make()
                    ->canViewThemesPage(fn () => auth()->user()?->hasRole('super_admin') ?? false),
                //-----------------------------------User Bukan Error------------
                // LightSwitchPlugin::make()
                //     ->position(Alignment::TopCenter),
                // FilamentBackgroundsPlugin::make()
                //     ->imageProvider(
                //         MyImages::make()
                //             ->directory('images/backgrounds')
                //     ),
                FilamentUsersPlugin::make(),
                FilamentShieldPlugin::make()
                    ->gridColumns([
                        'default' => 1,
                        'sm' => 2,
                        'lg' => 3,
                    ])
                    ->sectionColumnSpan(1)
                    ->checkboxListColumns([
                        'default' => 1,
                        'sm' => 2,
                        'lg' => 2,
                    ])
                    ->resourceCheckboxListColumns([
                        'default' => 1,
                        'sm' => 2,
                    ]),
                FilamentApexChartsPlugin::make(),
                FilamentPWAPlugin::make(),
                FilamentSettingsHubPlugin::make()
                    ->allowShield()
                    ->allowLocationSettings()
                    ->allowSiteSettings()
                    ->allowSocialMenuSettings(),
                BreezyCore::make()
                    ->avatarUploadComponent(fn () => FileUpload::make('avatar_url')->disk('profile-photos'))
                    ->myProfile(
                        shouldRegisterUserMenu: true, // Sets the 'account' link in the panel User Menu (default = true)
                        shouldRegisterNavigation: false, // Adds a main navigation item for the My Profile page (default = false)
                        navigationGroup: 'Settings', // Sets the navigation group for the My Profile page (default = null)
                        hasAvatars: false, // Enables the avatar upload form component (default = false)
                        slug: 'my-profile' // Sets the slug for the profile page (default = 'my-profile')
                    ),
                FilamentProgressbarPlugin::make()->color('red'),
                FilamentAnnouncePlugin::make()
                    ->pollingInterval('30s') // optional, by default it is set to null
                    ->defaultColor(Color::Blue), // optional, by default it is set to "primary"

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
