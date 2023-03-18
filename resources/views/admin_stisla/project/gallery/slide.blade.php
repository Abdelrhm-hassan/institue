@extends('admin_stisla.layout.layout')
@section('title',trans('admin.slide'))
@section('page')
    <style>
        .img-holder{
            margin-bottom: 15px;
            position: relative;
        }
        .img-holder a{
            position: absolute;
            top: 10px;
            left: 30px;
            color: #fff8f8;
            font-size: 2em;
        }
    </style>
    <div class="card has-shadow">
        <div class="card-header bordered no-actions">
            {{ trans('admin.gallery') }}
            "{!! $gallery->title ?? '' !!}"
        </div>
        <form method="post" action="/admin/product/gallery/slide/store/{!! $gallery->id !!}">
            <div class="card-body">
                <div class="form-group">
                    <label>{{ trans('admin.click_on_the_entry_below_to_select_the_photo') }}</label>
                    <input type="text" required class="form-control text-right filemanager" id="url" data-input="url" dir="ltr" name="url">
                </div>
            </div>
            <div class="card-footer">
                <input type="submit" class="btn btn-primary" value="{!! trans('admin.save') !!}">
            </div>
        </form>
    </div>
    <div class="h-10"></div>
    <div class="row">
        @foreach($slides as $slide)
            <div class="col-12 col-md-6 col-lg-3 img-holder">
                <a href="/admin/product/gallery/slide/delete/{!! $slide->id !!}" class="delete-item"><i class="fas fa-trash"></i></a>
                <img class="img-thumbnail" style="width: 100%;height: 300px;" src="{!! $slide->url ?? '' !!}"/>
            </div>
        @endforeach
    </div>
@stop
