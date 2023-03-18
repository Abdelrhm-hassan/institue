<?php

namespace App\Http\Middleware;
use App\Model\Category;
use App\Model\Link;
use App\Models\student;
use App\Models\User;
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;

class WebMiddleware
{
    public function handle($request, Closure $next)
    {

        // Set Language
        App::setLocale(getOption('site_language','en'));

        if(Cookie::get('User') != null){
            $mobile = decrypt(Cookie::get('User'));
            if($mobile){
                $User = student::where('mobile', $mobile)->first();
                if($User){
                    $request->session()->put('User',$User);
                }
            }
        }

        if($request->session()->has('User')){
            global $User;
            $User = student::find($request->session()->get('User')->id);
            view()->share('User', $User);
        }

        return $next($request);
    }
}