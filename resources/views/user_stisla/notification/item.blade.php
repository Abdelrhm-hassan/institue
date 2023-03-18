@extends('user_stisla.layout.layout')
@section('title',trans('admin.announcement'))
@section('page')
    <div class="card has-shadow">
        <div class="card-header no-actions bordered">{!! $notification->title ?? '' !!}</div>
        <div class="card-body">
            {!! $notification->alert ?? '' !!}
        </div>
    </div>
@stop
