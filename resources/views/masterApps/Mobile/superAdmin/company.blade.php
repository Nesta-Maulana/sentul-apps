@extends('masterApps.Mobile.superAdmin.templates.layout')
@section('title')
    Master Apps
@endsection
@section('subtitle')
    Company
@endsection
@section('content')
<div id="particles-js"></div>
<div class="container">
    <div class="row">
        <div class="col ml-2 mt-5 teks pt-3 rounded">
            <table class="table bg-white">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Company</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>
                            <button class="btn btn-danger">Tidak Aktif</button>
                        </td>
                    </tr>
                    <tr>
                    <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>
                            <button class="btn btn-danger">Tidak Aktif</button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>
                            <button class="btn btn-success">Aktif</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="{{ asset('masterApps/mobileStyle/js/sweetalert2.all.min.js') }}"></script>
<script src="{!! asset('masterApps/mobileStyle/superAdmin/js/jquery-3.3.1.min.js') !!}"></script>
@endsection