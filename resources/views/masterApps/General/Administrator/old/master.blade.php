<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin | @yield('judul')</title>
    <link rel="stylesheet" href="{!! asset('dashboard_style/css/icon/icon.css') !!}">
    <link rel="stylesheet" href="{!! asset('dashboard_style/css/icon/font-awesome.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('dashboard_style/css/materialize.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('dashboard_style/css/materialize.css') !!}">
    <link rel="stylesheet" href="{!! asset('dashboard_style/plugins/dataTables.material.min.css') !!}">
    <script type="text/javascript" src="{!! asset('dashboard_style/js/jquery.min.js') !!}"></script>
</head>
<body class="grey lighten-3">
    {{-- Navigasi Bagian Atas --}} 
    <nav style="background:#0CBEF2;">
        <ul class="hide-on-med-and-down">
            <li style="margin-left:10px; margin-top:1.5px;">
                <a href="" class="brand-logo" style="height:60px">
                    <img src="{!! asset('dashboard_style/images/logo/mixpro-logo.png') !!}" style="width:60px;height:60px;" alt="">
                </a>
            </li>
        </ul>
        <div class="nav-wrapper container">
            <ul class="hide-on-med-and-down left" style="margin-left:-130px">
                <li>
                    <a href="#about" style="font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;font-size:25px">About</a>
                </li>
                <li>
                    <a href="#userguide" style="font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;font-size:25px">User Guide</a>
                </li>
                <li>
                    <a href="#help" style="font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;font-size:25px">Help</a>
                </li>
            </ul>
            <ul class="hide-on-med-and-down right" style="margin-right:-150px">
                <li class="dropdown-button" data-activates="notifikasi" id="notif" style="padding-right:10px; text-align:center;">
                    <i class="fa fa-bell left" style="font-size:1.2rem;margin-left: 20px;"></i>
                    <ul class="dropdown-content" id="notifikasi" style="min-width:450px;margin-top:70px;">
                        <li  class="blue darken-3">
                            <div class="card-content blue">
                                <a style="border-bottom:0.3px solid white">
                                    <div class="row">
                                        <div class="col l11" style="font-size: 12px;">
                                            Lorem ipsum dolor sit amet
                                        </div>
                                        <div class="col l1">
                                                <i class="fa fa-circle left"></i>
                                        </div>
                                    </div>
                                </a>
                                <div class="card-action center">
                                    <a href="#" class="black-text">Lihat Semua</a>	
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>   
                <li class="dropdown-button" data-activates="logoutnya" id="logout">
                    <i class="material-icons left">account_circle</i>Nesta Maulana
                    <ul class="dropdown-content" id="logoutnya" style="">
                        <li>
                            <a href="" style="color: #fff;background-color: #001F24;">	
                                Keluar
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    {{-- Tutup Navigasi Bagian Atas --}}
    {{-- Navigasi Bagian Bawah --}}
    <nav style="margin-top:5px;background:#0070DB;">
        <div class="nav-wrapper container">
            <ul class="hide-on-med-and-down" style="margin-left:-150px">
                <li @yield('active-home')>
                    <a href="{{ url('administrator/home') }}" style="font-size:30px;">
                        <i class="fa fa-home"> 
                            <span style="font-size:20px;font-family:Arial, Helvetica, sans-serif;">Home</span>
                        </i>
                    </a>
                </li>
                <li style="font-size:35px;">|</li>
                <li @yield('active-lpm')>
                    <a href="{{ url('administrator/lpm') }}" style="font-size:30px;">
                        <i class="fa fa-files-o"> 
                            <span style="font-size:20px;font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">LPM</span>
                        </i>
                    </a>
                </li>
                <li style="font-size:35px;">|</li>
                <li @yield('active-pmb')>
                    <a href="{{ url('administrator/pmb') }}" style="font-size:30px;">
                        <i class="fa fa-edit"> 
                            <span style="font-size:20px;font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">PMB</span>
                        </i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    @yield('content')
    <footer class="page-footer" style="background:#0070DB">
        <div class="footer-copyright" style="background:#0CBEF2">
            <div class="container" style="text-align:center;font-weight: 700;">
                © 2018 Copyright <a href="javascript:void(0)" style="color:darkgreen">PT. Nutrifood Indonesia</a> | Coded <i class="fa fa-code" style="color:palevioletred;"></i> With Love <i class="fa fa-heart" style="color:palevioletred"></i>
            </div>
        </div>
    </footer>
    <script type="text/javascript" src="{!! asset('dashboard_style/js/materialize.min.js') !!}"></script>
	<script type="text/javascript" src="{!! asset('dashboard_style/plugins/jquery.dataTables.min.js') !!}"></script>
	<script type="text/javascript" src="{!! asset('dashboard_style/plugins/dataTables.material.min.js') !!}"></script>
	<script type="text/javascript" src="{!! asset('dashboard_style/plugins/jquery.validate.min.js') !!}"></script>
	<script type="text/javascript" src="{!! asset('dashboard_style/plugins/jquery.validate.js') !!}"></script>
	<script type="text/javascript" src="{!! asset('dashboard_style/plugins/ckeditor/ckeditor.js') !!}"></script>
	<script type="text/javascript" src="{!! asset('dashboard_style/js/init.js') !!}"></script>
    <script type="text/javascript">
		$(".buka").sideNav();
		$(document).ready(function() {
			$("select").material_select();
		});
		$('.datepicker').pickadate({
			format:'dd-mm-yyyy',
			selectMonths:true,
			selectYears:5,
			max:'Today',
			clear:'Clear',
			close:'Ok',
			closeOnSelect:true
        });
        $('.dropdown-trigger').dropdown();

		$("#logout").dropdown({
			inDuration:300,
			outDuration:300,
			hover:true,
			belowOrigin:true,
			constrain_width:true
		});
		$("#notif").dropdown({
			inDuration:300,
			outDuration:300,
			constrain_width:true
		});
		// CKEDITOR.replace('apa');
		// $(document).ready(function() {
		//     $('#tablenya').DataTable( {
		//         columnDefs: [
		//             {
		//                 targets: [ 0, 1, 2 ],
		//                 className: 'mdl-data-table__cell--non-numeric'
		//             }
		//         ]
		//     } );
		// } );
	</script>
</body>
</html>