<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{!!asset('utilityOnline/css/bootstrap.min.css')!!}">
    <link rel="stylesheet" href="{!!asset('utilityOnline/css/bootstrap.css')!!}">
    <link rel="stylesheet" href="{!!asset('utilityOnline/fonts/icon/font-awesome.min.css')!!}">
    <link rel="stylesheet" href="{!!asset('utilityOnline/css/style.css')!!}">
    <link rel='stylesheet' href="{!! asset('generalStyle/plugins/select2/css/select2.min.css') !!}">
    <script src="{!! asset('masterApps/js/jquery-3.3.1.min.js') !!}"></script>

    <style>
        .dataTables_filter
        {
            display: none; 
        }
        .dataTables_length 
        {
            display: none; 
        }
        .dataTables_info
        {
            color: white;
        }
        .img-bg
        {
            background-position: center;
            background-size: cover;
            width: 120%;
            height: 100%;
            z-index: 9;
        }
        .back-img-bg
        {
            width: 101.1%;
            opacity: 0.8;
        }
        @media only screen and (min-width: 920px)
        {
            .img-bg
            {
                background-position: 0 0px;
                height: 100%;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark bbotom" style="background-color: #1f1f1f;">
        <a class="navbar-brand" href="/sentul-apps/utility-online">
            Utility Online
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="#">Home 
                    <span class="sr-only">(current)</span>
                </a>
                <a class="nav-item nav-link" href="#">User Guide</a>
                <a class="nav-item nav-link" href="#">Help</a>
            </div>
            <div class="navbar-nav ml-auto mr-5">
                <div class="dropdown">
                    <a class="dropdown-toggle mr-2 text-white" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Hello, {{ $username }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="#">Profile</a>
                        <a class="dropdown-item" href="/sentul-apps/logout">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </nav> 
    <div class="text-white" style="background: #d8dad5;">
        <span class="justify-content-start d-flex mr-3 pb-1" style="margin-right: 10px">
            <a href="/sentul-apps/utility-online" class="text-white">
                <i class="fa fa-home text-success mr-5">Utility Online</i>
            </a>
        </span>
    </div>
    @if ($message = Session::get('success'))
        <div class="success" data-flashdata="{{ $message }}"></div>
    @endif
    @if ($message = Session::get('failed'))
        <div class="failed" data-flashdata="{{ $message }}"></div>
    @endif
    @yield('content')

<script src="{{ asset('generalStyle/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
<script src="{!! asset('generalStyle/plugins/sweetalert/wow.min.js') !!}"></script>
<script src="{{ asset('generalStyle/js/popper.min.js') }}"></script>
<script src="{{ asset('generalStyle/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('generalStyle/plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('utilityOnline/js/particles.min.js') }}" ></script>
<script src="{{ asset('utilityOnline/js/app.js') }}"></script>
<link rel="stylesheet" href="{{ asset('utilityOnline/admin/modules/datatables/datatables.min.css')}}">
<link rel="stylesheet" href="{{ asset('utilityOnline/admin/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
<script src="{{ asset('utilityOnline/admin/modules/datatables/datatables.min.js')}}"></script>
<script src="{{ asset('utilityOnline/admin/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('utilityOnline/admin/modules/datatables/Select-1.2.4/js/dataTables.select.min.js')}}"></script>

<script>
$('.data-tables-to-do-list').dataTable(
    {
        pageLength:5
    }
);
$('.tablePreview').dataTable(
    {
        pageLength:5
    }
);
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
    $('.select2').select2();
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    });
    
    new WOW().init();
</script>
</body>
</html>