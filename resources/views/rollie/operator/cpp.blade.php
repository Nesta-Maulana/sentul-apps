@extends('rollie.operator.templates.layout')
@section('title')
    ROLLIE | CPP
@endsection
@section('content')

<div class="row d-flex justify-content-center">
    <div class="bg-white col-lg-6 rounded mt-2">
        <hr>
        <div class="form-group">
            <label for="tglMixing">Tanggal Mixing : </label>
            <input type="date" name="tglMixing" id="tglMixing" class="form-control">
        </div>
        <div class="form-group">
            <label for="produk">Nama Produk : </label>
            <select name="produk" id="produk" class="form-control">
                <option value="" disabled selected>-- PILIH PRODUK --</option>
            </select>
        </div>
        <div class="form-group">
            <label for="noWo">No WO : </label>
            <input type="text" name="noWo" id="noWo" class="form-control">
        </div>
    </div>
    <div class="bg-white col-lg-6 rounded mt-2 ">
        <hr>
        <div class="form-group">
            <label for="kodeMesinFilling">Kode Mesin Filling : </label>
            <select name="kodeMesinFilling" id="kodeMesinFilling" class="form-control">
                <option value="" disabled selected>-- PILIH KODE MESIN FILLING --</option>
            </select>
        </div>
        <div class="form-group">
            <label for="expiredDate">Expired Date : </label>
            <input type="date" name="expiredDate" id="expiredDate" class="form-control">
        </div>
        <div class="form-group">
            <label for="lot">No LOT : </label>
            <input type="text" name="lot" id="lot" class="form-control">
        </div>
        <div class="float-right">
            <button class="mb-2 btn btn-warning text-white">Save to Draft</button>
            <button class="mb-2 btn btn-primary">Send</button>
        </div>
    </div>
</div>

<div class="row bg-white mt-3 p-3 rounded">
    <button class="btn mesin mr-2">Nama Mesin</button>
    <button class="btn mesin mr-2">Nama Mesin</button>
    <button class="btn mesin mr-2">Nama Mesin</button>
    <button class="btn mesin mr-2">Nama Mesin</button>
    <table class="table table-bordered mt-3" id="tablenya">
        <thead class="bg-dark text-center text-white">
            <th>No.</th>
            <th>Start</th>
            <th>End</th>
            <th>Box</th>
            <th>Pack</th>
        </thead>
        <tbody>
            <td>1</td>
            <td><input type="text" class="form-control" ></td>
            <td><input type="text" class="form-control"></td>
            <td><input type="text" class="form-control"></td>
            <td><input type="text" class="form-control"></td>
        </tbody>
    </table>
</div>

<div class="row bg-white mt-3 p-3 rounded">
    <div class="d-flex justify-content-center p-2">
        <h5>DataTables</h5>
    </div>
    <hr>
    <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="data-tables">
        <thead>
            <tr>
                <th>No</th>
                <th>Tgl</th>
                <th>Nama Produk</th>
                <th class="hidden-phone">No WO.</th>
                <th class="hidden-phone">No LOT A3</th>
                <th class="hidden-phone">BOX</th>
                <th class="hidden-phone">Pak</th>
                <th class="hidden-phone">Total</th>
                <th class="hidden-phone">Nomor LOT TBA</th>
                <th class="hidden-phone">BOX</th>
                <th class="hidden-phone">Pak</th>
                <th class="hidden-phone">Total 2</th>
                <th class="hidden-phone">Total Yield</th>
            </tr>
        </thead>
        <tbody>
            @for($i = 1; $i <=100; $i++)
                <tr class="gradeX">
                    <td>{{ $i }}</td>
                    <td>{{ $i }} - 01 -2018</td>
                    <td>Internet Explorer {{$i}}.0</td>
                    <td class="hidden-phone">11{{$i}}+</td>
                    <td class="hidden-phone">No LOT A3</td>
                    <td class="hidden-phone">BOX</td>
                    <td class="hidden-phone">Pak</td>
                    <td class="hidden-phone">Total</td>
                    <td class="hidden-phone">Nomor LOT TBA</td>
                    <td class="hidden-phone">BOX</td>
                    <td class="hidden-phone">Pak</td>
                    <td class="hidden-phone">Total 2</td>
                    <td class="hidden-phone">Total Yield</td>
                </tr>
            @endfor
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