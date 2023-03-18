<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ getOption('site_title') }} - {{ trans('admin.register') }}</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="/assets/stisla/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="/assets/stisla/node_modules/bootstrap-social/bootstrap-social.css">
    <link rel="stylesheet" href="/assets/stisla/node_modules/izitoast/dist/css/iziToast.min.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="/assets/stisla/css/style.css">
    <link rel="stylesheet" href="/assets/stisla/css/components.css">
</head>

<body>
<div id="app">
    <section class="section">
        <div class="d-flex flex-wrap align-items-stretch">
            <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
                <img src="/assets/stisla/img/logo.png" style="max-width: 100%;height: auto">
                <div class="p-4 m-3">
                    <form method="POST" action="/user/register/email" class="needs-validation" novalidate="">
                        <div class="form-group">
                            <label for="email">{{ trans('admin.email') }}</label>
                            <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                            <div class="invalid-feedback">
                                {{ trans('admin.fill_empty_filed') }}
                            </div>
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right" tabindex="4">
                                {{ trans('admin.register') }}
                            </button>
                        </div>

                        <div class="py-3 text-center">
                            <a href="/user/login">{{ trans('admin.back_to_login') }}</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom" data-background="/assets/stisla/img/unsplash/login-bg.jpg">
                <div class="absolute-bottom-left index-2">
                    <div class="text-light p-5 pb-2">
                        <div class="mb-5 pb-3">
                            <h1 class="mb-2 display-4 font-weight-bold">Good Evening</h1>
                            <h5 class="font-weight-normal text-muted-transparent">Bali, Indonesia</h5>
                        </div>
                        Photo by <a class="text-light bb" target="_blank" href="https://unsplash.com/photos/a8lTjWJJgLA">Justin Kauffman</a> on <a class="text-light bb" target="_blank" href="https://unsplash.com">Unsplash</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- General JS Scripts -->
<script src="/assets/stisla/js/jquery-3.3.1.min.js"></script>
<script src="/assets/stisla/js/popper.min.js"></script>
<script src="/assets/stisla/js/bootstrap.min.js"></script>
<script src="/assets/stisla/js/jquery.nicescroll.min.js"></script>
<script src="/assets/stisla/js/moment.min.js"></script>
<script src="/assets/stisla/js/stisla.js"></script>

<!-- JS Libraies -->
<script src="/assets/stisla/node_modules/izitoast/dist/js/iziToast.min.js"></script>

<!-- Template JS File -->
<script src="/assets/stisla/js/scripts.js"></script>
<script src="/assets/stisla/js/custom.js"></script>

@if(session('msg') != null && session('msg') != '')
    <script>
        iziToast.info({
            title: 'warning',
            message: '{!! session('msg') !!}',
            position: 'bottomLeft'
        });
    </script>
@endif
<!-- Page Specific JS File -->
</body>
</html>
