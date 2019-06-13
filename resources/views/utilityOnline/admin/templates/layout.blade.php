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
  <link rel="stylesheet" href="{{ asset('utilityOnline/admin/modules/fullcalendar/fullcalendar.min.css')}}">
  <link rel="stylesheet" href="{{ asset('utilityOnline/admin/css/daterangepicker.css')}}">
  <link rel="stylesheet" href="{{ asset('utilityOnline/admin/css/bootstrap-timepicker.min.css')}}">
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('utilityOnline/admin/css/style.css')}}">
  <link rel="stylesheet" href="{{ asset('utilityOnline/admin/css/components.css')}}">
  <link rel='stylesheet' href="{!! asset('generalStyle/plugins/select2/css/select2.min.css') !!}">

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
            </ul>
        </form>
        <ul class="navbar-nav navbar-right">
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
                    <a href="/sentul-apps/logout" class="dropdown-item has-icon text-danger">
                        <i class="fa fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </li>
        </ul> 
      </nav>
    <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
                <a href="/sentul-apps/utility-online/admin">UTILITY ONLINE</a>
            </div>
            <div class="sidebar-brand sidebar-brand-sm">
                <a href="/sentul-apps/utility-online/admin">ULLIE</a>
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
  
    <script src="{{ asset('utilityOnline/admin/js/moment.min.js')}}"></script>
    <script src="{{ asset('utilityOnline/admin/modules/fullcalendar/fullcalendar.min.js')}}"></script>
    <script src="{{ asset('utilityOnline/admin/js/page/modules-calendar.js')}}"></script>

    <script src="{{ asset('utilityOnline/admin/modules/datatables/datatables.min.js')}}"></script>
    <script src="{{ asset('utilityOnline/admin/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('utilityOnline/admin/modules/datatables/Select-1.2.4/js/dataTables.select.min.js')}}"></script>

  <script src="{{ asset('utilityOnline/admin/modules/jquery-ui/jquery-ui.min.js')}}"></script>
  <script src="{{ asset('utilityOnline/admin/js/daterangepicker.js')}}"></script>
  <script src="{{ asset('utilityOnline/admin/js/bootstrap-datetimepicker.min.js')}}"></script>
  <!-- Page Specific JS File -->
  <script src="{{ asset('utilityOnline/admin/js/page/modules-datatables.js')}}"></script>
  <script src="{{ asset('utilityOnline/admin/js/page/modules-chartjs.js')}}"></script>
  <script src="{{ asset('generalStyle/plugins/select2/js/select2.min.js') }}"></script>
  <script>
    
    $.ajax({
        url: 'form-hari-kerja-ambil/',
        method: 'get',
        dataType: 'json',
        success: function (data) {
            for (let i = 0; i < data.length; i++) {
                if(data[i].hni){
                    var event={id:i , title: data[i].hni + ' SHIFT (HNI)', start:  data[i].tgl, backgroundColor: "#eaeaea", borderColor: "#fff", textColor: '#000'};
                    $("#myEvent").fullCalendar('renderEvent', event, true);
                }
                if(data[i].nfi){
                    var event={id:i , title: data[i].nfi + ' SHIFT(NFI)', start:  data[i].tgl, backgroundColor: "#eaeaea", borderColor: "#fff", textColor: '#000'};
                    $("#myEvent").fullCalendar('renderEvent', event, true);
                }
                
            }
        }
    });
  
    // Modal
    $('.fc-day-top').click(function () {
        $("#hni option[value= '']").prop('selected', true);
        $("#nfi option[value= '']").prop('selected', true);
        $('#tgl').val($(this).data('date'));
        $.ajax({
            url: 'form-hari-kerja/' + $(this).data('date'),
            method: 'get',
            dataType: 'json',
            success: function(data) { 
                if(data[0]){
                    $('#id').val(data[0].id);
                    $("#hni option[value= '" + data[0].hni + "']").prop('selected', true);
                    $("#nfi option[value= '" + data[0].nfi + "']").prop('selected', true);
                }
             }
        });
        $('#exampleModal').appendTo("body").modal('show');
    });

    $('#closeModalHariKerja').click(function () { 
        $('#id').val("");
        
        $('#exampleModal').modal('hide');
     })

  $('.select2').select2();
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
        $('#tgl-penggunaan-1').val(start.format('YYYY-MM-DD'));
        $('#tgl-penggunaan-2').val(end.format('YYYY-MM-DD'));
        if($('#kategori-penggunaan').val() == null){
            $.ajax({
                url: 'report/' + start.format('YYYY-MM-DD') + '/' + end.format('YYYY-MM-DD'),
                method: 'GET',
                dataType: 'JSON',
                success: function (data) {
                    $('#export-penggunaan').show();
                    $('#export-penggunaan-info').hide();
                    $('#table-1').DataTable().destroy();
                    $('#isi').empty();
                    var no = 1;
                    for (let index = 0; index < data[0].length; index++) {
                        for (let i = 0; i < data[1].length; i++) {
                            if (data[0][index].id_bagian == data[1][i].id) {
                                var $table = "<tr>";
                                $table += "<td>" + no + "</td>";
                                $table += "<td>" + data[1][i].bagian + "</td>";
                                $table += "<td>" + data[0][index].nilai_nfi + "</td>";
                                $table += "<td>" + data[0][index].nilai_hni + "</td>";
                                $table += "<td>" + data[0][index].tgl_penggunaan + "</td>";
                                $table += '<td><a href="report/detail/' + data[0][index].id_bagian + '/' + data[0][index].tgl_penggunaan + '" class="btn btn-primary text-white">Lihat Detail</a></td>';
                                $table += "</tr>";
                                no++;
                                $("#isi").append($table);
                            }
                        }
                    }
                    $('#table-1').DataTable({
                        "columnDefs": [{
                            "sortable": false,
                            "targets": [2, 3]
                        }]
                    }).draw();
                }
            })
        }else{
            $.ajax({
                url: 'report/' + $('#kategori-penggunaan').val() + '/' + start.format('YYYY-MM-DD') + '/' + end.format('YYYY-MM-DD'),
                method: 'GET',
                dataType: 'JSON',
                success: function (data) {
                    $('#export-penggunaan').show();
                    $('#export-penggunaan-info').hide();
                    $('#table-1').DataTable().destroy();
                    $('#isi').empty();
                    var no = 1;
                    for (let index = 0; index < data[0].length; index++) {
                        for (let i = 0; i < data[1].length; i++) {
                            if (data[0][index].id_bagian == data[1][i].id) {
                                var table = "<tr>";
                                table += "<td>" + no + "</td>";
                                table += "<td>" + data[1][i].bagian + "</td>";
                                table += "<td>" + data[0][index].nilai_nfi + "</td>";
                                table += "<td>" + data[0][index].nilai_hni + "</td>";
                                table += "<td>" + data[0][index].tgl_penggunaan + "</td>";
                                table += '<td><a href="report/detail/' + data[0][index].id_bagian + '/' + data[0][index].tgl_penggunaan + '" class="btn btn-primary text-white">Lihat Detail</a></td>';
                                table += "</tr>";
                                no++;
                                $("#isi").append($table);
                            }
                        }
                    }
                    $('#table-1').DataTable({
                        "columnDefs": [{
                            "sortable": false,
                            "targets": [2, 3]
                        }]
                    }).draw();
                }
            })
        }
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
                    $('#export-pengamatan').show();
                    $('#export-pengamatan-info').hide();
                    $('#kategori').attr('disabled', false);
                    $('#kategori').val("");
                    $('#workcenter').val("");
                    $('#table-pengamatan').DataTable().destroy();
                    $('#isi-table-pengamatan').empty();
                    var no = 1;
                    for (let index = 0; index < data.length; index++) 
                    {
                        for (let i = 0; i < data[index].pengamatan.length; i++) {
                        var table = '<tr>';
                            table+='<td>' + no + '</td>'
                            table+='<td>' + data[index].bagian + '</td>';
                            if(!data[index].pengamatan[i][0]){
                                table+='<td> Tidak melakukan pengamatan </td>'
                            }else{
                                table+='<td>'+ data[index].pengamatan[i][0].nilai_meteran+'</td>'
                            }
                            table+='<td>'+ data[index].satuan_id +'</td>'
                            table+='<td>'+ data[index].pengamatan[i][1] +'</td>'
                            table+='</tr>';          
                            $("#isi-table-pengamatan").append(table);     
                            no++;
                        }
                    }
                    $('#table-pengamatan').DataTable().order([4, 'asc']).draw();
                }
            })
        }
    )
    $('#daterange-btn-3').daterangepicker(
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

            
            $('#daterange-btn-3 span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY')); 
            $('#tgl-report-3-1').val(start.format('YYYY-MM-DD'));
            $('#tgl-report-3-2').val(end.format('YYYY-MM-DD'));
            if($('#kategori3').val()){
                $.ajax({
                    url: 'report-3/'+ $('#kategori3').val() + '/'  + start.format('YYYY-MM-DD') + '/' +end.format('YYYY-MM-DD'),
                    method: 'GET',
                    dataType: 'JSON',
                    success: function (data) {
                        
                        $('.export-3').show();
                        $('.export-3-info').hide();
                        $('.table-3').DataTable().destroy();
                        $('.table-3 tbody').empty();
                        
                        var td = '';
                        for (let index = 0; index < data.length; index++) {
                            var no = index + 1;
                            td+='<tr>';
                            td+='<td>'+no+'</td>';
                            td+='<td>'+data[index].bagian+'</td>'
                            if (data[index.nilai] == 0) {
                                data[index].nilai = null;
                            }
                            td+='<td>'+data[index].nilai+'</td>'
                            td+='<td>'+data[index].satuan+'</td>'
                            td+='<td>'+data[index].tanggal_penggunaan+'</td>'
                            td+='</tr>';
                        }
                        $('#table-report-3').html(td).on('change');
                        $('.table-3').DataTable().order([4, 'asc']).draw({});
                    }
                });
            }else{
                $.ajax({
                    url: 'report-3/'  + start.format('YYYY-MM-DD') + '/' +end.format('YYYY-MM-DD'),
                    method: 'GET',
                    dataType: 'JSON',
                    success: function (data) {
                        
                        $('.export-3').show();
                        $('.export-3-info').hide();
                        $('.table-3').DataTable().destroy();
                        $('.table-3 tbody').empty();
                        
                        var td = '';
                        for (let index = 0; index < data.length; index++) {
                            var no = index + 1;
                            td+='<tr>';
                            td+='<td>'+no+'</td>';
                            td+='<td>'+data[index].bagian+'</td>'
                            if (data[index.nilai] == 0) {
                                data[index].nilai = null;
                            }
                            td+='<td>'+data[index].nilai+'</td>'
                            td+='<td>'+data[index].satuan+'</td>'
                            td+='<td>'+data[index].tanggal_penggunaan+'</td>'
                            td+='</tr>';
                        }
                        $('#table-report-3').html(td).on('change');
                        $('.table-3').DataTable().order([4, 'asc']).draw({});
                    }
                });
            }
        }
    )
    $('#daterange-btn-4').daterangepicker(
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
            $('#daterange-btn-4 span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY')); 
            $('#tgl-report-4-1').val(start.format('YYYY-MM-DD'));
            $('#tgl-report-4-2').val(end.format('YYYY-MM-DD'));
            $('#export-4').show();
            $('#info-export-4').hide();

            if($('#kategori-4').val()){
                $.ajax({
                    url: 'report-4/' + $('#kategori-4').val() + '/' + $('#tgl-report-4-1').val() + '/' + $('#tgl-report-4-2').val(),
                    method: 'GET',
                    dataType: 'JSON',
                    success: function (data) {
                        $(".table-4").DataTable().destroy();
                        $("#table-report-4").empty();
                        var table = "";
                        for (let i = 0; i < data.length; i++) {
                            var no = i + 1;
                            table+="<tr>";
                            table+="<td>" + no + "</td>"
                            table+="<td>" + data[i].bagian + "</td>";
                            table+="<td>" + data[i].nilai + "</td>";
                            table+="<td>" + data[i].satuan + "</td>";
                            table+="<td>" + data[i].tgl_penggunaan + "</td>";
                            table+="</tr>";   
                        }
                        $("#table-report-4").html(table).on('change');
                        $(".table-4").DataTable().order([4, 'asc']).draw();
                    }
                })
            }else{
                $.ajax({
                    url: "report-4/" + $('#tgl-report-4-1').val() + '/' + $('#tgl-report-4-2').val(),
                    method: 'GET',
                    dataType: 'JSON',
                    success: function (data) { 
                        $(".table-4").DataTable().destroy();
                        $("#table-report-4").empty();
                        var table = "";
                        for (let i = 0; i < data.length; i++) {
                            var no = i + 1;
                            table+="<tr>";
                            table+="<td>" + no + "</td>"
                            table+="<td>" + data[i].bagian + "</td>";
                            table+="<td>" + data[i].nilai + "</td>";
                            table+="<td>" + data[i].satuan + "</td>";
                            table+="<td>" + data[i].tgl_penggunaan + "</td>";
                            table+="</tr>";   
                        }
                        $("#table-report-4").html(table).on('change');
                        $(".table-4").DataTable().order([4, 'asc']).draw();
                    }
                })
            }


        }
    )
    
</script>
</body>
</html>
