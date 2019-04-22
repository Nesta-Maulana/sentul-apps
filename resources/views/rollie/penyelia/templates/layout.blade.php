<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <title>@yield('title')</title>

    <!-- Favicons -->
    <link href="img/favicon.png" rel="icon">
    <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{!!asset('utilityOnline/css/bootstrap.min.css')!!}">
    <!-- Bootstrap 4 -->
    <!--external css-->
    <link href="{{ asset('rollie/penyelia/lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('rollie/penyelia/css/zabuto_calendar.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('rollie/penyelia/lib/gritter/css/jquery.gritter.css')}}" />
    <!-- Custom styles for this template -->
    <link href="{{ asset('rollie/penyelia/css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('rollie/penyelia/css/style-responsive.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('utilityOnline/admin/modules/datatables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{ asset('utilityOnline/admin/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
    <script src="{{ asset('utilityOnline/admin/js/jquery.min.js') }}"></script>
    <script src="{!! asset('generalStyle/js/bootstrap.min.js') !!}"></script>
    <script src="{!! asset('generalStyle/js/bootstrap.bundle.min.js') !!}"></script>

</head>

<body>
    <section id="container">
        <!--header start-->
        <header class="header black-bg">
            <div class="sidebar-toggle-box">
                <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
            </div>
            <!--logo start-->
            <a href="index.html" class="logo"><b>RO<span>LL</span>IE</b></a>
            <!--logo end-->
            <div class="top-menu">
                <ul class="nav pull-right top-menu mt-4">
                    <li><a class="logout" href="login.html">Logout</a></li>
                </ul>
            </div>
        </header>
        <aside>
            <div id="sidebar" class="nav-collapse ">
                <ul class="sidebar-menu" id="nav-accordion">
                    <h5 class="centered">Sam Soffes</h5>
                    <p class="centered">Role</p>
                    <li class="mt">
                        <a class="active" href="index.html">
                            <i class="fa fa-dashboard"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-desktop"></i>
                            <span>UI Elements</span>
                        </a>
                        <ul class="sub">
                            <li><a href="general.html">General</a></li>
                            <li><a href="buttons.html">Buttons</a></li>
                            <li><a href="panels.html">Panels</a></li>
                            <li><a href="font_awesome.html">Font Awesome</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </aside>
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">

                @yield('content')

            </section>
        </section>

        <footer class="site-footer">
            <div class="text-center">
                <p>
                    &copy; Copyrights <strong>Dashio</strong>. All Rights Reserved
                </p>
                <div class="credits">
                    <!--
                    You are NOT allowed to delete the credit link to TemplateMag with free version.
                    You can delete the credit link only if you bought the pro version.
                    Buy the pro version with working PHP/AJAX contact form: https://templatemag.com/dashio-bootstrap-admin-template/
                    Licensing information: https://templatemag.com/license/
                -->
                    Created with Dashio template by <a href="https://templatemag.com/">TemplateMag</a>
                </div>
            </div>
        </footer>
        <!--footer end-->
    </section>
    <!-- DataTables -->
    <script src="{{ asset('utilityOnline/admin/modules/datatables/datatables.min.js')}}"></script>
    <script src="{{ asset('utilityOnline/admin/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('utilityOnline/admin/modules/datatables/Select-1.2.4/js/dataTables.select.min.js')}}"></script>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="{{ asset('rollie/penyelia/lib/bootstrap/js/bootstrap.min.js')}}"></script>
    <script class="include" type="text/javascript" src="{{ asset('rollie/penyelia/lib/jquery.dcjqaccordion.2.7.js')}}"></script>
    <script src="{{ asset('rollie/penyelia/lib/jquery.scrollTo.min.js')}}"></script>
    <script src="{{ asset('rollie/penyelia/lib/jquery.nicescroll.js')}}" type="text/javascript"></script>
    <script src="{{ asset('rollie/penyelia/lib/jquery.sparkline.js')}}"></script>

    <!--common script for all pages-->
    <script src="{{ asset('rollie/penyelia/lib/common-scripts.js')}}"></script>
    <script type="text/javascript" src="{{ asset('rollie/penyelia/lib/gritter/js/jquery.gritter.js')}}"></script>
    <script type="text/javascript" src="{{ asset('rollie/penyelia/lib/gritter-conf.js')}}"></script>

    <!-- My JS -->
    <script src="{!! asset('generalStyle/js/popper.min.js') !!}"></script>
    <script src="{!! asset('generalStyle/plugins/select2/js/select2.min.js') !!}"></script>
    <script src="{{ asset('generalStyle/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
    <script src="{!! asset('generalStyle/plugins/sweetalert/wow.min.js') !!}"></script>

    <script>
        var oTable = $('#data-tables-wo').dataTable({
            "columnDefs": [{
                "sortable": false,
                "targets": [5]
            }]
        });
        $('#data-tables').dataTable({});

        $('#myModal').on('shown.bs.modal', function() {
            $('#myInput').trigger('focus')
        })
    </script>
</body>

</html>