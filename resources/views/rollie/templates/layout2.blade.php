@php
	$host 				= env('DB_HOST');
	$database 			= env('DB_DATABASE');
	$uname 				= env('DB_USERNAME');
	$pass 				= env('DB_PASSWORD');
	$conn 				= mysqli_connect($host,$uname,$pass,$database); 
	@endphp

<!DOCTYPE html>
<html lang="en" >
	<head>
		<meta charset="utf-8" />
		<title>
			@yield('title')
		</title>
		<meta name="description" content="Latest updates and statistic charts">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="shortcut icon" href="{{ asset('rollie/img/logo/favicon.ico')}}" />

		<link href="{{ asset('rollie/css/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('rollie/css/vendors.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('rollie/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('rollie/css/custom.css')}}" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" href="{!!asset('utilityOnline/css/bootstrap.min.css')!!}">
		<link rel="stylesheet" href="{!!asset('utilityOnline/css/bootstrap.css')!!}">
        
        <link rel="stylesheet" href="{!!asset('utilityOnline/fonts/icon/font-awesome.min.css')!!}">

						
		<script src="{{ asset('rollie/js/webfont.js')}}"></script>
	  	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
		<link rel="stylesheet" href="{{ asset('generalStyle/plugins/datetime-picker/css/bootstrap.css') }}">
		<link rel="stylesheet" href="{{ asset('generalStyle/plugins/datetime-picker/css/bootstrap-datetimepicker.min.css') }}">
		<script type="text/javascript" src="{{ asset('generalStyle/plugins/datetime-picker/js/moment.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('generalStyle/plugins/datetime-picker/js/bootstrap-datetimepicker.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('generalStyle/plugins/datetime-picker/js/bootstrap-datetimepicker.min.js') }}"></script>
        <script type="text/javascript">
	        $('#timepicker').datetimepicker({
				format: 'YYYY-MM-DD HH:mm:ss'
        	}); 
		</script>  



		
	</head>

	<body  class="m-page--wide m-header--fixed m-header--fixed-mobile m-footer--push m-aside--offcanvas-default"  >
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<header id="m_header" class="m-grid__item m-header "  minimize="minimize" minimize-offset="200" minimize-mobile-offset="200" >
				<div class="m-header__top">
					<div class="m-container m-container--responsive m-container--xxl m-container--full-height m-page__container">
						<div class="m-stack m-stack--ver m-stack--desktop">
							<div class="m-stack__item m-brand">
								<div class="m-stack m-stack--ver m-stack--general m-stack--inline">
									<div class="m-stack__item m-stack__item--middle m-brand__logo">
										<a href="index.html" class="m-brand__logo-wrapper">
											<img alt="" src="{{ asset('rollie/img/logo/logo.png')}}"/>
										</a>
									</div>
									<div class="m-stack__item m-stack__item--middle m-brand__tools" >
										<div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-light m-aside-header-menu-mobile--submenu-skin-light "  >
											<ul class="m-menu__nav  m-menu__nav--submenu-arrow">
												<li class="m-menu__item  m-menu__item--active  m-menu__item--submenu m-menu__item--rel"  m-menu-submenu-toggle="click" aria-haspopup="true">
													<h3 class="m-subheader-search__title" style="color: #e71372;">
														ROLLIE 
													</h3>
												</li>
												<li class="m-menu__item  m-menu__item--submenu m-menu__item--rel @yield('active-home')"  m-menu-submenu-toggle="click" aria-haspopup="true">
													<a  href="javascript:;" class="m-menu__link m-menu__toggle">
														<span class="m-menu__link-text">
															Home
														</span>
													</a>
												</li>
												<li class="m-menu__item   m-menu__item--submenu m-menu__item--rel @yield('active-user-guide')"  m-menu-submenu-toggle="click" aria-haspopup="true">
													<a  href="javascript:;" class="m-menu__link m-menu__toggle">
														<span class="m-menu__link-text">
															UserGuide
														</span>
													</a>
												</li>
												<li class="m-menu__item  m-menu__item--submenu m-menu__item--rel  m-menu__item--submenu m-menu__item--rel @yield('active-help')"  m-menu-submenu-toggle="click" aria-haspopup="true">
													<a  href="javascript:;" class="m-menu__link m-menu__toggle">
														<span class="m-menu__link-text">
															Help
														</span>
													</a>
												</li>
											</ul>
										</div>
										<a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
											<span></span>
										</a>
										<a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
											<i class="flaticon-more"></i>
										</a>
									</div>
								</div>
							</div>
							<div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
								<div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
									<div class="m-stack__item m-topbar__nav-wrapper">
										<ul class="m-topbar__nav m-nav m-nav--inline d-flex justify-content-start">
											<li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click" id="user">
												<a href="#" class="m-nav__link m-dropdown__toggle" style="float: right">
													<span class="m-topbar__userpic m--hide">
														<img src="{{ asset('rollie/img/users/user4.jpg')}}" class="m--img-rounded m--marginless m--img-centered" alt=""/>
													</span>
													<span class="m-topbar__welcome">
														Hello,&nbsp;
													</span>
													<span class="m-topbar__username">
														{{ $username->fullname }}
													</span>
												</a>
												<div class="m-dropdown__wrapper">
													<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
													<div class="m-dropdown__inner">
														<div class="m-dropdown__header m--align-center back">
															<div class="m-card-user m-card-user--skin-dark">
																<div class="m-card-user__pic">
																	@if ($username->jk == '0')
																		@if ($username->agama->agama == 'Islam')
																			<img src="{{ asset('generalStyle/images/users/muslim.jpg')}}" class="m--img-rounded m--marginless" alt=""/>
																		@else
																			<img src="{{ asset('generalStyle/images/users/woman.png')}}" class="m--img-rounded m--marginless" alt=""/>
																		@endif
																	@else
																		<img src="{{ asset('generalStyle/images/users/men.png')}}" class="m--img-rounded m--marginless" alt=""/>
																	@endif
																</div>
																<div class="m-card-user__details">
																	<span class="m-card-user__name m--font-weight-500">
																		{{ $username->fullname }}
																	</span>
																	<a href="" class="m-card-user__email m--font-weight-300 m-link">
																		{{ $username->email }}
																	</a>
																</div>
															</div>
														</div>
														<div class="m-dropdown__body">
															<div class="m-dropdown__content">
																<ul class="m-nav m-nav--skin-light">
																	<li class="m-nav__section m--hide">
																		<span class="m-nav__section-text">
																			Section
																		</span>
																	</li>
																	<li class="m-nav__item">
																		<a href="/sentul-apps/logout" class="m-nav__link">
																			<i class="m-nav__link-icon flaticon-profile-1"></i>
																			<span class="m-nav__link-title">
																				<span class="m-nav__link-wrap">
																					<span class="m-nav__link-text">
																						Logout
																					</span>
																				</span>
																			</span>
																		</a>
																	</li>
																</ul>
															</div>
														</div>
													</div>
												</div>
											</li>
											<li class="m-nav__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-center 	m-dropdown--mobile-full-width" m-dropdown-toggle="click" m-dropdown-persistent="1">
												
											<li class="m-nav__item m-topbar__quick-actions m-topbar__quick-actions--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push m-dropdown--mobile-full-width m-dropdown--skin-light"  m-dropdown-toggle="click">
												
												<div class="m-dropdown__wrapper">
													<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
													<div class="m-dropdown__inner">
														<div class="m-dropdown__header m--align-center" style="background: url(app/media/img/misc/quick_actions_bg.jpg); background-size: cover;">
															<span class="m-dropdown__header-title">
																Quick Actions
															</span>
															<span class="m-dropdown__header-subtitle">
																Shortcuts
															</span>
														</div>
													</div>
												</div>
											</li>
											
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="m-header__bottom">
					<div class="m-container m-container--responsive m-container--xxl m-container--full-height m-page__container">
						<div class="m-stack m-stack--ver m-stack--desktop">
							<div class="m-stack__item m-stack__item--middle m-stack__item--fluid">
								<button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-light " id="m_aside_header_menu_mobile_close_btn">
									<i class="la la-close"></i>
								</button>
								<div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-dark m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-light m-aside-header-menu-mobile--submenu-skin-light "  >
									<ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
										
										<?php $idUser = Session::get('login') ?>
								        @foreach($menus as $menu)
								            <?php  
								                $cekchild 	= "SELECT COUNT(id) from v_hak_akses WHERE parent_id='$menu->id' AND lihat = '1'";
								                $cekchild 	= mysqli_query($conn, $cekchild);
								                $cekchilds 	= mysqli_fetch_array($cekchild); 
								                $potong		= explode('/', $menu->link);
								                $yield 		= 'active-'.$potong[1];
								            ?>
								            @if($cekchilds[0] == 0)
								                <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel @yield($yield)"  m-menu-submenu-toggle="click" aria-haspopup="true">
													<a href="{{ '/sentul-apps/'.$menu->link }}" class="m-menu__link m-menu__toggle">
														<span class="m-menu__item-here"></span>
														<span class="m-menu__link-text">
															{{ $menu->menu }}
														</span>
													</a>
													<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
														<span class="m-menu__arrow m-menu__arrow--adjust"></span>
														
													</div>
												</li>
								            @endif
		
							            @endforeach
										
										
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>		
            <div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver-desktop m-grid--desktop m-container m-container--responsive m-container--xxl m-page__container m-body" style="background: #f2f3f8">
				<div class="m-grid__item m-grid__item--fluid m-wrapper">
					<div class="m-subheader ">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								<h3 class="m-subheader__title ">
									@yield('subheader')
								</h3>
							</div>
						</div>
                    </div>
		            <div class="m-content" style="padding: 0px" >
		                @yield('content')    
		            </div>
                </div>
            </div>
            @if ($message = Session::get('success'))
	    	    <div class="success" data-flashdata="{{ $message }}"></div>
		    @endif
		    @if ($message = Session::get('failed'))
		        <div class="failed" data-flashdata="{{ $message }}"></div>
		    @endif
		    @if ($message = Session::get('info'))
		        <div class="info" data-flashdata="{{ $message }}"></div>
		    @endif
	<script src="{!! asset('masterApps/js/jquery-3.3.1.min.js') !!}"></script>

	<script src="{!! asset('rollie/js/select2.js') !!}"></script>
	<script src="{{ asset('rollie/js/vendors.bundle.js')}}" type="text/javascript"></script>
	<script src="{{ asset('rollie/js/scripts.bundle.js')}}" type="text/javascript"></script>
	<script src="{{ asset('rollie/js/fullcalendar.bundle.js')}}" type="text/javascript"></script>
	<script src="{{ asset('rollie/js/dashboard.js')}}" type="text/javascript"></script>
    <script src="{{ asset('generalStyle/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('generalStyle/js/popper.min.js') }}"></script>
    <script src="{{ asset('generalStyle/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('rollie/js/html-table.js') }}"></script>
    <script src="{!! asset('generalStyle/plugins/sweetalert/wow.min.js') !!}"></script>
    <script>
    	function ts_awal() 
    	{
    		var ts_awal_1 = $('#ts_awal_1').val()*1;
    		var ts_awal_2 = $('#ts_awal_2').val()*1;
    		if(ts_awal_1 === '')
    		{
    			ts_awal_1 = 0;
    		}
    		if (ts_awal_2 === '') 
    		{
    			ts_awal_2 = 0 ;
    		}
    		var ts_awal_sum = (ts_awal_1+ts_awal_2)/2;
    		document.getElementById('ts_awal_sum').value = ts_awal_sum.toFixed(3);
    		ubah_status_akhir();

    	}

    	function ts_tengah() 
    	{
    		var ts_tengah_1 = $('#ts_tengah_1').val()*1;
    		var ts_tengah_2 = $('#ts_tengah_2').val()*1;
    		if(ts_tengah_1 === '')
    		{
    			ts_tengah_1 = 0;
    		}
    		if (ts_tengah_2 === '') 
    		{
    			ts_tengah_2 = 0 ;
    		}
    		var ts_tengah_sum = (ts_tengah_1+ts_tengah_2)/2;
    		document.getElementById('ts_tengah_sum').value = ts_tengah_sum.toFixed(3);
    		ubah_status_akhir();
    	}

    	function ts_akhir() 
    	{
    		var ts_akhir_1 = $('#ts_akhir_1').val()*1;
    		var ts_akhir_2 = $('#ts_akhir_2').val()*1;
    		if(ts_akhir_1 === '')
    		{
    			ts_akhir_1 = 0;
    		}
    		if (ts_akhir_2 === '') 
    		{
    			ts_akhir_2 = 0 ;
    		}
    		var ts_akhir_sum = (ts_akhir_1+ts_akhir_2)/2;
    		document.getElementById('ts_akhir_sum').value = ts_akhir_sum.toFixed(3);
    		ubah_status_akhir();
    	}

    	function ubah_status_akhir() 
    	{
    		var	ts_awal 		= $('#ts_awal_sum').val();
    		var	ts_akhir 		= $('#ts_akhir_sum').val();
    		var	ts_tengah 		= $('#ts_tengah_sum').val();
    		var	ph_awal 		= $('#ph_awal_sum').val();
    		var	ph_tengah 		= $('#ph_tengah_sum').val();
    		var	ph_akhir 		= $('#ph_akhir_sum').val();
    		var spek_ts_min 	= $('#spek_ts_min').val();
    		var spek_ts_max 	= $('#spek_ts_max').val();
    		var spek_ph_min 	= $('#spek_ph_min').val();
    		var spek_ph_max 	= $('#spek_ph_max').val();
    		var sensory_awal 	= $('#sensory_awal').val();
    		var sensory_tengah 	= $('#sensory_tengah').val();
    		var sensory_akhir 	= $('#sensory_akhir').val();
    		// var status_akhir 	= ;
    		if (ts_awal !== '' && ts_akhir !== '' && ts_tengah !== '' && ph_awal !== '' && ph_tengah !== '' && ph_akhir !== '' && sensory_awal !== '' && sensory_awal !== null && sensory_tengah !== '' && sensory_tengah !== null && sensory_akhir !== '' && sensory_akhir !== null ) 
    		{
    			if ( ts_awal < spek_ts_min || ts_tengah < spek_ts_min || ts_akhir < spek_ts_min || ts_awal > spek_ts_max || ts_tengah > spek_ts_max || ts_akhir > spek_ts_max) 
				{
					if ($('#status_akhir').val().includes('TS OK')) 
					{
						document.getElementById('status_akhir').value 	= $('#status_akhir').val().replace('TS OK','TS #OK');
					} 
					else if($('#status_akhir').val().includes('TS #OK'))
					{
						document.getElementById('status_akhir').value 	= $('#status_akhir').val();
					}
					else
					{
						document.getElementById('status_akhir').value 	= $('#status_akhir').val()+"TS #OK ";
					}
				}
				else
				{
					if ($('#status_akhir').val().includes('TS #OK')) 
					{
						document.getElementById('status_akhir').value 	= $('#status_akhir').val().replace('TS #OK','TS OK');
					} 
					else if($('#status_akhir').val().includes('TS OK'))
					{
						document.getElementById('status_akhir').value 	= $('#status_akhir').val();
					}
					else
					{
						document.getElementById('status_akhir').value 	= $('#status_akhir').val()+"TS OK ";
					}	
				}
				if (ph_awal < spek_ph_min || ph_awal > spek_ph_max || ph_tengah < spek_ph_min || ph_tengah > spek_ph_max || ph_akhir < spek_ph_min || ph_akhir > spek_ph_max) 
				{
					// $('#status_akhir').val()
					if ($('#status_akhir').val().includes('pH OK')) 
					{
						document.getElementById('status_akhir').value 	= $('#status_akhir').val().replace('pH OK','pH #OK');
					} 
					else if ($('#status_akhir').val().includes('pH #OK'))
					{
						document.getElementById('status_akhir').value 	= $('#status_akhir').val();
					}	
					else
					{
						document.getElementById('status_akhir').value 	= $('#status_akhir').val()+"pH #OK ";
					}
				}
				else
				{
					if ($('#status_akhir').val().includes('pH #OK')) 
					{
						document.getElementById('status_akhir').value 	= $('#status_akhir').val().replace('pH #OK','pH OK');
					} 
					else if ($('#status_akhir').val().includes('pH OK'))
					{
						document.getElementById('status_akhir').value 	= $('#status_akhir').val();
					}	
					else
					{
						document.getElementById('status_akhir').value 	= $('#status_akhir').val()+"pH OK ";
					}		
				}
				
				if (sensory_awal !== 'OK' || sensory_tengah !== 'OK' || sensory_akhir !== 'OK')
				{
					if($('#status_akhir').val().includes('Sensory OK'))
					{
						document.getElementById('status_akhir').value 	= $('#status_akhir').val().replace('Sensory OK','Sensory #OK');
					}
					else if ($('#status_akhir').val().includes('Sensory #OK')) 
					{
						document.getElementById('status_akhir').value 	= $('#status_akhir').val();
					} 
					else 
					{
						document.getElementById('status_akhir').value 	= $('#status_akhir').val()+"Sensory #OK "
					}	
				}
				else
				{
					if($('#status_akhir').val().includes('Sensory #OK'))
					{
						document.getElementById('status_akhir').value 	= $('#status_akhir').val().replace('Sensory #OK','Sensory OK');
					}
					else if ($('#status_akhir').val().includes('Sensory OK')) 
					{
						document.getElementById('status_akhir').value 	= $('#status_akhir').val();
					} 
					else 
					{
						document.getElementById('status_akhir').value 	= $('#status_akhir').val()+"Sensory OK"
					}	
				}
    		} 
    	}
    </script>
    
	 <script>
	        const flashdatas = $('.failed').data('flashdata');
	        if(flashdatas){
	            swal({
	                title: "Proses Gagal",
	                text: flashdatas,
	                type: "error",
	            });
	        }
	        const flashdata = $('.success').data('flashdata');
	        if(flashdata){
	            swal({
	                title: "Proses Berhasil",
	                text: flashdata,
	                type: "success",
	            });
	        }
	        const flashdatai = $('.info').data('flashdata');
	        if(flashdatai){
	            swal({
	                title: "Proses Berhasil",
	                text: flashdatai,
	                type: "info",
	            });
	        }
	        $('#myModal').on('shown.bs.modal', function () {
	            $('#myInput').trigger('focus')
	        });
	        new WOW().init();
	    </script>
	@if (Route::currentRouteName()==='analisa-produk')
		<script src="{{ asset('generalStyle/plugins/datetime-picker/js/jquery.min.js') }}"></script>
	    <link rel="stylesheet" href="{{ asset('generalStyle/plugins/datetime-picker/css/bootstrap.css') }}">
	    <link rel="stylesheet" href="{{ asset('generalStyle/plugins/datetime-picker/css/bootstrap-datetimepicker.min.css') }}">
	    <script type="text/javascript" src="{{ asset('generalStyle/plugins/datetime-picker/js/moment.min.js') }}"></script>
	    <script type="text/javascript" src="{{ asset('generalStyle/plugins/datetime-picker/js/bootstrap-datetimepicker.min.js') }}"></script>
	    <script type="text/javascript" src="{{ asset('generalStyle/plugins/datetime-picker/js/bootstrap-datetimepicker.min.js') }}"></script>
	    <script>
	        $('.datetimepickernya').datetimepicker({
	            format: 'YYYY-MM-DD HH:mm:ss'
	        }); 
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
	    </script>
	@endif
    {{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> --}}
</body>
<!-- end::Body -->
</html>

