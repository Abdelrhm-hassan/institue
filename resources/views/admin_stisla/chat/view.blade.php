@extends('admin_stisla.layout.layout')
@section('title',trans('admin.view_chat'))
@section('page')
    @foreach($messages as $message)
        <div class="card has-shadow">
            <div class="card-header bordered no-actions">
                {!! $message->user->name ?? '' !!}
                <span class="pull-left">{!! getJDate($message->created_at) !!}</span>
            </div>
            @if($message->file == null)
                <div class="card-body">{!! $message->message ?? '' !!}</div>
            @else
                <div class="card-body"><a href="{!! $message->file ?? '' !!}" target="_blank">{!! $message->message ?? '' !!}</a></div>
            @endif
        </div>
    @endforeach
@stop
