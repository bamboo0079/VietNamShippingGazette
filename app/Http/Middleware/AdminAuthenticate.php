<?php

namespace App\Http\Middleware;
use Closure;
use Session;
use Config;
use App;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AdminAuthenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('admin.login');
        }
    }
    public function handle($request, Closure $next)
    {
        $locale = Session::get('locale', Config::get('app.locale'));
        App::setLocale($locale);
        return $next($request);
    }
}
