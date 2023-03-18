@extends('user_stisla.layout.layout')
@section('title',trans('admin.online'))
@section('page')
    <div class="row">
        <div class="col-12 col-md-5">
            <div class="card has-shadow">
                <div class="card-header bordered no-actions">{{ trans('admin.request_a_change_of_status') }}</div>
                <form method="post" action="/user/profile/online/request">
                    <div class="card-body">
                        <label>{{ trans('admin.status') }}</label>
                        <select name="type" class="form-control custom-select">
                            @if($User->online == 1)
                                <option value="disable">{{ trans('admin.deactivation') }}</option>
                            @else
                                <option value="enable">{{ trans('admin.activation') }}</option>
                            @endif
                        </select>
                    </div>
                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary" value="{!! trans('admin.submit') !!}">
                    </div>
                </form>
            </div>
            @if($User->online == 1)
                <div class="alert alert-info" role="alert">
                    <strong>{{ trans('admin.you_are_currently_an_online_user') }}</strong>
                </div>
            @else
                <div class="alert alert-warning" role="alert">
                    <strong>{{ trans('admin.you_are_not_currently_an_online_user') }}</strong>
                </div>
            @endif
                <div class="alert alert-info" role="alert">
                    <strong>{!! getOption('online_user_request') !!}</strong>
                </div>
        </div>
        <div class="col-12 col-md-7">
            <div class="card has-shadow">
                <div class="card-header bordered no-actions">{{ trans('admin.requests') }}</div>
                <div class="card-body p-0">
                    <table class="table mb-0 table-bordered">
                        <thead>
                        <tr>
                            <th class="text-center">{{ trans('admin.applying_for') }}</th>
                            <th class="text-center">{{ trans('admin.status') }}</th>
                            <th class="text-center">{{ trans('admin.date') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($list as $item)
                            <tr>
                                <td class="text-center">
                                    @if($item->type == 'disable')
                                        {{ trans('admin.deactivation') }}
                                    @else
                                        {{ trans('admin.activation') }}
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($item->mode == 'draft')
                                        <span class="badge badge-warning">{{ trans('admin.draft') }}</span>
                                    @elseif($item->mode == 'reject')
                                        <span class="badge badge-danger">{{ trans('admin.failed') }}</span>
                                    @else
                                        <span class="badge badge-success">{{ trans('admin.done') }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    {!! getJDate($item->created_at) !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
