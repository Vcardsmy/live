<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;
use Config;
use App;

class languageChangeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $localeLanguage = \Session::get('languageChange');


        if (! isset($localeLanguage)) {
            \App::setLocale('en');
        } else {
            \App::setLocale($localeLanguage);
        }

        return $next($request);
    }
}
