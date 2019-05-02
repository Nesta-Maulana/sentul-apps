@extends('masterApps.templates.layout')
@section('title')
    Master Apps
@endsection
@section('subtitle')
    Company
@endsection
@section('content')
<input id="interval" type="hidden" data-tambah="{{ Session::get('tambah') }}"/>
<div class="container">
    <div class="row">
        <div class="col-lg-6 data-menu {{ Session::get('tambah') }}">
            <form action="company/data" class="data-menu {{ Session::get('tambah') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="id" id="id">
                <div class="form-group">
                    <label for="">Company :</label>
                    <input type="text" id="company" name="company" class="form-control" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="">Singkatan</label>
                    <input type="text" id="singkatan" name="singkatan" class="form-control" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="status">Status :</label>
                    <select name="status" id="status" class="form-control">
                        <option value="" selected disabled>-- PILIH STATUS --</option>
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                </div>
                <button class="btn btn-primary mt-2 mb-3" id="simpan">Simpan</button>
                <button class="text-white btn btn-primary mt-2 mb-3" id="update">Update</button>
                <a class="text-white btn btn-danger mt-2 mb-3" id="batal">Batal</a>
            </form>
        </div>
        <div class="col-lg-6">
             <table class="table bg-white tabel-menu" id="table-company">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Company</th>
                        <th scope="col">Singkatan</th>
                        <th scope="col">Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php $i=1 ?>
                    @foreach($company as $c)
                    <?php $id=app('App\Http\Controllers\resourceController')->enkripsi($c->id) ?>
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $c->company }}</td>
                            <td>{{ $c->singkatan }}</td>
                            @if($c->status == "1")
                                <td>Aktif</td>
                            @else
                                <td>Tidak Aktif</td>
                            @endif
                            <td>
                                <button class="btn btn-primary edit {{ Session::get('ubah') }}" data-id="{{ $id }}">Edit</button>
                                <a href="delete/mysql4/company/{{$c->id}}" class="text-white btn btn-danger">Delete</a>    
                            </td>
                        </tr>
                        <?php $i++ ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<style>
.margin-top{
    margin-top: -250px !important;
}
.margin-top-mobile{
    margin-top: -240px !important;
}
</style>
 
<script src="{!! asset('masterApps/js/jquery-3.3.1.min.js') !!}"></script>
<script>
    
    $('#update').hide();
    $('#batal').hide();
/*    window.setInterval(function(){
        if($(window).width() <= 369){
            $('.table').addClass('table-responsive');
        }else{
            $('.table').removeClass('table-responsive');
        }
    }, 200);

    window.setInterval(function () {
        var cek = $('#interval').val();
        var tambah = $('#interval').data('tambah');
        if(cek == "" && tambah == "hidden"){
            var myVar = setInterval( setMargin(), 200);
        }else {
            clearInterval(myVar);
            $('.tabel-menu').removeClass('margin-top-mobile');
            $('.tabel-menu').removeClass('margin-top');
        }
    }, 200);

    function setMargin(){
        if($(window).width() >= 992){
            $('.tabel-menu').removeClass('margin-top-mobile');
            $('.tabel-menu').addClass('margin-top');
        }else{
            $('.tabel-menu').removeClass('margin-top');
            $('.tabel-menu').addClass('margin-top-mobile');
        }
    }*/

    $('#batal').click(function () {
        if($('#interval').data('tambah') == 'hidden'){
            $('.data-menu').addClass('hidden');
        }else{

        }
        $('#interval').val("");
        $('#update').hide();
        $('#batal').hide();
        $('#simpan').show();
        $('#id').val("");
        $('#company').val("");
        $('#status').val("");
    
    })

    $('.edit').click(function () {
        $('#interval').val("edit");
            $('.data-menu').removeClass('hidden');
            $('.tabel-menu').removeClass('margin-top');
            $('.tabel-menu').removeClass('margin-top-mobile');
        $('#update').show();
        $('#batal').show();
        $('#simpan').hide();
        var id = $(this).data('id');
        $.ajax({
            url: 'company/edit/' + id,
            method: 'GET',
            dataType: 'JSON',
            success: function (data) {
                $('#id').val(data.id);
                $('#company').val(data.company);
                $('#singkatan').val(data.singkatan);
                $("#status option[value= '" + data.status + "']").prop('selected', true);
            }
        });
    })
</script>
@endsection