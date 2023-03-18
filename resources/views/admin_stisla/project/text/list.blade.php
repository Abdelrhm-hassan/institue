@extends('admin_stisla.layout.layout')
@section('title',trans('admin.text_type'))
@section('page')
    <div class="row">
        <div class="col-12 col-md-5">
            <div class="card has-shadow">
                <div class="card-header bordered no-actions"><h4>{!! trans('admin.category') !!}</h4></div>
                <form method="post" @if(isset($edit)) action="/admin/project/text/edit/store/{!! $edit->id !!}" @else action="/admin/project/text/new/store" @endif>
                    <div class="card-body">
                        <div class="form-group">
                            <label>{{ trans('admin.title') }}</label>
                            <input type="text" required class="form-control" name="title" value="{!! $edit->title ?? '' !!}">
                        </div>
                        <div class="form-group">
                            <label>{!! trans('admin.order') !!}</label>
                            <input type="number" required class="form-control" name="sort" value="{!! $edit->sort ?? '' !!}">
                        </div>
                        <div class="form-group">
                            <label>{!! trans('admin.status') !!}</label>
                            <select name="mode" class="form-control">
                                <option value="publish" @if(isset($edit) && $edit->mode == 'publish') selected @endif>{!! trans('admin.publish') !!}</option>
                                <option value="draft" @if(isset($edit) && $edit->mode == 'draft') selected @endif>{!! trans('admin.draft') !!}</option>
                            </select>
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
                                <th class="text-center" width="100">{!! trans('admin.status') !!}</th>
                                <th class="text-center" width="100">{!! trans('admin.management') !!}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $item)
                                <tr>
                                        <td>{!! $item->title ?? '' !!}</td>
                                        <td class="text-center">{!! getMode('public', $item->mode) !!}</td>
                                        <td class="text-center">
                                            <a href="/admin/project/text/edit/{!! $item->id !!}" title="{!! trans('admin.edit') !!}"><i class="fas fa-edit"></i></a>
                                            <a class="delete-item" href="/admin/project/text/delete/{!! $item->id !!}" title="{!! trans('admin.delete') !!}"><i class="fas fa-trash"></i></a>
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
