@extends('admin_stisla.layout.layout')
@section('title',trans('admin.category'))
@section('page')
    <div class="row">
        <div class="col-12 col-md-5">
            <div class="card has-shadow">
                <div class="card-header bordered no-actions"><h4>{!! trans('admin.category') !!}</h4></div>
                <form method="post" @if(isset($edit)) action="/admin/project/category/edit/store/{!! $edit->id !!}" @else action="/admin/project/category/new/store" @endif>
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
                            <label>{!! trans('admin.icon') !!}(<a target="_blank" href="https://iconify.design">iconify</a>)</label>
                            <input type="text" class="form-control text-right" dir="ltr" data-input="icon" id="icon" name="icon" value="{!! $edit->icon ?? '' !!}">
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
                                <th class="text-center" width="100">{!! trans('admin.icon') !!}</th>
                                <th>{!! trans('admin.title') !!}</th>
                                <th class="text-center" width="100">{!! trans('admin.status') !!}</th>
                                <th class="text-center" width="100">{!! trans('admin.management') !!}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $item)
                                @if($item->parent_id == null)
                                    <tr>
                                        <td class="text-center"><span class="iconify" style="color:#1EA6F3" data-width="30" data-icon="{!! $item->icon ?? '' !!}" data-inline="false"></span></td>
                                        <td>{!! $item->title ?? '' !!}</td>
                                        <td class="text-center">{!! getMode('public', $item->mode) !!}</td>
                                        <td class="text-center">
                                            <a href="/admin/project/category/edit/{!! $item->id !!}" title="{!! trans('admin.edit') !!}"><i class="fas fa-edit"></i></a>
                                            <a class="delete-item" href="/admin/project/category/delete/{!! $item->id !!}" title="{!! trans('admin.delete') !!}"><i class="fas fa-trash"></i></a>
                                            @if($item->childes_count > 0)
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#sub{!! $item->id !!}" title="{!! trans('admin.show_subcategory') !!}"><i class="la la-list"></i></a>
                                                <div class="modal fade" id="sub{!! $item->id !!}" tabindex="-1" role="dialog"
                                                     aria-labelledby="modelTitleId" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="modelTitleId">{!! $item->title ?? '' !!}</h4>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body p-0">
                                                                <div class="table-responsive">
                                                                    <table class="table mb-0">
                                                                        <thead>
                                                                        <tr>
                                                                            <td>{!! trans('admin.title') !!}</td>
                                                                            <td class="text-center">{!! trans('admin.status') !!}</td>
                                                                            <td class="text-center">{!! trans('admin.management') !!}</td>
                                                                        </tr>
                                                                        </thead>
                                                                        @foreach($list as $child)
                                                                            @if($child->parent_id == $item->id)
                                                                                <tr>
                                                                                    <td>{!! $child->title ?? '' !!}</td>
                                                                                    <td class="text-center">{!! getMode('public', $child->mode) !!}</td>
                                                                                    <td class="text-center">
                                                                                        <a href="/admin/project/category/edit/{!! $child->id !!}" title="{!! trans('admin.edit') !!}"><i class="fas fa-edit"></i></a>
                                                                                        <a class="delete-item" href="/admin/project/category/delete/{!! $child->id !!}" title="{!! trans('admin.delete') !!}"><i class="fas fa-trash"></i></a>
                                                                                    </td>
                                                                                </tr>
                                                                            @endif
                                                                        @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
