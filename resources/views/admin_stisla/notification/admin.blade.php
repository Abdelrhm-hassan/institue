@extends('admin_stisla.layout.layout')
@section('title',trans('admin.management_notifications'))
@section('page')
    <div class="card has-shadow">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                    <tr>                
                       <th>{{ trans('admin.title') }}</th>
                        <th>{{ trans('admin.Description') }}</th>
                        <th class="text-center" width="100">{{ trans('admin.status') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $item)
                        <tr>
                            <td class="text-left">{!! $item->title ?? '' !!}</td>
                            <td class="text-left">{!! $item->alert ?? '' !!}</td>
                            <td class="text-center">
                                @if($item->view == 0)
                                    <span class="badge badge-warning">{{ trans('admin.have_not_been_seen') }}</span>
                                @else
                                    <span class="badge badge-success">{{ trans('admin.observed') }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @if($list->hasPages())
            <div class="card-footer text-center">
                {!! $list->links() !!}
            </div>
        @endif
    </div>
@stop
