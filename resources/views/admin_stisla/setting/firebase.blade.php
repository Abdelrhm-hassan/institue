@extends('admin_stisla.layout.layout')
@section('title',trans('admin.firebase_settings'))
@section('page')
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card has-shadow">
                <div class="card-body">
                    <form method="post" action="/admin/setting/store">
                        <div class="form-group">
                            <input type="hidden" name="firebase_enable" value="0">
                            <input type="checkbox" style="position: relative;top: 2px;" name="firebase_enable" value="1" @if(getOption('firebase_enable') == 1) checked @endif>&nbsp;<span>{{ trans('admin.enable_firebase') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="pull-left">Server Token</label>
                            <input type="text" class="form-control text-right" dir="ltr" name="firebase_token" value="{{ getOption('firebase_token') }}">
                        </div>
                        <div class="form-group">
                            <label class="pull-left">Server Id</label>
                            <input type="text" class="form-control text-right" dir="ltr" name="firebase_id" value="{{ getOption('firebase_id') }}">
                        </div>
                        <div class="form-group text-right">
                            <input type="submit" class="btn btn-primary" value="{{ trans('admin.save') }}">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@stop
