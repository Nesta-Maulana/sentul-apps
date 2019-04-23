@extends('masterApps.templates.layout')
@section('title')
    Master Apps
@endsection
@section('subtitle')
    Aplikasi
@endsection
@section('content')

    {!! Form::open(['route' => 'aplikasi-save', 'method' => 'POST']) !!}
        <input type="hidden" id="id" name="id">
        <div class="row">
            <div class="col-lg-4 data-menu {{ Session::get('tambah') }}">
                <div class="form-group">
                    <label for="aplikasi">Aplikasi : </label>
                    <input type="text" class="form-control" name="aplikasi" id="aplikasi">
                </div>
                <div class="form-group">
                    <label for="status">Status : </label>
                    <select class="form-control" id="status" name="status">
                        <option value="" selected disabled>-- PILIH STATUS --</option>
                        <option value="0">Tidak Aktif</option>
                        <option value="1">Aktif</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="link">link : </label>
                    <input type="text" class="form-control" name="link" id="link">
                </div>
                <button class="btn btn-primary simpan">Simpan</button>
                <button class="btn btn-primary update">Update</button>
                <a href="#" class="btn btn-danger batal">Batal</a>
            </div>
            <div class="col-lg-8">
                <div class="box">
                    <table class="table text-center table-bordered table-striped" id="table-aplikasi">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>#</th>
                                <th>Aplikasi</th>
                                <th>Status</th>
                                <th>Link</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=0 ?>
                            @foreach($aplikasi as $a)
                                <?php $i++ ?>
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $a->aplikasi }}</td>
                                    @if($a->status == '0')
                                        <td>Tidak Aktif</td>
                                    @else
                                        <td>Aktif</td>
                                    @endif
                                    <td>{{ $a->link }}</td>
                                    <td>
                                        <a href="#" onclick="edit('{{ $a->id }}')" class="btn btn-primary edit text-white">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    {!! Form::close() !!}

<script>
    $('.update').hide();
    $('.batal').hide();
    function edit(id) {
        $.ajax({
            url: 'aplikasi/'+id,
            method: 'GET',
            dataType: 'JSON',
            success: function (data) {
                $('#aplikasi').val(data.aplikasi);
                $('#link').val(data.link);
                $('#id').val(data.id);
                $("#status option[value= '" + data.status + "']").prop('selected', true);
                $('.update').show();
                $('.batal').show();
                $('.simpan').hide();
            }
        });
    }
    $('.batal').click(function () {
        $('#aplikasi').val("");
        $('#link').val("");
        $('#id').val("");
        $('#status').val("");
        $('.update').hide();
        $('.batal').hide();
        $('.simpan').show();
    })
</script>

@endsection