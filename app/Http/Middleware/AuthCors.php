<?php

namespace App\Http\Middleware;
use Closure;

class AuthCors
{
    /**
     * Handle an incoming request.
     * 支持跨域访问
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $response->header('Access-Control-Allow-Origin', isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '*');
//        $response->header('Access-Control-Allow-Origin', 'http://localhost:8080');
        $response->header('Access-Control-Allow-Headers', 'X-XSRF-TOKEN,x-requested-with,Origin, Content-Type, Cookie, Accept, multipart/form-data, application/json,credentials');
        $response->header('Access-Control-Allow-Methods', 'GET, POST, PATCH, PUT, OPTIONS');
        $response->header('Access-Control-Allow-Credentials', 'true');
        return $response;
    }
}
