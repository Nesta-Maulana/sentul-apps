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
                    <div class="p-2">
                        <button class=" btn btn-primary simpan">Simpan</button>
                        <button class=" btn btn-primary update">Update</button>
                        <a href="#" class="btn btn-danger batal">Batal</a>
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
                            @foreach($products as $product)
                            <?php $id=app('App\Http\Controllers\resourceController')->enkripsi($product->id) ?>
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $product->jenis_produk }}</td>
                                    <td><a href="#" class="btn btn-primary edit" onclick="edit('{{ $id }}')">Edit</a></td>
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

<script>
    $('.update').hide();
    $('.batal').hide();
    function edit(id){
        $.ajax({
            url: '/sentul-apps/master-apps/jenis-produk/edit/' + id,
            method: 'GET',
            dataType: 'JSON',
            success: function (data) {
                
                $('#jenisProduk').val(data.jenis_produk);
                $('.update').show();
                $('.batal').show();
                $('.simpan').hide();
                $('#id').val(data.id);
            }
        })
    }
    $('.batal').click(function () {
        $('#brand').val("");
        $('#plan').val("");
        $('#id').val("");
        $('.update').hide();
        $('.batal').hide();
        $('.simpan').show();
    })
</script>
@endsection 