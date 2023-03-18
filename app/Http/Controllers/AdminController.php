<?php

namespace App\Http\Controllers;

use App\Model\NotificationSetting as ModelNotificationSetting;
use App\Models\admin;
use App\Models\classRoom;
use App\Models\doctor;
use App\Models\Notification;
use App\Models\NotificationSetting;
use App\Models\Schedul;
use App\Models\student;
use App\Models\subject;
use DB; 
use Illuminate\Support\Str;
use Carbon\Carbon; 
use Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class AdminController extends Controller
{
   
    public function __construct()
    {
        global $Admin;
    }

    public function login(Request $request){
        if($request->session()->has('Admin')) {
            return redirect('/admin/dashboard');
        }
        if(Cookie::get('Admin') != null){
            return redirect('/admin/dashboard');
        }
        return view(env('ADMIN_TEMPLATE').'.login');
    }
     public function loginDo(Request $request)
    {
        $Code=$request->username;
        $passWord=$request->password;

        if($Code!=null) {
          $admin=  admin::where('code',$Code)->first();
          if($admin){
            if($passWord==$admin->password);{
                if(isset($request->remember)){
                    Cookie::queue('Admin',encrypt($Code), 1000000);
                }
                global $Admin;
                $Admin = $admin;
                $request->session()->put('Admin',$admin);
                return redirect('/admin/dashboard')->with('msg', trans('admin.login_successfully'));
            }
            return back()->with('msg',trans('admin.no_user_found'));
         }

          }
        
        
    }
    public function logout(Request $request)
    {
        $request->session()->forget('Admin');
        Cookie::queue('Admin','', -1);
        return redirect('/admin');
    }
    
    public function userLogin($id, Request $request){
        $Check = student::find($id);
        if(!$Check)
            return back()->with('msg',trans('admin.no_user_found'));
        global $User;
        $User = $Check;
        $request->session()->put('User',$Check);

        return redirect('/user/dashboard')->with('msg', trans('admin.login_successfully'));
    }
   
    
     #### Dashboard ####
     public function dashboard(){


        // $day = jdate('Y-m-d',time());
        // $month = jdate('Y-m-',time());

        $count = [];

        $count['admin']      = admin::count();
        $count['doctor']      = doctor::count();
        $count['student']      = student::count();
        $count['subject']      = subject::count();
        $count['classroom']      = classRoom::count();   
        $count['project']      = admin::count();

        $count['ticket']    = admin::count();

        $count['transaction_today'] = student::count();
        $count['transaction_month'] = admin::count();
        $count['transaction']       = admin::count();

        $count['site_income_day']       = Schedul::count();
        $count['site_income_month']     = Schedul::count();;
        $count['site_income_total']     = Schedul::count();;


        return view(env('ADMIN_TEMPLATE').'.dashboard',['count'=>$count]);
    }
  
    #### Notification ####
    public function notificationList(){
        $list = Notification::orderBy('id','DESC');
        ## Filters
        if(isset($_GET['title']) && $_GET['title'] != ''){
            $list->where('title','LIKE','%'.$_GET['title'].'%');
        }
        if(isset($_GET['username']) && $_GET['username'] != ''){
            $users = admin::where('username','LIKE','%'.$_GET['username'].'%')->pluck('id')->toArray();
            $list->whereIn('username',$users);
        }
        if(isset($_GET['type']) && $_GET['type'] != ''){
            $list->where('type','LIKE','%'.$_GET['type'].'%');
        }
        if(isset($_GET['mode']) && $_GET['mode'] != ''){
            $list->where('mode', $_GET['mode']);
        }
        if(isset($_GET['sender']) && $_GET['sender'] != ''){
            $list->where('sender', $_GET['sender']);
        }

        return view(env('ADMIN_TEMPLATE').'.notification.list',['list'=>$list->paginate(15)]);
    }
    public function notificationNew(){
        $admin = admin::get();
        $doctor = student::where('type','doctor')->get();
        $student = student::where('type','student')->get();
        return view(env('ADMIN_TEMPLATE').'.notification.new',['admin'=>$admin,'doctor'=>$doctor,'student'=>$student]);
    }
    public function notificationNewStore(Request $request){
        $type=$request->receiver;
             if($type =='doctor')
                if(isset($request->type))
            $request->request->add(['type'=>'doctor','user_id'=>$request->doctor]);
            
            if($type =='student')
                if(isset($request->type))
                $request->request->add(['type'=>'student','user_id'=>$request->student]);
                if($type=='admin')
                if(isset($request->type))
                $request->request->add(['type'=>'admin','user_id'=>$request->admin]);
                Notification::create($request->all());

        return redirect('/admin/notification/list')->with('msg', trans('admin.send_successfully'));
    }
    public function notificationEdit($id){}
    public function notificationDelete($id){
        Notification::find($id)->delete();
        return back()->with('msg', trans('admin.delete_successfully'));
    }
    public function notificationEditStore($id, Request $request){}
    public function notificationSetting(){
        $list = NotificationSetting::orderBy('sort')->get();
        return view(env('ADMIN_TEMPLATE').'.notification.setting.setting',['list'=>$list]);
    }
    public function notificationSettingEdit($id){
        $edit = NotificationSetting::find($id);
        return view(env('ADMIN_TEMPLATE').'.notification.setting.content',['edit'=>$edit]);
    }
    public function notificationSettingStore($id, Request $request){
        NotificationSetting::find($id)->update($request->all());
        return back()->with('msg',trans('admin.update_successfully'));
    }
    public function notificationSettingAction($id, Request $request){
        NotificationSetting::find($id)->update($request->all());
        return 'ok';
    }
    public function notificationAdminList(){
        $list = Notification::where('type','admin')->orderBy('id','DESC')->paginate(20);
        foreach ($list as $item){
            Notification::find($item->id)->update(['view'=>1]);
        }
        return view(env('ADMIN_TEMPLATE').'.notification.admin',['list'=>$list]);
    }
    public function notificationAdminView($id){}
}