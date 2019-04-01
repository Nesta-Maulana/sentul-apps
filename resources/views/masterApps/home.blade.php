@extends('masterApps.templates.layout')
@section('title')
    Master Apps
@endsection
@section('subtitle')
    Kategori
@endsection
@section('content')
    <h1 style="font-size: 60px" class="d-flex justify-content-center"><span class="wow slideInLeft animated">Selamat</span> &ensp;<span class="text-primary wow slideInRight animated"> Datang</span></h1>
    <h1 class="text-primary d-flex justify-content-center wow fadeInDown animated">Sentul Integration System</h1>    

    <div class="row mt-5 text-center">
        <div class="col mt-3 s12 text-white bg-primary mr-3 ml-3 p-3 rounded wow slideInLeft animated" data-wow-delay="0.05s">
            <h1 style="font-size: 50px">Cepat</h1>
            <h1 class="d-flex justify-content-center" style="font-size: 50px"><i class="fa fa-bolt"></i></h1>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cupiditate, maxime.</p>
        </div>
        <div class="col mt-3 s12 text-white bg-primary mr-3 p-3 rounded wow slideInLeft animated" data-wow-delay="0.05s">
            <h1 style="font-size: 50px">Mudah</h1>
            <h1 class="d-flex justify-content-center" style="font-size: 50px"><i class="fa fa-check"></i></h1>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cupiditate, maxime.</p>
        </div>
        <div class="col mt-3 s12 ml-3 text-white bg-primary mr-3 p-3 rounded wow slideInRight animated" data-wow-delay="0.05s">
            <h1 style="font-size: 50px">Easy</h1>
            <h1 class="d-flex justify-content-center" style="font-size: 50px"><i class="fa fa-user"></i></h1>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cupiditate, maxime.</p>
        </div>
        <div class="col mt-3 ml-3 s12 text-white bg-primary mr-3 p-3 rounded wow slideInRight animated" data-wow-delay="0.05s">
            <h1 style="font-size: 50px">Efektif</h1>
            <h1 class="d-flex justify-content-center" style="font-size: 50px"><i class="fa fa-clock-o"></i></h1>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cupiditate, maxime.</p>
        </div>
    </div>

    {{-- <script src="{!! asset('masterApps/js/jquery-3.3.1.min.js') !!}"></script> --}}
@endsection