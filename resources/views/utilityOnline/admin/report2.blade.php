@extends('utilityOnline.admin.templates.layout')
@section('title')
    Utility Online | Reports
@endsection
@section('active-report-pengamatan')
    active
@endsection
@section('content')
<input type="hidden" id="tgl-pengamatan-1">
<input type="hidden" id="tgl-pengamatan-2">
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
<script>
        $('#export-pengamatan').hide();
        $('#export-pengamatan-info').show();
        $('#kategori').attr('disabled', true);
        $('#workcenter').attr('disabled', true);
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
        $('#export-pengamatan').click(function () {
            var tgl = $('#tgl-pengamatan-1').val();
            var tgl2 = $('#tgl-pengamatan-2').val();
            document.location.href='report/export/pengamatan/utility-oline/' + tgl + '/' + tgl2;        
        })
        
</script>
@endsection

