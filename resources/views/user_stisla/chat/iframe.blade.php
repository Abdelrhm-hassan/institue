@extends('user_stisla.chat.chat_layout')
@section('title',trans('admin.chat'))
@section('page')
    <style>
        .content-inner.active{
            width: 100% !important;
            margin-right: 0px !important;
            margin-left: 0 !important;
        }
        .header{
            display: none;
        }
        .default-sidebar{
            display: none;
        }
        .chat .card .input-group{
            bottom: -61px;
        }
        .chat #sidebar{
            background: #6877ED !important;
        }
        .chat #search-group{
            background: #6877ED !important;
        }
        .chat #search-group input{
            background: white;
            color: #0b0b0b;
        }
        .chat .friend-list .media h4{
            color: white;
        }
        .message-card a{
            color: white;
        }
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
        .chat .friend-list .list-group-item{
            padding-top: 0!important;
            padding-bottom: 10px !important;
        }
        .chat .friend-list img{
            width: 42px;
        }
        .modal-chat{

        }
        .modal-chat .modal-body{

        }
        .chat-report {
            width: 100%;
            height: auto;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            position: absolute;
            background-color: white;
            box-shadow: 0 0 3px rgba(0, 0, 0, 0.1);
            padding: 13px 15px 10px 15px;
            text-align: left;
            display: none;
            z-index: 999;
        }
        .chat-message{
            padding-top: 70px;
        }

        .sms-container{
            height: 200px;
            overflow-y: scroll;
        }
        .sms-container::-webkit-scrollbar{
            width: 4px;
            background: #E0EAF6;
        }
        .sms-container::-webkit-scrollbar-thumb{
            width: 4px;
            background: #848A90;

        }
        .send-sms{
            cursor: pointer;
            min-width: 60px !important;
        }
    </style>
    <div class="col-xl-12 p-0 chat">
        <div class="row m-0 widget no-bg" style="height: 100vh">
            <div class="col-xl-3 col-lg-3 col-md-12 p-0" id="sidebar">
                <div class="sidebar-content w-100 h-100"  style="height: 90%;">
                    <div class="input-group no-padding" id="search-group">
                        <input type="text" autocomplete="off" class="form-control border-0" placeholder="{{ trans('admin.search_username...') }}" id="search-name">
                    </div>
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
                                                    <img src="{!! $item->sender->avatar ?? '/assets/user/img/avatar.png' !!}" class="user-img rounded-circle" style="width: 36px;height: 36px;">
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
                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-12 d-flex no-padding">
                <div class="card w-100 no-bg">
                    <div class="tab-content">
                        <div class="chat-report d-flex flex-row justify-content-between">
                            <span id="chat-current-user" class="font-weight-bold">

                            </span>
                            <i class="la la-bell" id="chat_report_btn" style="color: #9c3328;font-size: 2.0em; cursor: pointer;"></i>
                        </div>
                        <div class="tab-pane fade show active messages-scroll auto-scroll" style="flex: 1 1" id="msg-1">
                            <div class="card-body d-flex flex-column no-padding">
                                <div class="container-fluid chat-message">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button class="btn" data-toggle="modal" data-target="#chat_option"  type="button">
                                <span class="iconify" style="position: relative;top: 3px;"  data-width="25" data-icon="gg:menu-grid-o" data-inline="false"></span>
                            </button>
                        </span>
                        <input type="hidden" name="chat_id" id="chat_id">
                        <input type="text" class="form-control no-ppading-right no-padding-left" id="msg" placeholder="{{ trans('admin.write_your_message...') }}">
                        <span class="input-group-btn">
                            <button class="btn" type="button" id="btn-send-chat">
                                <i class="la la-paper-plane la-2x text-primary"></i>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modal-chat" id="chat_option" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <form id="attach-file" style="display: none">
                    <input type="file" id="attach" style="display: none;">
                    </form>
                    <div class="upload_section text-center" style="cursor:pointer;border:1px solid white;background-color: #2baac1;color: white;height: 100px;">
                        <h6 style="color: white;position: relative;top: 45px;">{{ trans('admin.click_to_upload_the_file') }}</h6>
                    </div>
                    <div class="sms-container">
                        @foreach($messages as $message)
                            <div class="p-3 d-flex flex-row justify-content-between align-items-center border-bottom" >
                                <span class="pr-4">{{ $message->text ?? '' }}</span>
                                <div class="d-flex flex-column align-items-center send-sms" template-id="{{ $message->id }}">
                                    <span class="small" style="color: green">{{ smsPrice($message->text) ?? 30 }} {{ trans('admin.usd') }}</span>
                                    <span class="small" style="color: red;">{{ trans('admin.send') }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_report" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title" id="modelTitleId">{{ trans('admin.report_abuse') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>{{ trans('admin.reason_for_violation') }}</label>
                        <textarea class="form-control" id="chat_report_description" rows="6"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('admin.cancel') }}</button>
                    <button type="button" class="btn btn-primary btn-send-report">{{ trans('admin.send') }}</button>
                </div>
            </div>
        </div>
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
            $('input[name="chat_id"]').val(id).trigger('change');
            $('.chat-message').html('<div class="loader"></div>');
            $.get('/user/chat/view/'+id, function (data){
                $('.chat-message').html(data);
                $('.messages-scroll').getNiceScroll().resize();
                $('.messages-scroll').getNiceScroll(0).doScrollTop($('.messages-scroll').height(),100);
                let username = $('#username').val();
                let avatar   = $('#avatar').val();
                $('#chat-current-user').html(`<img src="${avatar}" class="rounded-circle" style="width: 36px;height: 36px;">&nbsp;${username}`);
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
                               '                                            '+online+'<img src="'+ data[item]['avatar'] +'" class="user-img rounded-circle" style="width: 36px;height: 36px;">\n' +
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
               let sms          = $('#sms').prop('checked');
               let send         = true;
               if(sms){
                   send = confirm('{{ trans('admin.send_this_message_as_a_text_message?') }}');
               }

               if(send && msg != null && msg != '' && receiver_id != null && receiver_id != ''){
                   $.post('/user/chat/send',{
                      'receiver_id' : receiver_id,
                      'msg'         : msg,
                      'sms'         : (sms)?1:0
                   },function (data){
                       $('#msg').val('');
                       updateView(receiver_id);
                   });
               }

               $('#sms').prop('checked', false);
            });
        })
        $(document).on('keypress',function(e) {
            if(e.which == 13) {
                $('#btn-send-chat').click();
            }
        });
    </script>
    <script>
        $('.upload_section').on('click', function (){
            if($('#chat_id').val() == undefined || $('#chat_id').val() == '')
                return showMsg('{{ trans('admin.select_the_chat_contact_before_selecting_the_file') }}');

            return $('#attach').click();
        });
    </script>
    <script>
        $('#attach').on('change', function (){
            let receiver_id  = $('#chat_id').val();
            let form = new FormData();
            form.append('receiver_id',receiver_id);
            form.append('attach',$('#attach').prop('files')[0]);
            if(receiver_id != null && receiver_id != ''){
                $.ajax({
                    url: '/user/chat/attach',
                    type: 'post',
                    data: form,
                    contentType: false,
                    processData: false,
                    success: function (data){
                        $('#chat_option').modal('hide');
                        if(data.status == 'error'){
                            showMsg(data.message);
                        }
                        $('#msg').val('');
                        updateView(receiver_id);
                    },
                    error:function (){

                    }
                });
            }
        });
    </script>
    <script>
        $('#chat_id').on('change',function (){
           $('.chat-report').show();
        });
    </script>
    <script>
        $(function (){
            $('#chat_report_btn').click(function (){
                $('#modal_report').modal('show');
            });
        })
    </script>
    <script>
        $(function (){
            $('.btn-send-report').on('click', function (){
                let report_id = $('#chat_id').val();
                let Report    = new FormData();
                if($('#chat_report_description').val() == '')
                    return showMsg('{{ trans('admin.please_explain_the_reason_for_the_violation') }}');
                Report.append('description',$('#chat_report_description').val());
                Report.append('reporter_id', report_id);
                $.ajax({
                    type:'post',
                    data: Report,
                    contentType: false,
                    processData: false,
                    url: '/user/chat/report',
                    success:function (data){
                        $('#modal_report').modal('hide');
                        showMsg(data.message);
                    }
                })
            });
        })
    </script>
    <script>
        $(function (){
            $('body').on('click touch','.send-sms', function (){
                let receiver_id = $('#chat_id').val();
                let template    = $(this).attr('template-id');
                if(receiver_id == undefined || receiver_id == null || receiver_id == '' || template == null)
                    return showMsg('{{ trans('admin.select_the_chat_contact_before_selecting_the_file') }}');

                $.post('/user/chat/sms',{'receiver':receiver_id,'template':template},function (data){
                    console.log(data);
                    data = JSON.parse(data);
                    if(data['status'] == 'error'){
                        return showMsg('{{ trans('admin.unknown_error_occurs') }}');
                    }
                    if(data['status'] == 'credit'){
                        return showMsg('{{ trans('admin.increase_credit') }}');
                    }
                    if(data['status'] == 'success'){
                        $('#chat_option').modal('hide');
                        return showMsg('{{ trans('admin.send_successfully') }}');
                    }
                })
            });
        })
    </script>
    @if(isset($_GET['user']) && is_numeric($_GET['user']))
        <script>
            $(function (){
                setTimeout(function (){
                    updateView({{$_GET['user']}});
                },300)
            })
        </script>
    @endif
@stop
