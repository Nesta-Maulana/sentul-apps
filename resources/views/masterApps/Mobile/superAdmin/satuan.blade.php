@extends('masterApps.Mobile.superAdmin.templates.layout')
@section('title')
    Master Apps
@endsection
@section('subtitle')
    Satuan
@endsection
@section('content')
    <input id="interval" type="hidden" data-tambah="{{ Session::get('tambah') }}"/>
    <div class="row">
        <div class="col-lg-5 mb-3 data-menu {{ Session::get('tambah') }}">
            <form action="satuan/data" method="post">
                {{ csrf_field() }}
                <input type="hidden" id="id" name="id">
                <div class="form-group">
                    <label for="satuan">Satuan :</label>
                    <input type="text" name="satuan" id="satuan" class="form-control">
                </div>
                <div class="form-group">
                    <label for="status">Status :</label>
                    <select name="status" id="status" class="form-control">
                        <option value="" selected disabled>-- PILIH SATUAN -- </option>
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                </div>
                <button class="btn btn-primary" id="simpan">Simpan</button>
                <button class="btn btn-primary" id="update">Update</button>
                <a class="btn btn-danger text-white" id="batal">Batal</a>
            </form>
        </div>
    </div>
    <div class="box tabel-menu">
        <div class="box-header">
            <h3 class="box-title">Table Satuan</h3>
        </div>

        <div class="box-body no-padding">
            <table class="table table-striped">
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Satuan</th>
                    <th>Status</th>
                    <th style="width: 70px">Aksi</th>
                </tr>
                <?php $i=1 ?>
                @foreach($satuan as $s)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $s->satuan }}</td>
                        @if($s->status == "1")
                            <td>Aktif</td>
                        @else
                            <td>Tidak Aktif</td>
                        @endif
                        <td>
                            <Button class="btn btn-primary edit {{ Session::get('ubah') }}" data-id="{{ $s->id }}">Edit</Button>
                        </td>
                    </tr>
                    <?php $i++ ?>
                @endforeach
            </table>
        </div>
    </div>
    <style>
    .margin-top{
        margin-top: -220px !important;
    }
    .margin-top-mobile{
        margin-top: -230px !important;
    }
    </style>
    <script src="{!! asset('masterApps/mobileStyle/superAdmin/js/jquery-3.3.1.min.js') !!}"></script>
    <script>
        $(document).ready(function () {
            $('#update').hide();
            $('#batal').hide();

            window.setInterval(function(){
                if($(window).width() <= 305){
                    $('.table').addClass('table-responsive');
                }else{
                    $('.table').removeClass('table-responsive');
                }
            }, 100);

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
            }

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
                    url: 'satuan/edit/' + id,
                    method: 'GET',
                    dataType: 'JSON',
                    success: function (data) {
                        $('#id').val(data.id);
                        $('#satuan').val(data.satuan);
                        $("#status option[value= '" + data.status + "']").prop('selected', true);
                    }
                });
            });
            $('#batal').click(function () {
                $('#interval').val("");
                $('#satuan').val("");
                $('#status').val("");
                $('#id').val("");
                $('#update').hide();
                $('#batal').hide();
                $('#simpan').show();
            });
        });
    </script>
@endsection