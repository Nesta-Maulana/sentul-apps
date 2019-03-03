@extends('administrator.master')
@section('judul')
    Home
@endsection
@section('active-home')
    class="active"
@endsection
@section('content')
    <div class="row">
        <div class="col l8 offset-l2">
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <div style="color:#006794;text-align: center;font-family: serif;font-size: 35px;">
                            Hello , Nesta Maulana.
                        </div>
				    </div>
                    <div class="row center">
                        <img style="width: 400px;" src="{!!asset('dashboard_style/images/logo/logoya.png')!!}" >
                    </div>
                    <div class="row">
                        <div style="color: #006794;text-align: center;font-family: serif;font-size: 45px;">Mixing Data Management Sistem</div>
                        <div style="color: #006794;text-align: center;font-family: serif;font-size: 30px;">
                            PT. Nutrifood Indonesia Plant Sentul
                        </div>
                        <div style="color: #006794;text-align: center;font-family: serif;font-size: 25px;">
                            Coded <i class="fa fa-code"></i> With Love <i class="fa fa-heart"></i>
                        </div>
                        <div style="color: #006794;text-align: center;font-family: serif;font-size: 20px;font-weight:900">
                            &copy; 2018
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection