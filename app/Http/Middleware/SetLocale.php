<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        $locale = $request->query('lang', Session::get('locale', config('app.locale')));
        Session::put('locale', $locale);
        App::setLocale($locale);

        return $next($request);
    }
}