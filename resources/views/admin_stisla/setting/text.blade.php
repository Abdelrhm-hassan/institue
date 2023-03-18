@extends('admin_stisla.layout.layout')
@section('title',trans('admin.user_guide'))
@section('page')
    <div class="card has-shadow">
        <form method="post" action="/admin/setting/store">
            <div class="card-body">
            <div class="form-group">
                <label>{{ trans('admin.the_first_text_of_the_project_registration_page') }}</label>
                <textarea class="summernote" name="project_new_text_1">{!! getOption('project_new_text_1') !!}</textarea>
            </div>
            <div class="form-group">
                <label>{{ trans('admin.the_second_text_of_the_project_registration_page') }}</label>
                <textarea class="summernote" name="project_new_text_2">{!! getOption('project_new_text_2') !!}</textarea>
            </div>
            <div class="form-group">
                <label>{{ trans('admin.online_project_registration_page_text') }}</label>
                <textarea class="summernote" name="project_new_online">{!! getOption('project_new_online') !!}</textarea>
            </div>
            <div class="form-group">
                <label>{{ trans('admin.online_presenter_page_text') }}</label>
                <textarea class="summernote" name="online_user">{!! getOption('online_user') !!}</textarea>
            </div>
            <div class="form-group">
                <label>{{ trans('admin.the_text_of_the_online_typist_application_page') }}</label>
                <textarea class="summernote" name="online_user_request">{!! getOption('online_user_request') !!}</textarea>
            </div>
            <div class="form-group">
                <label>{{ trans('admin.the_text_of_the_project_page_of_the_proposal_submission_section') }} </label>
                <textarea class="summernote" name="project_send_request">{!! getOption('project_send_request') !!}</textarea>
            </div>
            <div class="form-group">
                <label>{{ trans('admin.support_page_text_(online_backup)') }}</label>
                <textarea class="form-control" style="height: 200px;" name="support_online">{!! getOption('support_online') !!}</textarea>
            </div>
            <div class="form-group">
                <label>{{ trans('admin.upport_page_text_(support_request)') }}</label>
                <textarea class="form-control" style="height: 200px;" name="support_ticket">{!! getOption('support_ticket') !!}</textarea>
            </div>
            <div class="form-group">
                <label>{{ trans('admin.telegram_channel_link') }}</label>
                <input type="text" class="form-control" dir="ltr" name="support_telegram_channel" value="{!! getOption('support_telegram_channel') !!}">
            </div>
            <div class="form-group">
                <label>{{ trans('admin.telegram_robot_link') }}</label>
                <input type="text" class="form-control" dir="ltr" name="support_telegram_robot" value="{!! getOption('support_telegram_robot') !!}">
            </div>
        </div>
            <div class="card-footer text-right">
                <input type="submit" class="btn btn-primary" value="{{ trans('admin.save') }}">
            </div>
        </form>
    </div>
@stop
