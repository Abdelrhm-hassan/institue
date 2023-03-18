@extends('user_stisla.layout.layout')
@section('title',trans('admin.support'))
@section('page')
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card has-shadow">
                <div class="card-body text-center" style="height: 300px">
                    <span class="iconify" data-width="100" data-icon="flat-color-icons:online-support" data-inline="false"></span>
                    <h3>{{ trans('admin.Online_backup') }}</h3>
                    <div class="py-4">
                        <span>{!! getOption('support_online') !!}</span>
                    </div>
                    <a @if(getOption('online_support_enable') == 1) href="{!! getOption('online_support_url') !!}" target="_blank" @else href="javascript:void(0);" @endif class="btn btn-primary @if(getOption('online_support_enable') != 1) disabled @endif w-100">
                        @if(getOption('online_support_enable') != 1)
                            {{ trans('admin.backup_is_offline,please_send_ticket') }}
                        @else
                            {{ trans('admin.live_conversation') }}
                        @endif
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card has-shadow">
                <div class="card-body text-center" style="height: 300px">
                    <span class="iconify" data-width="133" data-icon="logos:supportkit" data-inline="false"></span>
                    <h3>{{ trans('admin.request_support') }}</h3>
                    <div class="py-4">
                        <span>{!! getOption('support_ticket') !!}</span>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <a class="btn w-100 btn-warning" href="/user/support/list">{{ trans('admin.list_of_requests') }}</a>
                        </div>
                        <div class="col-6">
                            <a class="btn w-100 btn-success" href="/user/support/new">{{ trans('admin.new_request') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card has-shadow">
                <div class="card-body text-center p-0" style="color:white;background-color: #0F6FD5;height: 134px;">
                    <div class="py-4">
                        <span>{{ trans('admin.telegram_information_channel') }}</span>
                    </div>
                    <a class="btn btn-warning" href="{!! getOption('support_telegram_channel') !!}">{{ trans('admin.subscribe_to_the_channel') }}</a>
                </div>
            </div>
            <div class="card has-shadow">
                <div class="card-body text-center p-0" style="color:white;background-color: purple;height: 134px;">
                    <div class="py-4">
                        <span>{{ trans('admin.telegram_site_robot') }}</span>
                    </div>
                    <a class="btn btn-warning" href="{!! getOption('support_telegram_robot') !!}">{{ trans('admin.see_the_robot') }}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card has-shadow">
        <div class="card-header bordered no-actions">{{ trans('admin.direct_communication_methods') }}</div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <tbody>
                    @foreach($list as $item)
                        <tr>
                            <td width="300" class="text-center">{!! $item->title ?? '' !!}</td>
                            <td class="text-center">{!! $item->description ?? '' !!}</td>
                            <td width="300" class="text-center">{!! $item->time ?? '' !!}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
