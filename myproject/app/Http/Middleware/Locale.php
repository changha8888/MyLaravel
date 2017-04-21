<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Config;
use App;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)

    {
       
        $locale = Session::has('locale') ? Session::get('locale') : 'en';
        App::setlocale($locale);

        return $next($request);
    }
}
