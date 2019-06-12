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
                    <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link" href="#">User Guide</a>
                    <a class="nav-item nav-link @yield('active-hak-akses')" href="#">Help</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Akhir Navbar -->

    <!-- Jumbotron -->
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">@yield('slogan')</h1>
            <a href="@yield('link-to-content')" style="scroll-behaviour: smooth" class="btn btn-primary tombol go-to-request">Request</a>
        </div>
    </div>
    <!-- Akhir Jumbotron -->


    <!-- Container -->
    <div class="container">
        <!-- Info Panel -->
        <div class="row justify-content-center">
            <div class="col-10 info-panel">
                <div class="row">
                    <div class="col-lg">
                        <img src="{{ asset('generalStyle/images/logo/employee.png')}}" alt="Employee" class="float-left">
                        <h4>24 Hours</h4>
                        <p>Lorem ipsum dolor sit amet.</p>
                    </div>
                    <div class="col-lg">
                        <img src="{{ asset('generalStyle/images/logo/hires.png')}}" alt="Hires" class="float-left">
                        <h4>Fastest</h4>
                        <p>Lorem ipsum dolor sit amet.</p>
                    </div>
                    <div class="col-lg">
                        <img src="{{ asset('generalStyle/images/logo/security.png')}}" alt="Security" class="float-left">
                        <h4>Security</h4>
                        <p>Lorem ipsum dolor sit amet.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Akhir Info Panel -->

        @yield('content')

        <!-- Testimonial -->
        <section class="testimonial">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h5>"Inspiring a Nutrious Life"</h5>
                </div>
            </div>
        </section>
        <!-- Akhir Testimonial -->

        <!-- Footer -->
        <div class="row footer">
            <div class="col text-center">
                <p>2019 All Rights Reserved by Nutrifood.</p>
            </div>
        </div>
        <!-- Akhir Footer -->

        <!-- Akhir Container -->
    </div>
    <script src="{!! asset('generalStyle/js/popper.min.js') !!}"></script>
    <script src="{!! asset('generalStyle/js/bootstrap.min.js') !!}"></script>
    <script src="{!! asset('generalStyle/js/bootstrap.bundle.min.js') !!}"></script>
    <script src="{!! asset('generalStyle/plugins/select2/js/select2.min.js') !!}"></script>
    <script src="{!! asset('generalStyle/plugins/sweetalert/wow.min.js') !!}"></script>
    <script>
        $('.go-to-request').click(function() {
            var sectionTo = $(this).attr('href');
            $('html, body').animate({
            scrollTop: $(sectionTo).offset().top
        }, 1500);
        });
    </script>
</body>

</html>