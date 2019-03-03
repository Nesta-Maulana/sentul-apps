@extends('masterApps.mobile.templates.layout')
@section('judul')
    Home
@endsection
@section('content')

<div class="container">
    <div class="row mt-5 text-white d-flex justify-content-center">
        @foreach($hakAkses as $h)
            <div class="col-lg-4 bg-primary p-3 rounded mr-3 shadow ml-3 mt-2">
                <h3 class="text-center">{{$h->aplikasi}}</h3>
                <hr class="bg-white">
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cupiditate, odio?</p>
                <a href="{{ $h->link }}" class="btn btn-secondary d-flex justify-content-center">GO</a>
            </div>
        @endforeach
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="success" data-flashdata="{{ $message }}"></div>
@endif


<script>
const flashdata = $('.success').data('flashdata');
if(flashdata){
    swal({
    title: "Failed",
    text: flashdata,
    type: "success",
});
}
</script>
@endsection