@extends('admin_stisla.layout.layout')
@section('title','')
@section('page')
    <div class="card has-shadow">
        <div class="card-header bordered no-actions">{!! trans('admin.search') !!}</div>
        <form>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label>{!! trans('admin.title') !!}</label>
                            <input type="text" class="form-control" name="title" value="{!! $_GET['title'] ?? '' !!}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <input type="submit" class="btn btn-primary" value="{!! trans('admin.search') !!}">
            </div>
        </form>
    </div>
    <div class="card has-shadow">
        <div class="card-header bordered no-actions text-right">
            <a href="/admin/product/filter/group/new">{!! trans('admin.add_new_group') !!}</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                    <tr>
                        <th>{!! trans('admin.title') !!}</th>
                        <th class="text-center">{!! trans('admin.type') !!}</th>
                        <th class="text-center">{!! trans('admin.description') !!}</th>
                        <th class="text-center">{!! trans('admin.management') !!}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $item)
                        <tr>
                            <td>{!! $item->title ?? '' !!}</td>
                            <td class="text-center">{!! listType('filter',$item->type) ?? '' !!}</td>
                            <td class="text-center">{!! $item->label ?? '' !!}</td>
                            <td class="text-center">
                                <a href="/admin/product/filter/edit/{!! $item->id !!}"><i class="fas fa-edit"></i></a>
                                <a class="delete-item" href="/admin/product/filter/delete/{!! $item->id !!}"><i class="fas fa-trash"></i></a>
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
