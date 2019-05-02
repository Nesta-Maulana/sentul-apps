@extends('masterApps.templates.layout')
@section('title')
    Master Apps
@endsection
@section('subtitle')
    Sub-Brand
@endsection
@section('content')

{!! Form::open(['route' => 'sub-brand-data', 'method' => 'POST']) !!}
<input type="hidden" name='id' id="id">
    <div class="row box ml-1">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="brand">Brand : </label>
                <select class="form-control select2" id="brand" name="brand">
                    <option value="" disabled selected> -- PILIH BRAND --</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->brand }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="subBrand">Sub Brand : </label>
                <input type="text" class="form-control" id="subBrand" name="subBrand">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="status">Status : </label>
                <select class="form-control" id="status" name="status" name="status">
                    <option value="" disabled selected> -- PILIH STATUS -- </option>
                    <option value="1">Aktif</option>
                    <option value="0">Tidak Aktif</option>
                </select>
            </div>
        </div>
        <div class="mb-3 ml-2">
                <button class="btn btn-primary simpan">Simpan</button>
                <button class="btn text-white btn-primary update">Update</button>
                <a class="text-white btn btn-danger batal">Batal</a>
        </div>
    </div>
{!! Form::close() !!}
<div class="row">
    <div class="col-lg-12">
        <div class="box p-2">
            <div class="box-header">
                <h4>Sub Brand</h4>
            </div>
            <table class="table table-hovered">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>No</th>
                        <th>Brand</th>
                        <th>Sub Brand</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no =0 ?>
                    @foreach($subBrands as $subBrand)
                    <?php $id=app('App\Http\Controllers\resourceController')->enkripsi($subBrand->id) ?>
                    <?php $no++ ?>
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $subBrand->brand->brand }}</td>
                            <td>{{ $subBrand->sub_brand }}</td>
                            @if($subBrand->status == '1')
                                <td>Aktif</td>
                            @else
                                <td>Tidak Aktif</td>
                            @endif
                            <td>
                                <a class="btn  text-white btn-primary edit" data-id="{{ $id }}">Edit</a>
                                <a href="delete/mysql4/sub_brand/{{$subBrand->id}}" class="text-white btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $('.update').hide();
    $('.batal').hide();
    $('.edit').click(function () {
        var id = $(this).data('id');
        $.ajax({
            url: 'sub-brand/edit/' + id,
            method: 'GET',
            dataType: 'JSON',
            success: function (data) {
                $('.update').show();
                $('.simpan').hide();
                $('.batal').show();
                var option = "";
                for (let index = 0; index < data[1].length; index++) {
                    if (data[0].brand_id == data[1][index].id) {
                        option+='<option value='+ data[1][index].id +' selected>' + data[1][index].brand + '</option>';
                    }else{
                        option+='<option value='+ data[1][index].id +'>' + data[1][index].brand + '</option>';
                    }
                }
                $('#brand').html(option).on('change');
                $('#subBrand').val(data[0].sub_brand);
                $('#id').val(data[0].id);
                $("#status option[value= '" + data[0].status + "']").prop('selected', true);
            }
        });
    })
    $('.batal').click(function () {
        $("#brand").val('');
        $('#subBrand').val('');
        $('#id').val('');
        $("#status").val('');
    })
</script>
@endsection