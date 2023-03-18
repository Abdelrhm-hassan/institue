@extends('user_stisla.layout.layout')
@section('title',trans('admin.support_tickets'))
@section('page')
    <div class="card has-shadow">
        <div class="card-header bordered no-actions">
            <h4>
                {!! $ticket->title ?? '' !!}
                <span class="float-right">{!! getJDate($ticket->created_at) !!}</span>
            </h4>
        </div>
        <div class="card-body">
            {!! $ticket->text ?? '' !!}
        </div>
    </div>
    @foreach($ticket->messages as $message)
        <div class="card has-shadow">
            @if($message->user_id == null)
                <div class="card-header bordered no-actions" style="background: #0F6FD5;color: #fff8f8">
                    <h4 style="color: #fff8f8">
                        {{ trans('admin.supporter') }}
                        <span class="float-right">{!! getJDate($message->created_at) !!}</span>
                    </h4>
                </div>
            @else
                <div class="card-header bordered no-actions">
                    {{ trans('admin.user') }}
                    <span class="float-right">{!! getJDate($message->created_at) !!}</span>
                </div>
            @endif
            <div class="card-body">
                {!! $message->text ?? '' !!}
            </div>
            @if($message->file != null && $message->file != '' && $message->file != '[null]' && is_array(json_decode($message->file, true)))
                <div class="card-footer">
                    @foreach(json_decode($message->file, true) as $file)
                        <a target="_blank" href="{!! $file ?? '' !!}"><i class="la la-file-archive-o"></i></a>
                    @endforeach
                </div>
            @endif
        </div>
    @endforeach
    <div class="card has-shadow">
        <div class="card-header bordered no-actions">
            <h4>{{ trans('admin.post_reply') }}</h4>
        </div>
        <form method="post" action="/user/support/reply/store/{!! $ticket->id !!}">
            <div class="card-body">
                <div class="form-group">
                    <textarea class="form-control" style="height: 200px;" name="text"></textarea>
                </div>
                <div class="h-10"></div>
                {!! fileUploader('/user/support/upload','file',null,'multi', trans('admin.appendix')) !!}
            </div>
            <div class="card-footer text-right">
                <input type="submit" class="btn btn-primary" value="{{ trans('admin.send') }}">
            </div>
        </form>
    </div>
@endsection
