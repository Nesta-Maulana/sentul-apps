@extends('masterApps.templates.layout')
@section('title')
    Master Apps
@endsection
@section('subtitle')
    Bagian
@endsection
@section('content')
<input id="interval" type="hidden" data-tambah="{{ Session::get('tambah') }}"/>
<div class="container">
    <form action="bagian/data" method="post">
        <div class="row data-menu {{ Session::get('tambah') }}">
            <input type="hidden" id="id" name="id">
            {{ csrf_field() }}
            <div class="col-lg-6 ">
                <div class="form-group">
                    <label for="">WorkCenter :</label>
                    <select name="workcenter" id="workcenter" class="form-control" id="workcenter">
                        <option value="" selected disabled>-- PILIH WORKCENTER --</option>
                        @foreach($workcenter as $w)
                            <option value="{{ $w->id }}">{{ $w->workcenter }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Bagian :</label>
                    <input type="text" name="bagian" id="bagian" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Satuan :</label>
                    <select name="satuan" id="satuan" class="form-control">
                        <option value="" selected disabled> -- PILIH SATUAN -- </option>
                        @foreach($satuan as $s)
                            <option value="{{ $s->id }}">{{ $s->satuan }}</option>
                        @endforeach
                    </select>
                </div>   
            </div>
            <div class="col-lg-6 ">
                <div class="form-group">
                    <label for="">Status :</label>
                    <select name="status" id="status" class="form-control">
                        <option value="" selected disabled>-- PILIH STATUS --</option>
                        <option value="0">Tidak Aktif</option>
                        <option value="1">Aktif</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Spesifikasi Minimal :</label>
                    <input type="number" name="spek_min" id="spek_min" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Spesifikasi Maksimal :</label>
                    <input type="number" name="spek_max" id="spek_max" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Kategori Pencatatan :</label>
                    <select name="kategori_pencatatan" id="kategori_pencatatan" class="form-control">
                        <option value="" selected disabled> -- PILIH KATEGORI PENCATATAN --</option>
                        @foreach($kategoriPencatatan as $k)
                            <option value="{{ $k->id }}">{{ $k->kategori_pencatatan }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button class="btn btn-primary pr-5 pt-2 pb-2 pl-5 ml-3 d-flex-justify-content-center text-center" id="simpan">SIMPAN</button>
            <button class="btn btn-primary pr-5 pt-2 pb-2 pl-5 ml-3" id="update">Update</button>
            <a class="btn btn-danger pr-5 pt-2 pb-2 pl-5 ml-3 text-white" id="batal">Batal</a>
        </div>
    </form>
    <table class="table bg-white mt-4 tabel-menu">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">WorkCenter</th>
                <th scope="col">Bagian</th>
                <th scope="col">Status</th>
                <th scope="col">Satuan</th>
                <th scope="col">Spesifikasi Minimal</th>
                <th scope="col">Spesifikasi Maksimal</th>
                <th scope="col">Kategori Pencatatan</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1 ?>
            @foreach($bagian as $b)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $b->workcenter->workcenter }}</td>
                    <td>{{ $b->bagian }}</td>
                    <!-- <td>{{ $b->status }}</td> -->
                    @if($b->status == "1")
                        <td>Aktif</td>
                    @else
                        <td>Tidak Aktif</td>
                    @endif
                    <td>{{ $b->satuan->satuan }}</td>
                    <td>{{ $b->spek_min }}</td>
                    <td>{{ $b->spek_max }}</td>
                    <td>{{ $b->kategoriPencatatan->kategori_pencatatan }}</td>
                    <td>
                        <button class="btn btn-primary edit {{ Session::get('ubah') }}" data-id="{{ $b->id }}"><i class="fa fa-edit"></i> Edit</button>
                        <a href="delete/mysql2/bagian/{{$b->id}}" class="text-white btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php $i++ ?>
            @endforeach
        </tbody>
    </table>
</div>
<style>
.margin-top{
    margin-top: -280px !important;
}
.margin-top-mobile{
    margin-top: -520px !important;
}
</style>

<script src="{!! asset('masterApps/js/jquery-3.3.1.min.js') !!}"></script>
<script>

$('#batal').hide();
$('#update').hide();

// window.setInterval(function(){
//     if($(window).width() <= 1100){
//         $('.table').addClass('table-responsive');
//     }else{
//         $('.table').removeClass('table-responsive');
//     }
// }, 100);

// window.setInterval(function () {
//     var cek = $('#interval').val();
//     var tambah = $('#interval').data('tambah');
//     if(cek == "" && tambah == "hidden"){
//         var myVar = setInterval( setMargin(), 200);
//     }else {
//         clearInterval(myVar);
//         $('.tabel-menu').removeClass('margin-top-mobile');
//         $('.tabel-menu').removeClass('margin-top');
//     }
// }, 200);
// function setMargin(){
//     if($(window).width() >= 992){
//         $('.tabel-menu').removeClass('margin-top-mobile');
//         $('.tabel-menu').addClass('margin-top');
//     }else{
//         $('.tabel-menu').removeClass('margin-top');
//         $('.tabel-menu').addClass('margin-top-mobile');
//     }
// }


$('#batal').click(function () {
    if($('#interval').data('tambah') == 'hidden')
    {
        $('.data-menu').addClass('hidden');
    }
    
    $('#interval').val("");
    $('#simpan').show();
    $('#batal').hide();
    $('#update').hide();
    $('#id').val("");
    $('#bagian').val("");
    $('#satuan').val("");
    $('#spek_min').val("");
    $('#spek_max').val("");
    $("#status").val("");
    $("#workcenter").val("");
})


$('.edit').click(function () {
    $('#interval').val("edit");
    $('.data-menu').removeClass('hidden');
    $('.tabel-menu').removeClass('margin-top');
    $('.tabel-menu').removeClass('margin-top-mobile');
    $('#batal').show();
    $('#update').show();
    $('#simpan').hide();
    var id = $(this).data('id');
    $.ajax({
        url: 'bagian/edit/' + id,
        method: 'GET',
        dataType: 'JSON',
        success: function (data) {
            $("#id").val(data[0].id);
            $('#bagian').val(data[0].bagian);
            $('#satuan').val(data[0].satuan);
            $('#spek_min').val(data[0].spek_min);
            $('#spek_max').val(data[0].spek_max);
            $("#status option[value= '" + data[0].status + "']").prop('selected', true);
            var optionroles = '<option disabled>-- PILIH PARENT --</option>', $comboroles = $('#workcenter');
                for (index = 0; index < data[1].length; index++) 
                {
                    if (data[1][index].id == data[0].workcenter_id) 
                    {
                        
                        optionroles+='<option  value="'+data[1][index].id+'" selected>'+data[1][index].workcenter+'</option>';   
                    }
                    else
                    {
                        optionroles+='<option  value="'+data[1][index].id+'">'+data[1][index].workcenter+'</option>';   
                    }
                }
                $comboroles.html(optionroles).on('change');

                var optionroless = '<option disabled>-- PILIH PARENT --</option>', $comboroless = $('#kategori_pencatatan');
                for (index = 0; index < data[2].length; index++) 
                {
                    if (data[0].kategori_pencatatan_id == data[2][index].id) 
                    {
                        
                        optionroless+='<option  value="'+data[2][index].id+'" selected>'+data[2][index].kategori_pencatatan+'</option>';   
                    }
                    else
                    {
                        optionroless+='<option  value="'+data[2][index].id+'">'+data[2][index].kategori_pencatatan+'</option>';   
                    }
                }
                $comboroless.html(optionroless).on('change');

                var optionrolesss = '<option disabled>-- PILIH PARENT --</option>', $comborolesss = $('#satuan');
                for (index = 0; index < data[3].length; index++) 
                {
                    if (data[0].satuan_id == data[3][index].id) 
                    {
                        
                        optionrolesss+='<option  value="'+data[3][index].id+'" selected>'+data[3][index].satuan+'</option>';   
                    }
                    else
                    {
                        optionrolesss+='<option  value="'+data[3][index].id+'">'+data[3][index].satuan+'</option>';   
                    }
                }
                $comborolesss.html(optionrolesss).on('change');
        }
    });
})

</script>
@endsection