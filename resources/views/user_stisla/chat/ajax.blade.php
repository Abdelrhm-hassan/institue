@foreach($messages as $message)
<div class="row m-0 @if($message['type'] != 'send') justify-content-end @endif">
    <div class="message-card">
        <div class="card-body @if($message['type'] == 'send') sender-background @else receiver-background @endif">
            @if($message['file'] == null)
                <span>{{{ $message['message'] ?? '' }}}</span>
            @else
                <a href="/bin/chat/{!! $message['file'] ?? '' !!}" target="_blank">{!! $message['message'] ?? '' !!}</a>
            @endif
        </div>
        <span class="@if($message['type'] == 'send') sender-time @else receiver-time @endif"><small>{!! $message['date'] ?? '' !!}</small></span>
    </div>
</div>
@endforeach
<input type="hidden" id="avatar" value="{{ $avatar ?? '' }}"/>
<input type="hidden" id="username" value="{{ $name ?? '' }}"/>
