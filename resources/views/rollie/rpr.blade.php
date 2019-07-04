@extends('rollie.templates.layout2')
@section('title')
    Rollie | RPR
@endsection
@section('active-home')
    m-menu__item--active
@endsection
@section('active-rpr')
    m-menu__item--active
@endsection
@section('subheader')
    <h2 class="text-center">ROLLIE | RPR</h2>
@endsection
@section('content')

<div class="row">
        <div class="col-lg-12">
            <div class="m-portlet">
                <div>
                    <table class="m-datatable table table-striped table-bordered" width="100%" id="table-rpr" >
                        <thead class="back-purple text-white">
                            <tr>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Tanggal Produksi</th>
                                <th scope="col">Nomor WO</th>
                                <th scope="col">Nomor Lot</th>
                                <th scope="col">Tgl Selesai Filling</th>
                                <th scope="col">Mesin Filling</th>
                                <th scope="col">Brand</th>
                                <th scope="col">Mikro 30</th>
                                <th scope="col">Mikro 55</th>
                                <th scope="col">Kimia</th>
                                <th scope="col">Sortasi</th>
                                <th scope="col">PPQ</th>
                                <th scope="col">Estimasi Release</th>
                                <th scope="col">Status Mutu Akhir FG</th>
                                <th scope="col">Referensi Bar</th>
                                <th scope="col">Tanggal Bar</th>
                                <th scope="col">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($wos as $wo)
                                @if (!is_null($wo->cppHead) && $wo->cpphead->status=='1')
                                    @foreach ($wo->cppHead->cppDetail as $detail)
                                        @foreach ($detail->palet as $palet)
                                            <tr>
                                                <th scope="row">{{ $i }}</th>
                                                <td>{{ $wo->produk->nama_produk }}</td>
                                                <td>{{ $wo->production_realisation_date }}</td>
                                                <td>{{ $wo->nomor_wo }}</td>
                                                <td>{{ $detail->nolot }}-{{ $palet->palet }}</td>
                                                <td>{{ date('Y-m-d',strtotime($palet->end)) }}</td>
                                                <td>{{ $detail->mesinFilling->kode_mesin }}</td>
                                                <td>{{ $wo->produk->subBrand->sub_brand }}</td>
                                                <td>Belum Analisa</td>
                                                <td>Belum Analisa</td>
                                                <td>Belum Analisa</td>
                                                <td>-</td>
                                                <td>
                                                    @if (is_null($palet->ppq))
                                                        Tidak Ada PPQ
                                                    @else
                                                        @switch($palet->ppq->status_akhir)
                                                            @case('0')
                                                                On Progress PPQ
                                                            @break
                                                            @case('0')
                                                                OK
                                                            @break
                                                            @case('0')
                                                                #OK
                                                            @break
                                                        @endswitch
                                                        
                                                    @endif
                                                </td>
                                                <td><?php
                                                        $tanggalfilling = $palet->end;
                                                        $sla = "+".$wo->produk->sla." day";
                                                        $tanggalestimasi = strtotime($sla,strtotime($tanggalfilling));
                                                        echo date('Y-m-d',$tanggalestimasi);
                                                 ?></td>
                                                <td>On Progress</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                            </tr>
                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach
                                    @endforeach
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection