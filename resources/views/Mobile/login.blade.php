@extends('mobile.templates.layout')
@section('judul')
    Login
@endsection
@section('content')
    
@if ($message = Session::get('failed'))
    <div class="failed" data-flashdata="{{ $message }}"></div>
@endif
<div class="container">
    <div class="row mt-5">
    <div class="col-lg-2"></div>
    <div class="col-lg-8 s12 bg-white rounded p-3 mt-4 user-login">

        <form action="login-form" method="post">
            {{ csrf_field() }}
            <div class="container">
                <img src="{!!asset('Mobile-Style/img/logo.png')!!}" class="img-fluid rounded-circle mx-auto d-block hero mb-5" width="120" height="120" alt="">
                <div class="konten"></div> 
                <h1 class="title d-flex justify-content-center">MOLLIE</h1>
                <div class="konten mb-3"></div>
                <div class="form-group">
                    <i class="fa fa-envelope label"></i> <label for="email" class="label" data_icon="u">Email address</label>
                    <input type="email" name="email" class="form-control text" id="email" aria-describedby="emailHelp" placeholder="example : nestamaulana@nutrifood.co.id" autocomplete="off">
                </div>
                <div class="form-group">
                    <i class="fa fa-key text-black label"></i> <label class="label" for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control text" id="exampleInputPassword1" placeholder="eg. S311135T4">
                </div>
                    <input type="submit" class="login pl-4 pr-4" value="Login">
            </div>
        </form>

        <p class="mt-1 float-right label">Dont have an account ? <a href="register-form" class="register btn btn-primary">Join with us</a></p>
        
    </div>
    </div>
</div>

<script src="{!! asset('Mobile-Style/superAdmin/js/jquery-3.3.1.min.js') !!}"></script>
<script src="{{ asset('Mobile-Style/js/sweetalert2.all.min.js') }}"></script>
<script>
const flashdata = $('.failed').data('flashdata');
if(flashdata){
    swal({
    title: "Failed",
    text: flashdata,
    type: "error",
});
}
</script>
@endsection
