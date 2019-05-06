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
										<li class="m-menu__item @yield('active-cpp')"  aria-haspopup="true">
											<a  href="/sentul-apps/rollie/cpp" class="m-menu__link ">
												<span class="m-menu__item-here"></span>
												<span class="m-menu__link-text">
													CPP
												</span>
											</a>
										</li>
										<li class="m-menu__item  m-menu__item--submenu m-menu__item--rel @yield('active-analisa-kimia')"  m-menu-submenu-toggle="click" aria-haspopup="true">
											<a href="/sentul-apps/rollie/analisa-kimia-fg" class="m-menu__link m-menu__toggle">
												<span class="m-menu__item-here"></span>
												<span class="m-menu__link-text">
													Analisa Kimia FG
												</span>
											</a>
											<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
												<span class="m-menu__arrow m-menu__arrow--adjust"></span>
												
											</div>
										</li>
										<li class="m-menu__item  m-menu__item--submenu m-menu__item--rel @yield('active-rkj')"  m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
											<a  href="/sentul-apps/rollie/rkj" class="m-menu__link m-menu__toggle">
												<span class="m-menu__item-here"></span>
												<span class="m-menu__link-text">
													RKJ
												</span>
											</a>
											<div class="m-menu__submenu  m-menu__submenu--fixed m-menu__submenu--left" style="width:600px">
												<span class="m-menu__arrow m-menu__arrow--adjust"></span>
												<div class="m-menu__subnav">
													
												</div>
											</div>
										</li>
										<li class="m-menu__item  m-menu__item--submenu @yield('active-package')"  m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
											<a  href="/sentul-apps/rollie/package-integrity" class="m-menu__link m-menu__toggle">
												<span class="m-menu__item-here"></span>
												<span class="m-menu__link-text">
													Package Integrity
												</span>
											</a>
											<div class="m-menu__submenu  m-menu__submenu--fixed-xl m-menu__submenu--center" >
												<span class="m-menu__arrow m-menu__arrow--adjust"></span>
												<div class="m-menu__subnav">
													
												</div>
											</div>
										</li>
										<li class="m-menu__item  m-menu__item--submenu @yield('active-ppq')"  m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
											<a  href="/sentul-apps/rollie/ppq-fg" class="m-menu__link m-menu__toggle">
												<span class="m-menu__item-here"></span>
												<span class="m-menu__link-text">
													PPQ-FG
												</span>
											</a>
											<div class="m-menu__submenu  m-menu__submenu--fixed-xl m-menu__submenu--center" >
												<span class="m-menu__arrow m-menu__arrow--adjust"></span>
												<div class="m-menu__subnav">
													
												</div>
											</div>
										</li>
										<li class="m-menu__item  m-menu__item--submenu @yield('active-mikro')"  m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
											<a  href="/sentul-apps/rollie/analisa-mikro" class="m-menu__link m-menu__toggle">
												<span class="m-menu__item-here"></span>
												<span class="m-menu__link-text">
													Analisa Mikro
												</span>
											</a>
											<div class="m-menu__submenu  m-menu__submenu--fixed-xl m-menu__submenu--center" >
												<span class="m-menu__arrow m-menu__arrow--adjust"></span>
												<div class="m-menu__subnav">
													
												</div>
											</div>
										</li>
										<li class="m-menu__item  m-menu__item--submenu @yield('active-sortasi')"  m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
											<a  href="/sentul-apps/rollie/sortasi" class="m-menu__link m-menu__toggle">
												<span class="m-menu__item-here"></span>
												<span class="m-menu__link-text">
													Sortasi
												</span>
											</a>
											<div class="m-menu__submenu  m-menu__submenu--fixed-xl m-menu__submenu--center" >
												<span class="m-menu__arrow m-menu__arrow--adjust"></span>
												<div class="m-menu__subnav">
													
												</div>
											</div>
										</li>
										<li class="m-menu__item  m-menu__item--submenu @yield('active-rpr')"  m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
											<a  href="/sentul-apps/rollie/rpr" class="m-menu__link m-menu__toggle">
												<span class="m-menu__item-here"></span>
												<span class="m-menu__link-text">
													RPR
												</span>
											</a>
											<div class="m-menu__submenu  m-menu__submenu--fixed-xl m-menu__submenu--center" >
												<span class="m-menu__arrow m-menu__arrow--adjust"></span>
												<div class="m-menu__subnav">
													
												</div>
											</div>
										</li>
										<li class="m-menu__item  m-menu__item--submenu @yield('active-report')"  m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
											<a  href="/sentul-apps/rollie/reports" class="m-menu__link m-menu__toggle">
												<span class="m-menu__item-here"></span>
												<span class="m-menu__link-text">
													Reports
												</span>
											</a>
											<div class="m-menu__submenu  m-menu__submenu--fixed-xl m-menu__submenu--center" >
												<span class="m-menu__arrow m-menu__arrow--adjust"></span>
												<div class="m-menu__subnav">
													
												</div>
											</div>
										</li>
										<li class="m-menu__item  m-menu__item--submenu @yield('active-qa')"  m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
											<a  href="/sentul-apps/rollie/qa" class="m-menu__link m-menu__toggle">
												<span class="m-menu__item-here"></span>
												<span class="m-menu__link-text">
													QA
												</span>
											</a>
											<div class="m-menu__submenu  m-menu__submenu--fixed-xl m-menu__submenu--center" >
												<span class="m-menu__arrow m-menu__arrow--adjust"></span>
												<div class="m-menu__subnav">
												</div>
											</div>
										</li>
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
						<div>
                    </div>
                </div>
            </div>
            <div class="m-content" >
                @yield('content')    
            </div>
            @if ($message = Session::get('success'))
	    	    <div class="success" data-flashdata="{{ $message }}"></div>
		    @endif
		    @if ($message = Session::get('failed'))
		        <div class="failed" data-flashdata="{{ $message }}"></div>
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
        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        });
		new WOW().init();
    </script>
</body>
<!-- end::Body -->
</html>

