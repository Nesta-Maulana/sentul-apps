@extends('rollie.operator.templates.layout')
@section('title')
    ROLLIE | CPP
@endsection
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="row d-flex justify-content-center">
    <div class="bg-white col-lg-6 rounded mt-2">
        <hr>
        <div class="form-group">
            <label for="tglMixing">Tanggal Packing : </label>
            <input type="text" value="{{ $cpps->tanggal_packing }}" name="tglMixing" id="tglMixing" class="form-control" readonly>
        </div>
        <div class="form-group">
            <label for="produk">Nama Produk : </label>
            <input type="text" value="{{ $cpps->wo[0]->produk->nama_produk }}" name="nama_produk" id="nama_produk" class="form-control" readonly>
        </div>
    </div>
    <div class="bg-white col-lg-6 rounded mt-2 ">
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
        <a class="btn btn-basic mesin mr-2 col-lg-3" style="background: #f0f0f0" onclick="tambahcpp('{{ app('App\Http\Controllers\resourceController')->enkripsi($mesinfilling->mesinFilling->id) }}',$('#no_wo').val(),'{{ app('App\Http\Controllers\resourceController')->enkripsi($cpps->id) }}')">{{ $mesinfilling->mesinFilling->kode_mesin }}</a>
    @endforeach
</div>

<div class="row bg-white rounded" style="margin-top: -16px">
    <table class="table table-bordered mt-3" id="tablenya">
        <thead class="bg-dark text-center text-white" >
            <tr>
                <th>Nomor Wo</th>
                <th>Exp. Date</th>
                <th>Nomor Lot</th>
                <th>Palet</th>
                <th>Start</th>
                <th>End</th>
                <th>Box</th>
                <th>Pack</th>
            </tr>
        </thead>
        <tbody id="detail_palet">
            @foreach ($cpps->cppDetail as $detail_cpp)
                @foreach ($detail_cpp->palet as $detail_palet)
                <tr>
                    <td><input type="text" value="{{ $detail_cpp->wo->nomor_wo }}" class="form-control" readonly></td>
                    <td><input type="text" value="{{ $detail_cpp->wo->expired_date }}" class="form-control" readonly></td>
                    <td><input type="text" value="{{ $detail_cpp->nolot }}" class="form-control" readonly></td>
                    <td><input type="text" value="{{ $detail_palet->palet }}" class="form-control" readonly></td>
                    <td><input type="text" value="{{ $detail_palet->start }}" class="form-control" readonly></td>
                    <td><input type="text" value="{{ $detail_palet->end }}" class="form-control" readonly></td>
                    <td><input type="text" value="{{ $detail_palet->jumlah_box }}" class="form-control" readonly></td>
                    <td><input type="text" value="{{ $detail_palet->jumlah_pack }}" class="form-control" readonly></td>
                   
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