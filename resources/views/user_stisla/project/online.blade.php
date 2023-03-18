@extends('user_stisla.layout.layout')
@section('title',trans('admin.online_project'))
@section('page')
    <style>
        .loader {
            border: 2px solid #f3f3f3; /* Light grey */
            border-top: 2px solid green; /* Blue */
            border-radius: 50%;
            width: 10px;
            height: 10px;
            animation: spin 1s linear infinite;
            display: block !important;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .loader1 {
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
    <div class="row">
        <div class="col-12 col-md-9">
            <div class="card has-shadow send-project-card">
                <div class="card-header bordered no-actions">{{ trans('admin.submit_project') }}</div>
                <form id="online-form" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-5">
                                <label>{{ trans('admin.title') }}</label>
                                <input type="text" class="form-control" name="title">
                            </div>
                            <div class="col-12 col-md-5">
                                <label>{{ trans('admin.category') }}</label>
                                <select name="category_id" class="form-control custom-select">
                                    @foreach(getCategory('online') as $category)
                                        <option value="{!! $category['id'] !!}" @if(getOption('online_category_id') == $category['id']) selected @endif>{!! $category['title'] ?? '' !!}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-md-2">
                                <label>{{ trans('admin.number_of_pages') }}</label>
                                <input type="number" class="form-control text-center" min="1" max="999" value="1" name="page_count">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{ trans('admin.select_a_photo_in_jpeg_or_png_format') }}</label>
                        <input type="file" name="file" id="file" accept="image/x-png,image/jpeg" class="form-control">
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="button" class="btn btn-primary btn-send-file">{{ trans('admin.send') }}</button>
                </div>
                </form>
            </div>
            <div class="card has-shadow waiting-for-contractor" style="display: none">
                <div class="card-header bordered no-actions">{{ trans('admin.waiting_for_the_host...') }}</div>
                <div class="card-body text-center">
                    <div class="loader1"></div>
                </div>
            </div>
            <div class="card has-shadow waiting-for-done" style="display: none">
                <div class="card-header bordered no-actions">
                    {{ trans('admin.waiting_for_the_project_to_be_completed...') }}
                    <span class="float-right" id="contractor_name"></span>
                </div>
                <div class="card-body text-center">

                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card has-shadow">
                <div class="card-header bordered no-actions">{{ trans('admin.calculate_the_estimated_price') }}</div>
                <div class="card-body text-center">
                    <h2 style="color: green" id="process_price">{{ number_format(getOption('online_price_per_page')) ?? '0' }}</h2>
                    <sub>{{ trans('admin.usd') }}</sub>
                </div>
                <div class="card-footer bg-danger">
                    <strong>{{ trans('admin.the_price_is_calculated_based_on_the_number_of_pages_you_advertise_and_it_is_possible_to_change_the_final_price') }}</strong>
                </div>
            </div>
            <div class="card has-shadow">
                <div class="card-body text-center" style="position: relative">
                    <div class="loader" style="position: absolute;left: 5px;top: 5px;"></div>
                    <span id="online_users" style="font-size: 2em;color: green">0</span>
                    <br>
                    <span>{{ trans('admin.online_presenters') }}</span>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script src="/assets/user/vendors/js/simple_upload/simpleUpload.min.js"></script>
    <script>
        /* Process Price */
        let pricePerPage = {{ getOption('online_price_per_page',1000) }};
        $(function (){
           $('input[name="page_count"]').on('change',function (){
                let count = $(this).val();
                if(count != undefined && count > 0){
                    $('#process_price').text(pricePerPage * count);
                }else{
                    $('#process_price').text('0');
                }
           });
        });
    </script>
    <script>
        $(function (){
            $.get('/user/online/ajax?action=count', function (count){
                $('#online_users').text(count);
            });
            setInterval(function (){
                $.get('/user/online/ajax?action=count', function (count){
                    $('#online_users').text(count);
                });
            },10000);
        });
    </script>
    <script>
        $(document).ready(function(){
            $('.btn-send-file').click(function (){
                let file = $('#file').val();
                let title = $('input[name="title"]');
                let category= $('select[name="category_id"]');
                if(title.val() == '' || title.val() == undefined){
                    return title.focus();
                }
                if(category.val() == '' || category == undefined){
                    return category.focus();
                }
                if(file == undefined || file == ''){
                    return $('#file').focus();
                }
                let data = new FormData($('#online-form')[0]);
                $(this).html('<span class="loader"></span>').attr('disabled','disabled');
                $.ajax({
                    url: '/user/project/online/ajax?action=upload',
                    type: 'POST',
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data){
                        if(data.status == true){
                            $('.send-project-card').slideUp(500, function (){
                                $('.waiting-for-contractor').slideDown(500);
                                processOnline(data.project_id);
                            });
                        }else{
                            $('.btn-send-file').removeAttr('disabled').text('{!! trans('admin.send') !!}');
                            showMsg(data.message);
                        }
                    }
                });
            })
        });
    </script>
    <script>
        function processOnline(project_id){
            let process = setInterval(function (){
                $.getJSON('/user/project/online/ajax?action=offer&id='+project_id, function (data){
                    if(data.status == true){
                        let contractor = data.contractor;
                        $('#contractor_name').text(contractor.name);
                        clearInterval(process);
                        $('.waiting-for-contractor').slideUp(500,function (){
                            $('.waiting-for-done').slideDown(500);
                        })
                    }
                });
            },5000);
        }
    </script>
@stop
