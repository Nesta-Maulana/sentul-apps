@extends('utilityOnline.admin.templates.layout')
@section('title')
    Utility Online | Reports
@endsection
@section('active-report-grafik-perhari')
    active
@endsection
@section('content')
<div class="section-header">
    <h1>Report 3 Grafik Perhari</h1>
</div>
<div class="row bg-white p-2 rounded" style="box-shadow: 1px 1px 5px #000">
    <div class="col-lg-3">
        <div class="form-group">
            <label for="">Tahun : </label>
            <select name="tahun" id="tahun" class="form-control">
                <option value="" selected disabled>-- PILIH TAHUN --</option>
                <option value="2017">2017</option>
                <option value="2018">2018</option>
                <option value="2019">2019</option>
                <option value="2020">2020</option>
            </select>
        </div>
    </div>
    <div class="col-lg-2">
        <div class="form-group">
            <label for="">Bulan : </label>
            <select name="bulan" id="bulan" class="form-control">
                <option value="" selected disabled>-- PILIH BULAN --</option>
                @for($i = 1; $i <= 12; $i++) <option value="{{ $i }}">{{$i}}</option>
                    @endfor
            </select>
        </div>
    </div>
    <div class="col-lg-2">
        <div class="form-group">
            <label for="">Kategori : </label>
            <select name="kategori" id="kategori" class="form-control">
                <option value="" selected disabled>-- PILIH KATEGORI --</option>
                @foreach($kategori as $k)
                <option value="{{ $k->id }}">{{ $k->kategori }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label for="">Bagian : </label>
            <select name="bagian" id="bagian" class="form-control ">
                <option value="" selected disabled>-- PILIH BAGIAN --</option>
                
            </select>
        </div>
    </div>
</div>
<div id="perhari" class="mt-4 p-2 rounded" style="box-shadow: 1px 1px 5px #000"></div>


<script>
    $('#bulan').attr('disabled', true);
    $('#kategori').attr('disabled', true);
    $('#bagian').attr('disabled', true);
    $('#workcenter').attr('disabled', true);
    $("#tahun").change(function () { 
        $('#bulan').attr('disabled', false);
        $('#bulan').change(function () {
            $('#kategori').attr('disabled', false);
            $('#kategori').change(function () {
                $('#bagian').attr('disabled', false);
                var id = $('#kategori option:selected').val();
                $.ajax({
                    url: '/sentul-apps/utility-online/admin/option/report-3/bagian/' + id,
                    method: 'GET',
                    dataType: 'JSON',
                    success: function (data) {
                        $('#bagian').attr('disabled', false);
                        var option = "";
                        
                        for (let i = 0; i < data.length; i++) {
                            option+="<option value='"+ data[i] +"'>"+ data[i] +"</option>"
                        }
                        $('#bagian').html(option).on('change');
                        $("#bagian").change(function () {
                            penggunaanGrafikPerHari($(this).val());
                        })
                    }
                });
            })
        })
     })
    function penggunaanGrafikPerHari(id) { 
        $.ajax({
            url: '/sentul-apps/utility-online/admin/report-3/perhari/'+ $("#tahun").val() +'/'+ $('#bulan').val() +'/' + id,
            method: 'get',
            dataType: 'JSON',
            success: function (data) { 
                highChartPerhari(data);
            }
        })
    }
    function highChartPerhari(data) {
        Highcharts.chart('perhari', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Report Penggunaan Per Hari'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [
                    "1",
                    "2",
                    "3",
                    "4",
                    "5",
                    "6",
                    "7",
                    "8",
                    "9",
                    "10",
                    "11",
                    "12",
                    "13",
                    "14",
                    "15",
                    "16",
                    "17",
                    "18",
                    "19",
                    "20",
                    "21",
                    "22",
                    "23",
                    "24",
                    "25",
                    "26",
                    "27",
                    "28",
                    "29",
                    "30",
                    "31",
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Rainfall (mm)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:30px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: data
        });
}
    
</script>
@endsection

