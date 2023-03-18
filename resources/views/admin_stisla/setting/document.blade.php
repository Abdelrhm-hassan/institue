@extends('admin_stisla.layout.layout')
@section('title',trans('admin.document_settings'))
@section('page')
    <div class="card has-shadow">
        <div class="card-header bordered no-actions"><h4>{{ trans('admin.text_of_documents') }}</h4></div>
        <form method="post" action="/admin/setting/document/store">
            <div class="card-body">
                @foreach($list as $item)
                    <div class="form-group">
                        <label>{!! $item->title ?? '' !!}</label>
                        <input type="text" class="form-control" name="{!! $item->name ?? '' !!}" value="{!! $item->description ?? '' !!}">
                    </div>
                @endforeach
            </div>
            <div class="card-footer">
                <input type="submit" class="btn btn-primary" value="{!! trans('admin.submit') !!}">
            </div>
        </form>
    </div>
@stop
