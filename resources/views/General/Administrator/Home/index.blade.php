@extends('general.administrator.master')
@section('judul')
    Home
@endsection
@section('active-home')
    active
@endsection
@section('content')
    <div class="card">
        <div class="card-body" style="background:white">
            <div class="title-top text-primary d-flex justify-content-center">Welcome To </div>   
            <div class="title-bottom text-primary d-flex justify-content-center">
                Mixing Data Management System
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <img src="{!!asset('generalStyle/images/logo/logoya.png')!!}" alt="">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="company-text">
                        Copyright &copy;2018  PT. Nutrifood Indonesia
                    </div>
                </div>
            </div>   
            <div class="row">
                <div class="col-lg-12 text-center secondary-color-text">
                    <div class="coded-text">
                        Coded <i class="fa fa-code" style="color:darkgreen;font-weight: 900;"></i> With Love <i class="fa fa-heart" style="color:crimson"></i>
                    </div>
                </div>
            </div>    
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="version-text">
                        Alpha Version
                    </div>
                </div>
            </div>    
        </div>
    </div>
@endsection