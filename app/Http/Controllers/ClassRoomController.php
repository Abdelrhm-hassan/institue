<?php

namespace App\Http\Controllers;

use App\Models\acadmic_year;
use App\Models\classRoom;
use Illuminate\Http\Request;

class ClassRoomController extends Controller
{
 
## acadmeic year 
public function listYear(){
    $class=classRoom::orderBy('id','Desc');
    $year=acadmic_year::orderBy('id','Desc')->get();
    return view(env('ADMIN_TEMPLATE').'.class_room.list',['list'=>$class->paginate(20),'years'=>$year]);
}
public function storeYear(Request $request){
    $year=acadmic_year::orderBy('id','Desc')->get();

    $class=classRoom::create([
        'name'=>$request->name,
        'hours'=>$request->hour,
        'price'=>$request->price,
        'year_id'=>$request->year_id,
        'class_id'=>$request->class_id,
        'level' =>$request->level
    ]);

    return back()->with('msg', trans('admin.added_successfully'));

}
public function EditYear(Request $request,$id){
    $class=classRoom::orderBy('id','Desc');
    $year=acadmic_year::orderBy('id','Desc')->get();

    $edit=classRoom::find($id);

    return view(env('ADMIN_TEMPLATE').'.class_room.list',['list'=>$class->paginate(20),'edit'=>$edit,'years'=>$year]);
}
public function updateYear(Request $request ,$id)
{
    $class=classRoom::find($id);

    $class->update([
        'name'=>isset($request->name)?$request->name:$class->name,
        'hours'=>isset($request->hour)?$request->hour:$class->hour,
        'price'=>isset($request->price)?$request->price:$class->price,
        'price'=>isset($request->level)?$request->level:$class->level,
        'price'=>isset($request->price)?$request->price:$class->price,
        'year_id'=>isset($request->year_id)?$request->year_id : $class->year_id,
    ]);

    return back()->with('msg', trans('admin.edit_successfully'));

}
public function deleteYear($id)
{
    $class =classRoom::find($id)->delete();
    return back()->with('msg',trans('admin.delete_successfully'));

}

}