@extends('admin_stisla.layout.layout')
@section('title',trans('admin.department'))
@section('page')
    <div class="row">
        <div class="col-12 col-md-5">
            <div class="card has-shadow">
                <form method="post" @if(!isset($edit)) action="/admin/support/category/new/store" @else action="/admin/support/category/edit/store/{!! $edit->id !!}" @endif>
                    <div class="card-body">
                        <div class="form-group">
                            <label>{{ trans('admin.department_title') }}</label>
                            <input type="text" class="form-control" name="title" value="{!! $edit->title ?? '' !!}" required>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-8">
                                    <label>{{ trans('admin.status') }}</label>
                                    <select name="mode" class="form-control">
                                        <option value="publish" @if(isset($edit) && $edit->mode == 'publish') selected @endif>{{ trans('admin.publish') }}</option>
                                        <option value="draft" @if(isset($edit) && $edit->mode == 'draft') selected @endif>{{ trans('admin.draft') }}</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label>{{ trans('admin.view_order') }}</label>
                                    <input type="number" class="form-control text-center" name="sort" value="{!! $edit->sort ?? '' !!}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <input type="submit" class="btn btn-primary"  @if(isset($edit)) value="{{ trans('admin.edit') }}" @else value="{{ trans('admin.submit') }}" @endif>
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
                                <th>{{ trans('admin.title') }}</th>
                                <th class="text-center" width="150">{{ trans('admin.status') }}</th>
                                <th class="text-center" width="150">{{ trans('admin.settings') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $item)
                                <tr>
                                    <td>{!! $item->title ?? '' !!}</td>
                                    <td class="text-center">{!! getMode('public', $item->mode) !!}</td>
                                    <td class="text-center">
                                        <a title="{{ trans('admin.edit') }}" href="/admin/support/category/edit/{!! $item->id !!}"><i class="fas fa-edit"></i></a>
                                        <a class="delete-item" href="/admin/support/category/delete/{!! $item->id !!}"><i class="fas fa-trash"></i></a>
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
@endsection
