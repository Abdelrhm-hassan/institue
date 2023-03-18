<?php

namespace App\Http\Controllers;

use App\Classes\Stripe\Stripe;
use App\Classes\ZarinPal;
use App\Mail\ConfirmMail;
use App\Models\Appeal;
use App\Models\Bank;
use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\ChatReport;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Content;
use App\Models\Document;
use App\Models\DocumentMessage;
use App\Models\Factor;
use App\Models\Offer;
use App\Models\Price;
use App\Models\Project;
use App\Models\ProjectFile;
use App\Models\Report;
use App\Models\Revision;
use App\Models\RevisionMessage;
use App\Models\SmsTemplate;
use App\Models\Ticket;
use App\Models\Transaction;
use App\Models\Withdraw;
use App\Models\Sell;
use foo\bar;
use http\Url;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;
use App\Models\Category;
use App\Models\Notification;
// use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Kavenegar\KavenegarApi;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use PHPUnit\TextUI\ResultPrinter;
// use Psy\Util\Str;
use voku\helper\ASCII;
use function Symfony\Component\String\b;
use App\Models\classRoom;
use App\Models\student;
use Illuminate\Http\Request;
use DB; 
use Illuminate\Support\Str;
use Carbon\Carbon; 
use Mail;
class StudentController extends Controller
{
     
    private function strip_tags_content($string) {
        $string = preg_replace ('/<[^>]*>/', ' ', $string);
        $string = str_replace("\r", '', $string);
        $string = str_replace("\n", ' ', $string);
        $string = str_replace("\t", ' ', $string);
        $string = str_replace("&nbsp;", ' ', $string);
        $string = str_replace("&quot;", '"', $string);
        $string = trim(preg_replace('/ {2,}/', ' ', $string));
        return $string;
    }
   
    public function forgetpasswordlink(Request $request){
       $user_data= DB::table('password_resets')->where('token',$request->token)->first();
        return view(env('ADMIN_TEMPLATE').'.reset',['token' => $request->token,'email'=>$user_data->email]);
    }
    public function newPassword(Request $request){
       
        $user=student::where('email',$request->email);
        if($user)
        {
            $user->update([
                'password'=>encrypt($request->newpassword)
            ]);
        }
    
         return view(env('ADMIN_TEMPLATE').'.login');
     }

    
   
    
     ##login
         public function login(Request $request){
        if($request->session()->has('User')) {
            return redirect('/user/dashboard');
        }
        if(Cookie::get('User') != null){
            return redirect('/user/dashboard');
        }

        return view(env('USER_TEMPLATE').'.login');
    }
    public function loginDo(Request $request){
        $code = $request->username;
        $passWord = $request->password;

        $Check = student::where('code', $code)->where('status','active')->first();
        if(!$Check)
            return back()->with('msg',trans('admin.no_user_found'));
        if(decrypt($Check->password) != $passWord)
            return back()->with('msg',trans('admin.no_user_found'));

        if(isset($request->remember)){
            Cookie::queue('User',encrypt($code), 1000000);
        }
        global $User;
        $User = $Check;
        $request->session()->put('User',$Check);
        return redirect('/user/dashboard')->with('msg', trans('admin.login_successfully'));
    }
    public function logout(Request $request){
        $request->session()->forget('User');
        Cookie::queue('User','', -1);
        return redirect('/user');
    }

    public function forget(){
        return view(env('USER_TEMPLATE').'.forget');
    }
    public function forgetDo(Request $request){}
    public function register(){
        if(getOption('new_user_enable') == 0)
            return back()->with('msg', trans('admin.user_register_disabled'));
        return view(env('USER_TEMPLATE').'.register');
    }
    public function registerDo(Request $request){
        ## Duplicate
        if(duplicate_email($request->email))
            return back()->with('msg', trans('admin.duplicate_email'));
        if(env('REGISTER_TYPE') != 'email') {
            if (duplicate_phone($request->phone))
                return back()->with('msg', trans('admin.duplicate_phone'));
            if ($request->password != $request->re_password)
                return back()->with('msg', trans('admin.password_not_same'));

            $User = User::create([
                'username'   => $request->email,
                'password'   => encrypt($request->password),
                'phone'      => $request->phone,
                'email'      => $request->email,
                'mode'       => getOption('user_default_category'),
                'type'       => 'user',
                'token'      => \Illuminate\Support\Str::random(64)
            ]);
        }else{
            $User = User::create([
                'username'   => $request->email,
                'email'      => $request->email,
                'password'   => \Illuminate\Support\Str::random(),
                'mode'       => getOption('user_default_category'),
                'type'       => 'user',
                'token'      => \Illuminate\Support\Str::random(64)
            ]);
        }




        if(getOption('new_user_mode') == 'active'){
            $request->session()->put('User',$User);
            return redirect('/user/dashboard')->with('msg', trans('messages.register_successfully'));
        }
        if(getOption('new_user_mode') == 'confirm-sms'){
            return redirect('/user/confirm?email='+$request->phone)->with('msg', trans('messages.register_confirm_sms'));
        }
        if(getOption('new_user_mode') == 'confirm-email'){
            return redirect('/user/confirm?email='+$request->phone)->with('msg', trans('messages.register_confirm_email'));
        }
    }
    public function confirm(Request $request){
        global $User;
        if(isset($request->action) && $request->action == 'send-sms'){
            $code = rand(0000,9999);
            sendSms($User->mobile,$code);
            User::find($User->id)->update(['verification_time'=>time(),'code'=>$code]);
            return back()->with('msg',trans('admin.send_successfully'));
        }
        if(isset($request->action) && $request->action == 'active-sms'){
            if($User->code == $request->code){
                User::find($User->id)->update(['verification_time'=>0,'code'=>null,'confirm_sms'=>0]);
                return back()->with('msg',trans('admin.active_successfully'));
            }else{
                return back()->with('msg',trans('admin.The_code_entered_is_incorrect'));
            }
        }
        if(isset($request->action) && $request->action == 'send-email'){
            $code = rand(0000,9999);
            Mail::to($User->email)->send(new ConfirmMail(['code'=>$code]));
            User::find($User->id)->update(['verification_time'=>time(),'code'=>$code]);
            return back()->with('msg', trans('admin.Please_check_your_email_inbox'));
        }
        if(isset($request->action) && $request->action == 'active-email'){
            if($User->code == $request->code){
                User::find($User->id)->update(['verification_time'=>0,'code'=>null,'confirm_email'=>0]);
                return back()->with('msg',trans('admin.active_successfully'));
            }else{
                return back()->with('msg',trans('admin.The_code_entered_is_incorrect'));
            }
        }

        if($User->confirm_sms == 1 || $User->confirm_email == 1) {
            return view(env('USER_TEMPLATE').'.confirm');
        }else{
            return redirect('/user/dashboard');
        }

    }

   
 #### students ####
 ### Dashboard ###
 public function dashboard(){
    global $User;
    $blog = Content::where('type','blog')->where('mode','publish')->orderBy('id','DESC')->take(3)->get();
    // $projects = Project::where('user_id', $User->id)->take(5)->orderBy('id','DESC')->get();        
    $notification = Notification::where('user_id',$User->id)->where('view','0')->orderBy('id','DESC')->take(3)->get();
   
    
    return view(env('USER_TEMPLATE').'.dashboard',[
        'blog'          =>$blog,
        // 'projects'      =>$projects,
        'notifications' =>$notification

    ]);
}

 ### Notification ##
 public function notificationList(){
    global $User;
    
    if($User->type ='student'){

    $list = Notification::where('user_id',$User->id)->where('type','student')->orderBy('id','DESC')->paginate(15);
    }else{
        
    
    $list = Notification::where('user_id',$User->id)->where('type','doctor')->orderBy('id','DESC')->paginate(15);
    }
    foreach ($list as $item){
        Notification::find($item->id)->update(['view'=>1]);
    }
    return view(env('USER_TEMPLATE').'.notification.list',['list'=>$list]);
}
public function notificationItem($id){
    global $User;
    $notification = Notification::where('user_id',$User->id)->where('type','student')->orWhere('user_id',0)->find($id);
    if(!$notification)
        return  back()->with('msg', trans('admin.access_denied'));

    return view(env('USER_TEMPLATE').'.notification.item',['notification'=>$notification]);
}
  ## Chat ##
    public function lastSeen(){
        global $User;
        if($User){
            student::find($User->id)->update(['last_seen'=>time()]);
        }
    }
    public function chat(){
        global $User;
        $list = Chat::where('sender_id',$User->id)->orWhere('receiver_id',$User->id)->orderBy('updated_at','DESC')->get();
        return view(env('USER_TEMPLATE').'.chat.chat',['list'=>$list]);
    }
    public function chatIframe(){
        global $User;
        $list = Chat::where('sender_id',$User->id)->orWhere('receiver_id',$User->id)->orderBy('updated_at','DESC')->get();
        $messages = SmsTemplate::orderBy('id')->get();
        return view(env('USER_TEMPLATE').'.chat.iframe',['list'=>$list,'messages'=>$messages]);
    }
    public function chatSend(Request  $request){
        global $User;
        if(isset($request->msg) && $request->receiver_id != '' && $request->msg != '' && isset($User)){
            ## Duplicate
           $Chat = Chat::where(function ($s) use ($User,$request){
               $s->where('sender_id',$User->id)->where('receiver_id',$request->receiver_id);
           })->orWhere(function ($r) use ($User, $request){
               $r->where('receiver_id',$User->id)->where('sender_id',$request->receiver_id);
           })->first();


           if(isset($Chat)){
               $request->request->add(['chat_id'=>$Chat->id]);
           }else{
               $Chat = Chat::create([
                   'sender_id'  => $User->id,
                   'receiver_id'=> $request->receiver_id,
               ]);
               $request->request->add(['chat_id'=>$Chat->id]);
           }


           ChatMessage::create([
               'chat_id'    => $request->chat_id,
               'sender_id'  => $User->id,
               'receiver_id'=> $request->receiver_id,
               'message'    => $request->msg,
           ]);

           if($request->sms == 1){

           }
           $Chat->touch();
        }
    }
    public function chatView($user_id = null){
        $messages = [];
        global $User;
        if(isset($User) && $user_id != null){
            $chat = Chat::where(function ($w) use ($User,$user_id){
                $w->where('sender_id',$User->id)->where('receiver_id',$user_id);
            })->orWhere(function ($r) use ($User,$user_id){
                $r->where('receiver_id',$User->id)->where('sender_id',$user_id);
            })->first();
            if($chat){
                $chatMessages = ChatMessage::where('chat_id',$chat->id)->get()->toArray();
                ChatMessage::where('chat_id', $chat->id)->where('receiver_id', $User->id)->update(['view'=>1]);
                foreach ($chatMessages as $index=>$message){
                    $messages[] = [
                        'message'   => $message['message'],
                        'type'      => ($message['sender_id'] == $User->id)?'send':'receive',
                        'date'      => getJDate($message['created_at']),
                        'view'      => $message['view'],
                        'file'      => $message['file']
                    ];
                }
            }
        }

        $userFind = student::find($user_id);
        return view(env('USER_TEMPLATE').'.chat.ajax',['messages'=>$messages,'avatar'=>avatar($userFind->avatar),'name'=>$userFind->name]);
    }
    public function chatOnline(){
        $contacts = [];
        global $User;
        if($User) {
            $list = Chat::with(['sender', 'receiver'])->where('sender_id', $User->id)->orWhere('receiver_id', $User->id)->orderBy('id','DESC')->get();
            foreach ($list as $item) {
                if($item->sender_id == $User->id){
                    $contacts[] = [
                        'user_id'   => $item->receiver_id,
                        'avatar'    => $item->receiver->avatar,
                        'name'      => $item->receiver->name,
                        'username'  => $item->receiver->username,
                        'online'    => ($item->receiver->last_seen > time() - 60)?1:0
                    ];
                }else{
                    $contacts[] = [
                        'user_id'   => $item->sender_id,
                        'avatar'    => $item->sender->avatar,
                        'name'      => $item->sender->name,
                        'username'  => $item->sender->username,
                        'online'    => ($item->sender->last_seen > time() - 60)?1:0
                    ];
                }
            }
        }
        return $contacts;
    }
    public function chatSearch($q){
        global $User;
        $list = [];
        if(strlen($q) >= 2 && isset($User)){
            $list = student::where('code','LIKE','%'.$q.'%')->orWhere('email','LIKE','%'.$q.'%')->orWhere('name','LIKE','%'.$q.'%')->select(['name','email','id','avatar','last_seen'])->take(15)->get()->toArray();
        }
        foreach ($list as $index=>$item){
            if($item['last_seen'] > time() - 60){
                $list[$index]['online'] = 1;
            }
            if($item['name'] == '' || $item['name'] == null){
                $list[$index]['name'] = $item['email'];
            }
            if($item['avatar'] == '' || $item['avatar'] == null){
                $list[$index]['avatar'] = '/assets/user/img/avatar.png';
            }
        }
        return $list;
    }
    public function chatAttach(Request $request){
        global $User;

        if($request->has('attach')){
            $Chat = [];
            if($request->receiver_id != '' && isset($User)){
                ## Duplicate
                $Chat = Chat::where(function ($s) use ($User,$request){
                    $s->where('sender_id',$User->id)->where('receiver_id',$request->receiver_id);
                })->orWhere(function ($r) use ($User, $request){
                    $r->where('receiver_id',$User->id)->where('sender_id',$request->receiver_id);
                })->first();
                if(isset($Chat)){
                    $request->request->add(['chat_id'=>$Chat->id]);
                }else{
                    $Chat = Chat::create([
                        'sender_id'  => $User->id,
                        'receiver_id'=> $request->receiver_id,
                    ]);
                    $request->request->add(['chat_id'=>$Chat->id]);
                }
            }else{
                return ['status'=>'error','message'=>trans('admin.Please_select_a_contact')];
            }


            if($request->file('attach')->getClientOriginalExtension() == 'zip' || $request->file('attach')->getClientOriginalExtension() == 'jpg' || $request->file('attach')->getClientOriginalExtension() == 'jpeg' || $request->file('attach')->getClientOriginalExtension() == 'png'){
                $name = \Illuminate\Support\Str::random(30).'.'.$request->file('attach')->getClientOriginalExtension();
                $request->file('attach')->storeAs('/chat',$name,'file-manager');
                ChatMessage::create([
                    'chat_id'    => $Chat->id,
                    'sender_id'  => $User->id,
                    'receiver_id'=> $request->receiver_id,
                    'message'    => $request->file('attach')->getClientOriginalName(),
                    'file'       => $name
                ]);
                return ['status'=>'success'];
            }else{
                return ['status'=>'error','message'=>trans('admin.select_a_photo_in_jpeg_or_png_format')];
            }

            return ['status'=>$request->receiver_id];
        }
    }
    public function chatReport(Request $request){
        global $User;
        $request->request->add(['reporter_id'=>$request->reporter_id]);
        ## Find Chat
        $Chat = Chat::where(function ($s) use ($User,$request){
            $s->where('sender_id',$User->id)->where('receiver_id',$request->reporter_id);
        })->orWhere(function ($r) use ($User, $request){
            $r->where('receiver_id',$User->id)->where('sender_id',$request->reporter_id);
        })->first();

        if(!$Chat)
            return ['status'=>'error','message'=>trans('admin.No_shared_chats_found')];

        ## Duplicate
        $Report = ChatReport::where('reporter_id', $User->id)->where('chat_id', $Chat->id)->where('mode','request')->count();
        if($Report > 0)
            return ['status'=>'error','message'=>trans('admin.You_currently_have_an_open_report')];

        ChatReport::create([
           'description'    => $request->description,
            'reporter_id'   => $User->id,
            'chat_id'       => $Chat->id,
            'mode'          => 'request',
        ]);

        return ['status'=>'success','message'=>trans('admin.Violation_report_sent_to_relevant_expert')];
    }
    public function chatSendSms(Request $request){
        global $User;
        $template = $request->template;
        $receiver = $request->receiver;

        $smsTemplate = SmsTemplate::find($template);
        if(!$template){
            return json_encode(['status'=>'error']);
        }

        $price = smsPrice($smsTemplate->text);
        if($price > $User->sms_credit)
            return json_encode(['status'=>'credit']);


        //smsChat();
        $receiverUser = User::find($receiver);
        User::find($User->id)->update(['sms_credit'=>$User->sms_credit - $price]);
        $api = new KavenegarApi(env('KAVENEGAR_APIKEY',''));
        $api->VerifyLookup($receiverUser->phone,$receiverUser->phone, null,null,$smsTemplate->type);
        return json_encode(['status'=>'success']);
    }

    ##student crud
    public function List(){
     $list = student::where('type','student')->orderBy('id','Desc');
        
       ### Filters ####
       
        if(isset($_GET['username']) && $_GET['username'] != ''){
           $list->where('username','LIKE','%'.$_GET['username'].'%');
       }
       if(isset($_GET['name']) && $_GET['name'] != ''){
           $list->where('name','LIKE','%'.$_GET['name'].'%');
       }
       if(isset($_GET['phone']) && $_GET['phone'] != ''){
           $list->where('phone','LIKE','%'.$_GET['phone'].'%');
       }
       if(isset($_GET['email']) && $_GET['email'] != ''){
           $list->where('email','LIKE','%'.$_GET['email'].'%');
       }
       if(isset($_GET['mode']) && $_GET['mode'] != ''){
           $list->where('mode', $_GET['mode']);
       }
       if(isset($_GET['id']) && $_GET['id'] != ''){
           $list->where('id', $_GET['id']);
       }

       return view(env('ADMIN_TEMPLATE').'.student.list',['list'=>$list->paginate(20)]);
   }
   public function Delete($id){
       student::find($id)->delete();
       return back()->with('msg',trans('admin.delete_successfully'));
   }
      public function create()
    {
        $class=classRoom::orderBy('id','DESC')->get();
        return view(env('ADMIN_TEMPLATE').'.student.new',['class'=>$class]);

    
    }
    public function store(Request $request)
    {
        $name = $request->name;
        $code = $request->code;
        $email = $request->email;
        $password = $request->password;
        $status = $request->status;
        $gender = $request->gender;
        $phone = $request->phone;
        $grade= $request->grade;
        $photo= $request->photo;
        $class_id= $request->class_id;

        $User = student::where('code', $code)->orWhere('phone',$phone)->first();
        if($User)
                return $this->error(-1,"Your Email is Exist  Plesse Login ");
        if(!$User) 
        {
            if(isset($photo)){
                // save img shop_photo
                $shopPhoto=$request->file('photo');
                $img_name=$shopPhoto->getClientOriginalName();
                
                $request->file('photo')->move(getcwd().'/assets/student/img/',$img_name);
            }
                $User = student::create([
                    
                    'name'        => $name,
                    'code'        => $code,
                    'password'    => encrypt($password),
                    'email'       => $email,
                    'grade'       => $grade,
                    'phone'       => $phone,
                    'status'      => $status,
                    'photo'       =>$img_name,
                    'gender'      => $gender,
                    'class_id'    => 1,
                    'type'        =>'student',
                    'token'       => Str::random(64),
                ]);
                
            
        }
        return redirect('/admin/student/list')->with('msg', trans('admin.added_successfully'));

    }
   
    public function show($id)
    {
        $user=student::find($id);
        return view(env('ADMIN_TEMPLATE').'.student.profile',['profile'=>$user]);

    }

    
    public function Edit($id)
    {
        $class=classRoom::orderBy('id','DESC')->get();

        $edit = student::find($id);    
        $password=decrypt($edit->password);
        return view(env('ADMIN_TEMPLATE').'.student.new',['edit'=>$edit,'password'=>$password,'class'=>$class]);



    }

    public function update(Request $request, student $student)
    {
        $name = $request->name;
        $code = $request->code;
        $email = $request->email;
        $password = $request->password;
        $status = $request->status;
        $gender = $request->gender;
        $phone = $request->phone;
        $grade= $request->grade;
        $photo= $request->photo;
        $class_id= $request->class_id;

        $User = student::find($request->id);
       
        
            if(isset($photo)){
                // save img shop_photo
                $shopPhoto=$request->file('photo');
                $img_name=$shopPhoto->getClientOriginalName();
                
                $request->file('photo')->move(getcwd().'/assets/student/img/',$img_name);
            }
                $User->update([
                    'name'        => $name,
                    'code'        => $code,
                    'password'    => encrypt($password),
                    'email'       => $email,
                    'grade'       => $grade,
                    'phone'       => $phone,
                    'status'      => $status,
                    'photo'       =>$img_name,
                    'gender'      => $gender,
                    'class_id'    => $class_id,
                    'token'       => Str::random(64),
                ]);
            
        
        return redirect('/admin/student/list')->with('msg', trans('admin.added_successfully'));
    }
    ## Approved materials ##
    public function approvedMaterials(){
        
    }
  
}