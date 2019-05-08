@extends('rollie.operator.templates.layout')
@section('judul')
    {{ $menus[0]->aplikasi }} | RPD Filling
@endsection
@section('title')
    <div class="row">
    	<div class="col-lg-2">
    		<H3> RPD Filling |</H3> 
    	</div>
    	<select name="produkrpd" id="produkrpd" class="col-lg-6 pull-left select form-control" style="padding: 0 .8rem">
            <option value="idnya1">Produk Satu</option>
            <option value="idnya2">Produk Dua</option>	
		</select>	
    </div>
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
<!-- 						<div class="col-md-6">
	<a data-toggle="modal" data-target="#tambah-batch">
		<img src="{{ asset('generalStyle/images/logo/plus-red.png') }}" width="50px" alt="">
		Tambah Batch / Wo
	</a>
</div> -->
					</div>
				</div>
			</div>

			<div class="row">
				<hr>
					<h5 class="col-lg-4 text-left">
						<strong>Draft Analisa Sample QC</strong>
						
					</h5>  
				<hr>
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
			@include('rollie.inspektor.popup-tambah-batch')

		</div>
	</div>

@endsection