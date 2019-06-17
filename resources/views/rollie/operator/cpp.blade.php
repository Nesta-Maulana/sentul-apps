@extends('rollie.operator.templates.layout')
@section('title')
    ROLLIE | CPP
@endsection
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<input type="hidden" id="cpp_head_id" value="{{ app('App\Http\Controllers\resourceController')->enkripsi($cpps->id) }}">

<div class="row d-flex justify-content-center">
    <div class="bg-white col-lg-4 rounded mt-2">
        <hr>
        <div class="form-group">
            <label for="tglMixing">Tanggal Packing : </label>
            <input type="text" value="{{ $cpps->tanggal_packing }}" name="tglMixing" id="tglMixing" class="form-control" readonly>
        </div>
    </div>
    <div class="bg-white col-lg-4 rounded mt-2">
        <hr>
        <div class="form-group">
            <label for="produk">Nama Produk : </label>
            <input type="text" value="{{ $cpps->wo[0]->produk->nama_produk }}" name="nama_produk" id="nama_produk" class="form-control" readonly>
        </div>
    </div>

    <div class="bg-white col-lg-4 rounded mt-2">
        <hr>
        <div class="form-group">
            <label for="noWo">No WO : </label>
            <select name="no_wo" id="no_wo" class="form-control">
                @foreach ($cpps->wo as $wo)
                    <option value="{{  app('App\Http\Controllers\resourceController')->enkripsi($wo->id) }}">{{ $wo->nomor_wo }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="form-group row bg-white mt-3 p-3 rounded" id="tambah_palet">
    @foreach ($cpps->wo[0]->produk->mesinFillingHead->mesinFillingDetail as $mesinfilling)
        <a class="btn btn-info mesin mr-2 col-lg-4" style="background: #f0f0f0" onclick="tambahcpp('{{ app('App\Http\Controllers\resourceController')->enkripsi($mesinfilling->mesinFilling->id) }}',$('#no_wo').val(),'{{ app('App\Http\Controllers\resourceController')->enkripsi($cpps->id) }}')">{{ $mesinfilling->mesinFilling->kode_mesin }}</a>
    @endforeach
</div>

<div class="row bg-white rounded" style="margin-top: -16px">
    <table class="table" id="tablenya">
        <thead class="bg-dark text-center text-white" >
            <tr>
                <th>Nomor Wo</th>
                <th>Exp. Date</th>
                <th>Lot</th>
                <th>Palet</th>
                <th>Start</th>
                <th>End</th>
                <th>Box</th>
            </tr>
        </thead>
        <tbody id="detail_palet">
            @foreach ($cpps->cppDetail as $detail_cpp)
                @foreach ($detail_cpp->palet as $detail_palet)
                <tr>
                    <td>
                        <input type="text" value="{{ $detail_cpp->wo->nomor_wo }}" class="form-control" readonly>
                    </td>
                    <td>
                        <input type="text" value="{{ $detail_cpp->wo->expired_date }}" class="form-control" readonly>
                    </td>
                    <td>
                        <input type="text" value="{{ $detail_cpp->nolot }}" class="form-control" readonly>
                    </td>
                    <td>
                        <input type="text" value="{{ $detail_palet->palet }}" class="form-control">
                    </td>
                    <td>
                        <div class="row">
                            <div class="col-lg-12">                            
                                <input type="text" class="datetimepickernya form-control" value="{{ $detail_palet->start }}">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="row">
                            <div class="col-lg-12">                            
                                <input type="text" class="datetimepickernya form-control" value="{{ $detail_palet->end }}">
                            </div>
                        </div>
                    </td>
                    <td>
                        <input type="text" value="{{ $detail_palet->jumlah_box }}" class="form-control">
                    </td>
                   
                </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>


<script>
$('.mesin').click(function () {
    var $tableBody = $('#tablenya').find("tbody"),
    $trLast = $tableBody.find("tr:last"),
    $trNew = $trLast.clone();
    $trLast.after($trNew);
})
</script>
@endsection