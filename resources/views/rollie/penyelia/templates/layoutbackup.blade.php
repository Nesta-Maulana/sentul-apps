<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>Dashio - Bootstrap Admin Template</title>
 
  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="{{ asset('rollie/penyelia/lib/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{!!asset('utilityOnline/css/bootstrap.min.css')!!}"> <!-- Bootstrap 4 -->
  <!--external css-->
  <link href="{{ asset('rollie/penyelia/lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="{{ asset('rollie/penyelia/css/zabuto_calendar.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('rollie/penyelia/lib/gritter/css/jquery.gritter.css')}}" />
  <!-- Custom styles for this template -->
  <link href="{{ asset('rollie/penyelia/css/style.css')}}" rel="stylesheet">
  <link href="{{ asset('rollie/penyelia/css/style-responsive.css')}}" rel="stylesheet">
  <script src="lib/chart-master/Chart.js"></script>

  <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
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
            <ul class="nav pull-right top-menu">
                <li><a class="logout" href="login.html">Logout</a></li>
            </ul>
        </div>
    </header>
    <!--header end-->
    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <aside>
        <div id="sidebar" class="nav-collapse ">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu" id="nav-accordion">
                <p class="centered"><a href="profile.html"><h2 class='text-center'>USER</h2></a></p>
                <h5 class="centered">Sam Soffes</h5>
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
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="{{ asset('rollie/penyelia/lib/jquery/jquery.min.js')}}"></script>
  <script src="{{ asset('rollie/penyelia/lib/bootstrap/js/bootstrap.min.js')}}"></script>
  <script class="include" type="text/javascript" src="{{ asset('rollie/penyelia/lib/jquery.dcjqaccordion.2.7.js')}}"></script>
  <script src="{{ asset('rollie/penyelia/lib/jquery.scrollTo.min.js')}}"></script>
  <script src="{{ asset('rollie/penyelia/lib/jquery.nicescroll.js')}}" type="text/javascript"></script>
  <script src="{{ asset('rollie/penyelia/lib/jquery.sparkline.js')}}"></script>
  <!--common script for all pages-->
  <script src="{{ asset('rollie/penyelia/lib/common-scripts.js')}}"></script>
  <script type="text/javascript" src="{{ asset('rollie/penyelia/lib/gritter/js/jquery.gritter.js')}}"></script>
  <script type="text/javascript" src="{{ asset('rollie/penyelia/lib/gritter-conf.js')}}"></script>
</body>

</html>