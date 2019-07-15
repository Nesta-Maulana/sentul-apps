@extends('rollie.operator.templates.layout')
@section('title')
    ROLLIE | CPP
@endsection
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<input type="hidden" id="cpp_head_id" value="{{ app('App\Http\Controllers\resourceController')->enkripsi($cpps->id) }}">

<div class="row d-flex justify-content-center">
    <div class="bg-white col-lg-6 rounded mt-2">
        <hr>
        <div class="form-group">
            <label for="tglMixing">Tanggal Packing : </label>
            <input type="text" value="{{ $cpps->tanggal_packing }}" name="tglMixing" id="tglMixing" class="form-control" readonly>
        </div>
    </div>
    <div class="bg-white col-lg-6 rounded mt-2">
        <hr>
        <div class="form-group">
            <label for="produk">Nama Produk : </label>
            @if (count($cpp_aktif) > 1)
                <select name="nama_produk" id="nama_produk" onchange="pindahproduk(this)" class="form-control">
                    @foreach ($cpp_aktif as $cpp)
                        <option value="{{  app('App\Http\Controllers\resourceController')->enkripsi($cpp->id) }}" @if ($cpp->wo[0]->produk->id === $cpps->wo[0]->produk->id)
                            selected
                        @endif>{{ $cpp->wo[0]->produk->nama_produk }}</option>
                    @endforeach
                </select>
            @else
                <input type="text" value="{{ $cpps->wo[0]->produk->nama_produk }}" name="nama_produk" id="nama_produk" class="form-control" readonly>
            @endif
        </div>
    </div>

</div>
<div class="row d-flex justify-content-center">
    <div class="bg-white col-lg-6 rounded mt-2">
        <hr>
        <div class="form-group">
            <label for="noWo">No WO : </label>
            <select name="no_wo" id="no_wo" class="form-control" onchange="refreshcpp()">
                @foreach ($cpps->wo as $wo)
                    <option value="{{  app('App\Http\Controllers\resourceController')->enkripsi($wo->id) }}">{{ $wo->nomor_wo }}</option>
                @endforeach

            </select>
        </div>
    </div>
    <div class="bg-white col-lg-6 rounded mt-2">
        <hr>
        <div class="form-group">
            <label for="noWo">Expired Date : </label>
            <input type="text" value="@foreach ($cpps->wo as $element) {{ $element->expired_date.',' }} @endforeach" class="form-control" readonly>
        </div>
    </div>
</div>

<div class="row d-flex justify-content-center">
    <div class="bg-white col-lg-6 rounded mt-2">
        <hr>
    </div>
    <div class="bg-white col-lg-6 rounded mt-2">
        <hr>
        <a class="btn btn-info form-control text-white" data-toggle="modal" data-target="#tambah-batch-cpp">Tambah Batch / CPP</a>
    </div>
</div>

<div class="form-group row bg-white mt-3 p-3 rounded" id="tambah_palet">
    @foreach ($cpps->wo[0]->produk->mesinFillingHead->mesinFillingDetail as $mesinfilling)
        <div class="col-lg-1"></div>
        <a class="btn btn-info mesin  col-lg-4" style="background: #f0f0f0" onclick="tambahcpp('{{ app('App\Http\Controllers\resourceController')->enkripsi($mesinfilling->mesinFilling->id) }}',$('#no_wo').val(),'{{ app('App\Http\Controllers\resourceController')->enkripsi($cpps->id) }}')">
            {{ $mesinfilling->mesinFilling->kode_mesin }}
        </a>
        <div class="col-lg-1"></div>
    @endforeach
</div>
{{-- jika mesin fillingnya 2 --}}
@if ($cpps->wo[0]->produk->mesinFillingHead->mesinFillingDetail->count() > 1)
    <div class="row" id="ini_table_cpp">
        <div class="col-lg-6">
            <div class="row bg-white rounded" style="margin-top: -16px">
                <table class="table" id="table-cppc">
                    <thead class="bg-dark text-center text-white" >
                        <tr>
                            <th>Palet</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Box</th>
                        </tr>
                    </thead>
                    <tbody id="detail_tbac">
                        @foreach ($cpps->cppDetail as $detail_cpp)
                            @if ($detail_cpp->wo_id === $cpps->wo[0]->id)
                                <?php if (strpos($detail_cpp->nolot,'C')) { ?>
                                    @foreach ($detail_cpp->palet as $detail_palet)
                                    <tr>
                                        <td>
                                            <div class="form-inline row">
                                                    
                                                <label class="col-lg-6"> {{ $detail_cpp->nolot }}-</label>
                                                <input type="text" value="{{ $detail_palet->palet }}" style="width: 60px;" class="col-lg-6 form-control">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-lg-12">                            
                                                    <input type="text" class="datetimepickernya form-control" id="start_palet_{{ $detail_palet->id }}" onfocusout="ubahjamstart('{{ app('App\Http\Controllers\resourceController')->enkripsi($detail_palet->id) }}')" value="{{ $detail_palet->start }}">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-lg-12">                            <input type="text" class="datetimepickernya form-control" onfocusout="ubahjamend('{{ app('App\Http\Controllers\resourceController')->enkripsi($detail_palet->id) }}') " value="{{ $detail_palet->end }}" id="end_palet_{{ $detail_palet->id }}">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" onfocusout="jumlahbox('{{ app('App\Http\Controllers\resourceController')->enkripsi($detail_palet->id) }}')" id="box_palet_{{ $detail_palet->id }}" value="{{ $detail_palet->jumlah_box }}" class="form-control">
                                        </td>
                                    </tr>
                                    @endforeach
                                <?php } ?>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="row bg-white rounded" style="margin-top: -16px">
                <table class="table" id="table-cppb">
                    <thead class="bg-dark text-center text-white" >
                        <tr>
                            <th>Palet</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Box</th>
                        </tr>
                    </thead>
                    <tbody id="detail_a3b">
                        @foreach ($cpps->cppDetail as $detail_cpp)
                            @if ($detail_cpp->wo_id === $cpps->wo[0]->id)
                                <?php if (strpos($detail_cpp->nolot,'B')) { ?>
                                    @foreach ($detail_cpp->palet as $detail_palet)
                                    <tr>
                                        <input type="hidden" id="palet_{{ $detail_palet->id }}" value="{{  app('App\Http\Controllers\resourceController')->enkripsi($detail_palet->id) }}">
                                        <td>
                                            <div class="form-inline row">
                                                <label class="col-lg-6"> {{ $detail_cpp->nolot }}-</label>
                                                <input type="text" value="{{ $detail_palet->palet }}" style="width: 60px;" class="col-lg-6 form-control">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-lg-12">                            
                                                    <input type="text" class="datetimepickernya form-control"  value="{{ $detail_palet->start }}" id="start_palet_{{ $detail_palet->id }}" onblur="ubahjamstart('{{ app('App\Http\Controllers\resourceController')->enkripsi($detail_palet->id) }}')">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-lg-12">                            
                                                    <input type="text" class="datetimepickernya form-control" onfocusout="ubahjamend('{{ app('App\Http\Controllers\resourceController')->enkripsi($detail_palet->id) }}') " value="{{ $detail_palet->end }}" id="end_palet_{{ $detail_palet->id }}">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" onfocusout="jumlahbox('{{ app('App\Http\Controllers\resourceController')->enkripsi($detail_palet->id) }}')" id="box_palet_{{ $detail_palet->id }}" value="{{ $detail_palet->jumlah_box }}" class="form-control">
                                        </td>
                                       
                                    </tr>
                                    @endforeach
                                <?php } ?>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>    
@else
     <div class="row" id="ini_table_cpp">
        <div class="col-lg-12">
            <div class="row bg-white rounded" style="margin-top: -16px">
                <table class="table" id="table-cppa">
                    <thead class="bg-dark text-center text-white" >
                        <tr>
                            <th>Palet</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Box</th>
                        </tr>
                    </thead>
                    <tbody id="detail_tpa">
                        @foreach ($cpps->cppDetail as $detail_cpp)
                            @if ($detail_cpp->wo_id === $cpps->wo[0]->id)
                                <?php if (strpos($detail_cpp->nolot,'A')) { ?>
                                    @foreach ($detail_cpp->palet as $detail_palet)
                                    <tr>
                                        <td>
                                            <div class="form-inline row">
                                                    
                                                <label class="col-lg-6"> {{ $detail_cpp->nolot }}-</label>
                                                <input type="text" value="{{ $detail_palet->palet }}" style="width: 60px;" class="col-lg-6 form-control">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-lg-12">                            
                                                    <input type="text" class="datetimepickernya form-control" id="start_palet_{{ $detail_palet->id }}" onfocusout="ubahjamstart('{{ app('App\Http\Controllers\resourceController')->enkripsi($detail_palet->id) }}')" value="{{ $detail_palet->start }}">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-lg-12">                            <input type="text" class="datetimepickernya form-control" onfocusout="ubahjamend('{{ app('App\Http\Controllers\resourceController')->enkripsi($detail_palet->id) }}') " value="{{ $detail_palet->end }}" id="end_palet_{{ $detail_palet->id }}">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" onfocusout="jumlahbox('{{ app('App\Http\Controllers\resourceController')->enkripsi($detail_palet->id) }}')" id="box_palet_{{ $detail_palet->id }}" value="{{ $detail_palet->jumlah_box }}" class="form-control">
                                        </td>
                                    </tr>
                                    @endforeach
                                <?php } ?>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif
    <div class="row">
        <div class="col-lg-10"></div>
        <button class="btn btn-success col-lg-2" onclick="close_cpp($('#cpp_head_id').val())">Close CPP Head</button>

    </div>
@include('rollie.operator.tambahbatch')

{{-- <button onclick="ubahjamstart('1')">CEK CEK</button> --}}


<script>
$('.mesin').click(function () {
    var $tableBody = $('#tablenya').find("tbody"),
    $trLast = $tableBody.find("tr:last"),
    $trNew = $trLast.clone();
    $trLast.after($trNew);
})
</script>
@endsection