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
                                            <th title="Field #2" style="width: 7%;">
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
                                                        $datapalet                  = DB::connection('production_data')->table('palet')->join('cpp_detail','palet.cpp_detail_id','=','cpp_detail.id')->select('palet.*','cpp_detail.nolot')->whereRaw("'".$analisaMikroDetail['jam_filling']."' BETWEEN `start` AND `end`")->get();
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
                <h3 class="d-flex justify-content-center p-2 text-white" style="background: #716aca;">Data Resampling Analisa Mikro</h3>
                <div class="row p-3">
                    <div class="col-lg-12">                        
                        <input type="submit" class="btn btn-primary">
                    </div>
                </div>
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
                                        <tr></tr>
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