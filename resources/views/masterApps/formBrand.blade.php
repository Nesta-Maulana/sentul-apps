@extends('masterApps.templates.layout')
@section('title')
    Form Brand
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
        {!! Form::open(['url' =>'/master-apps/brand/data', 'method' => 'POST']) !!}
            <input type="hidden" name="id" id="id">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="brand">Brand :</label>
                        <input type="text" name="brand" id="brand" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="company">Company :</label>
                        <select name="company" id="company" class="form-control">
                            <option value="" disabled selected>-- PILIH PLAN --</option>
                            @foreach($company as $compani)
                                <option value="{{ $compani->id }}">{{ $compani->company }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="p-2">
                        <button class=" btn btn-primary simpan">Simpan</button>
                        <button class=" btn btn-primary update">Update</button>
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
                            @foreach($brands as $brand)
                                <?php $id=app('App\Http\Controllers\resourceController')->enkripsi($brand->id) ?>
                                <tr>
                                    
                                    <td>{{ $i }}</td>
                                    <td>{{ $brand->brand }}</td>
                                    <td>{{ $brand->company->company }}</td>
                                    <td>
                                        <a href="#" class="btn btn-primary edit" onclick="edit('{{ $id }}')">Edit</a>
                                        <a href="delete/production_data/brand/{{$brand->id}}" class="text-white btn btn-danger">Delete</a>
                                    </td>
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
            url: '/sentul-apps/master-apps/brand/edit/' + id,
            method: 'GET',
            dataType: 'JSON',
            success: function (data) {
                $('#brand').val(data[0].brand);
                var optionparent = '<option disabled>-- PILIH PLAN --</option>';
                for (index = 0; index < data[1].length; index++) 
                {   
                    if(data[1][index].id == data[0].plan_id){
                        optionparent+='<option selected value="'+data[1][index].id+'">'+data[1][index].plan+'</option>';
                    }else{
                        optionparent+='<option  value="'+data[1][index].id+'">'+data[1][index].plan+'</option>';
                    }
                }
                $('#plan').html(optionparent).on('change');
                $('.update').show();
                $('.batal').show();
                $('.simpan').hide();
                $('#id').val(data[0].id);
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