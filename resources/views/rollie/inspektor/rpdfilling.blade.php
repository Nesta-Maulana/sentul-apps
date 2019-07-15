@extends('rollie.inspektor.template.layout')
@section('judul')
    {{ $menus[0]->aplikasi }} | RPD Filling
@endsection
@section('title')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div class="row">
    	@if ($rpd_filling_aktif->count() > 1)
	    	<div class="col-lg-3">
	    		<H3>RPD Filling</H3> 
	    	</div>
	    	<select name="produkrpd" id="produkrpd" class="col-lg-6 pull-left select form-control" style="padding: 0 .8rem" onchange="pindahrpd(this)">
            @foreach ($rpd_filling_aktif as $rpdaktif)
	            <option value="{{ app('App\Http\Controllers\resourceController')->enkripsi($rpdaktif->id) }}" @if ($rpdaktif->id == $rpd_filling->id)
	            	selected
	            @endif>{{ $rpdaktif->wo[0]->produk->nama_produk }}</option>        	
            @endforeach	
			</select>	
    	@else
			<div class="col-lg-12">
	    		<H3>RPD Filling {{ $rpd_filling->wo[0]->produk->nama_produk }}</H3> 
	    	</div>
    	@endif
    </div>
@endsection
@section('content')
	<hr>
	<input type="hidden" id="idrpdfillinghead" value="{{ app('App\Http\Controllers\resourceController')->enkripsi($rpd_filling->id) }}">
	
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-8">
					<div class="row form-group left">
						<label class="col-md-4">Nama Produk</label>
						<label class="col-md-1">:</label>
						<input type="text" value="{{ $rpd_filling->wo[0]->produk->nama_produk }}" class="form-control col-md-7" readonly>
					</div>
					<div class="row form-group left">
						<label class="col-md-4">Tanggal Produksi</label>
						<label class="col-md-1">:</label>
						<textarea class="form-control col-md-7" readonly><?php
							foreach ($rpd_filling->wo as $key => $value) 
							{
								$tampil = $value->nomor_wo." => ".$value->production_realisation_date."&#13;&#10;";
								echo $tampil;
							}
						?></textarea>
					</div>
					<div class="row form-group left">
						<label class="col-md-4">&Sigma; Batch</label>
						<label class="col-md-1">:</label>
						<input type="text" value="{{ $rpd_filling->wo->count() }} Batch" class="form-control col-md-7" readonly>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="row form-group left" id="popupubah">
						<div class="col-md-6">
							<a data-toggle="modal" data-target="#tambah-sample" onclick="hapusdatapopup()">
								<img src="{{ asset('generalStyle/images/logo/plus.png') }}" width="50px" alt="">
								Tambah Sample
							</a>
						</div>
						<div class="col-md-6">
							<a data-toggle="modal" data-target="#tambah-batch">
								<img src="{{ asset('generalStyle/images/logo/plus-red.png') }}" width="50px" alt="">
								Tambah Batch / Wo
							</a>
						</div>
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
				<table class="table" id="table-draft-analisa">
                    <thead>
                        <tr>
                            <th scope="col" >Nomor Wo</th>
                            <th scope="col" >Mesin Filling</th>
                            <th scope="col" style="display: none;">Tanggal Filling</th>
                            <th scope="col" >Jam Filling</th>
                            <th scope="col" >Jenis Sample</th>
                            <th scope="col" >Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="detail_pi">
                    	@foreach ($rpd_filling->detail_pi as $detail_pi)
                    		@if (is_null($detail_pi->airgap) && is_null($detail_pi->ts_accurate_kanan) && is_null($detail_pi->ts_accurate_kiri) && is_null($detail_pi->ls_accurate) && is_null($detail_pi->sa_accurate) && is_null($detail_pi->surface_check) && is_null($detail_pi->pinching) && is_null($detail_pi->strip_folding) && is_null($detail_pi->konduktivity_kanan) && is_null($detail_pi->konduktivity_kiri) && is_null($detail_pi->design_kanan) && is_null($detail_pi->design_kiri) && is_null($detail_pi->dye_test) && is_null($detail_pi->residu_h2o2) && is_null($detail_pi->prod_code_no_md) && is_null($detail_pi->correction))
                			<tr>
                    			<td>{{ $detail_pi->wo->nomor_wo }}</td>
                    			<td>{{ $detail_pi->mesin_filling->kode_mesin }}</td>
                    			<td style="display: none;">{{ $detail_pi->tanggal_filling }}</td>
                    			<td>{{ $detail_pi->jam_filling }}</td>
                    			<td>{{ $detail_pi->kode_sampel->kode_sampel }}</td>
                    			<td><a data-toggle="modal" data-target="#analisa-sample-pi" class="btn btn-warning white-text" onclick="analisa_sampel_pi('{{ $detail_pi->kode_sampel->kode_sampel }}','{{ ucwords($detail_pi->kode_sampel->event) }}','{{ $detail_pi->mesin_filling->kode_mesin }}','{{ $detail_pi->tanggal_filling }}','{{ $detail_pi->jam_filling }}','{{ app('App\Http\Controllers\resourceController')->enkripsi($detail_pi->id) }}','{{ $detail_pi->wo->produk->nama_produk }}','{{ app('App\Http\Controllers\resourceController')->enkripsi($detail_pi->wo->id) }}','{{ app('App\Http\Controllers\resourceController')->enkripsi($detail_pi->mesin_filling->id) }}')">ANALISA</a></td>
                    		</tr>
                    		@endif
                    	@endforeach
                    	@foreach ($rpd_filling->detail_at_event as $detail_at_event)
                    	@if (is_null($detail_at_event->ls_sa_sealing_quality) && is_null($detail_at_event->ls_sa_proportion) && is_null($detail_at_event->status_akhir))
                    		<tr>
                    			<td>{{ $detail_at_event->wo->nomor_wo }}</td>
                    			<td>{{ $detail_at_event->mesin_filling->kode_mesin }}</td>
                    			<td style="display: none;">{{ $detail_at_event->tanggal_filling }}</td>
                    			<td>{{ $detail_at_event->jam_filling }}</td>
                    			<td>{{ $detail_at_event->kode_sampel->kode_sampel }} ( Event )</td>
                    			<td><a data-toggle="modal" data-target="#analisa-sample-at-event" class="btn btn-danger white-text" onclick="analisa_sampel_at_event('{{ $detail_at_event->kode_sampel->kode_sampel }}','{{ ucwords($detail_at_event->kode_sampel->event) }}','{{ $detail_pi->mesin_filling->kode_mesin }}','{{ $detail_at_event->tanggal_filling }}','{{ $detail_at_event->jam_filling }}','{{ app('App\Http\Controllers\resourceController')->enkripsi($detail_at_event->id) }}','{{ app('App\Http\Controllers\resourceController')->enkripsi($detail_at_event->wo->id) }}','{{ app('App\Http\Controllers\resourceController')->enkripsi($detail_at_event->mesin_filling->id) }}')">ANALISA</a></td>
                    		</tr>
                    	@endif
                    	@endforeach
                    </tbody>
				</table>
			</div>
			<div class="row">
				<div class="col-lg-10"></div>
				<button class="btn btn-success col-lg-2" onclick="close_rpd($('#idrpdfillinghead').val())">Close RPD Filling</button>
				
			</div>
			@include('rollie.inspektor.popup-tambah-sample')
			@include('rollie.inspektor.popup-tambah-batch')
			@include('rollie.inspektor.popup-analisa-pi')
			@include('rollie.inspektor.popup-analisa-at-event')
		</div>
	</div>
	
@endsection