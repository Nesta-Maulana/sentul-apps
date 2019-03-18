@extends('utilityOnline.templates.layout')
@section('title')
    Utility Online | Home
@endsection
@section('content')

<div id="particles-js"></div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-4 mt-4 justify-content-center d-flex">
            <button class="btn btn-success tombol"><a class="text-white" href="#"><h1 class="judul">Energy</h1></button></a>
        </div>
        <div class="col-lg-4 mt-4 justify-content-center d-flex">
            <button class="btn btn-success tombol"><a class="text-white" href="utility-online/water"><h1 class="judul">Air</h4></button></a>
        </div>
        <div class="col-lg-4 mt-4 justify-content-center d-flex">
            <button class="btn btn-success tombol"><a class="text-white" href="#"><h1 class="judul">Utility</h1></button></a>
        </div>
        <div class="col-lg-4 mt-4 justify-content-center d-flex">
            <button class="btn btn-success tombol"><a class="text-white" href="utility-online/database"><h1 class="judul">Database</h1></button></a>
        </div>
    </div>
</div>
@endsection