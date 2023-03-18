@extends('admin_stisla.layout.layout')
@section('title',trans('admin.support_settings'))
@section('page')

    <div class="card has-shadow">
        <div class="card-header bordered no-actions"><h4>{{ trans('admin.main_addresses') }}</h4></div>
        <form method="post" action="/admin/support/setting/store">
        <div class="card-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <label>{{ trans('admin.telegram_channel_address') }}</label>
                        <input type="text" class="form-control" name="support_telegram_channel" value="{!! getOption('support_telegram_channel') !!}">
                    </div>
                    <div class="col-12 col-md-4">
                        <label>{{ trans('admin.telegram_robot_address') }}</label>
                        <input type="text" class="form-control"  name="support_telegram_robot" value="{!! getOption('support_telegram_robot') !!}">
                    </div>
                    <div class="col-12 col-md-4">
                        <label>{{ trans('admin.online_backup_address') }}</label>
                        <input type="text" class="form-control"  name="support_online_url" value="{!! getOption('support_online_url') !!}">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <input type="hidden" name="online_support_enable" value="0">
                <input type="checkbox" name="online_support_enable" value="1" @if(getOption('online_support_enable') == 1) checked @endif>&nbsp;<span>{{ trans('admin.enable_online_backup') }}</span>
            </div>
        </div>
        <div class="card-footer">
            <input type="submit" class="btn btn-primary" value="{{ trans('admin.submit') }}">
        </div>
        </form>
    </div>
    <div class="card has-shadow">
        <div class="card-header bordered no-actions"><h4>{{ trans('admin.communication_methods') }}</h4></div>
        <form method="post" @if(isset($edit)) action="/admin/support/setting/contact/edit/store/{!! $edit->id !!}" @else action="/admin/support/setting/contact/new/store" @endif>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-4">
                            <label>{{ trans('admin.title') }}</label>
                            <input type="text" class="form-control" name="title" value="{!! $edit->title ?? '' !!}">
                        </div>
                        <div class="col-5">
                            <label>{{ trans('admin.explanation') }}</label>
                            <input type="text" class="form-control" name="description" value="{!! $edit->description ?? '' !!}">
                        </div>
                        <div class="col-2">
                            <label>{{ trans('admin.access_hours') }}</label>
                            <input type="text" class="form-control" name="time" value="{!! $edit->time ?? '' !!}">
                        </div>
                        <div class="col-1">
                            <label>{{ trans('admin.order') }}</label>
                            <input type="number" class="form-control" name="sort" value="{!! $edit->sort ?? '' !!}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <input type="submit" class="btn btn-primary" value="{{ trans('admin.submit') }}">
            </div>
        </form>
    </div>
    <div class="card has-shadow">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                    <tr>
                        <th>{{ trans('admin.title') }}</th>
                        <th class="text-center">{{ trans('admin.explanation') }}</th>
                        <th class="text-center">{{ trans('admin.access_hours') }}</th>
                        <th class="text-center" width="150">{{ trans('admin.management') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $item)
                        <tr>
                            <td>{!! $item->title ?? '' !!}</td>
                            <td class="text-center">{!! $item->description ?? '' !!}</td>
                            <td class="text-center">{!! $item->time ?? '' !!}</td>
                            <td class="text-center">
                                <a href="/admin/support/setting/contact/edit/{!! $item->id !!}"><i class="fas fa-edit"></i></a>
                                <a class="delete-item" href="/admin/support/setting/contact/delete/{!! $item->id !!}"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

