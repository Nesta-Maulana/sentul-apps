@extends('utilityOnline.admin.templates.layout')
@section('title')
    Utility Online | Reports
@endsection
@section('active-report')
    active
@endsection
@section('content')
<input type="hidden" id="tgl-pengamatan-1">
<input type="hidden" id="tgl-pengamatan-2">
<input type="hidden" id="tgl-penggunaan-1">
<input type="hidden" id="tgl-penggunaan-2">
<input type="hidden" id="tgl-report-3-1">
<input type="hidden" id="tgl-report-3-2">
<input type="hidden" id="tgl-report-4-1">
<input type="hidden" id="tgl-report-4-2">
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
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>Reports Pengamatan | </h4>
                <a class="btn btn-primary export text-white" id="export-pengamatan">Export</a>
                <button id="export-pengamatan-info" class="btn btn-primary">Please Select Date</button>
            </div>
            <div class="row p-2">
                <div class="row p-2">
                    <div class="col-lg-4">
                        <div class="input-group m-2">
                            <label for="" class="mt-2">Tanggal : </label>
                            <button type="button" class="btn btn-default pull-right ml-2" id="daterange-btn-2" name="inputRange" style="right: 0 !important;">
                                <span>
                                    <i class="fa fa-calendar"></i> Date range picker
                                </span>
                                <i class="fa fa-caret-down"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="input-group">
                            <br>
                            <select name="kategori" id="kategori" class="form-control select2 mt-2">
                                <option value="" selected disabled>-- PILIH KATEGORI --</option>
                                @foreach($kategori as $k)
                                    <option value="{{ $k->id }}">{{ $k->kategori }}</option>
                                @endforeach
                            </select>
                            <br>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="input-group">                             
                            <br>
                            <select name="workcenter" id="workcenter" class="form-control select2 mt-2">
                                <option value="" selected disabled>-- PILIH WORKCENTER --</option>
                                @foreach($workcenter as $w)
                                    <option value="{{ $w->id }}">{{ $w->workcenter }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mt-2">
                    <table id="table-pengamatan" class="table bg-white table-striped table-hover mt-3">
                        <!--Table head-->
                        <thead class="thead-dark">
                            <tr>
                            <th>#</th>
                            <th>Bagian</th>
                            <th>Input</th>
                            <th>Satuan</th>
                            <th>Tanggal Input</th>
                            </tr>
                        </thead>
                        <!--Table head-->
                        <!--Table body-->
                        <tbody id="isi-table-pengamatan">
                        </tbody>
                        <!--Table body-->
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>Reports 1.3 | </h4>
                <a class="btn btn-primary text-white export-3">Export</a>
                <a class="btn btn-primary text-white export-3-info">Please Select Date Or Category</a>
            </div>
            <div class="row">
                <div class="col-lg-3 m-2">
                    <div class="input-group m-2">
                        <label for="" class="mt-2">Tanggal : </label>
                        <button type="button" class="btn btn-default pull-right ml-2" id="daterange-btn-3" name="inputRange" style="right: 0 !important;">
                            <span>
                                <i class="fa fa-calendar"></i> Date range picker
                            </span>
                            <i class="fa fa-caret-down"></i>
                        </button>
                    </div>
                    <div class="input-group m-2">
                        <select name="kategori3" id="kategori3" class="form-control select2">
                            <option value="" selected disabled>-- Choose Category --</option>
                            @foreach($kategori as $b)
                                <option value="{{ $b->id }}">{{ $b->kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-8">
                    <table id="tablePreview" class="table table-3 bg-white table-striped table-hover mt-3">
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
                        <tbody id="table-report-3">
                            
                        </tbody>
                        <!--Table body-->
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>Reports 1.4 | </h4>
                <a class="btn btn-primary text-white" id="export-4">Export</a>
                <button class="btn btn-primary text-white" id="info-export-4">Please Select Date Or Category</button>
            </div>
            <div class="row">
                <div class="col-lg-3 m-2">
                    <div class="input-group m-2">
                        <label for="" class="mt-2">Tanggal : </label>
                        <button type="button" class="btn btn-default pull-right ml-2" id="daterange-btn-4" name="inputRange" style="right: 0 !important;">
                            <span>
                                <i class="fa fa-calendar"></i> Date range picker
                            </span>
                            <i class="fa fa-caret-down"></i>
                        </button>
                    </div>
                    <div class="input-group m-2">
                        <label for="" class="mt-2">Kategori : </label>
                        <select name="kategori-4" id="kategori-4" class="form-control">
                            <option value="" selected disabled>-- PILIH KATEGORI --</option>
                            @foreach($kategori as $k)
                                <option value="{{ $k->id }}">{{ $k->kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-8">
                    <table id="tablePreview" class="table bg-white table-striped table-hover mt-3 table-4">
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
                        <tbody id="table-report-4">
                            
                        </tbody>
                        <!--Table body-->
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
        $('#export-pengamatan').hide();
        $('#export-pengamatan-info').show();
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
        $('#kategori').change(function () {
            var id = $('#kategori option:selected').val();
            $.ajax({
                url: '/sentul-apps/utility-online/database/workcenter/' + id,
                method: 'GET',
                dataType: 'JSON',
                success: function (data) {
                    var optionroles = '', $comboroles = $('#workcenter');
                    $('#workcenter').attr('disabled', false);
                    optionroles+='<option selected disabled>-- PILIH WORKCENTER --</option>';
                    for (index = 0; index < data.length; index++)
                    {
                        optionroles+='<option value="'+data[index].id+'">'+data[index].workcenter+'</option>'
                    }
                    $comboroles.html(optionroles).on('change');

                    $('#workcenter').change(function () {
                        var id = $("#workcenter option:selected").val();
                        var tgl1 = $('#tgl-pengamatan-1').val();
                        var tgl2 = $('#tgl-pengamatan-2').val();
                        $.ajax({
                            url: '/sentul-apps/utility-online/admin/report/bagian/' + id + '/' + tgl1 + '/' + tgl2,
                            method: 'GET',
                            dataType: 'JSON',
                            success: function (data) {
                                $('#table-pengamatan').DataTable().destroy();
                                $('#isi-table-pengamatan').empty();
                                var no = 1;
                                for (let index = 0; index < data.length; index++) 
                                {
                                    for (let i = 0; i < data[index].pengamatan.length; i++) {
                                    var table = '<tr>';
                                        table+='<td>' + no + '</td>'
                                        table+='<td>' + data[index].bagian + '</td>';
                                        if(!data[index].pengamatan[i][0]){
                                            table+='<td> Tidak melakukan pengamatan </td>'
                                        }else{
                                            table+='<td>'+ data[index].pengamatan[i][0].nilai_meteran+'</td>'
                                        }
                                        table+='<td>'+ data[index].satuan_id +'</td>'
                                        table+='<td>'+ data[index].pengamatan[i][1] +'</td>'
                                        table+='</tr>';          
                                        $("#isi-table-pengamatan").append(table);     
                                        no++;
                                    }
                                }
                                $('#table-pengamatan').DataTable().order([4, 'asc']).draw();
                            }
                        });
                    })
                }
            });
        });
        $('#tanggal-report-4').change(function () {
            var tgl = $('#tanggal-report-4').val();
            $.ajax({
                url: 'report-4/' + tgl,
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
                    $('#table-report-4').html(td).on('change');
                }
            });
        })
        $('#export-pengamatan').click(function () {
            var tgl = $('#tgl-pengamatan-1').val();
            var tgl2 = $('#tgl-pengamatan-2').val();
            document.location.href='report/export/pengamatan/utility-oline/' + tgl + '/' + tgl2;        
        })
        $('#export-penggunaan').click(function () {
            var tgl = $('#tgl-penggunaan-1').val();
            var tgl2 = $('#tgl-penggunaan-2').val();
            var id = $('#kategori-penggunaan').val();
            document.location.href='report/export/penggunaan/utility-online/' + id + '/' + tgl + '/' + tgl2;  
        })
        $('#kategori3').change(function () {
            $('.export-3').show();
            $('.export-3-info').hide();
            if($('#tgl-report-3-1').val()){
                $.ajax({
                    url: 'report-3/' + $(this).val() + '/' + $('#tgl-report-3-1').val() +'/' + $('#tgl-report-3-2').val(),
                    method: 'GET',
                    dataType: 'JSON',
                    success: function (data) { 
                        $('.table-3').DataTable().destroy();
                        $('.table-3 tbody').empty();
                        
                        var td = '';
                        for (let index = 0; index < data.length; index++) {
                            var no = index + 1;
                            td+='<tr>';
                            td+='<td>'+no+'</td>';
                            td+='<td>'+data[index].bagian+'</td>'
                            td+='<td>'+data[index].nilai+'</td>'
                            td+='<td>'+data[index].satuan+'</td>'
                            td+='<td>'+data[index].tanggal_penggunaan+'</td>'
                            td+='</tr>';
                        }
                        $('#table-report-3').html(td).on('change');
                        $('.table-3').DataTable().order([4, 'asc']).draw({});
                    }
                });
            }else{
                $.ajax({
                    url: 'report-3/' + $(this).val(),
                    method: 'GET',
                    dataType: 'JSON',
                    success: function (data) { 
                        
                        var td = '';
                        for (let index = 0; index < data.length; index++) {
                            var no = index + 1;
                            td+='<tr>';
                            td+='<td>'+no+'</td>';
                            td+='<td>'+data[index].bagian+'</td>'
                            td+='<td>'+data[index].nilai+'</td>'
                            td+='<td>'+data[index].satuan+'</td>'
                            td+='<td>'+data[index].tanggal_penggunaan+'</td>'
                            td+='</tr>';
                        }
                        // $('.table-3').DataTable().destroy();
                        $('.table-3 tbody').empty();
                        $('#table-report-3').html(td).on('change');
                        $('.table-3').DataTable().order([4, 'asc']).draw({});
                    }
                });
            }
        })
        $('#kategori-4').change(function(){
            $('#export-4').show();
            $('#info-export-4').hide();
            if($('#tgl-report-4-1').val() == "" && $('#tgl-report-4-1').val() == ""){
                $.ajax({
                    url: 'report-4/' + $('#kategori-4').val(),
                    method: 'GET',
                    dataType: 'JSON',
                    success: function (data) {
                        $(".table-4").DataTable().destroy();
                        $("#table-report-4").empty();
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
                        $("#table-report-4").html(table).on('change');
                        $(".table-4").DataTable().order([4, 'asc']).draw();
                    }
                })
            } else{
                $.ajax({
                    url: 'report-4/' + $('#kategori-4').val() + '/' + $('#tgl-report-4-1').val() + '/' + $('#tgl-report-4-2').val(),
                    method: 'GET',
                    dataType: 'JSON',
                    success: function (data) {
                        $(".table-4").DataTable().destroy();
                        $("#table-report-4").empty();
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
                        $("#table-report-4").html(table).on('change');
                        $(".table-4").DataTable().order([4, 'asc']).draw();
                    }
                })
            }

        })

        // Export
        $('.export-3').click(function () {
            if($('#kategori').val() == ""){        
                document.location.href='report/export-3/Penggunaan/utilityOnline/' + $('#tgl-report-3-1').val() + '/'  + $('#tgl-report-3-1').val();
            }
            else if($('#tgl-report-3-1').val() == "" && $('#tgl-report-3-2').val() == ""){
                document.location.href='report/export-3/Penggunaan/utilityOnline/' + $('#kategori3').val();                
            }
            else{
                document.location.href='report/export-3/Penggunaan/utilityOnline/' + $('#tgl-report-3-1').val() + '/'  + $('#tgl-report-3-1').val() + '/' + $('#kategori3').val();
            }
        })

        $('#export-4').click(function () {
            if($('#kategori-4').val() == "" && $('#tgl-report-4-1').val() != "" && $('#tgl-report-4-2').val() != ""){        
                document.location.href='report-4/export/Penggunaan/utilityOnline/' + $('#tgl-report-4-1').val() + '/'  + $('#tgl-report-4-1').val();
            }
            else if($('#tgl-report-4-1').val() == "" && $('#tgl-report-4-2').val() == "" && $('#kategori-4').val() != ""){
                document.location.href='report-4/export/Penggunaan/utilityOnline/' + $('#kategori-4').val();                
            }
            else{
                if($('#kategori-4').val() == null){
                    document.location.href='report-4/export/Penggunaan/utilityOnline/' + $('#tgl-report-4-1').val() + '/'  + $('#tgl-report-4-2').val();
                }else{
                    document.location.href='report-4/export/Penggunaan/utilityOnline/' + $('#tgl-report-4-1').val() + '/'  + $('#tgl-report-4-2').val() + '/' + $('#kategori-4').val();
                }
            }
        })
</script>
@endsection

