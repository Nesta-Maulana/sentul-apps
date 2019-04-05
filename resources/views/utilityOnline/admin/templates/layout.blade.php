<?php 
$conn = mysqli_connect('localhost', "root", "", "master_apps");

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>@yield('title')</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('utilityOnline/admin/modules/bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{ asset('utilityOnline/admin/modules/fontawesome/css/all.min.css')}}">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('utilityOnline/admin/modules/jqvmap/dist/jqvmap.min.css')}}">
  <link rel="stylesheet" href="{{ asset('utilityOnline/admin/modules/weather-icon/css/weather-icons.min.css')}}">
  <link rel="stylesheet" href="{{ asset('utilityOnline/admin/modules/weather-icon/css/weather-icons-wind.min.css')}}">
  <link rel="stylesheet" href="{{ asset('utilityOnline/admin/modules/summernote/summernote-bs4.css')}}">
  <link rel="stylesheet" href="{{ asset('utilityOnline/admin/modules/datatables/datatables.min.css')}}">
  <link rel="stylesheet" href="{{ asset('utilityOnline/admin/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('utilityOnline/admin/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css')}}">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('utilityOnline/admin/css/style.css')}}">
  <link rel="stylesheet" href="{{ asset('utilityOnline/admin/css/components.css')}}">
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
          <div class="search-element">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
            <div class="search-backdrop"></div>
          </div>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
                <div class="dropdown-menu dropdown-list dropdown-menu-right">
                    <div class="dropdown-header">Notifications
                        <div class="float-right">
                            <a href="#">Mark All As Read</a>
                        </div>
                    </div>
                    <div class="dropdown-list-content dropdown-list-icons">
                        <a href="#" class="dropdown-item dropdown-item-unread">
                            <div class="dropdown-item-icon bg-primary text-white">
                                <i class="fas fa-code"></i>
                            </div>
                            <div class="dropdown-item-desc">
                                Template update is available now!
                                <div class="time text-primary">2 Min Ago</div>
                            </div>
                        </a>
                    </div>
                    <div class="dropdown-footer text-center">
                        <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </li>
            <li class="dropdown">
                <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    <div class="d-sm-none d-lg-inline-block">Hi, {{$username}}</div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-title">Kamu login sebagai QC Controller</div>
                    <a href="features-profile.html" class="dropdown-item has-icon">
                        <i class="far fa-user"></i> Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item has-icon text-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </li>
        </ul>
      </nav>
    <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
                <a href="dashboard-ecommerce.html">Stisla</a>
            </div>
            <div class="sidebar-brand sidebar-brand-sm">
                <a href="dashboard-ecommerce.html">St</a>
            </div>
            <ul class="sidebar-menu">

                <li class="menu-header">Main</li>
                    <li class="dropdown">
                        <a href="#" class="nav-link" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Reports</span></a>                        
                    </li>
                <li class="menu-header">Menu</li>
                <?php $idUser = Session::get('login') ?>
                @foreach($menus as $menu)
                    <?php  
                        $cekchild = "SELECT COUNT(id) from v_hak_akses WHERE parent_id='$menu->id' AND lihat = '1'";
                        $cekchild = mysqli_query($conn, $cekchild);
                        $cekchilds = mysqli_fetch_array($cekchild); 

                    ?>
                    @if($cekchilds[0] == 0)
                    <li class="dropdown">
                        <a href="{{ $menu->link }}" class="nav-link"><i class="fa {{ $menu->icon }}"></i> <span>{{$menu->menu}}</span></a>
                    </li>
                    @else
                    <li class="dropdown">
                        <a href='#' class="nav-link has-dropdown" data-toggle="dropdown"><i class='fa {{ $menu->icon }}'></i> <span>{{ $menu->menu }}</span></a>
                        <ul class='dropdown-menu'>
                            <?php
                                $childs = mysqli_query($conn, "SELECT * from v_hak_akses WHERE parent_id='$menu->id' AND lihat='1' AND user_id='$idUser'");
                            ?>
                            <?php $i=0 ?>
                            @while($c = mysqli_fetch_assoc($childs))
                                <?php $cek = mysqli_query($conn, "SELECT COUNT(id) from v_hak_akses WHERE parent_id='$c[id]' AND lihat='1'") ?>
                                <?php $cek = mysqli_fetch_array($cek) ?>
                                @if($cek[0] == 0)
                                <li class="dropdown">
                                    <a class="nav-link" href="/sentul-apps/master-apps/{{ $c['link'] }}"><i class="fa {{ $c['icon'] }}"></i> <span>{{ $c['menu'] }}</span></a>
                                </li>
                                @else
                                    <li class=" ">
                                        <a href='#' class='nav-link has-dropdown' data-toggle="dropdown"><i class="fa {{ $c['icon'] }}"></i> <span>{{ $c['menu'] }}</span></a>
                                        <?php
                                            $sql = "SELECT * FROM v_hak_akses WHERE parent_id='$c[id]' AND lihat='1' AND user_id='$idUser'";
                                            $anak = mysqli_query($conn, $sql);
                                        ?>
                                        <ul class='dropdown-menu'>
                                        
                                                @while($a = mysqli_fetch_assoc($anak))
                                                    <li class="nav-link"><a href="/sentul-apps/master-apps/{{ $a['link'] }}"><i class="fa {{ $a['icon'] }}"></i> <span>{{ $a['menu'] }}</span></a></li>
                                                @endwhile
                                        </ul>
                                    </li>
                                @endif
                            @endwhile
                        </ul>
                    @endif
                @endforeach
            </ul>
        </aside>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
        <!--<div class="section-header">
        <h1>Dashboard</h1>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                    <h4>Total Admin</h4>
                    </div>
                    <div class="card-body">
                    10
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                    <h4>News</h4>
                    </div>
                    <div class="card-body">
                    42
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                    <h4>Reports</h4>
                    </div>
                    <div class="card-body">
                    1,201
                    </div>
                </div>
                </div>
            </div>
        </div>-->
    
        @if ($message = Session::get('success'))
            <div class="success" data-flashdata="{{ $message }}"></div>
        @endif
        @if ($message = Session::get('failed'))
            <div class="failed" data-flashdata="{{ $message }}"></div>
        @endif
        @yield('content')
        </section>
    </div>
      <footer class="main-footer">
        <div class="footer-left">
          Copyright PT.Nutrifood &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
        </div>
        <div class="footer-right">
          v1.0.0
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="{{ asset('utilityOnline/admin/js/jquery.min.js') }}"></script>
  <script src="{{ asset('utilityOnline/admin/js/popper.js')}}"></script>
  <script src="{{ asset('utilityOnline/admin/js/tooltip.js')}}"></script>
  <script src="{{ asset('utilityOnline/admin/modules/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{ asset('utilityOnline/admin/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
  <script src="{{ asset('utilityOnline/admin/js/moment.min.js')}}"></script>
  <script src="{{ asset('utilityOnline/admin/js/stisla.js')}}"></script>
  
  <!-- JS Libraies -->
  <script src="{{ asset('utilityOnline/admin/modules/simple-weather/jquery.simpleWeather.min.js')}}"></script>
  <script src="{{ asset('utilityOnline/admin/js/chart.min.js')}}"></script>
  <script src="{{ asset('utilityOnline/admin/modules/jqvmap/dist/jquery.vmap.min.js')}}"></script>
  <script src="{{ asset('utilityOnline/admin/modules/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
  <script src="{{ asset('utilityOnline/admin/modules/summernote/summernote-bs4.js')}}"></script>
  <script src="{{ asset('utilityOnline/admin/modules/chocolat/dist/js/jquery.chocolat.min.js')}}"></script>

  <!-- Page Specific JS File -->
  <script src="{{ asset('utilityOnline/admin/js/page/dashboard-general.js')}}"></script>
  
    <!-- Template JS File -->
  <script src="{{ asset('utilityOnline/admin/js/scripts.js')}}"></script>
  <script src="{{ asset('utilityOnline/admin/js/custom.js')}}"></script>
  <script src="{{ asset('generalStyle/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
    <!-- JS Libraies -->
  <script src="{{ asset('utilityOnline/admin/modules/datatables/datatables.min.js')}}"></script>
  <script src="{{ asset('utilityOnline/admin/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{ asset('utilityOnline/admin/modules/datatables/Select-1.2.4/js/dataTables.select.min.js')}}"></script>
  <script src="{{ asset('utilityOnline/admin/modules/jquery-ui/jquery-ui.min.js')}}"></script>

  <!-- Page Specific JS File -->
  <script src="{{ asset('utilityOnline/admin/js/page/modules-datatables.js')}}"></script>
  <script>
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
  </script>
</body>
</html>