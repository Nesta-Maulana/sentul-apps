@extends('utilityOnline.admin.templates.layout')
@section('title')
    Utility Online | Reports
@endsection
@section('active-report-penggunaan')
    active
@endsection
@section('content')
<input type="hidden" id="tgl-penggunaan-1">
<input type="hidden" id="tgl-penggunaan-2">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="row mt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-5">
                        <h4>Reports Penggunaan | </h4>
                    </div>
                    <div class="col-lg-4">
                        <select name="" id="kategori-penggunaan" class="form-control">
                            <option value="" disabled selected>-- PILIH KATEGORI --</option>
                            @foreach($kategori as $k)
                            <option value="{{ $k->id }}">{{ $k->kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2">
                        <button id="export-penggunaan-info" class="btn btn-primary">Please Select Date Or Category</button>
                        <a class="btn btn-primary text-white" id="export-penggunaan">Export</a>
                    </div>
                </div>
            </div> 
            <div class="row mt-2">
                <div class="col-lg-9"></div>
                <div class="col-lg-3">
                    <div class="input-group">
                        <button type="button" class="btn btn-default pull-right ml-2" id="daterange-btn" name="inputRange" style="right: 0 !important;">
                            <span>
                                <i class="fa fa-calendar"></i> Date range picker
                            </span>
                            <i class="fa fa-caret-down"></i>
                        </button>
                    </div>
                </div>
            </div>   
            
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>                                 
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th>Bagian</th>
                                <th>Nilai (NFI)</th>
                                <th>Nilai (HNI)</th>
                                <th>Tanggal Penggunaan</th>     
                                <th>Aksi</th>                       
                            </tr>
                        </thead>
                        <tbody id="isi"> 
                            <?php $i=0 ?>                                
                            
                            @foreach($report as $r)
                                <?php $i++ ?>
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $r->bagian->bagian }}</td>
                                    <td>{{ $r->nilai_nfi }}</td>
                                    <td>{{ $r->nilai_hni }}</td>
                                    <td>{{ $r->tgl_penggunaan }}</td>
                                    <td><a href="report/detail/{{$r->id_bagian}}/{{$r->tgl_penggunaan}}" class="btn btn-primary text-white">Lihat Detail</a></td>
                                </tr>
                            @endforeach 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> 
</div>
<script>
        $('#export-penggunaan').hide();
        $('#export-penggunaan-info').show();
        $('.export-3-info').show();
        $('#info-export-4').show();
        $('#export-4').hide();
        $('.export-3').hide();
        $('#kategori').attr('disabled', true);
        $('#workcenter').attr('disabled', true);
        $('#kategori-penggunaan').change(function () {
            if($('#tgl-penggunaan-1').val() != null){
                $.ajax({
                    url: 'report/' + $(this).val() + '/' + $('#tgl-penggunaan-1').val() + '/' + $('#tgl-penggunaan-1').val(),
                    method: 'GET',
                    dataType: 'JSON',
                    success: function (data) {
                        $('#export-penggunaan').show();
                        $('#export-penggunaan-info').hide();
                        $('#table-1').DataTable().destroy();
                        $('#isi').empty();
                        var no = 1;
                        for (let index = 0; index < data[0].length; index++) {
                            for (let i = 0; i < data[1].length; i++) {
                                if (data[0][index].id_bagian == data[1][i].id) {
                                    var $table = "<tr>";
                                    $table += "<td>" + no + "</td>";
                                    $table += "<td>" + data[1][i].bagian + "</td>";
                                    $table += "<td>" + data[0][index].nilai_nfi + "</td>";
                                    $table += "<td>" + data[0][index].nilai_hni + "</td>";
                                    $table += "<td>" + data[0][index].tgl_penggunaan + "</td>";
                                    $table += '<td><a href="report/detail/' + data[0][index].id_bagian + '/' + data[0][index].tgl_penggunaan + '" class="btn btn-primary text-white">Lihat Detail</a></td>';
                                    $table += "</tr>";
                                    no++;
                                    $("#isi").append($table);
                                }
                            }
                        }
                        $('#table-1').DataTable({
                            "columnDefs": [{
                                "sortable": false,
                                "targets": [2, 3]
                            }]
                        }).draw();
                    }
                })
            }else{
                $.ajax({
                    url: 'report/' + $('#tgl-penggunaan-1').val() + '/' + $('#tgl-penggunaan-1').val(),
                    method: 'GET',
                    dataType: 'JSON',
                    success: function (data) {
                        $('#table-1').DataTable().destroy();
                        $('#isi').empty();
                        var no = 1;
                        for (let index = 0; index < data[0].length; index++) {
                            for (let i = 0; i < data[1].length; i++) {
                                if (data[0][index].id_bagian == data[1][i].id) {
                                    var $table = "<tr>";
                                    $table += "<td>" + no + "</td>";
                                    $table += "<td>" + data[1][i].bagian + "</td>";
                                    $table += "<td>" + data[0][index].nilai_nfi + "</td>";
                                    $table += "<td>" + data[0][index].nilai_hni + "</td>";
                                    $table += "<td>" + data[0][index].tgl_penggunaan + "</td>";
                                    $table += '<td><a href="report/detail/' + data[0][index].id_bagian + '/' + data[0][index].tgl_penggunaan + '" class="btn btn-primary text-white">Lihat Detail</a></td>';
                                    $table += "</tr>";
                                    no++;
                                    $("#isi").append($table);
                                }
                            }
                        }
                        $('#table-1').DataTable({
                            "columnDefs": [{
                                "sortable": false,
                                "targets": [2, 3]
                            }]
                        }).draw();
                    }
                })
            }
        })
        $('#export-penggunaan').click(function () {
            if($('#kategori-penggunaan').val() == "" && $('#tgl-penggunaan-1').val() != "" && $('#tgl-penggunaan-1').val() != ""){        
                document.location.href='/sentul-apps/utility-online/admin/report/export/penggunaan/UtilityOnline/' + $('#tgl-penggunaan-1').val() + '/'  + $('#tgl-penggunaan-1').val();
            }
            else if($('#tgl-penggunaan-1').val() == "" && $('#tgl-penggunaan-2').val() == ""){
                document.location.href='/sentul-apps/utility-online/admin/report/export/penggunaan/UtilityOnline/' + $('#kategori-penggunaan').val();                
            }
            else{
                if($('#kategori-4').val() == null){
                    document.location.href='/sentul-apps/utility-online/admin/report/export/penggunaan/UtilityOnline/' + $('#tgl-penggunaan-1').val() + '/'  + $('#tgl-penggunaan-1').val();
                }else{
                    document.location.href='/sentul-apps/utility-online/admin/report/export/penggunaan/UtilityOnline/'  + '/' + $('#kategori-penggunaan').val() + $('#tgl-penggunaan-1').val() + '/'  + $('#tgl-penggunaan-2').val();
                }
            }
        })
</script> 
@endsection

