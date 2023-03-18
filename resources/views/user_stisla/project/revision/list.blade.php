@extends('user_stisla.layout.layout')
@section('title',trans('admin.review_requests'))
@section('page')
    <div class="card has-shadow">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                    <tr>
                        <th>{{ trans('admin.project') }}</th>
                        <th class="text-center">{{ trans('admin.type') }}</th>
                        <th class="text-center">{{ trans('admin.status') }}</th>
                        <th class="text-center" width="250">{{ trans('admin.date_of_Registration') }}</th>
                        <th class="text-center" width="150">{{ trans('admin.update_date') }}</th>
                        <th class="text-center" width="150">{{ trans('admin.management') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $item)
                        <tr>
                            <td><a href="/user/project/details/{{ $item->project_id }}">{!! $item->project->title ?? '' !!}</a></td>
                            <td class="text-center">{{ $item->category->title ?? '' }}</td>
                            <td class="text-center">{!! getMode('revision',$item->mode) !!}</td>
                            <td class="text-center">{!! getJDate($item->created_at) !!}</td>
                            <td class="text-center">{!! getJDate($item->updated_at) !!}</td>
                            <td class="text-center">
                                <a href="/user/project/revision/reply/{!! $item->id !!}" title="{{ trans('admin.view_and_post_replies') }}"><i class="la la-comment"></i></a>
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
