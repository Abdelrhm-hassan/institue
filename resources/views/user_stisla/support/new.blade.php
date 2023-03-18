@extends('user_stisla.layout.layout')
@section('title',trans('admin.new_ticket'))
@section('page')
    <div class="card">
        <form method="post" action="/user/support/new/store">
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label>{{ trans('admin.title') }}</label>
                            <input type="text" class="form-control" name="title">
                        </div>
                        <div class="col-12 col-md-6">
                            <label>{{ trans('admin.department') }}</label>
                            <select name="category_id" class="form-control custom-select">
                                @foreach($categories as $category)
                                    <option value="{!! $category->id ?? '' !!}">{!! $category->title ?? '' !!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>{{ trans('admin.text') }}</label>
                    <textarea class="form-control" style="height: 300px;" name="text" rows="10"></textarea>
                </div>
                <div class="h-10"></div>
                {!! fileUploader('/user/support/upload','file',null) !!}
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-6">
                    </div>
                    <div class="col-6 text-right">
                        <input type="submit" class="btn btn-primary" value="{{ trans('admin.send') }}">
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
