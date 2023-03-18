@extends('user_stisla.layout.layout')
@section('title',trans('admin.project_yours'))
@section('page')
    @foreach($list as $item)
        <div class="card has-shadow" style="margin-bottom: 10px;">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead>
                        <tr
                            @if($item->mode == 'done') style="background-color: #28A745;color: white" @endif
                            @if($item->mode == 'publish') style="background-color: #007BFF;color: white" @endif
                            @if($item->mode == 'process') style="background-color: #6C757D;color: white" @endif
                            @if($item->mode == 'draft') style="background-color: #DB7E22;color: white" @endif
                        >
                            <td class="text-center">#</td>
                            <td>{{ trans('admin.title') }}</td>
                            <td class="text-center">{{ trans('admin.category') }}</td>
                            <td class="text-center">{{ trans('admin.contractors') }}</td>
                            <td class="text-center">{{ trans('admin.status') }}</td>
                            <td class="text-center">{{ trans('admin.date_of_Registration') }}</td>
                            <td class="text-center">{{ trans('admin.Offers') }}</td>
                            <td class="text-center">{{ trans('admin.management') }}</td>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">IT-{!! $item->id ?? '' !!}</td>
                                <td style="color: tomato"><a href="/user/project/details/{!! $item->id !!}">{!! $item->title ?? '' !!}@if($item->type == 'online')<span style="color: red;font-size: .7em;text-decoration: blink;position: relative;top: -2px;">&nbsp;{{ trans('admin.online') }}&nbsp;</span>@endif</a></td>
                                <td class="text-center">{!! $item->category->title ?? '' !!}</td>
                                <td class="text-center">{!! $item->contractor->name ?? trans('admin.not_selected') !!}</td>
                                <td class="text-center">{!! getMode('project', $item->mode) !!}</td>
                                <td class="text-center">{!! getJDate($item->created_at) !!}</td>
                                <td class="text-center">{!! $item->offers_count ?? 0 !!}</td>
                                <td class="text-center">
                                    <a href="/user/project/details/{!! $item->id !!}"><i class="la la-eye"></i></a>
                                    @if($item->contractor_id == null)<a class="delete-item" href="/user/project/delete/{!! $item->id !!}"><i class="la la-trash"></i></a>@endif
                                </td>
                            </tr>
                            <tr style="background-color: rgba(0,0,0,0.02)">
                                <td colspan="2">{{ trans('admin.approval_date:') }}
                                    <b style="color: #0F6FD5">{!! getJDateTimestamp($item->accept_at) !!}</b>
                                </td>
                                <td colspan="2">{{ trans('admin.delivery_date:') }}
                                    <b style="color: green">{!! getJDateTimestamp($item->done_at) !!}</b>
                                </td>
                                <td colspan="3">{{ trans('admin.warranty_amount:') }}
                                    @if($item->type == 'online')
                                        <span>{{ trans('admin.does_not_have') }}</span>
                                    @else
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach
    @if($list->hasPages())
        <div class="card-footer text-center">
            {!! $list->links() !!}
        </div>
    @endif
@stop

