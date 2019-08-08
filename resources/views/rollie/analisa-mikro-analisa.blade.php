@extends('rollie.templates.layout2')
@section('title')
    Rollie | Analisa Mikro
@endsection
@section('active-home')
    m-menu__item--active
@endsection
@section('active-analisa-mikro')
    m-menu__item--active
@endsection
@section('subheader')
    ROLLIE | Analisa Mikro FG | {{ $analisaMikro->cppHead->wo[0]->produk->nama_produk }} <hr>
@endsection
@section('content')
	{!! Form::open(['route'=>'input-analisa-mikro','enctype'=>'multipart/form-data','method'=>'post']) !!}
	<div class="row">
		<div class="col-lg-12">
			 <div class="m-portlet">
                <h3 class="d-flex justify-content-center p-2 text-white" style="background: #716aca;">Data Analisa Mikro</h3>
                <div class="row p-3">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body table-responsive" >
                                <table class="table table-bordered" id="proses-analisa-mikro" style="overflow-x: none; ">
                                    <thead class="text-center">
                                        <tr>
                                            <th title="Field #1" style="width: 7%;">
                                                Mesin
                                            </th>
                                            <th title="Field #2" style="width: 10%;">
                                                Kode Sampel
                                            </th>
                                            <th title="Field #3" style="width: 16%;">
                                                Jam Filling
                                            </th>
                                            <th title="Field #4" style="width: 7%;">
                                                Suhu
                                            </th>
                                            <th title="Field #5" style="width: 7%;">
                                                pH
                                            </th>
                                            <th title="Field #6" style="width: 7%;">
                                                TPC
                                            </th>
                                            @if ($analisaMikro->analisaMikroDetail[0]->rpdFillingDetailPi->wo->produk->kode_oracle == '7300861')
                                                <th title="Field #7" style="width: 7%;">
                                                    Yeast
                                                </th>
                                                <th title="Field #8" style="width: 7%;">
                                                    Mold
                                                </th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
										@foreach ($analisaMikro->analisaMikroDetail->sortBy('kode_sampel') as $detail)
											<tr>
                                                <input type="hidden" class="form-control" value="<?php 
                                                $id = '';
                                                foreach($detail->rpdFillingDetailPi->wo->cppDetail as $key => $cpp_detail)
                                                {
                                                    $id     .= $cpp_detail->id.',';
                                                }
                                                echo $id;
                                                ?>" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" name ="{{ $detail->id }}[cpp_detail]" maxlength="2" >
                                                <input type="hidden" value="{{ $detail->rpdFillingDetailPi->wo->produk->id }}" name="{{ $detail->id }}[produk_id]">

												<td>{{ $detail->rpdFillingDetailPi->mesin_filling->kode_mesin }}</td>
												<td style="text-align: center;">{{ $detail->kode_sampel }}</td>
												<td><input type="text" class="datetimepickernya form-control" value="{{ $detail->jam_filling }}" name ="{{ $detail->id }}[jam_filling]"></td>
												<td style="text-align: center;">{{ $detail->suhu_preinkubasi }}&deg;</td>
												<td><input type="text" class="form-control" value="7.50" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" maxlength="4" name ="{{ $detail->id }}[ph]"></td>
												<td><input type="text" class="form-control" value="0" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" maxlength="2" name ="{{ $detail->id }}[tpc]"></td>
												@if ($detail->rpdFillingDetailPi->wo->produk->kode_oracle == '7300861')
                                                    <td>
                                                        <input type="text" class="form-control" value="{{ $detail->yeast }}" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" maxlength="2" name ="{{ $detail->id }}[yeast]">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" value="{{ $detail->mold }}" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" name ="{{ $detail->id }}[mold]" maxlength="2">
                                                    </td>
                                                @endif
											</tr>
										@endforeach
                                            <tr>
                                                <td></td> 
                                                <td></td> 
                                                <td></td> 
                                                <td></td> 
                                                <td></td> 
                                                @if ($detail->rpdFillingDetailPi->wo->produk->kode_oracle == '7300861')
                                                    <td></td> 
                                                    <td></td>
                                                @endif 
                                               <td>
                                                    <button class="btn btn-info ">Simpan Hasil Analisa</button>
                                               </td> 
                                            </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
		</div>
	</div>
	{!! Form::close() !!}	
@endsection