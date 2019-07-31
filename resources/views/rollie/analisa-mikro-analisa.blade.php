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
                                <div class="panel-body table-responsive">
                                    <table class="m-datatable table-bordered" id="proses-analisa-mikro" style="overflow-x: none;">
                                        <thead class="text-center">
                                            <tr>
                                                <th title="Field #1">
                                                    Mesin
                                                </th>
                                                <th title="Field #2">
                                                    Kode Sampel
                                                </th>
                                                <th title="Field #3">
                                                    Jam Filling
                                                </th>
                                                <th title="Field #4">
                                                    Suhu Preinkubasi
                                                </th>
                                                <th title="Field #5">
                                                    pH
                                                </th>
                                                <th title="Field #6">
                                                    TPC
                                                </th>
                                                <th title="Field #7">
                                                    Yeast
                                                </th>
                                                <th title="Field #8">
                                                    Mold
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
											@foreach ($analisaMikro->analisaMikroDetail->sortBy	('kode_sampel') as $detail)
												<tr>
													<td>{{ $detail->rpdFillingDetailPi->mesin_filling->kode_mesin }}</td>
													<td>{{ $detail->kode_sampel }}</td>
													<td>{{ $detail->jam_filling }}</td>
													<td>{{ $detail->suhu_preinkubasi }}</td>
													<td>{{ $detail->ph }}</td>
													<td></td>
													<td></td>
													<td></td>
												</tr>
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
	{!! Form::close() !!}	
@endsection