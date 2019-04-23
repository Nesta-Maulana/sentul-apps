<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
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
    <script src="{{ asset('utilityOnline/admin/js/jquery.min.js') }}"></script>
    <!-- modernizr css -->
    <script src="{{ asset('rollie/operator/js/vendor/modernizr-2.8.3.min.js')}}"></script>
</head>

<body>
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
                            <li class="active">
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>dashboard</span></a>
                                <ul class="collapse">
                                    <li><a href="index.html">ICO dashboard</a></li>
                                    <li><a href="index2.html">Ecommerce dashboard</a></li>
                                    <li class="active"><a href="index3.html">SEO dashboard</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-align-left"></i> <span>Multi
                                        level menu</span></a>
                                <ul class="collapse">
                                    <li><a href="#">Item level (1)</a></li>
                                    <li><a href="#">Item level (1)</a></li>
                                    <li><a href="#" aria-expanded="true">Item level (1)</a>
                                        <ul class="collapse">
                                            <li><a href="#">Item level (2)</a></li>
                                            <li><a href="#">Item level (2)</a></li>
                                            <li><a href="#">Item level (2)</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Item level (1)</a></li>
                                </ul>
                            </li>
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
                                <h4 class="user-name dropdown-toggle text-dark" data-toggle="dropdown">Hello, Administrator<i class="fa fa-angle-down"></i></h4>
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
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">@yield('title')</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                    </div>
                </div>
            </div>
            <div class="main-content-inner">
                @yield('content')
            </div>
        </div>
        <footer>
            <div class="footer-area">
                <p>© Copyright 2018. All right reserved. Template by <a href="https://colorlib.com/wp/">Colorlib</a>.</p>
            </div>
        </footer>
    </div>
    <script src="{{ asset('rollie/operator/js/vendor/jquery-2.2.4.min.js')}}"></script>
    <script src="{{ asset('rollie/operator/js/popper.min.js')}}"></script>
    <script src="{{ asset('rollie/operator/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('rollie/operator/js/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('rollie/operator/js/metisMenu.min.js')}}"></script>
    <script src="{{ asset('rollie/operator/js/jquery.slimscroll.min.js')}}"></script>
    <script src="{{ asset('rollie/operator/js/jquery.slicknav.min.js')}}"></script>
    <script src="{{ asset('utilityOnline/admin/modules/datatables/datatables.min.js')}}"></script>
    <script src="{{ asset('utilityOnline/admin/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('utilityOnline/admin/modules/datatables/Select-1.2.4/js/dataTables.select.min.js')}}"></script>
    <script src="{{ asset('rollie/operator/js/line-chart.js')}}"></script>
    <script src="{{ asset('rollie/operator/js/pie-chart.js')}}"></script>
    <script src="{{ asset('rollie/operator/js/bar-chart.js')}}"></script>
    <script src="{{ asset('rollie/operator/js/plugins.js')}}"></script>
    <script src="{{ asset('rollie/operator/js/scripts.js')}}"></script>
    <script>
        $('#data-tables').dataTable({
                "columnDefs": [
                    { "sortable": false, "targets": [5] }
                ]
        });
        $('#table-jadwal').dataTable({
            "columnDefs": [
                { "sortable": false, "targets": [5] }
            ],
             bFilter:false,
            bInfo:false,
            bLengthChange:false,
            pageLength:10,
            scrollY: 400,
            scrollX: true,
        });
    </script>
</body>

</html>
