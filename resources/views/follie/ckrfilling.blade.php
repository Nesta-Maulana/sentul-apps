@extends('follie.layout.layout')
@section('title')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div class="row">
		<div class="col-lg-3">
			<H3>CKR Filling</H3> 
		</div>
    </div>
@endsection
@section('content')
	<hr>
	<input type="hidden" id="idrpdfillinghead">
	<div class="card">
		<div class="card-body">
                    <div class="form-group">
                        <label for="">Nama Produk</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Produksi</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">No. WO</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="row">
                        <div class="form-group" style="margin-left:20px;">   
                            <a data-target="" href="">
                                <i class="fa fa-circle fa-5x" style="color: green;"></i>
                                <p style="font-family: calibri; font-size: 18px; margin-top:-48px; color:white;" align="center"><b>Proses</b></p>
                            </a>
                        </div> 
                        <div class="form-group" style="margin-left:40px;">   
                            <a href="{{route('ckr.popup')}}" data-target="#pdt-popup" data-toggle="modal" >
                                <i class="fa fa-circle fa-5x" style="color: orange;"></i>
                                <p style="font-family: calibri; font-size: 18px; margin-top:-48px; color:white;" align="center"><b>PDT</b></p>
                            </a>
                        </div>  
                        <div class="form-group" style="margin-left:40px;">
                            <a href="" data-target="#updt-popup" data-toggle="modal" >
                                <i class="fa fa-circle fa-5x" style="color: red;"></i>
                                <p style="font-family: calibri; font-size: 18px; margin-top:-48px; color:white;" align="center"><b>UPDT</b></p>
                            </a>
                        </div> 
                    </div>
                    <br>
                <table class="table table-bordered" id="datatables" >
                    <thead>
                        <tr>
                            <th>Activity</th>
                            <th>Kategori BD</th>
                            <th>Penyebab BD</th>
                            <th>Start</th>
                            <th>Stop</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
				<div class="row">
				<div class="col-lg-10"></div>
				<button class="btn btn-success col-lg-2" >Close CKR Filling</button>
			</div>
			</div>
			
		</div>
	</div>
	@include('follie.pdt-popup')
	@include('follie.updt-popup')
@endsection