<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Support\Facades\Blade;
use App\Filament\Auth\CustomLogin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login(CustomLogin::class)

            ->renderHook(
                'panels::head.end',
                fn () => Blade::render(<<<HTML
                    <style>
                        /* ============================================
                         * PREMIUM LOGIN PAGE STYLES
                         * Target: .fi-simple-layout (hanya Login/Register)
                         * ============================================ */

                        /* --- KEYFRAMES --- */
                        @keyframes loginFadeIn {
                            from { opacity: 0; transform: translateY(30px); }
                            to   { opacity: 1; transform: translateY(0); }
                        }
                        @keyframes loginPulseGlow {
                            0%, 100% { box-shadow: 0 0 30px rgba(59, 130, 246, 0.15); }
                            50%      { box-shadow: 0 0 50px rgba(59, 130, 246, 0.25); }
                        }
                        @keyframes loginShimmer {
                            0%   { background-position: -200% center; }
                            100% { background-position: 200% center; }
                        }

                        /* --- FULL-PAGE BACKGROUND --- */
                        .fi-simple-layout {
                            background-image:
                                linear-gradient(135deg, rgba(10, 25, 60, 0.82), rgba(30, 58, 138, 0.75), rgba(0, 0, 0, 0.85)),
                                url('/image/bglogin.jpg') !important;
                            background-size: cover !important;
                            background-position: center !important;
                            background-repeat: no-repeat !important;
                            background-attachment: fixed !important;
                            min-height: 100vh !important;
                            width: 100% !important;
                            background-color: transparent !important;
                            display: flex !important;
                            align-items: center !important;
                            justify-content: center !important;
                        }

                        /* --- OUTER SQUARE CONTAINER (wrapper) --- */
                        .fi-simple-layout > div {
                            width: 520px !important;
                            height: 520px !important;
                            aspect-ratio: 1 / 1 !important;
                            display: flex !important;
                            align-items: center !important;
                            justify-content: center !important;
                            background: rgba(30, 58, 138, 0.35) !important;
                            backdrop-filter: blur(16px) !important;
                            -webkit-backdrop-filter: blur(16px) !important;
                            border: 1px solid rgba(255, 255, 255, 0.12) !important;
                            border-radius: 8px !important;
                            padding: 2rem !important;
                            box-sizing: border-box !important;
                        }

                        /* --- SQUARE GLASSMORPHISM LOGIN CARD (inner) --- */
                        .fi-simple-main-ctn {
                            background: rgba(0, 0, 0, 0.55) !important;
                            backdrop-filter: blur(28px) saturate(180%) !important;
                            -webkit-backdrop-filter: blur(28px) saturate(180%) !important;
                            border: 1px solid rgba(255, 255, 255, 0.15) !important;
                            border-radius: 8px !important;
                            box-shadow:
                                0 25px 60px -12px rgba(0, 0, 0, 0.6),
                                inset 0 1px 0 rgba(255, 255, 255, 0.1) !important;
                            width: 100% !important;
                            height: 100% !important;
                            aspect-ratio: 1 / 1 !important;
                            padding: 2.5rem 2.5rem !important;
                            display: flex !important;
                            flex-direction: column !important;
                            align-items: center !important;
                            justify-content: center !important;
                            animation: loginFadeIn 0.8s ease-out !important;
                            position: relative !important;
                            overflow: hidden !important;
                            box-sizing: border-box !important;
                        }
                        /* Shimmer accent line di atas card */
                        .fi-simple-main-ctn::before {
                            content: '';
                            position: absolute;
                            top: 0; left: 0; right: 0;
                            height: 3px;
                            background: linear-gradient(90deg, transparent, #facc15, #3b82f6, transparent);
                            background-size: 200% auto;
                            animation: loginShimmer 3s linear infinite;
                            border-radius: 8px 8px 0 0;
                        }
                        /* Form inside card — full width */
                        .fi-simple-main-ctn > form {
                            width: 100% !important;
                        }

                        /* --- LOGO BRANDING (injected via CustomLogin) --- */
                        .fi-simple-header {
                            display: flex !important;
                            flex-direction: column !important;
                            align-items: center !important;
                            gap: 0.5rem !important;
                        }

                        /* --- HEADING & SUBHEADING (compact) --- */
                        .fi-simple-header-heading {
                            color: #ffffff !important;
                            font-weight: 700 !important;
                            font-size: 1.15rem !important;
                            letter-spacing: -0.01em !important;
                            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3) !important;
                        }
                        .fi-simple-header-subheading {
                            color: rgba(255, 255, 255, 0.6) !important;
                            font-size: 0.72rem !important;
                            font-weight: 400 !important;
                        }

                        /* --- FORM LABELS --- */
                        .fi-simple-main-ctn .fi-fo-field-wrp label {
                            color: rgba(255, 255, 255, 0.85) !important;
                            font-weight: 600 !important;
                            font-size: 0.72rem !important;
                            letter-spacing: 0.03em !important;
                            text-transform: uppercase !important;
                        }

                        /* --- INPUT FIELDS --- */
                        .fi-simple-main-ctn .fi-input {
                            background: rgba(255, 255, 255, 0.1) !important;
                            border: 1px solid rgba(255, 255, 255, 0.2) !important;
                            border-radius: 6px !important;
                            color: #ffffff !important;
                            transition: all 0.3s ease !important;
                        }
                        .fi-simple-main-ctn .fi-input::placeholder {
                            color: rgba(255, 255, 255, 0.4) !important;
                        }
                        .fi-simple-main-ctn .fi-input:focus {
                            background: rgba(255, 255, 255, 0.15) !important;
                            border-color: #facc15 !important;
                            box-shadow: 0 0 0 3px rgba(250, 204, 21, 0.2) !important;
                            outline: none !important;
                        }
                        /* Input wrapper / container — relative for icon overlay */
                        .fi-simple-main-ctn .fi-input-wrp {
                            border: none !important;
                            box-shadow: none !important;
                            background: rgba(255, 255, 255, 0.1) !important;
                            border: 1px solid rgba(255, 255, 255, 0.2) !important;
                            border-radius: 6px !important;
                            overflow: visible !important;
                            position: relative !important;
                            display: flex !important;
                            align-items: center !important;
                            width: 100% !important;
                            transition: all 0.3s ease !important;
                        }
                        .fi-simple-main-ctn .fi-input-wrp:focus-within {
                            border-color: #facc15 !important;
                            box-shadow: 0 0 0 3px rgba(250, 204, 21, 0.2) !important;
                            background: rgba(255, 255, 255, 0.15) !important;
                        }
                        /* Override Filament native input — remove own border/bg */
                        .fi-simple-main-ctn .fi-input,
                        .fi-simple-main-ctn input.fi-input {
                            background: transparent !important;
                            border: none !important;
                            border-radius: 0 !important;
                            box-shadow: none !important;
                            color: #ffffff !important;
                            padding: 0.6rem 0.85rem !important;
                            font-size: 0.85rem !important;
                            width: 100% !important;
                            flex: 1 !important;
                            min-width: 0 !important;
                        }
                        .fi-simple-main-ctn .fi-input:focus {
                            background: transparent !important;
                            border: none !important;
                            box-shadow: none !important;
                            outline: none !important;
                        }

                        /* --- PASSWORD TOGGLE — hide ALL Filament default buttons --- */
                        .fi-simple-main-ctn .fi-input-wrp > button {
                            display: none !important;
                        }
                        /* Custom single eye toggle */
                        .fi-simple-main-ctn .custom-eye-toggle {
                            flex-shrink: 0;
                            padding: 0.4rem 0.65rem;
                            color: rgba(255, 255, 255, 0.55);
                            background: transparent;
                            border: none;
                            cursor: pointer;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            transition: color 0.2s ease, transform 0.2s ease;
                        }
                        .fi-simple-main-ctn .custom-eye-toggle:hover {
                            color: #facc15;
                        }
                        .fi-simple-main-ctn .custom-eye-toggle svg {
                            width: 1.4rem;
                            height: 1.4rem;
                            transition: transform 0.25s ease;
                        }
                        .fi-simple-main-ctn .custom-eye-toggle.animate-pop svg {
                            transform: scale(0.75);
                        }

                        /* --- LOGIN BUTTON --- */
                        .fi-simple-main-ctn .fi-btn-primary {
                            background: linear-gradient(135deg, #1e40af 0%, #2563eb 50%, #1e3a8a 100%) !important;
                            border: none !important;
                            border-radius: 6px !important;
                            padding: 0.6rem 1.25rem !important;
                            font-weight: 700 !important;
                            font-size: 0.85rem !important;
                            text-transform: uppercase !important;
                            letter-spacing: 0.08em !important;
                            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.4) !important;
                            transition: all 0.3s ease !important;
                            color: #ffffff !important;
                        }
                        .fi-simple-main-ctn .fi-btn-primary:hover {
                            background: linear-gradient(135deg, #facc15 0%, #eab308 50%, #facc15 100%) !important;
                            color: #1e3a8a !important;
                            box-shadow: 0 6px 25px rgba(250, 204, 21, 0.4) !important;
                            transform: translateY(-1px) !important;
                        }

                        /* --- CHECKBOX & REMEMBER ME --- */
                        .fi-simple-main-ctn .fi-checkbox-input {
                            border-color: rgba(255, 255, 255, 0.3) !important;
                            background: rgba(255, 255, 255, 0.1) !important;
                        }
                        .fi-simple-main-ctn .fi-checkbox-input:checked {
                            background-color: #facc15 !important;
                            border-color: #facc15 !important;
                        }
                        .fi-simple-main-ctn a {
                            color: #facc15 !important;
                            text-decoration: none !important;
                            font-weight: 600 !important;
                            transition: opacity 0.2s !important;
                        }
                        .fi-simple-main-ctn a:hover {
                            opacity: 0.8 !important;
                        }

                        /* --- FOOTER BRANDING --- */
                        .fi-simple-layout > div:last-child {
                            color: rgba(255, 255, 255, 0.45) !important;
                            font-size: 0.75rem !important;
                        }

                        /* --- HIDE default brand name on login --- */
                        .fi-simple-layout .fi-logo {
                            display: none !important;
                        }

                        /* --- Responsive --- */
                        @media (max-width: 640px) {
                            .fi-simple-layout > div {
                                width: 92vw !important;
                                height: 92vw !important;
                                padding: 1rem !important;
                                border-radius: 6px !important;
                            }
                            .fi-simple-main-ctn {
                                padding: 1.25rem !important;
                                border-radius: 6px !important;
                            }
                        }
                    </style>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const eyeOpen = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>';
                            const eyeClosed = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.98 8.223A10.477 10.477 0 001.934 12c1.292 4.338 5.31 7.5 10.066 7.5.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/>';

                            const wrps = document.querySelectorAll('.fi-simple-main-ctn .fi-input-wrp');
                            wrps.forEach(function(wrp) {
                                const input = wrp.querySelector('input[type="password"]');
                                if (!input) return;

                                let isHidden = true;

                                const btn = document.createElement('button');
                                btn.type = 'button';
                                btn.className = 'custom-eye-toggle';
                                btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">' + eyeClosed + '</svg>';
                                wrp.appendChild(btn);

                                btn.addEventListener('click', function() {
                                    isHidden = !isHidden;
                                    input.type = isHidden ? 'password' : 'text';

                                    btn.classList.add('animate-pop');
                                    setTimeout(function() {
                                        btn.querySelector('svg').innerHTML = isHidden ? eyeClosed : eyeOpen;
                                        btn.classList.remove('animate-pop');
                                    }, 130);
                                });
                            });
                        });
                    </script>
                HTML)
            )

            ->brandName('Dinsos Kab. Semarang')
            ->colors([
                'primary' => Color::Blue,
            ])
            ->font('Poppins')
            ->sidebarCollapsibleOnDesktop()
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
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