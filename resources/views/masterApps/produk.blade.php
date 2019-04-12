@extends('masterApps.templates.layout')
@section('title')
    Form Mesin Filling
@endsection
@section('subtitle')
    Subtitle
@endsection
@section('active-brand')
    active
@endsection
@section('content')
<div class="box d-flex data-menu {{ Session::get('tambah') }}">
    <div class="container">
        <div class="box-header">
            
        </div>
        {!! Form::open(['route' => 'brand-data', 'method' => 'POST']) !!}
            <input type="hidden" name="id" id="id">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="brand">Brand :</label>
                        <select name="brand" id="brand" class="form-control select2">
                            <option value="" selected disabled>-- PILIH BRAND --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="produk">Nama Produk : </label>
                        <input type="text" name="produk" class="form-control" id="produk">
                    </div>
                    <div class="form-group">
                        <label for="oracle">Kode Oracle : </label>
                        <input type="text" name="oracle" class="form-control" id="oracle">
                    </div>
                    <div class="form-group">
                        <label for="spekTsMin">Spek TS Min : </label>
                        <input type="text" name="spekTsMin" class="form-control" id="spekTsMin">
                    </div>
                    <div class="form-group">
                        <label for="spekTsMax">Spek TS Max : </label>
                        <input type="text" name="spekTsMax" class="form-control" id="spekTsMax">
                    </div>
                    <div class="form-group">
                        <label for="spekPhMin">Spek PH Min : </label>
                        <input type="text" name="spekPhMin" class="form-control" id="spekPhMin">
                    </div>
                    <div class="form-group">
                        <label for="spekPhMax">Spek PH Max : </label>
                        <input type="text" name="spekPhMax" class="form-control" id="spekPhMax">
                    </div>
                    <div class="form-group">
                        <label for="sla">sla : </label>
                        <input type="text" name="sla" class="form-control" id="sla">
                    </div>
                    <div class="form-group">
                        <label for="produk">Waktu Analisa Mikro : </label>
                        <input type="text" name="produk" class="form-control" id="produk">
                    </div>
                    <div class="form-group">
                        <label for="kelompokMesinFillingHead">Kelompok Mesing Fillng Head : </label>
                        <input type="text" name="kelompokMesinFillingHead" class="form-control" id="kelompokMesinFillingHead">
                    </div>
                    <div class="form-group">
                        <label for="jenisProduk">Jenis Produk : </label>
                        <input type="text" name="jenisProduk" class="form-control" id="jenisProduk">
                    </div>
                    <div class="form-group">
                        <label for="status">Status : </label>
                        <input type="text" name="status" class="form-control" id="status">
                    </div>
                    <div class="p-2">
                        <button class=" btn btn-primary simpan">Simpan</button>
                        <button href="#" class="btn btn-primary update">update</button>
                        <a href="#" class="btn btn-danger batal">Batal</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <table class="table text-center table-bordered table-striped">
                        <thead class="dark">
                            <tr>
                                <td>#</td>
                                <td>Brand</td>
                                <td>Plan</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1 ?>
                           
                        </tbody>
                    </table>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection