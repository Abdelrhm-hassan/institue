<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ trans('admin.forget_password') }} &mdash; {{ getOption('site_title') }}</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="/assets/stisla/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="/assets/stisla/css/style.css">
    <link rel="stylesheet" href="/assets/stisla/css/components.css">
</head>

<body>
<div id="app">
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    

                    <div class="card card-primary">
                        <div class="card-header"><h4>New Password</h4></div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('newPassword') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="email">{{ trans('admin.email') }}</label>
                                    <input hidden name="token" class="form-control" value="{{ $token }}" >
                                    <input id="email" class="form-control" readonly value="{{$email}}" name="email" tabindex="1" >
                                    @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                                </div>
                                <div class="form-group">
                                    <label for="email">New Password</label>
                                    <input id="email" class="form-control" value="" name="newpassword" tabindex="1" required autofocus>
                                    @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                                </div>
                                

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                        {{ trans('admin.forget_password') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="simple-footer">
                        Copyright &copy; {{ getOption('site_title') }} 2022
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- General JS Scripts -->
<script src="/assets/stisla/js/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="/assets/stisla/js/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="/assets/stisla/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="/assets/stisla/js/jquery.nicescroll.min.js"></script>
<script src="/assets/stisla/js/moment.min.js"></script>
<script src="/assets/stisla/js/stisla.js"></script>

<!-- JS Libraies -->

<!-- Template JS File -->
<script src="/assets/stisla/js/scripts.js"></script>
<script src="/assets/stisla/js/custom.js"></script>

<!-- Page Specific JS File -->
</body>
</html>
