@extends('masterApps.templates.layout')
@section('title')
    Master Apps
@endsection
@section('subtitle')
    WorkCenter
@endsection
@section('content')
<input id="interval" type="hidden" data-tambah="{{ Session::get('tambah') }}"/>
    <div class="container">
        <div class="row">
            <div class="col teks mt-3 rounded">
                    <form action="workcenter/data" class="data-menu {{ Session::get('tambah') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" id="id" name="id">
                        <div class="row">
                            <div class="col-lg-6 ">
                                <div class="form-group">
                                    <label for="">WorkCenter :</label>
                                    <input type="text" name="workcenter" id="workcenter" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Status :</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="" selected disabled>-- PILIH STATUS --</option>
                                        <option value="0">Tidak Aktif</option>
                                        <option value="1">Aktif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 ">
                                <div class="form-group">
                                    <label for="">Kategori :</label>
                                    <select name="kategori" id="kategori" class="form-control">
                                        <option value="" selected disabled>-- PILIH KATEGORI --</option>
                                        @foreach($kategori as $k)
                                            <option value="{{ $k->id }}">{{ $k->kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-primary pr-5 pt-2 pb-2 pl-5 ml-3 d-flex-justify-content-center text-center" id="simpan">SIMPAN</button>
                            <button class="btn btn-primary pr-5 pt-2 pb-2 pl-5 ml-3" id="update">Update</button>
                            <a class="btn btn-danger pr-5 pt-2 pb-2 pl-5 ml-3 text-white" id="batal"> Batal </a>
                        </div>
                    </form>

                    <table class="table bg-white mt-4 tabel-menu">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">WorkCenter</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i=1 ?>
                            @foreach($workcenter as $w)
                            <?php $id=app('App\Http\Controllers\resourceController')->enkripsi($w->id) ?>
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $w->workcenter }}</td>
                                    <td>{{ $w->kategori->kategori }}</td>
                                    <td>{{ $w->status }}</td>
                                    <td>
                                        <button class="btn btn-primary edit {{ Session::get('ubah') }}" data-id="{{ $id }}"><i class="fa fa-edit"></i> Edit</button>
                                        <a href="delete/mysql2/workcenter/{{$w->id}}" class="text-white btn btn-danger">Delete</a>
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
    margin-top: -220px !important;
}
.margin-top-mobile{
    margin-top: -300px !important;
}
</style>
 
<script src="{!! asset('masterApps/js/jquery-3.3.1.min.js') !!}"></script>
<script>


$('#update').hide();
$('#batal').hide();
$('#simpan').show();
window.setInterval(function(){
    if($(window).width() <= 440){
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
window.setInterval(function(){
    if($(window).width() <= 240){
        $('.table').addClass('table-responsive');
    }else{
        $('.table').removeClass('table-responsive');
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
}

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
    $('#workcenter').val("");
    $('#status').val("");
    $('#kategori').val(""); 
})

$(".edit").click(function () {
    $('#interval').val("edit");
    $('.data-menu').removeClass('hidden');
    $('.tabel-menu').removeClass('margin-top');
    $('.tabel-menu').removeClass('margin-top-mobile');
    $('#update').show();
    $('#batal').show();
    $('#simpan').hide();
    var id = $(this).data('id');
    $.ajax({
        url: 'workcenter/edit/' + id,
        method: 'GET',
        dataType: 'JSON',
        success: function (data) {
            $('#id').val(data[0].id);
            $('#workcenter').val(data[0].workcenter);
            $("#status option[value= '" + data[0].status + "']").prop('selected', true);
            var optionroles = '<option disabled>-- PILIH PARENT --</option>', $comboroles = $('#kategori');
                for (index = 0; index < data[1].length; index++) 
                {
                    if (data[1][index].id == data[0].kategori_id) 
                    {
                        
                        optionroles+='<option  value="'+data[1][index].id+'" selected>'+data[1][index].kategori+'</option>';   
                    }
                    else
                    {
                        optionroles+='<option  value="'+data[1][index].id+'">'+data[1][index].kategori+'</option>';   
                    }
                }
                $comboroles.html(optionroles).on('change');
        }
    });
});



</script>
@endsection