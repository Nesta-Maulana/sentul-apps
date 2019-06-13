@extends('hakAkses.templates.layout')
@section('judul')
    Request Hak Akses
@endsection
@section('active-hak-akses')
    active
@endsection
@section('slogan')
    Request your <span>Hak Akses</span>
@endsection
@section('link-to-content')
    #hak-akses
@endsection
@section('content')
<?php $idUser = app('App\Http\Controllers\resourceController')->enkripsi(session()->get('login')) ?>
    <div class="row" id="hak-akses">
        <div class="col-lg-2"></div>
        <div class="col-lg-8 info-panel mt-5">
            {!! Form::open(['route' => 'request-hak-akses', 'method' => 'POST']) !!}
                <div class="form-group">
                    <label for="aplikasi">Aplikasi</label>
                    <select name="aplikasi" id="aplikasi" class="form-control select2">
                        <option value="" selected disabled>-- PILIH APLIKASI --</option>
                        @foreach($aplications as $aplication)
                        <?php $id=app('App\Http\Controllers\resourceController')->enkripsi($aplication->id) ?>
                            <option value="{{ $id }}">{{ $aplication->aplikasi }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <a class="btn btn-primary text-white" id="selectAll">Select All Menu</a>
                </div>
                <table class="table mt-2 text-center table-hak-akses text-vertical-center" border='1'>
                    <thead>
                        <tr>
                            <th style="vertical-align: middle;">No</th>
                            <th style="vertical-align: middle;">Menu</th>
                            <th>Read</th>
                            <th>Create</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
                <button class="btn btn-primary float-right" id="request">Request</button>
                <input type="hidden" name="nilai_hak_akses" id="nilai_hak_akses">
            {!! Form::close() !!}
        </div>
    </div>
<script>    
                
    setInterval(function() {
        if($(window).width() <= 570){
            $('.table-hak-akses').addClass('table-responsive');
        }else{
            $('.table-hak-akses').removeClass('table-responsive');
        }
    }, 100);

    $('#aplikasi').change(function () {
        const id = $(this).val();
        $.ajax({
            url: 'request-hak-akses/aplication/' + $('#aplikasi').val() +  '/' + "{{ $idUser }}",
            method: 'GET',
            dataType: 'JSON',
            success: function (data) { 
                $('.table-hak-akses tbody').empty();
                
                var no = 1;
                for (var index = 0; index < data.length; index++) 
                {
                    var $table = "<tr>";
                    $table += "<td>"+no+"</td>";
                    $table += "<td>"+data[index].menu+"</td>";
                    if (data[index].lihat =='1') 
                    {
                        $table+="<td> <label for=''>Y</label> <input type='radio'  name='lihat_" + index + "' value='" +data[index].id+ "_1' checked> <label for=''>T</label> <input type='radio' name='lihat_" + index + "' value='" +data[index].id+ "_0'> </td>"; 
                    }
                    else
                    {
                        $table += "<td> <label for=''>Y</label> <input type='radio' name='lihat_" + index + "' value='" +data[index].id+ "_1'> <label for=''>T</label> <input type='radio' name='lihat_" + index + "' value='" +data[index].id+ "_0' checked> </td>";
                    }
                    if (data[index].tambah =='1') 
                    {
                        $table+="<td> <label for=''>Y</label> <input type='radio' name='tambah_" + index + "' value='" +data[index].id+ "_1' checked> <label for=''>T</label> <input type='radio' name='tambah_" + index + "' value='" +data[index].id+ "_0'> </td>"; 
                    }
                    else
                    {
                        $table += "<td> <label for=''>Y</label> <input type='radio' name='tambah_" + index + "' value='" +data[index].id+ "_1'> <label for=''>T</label> <input type='radio' name='tambah_" + index + "' value='" +data[index].id+ "_0' checked> </td>";     
                    }
                    if (data[index].ubah =='1') 
                    {
                        $table+="<td> <label for=''>Y</label> <input type='radio' name='ubah_" + index + "' value='" +data[index].id+ "_1' checked> <label for=''>T</label> <input type='radio' name='ubah_" + index + "' value='" +data[index].id+ "_0'> </td>"; 
                    }
                    else
                    {
                        $table += "<td> <label for=''>Y</label> <input type='radio' name='ubah_" + index + "' value='" +data[index].id+ "_1'> <label for=''>T</label> <input type='radio' name='ubah_" + index + "' value='" +data[index].id+ "_0' checked> </td>"; 
                    }        
                    if (data[index].hapus =='1') 
                    {
                        $table+="<td> <label for=''>Y</label> <input type='radio' name='hapus_" + index + "' value='" +data[index].id+ "_1' checked> <label for=''>T</label> <input type='radio' name='hapus_" + index + "' value='" +data[index].id+ "_0'> </td>"; 
                    }
                    else
                    {
                        $table += "<td> <label for=''>Y</label> <input type='radio' name='hapus_" + index + "' value='" +data[index].id+ "_1'> <label for=''>T</label> <input type='radio' name='hapus_" + index + "' value='" +data[index].id+ "_0' checked> </td>"; 
                    }
                    $table+="</tr>";
                    no++;
                    $(".table-hak-akses tbody").append($table);               
                }
                $('#nilai_hak_akses').val(index);
            }
        })
    })
    $('#selectAll').click(function () {
        const id = $('#aplikasi').val();
        $.ajax({
            url: 'request-hak-akses/aplication/' + $('#aplikasi').val() +  '/' + "{{ $idUser }}",
            method: 'GET',
            dataType: 'JSON',
            success: function (data) { 
                $('.table-hak-akses tbody').empty();
                var no = 1;
                for (let index = 0; index < data.length; index++) 
                {
                    var $table = "<tr>";
                    $table += "<td>"+no+"</td>";
                    $table += "<td>"+data[index].menu+"</td>";
                    $table+="<td> <label for=''>Y</label> <input type='radio'  name='lihat_" + index + "' value='" +data[index].id+ "_1' checked> <label for=''>T</label> <input type='radio' name='lihat_" + index + "' value='" +data[index].id+ "_0'> </td>"; 
                    $table+="<td> <label for=''>Y</label> <input type='radio' name='tambah_" + index + "' value='" +data[index].id+ "_1' checked> <label for=''>T</label> <input type='radio' name='tambah_" + index + "' value='" +data[index].id+ "_0'> </td>"; 
                    $table+="<td> <label for=''>Y</label> <input type='radio' name='ubah_" + index + "' value='" +data[index].id+ "_1' checked> <label for=''>T</label> <input type='radio' name='ubah_" + index + "' value='" +data[index].id+ "_0'> </td>"; 
                    $table+="<td> <label for=''>Y</label> <input type='radio' name='hapus_" + index + "' value='" +data[index].id+ "_1' checked> <label for=''>T</label> <input type='radio' name='hapus_" + index + "' value='" +data[index].id+ "_0'> </td>"; 
                    $table+="</tr>";
                    no++;
                    $(".table-hak-akses tbody").append($table);               

                }
            }
        })
    })

</script>
@endsection
