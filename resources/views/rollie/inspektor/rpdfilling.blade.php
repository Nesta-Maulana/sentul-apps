@extends('rollie.operator.templates.layout')
@section('title')
    {{ $menus[0]->aplikasi }} | Dashboard
@endsection
@section('content')
	<hr>
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-8">
					<div class="row form-group left">
						<label class="col-md-4">Nama Produk</label>
						<label class="col-md-1">:</label>
						<input type="text" value="Hilo School Coklat 200Ml" class="form-control col-md-7" readonly>
					</div>
					<div class="row form-group left">
						<label class="col-md-4">Tanggal Produksi</label>
						<label class="col-md-1">:</label>
						<textarea class="form-control col-md-7" readonly>WO 1 - 4 April , Wo 2 - 5 April  WO 1 - 4 April , Wo 2 - 5 April</textarea>
					</div>
					<div class="row form-group left">
						<label class="col-md-4">&Sigma; Batch</label>
						<label class="col-md-1">:</label>
						<input type="text" value="4 Batch" class="form-control col-md-7" readonly>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="row form-group left">
						<div class="col-md-6">
							<a data-toggle="modal" data-target="#tambah-sample">
								<img src="{{ asset('generalStyle/images/logo/plus.png') }}" width="50px" alt="">
								Tambah Sample
							</a>
						</div>
						<div class="col-md-6">
							<a href="">
								<img src="{{ asset('generalStyle/images/logo/plus-red.png') }}" width="50px" alt="">
								Tambah Batch / Wo
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<table class="table display nowrap table-hover" id="table-draft-analisa">
                    <thead>
                        <tr>
                            <th scope="col" >Mesin Filling</th>
                            <th scope="col" >Jam Filling</th>
                            <th scope="col" >Jenis Sample</th>
                            <th scope="col" >Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    	@for ($i = 1; $i <= 100 ; $i++)
                    	<tr>
                    		<td>Data Data <?=$i?></td>
                    		<td>Data Data <?=$i?></td>
                    		<td>Data Data <?=$i?></td>
                    		<td>Data Data <?=$i?></td>
                    	</tr>
                    	@endfor
                    </tbody>
				</table>
			</div>
			@include('rollie.inspektor.popup-tambah-sample')

		</div>
	</div>

@endsection