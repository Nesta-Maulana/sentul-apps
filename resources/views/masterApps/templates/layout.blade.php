<?php 
$conn = mysqli_connect('localhost', "root", "", "master_apps");
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- <link rel="stylesheet" href="{!! asset('masterApps/bower_components/bootstrap/dist/css/bootstrap.min.css') !!}"> -->
  <link rel="stylesheet" href="{!! asset('generalStyle/css/bootstrap.min.css') !!}">
  <link rel="stylesheet" href="{!! asset('masterApps/bower_components/font-awesome/css/font-awesome.min.css') !!}">
  <link rel="stylesheet" href="{!! asset('masterApps/bower_components/Ionicons/css/ionicons.min.css') !!}">
  <link rel="stylesheet" href="{!! asset('masterApps/dist/css/AdminLTE.min.css') !!}">
  <link rel="stylesheet" href="{!! asset('masterApps/dist/css/skins/skin-blue.min.css') !!}">
  <link rel="stylesheet" href="{!! asset('generalStyle/plugins/select2/css/select2.min.css') !!}">
  <link rel="stylesheet" type="text/css" href="{{ asset('masterApps/dist/css/animate.min.css') }}">
  <script src="{!! asset('masterApps/js/jquery-3.3.1.min.js') !!}"></script>
  <script src="{{ asset('generalStyle/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
  <style>
  .hidden
  {
        display:none;
  }
  </style>
    <!-- My Css -->
    <link rel="stylesheet" href="{!! asset('masterApps/css/style.css') !!}">
    <link rel="stylesheet" href="{!! asset('userAccess/css/input-style.css') !!}">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <title>@yield('title')</title>
    
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header hero">

    <!-- Logo -->
    <a href="/sentul-apps/master-apps" class="logo" style="padding-bottom: 70px;">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini mt-1"><img src="{!! asset('generalStyle/images/logo/mixpro-logo.png') !!}" width="50" height="40" alt=""></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg" style="margin-top: 10px"><img src="{!! asset('generalStyle/images/logo/mixpro-logo.png') !!}" class="mb-1" width="50" height="40" alt="">&ensp;<b>SISY</b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle hero" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-custom-menunav">
            
        </ul>
            <div class="dropdown text-white">
                Hello,
                <a class="text-white user dropdown-toggle mr-4" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     {{$username}}
                </a>
                <div class="dropdown-menu mt-4 rounded-0 p-1 bg" style="background : #3c8dbc" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item text-white drop" href="#">Edit Profile</a>
                    <a class="dropdown-item text-white drop" href="/sentul-apps/logout">Logout</a>
                </div>
            </div>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar mt-5">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{!! asset('userAccess/img/user.png') !!}" class="rounded-circle" alt="">
        </div>
        <div class="pull-left info">
          <p class="d-flex justify-content-start">{{ $username }}</p>
          <!--  Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div> 

      <!-- Sidebar Menu -->
    <ul class="sidebar-menu" data-widget="tree">
        <li class="header"><br></li>

        <!-- Optionally, you can add icons to the links -->
      <?php $idUser = Session::get('login') ?>
        
        @foreach($menus as $menu)
            <?php  
                $cekchild = "SELECT COUNT(id) from v_hak_akses WHERE parent_id='$menu->id' AND lihat = '1'";
                $cekchild = mysqli_query($conn, $cekchild);
                $cekchilds = mysqli_fetch_array($cekchild); 
                
            ?>
            @if($cekchilds[0] == 0)
                <li class="@yield('active')"><a href="{{ $menu->link }}"><i class="fa {{ $menu->icon }}"></i> <span>{{ $menu->menu }}</span></a></li>
            @else
            <li class=" treeview">
                <a href='#' class='active'><i class='fa {{ $menu->icon }}'></i> <span>{{ $menu->menu }}</span>
                        <span class='pull-right-container'>
                            <i class='fa fa-angle-left pull-right'></i>
                    </span>
                </a>
                <ul class='treeview-menu'>
                    <?php
                        $childs = mysqli_query($conn, "SELECT * from v_hak_akses WHERE parent_id='$menu->id' AND lihat='1' AND user_id='$idUser'");
                    ?>
                    
                        <?php $i=0 ?>
                        @while($c = mysqli_fetch_assoc($childs))
                            <?php $cek = mysqli_query($conn, "SELECT COUNT(id) from v_hak_akses WHERE parent_id='$c[id]' AND lihat='1'") ?>
                            <?php $cek = mysqli_fetch_array($cek) ?>
                            @if($cek[0] == 0)
                                <li class=""><a href="/sentul-apps/{{ $c['link'] }}"><i class="fa {{ $c['icon'] }}"></i> <span>{{ $c['menu'] }}</span></a></li>
                            @else
                                <li class="treeview">
                                    <a href='#' class='active'><i class="fa {{ $c['icon'] }}"></i> <span>{{ $c['menu'] }}</span>
                                            <span class='pull-right-container'>
                                                <i class='fa fa-angle-left pull-right'></i>
                                        </span>
                                    </a>
                                    <?php
                                        $sql = "SELECT * FROM v_hak_akses WHERE parent_id='$c[id]' AND lihat='1' AND user_id='$idUser'";
                                        $anak = mysqli_query($conn, $sql);
                                    ?>
                                    <ul class='treeview-menu'>
                                    
                                            @while($a = mysqli_fetch_assoc($anak))
                                                <li class=""><a href="/sentul-apps/{{ $a['link'] }}"><i class="fa {{ $a['icon'] }}"></i> <span>{{ $a['menu'] }}</span></a></li>
                                            @endwhile
                                    </ul>
                                </li>
                            @endif
                            
                        @endwhile
                </ul>
            </li>
            @endif
        @endforeach

    </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class="mt-4">
        @yield('title')
        <small>@yield('subtitle')</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li>Super Administrator</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        @if ($message = Session::get('success'))
            <div class="success" data-flashdata="{{ $message }}"></div>
        @endif
        @if ($message = Session::get('failed'))
            <div class="failed" data-flashdata="{{ $message }}"></div>
        @endif
        @yield('content')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2018 <a href="#">PT. Nutrifood Indonesia</a>.</strong> All rights reserved.
  </footer>


<!-- REQUIRED JS SCRIPTS -->
 
  <script src="{!! asset('masterApps/js/jquery-3.3.1.min.js') !!}"></script>
  <script src="{!! asset('generalStyle/js/popper.min.js') !!}"></script>
  <script src="{!! asset('generalStyle/js/bootstrap.min.js') !!}"></script>
  <script src="{!! asset('masterApps/dist/js/adminlte.min.js') !!}"></script>
  <script src="{!! asset('generalStyle/js/bootstrap.bundle.min.js') !!}"></script>
  <script src="{!! asset('generalStyle/plugins/select2/js/select2.min.js') !!}"></script>
  <script src="{!! asset('generalStyle/plugins/sweetalert/wow.min.js') !!}"></script>

  <script src="{!! asset('masterApps/js/datatable.min.js') !!}"></script>
  <link rel="stylesheet" href="{{ asset('masterApps/css/datatable.min.css') }}">
<script>
  $(document).ready(function() 
    {
      $('.basic-data-table').dataTable({
        bLengthChange:false,  
      });
        $('#table-company').DataTable({
          bFilter:false,
          bInfo:false,
          bLengthChange:false,
          pageLength:3
        });
        $('#table-satuan').DataTable({
          bFilter:false,
          bInfo:false,
          bLengthChange:false,
          pageLength:3
        });

        $('#table-produk').DataTable({
          paging: false,
          scrollY: 400,
          scrollX: true,
          bFilter:false,

        });

        $('#table-aplikasi').DataTable({
          bFilter:false,
          bInfo:false,
          bLengthChange:false,
          pageLength:3
        });

        $('#table-plan').DataTable({
          bFilter:false,
          bInfo:false,
          bLengthChange:false,
          pageLength:3
        });

    } 
  );
 
  new WOW().init();
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
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    });
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
        $('#example').tooltip();
    });
    $(function () {
        $('[data-toggles="tooltip"]').tooltip();
        $('#example').tooltip();
    });
    $('.select2').select2();
</script>
</body>
</html>