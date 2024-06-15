<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Navigation\MenuItem;
use App\Filament\Pages\Auth\Login;
use Filament\Support\Colors\Color;
use Filament\Navigation\NavigationItem;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;

class NetworkAdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('networkAdmin')
            ->path('networkAdmin')
            ->login(Login::class)
            ->userMenuItems([
                MenuItem::make()
                ->label('My Profile')
                ->icon('heroicon-o-user-circle')
                ->url('/networkAdmin/users/4/edit')
            ])
            ->colors([
                'danger' => Color::Rose,
                'gray' => Color::Slate,
                'info' => Color::Blue,
                'primary' => Color::Green,
                'success' => Color::Emerald,
                'warning' => Color::Orange,
            ])
            ->favicon(asset('images/logooo.png'))
            ->sidebarCollapsibleOnDesktop()
            // ->navigationItems([
            //     NavigationItem::make('Map')
            //         ->url('/building-button', shouldOpenInNewTab: true)
            //         ->icon('heroicon-o-map')
            //         ->group('Computer Mapping')
            //         ->sort(2)
            // ])
            ->discoverResources(in: app_path('Filament/NetworkAdmin/Resources'), for: 'App\\Filament\\NetworkAdmin\\Resources')
            ->discoverPages(in: app_path('Filament/NetworkAdmin/Pages'), for: 'App\\Filament\\NetworkAdmin\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/NetworkAdmin/Widgets'), for: 'App\\Filament\\NetworkAdmin\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
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
            ]);
    }
}
