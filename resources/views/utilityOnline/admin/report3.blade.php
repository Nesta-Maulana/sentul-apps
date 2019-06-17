@extends('utilityOnline.admin.templates.layout')
@section('title')
    Utility Online | Reports
@endsection
@section('active-report-3')
    active
@endsection
@section('content')
<input type="hidden" id="tgl-report-3-1">
<input type="hidden" id="tgl-report-3-2">
<meta name="csrf-token" content="{{ csrf_token() }}" />
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
<script>
        $('.export-3-info').show();
        $('.export-3').hide();
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
</script>
@endsection

