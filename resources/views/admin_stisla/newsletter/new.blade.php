@extends('admin_stisla.layout.layout')
@section('title',trans('admin.newsletter'))
@section('page')
    <div class="card has-shadow">
        <form method="post" @if(isset($edit)) action="/admin/newsletter/edit/store/{!! $edit->id !!}" @else action="/admin/newsletter/store" @endif>
            <div class="card-body">
                <div class="form-group">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <label>{{ trans('admin.title') }}</label>
                                <input type="text" class="form-control" name="title" value="{!! $edit->title ?? '' !!}">
                            </div>
                            <div class="col-6">
                                <label>{{ trans('admin.recipients') }}</label>
                                <select name="recipient" class="form-control">
                                    <option value="all" @if(isset($edit) && $edit->recipient == 'all') selected @endif>{{ trans('admin.all') }}</option>
                                    <option value="manager" @if(isset($edit) && $edit->recipient == 'manager') selected @endif>{{ trans('admin.Managers') }}</option>
                                    <option value="user" @if(isset($edit) && $edit->recipient == 'user') selected @endif>{{ trans('admin.all_users') }}</option>
                                    <option value="user-banned" @if(isset($edit) && $edit->recipient == 'user-banned') selected @endif>{{ trans('admin.disabled_users') }}</option>
                                    <option value="user-active" @if(isset($edit) && $edit->recipient == 'user-active') selected @endif>{{ trans('admin.active_service_users') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{ trans('admin.newsletter_text') }}</label>
                        <textarea class="summernote" id="text">{!! $edit->text ?? '' !!}</textarea>
                    </div>
                    <div class="h-10"></div>
                    @if(isset($edit))
                        {!! fileUploader('/admin/function/upload/file', 'attach', $edit->attach , 'multi',trans('admin.attachment_to_the_newsletter'))!!}
                    @endif
                    @if(!isset($edit))
                        {!! fileUploader('/admin/function/upload/file', 'attach', null , 'multi', trans('admin.attachment_to_the_newsletter')) !!}
                    @endif
                </div>
            </div>
            <div class="card-footer text-right">
                <input type="submit" class="btn btn-primary" @if(isset($edit)) value="{{ trans('admin.edit') }}" @else value="{{ trans('admin.submit') }}" @endif>
            </div>
        </form>
    </div>
@endsection
