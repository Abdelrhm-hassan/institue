<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ trans('admin.user_panel') }} - @yield('title')</title>

    <link rel="shortcut icon" type="image" href="/assets/pink/img/fav.png" />
    <!-- General CSS Files -->
    <link rel="stylesheet" href="/assets/stisla/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="/assets/stisla/node_modules/summernote/dist/summernote-bs4.css">
    <link rel="stylesheet" href="/assets/stisla/node_modules/selectric/public/selectric.css">
    <link rel="stylesheet" href="/assets/admin/vendors/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="/assets/admin/vendors/raty/lib/jquery.raty.css">
    <link rel="stylesheet" href="/assets/stisla/node_modules/izitoast/dist/css/iziToast.min.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="/assets/stisla/css/style.css">
    <link rel="stylesheet" href="/assets/stisla/css/components.css">

    @if(getOption('site_direction','ltr') == 'rtl')
        <link rel="stylesheet" href="/assets/stisla/css/rtl.css">
    @endif

    <script src="/assets/stisla/js/jquery-3.3.1.min.js"></script>
</head>

<body>
<div id="app">
    <div class="main-wrapper">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar d-flex justify-content-between">
            <ul class="navbar-nav mr-3">
                <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            </ul>
            <ul class="navbar-nav navbar-right d-flex align-items-center justify-content-end">
                <li><a title="{{ trans('admin.chat') }}" href="javascript:void(0);" data-toggle="modal" data-target="#modal_chat" class="nav-link nav-link-lg"><i class="fas fa-comment @if($Notification['chat'] > 0) beep @endif"></i>@if($Notification['chat'] > 0)<span class="badge-pulse"></span>@endif</a></li>
                <li><a title="{{ trans('admin.subscription') }}" href="/user/account" class="nav-link nav-link-lg"><i class="fas fa-user-plus" @if($section == 'account') style="color: gold;" @endif></i></a>
                    <li><a href="/user/notification/list" class="nav-link nav-link-lg @if(isset($notifications) && count($notifications) > 0) beep @endif"><i class="far fa-bell"></i></a></li>
                </ul>
        </nav>
        <div class="main-sidebar">
            <aside id="sidebar-wrapper">
                @include('user_stisla.layout.sidebar')
            </aside>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            @yield('page')
        </div>
    </div>
</div>

@include('user_stisla.layout.modal')

<!-- General JS Scripts -->
<script src="/assets/stisla/js/popper.min.js"></script>
<script src="/assets/stisla/js/bootstrap.min.js"></script>
<script src="/assets/stisla/js/jquery.nicescroll.min.js"></script>
<script src="/assets/stisla/js/moment.min.js"></script>
<script src="/assets/stisla/js/stisla.js"></script>

<!-- JS Libraies -->
<script src="https://code.iconify.design/2/2.1.2/iconify.min.js"></script>
<script src="/assets/stisla/node_modules/selectric/public/jquery.selectric.min.js"></script>
<script src="/assets/stisla/node_modules/summernote/dist/summernote-bs4.js"></script>
<script src="/assets/admin/vendors/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="/assets/stisla/node_modules/izitoast/dist/js/iziToast.min.js"></script>
<script src="/assets/admin/vendors/raty/lib/jquery.raty.js"></script>

<!-- Template JS File -->
<script src="/assets/stisla/js/scripts.js"></script>
<script src="/assets/stisla/js/custom.js"></script>

@yield('script')

<script>
    $('.delete-item').click(function (e) {
        e.stopPropagation();
        e.preventDefault();
        $('#modal-delete').modal('show');
        let url = $(this).attr('href');
        $('#modal-delete').find('a').attr('href',url);
    })
</script>
<script>
    $('.confirm-item').click(function (e) {
        e.stopPropagation();
        e.preventDefault();
        $('#modal-confirm').modal('show');
        let url = $(this).attr('href');
        $('#modal-confirm').find('a').attr('href',url);
    })
</script>
<script>
    if($('#menu-{!! $section ?? '' !!}').find('ul').length > 0) {
        $('#menu-{!! $section ?? '' !!}').find('a:first').attr('aria-expanded', 'true');
        $('#menu-{!! $section ?? '' !!}').addClass('active');
    }
    $.each($('#menu-{!! $section ?? '' !!}').find('a'), function () {
        if($(this).attr('href') == '{!! $url ?? '' !!}') {
            $(this).parent().addClass('active');
        }
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
    $('.count-animate').each(function () {
        var $this = $(this);
        jQuery({ Counter: 0 }).animate({ Counter: $this.text() }, {
            duration: 4000,
            easing: 'swing',
            step: function () {
                $this.text(Math.ceil(this.Counter));
            }
        });
    });
</script>
<script>
    function showMsg(msg){
        iziToast.info({
            title: 'warning',
            message: msg,
            position: 'bottomLeft'
        });
    }
</script>
@if(session('msg') != null && session('msg') != '')
    @if(session('msg') != null && session('msg') != '')
        <script>
            iziToast.info({
                title: '',
                message: '{!! session('msg') !!}',
                position: 'bottomLeft'
            });
        </script>
    @endif
@endif
<script>
    $(function (){
        $('[data-mode="chat"]').on('click touch', function (){
            $('#modal_chat').find('iframe').attr('src','/user/chat/iframe?user='+$(this).attr('data-user'));
            $('#modal_chat').modal('show');
        });
    })
</script>

<!-- Page Specific JS File -->
</body>
</html>
