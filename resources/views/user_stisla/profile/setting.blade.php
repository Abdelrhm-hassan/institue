@extends('user_stisla.layout.layout')
@section('title',trans('admin.settings'))
@section('page')
    @if($User->username == null || $User->name == null)
    <div class="alert alert-danger mb-4" role="alert">
        <strong>{{ trans('admin.if_you_have_just_registered_choosing_a_first_and_last_name_is_a_must_have_name_for_working_with_the_site') }}</strong>
    </div>
    @endif
    @if($User->password == null)
        <div class="alert alert-danger mb-4" role="alert">
            <strong>{{ trans('admin.if_you_have_just_registered_choosing_the_right_password_to_work_with_the_site_is_mandatory') }}</strong>
        </div>
    @endif
    <div class="row">
      <div class="col-12 col-md-8">
          <div class="card has-shadow">
              <form method="post" action="/user/profile/store">
                  <div class="card-body">
                      <div class="form-group">
                          <div class="row">
                              <div class="col-12 col-md-6">
                                  <label>{{ trans('admin.email') }}</label>
                                  <input type="text" value="{!! $User->email ?? '' !!}" class="form-control text-center" name="email">
                              </div>
                              <div class="col-12 col-md-6">
                                  <label>{{ trans('admin.mobile') }}</label>
                                  <input type="tel" disabled="disabled" class="form-control text-center" value="{!! $User->phone ?? '' !!}">
                              </div>
                          </div>
                      </div>
                      <span style="font-size: 0.8em;">{{ trans('admin.by_changing_your_email_or_mobile,_your_account_is_suspended_and_you_must_activate_it.') }}</span>
                  </div>
                  <div class="card-footer text-right">
                      <input type="submit" class="btn btn-primary " value="{{ trans('admin.submit') }}">
                  </div>
              </form>
          </div>
          <div class="card has-shadow">
              <div class="card-header bordered no-actions"><h4>{{ trans('admin.personal_information') }}</h4></div>
              <form method="post" action="/user/profile/store">
                  <div class="card-body">
                      <div class="form-group">
                          <div class="row">
                              <div class="col-12 col-md-6">
                                  <label>{{ trans('admin.show_name') }}</label>
                                  <input type="text" class="form-control" name="username" value="{!! $User->username ?? '' !!}">
                              </div>
                              <div class="col-12 col-md-6">
                                  <label>{{ trans('admin.first_name_and_last_name') }}</label>
                                  <input type="text" class="form-control" name="name" value="{!! $User->name ?? '' !!}">
                              </div>
                          </div>
                      </div>
                      <div class="form-group">
                          <div class="row">
                              <div class="col-12 col-md-6">
                                  <label>{{ trans('admin.gender') }}</label>
                                  <select name="gender" class="form-control custom-select">
                                      <option value="m" @if($User->gender == 'm') selected @endif>{{ trans('admin.Man') }}</option>
                                      <option value="f" @if($User->gender == 'f') selected @endif>{{ trans('admin.Female') }}</option>
                                  </select>
                              </div>
                              <div class="col-12 col-md-6">
                                  <label>{{ trans('admin.national_code') }}</label>
                                  <input type="text" class="form-control" name="national_id" value="{!! $User->national_id ?? '' !!}">
                              </div>
                          </div>
                      </div>
                      <div class="form-group">
                          <div class="row">
                              <div class="col-4">
                                  <label>{{ trans('admin.City') }}</label>
                                  <input type="text" class="form-control" name="city" value="{!! $User->city ?? '' !!}">
                              </div>
                              <div class="col-8">
                                  <label>{{ trans('admin.address') }}</label>
                                  <input type="text" class="form-control" name="address" value="{!! $User->address ?? '' !!}">
                              </div>
                          </div>
                      </div>
                      <div class="form-group">
                          <label>{{ trans('admin.about_me') }}</label>
                          <textarea class="form-control" style="height: 200px;" name="about_me" rows="10">{!! $User->about_me ?? '' !!}</textarea>
                      </div>
                      <div class="form-group">
                          <label>{{ trans('admin.CV') }}</label>
                          <textarea class="form-control" style="height: 200px;" name="cv" rows="10">{!! $User->cv ?? '' !!}</textarea>
                      </div>
                  </div>
                  <div class="card-footer text-right">
                      <input type="submit" class="btn btn-primary" value="{{ trans('admin.submit') }}">
                  </div>
              </form>
          </div>
      </div>
      <div class="col-12 col-md-4">
          <div class="card has-shadow">
              <form method="post" enctype="multipart/form-data" action="/user/profile/store">
                  <div class="card-body text-center" style="padding-bottom: 0;">
                      <input type="file" id="avatar" name="avatar" style="display: none;">
                      <img src="{!! $User->avatar ?? '/assets/user/img/avatar/avatar-02.jpg' !!}" class="img-thumbnail avatar rounded" style="width: 75px;height: 75px;">
                      <div class="p-4">
                          <span style="color: #040505;cursor: pointer;" onclick="$('#avatar').click();">{{ trans('admin.select') }}</span>
                          <br>
                          <label style="font-size: 0.7em">{{ trans('admin.jpg_format_with_a_maximum_size_of_512_KB') }}</label>
                      </div>
                  </div>
                  <div class="card-footer text-right">
                      <input type="submit" class="btn btn-primary " value="{{ trans('admin.submit') }}">
                  </div>
              </form>
          </div>
          <div class="card has-shadow">
              <form method="post" action="/user/profile/store">
                  <div class="card-body">
                      <div class="form-group">
                          <label>{{ trans('admin.new_password') }}</label>
                          <input type="password" class="form-control" name="password">
                      </div>
                      <div class="form-group">
                          <label>{{ trans('admin.repeat_the_new_password') }}</label>
                          <input type="password" class="form-control" name="re_password">
                      </div>
                  </div>
                  <div class="card-footer text-right">
                      <input type="submit" class="btn btn-primary " value="{{ trans('admin.submit') }}">
                  </div>
              </form>
          </div>
      </div>
  </div>
@stop
