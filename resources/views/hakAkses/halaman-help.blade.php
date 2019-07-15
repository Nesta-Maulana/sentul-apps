@extends('hakAkses.templates.layout')
@section('judul')
    Bantuan Pengguna
@endsection
@section('active-hak-akses')
    active
@endsection
@section('slogan')
    Do you have some <span>problem?</span>
@endsection
@section('link-to-content')
    #bantuan
@endsection
@section('href')
    Let's Help
@endsection
<?php $idUser = app('App\Http\Controllers\resourceController')->enkripsi(session()->get('login')) ?>
@section('content')
 <div class="row justify-content-center">
    <div class="col-12 info-panel">
        <div class="row">
            <div class="col-lg">
                <img src="{{ asset('generalStyle/images/logo/employee.png')}}" alt="Employee" class="float-left">
                <h4>Efficiency</h4>
                <p>Efisiensi pekerajaan SDM dan memaksimalkan kinerja-kinerja sdm yang ada demi mendukung perkembangan industri 4.0</p>
            </div>
            <div class="col-lg">
                <img src="{{ asset('generalStyle/images/logo/hires.png')}}" alt="Hires" class="float-left">
                <h4>Fastest</h4>
                <p>Menyelesai masalah anda dengan waktu seefisien mungkin dan dengan penyelesaian yang tepat juga cepat.</p>
            </div>
            <div class="col-lg">
                <img src="{{ asset('generalStyle/images/logo/security.png')}}" alt="Security" class="float-left">
                <h4>Security</h4>
                <p>Menjamin seluruh keamanan data anda dengan tingkat keamanan terbaik yang kami miliki.</p>
            </div>
        </div>
    </div>
</div>
<div class="row" id="bantuan">
    <div class="col-12 info-panel mt-5" style="background-color:#ecffff">
        <div class="row">
            <div class="col-lg">
                <img src="{{ asset('generalStyle/images/logo/user-credentials.png')}}" alt="Employee" class="float-left">
                <h4>Request User Access</h4>
                <p style="font-weight: 400;">Membutuhkan akses aplikasi atau menu-menu dalam aplikasi portal Sisy? Mari request akses yang kamu butuhkan <a href="{{ route('request-hak-akses-menu') }}">disini</a></p>
            </div>
            <div class="col-lg">
                <img src="{{ asset('generalStyle/images/logo/hires.png')}}" alt="Hires" class="float-left">
                <h4>Fastest</h4>
                <p>Menyelesai masalah anda dengan waktu seefisien mungkin dan dengan penyelesaian yang tepat juga cepat.</p>
            </div>
            <div class="col-lg">
                <img src="{{ asset('generalStyle/images/logo/security.png')}}" alt="Security" class="float-left">
                <h4>Security</h4>
                <p>Menjamin seluruh keamanan data anda dengan tingkat keamanan terbaik yang kami miliki.</p>
            </div>
        </div>        
    </div>
</div>


@endsection