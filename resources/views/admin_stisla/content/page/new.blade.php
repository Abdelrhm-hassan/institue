@extends('admin_stisla.layout.layout')
@section('title',trans('admin.new'))
@section('page')
    <form method="post" @if(!isset($edit)) action="/admin/page/new/store" @else action="/admin/page/edit/store/{!! $edit->id !!}" @endif>
        <div class="row">
            <div class="col-12 col-md-9">
                <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>{{ trans('admin.title') }}</label>
                                <input type="text" class="form-control" name="title" value="{!! $edit->title ?? '' !!}">
                            </div>
                            <div class="form-group">
                                <label>Slug</label>
                                <input type="text" class="form-control" name="slug" value="{!! $edit->slug ?? '' !!}">
                            </div>
                            <div class="form-group">
                                <label>{{ trans('admin.main_text') }}</label>
                                <textarea class="summernote" id="text" name="text">{!! $edit->text ?? '' !!}</textarea>
                            </div>
                            <div class="form-group">
                                <label>{{ trans('admin.text_description') }}(Description)</label>
                                <input type="text" class="form-control" name="description" value="{!! $edit->description ?? '' !!}">
                            </div>
                            <div class="form-group">
                                <label>{{ trans('admin.key_words') }}</label>
                                <input type="text" data-role="tagsinput"  class="form-control" name="keyword[]" @if(isset($edit) && is_array(json_decode($edit->keyword,true))) value="{!! implode(',',json_decode($edit->keyword,true)) !!}" @endif>
                            </div>
                        </div>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="card has-shadow">
                    <div class="card-body">
                        <div class="form-group">
                            <label>{{ trans('admin.status') }}</label>
                            <select name="mode" class="form-control">
                                <option value="publish" @if(isset($edit) && $edit->mode == 'publish') selected @endif>{{ trans('admin.publish') }}</option>
                                <option value="draft" @if(isset($edit) && $edit->mode == 'draft') selected @endif>{{ trans('admin.draft') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="form-group text-right">
                            <input type="submit" class="btn btn-primary" @if(isset($edit)) value="{{ trans('admin.edit') }}" @else value="{{ trans('admin.submit') }}" @endif>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
