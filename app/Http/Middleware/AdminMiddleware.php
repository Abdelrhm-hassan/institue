<?php

namespace App\Http\Middleware;

use App\Models\Notification;
use App\Models\admin;
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {

        // Set Language
        App::setLocale(getOption('site_language','en'));

        if(Cookie::get('Admin') != null){
            $Code = decrypt(Cookie::get('Admin'));
            if($Code){
                $Admin = admin::where('code', $Code->code)->first();
                if($Admin){
                    $request->session()->put('Admin',$Admin);
                }
            }
        }
        if($request->session()->has('Admin')){
            global $Admin;
            $Admin = admin::find($request->session()->get('Admin')->id);
            if($Admin) {
                if ($Admin->access == null || $Admin->access == '') {
                    $request->session()->forget('Admin');
                    Cookie::queue('Admin','', -1);
                    return redirect('/admin/login')->with('msg', trans('messages.access_denied'));
                } else {
                    global $Access;
                    $Access = json_decode($Admin->access);
                    view()->share('Access', $Access);
                }
            }
        }else{
            return redirect('/admin/login')->with('msg',trans('messages.no_user_found'));
        }

        # Segment
        view()->share('section', $request->segment(2));
        view()->share('url',str_replace(url('/'),'',url()->current()));

        # Notification
        $Notifications = Notification::where('type','admin')->where('view','0')->orderBy('id','DESC')->get();
        view()->share('Notifications',$Notifications);

        # Admin
        view()->share('Admin',$Admin);

        # Direction
        if($Admin->type == 'manager' && !in_array($request->segment(2),$Access) && $request->segment(2) != 'dashboard'){
            return redirect('/admin/dashboard');
        }

        return $next($request);
    }
}