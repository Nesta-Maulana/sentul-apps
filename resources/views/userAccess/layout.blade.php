<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('judul')</title>
    <link rel="stylesheet" href="{!!asset('generalStyle/css/bootstrap.min.css')!!}">
    <link rel="stylesheet" href="{!!asset('userAccess/css/style.css')!!}">
    <link rel="stylesheet" href="{!!asset('generalStyle/fonts/icon/font-awesome.min.css')!!}">
    <script src="{!! asset('userAccess/js/js-slim.min.js') !!}"></script>
    <!-- <link rel="stylesheet" href="{!! asset('generalStyle/css/hakAkses.css') !!}"> -->
    <link rel="stylesheet" href="{!! asset('masterApps/bower_components/font-awesome/css/font-awesome.min.css') !!}">
    <script src="{!! asset('masterApps/js/jquery-3.3.1.min.js') !!}"></script>

</head>

<style>
    @media only screen and (max-width){
        .navbar{
            margin-top: -5%;
        }
    }
</style>

<body class="jumbotron">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand home-logo" href="#">Sentul Apps</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto">
                    <a class="nav-item nav-link active" href="#">Home</a>
                    <a class="nav-item nav-link" href="#">User Guide</a>
                    <a class="nav-item nav-link" href="#">Help</a>
                    <a class="nav-item nav-link" href="/sentul-apps/logout">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    @yield('content')

    @if ($message = Session::get('success'))
    <div class="success" data-flashdata="{{ $message }}"></div>
    @endif
    @if ($message = Session::get('error'))
    <div class="failed" data-flashdatas="{{ $message }}"></div>
    @endif
    <script src="{!! asset('generalStyle/js/popper.min.js') !!}"></script>
    <script src="{!!asset('generalStyle/js/bootstrap.min.js')!!}"></script>
    <script src="{{ asset('generalStyle/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
    <script>
        const flashdatas = $('.failed').data('flashdatas');
        const flashdata = $('.success').data('flashdata');
        if (flashdatas) {
            swal({
                title: "Failed",
                text: flashdatas,
                type: "error",
            });
        }
        if (flashdata) {
            swal({
                title: "Success",
                text: flashdata,
                type: "success",
            });
        }
    </script>
</body>

</html>