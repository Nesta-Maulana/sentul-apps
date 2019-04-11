@extends('utilityOnline.admin.templates.layout')
@section('title')
    Utility Online | Reports
@endsection
@section('active-report')
    active
@endsection
@section('content')
<!-- <style>
    .daterangepicker .dropdown-menu .ltr .opensleft .show-calendar{
        right: 0px !important;
    } 
</style> -->
<div class="row mt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Reports Penggunaan</h4>
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
                                <th>Nilai</th>
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
                                        @foreach($bagian as $b)
                                            @if($r->id_bagian == $b->id)
                                                <td>{{ $b->bagian }}</td>
                                            @endif
                                        @endforeach
                                    <td>{{ $r->nilai }}</td>
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
                <h4>Reports Pengamatan</h4>
            </div>
            <div class="row">
                <div class="col-lg-3 m-2">
                    <label for="tanggal">Tanggal : </label>
                    <br>
                    <input type="date" id="tanggal" class="form-control">
                    <label for="kategori">Kategori :</label>
                    <br>
                    <select name="kategori" id="kategori" class="form-control select2">
                        <option value="" selected disabled>-- PILIH KATEGORI --</option>
                        @foreach($kategori as $k)
                            <option value="{{ $k->id }}">{{ $k->kategori }}</option>
                        @endforeach
                    </select>
                    <br>
                    <label for="workcenter">Workcenter :</label>
                    <br>
                    <select name="workcenter" id="workcenter" class="form-control select2">
                        <option value="" selected disabled>-- PILIH WORKCENTER --</option>
                        @foreach($workcenter as $w)
                            <option value="{{ $w->id }}">{{ $w->workcenter }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-8">
                    <table id="tablePreview" class="table bg-white table-striped table-hover mt-3">
                        <!--Table head-->
                        <thead class="thead-dark">
                            <tr>
                            <th>#</th>
                            <th>Bagian</th>
                            <th>Input</th>
                            <th>Satuan</th>
                        
                            </tr>
                        </thead>
                        <!--Table head-->
                        <!--Table body-->
                        <tbody id="table">
                            
                        </tbody>
                        <!--Table body-->
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-6 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4>Line Chart</h4>
            </div>
            <div class="card-body">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4>Bar Chart</h4>
            </div>
            <div class="card-body">
                <canvas id="myChart2"></canvas>
            </div>
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4>Doughnut Chart</h4>
                </div>
                <div class="card-body">
                    <canvas id="myChart3"></canvas>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4>Pie Chart</h4>
                </div>
                <div class="card-body">
                    <canvas id="myChart4"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
        $('#kategori').attr('disabled', true);
        $('#workcenter').attr('disabled', true);
        $('#tanggal').change(function () {
            $('#kategori').attr('disabled', false);
            if($('#workcenter option:selected').val() == ""){

            }else{
                reload();
            }
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
                            var tanggal = $('#tanggal').val();
                            $.ajax({
                                url: '/sentul-apps/utility-online/database/bagian/' + id + '/' + tanggal,
                                method: 'GET',
                                dataType: 'JSON',
                                success: function (data) {
                                    var optionroles = '', $comboroles = $('#table');
                                    for (index = 0; index < data[0].length; index++) 
                                    {
                                        if(data[0][index].pengamatan.length > 0){
                                            for (indek = 0; indek < data[0][index].pengamatan.length; indek++)
                                            {   
                                            
                                                // optionroles+='<td>'+ data[0][index].pengamatan.nilai_meteran +'</td>';
                                                if(data[0][index].pengamatan[indek])
                                                {
                                                    console.log(data[0][index].pengamatan[indek].pengamatan_id);
                                                    
                                                    var nomor = nomor+1;
                                                    optionroles+='<tr>';
                                                    optionroles+='<td>'+ nomor +'</td>';
                                                    optionroles+='<td>'+ data[0][index].pengamatan[indek].bagian +'</td>';
                                                    optionroles+='<td>'+ data[0][index].pengamatan[indek].nilai_meteran +'</td>'
                                                    for (let i = 0; i < data[1].length; i++) {
                                                        if (data[0][index].satuan_id == data[1][i].id) {
                                                            optionroles+='<td>'+data[1][i].satuan+'</td>';
                                                        }
                                                    }
                                                    optionroles+='<td><button class="btn btn-primary edit" data-id="' + data[0][index].pengamatan[indek].pengamatan_id + '" data-tgl="' + data[0][index].pengamatan[indek].created_at + '" data-toggle="modal" data-target="#exampleModal">Edit</button> </td>';
                                                }
                                                else
                                                {
                                                    
                                                }
                                            }
                                        }else{
                                            var nomor = nomor+1;
                                            optionroles+='<tr>';
                                            optionroles+='<td>'+ nomor +'</td>';
                                            optionroles+='<td>'+ data[0][index].bagian +'</td>';
                                            optionroles+='<td> No Value </td>';
                                            for (let i = 0; i < data[1].length; i++) 
                                            {
                                                if (data[0][index].satuan_id == data[1][i].id) {
                                                    optionroles+='<td>'+data[1][i].satuan+'</td>';
                                                }
                                            }
                                            optionroles+='<td><button class="btn btn-primary edit" data-idBagian="'+ data[0][index].id +'" data-bagian="'+ data[0][index].bagian +'" data-id="" data-toggle="modal" data-target="#exampleModal">Edit</button></td>';
                                        }
                                        
                                        
                                        // optionroles+='<td> <button class="btn btn-primary" data-id="' + data[0][index].pengamatan.id + '">Edit</button> </td>';
                                        optionroles+='</tr>';
                                    }
                                    $comboroles.html(optionroles).on('change');
                                }
                            });
                        })
                    }
                });
            });
        });
        
</script>
@endsection
