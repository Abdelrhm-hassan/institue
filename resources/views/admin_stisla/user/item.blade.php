@extends('admin_stisla.layout.layout')
@section('title',trans('admin.edit_user'))
@section('page')
    <div class="card has-shadow">
        <div class="card-header bordered no-actions d-flex align-items-center">
            <h4>{{ trans('admin.user') }} "{!! $edit->username ?? '' !!}"</h4>
        </div>
        <div class="card-body sliding-tabs">
            <ul class="nav nav-tabs" id="example-one" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active show" id="base-tab-1" data-toggle="tab" href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="true">{{ trans('admin.profile') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="base-tab-2" data-toggle="tab" href="#tab-2" role="tab" aria-controls="tab-2" aria-selected="false">{{ trans('admin.transactions') }}</a>
                </li>
            </ul>
            <div class="tab-content pt-3">
                <div class="tab-pane fade active show" id="tab-1" role="tabpanel" aria-labelledby="base-tab-1">
                    <form method="post" action="/admin/user/edit/store/{!! $edit->id !!}">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label>{{ trans('admin.username') }}</label>
                                    <input type="text" class="form-control" name="username" value="{!! $edit->username !!}" disabled="disabled">
                                </div>
                                <div class="col-6">
                                    <label>{{ trans('admin.name') }}</label>
                                    <input type="text" name="name" class="form-control" value="{!! $edit->name ?? '' !!}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label>{{ trans('admin.email') }}</label>
                                    <input type="email" class="form-control" name="email" value="{!! $edit->email ?? '' !!}">
                                </div>
                                <div class="col-6">
                                    <label>{{ trans('admin.phone_number') }}</label>
                                    <input type="text" class="form-control" name="phone" value="{!! $edit->phone ?? '' !!}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>{{ trans('admin.online_contractor') }}</label>
                                    <select name="online" class="form-control custom-select">
                                        <option value="1" @if($edit->online == 1) selected @endif>{{ trans('admin.active') }}</option>
                                        <option value="0" @if($edit->online == 0) selected @endif>{{ trans('admin.inactive') }}</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label>{{ trans('admin.status') }}</label>
                                    <select name="mode" class="form-control custom-select">
                                        <option value="active" @if($edit->mode == 'active') selected @endif>{{ trans('admin.active') }}</option>
                                        <option value="inactive" @if($edit->mode == 'inactive') selected @endif>{{ trans('admin.inactive') }}</option>
                                        <option value="banned" @if($edit->mode == 'banned') selected @endif>{{ trans('admin.blocked') }}</option>
                                        <option value="confirm-sms" @if($edit->mode == 'confirm-sms') selected @endif>{{ trans('admin.mobile_confirmation') }}</option>
                                        <option value="confirm-email" @if($edit->mode == 'confirm-email') selected @endif>{{ trans('admin.email_verification') }}</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label>{{ trans('admin.grouping') }}</label>
                                    <select name="category_id" class="form-control custom-select">
                                         @foreach($categories as $category)
                                            <option value="{!! $category->id !!}" @if(isset($edit) && $edit->category_id == $category->id) selected @endif>{!! $category->title ?? '' !!}</option>
                                         @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <input type="submit" class="btn btn-primary" value="{{ trans('admin.record_changes') }}">
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="base-tab-2">
                </div>
                <div class="tab-pane fade" id="tab-3" role="tabpanel" aria-labelledby="base-tab-3">
                </div>
            </div>
        </div>
    </div>
@endsection
