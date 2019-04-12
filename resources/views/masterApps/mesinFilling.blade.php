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
        {!! Form::open(['route' => 'mesin-filling-data', 'method' => 'POST']) !!}
            <input type="hidden" name="id" id="id">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="mesin">Nama Mesin : </label>
                        <input type="text" name="mesin" class="form-control" id="mesin">
                    </div>
                    <div class="form-group">
                        <label for="kodeMesin">Kode Mesin : </label>
                        <input type="text" name="kodeMesin" class="form-control" id="kodeMesin">
                    </div>
                    <div class="p-2">
                        <button class=" btn btn-primary simpan">Simpan</button>
                        <button href="#" class="btn btn-primary update">update</button>
                        <a href="#" class="btn btn-danger batal">Batal</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <table class="table text-center table-bordered table-striped">
                        <thead class="bg-dark text-white">
                            <tr>
                                <td>#</td>
                                <td>Nama Mesin</td>
                                <td>Kode Mesin</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1 ?>
                            @foreach($mesinFilling as $m)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $m->nama_mesin }}</td>
                                    <td>{{ $m->kode_mesin }}</td>
                                    <td><a href="#" class="btn btn-primary">Edit</a></td>
                                </tr>
                                <?php $i++ ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>


@endsection