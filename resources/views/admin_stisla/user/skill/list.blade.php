@extends('admin_stisla.layout.layout')
@section('title',trans('admin.skills'))
@section('page')
    <div class="row">
        <div class="col-12 col-md-5">
            <div class="card has-shadow">
                <div class="card-header bordered no-actions"><h4>{!! trans('admin.category') !!}</h4></div>
                <form method="post" @if(isset($edit)) action="/admin/user/skill/edit/store/{!! $edit->id !!}" @else action="/admin/user/skill/new/store" @endif>
                    <div class="card-body">
                        <div class="form-group">
                            <label>{{ trans('admin.title') }}</label>
                            <input type="text" required class="form-control" name="title" value="{!! $edit->title ?? '' !!}">
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary" value="{!! trans('admin.save') !!}">
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12 col-md-7">
            <div class="card has-shadow">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                            <tr>
                                <th>{!! trans('admin.title') !!}</th>
                                <th class="text-center" width="100">{!! trans('admin.management') !!}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $item)
                                <tr>
                                        <td>{!! $item->title ?? '' !!}</td>
                                        <td class="text-center">
                                            <a href="/admin/user/skill/edit/{!! $item->id !!}" title="{!! trans('admin.edit') !!}"><i class="fas fa-edit"></i></a>
                                            <a class="delete-item" href="/admin/user/skill/delete/{!! $item->id !!}" title="{!! trans('admin.delete') !!}"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
