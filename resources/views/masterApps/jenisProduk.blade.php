@extends('masterApps.templates.layout')
@section('title')
    Form Produk
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
        {!! Form::open(['route' => 'jenis-produk-data', 'method' => 'POST']) !!}
            <input type="hidden" name="id" id="id">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="jenisProduk">Jenis Produk : </label>
                        <input type="text" name="jenisProduk" class="form-control" id="jenisProduk">
                    </div>
                </div>
                <div class="col-lg-6">
                    <table class="table text-center table-bordered table-striped">
                        <thead class="bg-dark text-white">
                            <tr>
                                <td>#</td>
                                <td>Jenis Produk</td>
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