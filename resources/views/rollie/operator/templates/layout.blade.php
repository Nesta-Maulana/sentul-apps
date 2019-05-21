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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <link rel="stylesheet" href="{{ asset('generalStyle/plugins/datetime-picker/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('generalStyle/plugins/datetime-picker/css/bootstrap-datetimepicker.min.css') }}">
    <script type="text/javascript" src="{{ asset('generalStyle/plugins/datetime-picker/js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('generalStyle/plugins/datetime-picker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('generalStyle/plugins/datetime-picker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        function prosescpp(namaproduk,nomorwo) 
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
                }
            })
        }
        function prosesrpd(namaproduk,nomorwo) 
        {
            Swal.fire
            ({
                title: 'Konfirmasi Aksi Filling',
                text: 'Apakah '+namaproduk+' dengan Nomor Wo '+nomorwo+' akan diproses filling?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Masuk Ke Form RPD Filling',
                cancelButtonText: 'Tidak Proses Yang Lain',
            }).then((result) => 
            {
                if (result.value) 
                {
                    $.ajax({
                        headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ route('proses-rpd-filling') }}',
                        method: 'POST',
                        dataType: 'JSON',
                        data: 
                        { 
                            'nama_produk'   : namaproduk, 
                            'nomor_wo'      : nomorwo
                        },
                        success: function (data) 
                        {
                            window.location.href    = "rollie-inspektor-qc/rpd-filling/"+data.id_rpd_head
                        },
                    });
                }
            })
        }
        function analisa_sampel_pi(kode_sampel,event_sampel,mesin_filling,tanggal_filling,jam_filling,rpd_filling_detail_id)
        {
            //
        }

        function analisa_sampel_at_event(kode_sampel,event_sampel,mesin_filling,tanggal_filling,jam_filling,rpd_filling_detail_id)
        {
            //
            
        }
        //function tambah sampel analisa untuk dimasukan di analisa QC rpd filling
        function tambahSampelAnalisa(nomorwo,mesinfilling,tanggalfilling,jamfilling,kodeanalisa,keteranganevent,beratkanan,beratkiri,id_user,id_rpd_head) 
        {
            if (!nomorwo || !mesinfilling || !tanggalfilling || !jamfilling || !kodeanalisa || !keteranganevent || !beratkanan || !beratkiri)
            {
                swal({
                    title: "Proses Gagal",
                    text: "Harap lengkapi data-data analisa sampel",
                    type: "error",
                });
                return false;
            }
            if (beratkanan.includes('.') && beratkiri.includes('.'))
            {
                if (beratkanan.toString().split(".")[1].length != 2 || beratkiri.toString().split(".")[1].length != 2)
                {
                    swal({
                        title: "Proses Gagal",
                        text: "Berat Kanan dan Berat Kiri Harus Desimal 2 angka dibelakang koma contoh : 222.30",
                        type: "error",
                    });
                    return false;
                }
            }
            else
            {
                swal({
                        title: "Proses Gagal",
                        text: "Berat Kanan dan Berat Kiri Harus Desimal 2 angka dibelakang koma contoh : 222.30",
                        type: "error",
                    });
                return false;
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url         : '{{ route('tambahsampel-inspektor-qc') }}',
                method      : 'POST',
                dataType    : 'JSON',
                data        : 
                {
                    'nomor_wo'          : nomorwo,
                    'mesin_filling_id'  : mesinfilling,
                    'tanggal_filling'   : tanggalfilling,
                    'jam_filling'       : jamfilling,
                    'kode_analisa_id'   : kodeanalisa,
                    'keteranganevent'   : keteranganevent,
                    'berat_kanan'       : beratkanan,
                    'berat_kiri'        : beratkiri,
                    'user_inputer_id'   : id_user,
                    'rpd_filling_head_id' : id_rpd_head
                },
                success      : function(data) 
                {
                    hapusdatapopup();
                    document.getElementById('close-button').click();
                    reloadTablePi();
                }
            });
        }
        //reload otomatis table
        function reloadTablePi() 
        {
            var $idrpdfillinghead = $('#idrpdfillinghead').val();
            $.ajax({
                url     : '/sentul-apps/rollie-inspektor-qc/refresh-rpd-filling/'+$idrpdfillinghead,
                method  : 'GET',
                dataType: 'JSON',
                success : function(data) 
                {
                    var isitable = '', $isitable = $('#detail_pi');
                    console.log(data.detail_pi_nya.length);
                    for (var i = 0; i < data.detail_pi_nya.length; i++)
                    {
                        isitable    += '<tr>';
                        isitable    += '<td>'+data.detail_pi_nya[i].nomor_wo+'</td>';
                        isitable    += '<td>'+data.detail_pi_nya[i].mesin_filling+'</td>';
                        isitable    += '<td>'+data.detail_pi_nya[i].jam_filling+'</td>';
                        isitable    += '<td>'+data.detail_pi_nya[i].kode_sampel+'</td>';
                        if (data.detail_pi_nya[i].kodenya == 'Event') 
                        {
                            isitable    += '<td><a data-toggle="modal" data-target="#analisa-sample-at-event">Analisa</a></td>';
                        } 
                        else if (data.detail_pi_nya[i].kodenya == 'Bukan Event') 
                        {
                            isitable    += '<td><a data-toggle="modal" data-target="#analisa-sample-pi">Analisa</a></td>';
                        }
                        isitable    += '</tr>';
                    }
                    $isitable.html(isitable).on('change');
                }
            });
        }
        function hapusdatapopup()
        {
            $('#nomorwosampel option').prop('selected', function() {
                return this.defaultSelected;
            });
            $('#mesinfillingsampel option').prop('selected', function() {
                return this.defaultSelected;
            });
            $('.timepickernya').data("DateTimePicker").date(moment(new Date()).format('HH:mm:ss'));
            $('.datepickernya').data("DateTimePicker").date(moment(new Date()).format('YYYY-MM-DD'));
            $('#kodeanalisasampel option').prop('selected', function() {
                return this.defaultSelected;
            });
            $('#eventsampel option').prop('selected', function() {
                return this.defaultSelected;
            });
            $('#beratkanansampel').val('');
            $('#beratkirisampel').val('');
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
            format: 'YYYY-mm-DD HH:mm:ss'
        }); 
    </script>  

                    
                  
</body>

</html>
