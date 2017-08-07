<?php

namespace ResultSystems\Cors;

use Closure;
use Config;

class CorsMiddleware
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

        $response = $next($request);
        $response->headers->set('Access-Control-Allow-Origin' , $allow);
        $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE, PATCH');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Accept, Authorization, X-Requested-With, Origin');

        return $response;
    }

    public function getPermission()
    {
        $permissions = Config::get('cors.permissions', '*');

        if ($permissions == '*' || $permissions == ['*']) {
            return '*';
        }

        if (!isset($_SERVER['HTTP_REFERER'])) {
          return '*';
        }
        $url = parse_url($_SERVER['HTTP_REFERER']);

        if (!is_array($permissions)) {
            $permissions = [$permissions];
        }

        if (in_array($url['host'], $permissions)) {
            return $url['scheme'].'://'.$url['host'];
        }
        if (in_array($url['host'].':'.$url['port'], $permissions)) {
            return $url['scheme'].'://'.$url['host'].':'.$url['port'];
        }

        return $url['scheme'].'://'.current($permissions);
    }
}
