@extends('admin_stisla.layout.layout')
@section('title',trans('admin.product'))
@section('page')
<link rel="stylesheet" href="{{asset('assets/admin/custom_css/add_project.css')}}">
    <style>
    </style>
    <form method="post" @if(isset($edit)) action="/admin/project/edit/store/{!! $edit->id !!}" @else action="{{url('admin/project/new/store')}}" @endif  enctype="multipart/form-data">
            {{csrf_field()}}
        <div class="row">
            <div class="col-12 col-md-9 col-lg-9">
                <div class="card has-shadow">
                    <div class="card-header bordered no-actions">{!! trans('admin.product') !!}</div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                   
                                   <label>{!! trans('admin.title') !!}</label>
                                    <input type="text" class="form-control" name="title" value="{!! $edit->title ?? '' !!}">
                                </div>
                                <div class="col-12 col-md-4">
                                    <label>{!! trans('admin.type') !!}</label>
                                    <select name="type" id="type" class="form-control">
                                        <option value="public" @if(isset($edit) && $edit->type== 'public') selected @endif>{{ trans('admin.general') }}</option>
                                        <option value="private" @if(isset($edit) && $edit->type== 'private') selected @endif>{{ trans('admin.private') }}</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label>{!! trans('admin.grouping') !!}</label>
                                    <select name="category_id" class="form-control">
                                        @foreach(getCategory() as $category)
                                            <option value="{!! $category->id ?? '' !!}">{!! $category->title ?? '' !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="users" style="display: none">
                            <label>{{ trans('admin.enter_the_username_of_the_desired_user') }}</label>
                            <input type="text" class="form-control" name="contractor_user">
                        </div>
                        <div class="form-group">
                            <div class="row">
                              
                                    <label>{!! trans('admin.Vehicle_Number') !!}</label>
                                   <input type="text" class="form-control" name="vehicle_num" value="{!! $edit->vehicle_num ?? '' !!}">
                             
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{!! trans('admin.text') !!}</label>
                            <textarea class="summernote" name="description">{!! $edit->description ?? '' !!}</textarea>
                        </div>
                           {{-- upload mult img --}}
                   <div class="form-group">
                            <fieldset class="form-group">
                                <a href="javascript:void(0)" class="btn btn-info" onclick="$('#pro-image').click()">Upload Image</a>
                                <input type="file" id="pro-image" name="imgs[]"  hidden class="form-control" multiple>
                            </fieldset>
                          
                            <div class="preview-images-zone">
                                @if (isset($edit))
                                @foreach ($imgs as $img )
                                    <div class="preview-image preview-show">
                                    <div class="image-zone">
                                    <img id="pro-img" src="{{ asset('assets/admin/img/project/') }}/{{$img}}" alt="">
                                    </div>
                                    </div>
                                        
                                    @endforeach

                                    @endif

                                {{-- img uploaded here --}}
                          </div>
                    </div>

                    {{-- add multi Button --}}
                <div class="panel-body" id="test">
                    @if (isset($edit))
                    @foreach ($picec_name as $key=>$item)
                    <div class="row te-{{$loop->iteration}}" id="row1">
                        <div class="col-12 col-md-5">
                        <label>{!! trans('admin.pices_name') !!}</label>
                          <input type="text" value="{{$item}}" class="form-control" name="pices_name[]" >
                        </div>
                        <div  class="col-12 col-md-5">
                        <label>{!! trans('admin.pices_count') !!}</label>
                          <input type="number" value="{{$picec_count[$key]}}" class="form-control" name="pices_count[]">
                        </div>
                         <div class="col-12 col-md-2">
                          <a href="javascript:void(0)" id="cancel" data-no="{{$loop->iteration}}" class="btn btn-danger my-2" >X</a>
                        </div>
                    </div>
                    @endforeach
                    @endif
                   
               
              
             </div>
              <div class="form-group">
                <a  href="javascript:void(0)" class="btn btn-info my-2"  onclick="add_multi_dev()" > {!! trans('admin.add_more') !!}</a>
             </div>
        </div>
 </div>

            </div>
            <div class="col-12 col-md-3 col-lg-3">
                <div class="card has-shadow">
                    <div class="card-body">
                        <div class="form-group">
                            <label>{{ trans('admin.garage') }}</label>
                            <select class="form-control" name="user_id">
                                @foreach(garageList() as $user)
                                    <option @if(isset($edit) && $edit->user_id == $user['id']) selected @endif  value="{!! $user['id'] ?? '' !!}">{!! $user['name'] ?? '' !!}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('admin.language') }}</label>
                            <select class="form-control" name="language_id">
                                @foreach(getLanguageList() as $language)
                                    <option @if(isset($edit) && $edit->language_id == $language['id']) selected @endif  value="{!! $language['id'] ?? '' !!}">{!! $language['title'] ?? '' !!}</option>
                                @endforeach
                            </select>
                        </div>
                       
                        <div class="form-group">
                            <label>{{ trans('admin.text_type') }}</label>
                            <select class="form-control" name="text_id">
                                @foreach(getTextList() as $text)
                                    <option @if(isset($edit) && $edit->text_id == $text['id']) selected @endif  value="{!! $text['id'] ?? '' !!}">{!! $text['title'] ?? '' !!}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('admin.specialty_guarantee_(USD)') }}</label>
                            <input type="number" class="form-control text-center" name="guarantee_amount" value="{!! $edit->guarantee_amount ?? '' !!}">
                        </div>
                        <div class="form-group">
                            <label>{!! trans('admin.status') !!}</label>
                            <select name="mode" class="form-control">
                                <option value="publish" @if(isset($edit) && $edit->mode == 'publish') selected @endif>{!! trans('admin.publish') !!}</option>
                                <option value="draft" @if(isset($edit) && $edit->mode == 'draft') selected @endif>{!! trans('admin.draft') !!}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            @if(isset($edit))
                                <input type="submit" class="btn btn-warning col-12" value="{!! trans('admin.edit') !!}">
                            @else
                                <input type="submit" class="btn btn-primary col-12" value="{!! trans('admin.save') !!}">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
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
