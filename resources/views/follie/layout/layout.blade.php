<?php 
    $conn = mysqli_connect('localhost', "root", "", "master_apps");
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('judul')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <link rel="shortcut icon" type="image/png" href="images/icon/favicon.ico"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('rollie/operator/css/bootstrap.min.css')}}"> --}}
    <link rel="stylesheet" href="{!!asset('utilityOnline/css/bootstrap.min.css')!!}">
    <link rel="stylesheet" href="{{ asset('rollie/operator/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('rollie/operator/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{ asset('rollie/operator/css/metisMenu.css')}}">
    <link rel="stylesheet" href="{{ asset('rollie/operator/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('rollie/operator/css/slicknav.min.css')}}">
    <link rel="stylesheet" href="{{ asset('rollie/operator/css/typography.css')}}">
    <link rel="stylesheet" href="{{ asset('rollie/operator/css/default-css.css')}}">
    <link rel="stylesheet" href="{{ asset('rollie/operator/css/styles.css')}}">
    <link rel="stylesheet" href="{{ asset('rollie/operator/css/responsive.css')}}">
    <link rel="stylesheet" href="{{ asset('utilityOnline/admin/modules/datatables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{ asset('utilityOnline/admin/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{!! asset('generalStyle/plugins/select2/css/select2.min.css') !!}">
    
    <script src="{{ asset('utilityOnline/admin/js/jquery.min.js') }}"></script>
    <script src="{!! asset('generalStyle/js/bootstrap.min.js') !!}"></script>
    <script src="{!! asset('generalStyle/js/bootstrap.bundle.min.js') !!}"></script>
    <script src="{{ asset('rollie/js/webfont.js')}}"></script>
    <script src="{{ asset('rollie/operator/js/vendor/modernizr-2.8.3.min.js')}}"></script>
    
</head>

<body id="body-layout">
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <div class="page-container">
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="index.html"><h2><b>ROLLIE</b></h2></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="main-content">
            <div class="header-area">
                <div class="row align-items-center">
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-4 clearfix">
                        <ul class="notification-area pull-right">
                            <li>
                                <h4 class="user-name dropdown-toggle text-dark" data-toggle="dropdown">Hello, Operator<i class="fa fa-angle-down"></i></h4>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Log Out</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="breadcrumbs-area clearfix">
                            @yield('title')
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-content-inner">
                @yield('content')
            </div>
        </div>
        <footer>
            <div class="footer-area">
                <p>© Copyright 2018. All right reserved <a href="https://nutrifood.co.id">PT. Nutrifood Indonesia Plant Sentul</a>.</p>
            </div>
        </footer>
    </div>
     @if ($message = Session::get('success'))
      <div class="success" data-flashdata="{{ $message }}"></div>
    @endif
    @if ($message = Session::get('failed'))
      <div class="failed" data-flashdata="{{ $message }}"></div>
    @endif
    
    <script src="{{ asset('rollie/operator/js/vendor/jquery-2.2.4.min.js')}}"></script>
    <script src="{{ asset('rollie/operator/js/popper.min.js')}}"></script>
    <script src="{{ asset('rollie/operator/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('rollie/operator/js/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('rollie/operator/js/metisMenu.min.js')}}"></script>
    <script src="{{ asset('rollie/operator/js/jquery.slimscroll.min.js')}}"></script>
    <script src="{{ asset('rollie/operator/js/jquery.slicknav.min.js')}}"></script>
    <script src="{{ asset('rollie/operator/js/line-chart.js')}}"></script>
    <script src="{{ asset('rollie/operator/js/pie-chart.js')}}"></script>
    <script src="{{ asset('rollie/operator/js/bar-chart.js')}}"></script>
    <script src="{{ asset('rollie/operator/js/plugins.js')}}"></script>
    <script src="{{ asset('rollie/operator/js/scripts.js')}}"></script>
    <script src="{!! asset('generalStyle/plugins/select2/js/select2.min.js') !!}"></script>
    <script src="{{ asset('generalStyle/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
    <script src="{!! asset('generalStyle/plugins/sweetalert/wow.min.js') !!}"></script>
    <script src="{{ asset('utilityOnline/admin/modules/datatables/datatables.min.js')}}"></script>
    <script src="{{ asset('utilityOnline/admin/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('utilityOnline/admin/modules/datatables/Select-1.2.4/js/dataTables.select.min.js')}}"></script>
    {{-- select two , alert js --}}
    <script src="{{ asset('utilityOnline/admin/js/page/modules-datatables.js')}}"></script>
       <script>
        $('.select2').select2();
        const flashdatas = $('.failed').data('flashdata');
        if(flashdatas)
        {
            swal({
                title: "Proses Gagal",
                text: flashdatas,
                type: "error",
            });
        }
        
        const flashdata = $('.success').data('flashdata');
        if(flashdata)
        {
            swal({
                title: "Proses Berhasil",
                text: flashdata,
                type: "success",
            });
        }
        new WOW().init();
    </script>
    <script src="{{ asset('rollie/js/webfont.js')}}"></script>
    {{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> --}}
    <script src="{{ asset('generalStyle/plugins/datetime-picker/js/jquery.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('generalStyle/plugins/datetime-picker/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('generalStyle/plugins/datetime-picker/css/bootstrap-datetimepicker.min.css') }}">
    <script type="text/javascript" src="{{ asset('generalStyle/plugins/datetime-picker/js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('generalStyle/plugins/datetime-picker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('generalStyle/plugins/datetime-picker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#datatables').DataTable();
        } );
    </script>

                    
                  
</body>

</html>