<?php

namespace App\Http\Middleware;

use Closure;
use App\Tools\Wxjs;

class JssdkMiddleware
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
        $jssdk = new Wxjs();
        $signpackage = $jssdk -> getSignPackage();
        //dd($signpackage);
        $wxconfig = ['signPackage'=>$signpackage];
        $request->merge($wxconfig);
        return $next($request);
    }
}
