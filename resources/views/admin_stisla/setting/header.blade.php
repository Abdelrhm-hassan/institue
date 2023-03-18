@extends('admin_stisla.layout.layout')
@section('title',trans('admin.header'))
@section('page')
    <div class="card has-shadow">
        <div class="card-header bordered no-actions"><h4>{{ trans('admin.menu') }}</h4></div>
        <form method="post" @if(!isset($menu)) action="/admin/setting/header/menu/new/store" @else action="/admin/setting/header/menu/edit/store/{!! $menu->id !!}" @endif>
        <div class="card-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-12 col-md-3">
                        <label>{{ trans('admin.title') }}</label>
                        <input type="text" class="form-control" name="title" value="{!! $menu->title ?? '' !!}">
                    </div>
                    <div class="col-12 col-md-3">
                        <label>{{ trans('admin.link') }}</label>
                        <input type="text" class="form-control text-right" dir="ltr" name="url" value="{!! $menu->url ?? '' !!}">
                    </div>
                    <div class="col-12 col-md-4">
                        <label>{!! trans('admin.icon') !!}(<a target="_blank" href="https://iconify.design">iconify</a>)</label>
                        <input type="text" class="form-control text-right" data-input="icon" dir="ltr" name="icon" id="icon" value="{!! $menu->icon ?? '' !!}">
                    </div>
                    <div class="col-12 col-md-2">
                        <label>{{ trans('admin.order') }}</label>
                        <input type="number" class="form-control text-center" name="sort" value="{!! $menu->sort ?? '' !!}">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            @if(!isset($menu))
                <input type="submit" class="btn btn-primary" value="{{ trans('admin.submit') }}">
            @else
                <input type="submit" class="btn btn-warning" value="{{ trans('admin.edit') }}">
            @endif
        </div>
        </form>
    </div>

    <div class="card has-shadow">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                    <tr>
                        <th class="text-center" width="100">{{ trans('admin.icon') }}</th>
                        <th class="text-center" width="200">{{ trans('admin.title') }}</th>
                        <th class="text-center">{{ trans('admin.link') }}</th>
                        <th class="text-center" width="100">{{ trans('admin.management') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($menus as $item)
                        <tr>
                            <td class="text-center">
                                <iconify-icon data-width="36" data-icon="{!! $item->icon ?? '' !!}"></iconify-icon>
                            </td>
                            <td class="text-center">{!! $item->title ?? '' !!}</td>
                            <td class="text-center">{!! $item->url ?? '' !!}</td>
                            <td class="text-center">
                                <a href="/admin/setting/header/menu/edit/{!! $item->id !!}"><i class="fas fa-edit"></i></a>
                                <a class="delete-item" href="/admin/setting/header/menu/delete/{!! $item->id !!}"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
