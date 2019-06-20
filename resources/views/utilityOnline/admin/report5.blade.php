@extends('utilityOnline.admin.templates.layout')
@section('title')
    Utility Online | Reports 
@endsection
@section('active-report-5')
    active
@endsection
@section('content')
<input type="hidden" id="tgl-report-5-1">
<input type="hidden" id="tgl-report-5-2">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>Reports 1.5 | </h4>
                <a class="btn btn-primary text-white" id="export-5">Export</a>
                <button class="btn btn-primary text-white" id="info-export-5">Please Select Date Or Category</button>
            </div>
            <div class="row">
                <div class="col-lg-3 m-2">
                    <div class="input-group m-2">
                        <label for="" class="mt-2">Tanggal : </label>
                        <button type="button" class="btn btn-default pull-right ml-2" id="daterange-btn-5" name="inputRange" style="right: 0 !important;">
                            <span>
                                <i class="fa fa-calendar"></i> Date range picker
                            </span>
                            <i class="fa fa-caret-down"></i>
                        </button>
                    </div>
                    <div class="input-group m-2">
                        <label for="" class="mt-2">Kategori : </label>
                        <select name="kategori-5" id="kategori-5" class="form-control">
                            <option value="" selected disabled>-- PILIH KATEGORI --</option>
                            @foreach($kategori as $k)
                                <option value="{{ $k->id }}">{{ $k->kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-8 m-2">
                    <table id="tablePreview" class="table bg-white table-striped table-hover mt-3 table-5">
                        <!--Table head-->
                        <thead class="thead-dark">
                            <tr>
                            <th>#</th>
                            <th>Bagian</th>
                            <th>Nilai</th>
                            <th>Satuan</th>
                            <th>Tanggal Penggunaan</th>
                            </tr>
                        </thead>
                        <!--Table head-->
                        <!--Table body-->
                        <tbody id="table-report-5">
                            
                        </tbody>
                        <!--Table body-->
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
        $('#info-export-5').show();
        $('#export-5').hide();
        $('#tanggal-report-5').change(function () {
            var tgl = $('#tanggal-report-5').val();
            $.ajax({
                url: 'report-5/' + tgl,
                method: 'GET',
                dataType: 'JSON',
                success: function (data) {
                    var td = '';
                    for (let index = 0; index < data.length; index++) {
                        var no = index + 1;
                        td+='<tr>';
                        td+="<td>" + no + "</td>"
                        td+="<td>" + data[index].bagian + "</td>"
                        td+='</tr>';
                    }
                    $('#table-report-5').html(td).on('change');
                }
            });
        })
        $('#kategori-5').change(function(){
            $('#export-5').show();
            $('#info-export-5').hide();
            if($('#tgl-report-5-1').val() == "" && $('#tgl-report-5-1').val() == ""){
                $.ajax({
                    url: 'report-5/' + $('#kategori-5').val(),
                    method: 'GET',
                    dataType: 'JSON',
                    success: function (data) {
                        $(".table-5").DataTable().destroy();
                        $("#table-report-5").empty();
                        var table = "";
                        for (let i = 0; i < data.length; i++) {
                            var no = i + 1;
                            table+="<tr>";
                            table+="<td>" + no + "</td>"
                            table+="<td>" + data[i].bagian + "</td>";
                            table+="<td>" + data[i].nilai + "</td>";
                            table+="<td>" + data[i].satuan + "</td>";
                            table+="<td>" + data[i].tgl_penggunaan + "</td>";
                            table+="</tr>";   
                        }
                        $("#table-report-5").html(table).on('change');
                        $(".table-5").DataTable().order([4, 'asc']).draw();
                    }
                })
            } else{
                $.ajax({
                    url: 'report-5/' + $('#kategori-5').val() + '/' + $('#tgl-report-5-1').val() + '/' + $('#tgl-report-5-2').val(),
                    method: 'GET',
                    dataType: 'JSON',
                    success: function (data) {
                        $(".table-5").DataTable().destroy();
                        $("#table-report-5").empty();
                        var table = "";
                        for (let i = 0; i < data.length; i++) {
                            var no = i + 1;
                            table+="<tr>";
                            table+="<td>" + no + "</td>"
                            table+="<td>" + data[i].bagian + "</td>";
                            table+="<td>" + data[i].nilai + "</td>";
                            table+="<td>" + data[i].satuan + "</td>";
                            table+="<td>" + data[i].tgl_penggunaan + "</td>";
                            table+="</tr>";   
                        }
                        $("#table-report-5").html(table).on('change');
                        $(".table-5").DataTable().order([4, 'asc']).draw();
                    }
                })
            }

        })




        // Export
        $('#export-5').click(function () {
            if($('#kategori-5').val() == "" && $('#tgl-report-5-1').val() != "" && $('#tgl-report-5-2').val() != ""){        
                document.location.href='report-5/export/Penggunaan/utilityOnline/' + $('#tgl-report-5-1').val() + '/'  + $('#tgl-report-5-1').val();
            }
            else if($('#tgl-report-5-1').val() == "" && $('#tgl-report-5-2').val() == "" && $('#kategori-5').val() != ""){
                document.location.href='report-5/export/Penggunaan/utilityOnline/' + $('#kategori-5').val();                
            }
            else{
                if($('#kategori-5').val() == null){
                    document.location.href='report-5/export/Penggunaan/utilityOnline/' + $('#tgl-report-5-1').val() + '/'  + $('#tgl-report-5-2').val();
                }else{
                    document.location.href='report-5/export/Penggunaan/utilityOnline/' + $('#tgl-report-5-1').val() + '/'  + $('#tgl-report-5-2').val() + '/' + $('#kategori-5').val();
                }
            }
        })
</script>
@endsection