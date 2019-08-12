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
    ROLLIE | Resampling Analisa Mikro FG | {{ $analisaMikro->cppHead->wo[0]->produk->nama_produk }} <hr>
@endsection
@section('content')
	{!! Form::open(['route'=>'input-analisa-mikro','enctype'=>'multipart/form-data','method'=>'post']) !!}

    <input type="hidden" value="{{ app('App\Http\Controllers\resourceController')->enkripsi($analisaMikro->id) }}" name="analisa_mikro_head_id">
    <div class="row">
        <div class="col-lg-12">
             <div class="m-portlet">
                <h3 class="d-flex justify-content-center p-2 text-white" style="background: #716aca;">Data Analisa Mikro #OK</h3>
                <div class="row p-3">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body table-responsive" >
                                <table class="table table-bordered" id="proses-unok-analisa-mikro" style="overflow-x: none; ">
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
                                            <th title="Field #9" style="width: 7%;">Palet</th>
                                            <th title="Field #10" style="width: 7%;">Jam Palet</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($analisaMikro->analisaMikroDetail->sortBy('kode_sampel') as $analisaMikroDetail)
                                            @if ($analisaMikroDetail->status == 2)
                                                <tr>
                                                    <td>{{ $analisaMikroDetail->rpdFillingDetailPi->mesin_filling->kode_mesin }}</td>
                                                    <td>{{ $analisaMikroDetail->kode_sampel }}</td>
                                                    <td>{{ $analisaMikroDetail->jam_filling }}</td>
                                                    <td>{{ $analisaMikroDetail->suhu_preinkubasi }}</td>
                                                    <td>{{ number_format($analisaMikroDetail->ph,2,'.',',') }}</td>
                                                    <td>{{ $analisaMikroDetail->tpc }}</td>
                                                    @if ($analisaMikroDetail->rpdFillingDetailPi->wo->produk->kode_oracle == '7300861')
                                                    <td>{{ $analisaMikroDetail->yeast }}</td>
                                                    <td>{{ $analisaMikroDetail->mold }}</td>
                                                    @endif
                                                    @php
                                                        $datapalet                  = DB::connection('mysql4')->table('palet')->join('cpp_detail','palet.cpp_detail_id','=','cpp_detail.id')->select('palet.*','cpp_detail.nolot')->whereRaw("'".$analisaMikroDetail['jam_filling']."' BETWEEN `start` AND `end`")->get();
                                                        /*dd($datapalet);
                                                        $datapalet                  = DB::connection('mysql4')->select("SELECT * FROM palet  where '".$analisaMikroDetail['jam_filling']."' BETWEEN `start` AND `end`");
                                                        dd($datapalet);*/
                                                        $cpp_detail     = array();
                                                        $paletfix       = array();
                                                        foreach($analisaMikroDetail->rpdFillingDetailPi->wo->cppDetail as $cppDetail)
                                                        {   
                                                            array_push($cpp_detail, $cppDetail->id);
                                                        }
                                                        foreach ($datapalet as $palet) 
                                                        {
                                                            if (in_array($palet->cpp_detail_id, $cpp_detail)) 
                                                            {
                                                                array_push($paletfix,$palet);
                                                            }
                                                        }
                                                        $paletnya   = '';
                                                        $jampalet   = '';
                                                        foreach ($paletfix as $paletfixs) 
                                                        {
                                                            $paletnya .=$paletfixs->nolot.'-'.$paletfixs->palet.',';
                                                            $jampalet .=$paletfixs->start.' s/d '.$paletfixs->end.',';
                                                        }
                                                        $paletnya   = rtrim($paletnya,',');
                                                        $jampalet   = rtrim($jampalet,',');

                                                    @endphp
                                                    <td>{{ $paletnya }}</td>
                                                    <td>{{ $jampalet }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
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