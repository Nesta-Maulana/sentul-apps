<?php $conn = mysqli_connect('localhost', "root", "", "master_apps"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>@yield('title')</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('generalStyle/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{ asset('generalStyle/fonts/icon/font-awesome.min.css')}}">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('utilityOnline/admin/modules/datatables/datatables.min.css')}}">
  <link rel="stylesheet" href="{{ asset('utilityOnline/admin/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('utilityOnline/admin/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('utilityOnline/admin/css/daterangepicker.css')}}">
  <link rel="stylesheet" href="{{ asset('utilityOnline/admin/css/bootstrap-timepicker.min.css')}}">
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('utilityOnline/admin/css/style.css')}}">
  <link rel="stylesheet" href="{{ asset('utilityOnline/admin/css/components.css')}}">
  <script src="{{ asset('utilityOnline/admin/js/jquery.min.js') }}"></script>
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fa fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fa fa-search"></i></a></li>
          </ul>
          <div class="search-element">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
            <button class="btn" type="submit"><i class="fa fa-search"></i></button>
            <div class="search-backdrop"></div>
          </div>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="fa fa-bell"></i></a>
                <div class="dropdown-menu dropdown-list dropdown-menu-right">
                    <div class="dropdown-header">Notifications
                        <div class="float-right">
                            <a href="#">Mark All As Read</a>
                        </div>
                    </div>
                    <div class="dropdown-list-content dropdown-list-icons">
                        <a href="#" class="dropdown-item dropdown-item-unread">
                            <div class="dropdown-item-icon bg-primary text-white">
                                <i class="fa fa-code"></i>
                            </div>
                            <div class="dropdown-item-desc">
                                Template update is available now!
                                <div class="time text-primary">2 Min Ago</div>
                            </div>
                        </a>
                    </div>
                    <div class="dropdown-footer text-center">
                        <a href="#">View All <i class="fa fa-chevron-right"></i></a>
                    </div>
                </div>
            </li>
            <li class="dropdown">
                <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    <div class="d-sm-none d-lg-inline-block">Hi, {{$username}}</div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-title">Kamu login sebagai .....</div>
                    <a href="features-profile.html" class="dropdown-item has-icon">
                        <i class="fa fa-user"></i> Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item has-icon text-danger">
                        <i class="fa fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </li>
        </ul>
      </nav>
    <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
                <a href="dashboard-ecommerce.html">UTILITY ONLINE</a>
            </div>
            <div class="sidebar-brand sidebar-brand-sm">
                <a href="dashboard-ecommerce.html">ULLIE</a>
            </div>
            <ul class="sidebar-menu">

                <li class="menu-header">Main</li>
                    <li class="dropdown @yield('active-report')">
                        <a href="/sentul-apps/utility-online/admin/report" class="nav-link"><i class="fa fa-columns"></i> <span>Reports</span></a>                        
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
          Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
        </div>
        <div class="footer-right">
          v1.0.0
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="{{ asset('generalStyle/js/popper.min.js')}}"></script>
  <script src="{{ asset('utilityOnline/admin/js/tooltip.js')}}"></script>
  <script src="{{ asset('generalStyle/js/bootstrap.min.js')}}"></script>
  <script src="{{ asset('utilityOnline/admin/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
  <script src="{{ asset('utilityOnline/admin/js/moment.min.js')}}"></script>
  <script src="{{ asset('utilityOnline/admin/js/stisla.js')}}"></script>
  
  <!-- JS Libraies -->
  <script src="{{ asset('utilityOnline/admin/js/chart.min.js')}}"></script>

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
  <script src="{{ asset('utilityOnline/admin/js/daterangepicker.js')}}"></script>
  <script src="{{ asset('utilityOnline/admin/js/bootstrap-datetimepicker.min.js')}}"></script>
  <!-- Page Specific JS File -->
  <script src="{{ asset('utilityOnline/admin/js/page/modules-datatables.js')}}"></script>
  <script src="{{ asset('utilityOnline/admin/js/page/modules-chartjs.js')}}"></script>
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
  <script>
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        // startDate: moment().subtract(29, 'days'),
        // endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        // $('#inputMulai').val(start.format('YYYY-MM-DD'));
        // $('#inputSampai').val(end.format('YYYY-MM-DD'));
        $.ajax({
            url: 'report/' + start.format('YYYY-MM-DD') + '/' +end.format('YYYY-MM-DD'),
            method: 'GET',
            dataType: 'JSON',
            success: function (data) {
                $('#table-1').DataTable().destroy();
                $('#isi').empty();
                var no = 1;
                for (let index = 0; index < data[0].length; index++) 
                {
                
                    var $table = "<tr>";
                    $table += "<td>" + no + "</td>";
                    for(let i = 0; i < data[1].length; i++){
                        if(data[0][index].id_bagian == data[1][i].id){
                            $table += "<td>"+data[1][i].bagian+"</td>";
                        }
                    }
                    $table += "<td>"+data[0][index].nilai+"</td>";
                    $table += "<td>"+data[0][index].tgl_penggunaan+"</td>";
                    $table += '<td><a href="report/detail/'+ data[0][index].id_bagian +'/'+ data[0][index].tgl_penggunaan +'" class="btn btn-primary text-white">Lihat Detail</a></td>';
                    $table+="</tr>";
                    no++;
                    $("#isi").append($table);     
                }
                $('#table-1').DataTable().draw();
            }
        })
      })
    $('#daterange-btn-2').daterangepicker(
        {
            ranges   : {
                'Today'       : [moment(), moment()],
                'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            
        },
        function (start, end) { 
            $('#daterange-btn-2 span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY')); 
            $('#tgl-pengamatan-1').val(start.format('YYYY-MM-DD'));
            $('#tgl-pengamatan-2').val(end.format('YYYY-MM-DD'));
            $.ajax({
                url: 'report-2/' + start.format('YYYY-MM-DD') + '/' +end.format('YYYY-MM-DD'),
                method: 'GET',
                dataType: 'JSON',
                success: function (data) {
                    $('#kategori').attr('disabled', false);
                    $('#table-pengamatan').DataTable().destroy();
                    $('#isi-table-pengamatan').empty();
                    var no = 1;
                    for (let index = 0; index < data.length; index++) 
                    {
                        console.log(data);
                        
                        var $table = "<tr>";
                        $table += "<td>" + no + "</td>";
                        $table += "<td>"+data[index].bagian.bagian+"</td>";
                        $table += "<td>"+data[index].nilai_meteran+"</td>";
                        $table += "<td>"+data[index].bagian.satuan.satuan+"</td>";
                        if (data[index].created_at !== null) {
                            $table += "<td>"+data[index].created_at+"</td>";
                        }else{
                            $table += "<td> Belum ada pengamatan </td>";
                        }
                        $table+="</tr>";
                        no++;
                        $("#isi-table-pengamatan").append($table);     
                    }
                    $('#table-pengamatan').DataTable().draw();
                }
            })
        }
    )
    
</script>
</body>
</html>
