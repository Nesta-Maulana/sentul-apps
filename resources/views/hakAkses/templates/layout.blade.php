<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> 
    <title>@yield('judul')</title>
    <link rel="stylesheet" href="{!! asset('generalStyle/css/bootstrap.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('generalStyle/css/hakAkses.css') !!}">
    <link rel="stylesheet" href="{!! asset('masterApps/bower_components/font-awesome/css/font-awesome.min.css') !!}">
    <script src="{!! asset('masterApps/js/jquery-3.3.1.min.js') !!}"></script>
    <link rel="stylesheet" href="{!! asset('generalStyle/plugins/select2/css/select2.min.css') !!}">
    <script src="{{ asset('generalStyle/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">Sentul Apps</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto">
                    <a class="nav-item nav-link active" href="{{ route('home-aplikasi') }}">Home <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link" href="{{ route('user-guide') }}">User Guide</a>
                    <a class="nav-item nav-link @yield('active-hak-akses')" href="{{ route('halaman-help') }}">Help</a>
                    <a class="nav-item nav-link" href="{{ route('logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">@yield('slogan')</h1>
            <a href="@yield('link-to-content')" style="scroll-behaviour: smooth" class="btn btn-primary tombol go-to-request">@yield('href')</a>
        </div>
    </div>

    <div class="container">
        @yield('content')
    </div>


    <div class="footer">
        <div class="text-center">
            <p>2019 All Rights Reserved by Nutrifood.</p>
        </div>
    </div>
    @if ($message = Session::get('success'))
    <div class="success" data-flashdata="{{ $message }}"></div>
    @endif
    @if ($message = Session::get('failed'))
    <div class="failed" data-flashdatas="{{ $message }}"></div>
    @endif
    <script src="{!! asset('generalStyle/js/popper.min.js') !!}"></script>
    <script src="{!! asset('generalStyle/js/bootstrap.min.js') !!}"></script>
    <script src="{!! asset('generalStyle/js/bootstrap.bundle.min.js') !!}"></script>
    <script src="{!! asset('generalStyle/plugins/select2/js/select2.min.js') !!}"></script>
    <script src="{!! asset('generalStyle/plugins/sweetalert/wow.min.js') !!}"></script>
    <script>
        $('.select2').select2();
        $('.go-to-request').click(function() {
            var sectionTo = $(this).attr('href');
            $('html, body').animate({
            scrollTop: $(sectionTo).offset().top
        }, 1500);
        });

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