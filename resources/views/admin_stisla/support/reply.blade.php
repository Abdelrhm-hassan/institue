@extends('admin_stisla.layout.layout')
@section('title', $ticket->title)
@section('page')
    <style>
        .user-card .card-header{
            background-color: #0f6674;
            color: #fafafa;
        }
        .user-card .card-header h4{
            color: #fafafa;
        }
        .admin-card .card-header{
            background-color: #3b5998;
            color: #fafafa;
        }
        .admin-card .card-header h4{
            color: #fafafa;
        }
    </style>
    @if($ticket->mode == 'closed')
        <div class="alert alert-danger" role="alert">
            <strong>{{ trans('admin.attention!_You_are_reviewing_a_closed_ticket') }}</strong>
        </div>
    @endif
    <div class="card has-shadow">
        <div class="card-body d-flex flex-row justify-content-between">
            <div>
                <span>{{ trans('admin.sender') }} :</span>
                <span>{!! userUrl($ticket->user) !!}</span>
            </div>
            <div>
                <span>{{ trans('admin.created_at') }} :</span>
                <span>{!! getJDate($ticket->created_at) !!}</span>
            </div>
        </div>
    </div>
    <div class="card user-card has-shadow">
        <div class="card-header bordered no-actions d-flex align-items-center"><h4>{!! $ticket->title ?? '' !!}</h4></div>
        <div class="card-body">
            {!! $ticket->text ?? '-' !!}
        </div>
        <div class="card-footer text-right d-flex flex-row justify-content-between">
            @if($ticket->file != '[null]' && $ticket->file != null && is_array(json_decode($ticket->file)))
                @foreach(json_decode($ticket->file) as $file)
                    <a href="{!! $file ?? '' !!}" target="_blank" class="pull-right" style="font-size: 1.2em;"><i class="la la-file-archive-o"></i></a>
                @endforeach
            @endif
            {!! getJDate($ticket->created_at) !!}
        </div>
    </div>
    @foreach($ticket->messages as $message)
        @if($message->supporter_id != null)
            <div class="card has-shadow admin-card">
                <div class="card-header bordered no-actions d-flex align-items-center"><h4>{{ trans('admin.supporter') }}</h4></div>
                <div class="card-body">{!! $message->text ?? '' !!}</div>
                <div class="card-footer text-right">
                    @if($message->file != '[null]' && $message->file != null && is_array(json_decode($message->file)))
                        @foreach(json_decode($message->file) as $file)
                            <a href="{!! $file ?? '' !!}" target="_blank" class="pull-right" style="font-size: 1.2em;"><i class="la la-file-archive-o"></i></a>
                        @endforeach
                    @endif
                    {!! getJDate($message->created_at) !!}
                </div>
            </div>
        @else
            <div class="card has-shadow user-card">
                <div class="card-header bordered no-actions d-flex align-items-center"><h4>{{ trans('admin.user') }}</h4></div>
                <div class="card-body">{!! $message->text ?? '' !!}</div>
                <div class="card-footer text-right">
                    @if($message->file != '[null]' && $message->file != null && is_array(json_decode($message->file)))
                        @foreach(json_decode($message->file) as $file)
                            <a href="{!! $file ?? '' !!}" target="_blank" class="pull-right" style="font-size: 1.2em;"><i class="fas fa-file-archive"></i></a>
                        @endforeach
                    @endif
                    {!! getJDate($message->created_at) !!}
                </div>
            </div>
        @endif
    @endforeach
    @if($ticket->mode == 'closed')

    @else
        <div class="card has-shadow">
        <div class="card-header bordered no-actions d-flex align-items-center"><h4>{{ trans('admin.post_reply') }}</h4></div>
        <form method="post" action="/admin/support/reply/store/{!! $ticket->id !!}">
            <div class="card-body">
                <div class="form-group">
                    <label>{{ trans('admin.text') }}</label>
                    <textarea class="summernote" rows="10" name="text"></textarea>
                </div>
                <div class="h-10"></div>
                {!! fileUploader('/admin/function/upload/file','file',null,'multi', trans('admin.appendix')) !!}
            </div>
            <div class="card-footer text-right">
                <input type="submit" class="btn btn-primary" value="{{ trans('admin.send') }}">
            </div>
        </form>
    </div>
    @endif
@endsection
