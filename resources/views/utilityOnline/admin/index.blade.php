@extends('utilityOnline.admin.templates.layout')
@section('title')
    Utility Online | Admin | Home
@endsection
@section('content')
    <div class="row mt-5 d-flex justify-content-center">
        <h1 class="text-primary">Welcome To Utility Online</h1>
    </div>
    <div class="row d-flex justify-content-center">
        <h1 class="d-flex justify-content-center" style="font-size: 200px">
            <!-- <img src="" alt=""> -->
            <i class="fa fa-laptop" aria-hidden="true"></i>
        </h1>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-lg-3 p-3 bg-primary m-2 text-center">
            <h2 class="text-white">Utility</h2>
        </div>
        <div class="col-lg-3 p-3 bg-primary m-2 text-center">
            <h2 class="text-white">ULLIE</h2>
        </div>
        <div class="col-lg-3 p-3 bg-primary m-2 text-center">
            <h2 class="text-white">Online</h2>
        </div>
    </div>
@endsection