<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ trans('admin.user_panel') }} - @yield('title')</title>
    <meta name="description" content="SeenBoard is a Web App and Admin Dashboard Template built with Bootstrap 4">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @if(getOption('site_direction','ltr') == 'rtl')
        <link rel="stylesheet" href="/assets/user/css/fontiran.css">
    @endif
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/user/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/user/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/user/img/favicon-16x16.png">
    <link rel="stylesheet" href="/assets/user/vendors/css/base/bootstrap.min.css">
    @if(getOption('site_direction','ltr') == 'rtl')
        <link rel="stylesheet" href="/assets/user/vendors/css/base/rtl.css">
    @else
        <link rel="stylesheet" href="/assets/user/vendors/css/base/ltr.css">
    @endif
    <link rel="stylesheet" href="/assets/user/css/animate/animate.min.css">
    <link rel="stylesheet" href="/assets/user/vendors/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="/assets/user/css/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/admin/vendors/raty/lib/jquery.raty.css">
    <link rel="stylesheet" href="/assets/user/css/owl-carousel/owl.theme.min.css">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="/assets/user/vendors/js/base/jquery.min.js"></script>
</head>
<body id="page-top">
<!-- Begin Preloader -->
<div id="preloader">
    <div class="canvas">
        <img src="/assets/user/img/logo.png" alt="logo" class="loader-logo">
        <div class="spinner"></div>
    </div>
</div>
<div class="page">
    <header class="header">
        <nav class="navbar fixed-top">
            <div class="navbar-holder d-flex align-items-center align-middle justify-content-between">
                <div class="navbar-header">
                    <a id="toggle-btn" href="#" class="menu-btn active">
                        <span></span>
                        <span></span>
                        <span></span>
                    </a>
                    <span @if(getOption('site_direction') == 'ltr') class="pr-5" @else class="pl-5" @endif>{{ $User->name ?? '' }}</span>
                    <span class="px-1">|</span>
                    <span>{{ trans('admin.date_of_Registration') }}: {{ getJDate($User->created_at) }}</span>
                    <span class="px-1">|</span>
                    <span>{{ trans('admin.credit_statistics') }}: <b style="color: green;">{{ number_format($User->credit) ?? 0 }}</b>&nbsp;{{ trans('admin.usd') }}</span>
                </div>
                <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center pull-right">
                    <li class="nav-item"><a title="{{ trans('admin.chat') }}" href="javascript:void(0);" data-toggle="modal" data-target="#modal_chat" class="nav-link"><i class="la la-commenting @if($Notification['chat'] > 0) animated infinite swing @endif"></i>@if($Notification['chat'] > 0)<span class="badge-pulse"></span>@endif</a></li>
                    <li class="nav-item"><a title="{{ trans('admin.subscription') }}" href="/user/account" class="nav-link"><i class="la la-user-plus" @if($section == 'account') style="color: red;" @endif></i></a>
                    <li class="nav-item dropdown"><a id="notifications" rel="nofollow" href="/user/notification" class="nav-link"><i class="la la-bell @if($Notification['notification'] > 0) animated infinite swing @endif"></i>@if($Notification['notification'] > 0)<span class="badge-pulse"></span>@endif</a></li>
                </ul>
                <!-- End Navbar Menu -->
            </div>
        </nav>
    </header>

    <div class="page-content d-flex align-items-stretch">
        <div class="default-sidebar">
            @include('user_stisla.layout.sidebar')
        </div>

        <div class="content-inner">
            <div class="container-fluid chat-layout" style="min-height: 1000px">
                @yield('page')
            </div>
            <footer class="main-footer" style="display: none;">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 d-flex align-items-center justify-content-xl-start justify-content-lg-start justify-content-md-start justify-content-center">
                        <p class="text-gradient-02"></p>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 d-flex align-items-center justify-content-xl-end justify-content-lg-end justify-content-md-end justify-content-center">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link" href="documentation.html">{{ trans('admin.documentation') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="changelog.html">{{ trans('admin.updates') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </footer>

            <a href="#" class="go-top"><i class="la la-arrow-up"></i></a>
        </div>
    </div>
    <!-- Modal -->
    <style>
        .modal-lg{
            max-width: 1000px;
        }
    </style>
    <div class="modal fade" id="modal_chat" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelTitleId">{{ trans('admin.chat') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-0">
                    <iframe src="/user/chat/iframe" scrolling="no" frameborder="0" marginwidth="0" marginheight="0" style="display:block;width: 100%;height: 550px;margin: 0;padding: 0;border-width: 0!important;"></iframe>
                </div>
            </div>
        </div>
    </div>
    @if(isset($_GET['chat']))
        <script>
            $(function (){
                $('#modal_chat').modal('show');
            })
        </script>
    @endif
    @include('user_stisla.layout.modal')
</div>
<script src="/assets/user/vendors/js/base/core.min.js"></script>
<script src="/assets/user/vendors/js/nicescroll/nicescroll.min.js"></script>
<script src="/assets/user/vendors/js/owl-carousel/owl.carousel.min.js"></script>
<script src="/assets/user/vendors/js/noty/noty.min.js"></script>
<script src="/assets/user/vendors/js/app/app.min.js"></script>
<script src="/assets/user/js/app/contact/contact.min.js"></script>
<script src="/assets/user/ckeditor/ckeditor.js"></script>
<script src="/assets/admin/vendors/raty/lib/jquery.raty.js"></script>
<script src="https://code.iconify.design/1/1.0.6/iconify.min.js"></script>
@yield('script')
<script>
    $('.ck').each( function () {
        CKEDITOR.replace( this.id );
    });
</script>
<script>
    $(document).ready(function () {
        $('.bootstrap-tagsinput input').keydown(function( event ) {
            if ( event.which == 13 ) {
                $(this).blur();
                $(this).focus();
                return false;
            }
        });
    });
</script>
<script>
    $('.delete-item').click(function (e) {
        e.stopPropagation();
        e.preventDefault();
        $('#modal-delete').modal('show');
        var url = $(this).attr('href');
        $('#modal-delete').find('a').attr('href',url);
    })
</script>
<script>
    if($('#menu-{!! $section ?? '' !!}').find('ul').length > 0)
        $('#menu-{!! $section ?? '' !!}').find('a:first').attr('aria-expanded','true');
    $('#menu-{!! $section ?? '' !!}').find('a:first').next().addClass('show');
    $.each($('#menu-{!! $section ?? '' !!}').find('a'), function () {
        if($(this).attr('href') == '{!! $url ?? '' !!}') {
            $(this).addClass('active');
        }
    });
</script>
<script>
    $(function (){
        $('[data-mode="chat"]').on('click touch', function (){
            $('#modal_chat').find('iframe').attr('src','/user/chat/iframe?user='+$(this).attr('data-user'));
            $('#modal_chat').modal('show');
        });
    })
</script>
<script>
    function showMsg(msg){
        new Noty({
            type: 'notification',
            layout: 'topLeft',
            text: msg,
            progressBar: true,
            timeout: 2500,
            animation: {
                open: 'animated bounceInLeft',
                close: 'animated bounceOutLeft'
            }
        }).show();
    }
</script>
@if(session('msg') != null && session('msg') != '')
<script>
    new Noty({
        type: 'notification',
        layout: 'topLeft',
        text: '{!! session('msg') !!}',
        progressBar: true,
        timeout: 2500,
        animation: {
            open: 'animated bounceInLeft',
            close: 'animated bounceOutLeft'
        }
    }).show()
</script>
@endif
</body>
</html>
