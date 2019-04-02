<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{!!asset('utilityOnline/css/bootstrap.min.css')!!}">
    <link rel="stylesheet" href="{!!asset('utilityOnline/css/bootstrap.css')!!}">
    <link rel="stylesheet" href="{!!asset('utilityOnline/fonts/icon/font-awesome.min.css')!!}">
    <link rel="stylesheet" href="{!!asset('utilityOnline/css/style.css')!!}">
    <link rel='stylesheet' href="{!! asset('generalStyle/plugins/select2/css/select2.min.css') !!}">
    <script src="{!! asset('masterApps/js/jquery-3.3.1.min.js') !!}"></script>
</head>
<body >
<nav class="navbar navbar-expand-lg navbar-dark bg-light bbotom">
    <a class="navbar-brand text-success" href="#">Utility Online</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon bg-success"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link text-success" href="#">Home <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link text-success" href="#">User Guide</a>
            <a class="nav-item nav-link text-success" href="#">Help</a>
        </div>
        <div class="navbar-nav ml-auto mr-5">
            <div class="dropdown">
                <a class="dropdown-toggle text-success mr-2" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Hello, {{ $username }}
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="#">Profile</a>
                    <a class="dropdown-item" href="/sentul-apps/logout">Logout</a>
                </div>
            </div>
        </div>
    </div>
</nav> 
<div class="text-white" style="background: #aef64a;">
    <span class="justify-content-end d-flex mr-3 pb-1">
        <i class="fa fa-home text-success mr-5">Utility Online</i>
    </span>
</div>
    @if ($message = Session::get('success'))
        <div class="success" data-flashdata="{{ $message }}"></div>
    @endif
    @if ($message = Session::get('failed'))
        <div class="failed" data-flashdata="{{ $message }}"></div>
    @endif
    @yield('content')

<script src="{{ asset('generalStyle/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
<script src="{!! asset('generalStyle/plugins/sweetalert/wow.min.js') !!}"></script>
<script src="{{ asset('generalStyle/js/popper.min.js') }}"></script>
<script src="{{ asset('generalStyle/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('generalStyle/plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('utilityOnline/js/particles.min.js') }}" ></script>
<script src="{{ asset('utilityOnline/js/app.js') }}"></script>

<script>
  const flashdatas = $('.failed').data('flashdata');
    if(flashdatas){
        swal({
            title: "Failed",
            text: flashdatas,
            type: "error",
        });
    }
    const flashdata = $('.success').data('flashdata');
    if(flashdata){
        swal({
            title: "Success",
            text: flashdata,
            type: "success",
        });
    }
    $('.select2').select2();
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    });
    new WOW().init();
</script>
</body>
</html>