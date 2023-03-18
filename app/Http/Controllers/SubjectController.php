<?php

namespace App\Http\Controllers;

use App\Models\classRoom;
use App\Models\result;
use App\Models\subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class SubjectController extends Controller
{
    
## Subject
public function listYear(){
    $class=classRoom::orderBy('id','ASC');
    $subject=subject::orderBy('class_id','ASC')->paginate(20);
    return view(env('ADMIN_TEMPLATE').'.subjects.list',['class'=>$class->get(),'list'=>$subject]);
}
public function storeYear(Request $request){

    $class=subject::create([
        'name'=>$request->name,
        'hours'=>$request->hour,
        'price'=>$request->price,
        'class_id'=>$request->class_id,
    ]);

    return back()->with('msg', trans('admin.added_successfully'));
}
public function EditYear(Request $request,$id){
    $class=classRoom::orderBy('id','Desc')->get();
    $subject=subject::orderBy('id','Desc');

    $edit=subject::find($id);

    return view(env('ADMIN_TEMPLATE').'.subjects.list',['list'=>$subject->paginate(20),'edit'=>$edit,'class'=>$class]);
}
public function updateYear(Request $request ,$id)
{
    $class=subject::find($id);

    $class->update([
        'name'=>isset($request->name)?$request->name:$class->name,
        'hours'=>isset($request->hour)?$request->hour:$class->hour,
        'price'=>isset($request->price)?$request->price:$class->price,
        'class_id'=>isset($request->class_id)?$request->class_id : $class->class_id,
    ]);

    return back()->with('msg', trans('admin.edit_successfully'));

}
public function deleteYear($id)
{
    $class =subject::find($id)->delete();
    if($class){

        return back()->with('msg',trans('admin.delete_successfully'));

    }

}
   ## Approved materials ##
   public function approvedMaterials()
   {
    if(session('User')!=null){
        $class_id=session('User')->class_id;
        $subject=subject::where('class_id',$class_id)->orderBy('id','Desc');

    
    
        return view(env('USER_TEMPLATE').'.subject',['list'=>$subject->paginate(20)]);

    }

    return back()->with('msg', trans('admin.edit_successfully'));

        
   }
   ##  Result   ##
   public function userResult()
   {
    if(session('User')!=null){
        $student_id=session('User')->id;
        $class_id=session('User')->class_id;

        // dd($student_id);
        $subject=result::where('student_id',$student_id)->where('class_id',$class_id)->orderBy('id','ASC');

    
    
        return view(env('USER_TEMPLATE').'.result',['list'=>$subject->paginate(20)]);

    }

    return back()->with('msg', trans('admin.edit_successfully'));

        
   }
   

}