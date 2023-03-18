@extends('admin_stisla.layout.layout')
@section('title','add Student')
@section('page')
<link rel="stylesheet" href="{{asset('assets/admin/custom_css/add_project.css')}}">
    <style>
    </style>
    <form method="post" @if(isset($edit)) action="/admin/student/edit/store/{!! $edit->id !!}" @else action="{{url('/admin/student/new/store')}}" @endif  enctype="multipart/form-data">
            {{csrf_field()}}
        <div class="row">
            <div class="col-12 container ">
                <div class="card has-shadow">
                    <div class="card-header bordered no-actions">Add Students</div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-md-3">
                                   
                                   <label>{!! trans('admin.name') !!}</label>
                                    <input type="text" class="form-control" name="name" value="{!! $edit->name ?? '' !!}">
                                </div>
                                <div class="col-12 col-md-3">
                                   
                                    <label>code</label>
                                     <input type="text" class="form-control" name="code" value="{!! $edit->code ?? '' !!}">
                              </div>
                              <div class="col-12 col-md-3">
                                   
                                <label>phone</label>
                                 <input type="text" class="form-control" name="phone" value="{!! $edit->phone ?? '' !!}">
                          </div>
                                <div class="col-12 col-md-3">
                                    <label>mode</label>
                                    <select name="status" id="type" class="form-control">
                                        <option value="active" @if(isset($edit) && $edit->mode== 'active') selected @endif>{{ trans('admin.active') }}</option>
                                        <option value="pendding" @if(isset($edit) && $edit->mode== 'pendding') selected @endif>pendding</option>
                                    </select>
                                </div>        
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-md-3">
                                   
                                   <label>{!! trans('admin.email') !!}</label>
                                    <input type="text" class="form-control" name="email" value="{!! $edit->email ?? '' !!}">
                                </div>
                                <div class="col-12 col-md-3">
                                   
                                    <label>password</label>
                                     <input type="text" class="form-control" name="password"  value="{!! $password ?? '' !!}">
                              </div>
                                <div class="col-12 col-md-3">
                                    <label>gender</label>
                                    <select name="gender" id="type" class="form-control">
                                        <option value="male" @if(isset($edit) && $edit->mode== 'male') selected @endif>male</option>
                                        <option value="female" @if(isset($edit) && $edit->mode== 'female') selected @endif>female</option>
                                    </select>
                                </div>    
                                <div class="col-12 col-md-3">
                                    <label>{{ trans('admin.class_room') }}</label>
                                    <select name="class_id" id="type" class="form-control">
                                        @foreach ($class as $item)
                                        <option value="{{$item->id}}" @if(isset($edit) && $edit->id== $item->id) selected @endif>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>     
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="">
                                    <label>grade</label>
                                   <input type="text" class="form-control" name="grade" value="{!! $edit->grade ?? '' !!}">
                            </div>
                        </div>
                           {{-- upload mult img --}}
                   <div class="form-group">
                            <fieldset class="form-group">
                                <a href="javascript:void(0)" class="btn btn-info" onclick="$('#pro-image').click()">Upload Image</a>
                                <input type="file" id="pro-image" name="photo"  hidden class="form-control" multiple>
                            </fieldset>
                          
                            <div class="preview-images-zone">
                                @if (isset($edit))
                                    <div class="preview-image preview-show">
                                    <div class="image-zone">
                                    <img id="pro-img" src="{{ asset('assets/student/img') }}/{{$edit->photo}}" alt="">
                                    </div>
                                    </div>
                                    @endif

                                {{-- img uploaded here --}}
                          </div>
                    </div>

           
        </div>

        <div class="form-group text-left">
            <input type="submit" class="btn btn-primary" @if(isset($edit)) value="{{ trans('admin.edit') }}" @else value="{{ trans('admin.submit') }}" @endif>
        </div>
    </form>

  <script src="{{asset('assets/admin/custom_js/add_project.js')}}"></script>
@stop
@section('script')
    <script>

        var count=1
        $(document).on('click', '#cancel', function() {
        let no = $(this).data('no');
        $(".te-"+no).remove();
    });
      var count=1
    //  add multi Devs
    function add_multi_dev(){
        count+=1
        html =
        '<div class="row te-'+count+'"  id="row'+count+'">\
                     <div class="col-12 col-md-5">\
                           <label>{!! trans("admin.pices_name") !!}</label>\
                             <input type="text" class="form-control" name="pices_name[]" >\
                     </div>\
                     <div  class="col-12 col-md-5">\
                     <label>{!! trans("admin.pices_count") !!}</label>\
                       <input type="number" class="form-control" name="pices_count[]">\
                     </div>\
                      <div class="col-12 col-md-2">\
                       <a href="javascript:void(0);"  data-no="'+ count +'" id="cancel" class="btn btn-danger my-2" >X</a>\
                     </div>\
        </div>';
        var output = $("#test");

        output.append(html);



        

        
    }


     // 

   
        $('#type').on('change', function () {
            if($(this).val() == 'private'){
                $('#users').show();
            }else{
                $('#users').hide();
            }
        })
    </script>
@stop
