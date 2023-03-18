@extends('admin_stisla.layout.layout')
@section('title',trans('admin.user_settings'))
@section('page')
    <div class="card has-shadow">
        <div class="card-header bordered no-actions">
            <h4>{{ trans('admin.user_settings') }}</h4>
        </div>
        <form method="post" action="/admin/setting/store">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label>{{ trans('admin.new_user_registration') }}</label>
                            <select name="new_user_enable" class="form-control custom-select">
                                <option @if(getOption('new_user_enable') == 1) selected @endif value="1">{{ trans('admin.active') }}</option>
                                <option @if(getOption('new_user_enable') == 0) selected @endif value="0">{{ trans('admin.inactive') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label>{{ trans('admin.status_of_new_users') }}</label>
                            <select name="new_user_mode" class="form-control custom-select">
                                <option @if(getOption('new_user_mode') == 'confirm-sms') selected @endif value="confirm-sms">{{ trans('admin.requires_mobile_confirmation') }}</option>
                                <option @if(getOption('new_user_mode') == 'confirm-email') selected @endif value="confirm-email">{{ trans('admin.requires_email_confirmation') }}</option>
                                <option @if(getOption('new_user_mode') == 'active') selected @endif value="active">{{ trans('admin.active') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label>{{ trans('admin.default_category_of_users') }}</label>
                            <select name="user_default_category" class="form-control custom-select">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id ?? '' }}" @if(getOption('user_default_category') == $category->id) selected @endif>{{ $category->title ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="{{ trans('admin.submit') }}">
                </div>
            </div>
        </form>
    </div>
@endsection
