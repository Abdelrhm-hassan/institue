@extends('admin_stisla.layout.layout')
@section('title',trans('admin.edit_notification'))
@section('page')
    <div class="card">
        <div class="card-header bordered no-actions d-flex"><h4>{{ trans('admin.short_code') }}</h4></div>
        <div class="card-body">
            <div class="row">
                <div class="col-4">[User.Name] => {{ trans('admin.name') }}</div>
                <div class="col-4">[User.Email] => {{ trans('admin.user_email') }}</div>
                <div class="col-4">[Project.Title] =>{{ trans('admin.project_title') }} </div>
            </div>
            <div class="h-10"></div>
            <div class="row">
                <div class="col-4">[Ticket.Id] =>{{ trans('admin.ticket_number') }}</div>
                <div class="col-4">[Ticket.Title] => {{ trans('admin.ticket_title') }}</div>
                <div class="col-4">[Ticket.Update] => {{ trans('admin.update_date') }}</div>
            </div>
            <div class="h-10"></div>
            <div class="row">
                <div class="col-4">[Transaction.Ref] => {{ trans('admin.payment_number') }}</div>
                <div class="col-4">[Transaction.Mode] => {{ trans('admin.payment_status') }}</div>
                <div class="col-4">[Transaction.Type] => {{ trans('admin.payment_type') }}</div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header bordered no-actions d-flex">
            <h4>{{ trans('admin.edit_notification') }}"{!! $edit->title ?? '' !!}"</h4>
        </div>
        <form method="post" action="/admin/notification/setting/store/{!! $edit->id !!}">
            <div class="card-body">
                <div class="form-group">
                    <label>{{ trans('admin.SMS_text') }}</label>
                    <input type="text" class="form-control" name="sms" value="{!! $edit->sms ?? '' !!}">
                </div>
                <div class="form-group">
                    <label>{{ trans('admin.email_text') }}</label>
                    <textarea class="summernote" id="email" name="email">{!! $edit->email ?? '' !!}</textarea>
                </div>
                <div class="form-group">
                    <label>{{ trans('admin.announcement_text') }}</label>
                    <textarea class="summernote" id="alert" name="alert">{!! $edit->alert ?? '' !!}</textarea>
                </div>
            </div>
            <div class="card-footer text-right">
                <input type="submit" class="btn btn-primary" value="{{ trans('admin.update') }}">
            </div>
        </form>
    </div>
@endsection
