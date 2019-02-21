@extends('administrator.master')
@section('judul')
    LPM
@endsection
@section('active-lpm')
    class="active"
@endsection
@section('content')
    <div class="row">
        <div class="col l8 offset-l2">
                <a href="#!" class="breadcrumb" style="color:black;font-weight: 900;">LPM</a>
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <div class="col l6">
                            <div class="card-title">
                                <p style="color:black">Lembar Proses Mixing</p>
                                <hr class="col l7">
                            </div>
                        </div>
                        <div class="col l6">
                            
                        </div>
                    </div>
                    <table class="responsive-table">
                        <thead>
                            <tr>
                                <th>Kode Form</th>
                                <th>Nama Form</th>
                                <th>Kode Formula</th>
                                <th>Revisi Ke</th>
                                <th>Tanggal Berlaku</th>
                                <th style="text-align:center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>F.P.6AT1001</td>
                                <td>Laporan Proses Mixing HEAVENLY BLUSH YOGURT - HB YOGHURT STRAWBERRY - (HEAVENLY NUTRITION INDONESIA)</td>
                                <td>03/HBYS/2018-4.2</td>
                                <td>00</td>
                                <td>01.11.2018</td>
                                <td>
                                    <a hre  f="javascript:void(0)" class="btn waves-effect waves-light" style="background:#0CBEF2">Lihat</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection