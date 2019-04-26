<?php 
    $conn = mysqli_connect('localhost', "root", "", "master_apps");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <title>@yield('title')</title>
    <link href="{{ asset('userAccess/img/factory.png') }}" rel="icon">
    <link href="img/apple-touch-icon.png" rel="apple-touch-icon">
    <link rel="stylesheet" href="{!!asset('utilityOnline/css/bootstrap.min.css')!!}">
    <link rel="stylesheet" href="{!!asset('utilityOnline/css/bootstrap.css')!!}">
    <link href="{{ asset('rollie/penyelia/lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('rollie/penyelia/css/zabuto_calendar.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('rollie/penyelia/lib/gritter/css/jquery.gritter.css')}}" />
    <script src="{{ asset('utilityOnline/admin/js/jquery.min.js') }}"></script>
    <script src="{!! asset('generalStyle/js/bootstrap.min.js') !!}"></script>
    <script src="{!! asset('generalStyle/js/bootstrap.bundle.min.js') !!}"></script>
    <link rel="stylesheet" href="{{ asset('utilityOnline/admin/modules/datatables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{ asset('utilityOnline/admin/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
    <link href="{{ asset('rollie/penyelia/css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('rollie/penyelia/css/style-responsive.css')}}" rel="stylesheet">

</head>

<body>
    <section id="container">
        <!--header start-->
        <header class="header black-bg">
            <div class="sidebar-toggle-box">
                <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
            </div>
            <a href="index.html" class="logo"><b>RO<span>LL</span>IE</b></a>
            <div class="top-menu">
                <!-- <ul class="nav pull-right top-menu mt-4">
                    <li><a class="logout" href="login.html">Logout</a></li>
                </ul> -->
            </div>
        </header>
        <aside>
            <div id="sidebar" class="nav-collapse ">
                <ul class="sidebar-menu" id="nav-accordion">
                    <hr>
                    <p class="centered">
                        <a href=""><img src="{{ asset('userAccess/img/user.png') }}" class="img-circle" style="border-radius: 50%;" width="80"></a>
                    </p>
                    <h6 class="centered text-white" >Hello , {{ $username->fullname }}</h6>
                    <p class="centered text-white">You're Logged As {{ $username->user->role->role }}</p>
                    <p class="centered " style="margin-top: -15px;">
                        <a href="" class="text-gray-dark">Logout</a>
                    </p>
                    <hr>
                    <li class="mt">
                        <a class="@yield('active-dashboard')" href="index.html">
                            <i class="fa fa-dashboard"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <?php $idUser = Session::get('login') ?>
                    @foreach ($menus as $menu)
                        <?php  
                            $cekchild = "SELECT COUNT(id) from v_hak_akses WHERE parent_id='$menu->id' AND lihat = '1'";
                            $cekchild = mysqli_query($conn, $cekchild);
                            $cekchilds = mysqli_fetch_array($cekchild); 
                        ?>
                        @if ($cekchilds[0] == 0)
                            <li>
                                <a class="<?php if(Request::Route()->uri() == $menu->link){echo "active";} ?>" href="{{ $menu->link }}">
                                    <i class="fa {{ $menu->icon }}"></i>
                                    <span>{{ $menu->menu }}</span>
                                </a>
                            </li>
                        @else
                            
                            <li class="sub-menu">
                                <a href="javascript:;">
                                    <i class="fa {{ $menu->icon }}"></i>
                                    <span>{{ $menu->menu }}</span>
                                </a>
                                <ul class="sub">
                                    <?php
                                        $childs = mysqli_query($conn, "SELECT * from v_hak_akses WHERE parent_id='$menu->id' AND lihat='1' AND user_id='$idUser'");
                                    ?>
                                    <?php $i=0 ?>
                                    @while($c = mysqli_fetch_assoc($childs))
                                        <?php $cek = mysqli_query($conn, "SELECT COUNT(id) from v_hak_akses WHERE parent_id='$c[id]' AND lihat='1'") ?>
                                        <?php $cek = mysqli_fetch_array($cek) ?>
                                        @if($cek[0] == 0)
                                            <li>
                                                <a class="<?php if(Request::Route()->uri() == $menu->link){echo "active";} ?>" href="{{ $menu->link }}">
                                                    <i class="fa {{ $menu->icon }}"></i>
                                                    <span>{{ $menu->menu }}</span>
                                                </a>
                                            </li>
                                        @else
                                            <li class="sub-menu">
                                                <a href="javascript:;">
                                                    <i class="fa {{ $menu->icon }}"></i>
                                                    <span>{{ $menu->menu }}</span>
                                                </a>
                                                    <?php
                                                        $sql = "SELECT * FROM v_hak_akses WHERE parent_id='$c[id]' AND lihat='1' AND user_id='$idUser'";
                                                        $anak = mysqli_query($conn, $sql);
                                                    ?>
                                                <ul class="sub">
                                                      @while($a = mysqli_fetch_assoc($anak))
                                                            <li>
                                                                <a class="<?php if(Request::Route()->uri() == $menu->link){echo "active";} ?>" href="{{ $menu->link }}">
                                                                    <i class="fa {{ $menu->icon }}"></i>
                                                                    <span>{{ $menu->menu }}</span>
                                                                </a>
                                                            </li>               
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
                    &copy; Copyrights <strong>PT Nutrifood Indonesia</strong>. All Rights Reserved
                </p>
                <div class="credits">
                    Created with  by Nesta Maulana
                </div>
            </div>
        </footer>
        <!--footer end-->
        @if ($message = Session::get('success'))
          <div class="success" data-flashdata="{{ $message }}"></div>
        @endif
        @if ($message = Session::get('failed'))
          <div class="failed" data-flashdata="{{ $message }}"></div>
        @endif
    </section>
    <!-- DataTables -->
    <script src="{{ asset('utilityOnline/admin/modules/datatables/datatables.min.js')}}"></script>
    <script src="{{ asset('utilityOnline/admin/modules/datatables/fixed-table.min.js')}}"></script>
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
    <script src="{{ asset('rollie/penyelia/js/table.js')}}"></script>

    <!-- My JS -->
    <script src="{!! asset('generalStyle/js/popper.min.js') !!}"></script>
    <script src="{!! asset('generalStyle/plugins/select2/js/select2.min.js') !!}"></script>
    <script src="{{ asset('generalStyle/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
    <script src="{!! asset('generalStyle/plugins/sweetalert/wow.min.js') !!}"></script>
    <script>
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
    <script>
        
        $('#data-tables').dataTable({});

        $('#myModal').on('shown.bs.modal', function() {
            $('#myInput').trigger('focus')
        })
        document.getElementById("uploadBtn").onchange = function () 
        {
            document.getElementById("uploadFile").value = this.value.replace("C:\\fakepath\\", "");
        };

    </script>
</body>

</html>