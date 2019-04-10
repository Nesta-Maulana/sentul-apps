<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en" >
	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>
			@yield('title')
		</title>
		<meta name="description" content="Latest updates and statistic charts">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!--begin::Web font -->
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
          WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
		</script>
		<!--end::Web font -->
        <!--begin::Base Styles -->  
        <!--begin::Page Vendors -->
		<link href="{{ asset('rollie/css/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Page Vendors -->
		<link href="{{ asset('rollie/css/vendors.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('rollie/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('rollie/css/custom.css')}}" rel="stylesheet" type="text/css" />
	
		<!--end::Base Styles -->

        <!-- My CSS -->
        <link rel="stylesheet" href="{!!asset('utilityOnline/css/bootstrap.css')!!}">
        <link rel="stylesheet" href="{!!asset('utilityOnline/fonts/icon/font-awesome.min.css')!!}">
        <link rel="stylesheet" href="{!! asset('generalStyle/plugins/select2/css/select2.min.css') !!}">
        <script src="{!! asset('masterApps/mobileStyle/superAdmin/js/jquery-3.3.1.min.js') !!}"></script>
		<link rel="shortcut icon" href="{{ asset('rollie/img/logo/favicon.ico')}}" />
        <link rel="stylesheet" href="{!!asset('utilityOnline/css/bootstrap.min.css')!!}">
		<link href="{{ asset('dataTables/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{ asset('dataTables/css/fixedColumns.dataTables.min.css')}}" rel="stylesheet">

	</head>

	<!-- end::Head -->
    <!-- end::Body -->
	<body  class="m-page--wide m-header--fixed m-header--fixed-mobile m-footer--push m-aside--offcanvas-default"  >
		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<!-- begin::Header -->
			<header id="m_header" class="m-grid__item m-header "  minimize="minimize" minimize-offset="200" minimize-mobile-offset="200" >
				<div class="m-header__top">
					<div class="m-container m-container--responsive m-container--xxl m-container--full-height m-page__container">
						<div class="m-stack m-stack--ver m-stack--desktop">
							<!-- begin::Brand -->
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
										<!-- begin::Responsive Header Menu Toggler-->
										<a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
											<span></span>
										</a>
										<!-- end::Responsive Header Menu Toggler-->
										<!-- begin::Topbar Toggler-->
										<a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
											<i class="flaticon-more"></i>
										</a>
										<!--end::Topbar Toggler-->
									</div>
								</div>
							</div>
							<!-- end::Brand -->		
				<!-- begin::Topbar -->
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
														Nick
													</span>
												</a>
												<div class="m-dropdown__wrapper">
													<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
													<div class="m-dropdown__inner">
														<div class="m-dropdown__header m--align-center back">
															<div class="m-card-user m-card-user--skin-dark">
																<div class="m-card-user__pic">
																	<img src="{{ asset('rollie/img/users/user4.jpg')}}" class="m--img-rounded m--marginless" alt=""/>
																</div>
																<div class="m-card-user__details">
																	<span class="m-card-user__name m--font-weight-500">
																		Mark Andre
																	</span>
																	<a href="" class="m-card-user__email m--font-weight-300 m-link">
																		mark.andre@gmail.com
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
																		<a href="profile.html" class="m-nav__link">
																			<i class="m-nav__link-icon flaticon-profile-1"></i>
																			<span class="m-nav__link-title">
																				<span class="m-nav__link-wrap">
																					<span class="m-nav__link-text">
																						My Profile
																					</span>
																					<span class="m-nav__link-badge">
																						<span class="m-badge m-badge--success">
																							2
																						</span>
																					</span>
																				</span>
																			</span>
																		</a>
																	</li>
																	
																	<li class="m-nav__separator m-nav__separator--fit"></li>
																	<li class="m-nav__item">
																		<a href="snippets/pages/user/login-1.html" class="btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">
																			Logout
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
							<!-- end::Topbar -->
						</div>
					</div>
				</div>
				<div class="m-header__bottom">
					<div class="m-container m-container--responsive m-container--xxl m-container--full-height m-page__container">
						<div class="m-stack m-stack--ver m-stack--desktop">
							<!-- begin::Horizontal Menu -->
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
							<!-- end::Horizontal Menu -->	
						</div>
					</div>
				</div>
			</header>
			<!-- end::Header -->		
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
            <!--begin:: Widgets/Stats-->
            <div class="m-content" >
                
                    @yield('content')    
                
            </div>

	<script src="{{ asset('rollie/js/vendors.bundle.js')}}" type="text/javascript"></script>
	<script src="{{ asset('rollie/js/scripts.bundle.js')}}" type="text/javascript"></script>
	<!--end::Base Scripts -->   
        <!--begin::Page Vendors -->
	<script src="{{ asset('rollie/js/fullcalendar.bundle.js')}}" type="text/javascript"></script>
	<!--end::Page Vendors -->  
        <!--begin::Page Snippets -->
	<script src="{{ asset('rollie/js/dashboard.js')}}" type="text/javascript"></script>
	<!--end::Page Snippets -->
    <!-- My JS -->
    <script src="{{ asset('masterApps/mobileStyle/js/sweetalert2.all.min.js') }}"></script>
    <script src="{!! asset('generalStyle/js/popper.min.js') !!}"></script>
    <script src="{!! asset('generalStyle/js/bootstrap.min.js') !!}"></script>
    <script src="{!! asset('generalStyle/plugins/select2/js/select2.min.js') !!}"></script>
    <script src="{!! asset('masterApps/mobileStyle/js/wow.min.js') !!}"></script>
	<script src=" {{ asset('dataTables/js/jquery.dataTables.min.js') }} "></script>
  <script src="{{asset('dataTables/js/jquery.dataTables2.min.js')}}"></script>
  <script src="{{asset('dataTables/js/dataTables.bootstrap.min.js')}}"></script>
  <script src="{{asset('dataTables/js/dataTables.fixedColumns.min.js')}}"></script>
    <script>
        $('.select2').select2();
        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        });
		new WOW().init();
		$('#analisa-kimia-table').DataTable({
    'paging'      : true,
    'lengthChange': true,
    'searching'   : true,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : false,
    'responsive' :true,
    'scrollX' : true,
    'processing' :true,
  });
    </script>
</body>
<!-- end::Body -->
</html>

