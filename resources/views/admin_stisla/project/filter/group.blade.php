@extends('admin_stisla.layout.layout')
@section('title',trans('admin.group'))
@section('page')
    <div class="card has-shadow">
        <div class="card-header bordered no-actions">{!! trans('admin.add_new_group') !!}</div>
        <form method="post" @if(isset($edit)) action="/admin/product/filter/group/edit/store/{!! $edit->id ?? '' !!}" @else action="/admin/product/filter/group/new/store" @endif>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label>{{ trans('admin.title') }}</label>
                            <input type="text" class="form-control" name="title" value="{!! $edit->title ?? '' !!}">
                        </div>
                        <div class="col-12 col-md-6">
                            <label>{!! trans('admin.icon') !!}(<a target="_blank" href="https://iconify.design">iconify</a>)</label>
                            <input type="text" class="form-control text-right" name="icon" id="icon" data-input="icon" value="{!! $edit->icon ?? '' !!}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <input type="submit" class="btn btn-primary" value="{!! trans('admin.save') !!}">
            </div>
        </form>
    </div>
    <div class="card has-shadow">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                    <tr>
                        <th class="text-center" width="100">{!! trans('admin.icon') !!}</th>
                        <th>{!! trans('admin.title') !!}</th>
                        <th class="text-center" width="140">{!! trans('admin.management') !!}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $item)
                        <tr>
                            <th class="text-center" width="100">
                                @if(isset($item->icon))
                                    <span class="iconify" data-width="20" data-icon="{!! $item->icon ?? '' !!}" data-inline="false"></span>
                                @endif
                            </th>
                            <th>{!! $item->title ?? '' !!}</th>
                            <th class="text-center" width="140">
                                <a href="/admin/product/filter/new/{!! $item->id !!}"title="{!! trans('admin.add_new_filter') !!}"><i class="la la-tags"></i></a>
                                <a href="/admin/product/filter/group/edit/{!! $item->id !!}" title=""><i class="fas fa-edit"></i></a>
                                <a class="delete-item" href="/admin/product/filter/group/delete/{!! $item->id !!}"><i class="fas fa-trash"></i></a>
                            </th>
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
