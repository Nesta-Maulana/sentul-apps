<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('judul')</title>
    <link rel="stylesheet" href="{!!asset('generalStyle/css/bootstrap.min.css')!!}">
    <link rel="stylesheet" href="{!!asset('generalStyle/css/bootstrap.css')!!}">
    <link rel="stylesheet" href="{!!asset('userAccess/css/style.css')!!}">
    <link rel="stylesheet" href="{!!asset('generalStyle/fonts/icon/font-awesome.min.css')!!}">
    <script src="{!! asset('userAccess/js/js-slim.min.js') !!}"></script>
    
</head>
<body>
    @yield('content')

@if ($message = Session::get('success'))
    <div class="success" data-flashdata="{{ $message }}"></div>    
@endif
@if ($message = Session::get('failed'))
    <div class="failed" data-flashdatas="{{ $message }}"></div>    
@endif
<script src="{!! asset('generalStyle/js/popper.min.js') !!}"></script>
<script src="{!!asset('generalStyle/js/bootstrap.min.js')!!}"></script>
<script src="{{ asset('generalStyle/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
<script>
    const flashdatas = $('.failed').data('flashdatas');
    const flashdata = $('.success').data('flashdata');
    if(flashdatas){
        swal({
            title: "Failed",
            text: flashdatas,
            type: "error",
        });
    }
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