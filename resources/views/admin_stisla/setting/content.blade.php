@extends('admin_stisla.layout.layout')
@section('title',trans('admin.content_settings'))
@section('page')
    <div class="card has-shadow">
        <div class="card-header bordered no-actions">
            <h4>{{ trans('admin.content_settings') }}</h4>
        </div>
        <div class="card-body">
            <form method="post" action="/admin/setting/store">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <label>{{ trans('admin.number_of_posts_on_the_blog_page') }}</label>
                            <input type="number" class="form-control text-center" name="blog_post_count" value="{!! getOption('blog_post_count') !!}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="{{ trans('admin.submit') }}">
                </div>
            </form>
        </div>
    </div>
    <div class="card has-shadow">
        <div class="card-header bordered no-actions">
            <h4>{{ trans('admin.tutorial_page') }}</h4>
        </div>
        <form method="post" action="/admin/setting/store">
        <div class="card-body">
            <div class="form-group">
                <label>{{ trans('admin.text') }}</label>
                <textarea class="summernote" name="site_learn" id="ckeditor">{!! getOption('site_learn') !!}</textarea>
            </div>
        </div>
        <div class="card-footer">
            <input type="submit" class="btn btn-primary" value="{{ trans('admin.submit') }}">
        </div>
        </form>
    </div>
@endsection
