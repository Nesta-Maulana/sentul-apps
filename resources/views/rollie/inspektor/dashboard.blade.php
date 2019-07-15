@extends('rollie.inspektor.template.layout')
@section('title')
    {{ $menus[0]->aplikasi }} | Dashboard
@endsection
@section('judul')
    {{ $menus[0]->aplikasi }} | Dashboard
@endsection
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
	<div class="row mt-5 mb-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <h4 class="header-title mb-0">Jadwal Produksi</h4>
                    </div>
                    <table class="display nowrap table table-hover" id="table-jadwal" width="100%">
                        <thead class="text-center">
                            <tr>
                                <th scope="col" >Nomor Wo</th>
                                <th scope="col" >Produk</th>
                                <th scope="col" >Tanggal Produksi</th>
                                <th scope="col" >Batch Size</th>
                                <th scope="col" >Formula</th>
                                <th scope="col" >Status</th>
                                <th scope="col" >Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($wos as $wo)
                                @if ( ($wo->status === '2' || is_null($wo->rpdFillingHead)))
                                    <tr>
                                        <td>{{ $wo->nomor_wo }}</td>
                                        <td>{{ $wo->produk->nama_produk }}</td>
                                        <td>{{ $wo->production_realisation_date }}</td>
                                        <td class="text-center">{{ $wo->plan_batch_size }}</td>
                                        <td>{{ $wo->revisi_formula }}</td>
                                        @switch($wo->status)
                                            @case('0')
                                                <td>Waiting Mixing</td>
                                            @break
                                            @case('1')
                                                <td>On Progress Mixing</td>
                                            @break
                                            @case('2')
                                                <td>Waiting Fillpack</td>
                                                <td>
                                                    <a onclick="prosesrpd('<?=$wo->produk->nama_produk;?>','<?=$wo->nomor_wo?>')"> Proses Fillpack</a>
                                                </td>
                                            @break
                                            @case('3')
                                                <td>On Progress Fillpack</td>
                                                <td>
                                                    @php
                                                        $rpd_id = app('App\Http\Controllers\resourceController')->enkripsi($wo->rpdFillingHead->id);
                                                    @endphp
                                                    <a href="{{ route('rpdfilling-inspektor-qc',['rpd_filling_head_id'=>$rpd_id]) }}"> Proses Fillpack</a>
                                                </td>
                                            @break
                                            @case('4')
                                                <td>Waiting For Close</td>
                                            @break
                                            @case('5')
                                                <td>Closed</td>
                                            @break
                                        @endswitch
                                    </tr>
                                @elseif( ($wo->status === '3' && is_null($wo->rpdFillingHead->status=='0')) )
                                    <tr>
                                        <td>{{ $wo->nomor_wo }}</td>
                                        <td>{{ $wo->produk->nama_produk }}</td>
                                        <td>{{ $wo->production_realisation_date }}</td>
                                        <td class="text-center">{{ $wo->plan_batch_size }}</td>
                                        <td>{{ $wo->revisi_formula }}</td>
                                        @switch($wo->status)
                                            @case('0')
                                                <td>Waiting Mixing</td>
                                            @break
                                            @case('1')
                                                <td>On Progress Mixing</td>
                                            @break
                                            @case('2')
                                                <td>Waiting Fillpack</td>
                                                <td>
                                                    <a onclick="prosesrpd('<?=$wo->produk->nama_produk;?>','<?=$wo->nomor_wo?>')"> Proses Fillpack</a>
                                                </td>
                                            @break
                                            @case('3')
                                                <td>On Progress Fillpack</td>
                                                <td>
                                                    @php
                                                        $rpd_id = app('App\Http\Controllers\resourceController')->enkripsi($wo->rpdFillingHead->id);
                                                    @endphp
                                                    <a href="{{ route('rpdfilling-inspektor-qc',['rpd_filling_head_id'=>$rpd_id]) }}"> Proses Fillpack</a>
                                                </td>
                                            @break
                                            @case('4')
                                                <td>Waiting For Close</td>
                                            @break
                                            @case('5')
                                                <td>Closed</td>
                                            @break
                                        @endswitch
                                    </tr>
                                @endif
                                {{-- Pengecekan apakah wo tersebut brand HB atau bukan , apabila brand HB maka akan dilakukan pengecekan terhadap YOBASE yang support dengan produk tsb apakah tersedia atau belum .  --}}
                                <!-- @if ($wo->produk->subbrand->sub_brand !== 'HB') <tr> <td>{{ $wo->nomor_wo }}</td> <td>{{ $wo->produk->nama_produk }}</td> <td>{{ $wo->production_realisation_date }}</td> <td class="text-center">{{ $wo->plan_batch_size }}</td> <td>{{ $wo->revisi_formula }}</td> @switch($wo->status) @case('0') <td>Waiting Mixing</td> @break @case('1') <td>On Progress Mixing</td> @break @case('2') <td>Waiting Fillpack</td> <td> <a onclick="prosesrpd('<?=$wo->produk->nama_produk;?>','<?=$wo->nomor_wo?>')"> Proses Fillpack</a> </td> @break @case('3') <td>On Progress Fillpack</td> <td> @php $rpd_id = app('App\Http\Controllers\resourceController')->enkripsi($wo->rpdFillingHead->id); @endphp <a href="{{ route('rpdfilling-inspektor-qc',['rpd_filling_head_id'=>$rpd_id]) }}"> Proses Fillpack</a> </td> @break @case('4') <td>Waiting For Close</td> @break @case('5') <td>Closed</td> @break @endswitch </tr> @else <tr> <td>{{ $wo->nomor_wo }}</td> <td>{{ $wo->produk->nama_produk }}</td> <td>{{ $wo->production_realisation_date }}</td> <td class="text-center">{{ $wo->plan_batch_size }}</td> <td>{{ $wo->revisi_formula }}</td> @switch($wo->status) @case('0') <td>Waiting Mixing</td> @break @case('1') <td>On Progress Mixing</td> @break @case('2') <td>Waiting Fillpack</td> @break @case('3') <td>On Progress Fillpack</td> @break @case('4') <td>Waiting For Close</td> @break @case('5') <td>Closed</td> @break @endswitch <td> <a href="aksi"> Proses Fillpack</a> </td> </tr> @endif --> 
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
	
@endsection
