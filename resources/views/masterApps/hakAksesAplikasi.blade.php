@extends('masterApps.templates.layout')
@section('title')
    Master Apps
@endsection
@section('subtitle')
    Hak Akses Aplikasi
@endsection
@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="form-group">
            <select name="user" id="user" class="form-control">
                <option value="" selected disabled>-- PILIH USER --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->karyawan->fullname }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="box">
            <table class="table text-center table-bordered table-striped" id="table-aplikasi">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>#</th>
                        <th>Aplikasi</th>
                        <th>Hak Akses </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=0 ?>
                    <!-- @foreach($hakAksesAplikasi as $a)
                        <?php $i++ ?>
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $a->aplikasi->aplikasi }}</td>
                            <td>{{ $a->user->karyawan->fullname }}</td>
                            <td></td>
                        </tr>
                    @endforeach -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $('#user').change(function () {
        reload();
    })
    function reload() {
        var id = $('#user option:selected').val();
        $.ajax({
            url: 'hak-akses-aplikasi/user/' + id,
            method: 'GET',
            dataType: 'JSON',
            success: function (data) {
                // $('#table-aplikasi tbody');
                
                var optionroles="";
                for (index = 0; index < data[0].length; index++) 
                {
                    var no = index + 1;
                    optionroles += '<tr>';
                    optionroles += '<td>'+no+'</td>';
                    for (let i = 0; i < data[1].length; i++) {
                        if (data[0][index].id_aplikasi == data[1][i].id) {
                            optionroles += '<td>'+data[1][i].aplikasi+'</td>';       
                        }
                    }
                    if(data[0][index].status == '1'){
                        optionroles += '<td><button class="btn btn-success"  onclick="ubahHakAkses('+data[0][index].id+',0)">Aktif</button></td>';
                    }else{
                        optionroles += '<td><button class="btn btn-danger" onclick="ubahHakAkses('+data[0][index].id+',1)">Tidak Aktif</button></td>';
                    }
                    optionroles += '</tr>';
                }
                    $('#table-aplikasi tbody').html(optionroles).on('change');
            }
        })
    }
    function ubahHakAkses(id, aksi) {
        $.ajax({
            url: 'hak-akses-aplikasi/ubah-hak-akses/' + id + '/' + aksi,
            method: 'GET',
            dataType: 'JSON',
            success: function (data) {
                swal({
                    title: 'Berhasil',
                    text: 'Berhasil Mengubah Hak Akses',
                    type: 'success',
                });
                reload();
            }
        })
    }
</script>

@endsection