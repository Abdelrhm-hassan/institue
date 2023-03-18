<?php

namespace App\Http\Controllers;

use App\Models\acadmic_year;
use DB; 
use Illuminate\Support\Str;
use Carbon\Carbon; 
use Mail;
use App\Models\student;
use Illuminate\Http\Request;

class DoctorController extends Controller
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
    public function forget(){
        return view(env('ADMIN_TEMPLATE').'.forget');
    }
    public function forgetDo(Request $request){
        $request->validate([
            'email' => 'required|email|exists:user',
        ]);
        $token = Str::random(64);
  
        DB::table('password_resets')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
          ]);

        Mail::send('admin_stisla/email', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('message', 'We have e-mailed your password reset link!');
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

    
   
    
   
 #### Doctors ####
    public function List(){
     $list = student::where('type','doctor')->orderBy('id','Desc');
        
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

       return view(env('ADMIN_TEMPLATE').'.doctor.list',['list'=>$list->paginate(20)]);
   }
  
   
   public function Delete($id){
       student::find($id)->delete();
       return back()->with('msg',trans('admin.delete_successfully'));
   }
   

  
    public function create()
    {
        return view(env('ADMIN_TEMPLATE').'.doctor.new');

    
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
        $linkedin= $request->linkedin;
        $photo= $request->photo;
        $bio= $request->bio;
        

        $User = student::where('code', $code)->orWhere('phone',$phone)->first();
        if($User)
                return $this->error(-1,"Your Email is Exist  Plesse Login ");
        if(!$User) 
        {
            if(isset($photo)){
                // save img shop_photo
                $shopPhoto=$request->file('photo');
                $img_name=$shopPhoto->getClientOriginalName();
                
                $request->file('photo')->move(getcwd().'/assets/doctor/img/',$img_name);
            }
                $User = student::create([
                    
                    'name'        => $name,
                    'code'        => $code,
                    'password'    => encrypt($password),
                    'email'       => $email,
                    'linkedin'    => $linkedin,
                    'phone'       => $phone,
                    'type'        =>'doctor',
                    'status'      => $status,
                    'photo'       =>$img_name,
                    'gender'      => $gender,
                    'bio'      => $this->strip_tags_content($bio),
                    'token'         => Str::random(64),
                ]);
            
        }
        return redirect('/admin/doctor/list')->with('msg', trans('admin.added_successfully'));

    }
   
    public function show($id)
    {
        $user=student::find($id);
        return view(env('ADMIN_TEMPLATE').'.doctor.profile',['profile'=>$user]);

    }

    
    public function Edit($id)
    {
        $edit = student::find($id);    
        // return $edit;
        $password=decrypt($edit->password);
        return view(env('ADMIN_TEMPLATE').'.doctor.new',['edit'=>$edit,'password'=>$password]);



    }

    public function update(Request $request)
    {
        $name = $request->name;
        $code = $request->code;
        $email = $request->email;
        $password = $request->password;
        $status = $request->status;
        $gender = $request->gender;
        $phone = $request->phone;
        $linkedin= $request->linkedin;
        $photo= $request->photo;
        $bio= $request->bio;

        $User = student::find($request->id);
       
        
            if(isset($photo)){
                // save img shop_photo
                $shopPhoto=$request->file('photo');
                $img_name=$shopPhoto->getClientOriginalName();
                
                $request->file('photo')->move(getcwd().'/assets/doctor/img/',$img_name);
            }
                $User->update([
                    
                    'name'        => isset($name)?$name:$User->name,
                    'code'        =>isset($code)?$code:$User->code,
                    'password'    => isset($name)?encrypt($password):$User->password,
                    'email'       => isset($email)?$email:$User->email,
                    'linkedin'    => isset($linkedin)?$linkedin:$User->linkedin,
                    'phone'       => isset($phone)?$phone:$User->phone,
                    'status'      => isset($status)?$status:$User->status,
                    'photo'       =>isset($img_name)?$img_name:$User->photo,
                    'gender'      => isset($gender)?$gender:$User->gender,
                    'bio'      => isset($bio)?$this->strip_tags_content($bio):$User->bio,
                ]);
            
        
        return redirect('/admin/doctor/list')->with('msg', trans('admin.added_successfully'));
    }



## acadmeic year 
public function listYear(){
    $years=acadmic_year::orderBy('id','Desc');
    return view(env('ADMIN_TEMPLATE').'.academic_year.list',['list'=>$years->paginate(20)]);
}
public function storeYear(Request $request){
    $years=acadmic_year::create([
        'name'=>$request->title,
    ]);

    return view(env('ADMIN_TEMPLATE').'.academic_year.list',['list'=>$years->paginate(20)])->with('msg', trans('admin.added_successfully'));
}
public function EditYear(Request $request,$id){
    $years=acadmic_year::orderBy('id','Desc');

    $edit=acadmic_year::find($id);

    return view(env('ADMIN_TEMPLATE').'.academic_year.list',['list'=>$years->paginate(20),'edit'=>$edit]);
}
public function updateYear(Request $request ,$id)
{
    $years=acadmic_year::find($id);

    $years->update([
        'name'=>$request->title,
    ]);

    return back()->with('msg', trans('admin.edit_successfully'));

}
public function deleteYear($id)
{
    $years =acadmic_year::find($id)->delete();
    return back()->with('msg',trans('admin.delete_successfully'));

}

}