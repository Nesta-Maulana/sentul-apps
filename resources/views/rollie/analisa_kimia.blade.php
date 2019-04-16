@extends('rollie.templates.layout2')
@section('title')
    Rollie | Analisa Kimia FG
@endsection
@section('active-home')
    m-menu__item--active
@endsection
@section('active-analisa-kimia')
    m-menu__item--active
@endsection
@section('subheader')
    <h2 class="text-center">ROLLIE | Analisa Kimia FG</h2>
@endsection
@section('content')
  	<div class="m-portlet m-portlet--mobile" style="background:#f0f0f0;">
        <h3 class="d-flex justify-content-center p-3 text-white font-weight-bold" style="background:linear-gradient(135deg, #5867dd 30%, #36a3f7 100%)">
            Table Analisa Kimia Produk Jadi
        </h3>
    </div>
    <div class="m-portlet__body" style="background:#f0f0f0;">
        <div class="form-inline row p-3">
        	<label for="nama_produk_filter" class="col-lg-2">Nama Produk </label>
            <select class="col-lg-4 form-control m-bootstrap-select " id="nama_produk_filter">
                <option value="">
                    All
                </option>
                <option value="HiLo Orange">
                    HiLo Orange
                </option>
                <option value="Heavenly Blush Orange">
                    Heavenly Blush Orange
                </option>
            </select>
        </div>
        <div class="form-inline row p-3">
        	<label for="tanggal_produksi_filter" class="col-lg-2">Tanggal Produksi</label>
            <select class="col-lg-4 form-control m-bootstrap-select " id="tanggal_produksi_filter">
                <option value="">
                    All
                </option>
                <option value="2019-04-15">
                    2019-04-15
                </option>
                <option value="2019-04-23">
                    2019-04-23
                </option>
            </select>
        </div>
        <div class="row p-3">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body table-responsive">
                        <table class="m-datatable table table-striped table-bordered" id="table-analisa-kimia" width="100%">
                            <thead class="text-center">
                                <tr>
                                    <th title="Field #1">
                                        Nama Produk
                                    </th>
                                    <th title="Field #2">
                                        Tanggal Produksi
                                    </th>
                                    <th title="Field #3">
                                        Status Analisa Kimia
                                    </th>
                                    <th title="Field #4" >
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            	<tr>
                            		<td>Heavenly Blush Orange</td>
                            		<td>2019-04-15</td>
                            		<td>Belum Analisa</td>
                            		<td>
                            			<input type="submit" class="btn m-btn btn-warning form-control" value="Analisa" onclick="document.location.href='{{ route("analisa-produk",["id"=>"1"]) }}'">
									</td>
                            	</tr>
                            	<tr>
                            		<td>HiLo Orange</td>
                            		<td>2019-04-23</td>
                            		<td>Belum Analisa</td>
                            		<td>
                                        <input type="submit" class="btn m-btn btn-warning form-control" value="Analisa" onclick="document.location.href='{{ route("analisa-produk",["id"=>"1"]) }}'">
                            		</td>
                            	</tr>
                                <tr>
                                    <td>HiLo Orange</td>
                                    <td>2019-04-23</td>
                                    <td>Belum Analisa</td>
                                    <td>
                                        <input type="submit" class="btn m-btn btn-warning form-control" value="Analisa" onclick="document.location.href='{{ route("analisa-produk",["id"=>"1"]) }}'">
                                    </td>
                                </tr>
                                <tr>
                                    <td>HiLo Orange</td>
                                    <td>2019-04-23</td>
                                    <td>Belum Analisa</td>
                                    <td>
                                        <input type="submit" class="btn m-btn btn-warning form-control" value="Analisa" onclick="document.location.href='{{ route("analisa-produk",["id"=>"1"]) }}'">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection