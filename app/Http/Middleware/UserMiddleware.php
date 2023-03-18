<?php

namespace App\Http\Middleware;

use App\Models\ChatMessage;
use App\Models\Notification;
use App\Models\User;
use App\Models\student;
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;

class UserMiddleware
{
    public function handle($request, Closure $next)
    {
        // Set Language
        App::setLocale(getOption('site_language','en'));

        if(Cookie::get('User') != null && !$request->session()->has('User')){
            $mobile = decrypt(Cookie::get('User'));
            if($mobile){
                $User = User::where('mobile', $mobile)->first();
                if($User){
                    $request->session()->put('User',$User);
                }else{
                    Cookie::queue(Cookie::forget('User'));
                }
            }
        }

        if($request->session()->has('User')){
            global $User;

            $User = student::find($request->session()->get('User')->id);

            if(($User->confrim_sms == 1 || $User->confirm_email == 1) && ($request->segment(2) != 'confirm' && $request->segment(2) != 'profile' && $request->segment(2) != 'learn'))
                return redirect('/user/confirm');

            if($User->status!= 'active') {
                $request->session()->forget('User');
                Cookie::queue('User','', -1);
                return redirect('/user')->with('msg', trans('admin.user_banned'));
            }

            if(($User->name == '' || $User->name == null || $User->password == null) && $request->segment(2) != 'profile' && $request->segment(2) != 'logout')
                return redirect('/user/profile/setting');

        }else{
            return redirect('/user/login')->with('msg',trans('admin.no_user_found'));
        }

        ## Notification
        $Notification['notification'] = Notification::where('user_id',$User->id)->where('view',0)->count();

        ## Chat
        $Notification['chat'] = ChatMessage::where('receiver_id', $User->id)->where('view',0)->count();


        # Segment
        view()->share('section', $request->segment(2));
        view()->share('url',str_replace(url('/'),'',url()->current()));


        view()->share('Notification', $Notification);
        view()->share('User', $User);
        return $next($request);
    }
}