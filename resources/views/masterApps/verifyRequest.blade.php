@extends('masterApps.templates.layout')
@section('title')
    Master Apps
@endsection
@section('subtitle')
    Verify Request
@endsection
@section('content')

<div class="row mt-4">   
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="aplikasi">Aplikasi : </label>
                    <select name="aplikasi" id="aplikasiRequest" class="form-control aplikasi ">
                        <option value="" selected disabled> -- Pilih Aplikasi --</option>
                        @foreach($aplications as $aplication)
                            <option value="{{ $aplication->id }}"> {{ $aplication->aplikasi }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="user">User : </label>
                    <select class=" form-control" name="user" id="user">
                        <option selected disabled>-- Pilih User --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}"> {{ $user->karyawan->fullname }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="menu">Menu : </label>
                    <select class=" form-control" name="menu" id="menu">
                        <option selected disabled>-- Pilih Menu --</option>
                        @foreach($allMenu as $menu)
                            <option value="{{ $menu->id }}"> {{ $menu->menu }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="aksi">Aksi : </label>
                    <select class=" form-control" name="aksi" id="aksi">
                        <option selected disabled>-- Pilih Aksi --</option>
                        <option value="lihat">Lihat</option>
                        <option value="ubah">Ubah</option>
                        <option value="tambah">Tambah</option>
                        <option value="hapus">Hapus</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-9">
                <table class="table table-striped table-inverse basic-data-table" id="table-request">
                    <thead class="thead-inverse bg-dark text-white">
                        <tr>
                            <th>No.</th>
                            <th>User</th>
                            <th>Aplikasi</th>
                            <th>Menu</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach($requestHakAplikasi as $rh)
                            <?php $i++ ?>
                                <tr>
                                    <td>{{ $i  }}</td>
                                    <td>{{ $rh->head->user->karyawan->fullname }}</td>
                                    <td>{{ $rh->head->aplikasi->aplikasi }}</td>
                                    <td>{{ $rh->menu->menu }}</td>
                                    <td>{{ $rh->aksi }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    
    
    $('#aplikasiRequest').change(function () { 
        var id = $(this).val();
        $.ajax({
            url: 'verify-request/aplikasi/' + $(this).val(),
            method: 'get',
            dataType: 'JSON',
            success: function (data) {
                $('#table-request').DataTable().destroy();
                $('#table-request tbody').empty();
                var td = '';
                var no = 0;
                for (let i = 0; i < data.length; i++) {
                    no++;
                    td+="<tr>";
                    td+="<td>" + no + "</td>"
                    td+="<td>"+ data[i].user +"</td>"
                    td+="<td>"+ data[i].aplikasi +"</td>"
                    td+="<td>"+ data[i].menu.menu +"</td>"
                    td+="<td>"+ data[i].aksi +"</td>"
                    td+="</tr>";
                }
                $('#table-request tbody').append(td);
                $('#table-request').DataTable().draw();
            }
        })        
    });
    $('#user').change(function () {
        var id = $(this).val();
        $.ajax({
            url: 'verify-request/user/' + $(this).val(),
            method: 'get',
            dataType: 'JSON',
            success: function (data) {
                $('#table-request').DataTable().destroy();
                $('#table-request tbody').empty();
                var td = '';
                var no = 0;
                for (let i = 0; i < data.length; i++) {
                    no++;
                    td+="<tr>";
                    td+="<td>" + no + "</td>"
                    td+="<td>"+ data[i].user +"</td>"
                    td+="<td>"+ data[i].aplikasi +"</td>"
                    td+="<td>"+ data[i].menu.menu +"</td>"
                    td+="<td>"+ data[i].aksi +"</td>"
                    td+="</tr>";
                }
                $('#table-request tbody').append(td);
                $('#table-request').DataTable().draw();
            }
        })
    });
    $('#menu').change(function () {
        var id = $(this).val();
        $.ajax({
            url: 'verify-request/menu/' + $(this).val(),
            method: 'get',
            dataType: 'JSON',
            success: function (data) {
                $('#table-request').DataTable().destroy();
                $('#table-request tbody').empty();
                var td = '';
                var no = 0;
                for (let i = 0; i < data.length; i++) {
                    no++;
                    td+="<tr>";
                    td+="<td>" + no + "</td>"
                    td+="<td>"+ data[i].user +"</td>"
                    td+="<td>"+ data[i].aplikasi +"</td>"
                    td+="<td>"+ data[i].menu.menu +"</td>"
                    td+="<td>"+ data[i].aksi +"</td>"
                    td+="</tr>";
                }
                $('#table-request tbody').append(td);
                $('#table-request').DataTable().draw();
            }
        })
    });
    $('#aksi').change(function () {
        var id = $(this).val();
        $.ajax({
            url: 'verify-request/aksi/' + $(this).val(),
            method: 'get',
            dataType: 'JSON',
            success: function (data) {
                $('#table-request').DataTable().destroy();
                $('#table-request tbody').empty();
                var td = '';
                var no = 0;
                for (let i = 0; i < data.length; i++) {
                    no++;
                    td+="<tr>";
                    td+="<td>" + no + "</td>"
                    td+="<td>"+ data[i].user +"</td>"
                    td+="<td>"+ data[i].aplikasi +"</td>"
                    td+="<td>"+ data[i].menu.menu +"</td>"
                    td+="<td>"+ data[i].aksi +"</td>"
                    td+="</tr>";
                }
                $('#table-request tbody').append(td);
                $('#table-request').DataTable().draw();
            }
        })
    });
</script>
@endsection