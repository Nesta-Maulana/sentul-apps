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
    <link rel="stylesheet" href="{!!asset('rollie/css/style.css')!!}">
    <link rel='stylesheet' href='http://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css'>
    <script src="{!! asset('masterApps/mobileStyle/superAdmin/js/jquery-3.3.1.min.js') !!}"></script>
</head>
<body >
<nav class="navbar navbar-expand-lg navbar-dark bg" style="background: #66883f">
    <a class="navbar-brand ml-3" href="#">ROLLIE</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse ml-3" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link active" href="#">CPP</a>
            <a class="nav-item nav-link" href="#">Analisa Kimia FG</a>
            <a class="nav-item nav-link" href="#">RKJ</a>
            <a class="nav-item nav-link" href="#">Package Integrity</a>
            <a class="nav-item nav-link" href="#">Analisa Mikro</a>
            <a class="nav-item nav-link" href="#">Sortasi</a>
            <a class="nav-item nav-link" href="#">RPR</a>
            <a class="nav-item nav-link" href="#">Report</a>
            <a class="nav-item nav-link" href="#">QA</a>
        </div>
        <div class="navbar-nav ml-auto mr-5">
            <div class="dropdown">
                <a class="dropdown-toggle mr-2 text-white" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Hello, USER
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="#">Profile</a>
                    <a class="dropdown-item" href="/sentul-apps/logout">Logout</a>
                </div>
            </div>
        </div>
    </div>
</nav>
@yield('content')
 
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="{{ asset('utilityOnline/js/particles.min.js') }}" ></script>
<script src="{{ asset('utilityOnline/js/app.js') }}"></script>
<script src="{!! asset('masterApps/mobileStyle/js/wow.min.js') !!}"></script>
<script>
    $('.select2').select2();
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    });
    new WOW().init();
</script>
</body>
</html>