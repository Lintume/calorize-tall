<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        // Перевіряємо, чи є локаль у сесії
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        } else {
            // Визначаємо локаль із браузера
            $browserLocale = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);

            // Встановлюємо локаль: 'uk' для української або 'en' для інших
            $locale = $browserLocale === 'uk' ? 'uk' : 'en';

            // Зберігаємо локаль у сесії
            Session::put('locale', $locale);
            App::setLocale($locale);
        }

        return $next($request);
    }
}