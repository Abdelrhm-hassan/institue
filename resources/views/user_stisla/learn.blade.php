@extends('user_stisla.layout.layout')
@section('title',trans('admin.education'))
@section('page')
    <div class="card has-shadow">
        <div class="card-header bordered no-actions"><h4>{{ trans('admin.education') }}</h4></div>
        <div class="card-body">
            {!! getOption('site_learn','') !!}
        </div>
    </div>
@stop
