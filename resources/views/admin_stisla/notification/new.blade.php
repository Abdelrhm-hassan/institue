@extends('admin_stisla.layout.layout')
@section('title',trans('admin.new_announcement'))
@section('page')
    <div class="card has-shadow">
        <form method="post" action="/admin/notification/new/store">
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <label>{{ trans('admin.receiver') }}</label>
                            <select name="receiver" id="receiver" class="show-menu-arrow form-control text-right selectric" title="{{ trans('admin.please_select_one_or_more_items') }}" multiple required>
                                <option value="admin">{{ trans('admin.admin') }}</option>
                                <option value="doctor">{{ trans('admin.doctors') }}</option>
                                <option value="student">{{ trans('admin.students') }}</option>
                            </select>
                        </div>
                        <div  class="col-6" id="admin" style="display: none">
                            <label>{{ trans('admin.receiver') }} Admin</label>
                            <select data-live-search="true" name="admin" class="selectpicker form-control" required>
                                <option value="0">{{ trans('admin.all_users') }}</option>
                                @foreach($admin as $user)
                                    <option value="{!! $user->id !!}" @if(isset($_GET['user_id']) && $_GET['user_id'] == $user->id) selected @endif>{!! $user->name ?? '' !!}
                                         </option>
                                @endforeach
                            </select>
                        </div>
                        <div  class="col-6" id="doctor" style="display: none">
                            <label>{{ trans('admin.receiver') }} doctors</label>
                            <select data-live-search="true" name="doctor" class="selectpicker form-control" required>
                                <option value="0">{{ trans('admin.all_users') }}</option>
                                @foreach($doctor as $user)
                                    <option value="{!! $user->id !!}" @if(isset($_GET['user_id']) && $_GET['user_id'] == $user->id) selected @endif>{!! $user->name ?? '' !!} </option>
                                @endforeach
                            </select>
                        </div>
                        <div  class="col-6" id="student" style="display: none">
                            <label>{{ trans('admin.receiver') }} students</label>
                            <select data-live-search="true" name="student" class="selectpicker form-control" required>
                                <option value="0">{{ trans('admin.all_users') }}</option>
                                @foreach($student as $user)
                                    <option value="{!! $user->id !!}" @if(isset($_GET['user_id']) && $_GET['user_id'] == $user->id) selected @endif>{!! $user->name ?? '' !!} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <label>{{ trans('admin.notification_type') }}</label>
                            <select name="type[]" id="type" class="show-menu-arrow form-control text-right selectric" title="{{ trans('admin.please_select_one_or_more_items') }}" multiple required>
                                <option value="alert">{{ trans('admin.internal_notification') }}</option>
                                {{-- <option value="sms">{{ trans('admin.SMS') }}</option>
                                <option value="email">{{ trans('admin.email') }}</option> --}}
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label>{{ trans('admin.title') }}</label>
                            <input type="text" class="form-control" name="title">
                        </div>
                    </div>
                </div>
             
                <div class="form-group" id="alert" style="display: none">
                    <label>{{ trans('admin.announcement_text') }}</label>
                    <textarea class="summernote" name="alert" id="alert_text"></textarea>
                </div>
                <div class="form-group" id="email" style="display: none">
                    <label>{{ trans('admin.email_text') }}</label>
                    <textarea class="summernote" name="email" id="email_text"></textarea>
                </div>
                <div class="form-group" id="sms" style="display: none">
                    <label>{{ trans('admin.SMS_text') }}</label>
                    <input type="text" class="form-control" name="sms">
                </div>
            </div>
            <div class="card-footer text-right">
                <input type="submit" class="btn btn-primary" value="{{ trans('admin.send') }}">
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script>
        $('#type').change(function () {
            let arr = $('#type').val();
            if(jQuery.inArray("email",arr) !== -1 ) $('#email').show(); else $('#email').hide();
            if(jQuery.inArray("sms",arr) !== -1 ) $('#sms').show(); else $('#sms').hide();
            if(jQuery.inArray("alert",arr) !== -1 ) $('#alert').show(); else $('#alert').hide();
        });
        $('#receiver').change(function(){
            let rec=$('#receiver').val();
            if(jQuery.inArray("admin",rec) !== -1 ) $('#admin').show(); else $('#admin').hide();
            if(jQuery.inArray("doctor",rec) !== -1 ) $('#doctor').show(); else $('#doctor').hide();
            if(jQuery.inArray("student",rec) !== -1 ) $('#student').show(); else $('#student').hide();

        });
    </script>
@endsection
