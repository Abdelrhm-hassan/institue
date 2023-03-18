@extends('admin_stisla.layout.layout')
@section('title',trans('admin.manager'))
@section('page')
    <div class="card has-shadow">
        <div class="card-header bordered no-actions d-flex align-items-center">
            @if(isset($edit))
                <h4>{{ trans('admin.edit_manager') }}</h4>
            @else
                <h4>{{ trans('admin.new_manager') }}</h4>
            @endif
        </div>
        <form method="post" @if(isset($edit)) action="/admin/manager/edit/store/{!! $edit->id !!}" @else action="/admin/manager/new/store" @endif>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label>{{ trans('admin.username') }}</label>
                            <input type="text" class="form-control" dir="ltr" name="username" value="{!! $edit->username ?? '' !!}">
                        </div>
                        <div class="col-12 col-md-6 mt-2 mt-md-0">
                            <label>{{ trans('admin.password') }}</label>
                            <input type="text" class="form-control" dir="ltr" name="password" @if(isset($edit)) value="{!! decrypt($edit->password) !!}" @endif>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label>{{ trans('admin.first_name_and_last_name') }}</label>
                            <input type="text" class="form-control" name="name" value="{!! $edit->name ?? '' !!}">
                        </div>
                        <div class="col-12 col-md-6 mt-2 mt-md-0">
                            <label>{{ trans('admin.email') }}</label>
                            <input type="email" name="email" class="form-control" value="{!! $edit->email ?? '' !!}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label>{{ trans('admin.phone_number') }}</label>
                            <input type="text" class="form-control" name="phone" value="{!! $edit->phone ?? '' !!}">
                        </div>
                        <div class="col-12 col-md-6 mt-2 mt-md-0">
                            <label>{{ trans('admin.status') }}</label>
                            <select name="mode" class="form-control">
                                <option value="active" @if(isset($edit) && $edit->mode == 'active') selected @endif>{{ trans('admin.active') }}</option>
                                <option value="deactive" @if(isset($edit) && $edit->mode == 'deactive') selected @endif>{{ trans('admin.inactive') }}</option>
                                <option value="banned" @if(isset($edit) && $edit->mode == 'banned') selected @endif>{{ trans('admin.blocked') }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>{{ trans('admin.access_level') }}</label>
                    <div class="h-10" style="height: 10px;"></div>
                    <div class="row">
                        <div class="col-6 col-md-2 mb-2">
                            <div class="styled-checkbox">
                                <input type="checkbox"  name="access[]" value="manager" id="ch-1" @if(isset($edit) && inJson('manager', $edit->access)) checked @endif>
                                <label for="ch-1">{{ trans('admin.Managers') }}</label>
                            </div>
                        </div>
                        <div class="col-6 col-md-2 mb-2">
                            <div class="styled-checkbox">
                                <input type="checkbox" value="user" name="access[]" id="ch-2" @if(isset($edit) && inJson('user', $edit->access)) checked @endif>
                                <label for="ch-2">{{ trans('admin.users') }}</label>
                            </div>
                        </div>
                        <div class="col-6 col-md-2 mb-2">
                            <div class="styled-checkbox">
                                <input type="checkbox" value="project" name="access[]" id="ch-2" @if(isset($edit) && inJson('project', $edit->access)) checked @endif>
                                <label for="ch-2">{{ trans('admin.project') }}</label>
                            </div>
                        </div>
                        <div class="col-6 col-md-2 mb-2">
                            <div class="styled-checkbox">
                                <input type="checkbox" value="document" name="access[]" id="ch-2" @if(isset($edit) && inJson('document', $edit->access)) checked @endif>
                                <label for="ch-2">{{ trans('admin.documents') }}</label>
                            </div>
                        </div>
                        <div class="col-6 col-md-2 mb-2">
                            <div class="styled-checkbox">
                                <input type="checkbox" value="transaction" name="access[]" id="ch-2" @if(isset($edit) && inJson('transaction', $edit->access)) checked @endif>
                                <label for="ch-2">{{ trans('admin.transactions') }}</label>
                            </div>
                        </div>
                        <div class="col-6 col-md-2 mb-2">
                            <div class="styled-checkbox">
                                <input type="checkbox" value="withdraw" name="access[]" id="ch-2" @if(isset($edit) && inJson('withdraw', $edit->access)) checked @endif>
                                <label for="ch-2">{{ trans('admin.deposit_request') }}</label>
                            </div>
                        </div>
                        <div class="col-6 col-md-2 mb-2">
                            <div class="styled-checkbox">
                                <input type="checkbox" value="chat" name="access[]" id="ch-3" @if(isset($edit) && inJson('chat', $edit->access)) checked @endif>
                                <label for="ch-3">{{ trans('admin.support') }}</label>
                            </div>
                        </div>
                        <div class="col-6 col-md-2 mb-2">
                            <div class="styled-checkbox">
                                <input type="checkbox" value="support" name="access[]" id="ch-3" @if(isset($edit) && inJson('support', $edit->access)) checked @endif>
                                <label for="ch-3">{{ trans('admin.chat') }}</label>
                            </div>
                        </div>
                        <div class="col-6 col-md-2 mb-2">
                            <div class="styled-checkbox">
                                <input type="checkbox" value="revision" name="access[]" id="ch-3" @if(isset($edit) && inJson('revision', $edit->access)) checked @endif>
                                <label for="ch-3">{{ trans('admin.review') }}</label>
                            </div>
                        </div>
                        <div class="col-6 col-md-2 mb-2">
                            <div class="styled-checkbox">
                                <input type="checkbox" value="notification" name="access[]" id="ch-4" @if(isset($edit) && inJson('notification', $edit->access)) checked @endif>
                                <label for="ch-4">{{ trans('admin.notices') }}</label>
                            </div>
                        </div>
                        <div class="col-6 col-md-2 mb-2">
                            <div class="styled-checkbox">
                                <input type="checkbox" value="newsletter" name="access[]" id="ch-4" @if(isset($edit) && inJson('newsletter', $edit->access)) checked @endif>
                                <label for="ch-4">{{ trans('admin.newsletter') }}</label>
                            </div>
                        </div>
                        <div class="col-6 col-md-2 mb-2">
                            <div class="styled-checkbox">
                                <input type="checkbox" value="blog" name="access[]" id="ch-5" @if(isset($edit) && inJson('blog', $edit->access)) checked @endif>
                                <label for="ch-5">{{ trans('admin.weblog') }}</label>
                            </div>
                        </div>
                        <div class="col-6 col-md-2 mb-2">
                            <div class="styled-checkbox">
                                <input type="checkbox" value="page" name="access[]" id="ch-6" @if(isset($edit) && inJson('page', $edit->access)) checked @endif>
                                <label for="ch-6">{{ trans('admin.pages') }}</label>
                            </div>
                        </div>
                        <div class="col-6 col-md-2 mb-2">
                            <div class="styled-checkbox">
                                <input type="checkbox" value="comment" name="access[]" id="ch-7" @if(isset($edit) && inJson('comment', $edit->access)) checked @endif>
                                <label for="ch-7">{{ trans('admin.comments') }}</label>
                            </div>
                        </div>
                        <div class="col-6 col-md-2 mb-2">
                            <div class="styled-checkbox">
                                <input type="checkbox" value="setting" name="access[]" id="ch-7" @if(isset($edit) && inJson('setting', $edit->access)) checked @endif>
                                <label for="ch-7">{{ trans('admin.settings') }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <input type="submit" class="btn btn-primary" @if(!isset($edit)) value="{{ trans('admin.new_registration') }}" @else value="{{ trans('admin.edit_registration') }}" @endif>
            </div>
        </form>
    </div>
@endsection
