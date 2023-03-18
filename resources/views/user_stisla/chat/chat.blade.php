@extends('user_stisla.layout.layout')
@section('title',trans('admin.chat'))
@section('page')
    <style>
        .chat-layout{padding: 0!important;min-height: auto !important;}
        span.online{
            width: 10px;
            height: 10px;
            position: absolute;
            background-color: #2BE973;
            border-radius: 10px;
            z-index: 9999;
        }
        .loader {
            color: #404040;
            font-size: 90px;
            text-indent: -9999em;
            overflow: hidden;
            width: 1em;
            height: 1em;
            border-radius: 50%;
            margin: 72px auto;
            position: relative;
            -webkit-transform: translateZ(0);
            -ms-transform: translateZ(0);
            transform: translateZ(0);
            -webkit-animation: load6 1.7s infinite ease, round 1.7s infinite ease;
            animation: load6 1.7s infinite ease, round 1.7s infinite ease;
        }
        @-webkit-keyframes load6 {
            0% {
                box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
            }
            5%,
            95% {
                box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
            }
            10%,
            59% {
                box-shadow: 0 -0.83em 0 -0.4em, -0.087em -0.825em 0 -0.42em, -0.173em -0.812em 0 -0.44em, -0.256em -0.789em 0 -0.46em, -0.297em -0.775em 0 -0.477em;
            }
            20% {
                box-shadow: 0 -0.83em 0 -0.4em, -0.338em -0.758em 0 -0.42em, -0.555em -0.617em 0 -0.44em, -0.671em -0.488em 0 -0.46em, -0.749em -0.34em 0 -0.477em;
            }
            38% {
                box-shadow: 0 -0.83em 0 -0.4em, -0.377em -0.74em 0 -0.42em, -0.645em -0.522em 0 -0.44em, -0.775em -0.297em 0 -0.46em, -0.82em -0.09em 0 -0.477em;
            }
            100% {
                box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
            }
        }
        @keyframes load6 {
            0% {
                box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
            }
            5%,
            95% {
                box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
            }
            10%,
            59% {
                box-shadow: 0 -0.83em 0 -0.4em, -0.087em -0.825em 0 -0.42em, -0.173em -0.812em 0 -0.44em, -0.256em -0.789em 0 -0.46em, -0.297em -0.775em 0 -0.477em;
            }
            20% {
                box-shadow: 0 -0.83em 0 -0.4em, -0.338em -0.758em 0 -0.42em, -0.555em -0.617em 0 -0.44em, -0.671em -0.488em 0 -0.46em, -0.749em -0.34em 0 -0.477em;
            }
            38% {
                box-shadow: 0 -0.83em 0 -0.4em, -0.377em -0.74em 0 -0.42em, -0.645em -0.522em 0 -0.44em, -0.775em -0.297em 0 -0.46em, -0.82em -0.09em 0 -0.477em;
            }
            100% {
                box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
            }
        }
        @-webkit-keyframes round {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        @keyframes round {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
    </style>
    <div class="col-xl-12 p-0 chat">
        <!-- Begin card -->
        <div class="row m-0 card no-bg">
            <!-- Begin Friends Sidebar -->
            <div class="col-xl-3 col-lg-3 col-md-12 p-0" id="sidebar">
                <!-- Begin Friendslist -->
                <div class="sidebar-content w-100 h-100"  style="height: 90%;">
                    <div class="input-group no-padding" id="search-group">
                        <input type="text" class="form-control border-0" placeholder="{{ trans('admin.search_username...') }}" id="search-name">
                    </div>
                    <!-- Begin List Group -->
                    <div id="list-group">
                        <ul class="friend-list list-group w-100 friends-scroll auto-scroll">
                            @foreach($list as $item)
                                @if($item->sender_id == $User->id)
                                    <li class="list-group-item chat-user" chat-id="{!! $item->receiver_id !!}">
                                        <a class="d-block" data-toggle="tab" href="javascript:void(0);">
                                            <div class="media">
                                               <div class="media-left align-self-center">
                                                   <img src="{!! $item->receiver->avatar ?? '/assets/user/img/avatar.png' !!}" class="user-img rounded-circle" alt="...">
                                               </div>
                                               <div class="media-body align-self-center">
                                                    <h4>{!! $item->receiver->name ?? $item->receiver->email ?? '' !!}</h4>
                                               </div>
                                               <div class="media-right align-self-center">
                                                    <span class="date-send"></span>
                                               </div>
                                           </div>
                                       </a>
                                    </li>
                                @else
                                    <li class="list-group-item chat-user" chat-id="{!! $item->sender_id !!}">
                                        <a class="d-block" data-toggle="tab" href="javascript:void(0);">
                                            <div class="media">
                                                <div class="media-left align-self-center">
                                                    <img src="{!! $item->sender->avatar ?? '/assets/user/img/avatar.png' !!}" class="user-img rounded-circle" alt="...">
                                                </div>
                                                <div class="media-body align-self-center">
                                                    <h4>{!! $item->sender->name ?? $item->sender->email ?? '' !!}</h4>
                                                </div>
                                                <div class="media-right align-self-center">
                                                    <span class="date-send"></span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <!-- End List Group -->
                </div>
                <!-- End Friendslist -->
            </div>
            <!-- End Friends Sidebar -->
            <!-- Begin Messages -->
            <div class="col-xl-9 col-lg-9 col-md-12 d-flex no-padding">
                <!-- Begin Card -->
                <div class="card w-100 no-bg">
                    <!-- Begin Tab -->
                    <div class="tab-content">
                        <div class="tab-pane fade show active messages-scroll auto-scroll" style="flex: 1 1" id="msg-1">
                            <div class="card-body d-flex flex-column no-padding">
                                <div class="container-fluid chat-message">

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Tab -->
                    <!-- Begin Input Group -->
                    <div class="input-group">
                        <input type="hidden" name="chat_id" id="chat_id">
                        <input type="text" class="form-control no-ppading-right no-padding-left" id="msg" placeholder="{{ trans('admin.write_your_message...') }}">
                        <span class="input-group-btn">
                            <button class="btn" type="button" id="btn-send-chat">
                                <i class="la la-paper-plane la-2x text-primary"></i>
                            </button>
                        </span>
                    </div>
                    <!-- End Input Group -->
                </div>
                <!-- End Card -->
            </div>
            <!-- End Messages -->
        </div>
        <!-- End card -->
    </div>
@stop
@section('script')
    <script src="/assets/admin/js/app/chat/chat.min.js"></script>
    <script>chatScroll();</script>
    <script>
        $(function (){
            $('#toggle-btn').click();
            setInterval(hiddenUpdate,10000);
        })
    </script>
    <script>
        function updateView(id){
            $('input[name="chat_id"]').val(id);
            $('.chat-message').html('<div class="loader"></div>');
            $.get('/user/chat/view/'+id, function (data){
                $('.chat-message').html(data);
                $('.messages-scroll').getNiceScroll().resize();
                $('.messages-scroll').getNiceScroll(0).doScrollTop($('.messages-scroll').height(),100);
            });
        }
        function hiddenUpdate(){
            let id = $('input[name="chat_id"]').val();
            if(id != '' && id != undefined) {
                $.get('/user/chat/view/' + id, function (data) {
                    $('.chat-message').html(data);
                    $('.messages-scroll').getNiceScroll().resize();
                    $('.messages-scroll').getNiceScroll(0).doScrollTop($('.messages-scroll').height(), 100);
                });
            }
        }
        $(function (){
            $('#search-name').keyup(function (){
               let username = $(this).val();
               if(username.length >= 3){
                   $.getJSON('/user/chat/search/'+username, function (data) {
                       $('.friend-list').html('');
                       for (var item in data) {
                           let online = '';
                           if(data[item]['online'] == '1')
                               online = '<span class="online"></span>';
                           $('.friend-list').append('<li class="list-group-item chat-user" chat-id="'+ data[item]['id'] +'">\n' +
                               '                                <a class="d-block" data-toggle="tab" href="javascript:void(0);">\n' +
                               '                                    <div class="media">\n' +
                               '                                        <div class="media-left align-self-center">\n' +
                               '                                            '+online+'<img src="'+ data[item]['avatar'] +'" class="user-img rounded-circle" alt="...">\n' +
                               '                                        </div>\n' +
                               '                                        <div class="media-body align-self-center">\n' +
                               '                                            <h4>' + data[item]['name'] + '</h4>\n' +
                               '                                        </div>\n' +
                               '                                        <div class="media-right align-self-center">\n' +
                               '                                            <span class="date-send"></span>\n' +
                               '                                        </div>\n' +
                               '                                    </div>\n' +
                               '                                </a>\n' +
                               '                            </li>')

                   }});
               }
            });
        })
        $(function (){
           $('body').on('click','.chat-user', function (){
                let chatId = $(this).attr('chat-id');
                updateView(chatId);
           })
        });
        $(function (){
            $('#btn-send-chat').click(function (){
               let receiver_id  = $('#chat_id').val();
               let msg          = $('#msg').val();
               if(msg != null && msg != '' && receiver_id != null && receiver_id != ''){
                   $.post('/user/chat/send',{
                      'receiver_id' : receiver_id,
                      'msg'         : msg
                   },function (data){
                       console.log(data);
                       $('#msg').val('');
                       updateView(receiver_id);
                   });
               }
            });
        })
        $(document).on('keypress',function(e) {
            if(e.which == 13) {
                $('#btn-send-chat').click();
            }
        });
    </script>
@stop
