@extends('admin_stisla.layout.layout')
@section('title',trans('admin.new_gallery'))
@section('page')
    <div class="card has-shadow">
        <form method="post" @if(isset($edit)) action="/admin/product/gallery/edit/store/{!! $edit->id ?? '' !!}" @else action="/admin/product/gallery/new/store" @endif>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label>{{ trans('admin.gallery_title') }}</label>
                            <input type="text" required class="form-control" name="title" value="{!! $edit->title ?? '' !!}">
                        </div>
                        <div class="col-12 col-md-6">
                            <label>{{ trans('admin.status') }}</label>
                            <select name="mode" class="form-control">
                                <option value="publish" @if(isset($edit) && $edit->mode == 'publish') selected @endif>{{ trans('admin.publish') }}</option>
                                <option value="draft" @if(isset($edit) && $edit->mode == 'draft') selected @endif>{{ trans('admin.draft') }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <input type="submit" class="btn btn-primary" value="{{ trans('admin.submit') }}">
            </div>
        </form>
    </div>
@stop
