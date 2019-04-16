@extends('masterApps.templates.layout')
@section('title')
    Master Apps
@endsection
@section('subtitle')
    Kategori
@endsection
@section('content')
    <input id="interval" type="hidden" data-tambah="{{ Session::get('tambah') }}"/>
    <div class="container">
        <div class="row">
            <div class="col teks mt-3 rounded">
                    <form action="kategori/data" class="data-menu {{ Session::get('tambah') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" id="id">
                        <div class="row">
                            <div class="col-lg-4 ">
                                <div class="form-group">
                                    <label for="">Kategori :</label>
                                    <input type="text" id="kategori" name="kategori" class="form-control" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <br>
                                <button class="btn btn-primary mt-2" id="simpan">Simpan</button>
                                <button class="text-white btn btn-primary mt-2" id="update">Update</button>
                                <a class="text-white btn btn-danger mt-2" id="batal">Batal</a>
                            </div>
                        </div>
                    </form>
                    <table class="table bg-white mt-4 tabel-menu">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1 ?>
                            @foreach($kategori as $k)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>
                                        {{ $k->kategori }}
                                    </td>
                                    <td>
                                        <button class="btn btn-primary edit {{ Session::get('ubah') }}" id="edit" data-id="{{ $k->id }}">Edit</button>
                                    </td>
                                    <?php $i++ ?>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
<style>
.margin-top{
    margin-top: -70px !important;
}
.margin-top-mobile{
    margin-top: -150px !important;
}
</style>

<script src="{!! asset('masterApps/js/jquery-3.3.1.min.js') !!}"></script>
<script>
    $(document).ready(function () {
        $('#batal').hide();
        $('#update').hide();
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

        function setMargin()
        {
            if($(window).width() >= 992){
                $('.tabel-menu').removeClass('margin-top-mobile');
                $('.tabel-menu').addClass('margin-top');
            }else{
                $('.tabel-menu').removeClass('margin-top');
                $('.tabel-menu').addClass('margin-top-mobile');
            }
        }

        $('#batal').click(function(){
            if($('#interval').data('tambah') == 'hidden'){
                $('.data-menu').addClass('hidden');
            }else{

            }
            $('#interval').val("");
            $('#kategori').val("");
            $('#id').val("");
            $('#simpan').show();
            $('#update').hide();
            $('#batal').hide();
        });

        $('.edit').click(function () {
            $('#interval').val("edit");
            $('.data-menu').removeClass('hidden');
            $('.tabel-menu').removeClass('margin-top');
            $('.tabel-menu').removeClass('margin-top-mobile');
            $('#simpan').hide();
            $('#update').show();
            $('#batal').show();
            var id = $(this).data('id');
            $.ajax({
                url: 'kategori/edit/' + id,
                method: 'GET',
                dataType:'JSON',
                success: function(data)
                {
                    $('#kategori').val(data['kategori']);
                    $('#id').val(data['id']);
                }
            });
        });
        window.setInterval(function () {
        var cek = $('#interval').val();
        var tambah = $('#interval').data('tambah');
        if(cek == "" && tambah == "hidden"){
            // console.log('asdf');
            var myVar = setInterval( setMargin(), 200);
        }else {
            clearInterval(myVar);
            $('.tabel-menu').removeClass('margin-top-mobile');
            $('.tabel-menu').removeClass('margin-top');
        }
        }, 200);

        function setMargin(){
            // console.log('setMargin');
            if($(window).width() >= 992){
                // console.log('>');
                $('.tabel-menu').removeClass('margin-top-mobile');
                $('.tabel-menu').addClass('margin-top');
            }else{
                // console.log('<');
                $('.tabel-menu').removeClass('margin-top');
                $('.tabel-menu').addClass('margin-top-mobile');
            }
        }
    });

</script>
@endsection