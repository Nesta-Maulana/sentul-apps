@extends('userAccess.layout')
@section('judul')
    Register
@endsection
@section('content')

    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-3"></div>
            <div class="col-lg-5 s12 bg-white rounded p-3 mt-4 user-login ml-5 mr-5">
                <div class="container">
                    <img src="{!!asset('userAccess/img/logo.png')!!}" class="img-fluid rounded-circle mx-auto d-block hero mb-5" width="120" height="120" alt="">
                    <div class="konten"></div> 
                    <h1 class="title d-flex justify-content-center">SISI</h1>
                    <div class="konten mb-3"></div>
                    <div class="form-group">
                        <i class="fa fa-user label"></i> <label for="name" class="label">Full Name</label>
                        <input type="text" class="form-control text" id="name" placeholder="example : Nesta maulana" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <i class="fa fa-envelope label"></i> <label for="email" class="label">Email address</label>
                        <input type="email" class="form-control text" id="email" aria-describedby="emailHelp" placeholder="example : nestamaulana@nutrifood.co.id" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <i class="fa fa-key text-black label"></i> <label class="label" for="password">Password</label>
                        <input type="password" class="form-control text" id="password" placeholder="eg. S311135T4">
                    </div>
                    <div class="form-group">
                        <i class="fa fa-user-secret text-black label"></i> <label class="label" for="confirm">Confirm your password</label>
                        <input type="password" class="form-control text" id="confirm" placeholder="eg. S311135T4">
                    </div>
                    <div class="form-group">
                        <i class="fa fa-exchange text-black label"></i> <label class="label" for="exampleInputPassword1">Role Apps</label>
                        <select name="" class="form-control text">
                            <option value="" selected disabled>Choose one rule what you want to access</option>
                            <option value="Administrator">Administrator</option>
                            <option value="R & D Produk">R & D Produk</option>
                        </select>
                    </div>
                        <input type="submit" class="login pl-4 pr-4" value="Login">
                </div>
                    <p class="mt-1 float-right label">Have an account ? <a href="{{route('halaman-login')}}" class="btn btn-primary register">Bring me to login</a></p>
            </div>
        </div>
    </div>

@endsection
