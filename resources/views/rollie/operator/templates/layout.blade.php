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
    <div class="page-container sbar_collapsed">
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
                            <?php $idUser = Session::get('login') ?>
                            @foreach ($menus as $menu)
                                <?php  
                                    $cekchild = "SELECT COUNT(id) from v_hak_akses WHERE parent_id='$menu->id' AND lihat = '1'";
                                    $cekchild = mysqli_query($conn, $cekchild);
                                    $cekchilds = mysqli_fetch_array($cekchild); 
                                ?>
                                @if ($cekchilds[0] == 0)
                                    <li>
                                        <a class="<?php if(Request::Route()->uri() == $menu->link){echo "active";} ?>" href="/sentul-apps/{{ $menu->link }}" aria-expanded="false">
                                            <i class="fa {{ $menu->icon }}"></i>
                                            <span>{{ $menu->menu }} </span>
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
                                                        <a class="<?php if(Request::Route()->uri() == $menu->link){echo "active";} ?>" href="/sentul-apps/{{ $menu->link }}">
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
                                                                        <a class="<?php if(Request::Route()->uri() == $menu->link){echo "active";} ?>" href="/sentul-apps/{{ $menu->link }}">
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
                                <h4 class="user-name dropdown-toggle text-dark" data-toggle="dropdown">Hello, {{ $username->fullname }}<i class="fa fa-angle-down"></i></h4>
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
    <script src="{{ asset('generalStyle/plugins/datetime-picker/js/jquery.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('generalStyle/plugins/datetime-picker/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('generalStyle/plugins/datetime-picker/css/bootstrap-datetimepicker.min.css') }}">
    <script type="text/javascript" src="{{ asset('generalStyle/plugins/datetime-picker/js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('generalStyle/plugins/datetime-picker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('generalStyle/plugins/datetime-picker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $('.timepickernya').datetimepicker({
            format: 'HH:mm:ss',
            locale:'en',
            date: new Date()
        }); 
        $('.datepickernya').datetimepicker({
            format: 'YYYY-MM-DD',
            locale:'en',
            date: new Date()
        }); 
        $('.datetimepickernya').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        }); 
        function prosescpp(namaproduk,nomorwo,wo_id) 
        {
            Swal.fire
            ({
                title: 'Konfirmasi Aksi Filling',
                text: 'Apakah '+namaproduk+' dengan Nomor Wo '+nomorwo+' akan diproses filling?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Masuk Ke Form CPP',
                cancelButtonText: 'Tidak Proses Yang Lain',
            }).then((result) => 
            {
                if (result.value) 
                {
                     $.ajax({
                        headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ route('proses-cpp') }}',
                        method: 'POST',
                        dataType: 'JSON',
                        data: 
                        { 
                            'wo_id'         : wo_id 
                        },
                        success: function (data) 
                        {
                            window.location.href    = "rollie-operator-produksi/cpp/"+data.cpp_head_id
                        },
                    });
                }
            })
        }

        function tambahcpp(idmesin,idwo,cpp_head_id) 
        {
            $.ajax({
                headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('tambah-cpp') }}',
                method: 'POST',
                dataType: 'JSON',
                data: 
                { 
                    'cpp_head_id'               : cpp_head_id,
                    'wo_id'                     : idwo,
                    'mesin_filling_id'          : idmesin 
                },
                success: function (data) 
                {
                    refreshcpp();
                },
            }); 
        }
        function refreshcpp() 
        {
            var $cpp_head_id    = $('#cpp_head_id').val();
            var $wo_id          = $('#no_wo').val();
            $.ajax({
                url     : '/sentul-apps/rollie-operator-produksi/cpp/refresh-table-cpp/'+$cpp_head_id+'/'+$wo_id,
                method  : 'GET',
                dataType: 'JSON',
                success : function(data) 
                {
                    $('#detail_tbac').empty();
                    $('#detail_a3b').empty();
                    $('#detail_tpa').empty();
                    for (var i = 0; i < data.cpp_detail.length; i++) 
                    {
                        if (data.cpp_detail[i].nolot.includes('TC')) 
                        {
                            if (data.cpp_detail[i].palet !== null) 
                            {
                                // ini untuk mesin TBA C
                                var table_tba_c = '', $table_tba_c = $('#detail_tbac');
                                for (var a = 0; a < data.cpp_detail[i].palet.length; a++) 
                                {
                                    table_tba_c     +=   '<tr>';
                                    // lot palet
                                    table_tba_c     +=   '<td>';
                                    table_tba_c     +=   '<div class="form-inline row">';
                                    table_tba_c     +=   '<label class="col-lg-6"> '+data.cpp_detail[i].nolot+'-</label>';
                                    table_tba_c     +=   '<input type="text" value="'+data.cpp_detail[i].palet[a].palet+'" style="width: 60px;" class="col-lg-6 form-control">';
                                    table_tba_c     +=   '</div>';
                                    table_tba_c     +=   '</td>';
                                    //start
                                    table_tba_c     +=    '<td>';
                                    table_tba_c     +=    '<div class="row">';
                                    table_tba_c     +=    '<div class="col-lg-12">';                            
                                    table_tba_c     +=    '<input type="text" class="datetimepickernya form-control" id="start_palet_'+data.cpp_detail[i].palet[a].id+'" onfocusout="ubahjamstart(\''+data.cpp_detail[i].palet[a].id_detail+'\')"  value="'+data.cpp_detail[i].palet[a].start+'">';
                                    table_tba_c     +=    '</div>';
                                    table_tba_c     +=    '</div>';
                                    table_tba_c     +=    '</td>';
                                    //end
                                    table_tba_c     +=    '<td>';
                                    table_tba_c     +=    '<div class="row">';
                                    table_tba_c     +=    '<div class="col-lg-12">';                            
                                    if (data.cpp_detail[i].palet[a].end !== null && data.cpp_detail[i].palet[a].end !== '') 
                                    {
                                        table_tba_c     +=    '<input type="text" class="datetimepickernya form-control" onfocusout="ubahjamend(\''+data.cpp_detail[i].palet[a].id_detail+'\')" id="end_palet_'+data.cpp_detail[i].palet[a].id+'" value="'+data.cpp_detail[i].palet[a].end+'" >';
                                    } 
                                    else 
                                    {
                                        table_tba_c     +=    '<input type="text" class="datetimepickernya form-control" onfocusout="ubahjamend(\''+data.cpp_detail[i].palet[a].id_detail+'\')" onfocusout="ubahjamend(\''+data.cpp_detail[i].palet[a].id_detail+'\')" id="end_palet_'+data.cpp_detail[i].palet[a].id+'" value="">';
                                    }                            
                                    table_tba_c     +=    '</div>';
                                    table_tba_c     +=    '</div>';
                                    table_tba_c     +=    '</td>';
                                    // jumlah_box
                                    table_tba_c     +=    '<td>';
                                    table_tba_c     +=    '<div class="row">';
                                    table_tba_c     +=    '<div class="col-lg-12">';                            
                                    if (data.cpp_detail[i].palet[a].jumlah_box !== null && data.cpp_detail[i].palet[a].jumlah_box!=='') 
                                    {
                                        table_tba_c     +=    '<input type="text" onfocusout="jumlahbox(\''+data.cpp_detail[i].palet[a].id_detail+'\')" id="box_palet_'+data.cpp_detail[i].palet[a].id+'" class="form-control"  value="'+data.cpp_detail[i].palet[a].jumlah_box+'">';
                                    } 
                                    else 
                                    {
                                        table_tba_c     +=    '<input type="text" onfocusout="jumlahbox(\''+data.cpp_detail[i].palet[a].id_detail+'\')" id="box_palet_'+data.cpp_detail[i].palet[a].id+'" class="form-control"  value="">';
                                    }
                                    table_tba_c     +=    '</div>';
                                    table_tba_c     +=    '</div>';
                                    table_tba_c     +=    '</td>';
                                    table_tba_c     +=    '</tr>';
                                    $table_tba_c.html(table_tba_c).on('change');
                                }
                            }
                        } 
                        else if (data.cpp_detail[i].nolot.includes('TB'))
                        {   
                            if (data.cpp_detail[i].palet !== null)
                            {
                                // ini untuk mesin A 3B
                                var table_a3b = '', $table_a3b = $('#detail_a3b');
                                for (var a = 0; a < data.cpp_detail[i].palet.length; a++) 
                                {
                                    table_a3b     +=   '<tr>';
                                    // lot palet
                                    table_a3b     +=   '<td>';
                                    table_a3b     +=   '<div class="form-inline row">';
                                    table_a3b     +=   '<label class="col-lg-6"> '+data.cpp_detail[i].nolot+'-</label>';
                                    table_a3b     +=   '<input type="text" value="'+data.cpp_detail[i].palet[a].palet+'" style="width: 60px;" class="col-lg-6 form-control">';
                                    table_a3b     +=   '</div>';
                                    table_a3b     +=   '</td>';
                                    //start
                                    table_a3b     +=    '<td>';
                                    table_a3b     +=    '<div class="row">';
                                    table_a3b     +=    '<div class="col-lg-12">';                            
                                    table_a3b     +=    '<input type="text" class="datetimepickernya form-control" id="start_palet_'+data.cpp_detail[i].palet[a].id+'" onfocusout="ubahjamstart(\''+data.cpp_detail[i].palet[a].id_detail+'\')"  value="'+data.cpp_detail[i].palet[a].start+'">';
                                    table_a3b     +=    '</div>';
                                    table_a3b     +=    '</div>';
                                    table_a3b     +=    '</td>';
                                    //end
                                    table_a3b     +=    '<td>';
                                    table_a3b     +=    '<div class="row">';
                                    table_a3b     +=    '<div class="col-lg-12">';
                                    if (data.cpp_detail[i].palet[a].end !== null && data.cpp_detail[i].palet[a].end !== '') 
                                    {

                                        table_a3b     +=    '<input type="text" class="datetimepickernya form-control" onfocusout="ubahjamend(\''+data.cpp_detail[i].palet[a].id_detail+'\')" id="end_palet_'+data.cpp_detail[i].palet[a].id+'" value="'+data.cpp_detail[i].palet[a].end+'">';
                                    } 
                                    else 
                                    {
                                        table_a3b     +=    '<input type="text" class="datetimepickernya form-control" onfocusout="ubahjamend(\''+data.cpp_detail[i].palet[a].id_detail+'\')" id="end_palet_'+data.cpp_detail[i].palet[a].id+'" value="">';
                                    }                            
                                    table_a3b     +=    '</div>';
                                    table_a3b     +=    '</div>';
                                    table_a3b     +=    '</td>';
                                    // jumlah_box
                                    table_a3b     +=    '<td>';
                                    table_a3b     +=    '<div class="row">';
                                    table_a3b     +=    '<div class="col-lg-12">';
                                    if (data.cpp_detail[i].palet[a].jumlah_box !== null && data.cpp_detail[i].palet[a].jumlah_box!=='') 
                                    {
                                        table_a3b     +=    '<input type="text" class="form-control" onfocusout="jumlahbox(\''+data.cpp_detail[i].palet[a].id_detail+'\')" id="box_palet_'+data.cpp_detail[i].palet[a].id+'" value="'+data.cpp_detail[i].palet[a].jumlah_box+'">';
                                    } 
                                    else 
                                    {
                                        table_a3b     +=    '<input type="text" onfocusout="jumlahbox(\''+data.cpp_detail[i].palet[a].id_detail+'\')" id="box_palet_'+data.cpp_detail[i].palet[a].id+'" class="form-control"  value="">';
                                    }
                                    
                                    table_a3b     +=    '</div>';
                                    table_a3b     +=    '</div>';
                                    table_a3b     +=    '</td>';
                                    table_a3b     +=    '</tr>';
                                    $table_a3b.html(table_a3b).on('change');
                                }

                            }
                            
                        } 
                        else 
                        {
                            if (data.cpp_detail[i].palet !== null)
                            {
                            // ini untuk mesin TBA C
                                var table_tpa = '', $table_tpa = $('#detail_tpa');
                                for (var a = 0; a < data.cpp_detail[i].palet.length; a++) 
                                {
                                    table_tpa     +=   '<tr>';
                                    // lot palet
                                    table_tpa     +=   '<td>';
                                    table_tpa     +=   '<div class="form-inline row">';
                                    table_tpa     +=   '<label class="col-lg-6"> '+data.cpp_detail[i].nolot+'-</label>';
                                    table_tpa     +=   '<input type="text" value="'+data.cpp_detail[i].palet[a].palet+'" style="width: 60px;" class="col-lg-6 form-control">';
                                    table_tpa     +=   '</div>';
                                    table_tpa     +=   '</td>';
                                    //start
                                    table_tpa     +=    '<td>';
                                    table_tpa     +=    '<div class="row">';
                                    table_tpa     +=    '<div class="col-lg-12">';                            
                                    table_tpa     +=    '<input type="text" class="datetimepickernya form-control" id="start_palet_'+data.cpp_detail[i].palet[a].id+'" onfocusout="ubahjamstart(\''+data.cpp_detail[i].palet[a].id_detail+'\')"  value="'+data.cpp_detail[i].palet[a].start+'">';
                                    table_tpa     +=    '</div>';
                                    table_tpa     +=    '</div>';
                                    table_tpa     +=    '</td>';
                                    //end
                                    table_tpa     +=    '<td>';
                                    table_tpa     +=    '<div class="row">';
                                    table_tpa     +=    '<div class="col-lg-12">';                            
                                    if (data.cpp_detail[i].palet[a].end !== null && data.cpp_detail[i].palet[a].end !== '') 
                                    {
                                        table_tpa     +=    '<input type="text" class="datetimepickernya form-control" onfocusout="ubahjamend(\''+data.cpp_detail[i].palet[a].id_detail+'\')" id="end_palet_'+data.cpp_detail[i].palet[a].id+'" value="'+data.cpp_detail[i].palet[a].end+'" >';
                                    } 
                                    else 
                                    {
                                        table_tpa     +=    '<input type="text" class="datetimepickernya form-control" onfocusout="ubahjamend(\''+data.cpp_detail[i].palet[a].id_detail+'\')" onfocusout="ubahjamend(\''+data.cpp_detail[i].palet[a].id_detail+'\')" id="end_palet_'+data.cpp_detail[i].palet[a].id+'" value="">';
                                    }                            
                                    table_tpa     +=    '</div>';
                                    table_tpa     +=    '</div>';
                                    table_tpa     +=    '</td>';
                                    // jumlah_box
                                    table_tpa     +=    '<td>';
                                    table_tpa     +=    '<div class="row">';
                                    table_tpa     +=    '<div class="col-lg-12">';                            
                                    if (data.cpp_detail[i].palet[a].jumlah_box !== null && data.cpp_detail[i].palet[a].jumlah_box!=='') 
                                    {
                                        table_tpa     +=    '<input type="text" onfocusout="jumlahbox(\''+data.cpp_detail[i].palet[a].id_detail+'\')" id="box_palet_'+data.cpp_detail[i].palet[a].id+'" class="form-control"  value="'+data.cpp_detail[i].palet[a].jumlah_box+'">';
                                    } 
                                    else 
                                    {
                                        table_tpa     +=    '<input type="text" onfocusout="jumlahbox(\''+data.cpp_detail[i].palet[a].id_detail+'\')" id="box_palet_'+data.cpp_detail[i].palet[a].id+'" class="form-control"  value="">';
                                    }
                                    table_tpa     +=    '</div>';
                                    table_tpa     +=    '</div>';
                                    table_tpa     +=    '</td>';
                                    table_tpa     +=    '</tr>';
                                    $table_tpa.html(table_tpa).on('change');
                                }   
                            }
                        }    
                        $('.timepickernya').datetimepicker({
                            format: 'HH:mm:ss',
                            locale:'en',
                            date: new Date()
                        }); 
                        $('.datepickernya').datetimepicker({
                            format: 'YYYY-MM-DD',
                            locale:'en',
                            date: new Date()
                        }); 
                        $('.datetimepickernya').datetimepicker({
                            format: 'YYYY-MM-DD HH:mm:ss'
                        }); 
                    }
                }
            });
        }
        function ubahjamstart(idpalet) 
        {
            $.ajax({
                url     : '/sentul-apps/dekripsi/'+idpalet,
                method  : 'GET',
                dataType: 'JSON',
                success : function(palet_id) 
                {
                    // return false;
                    palet_id        = palet_id.toString();
                    var start       = $('#start_palet_'+palet_id).val();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url         : '{{ route('ubah-jam-awal-cpp') }}',
                        method      : 'POST',
                        dataType    : 'JSON',
                        data        : 
                        {
                            jam_start   : start,
                            id_palet    : idpalet
                        },
                        success      : function(data) 
                        {
                            if (data.success == true) 
                            {
                                swal({
                                    title: "Proses Berhasil",
                                    text: data.message,
                                    type: "success",
                                });
                                refreshcpp();
                            } 
                            else 
                            {
                                swal({
                                    title: "Proses Gagal",
                                    text: data.message,
                                    type: "error",
                                });
                                refreshcpp();

                            }
                        }
                    });
                }
            });   
        }

        function ubahjamend(idpalet) 
        {
            $.ajax({
                url     : '/sentul-apps/dekripsi/'+idpalet,
                method  : 'GET',
                dataType: 'JSON',
                success : function(palet_id) 
                {
                    // return false;
                    palet_id        = palet_id.toString();
                    var end       = $('#end_palet_'+palet_id).val();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url         : '{{ route('ubah-jam-end-cpp') }}',
                        method      : 'POST',
                        dataType    : 'JSON',
                        data        : 
                        {
                            jam_end   : end,
                            id_palet    : idpalet
                        },
                        success      : function(data) 
                        {
                            if (data.success == true) 
                            {
                                swal({
                                    title: "Proses Berhasil",
                                    text: data.message,
                                    type: "success",
                                });
                                refreshcpp();
                            } 
                            else 
                            {
                                swal({
                                    title: "Proses Gagal",
                                    text: data.message,
                                    type: "error",
                                });
                                refreshcpp();

                            }
                        }
                    });
                }
            });   
        }
        function jumlahbox(idpalet) 
        {
            $.ajax({
                url     : '/sentul-apps/dekripsi/'+idpalet,
                method  : 'GET',
                dataType: 'JSON',
                success : function(palet_id) 
                {
                    // return false;
                    palet_id        = palet_id.toString();
                    var box         = $('#box_palet_'+palet_id).val();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url         : '{{ route('ubah-box-cpp') }}',
                        method      : 'POST',
                        dataType    : 'JSON',
                        data        : 
                        {
                            jumlah_box   : box,
                            id_palet    : idpalet
                        },
                        success      : function(data) 
                        {
                            refreshcpp();

                            // if (data.success == true) 
                            // {
                            //     swal({
                            //         title: "Proses Berhasil",
                            //         text: data.message,
                            //         type: "success",
                            //     });
                                refreshcpp();
                            // } 
                            // else 
                            // {
                            //     swal({
                            //         title: "Proses Gagal",
                            //         text: data.message,
                            //         type: "error",
                            //     });
                            //     refreshcpp();

                            // }
                        }
                    });
                }
            });   
        }
        function tambah_wo_batch(jenis_penambahan,cpp_head_id) 
        {
            $.ajax({
                url     : '/sentul-apps/rollie-operator-produksi/tambah-wo-batch/'+jenis_penambahan+'/'+cpp_head_id,
                method  : 'GET',
                dataType: 'JSON',
                success : function(data) 
                {
                    if (data.success == true) 
                    {
                        console.log(data);
                        var optionwo = '<option disabled selected>-- PILIH Nomor Wo --</option>', $combowo = $('#nomor_wo_tambah');
                        for (index = 0; index < data.data.length; index++) 
                        {
                            optionwo+='<option  value="'+data.data[index].nomor_wo+'" >'+data.data[index].nomor_wo+' - '+data.data[index].produk.nama_produk+'</option>';   

                        }
                        $combowo.html(optionwo).on('change');

                    } 
                    else 
                    {
                        swal({
                            title   : "Proses Gagal",
                            text    : data.message,
                            type    : "error",
                        });
                        document.getElementById('close-button-tambah-wo').click();

                    }
                }
            });
        }
        function close_popup_tambah_batch() 
        {
            $('#jenis_tambah option').prop('selected', function() {
                return this.defaultSelected;
            });
            // $('#nomor_wo_tambah option').prop('selected', function() {
            //     return this.defaultSelected;
            // });
            var select = document.getElementById("nomor_wo_tambah");
            var length = select.options.length;
            for (i = 0; i < length; i++) {
              select.options[i] = null;
            }

        }

        function pindahproduk(id_rpd_head) 
        {
            window.location.href = "/sentul-apps/rollie-operator-produksi/cpp/"+id_rpd_head.value; 
        }

        function close_cpp(id_cpp_head) 
        {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url         : '{{ route('close-cpp-operator') }}',
                method      : 'POST',
                dataType    : 'JSON',
                data        : 
                {
                    cpp_head_id : id_cpp_head
                },
                success      : function(data) 
                {
                    if (data.success == true) 
                    {
                        swal({
                            title: "Proses Berhasil",
                            text: data.message,
                            type: "success",
                        });   
                        window.location.href='{{ route("dashboard-operator-fillpack") }}';
                    } 
                    else 
                    {
                        swal({
                            title: "Proses Gagal",
                            text: data.message,
                            type: "error",
                        });
                        return false;
                    }
                }
            });
        }
    </script>  

                    
                  
</body>

</html>
