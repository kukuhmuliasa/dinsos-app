<?php

namespace App\Filament\Auth;

use Filament\Pages\Auth\Login;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;

class CustomLogin extends Login
{
    public function getHeading(): string | Htmlable
    {
        return new HtmlString('
            <div style="display:flex; flex-direction:column; align-items:center; gap:0.5rem; margin-bottom:0.25rem;">
                <img src="' . asset('image/kabsmg.png') . '" alt="Logo Kabupaten Semarang"
                     style="height:52px; width:auto; filter:drop-shadow(0 4px 12px rgba(0,0,0,0.3)); animation:loginFadeIn 0.6s ease-out;">
                <span style="font-size:1.15rem; font-weight:700; color:#fff; letter-spacing:-0.01em; text-shadow:0 2px 8px rgba(0,0,0,0.3);">
                    Login Administrator
                </span>
            </div>
        ');
    }

    public function getSubHeading(): string | Htmlable
    {
        return new HtmlString('
            <p style="text-align:center; color:rgba(255,255,255,0.55); font-size:0.72rem; font-weight:400; margin:0; line-height:1.4;">
                Sistem Informasi Dinas Sosial<br>Kabupaten Semarang
            </p>
        ');
    }
}