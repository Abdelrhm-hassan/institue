@extends('admin_stisla.layout.layout')
@section('title',trans('admin.reports'))
@section('page')
    <div class="card has-shadow">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                    <tr>
                        <th>{{ trans('admin.title') }}</th>
                        <th class="text-center">{{ trans('admin.reporter') }}</th>
                        <th class="text-center">{{ trans('admin.employer') }}</th>
                        <th class="text-center">{{ trans('admin.contractor') }}</th>
                        <th class="text-center">{!! trans('admin.category') !!}</th>
                        <th class="text-center">{!! trans('admin.status') !!}</th>
                        <th class="text-center">{{ trans('admin.created_at') }}</th>
                        <th class="text-center">{{ trans('admin.settings') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $item)
                        <tr>
                            <td>
                                @if($item->project->type == 'online')
                                    <a href="/admin/project/online?id={{ $item->project->id ?? '' }}">{!! $item->project->title ?? '' !!}</a>
                                @else
                                    <a href="/admin/project/list?id={{ $item->project->id ?? '' }}">{!! $item->project->title ?? '' !!}</a>
                                @endif
                            </td>
                            <td class="text-center"><a href="/admin/user/list?id={{ $item->user_id ?? '' }}">{!! $item->user->name ?? '-' !!}</a></td>
                            <td class="text-center"><a href="/admin/user/list?id={{ $item->project->user_id ?? '' }}">{!! $item->project->user->name ?? '-' !!}</a></td>
                            <td class="text-center"><a href="/admin/user/list?id={{ $item->project->contractor_id ?? '' }}">{!! $item->project->contractor->name ?? '-' !!}</a></td>
                            <td class="text-center">{!! $item->project->category->title ?? '' !!}</td>
                            <td class="text-center">{!! getMode('project', $item->project->mode) !!}</td>
                            <td class="text-center">{!! getJDate($item->created_at) !!}</td>
                            <td class="text-center">
                                <a class="delete-item" title="Delete Report" href="/admin/project/report/action?mode=delete&id={!! $item->id !!}"><i class="fas fa-trash"></i></a>
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
