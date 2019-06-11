<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('goOffice/img/Fevicon.png')}}" type="image/png">

    <link rel="stylesheet" href="{{ asset('goOffice/vendors/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('goOffice/vendors/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('goOffice/vendors/themify-icons/themify-icons.css')}}">
    <link rel="stylesheet" href="{{ asset('goOffice/vendors/linericon/style.css')}}">
    <link rel="stylesheet" href="{{ asset('goOffice/vendors/owl-carousel/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{ asset('goOffice/vendors/owl-carousel/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('goOffice/vendors/flat-icon/font/flaticon.css')}}">
    <link rel="stylesheet" href="{{ asset('goOffice/vendors/nice-select/nice-select.css')}}">

    <link rel="stylesheet" href="{{ asset('goOffice/css/style.css')}}">
</head>

<body class="bg-shape">

    <!--================ Header Menu Area start =================-->
    <header class="header_area">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container box_1620">
                    <a class="navbar-brand logo_h" href="index.html" style="text-shadow: 1px 1px 1px black"><h1> <span style="color: #fff">GO</span> OFFICE</h1></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav justify-content-end">
                            <li class="nav-item active"><a class="nav-link" href="index.html">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
                            <li class="nav-item"><a class="nav-link" href="package.html">Packages</a>
                            <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false">Pages</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="amentities.html">Amentities</a>
                                </ul>
                            </li>

                            <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false">Blog</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="blog.html">Blog Single</a></li>
                                    <li class="nav-item"><a class="nav-link" href="blog-details.html">Blog Details</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
                        </ul>
     
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!--================Header Menu Area =================-->



    <!--================Hero Banner Area Start =================-->
    <section class="hero-banner magic-ball">
        <div class="container">

            <div class="row align-items-center text-center text-md-left">
                <div class="col-lg-12 mb-5">
                    <h1>Go Office</h1>
                    <p>Go Office is a system that connects all data of PT. Nutrifood Indonesia which was developed by <span class="font-weight-bold" style="color:lg-1276ff">Nesta Maulana</span> and his team.</p>
                </div>
                <div class="col-lg-12">
                    <img class="img-responsive" src="{{ asset('goOffice/img/home/hero-img.png')}}" alt="">
                </div>
            </div>
        </div>
    </section>
    <!--================Hero Banner Area End =================-->

    <!-- ================ start footer Area ================= -->
    <footer class="footer-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3  col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>About Agency</h6>
                        <p>

                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>Navigation Links</h6>
                        <div class="row">
                            <div class="col">
                                <ul>
                                    <li><a href="#"></a></li>
                                </ul>
                            </div>
                            <div class="col">
                                <ul>
                                    <li><a href="#"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3  col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>Newsletter</h6>
                        <p>

                        </p>
                    </div>
                </div>
                <div class="col-lg-3  col-md-6 col-sm-6">
                    <div class="single-footer-widget mail-chimp">
                        <h6 class="mb-20">InstaFeed</h6>
                        <ul class="instafeed d-flex flex-wrap">
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="row align-items-center">
                    <p class="col-lg-8 col-sm-12 footer-text m-0 text-center text-lg-left">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | This template is made with <i class="fa fa-heart"
                            aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                    <div class="col-lg-4 col-sm-12 footer-social text-center text-lg-right">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-dribbble"></i></a>
                        <a href="#"><i class="fab fa-behance"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ================ End footer Area ================= -->




    <script src="{{ asset('goOffice/vendors/jquery/jquery-3.2.1.min.js')}}"></script>
    <script src="{{ asset('goOffice/vendors/bootstrap/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('goOffice/vendors/owl-carousel/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('goOffice/vendors/nice-select/jquery.nice-select.min.js')}}"></script>
    <script src="{{ asset('goOffice/js/jquery.ajaxchimp.min.js')}}"></script>
    <script src="{{ asset('goOffice/js/mail-script.js')}}"></script>
    <script src="{{ asset('goOffice/js/skrollr.min.js')}}"></script>
    <script src="{{ asset('goOffice/js/main.js')}}"></script>
</body>

</html>