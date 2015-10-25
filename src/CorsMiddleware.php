<?php

namespace ResultSystems\Cors;

use Closure;
use Config;
use Illuminate\Contracts\Routing\Middleware;

class CorsMiddleware implements Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $allow = $this->getPermission();

        return $next($request)->header('Access-Control-Allow-Origin', $allow)
            ->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE')
            ->header('Access-Control-Allow-Headers', 'Content-Type, Accept, Authorization, X-Requested-With, Origin');
    }

    public function getPermission()
    {
        $allow = '';
        $permissions = Config::get('cors.permissions', ['*']);

        if ($permissions == '*' || ['*']) {
            return '*';
        }

        if (isset($_SERVER['HTTP_REFERER'])) {
            $url = parse_url($_SERVER['HTTP_REFERER']);

            if (in_array($url['host'], $permissions)) {
                return $url['scheme'].'://'.$url['host'];
            }
        }

        return '';
    }
}
