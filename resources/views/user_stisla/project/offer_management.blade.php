@extends('user_stisla.layout.layout')
@section('title',trans('admin.project_management'))
@section('page')
    <div class="card has-shadow">
        <div class="card-header bordered no-actions">{{ trans('admin.send_file_and_project_description') }}</div>
        <form method="post" enctype="multipart/form-data"
              action="/user/project/offer/upload/{!! $offer->project_id ?? '' !!}">
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <label>{{ trans('admin.file_title') }}</label>
                            <input type="text" class="form-control" name="title">
                        </div>
                        <div class="col-12 col-md-3">
                            <label>{{ trans('admin.file_(zip_format_only)') }}</label>
                            <input type="file" name="upload" class="form-control">
                        </div>
                        <div class="col-12 col-md-3">
                            <label>{{ trans('admin.file_type') }}</label>
                            <select name="type" class="form-control">
                                <option value="price">{{ trans('admin.non_free') }}</option>
                                <option value="free">{{ trans('admin.free') }}</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-2">
                            <label>{{ trans('admin.number_of_pages') }}</label>
                            <input type="number" class="form-control text-center" min="1" name="page">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>{{ trans('admin.description') }}</label>
                    <textarea class="form-control" rows="10"></textarea>
                </div>
            </div>
            <div class="card-footer">
                <input type="submit" class="btn btn-primary" value="{!! trans('admin.submit') !!}">
            </div>
        </form>
    </div>
    <div class="card has-shadow">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead>
                        <tr>
                            <td>{{ trans('admin.title') }}</td>
                            <td class="text-center" width="100">{{ trans('admin.type') }}</td>
                            <td class="text-center" width="200">{{ trans('admin.postage_date') }}</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($list as $item)
                            <tr>
                                <td><a href="{!! $item->file ?? '' !!}">{!! $item->title ?? '' !!}</a></td>
                                <td class="text-center">
                                    @if($item->type == 'free')
                                        <div class="badge badge-danger">{{ trans('admin.free') }}</div>
                                    @else
                                        <div class="badge badge-info">{{ trans('admin.non_free') }}</div>
                                    @endif
                                </td>
                                <td class="text-center">{!! getJDate($item->created_at) !!}</td>
                            </tr>
                            @if(isset($item->description) && $item->description != '')
                                <tr>
                                    <td colspan="4">{!! $item->description ?? '' !!}</td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@stop
