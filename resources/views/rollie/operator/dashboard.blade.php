@extends('rollie.operator.templates.layout')
@section('title')
    ROLLIE | Dashboard
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
                                @if ($wo->status == '3')
                                    <tr>
                                        <td>{{ $wo->nomor_wo }}</td>
                                        <td>{{ $wo->produk->nama_produk }}</td>
                                        <td>{{ $wo->production_realisation_date }}</td>
                                        <td class="text-center">{{ $wo->plan_batch_size }}</td>
                                        <td>{{ $wo->revisi_formula }}</td>
                                        <td>On Progress Fillpack</td>
                                        @if (is_null($wo->cppHead))
                                            <td>
                                                <a onclick="prosescpp('{{ $wo->produk->nama_produk }}','{{ $wo->nomor_wo }}','{{ app('App\Http\Controllers\resourceController')->enkripsi($wo->id) }}')">Proses Packing</a>
                                            
                                            </td>
                                        @elseif(!is_null($wo->cppHead))
                                            @php
                                                $cpp_id = app('App\Http\Controllers\resourceController')->enkripsi($wo->cppHead->id);
                                            @endphp
                                            <td>
                                                <a href="{{ route('operator-cpp',['cpp_head_id'=>$cpp_id]) }}">
                                                    Proses Packing
                                                </a>
                                                    
                                            </td>
                                        @endif
                                    </tr>
                                @endif
                                {{-- Pengecekan apakah wo tersebut brand HB atau bukan , apabila brand HB maka akan dilakukan pengecekan terhadap YOBASE yang support dengan produk tsb apakah tersedia atau belum .  --}}
                                <!-- @if ($wo->produk->subbrand->sub_brand !== 'HB') <tr> <td>{{ $wo->nomor_wo }}</td> <td>{{ $wo->produk->nama_produk }}</td> <td>{{ $wo->production_realisation_date }}</td> <td class="text-center">{{ $wo->plan_batch_size }}</td> <td>{{ $wo->revisi_formula }}</td> @switch($wo->status) @case('0') <td>Waiting Mixing</td> @break @case('1') <td>On Progress Mixing</td> @break @case('2') <td>Waiting Fillpack</td> @break @case('3') <td>On Progress Fillpack</td> @break @case('4') <td>Waiting For Close</td> @break @case('5') <td>Closed</td> @break @endswitch <td> <a onclick="prosescpp('<?=$wo->produk->nama_produk;?>','<?=$wo->nomor_wo?>')"> Proses Fillpack</a> </td> </tr> @else <tr> <td>{{ $wo->nomor_wo }}</td> <td>{{ $wo->produk->nama_produk }}</td> <td>{{ $wo->production_realisation_date }}</td> <td class="text-center">{{ $wo->plan_batch_size }}</td> <td>{{ $wo->revisi_formula }}</td> @switch($wo->status) @case('0') <td>Waiting Mixing</td> @break @case('1') <td>On Progress Mixing</td> @break @case('2') <td>Waiting Fillpack</td> @break @case('3') <td>On Progress Fillpack</td> @break @case('4') <td>Waiting For Close</td> @break @case('5') <td>Closed</td> @break @endswitch <td> <a href="aksi"> Proses Fillpack</a> </td> </tr> @endif --> 
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
	
@endsection
