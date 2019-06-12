<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Ganti Password</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="{{ asset('userAccess/css/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('userAccess/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />

</head>
 
<body

	class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
	<!-- begin:: Page -->
	<div class="m-grid m-grid--hor m-grid--root m-page">
		<div class="m-login m-login--signin  m-login--5" id="m_login"
			style="background-image: url('{{ asset('userAccess/img/bg/d.png') }}');background-position: center;background-repeat: no-repeat;background-size: cover;">
			<div class="m-login__wrapper-1 m-portlet-full-height">
				<div class="m-login__wrapper-1-1">
					<div class="m-login__contanier">
						<div class="m-login__content">
							<div class="m-login__logo">
								<a href="#">
									<img src="{{ asset('userAccess/img/logos/logo-2.png')}}">
								</a>
							</div>
							<div class="m-login__title">
								<h3 style="font-weight: 600;text-align:center; color:#001682">
									Sentul Integrated System
								</h3>
							</div>
							<div class="m-login__desc" style="font-size:20px;text-align: justify;color:#260394">
								Sentul integrated system is a system that connects all data of PT. Nutrifood
								Indonesia which was developed by
								Nesta Maulana and his team.
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="m-login__wrapper-2 m-portlet-full-height">
				<div class="m-login__contanier">
					<div class="m-login__signin">
						<div class="m-login__head">
							<h3 class="m-login__title"
								style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;color:#4a03a4;">
								Ganti Password
								<hr>
							</h3>
						</div>
						<form class="m-login__form m-form" action="/sentul-apps/ganti-user-password" method="post">
                    		{{ csrf_field() }}
                            <div class="form-group m-form__group">
								<input style="background-color:transparent;font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; " class="form-control m-input text-nesta" type="text" placeholder="Username" name="username"
									autocomplete="off" readonly value="{{ $username }}" autofocus>
							</div>
							<div class="form-group m-form__group">
								<input class="form-control m-input text-nesta" style="background-color:transparent;font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; "
									type="Password" placeholder="Password Lama" name="oldPassword">
							</div>
                            <div class="form-group m-form__group">
								<input class="form-control m-input text-nesta" style="background-color:transparent;font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; "
									type="Password" placeholder="Password Baru" name="newPassword">
							</div>
                            <div class="form-group m-form__group">
								<input class="form-control m-input m-login__form-input--last text-nesta" style="background-color:transparent;font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; "
									type="Password" placeholder="Confirm Password Baru" name="cNewPassword">
							</div>
							<div class="m-login__form-action">
								<button id="" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
									Change
								</button>
								<!-- <a href="login-form"  class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
									Back To Login
								</a> -->
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
    @if ($message = Session::get('failed'))
        <div class="failed" data-flashdata="{{ $message }}"></div>
    @endif
	@if ($message = Session::get('success'))
        <div class="success" data-flashdatas="{{ $message }}"></div>
    @endif
	<!-- end:: Page -->
	<!--begin::Base Scripts -->
	<script src="{{ asset('userAccess/js/vendors.bundle.js') }}" type="text/javascript"></script>
	<script src="{{ asset('userAccess/js/scripts.bundle.js') }}" type="text/javascript"></script>
	<!--end::Base Scripts -->
	<!--begin::Page Snippets -->
	<script src="{{ asset('userAccess/js/login.js') }}" type="text/javascript"></script>
	<!--end::Page Snippets -->
    <script>
        const flashdatas = $('.failed').data('flashdata');
        if(flashdatas){
            swal({
                title: "Failed",
                text: flashdatas,
                type: "error",
            });
        }
		const flashdata = $('.success').data('flashdatas');
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