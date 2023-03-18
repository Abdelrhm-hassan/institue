@extends('user_stisla.layout.layout')
@section('title',trans('admin.list_of_suggestions'))
@section('page')
    <div class="card has-shadow">
        <div class="card-header bordered no-actions"><h4>{{ trans('admin.search') }}</h4></div>
        <form>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <label>{{ trans('admin.title') }}</label>
                            <input type="text" class="form-control" name="title" value="{{ $_GET['title'] ?? '' }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <input type="submit" class="btn btn-primary" value="{{ trans('admin.search') }}">
            </div>
        </form>
    </div>
    <div class="card has-shadow">
        <div class="card-header bordered no-actions" style="background: blueviolet;color: white;"><h4 style="color: white">{{ trans('admin.the_projects_you_selected_as_the_facilitator') }}</h4></div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                    <tr>
                        <th>{{ trans('admin.project') }}</th>
                        <th class="text-center">{{ trans('admin.total_amount') }}</th>
                        <th class="text-center">{{ trans('admin.guarantee') }}</th>
                        <th class="text-center">{{ trans('admin.date') }}</th>
                        <th class="text-center">{{ trans('admin.project_status') }}</th>
                        <th class="text-center">{{ trans('admin.management') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list_contractor as $item)
                        <tr>
                            <td><a href="/user/project/details/{!! $item->id !!}">{!! $item->title ?? '' !!}@if($item->type == 'online')&nbsp;<sub style="color: red;">{{ trans('admin.(usd)') }}</sub>@endif</a></td>
                            <td class="text-center">@if(isset($item->offer)){!! number_format($item->offer->amount) ?? 0 !!}@endif</td>
                            <td class="text-center">@if(isset($item->offer)){!! number_format($item->offer->warranty) ?? 0 !!}@endif</td>
                            <td class="text-center">{!! getJDate($item->created_at) !!}</td>
                            <td class="text-center">{!! getMode('project', $item->mode) ?? '-' !!}</td>
                            <td class="text-center">
                                @if(isset($item) && $item->mode == 'process' && $item->contractor_id == $User->id)
                                    <a href="/user/project/details/{!! $item->id !!}">{{ trans('admin.management') }}</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @if($list_contractor->hasPages())
            <div class="card-footer text-center">
                {!! $list_contractor->links() !!}
            </div>
        @endif
    </div>
    <div class="card has-shadow">
        <div class="card-header bordered no-actions" style="background: orange;color: white"><h4 style="color: white;">{{ trans('admin.all_your_suggestions') }}</h4></div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                    <tr>
                        <th>{{ trans('admin.project') }}</th>
                        <th class="text-center">{{ trans('admin.total_amount') }}</th>
                        <th class="text-center">{{ trans('admin.guarantee') }}</th>
                        <th class="text-center">{{ trans('admin.date') }}</th>
                        <th class="text-center">{{ trans('admin.project_status') }}</th>
                        <th class="text-center">{{ trans('admin.bid_status') }}</th>
                        <th class="text-center">{{ trans('admin.management') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $item)
                        <tr>
                            <td><a href="/user/project/details/{!! $item->project_id !!}">{!! $item->project->title ?? '' !!}</a></td>
                            <td class="text-center">{!! number_format($item->amount) ?? 0 !!}</td>
                            <td class="text-center">{!! number_format($item->warranty) ?? 0 !!}</td>
                            <td class="text-center">{!! getJDate($item->created_at) !!}</td>
                            <td class="text-center">@if(isset($item->project)){!! getMode('project', $item->project->mode) ?? '-' !!}@endif</td>
                            <td class="text-center">{!! getMode('offer', $item->mode) ?? '-' !!}</td>
                            <td class="text-center">
                                @if(isset($item->project) && $item->project->mode == 'publish' && $item->mode == 'draft')
                                    <a class="delete-item" href="/user/project/offer/delete/{!! $item->id !!}"><i class="la la-trash"></i></a>
                                @endif
                                @if(isset($item->project) && $item->project->mode == 'process' && $item->mode == 'accept')
                                    <a href="/user/project/offer/manage/{!! $item->id !!}">{{ trans('admin.management') }}</a>
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
