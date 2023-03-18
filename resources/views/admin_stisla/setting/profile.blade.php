@extends('admin_stisla.layout.layout')
@section('title',trans('admin.user_settings'))
@section('page')
    <div class="card has-shadow">
        <div class="card-header bordered no-actions">
            <h4>{{ trans('admin.security_settings') }}</h4>
        </div>
        <div class="card-body">
            <form method="post" action="/admin/setting/password/update">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label>{{ trans('admin.new_password') }}</label>
                            <input type="password" required name="password" class="form-control text-center">
                        </div>
                        <div class="col-12 col-md-6">
                            <label>{{ trans('admin.repeat_password') }}</label>
                            <input type="password" required name="re_password" class="form-control text-center">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="{{ trans('admin.submit') }}">
                </div>
            </form>
        </div>
    </div>
@endsection
