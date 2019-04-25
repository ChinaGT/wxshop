<?php

namespace App\Http\Middleware;

use App\Model\User;
use Closure;
use Illuminate\Http\Request;

class LogMiddleware
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

//        $name=$request->session()->get('user_id');
//        dd($name) ;
        $user_id=session('user_id');
        if(!$request->session()->has('user_id')){
            return redirect('login');
        }else{
            $user = new User();
            $arr=$user->where('user_id',$user_id)->select('openid');
            if(empty($arr)){
                return redirect('wxbd');
            }

        }
        return $next($request);
    }
}
