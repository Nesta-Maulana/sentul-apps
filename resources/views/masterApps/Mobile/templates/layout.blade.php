<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('judul')</title>
    <link rel="stylesheet" href="{!!asset('masterApps/generalStyle/css/bootstrap.min.css')!!}">
    <link rel="stylesheet" href="{!!asset('masterApps/generalStyle/css/bootstrap.css')!!}">
    <link rel="stylesheet" href="{!!asset('masterApps/mobileStyle/css/style.css')!!}">
    <link rel="stylesheet" href="{!!asset('masterApps/generalStyle/fonts/icon/font-awesome.min.css')!!}">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    
</head>
<body>
    @yield('content')

@if ($message = Session::get('success'))
    <div class="success" data-flashdata="{{ $message }}"></div>
@endif

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
<script src="{{ asset('masterApps/mobileStyle/js/sweetalert2.all.min.js') }}"></script>
<script>
    const flashdatas = $('.failed').data('flashdata');
    if(flashdatas){
        swal({
            title: "Failed",
            text: flashdatas,
            type: "error",
        });
    }
    const flashdata = $('.success').data('flashdata');
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