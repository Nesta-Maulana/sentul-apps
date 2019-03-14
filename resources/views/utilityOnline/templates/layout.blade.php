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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
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
                    <a class="dropdown-item" href="#">Logout</a>
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
    @yield('content')

<script src="{{ asset('masterApps/mobileStyle/js/sweetalert2.all.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
<script src="{{ asset('utilityOnline/js/particles.min.js') }}" ></script>
<script src="{{ asset('utilityOnline/js/app.js') }}"></script>
</body>
</html>