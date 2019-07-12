@extends('userAccess.layout')
@section('judul')
    Home
@endsection
@section('content')

@if($hakAkses)
    <div class="container">
        <div class="row mt-5 text-white d-flex justify-content-center">
            @foreach($hakAkses as $h)
                <div class="col-lg-4 bg-primary p-3 rounded mr-3 shadow ml-3 mt-2">
                    <h3 class="text-center">{{$h->aplikasi}}</h3>
                    <hr class="bg-white">
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cupiditate, odio?</p>
                    <a href="{{ $h->link }}" class="btn btn-secondary d-flex justify-content-center" style="box-shadow: 1px 1px 5px black">GO</a>
                </div>
            @endforeach
        </div>
    </div>
@else
    <div class="container">
        <h1 class="display-4">Harap Hubungi <span>Admin</span> Untuk <br> Request <span> Hak Akses Aplikasi</span> atau Klik Menu Help</h1>
    </div>
@endif

@endsection