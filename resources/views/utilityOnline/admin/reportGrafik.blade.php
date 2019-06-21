@extends('utilityOnline.admin.templates.layout')
@section('title')
    Utility Online | Reports
@endsection
@section('active-report-grafik')
    active
@endsection
@section('content')
<div class="section-header">
    <h1>Report Grafik Perbulan</h1>
</div>
<div class="row">
    <div class="col-lg-3">
        <div class="bg-white p-2 rounded" style="box-shadow: 1px 1px 10px #000">
            <div class="form-group">
                <label for="">Tahun : </label>
                <select name="tahun" id="tahun" class="form-control">
                    <option value="" selected disabled>-- PILIH TAHUN --</option>
                    <option value="2016">2016</option>
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Kategori : </label>
                <select name="kategori" id="kategori" class="form-control">
                    <option value="" selected disabled>-- PILIH KATEGORI --</option>
                    @foreach($kategori as $k)
                        <option value="{{ $k->id }}">{{ $k->kategori }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Workcenter : </label>
                <select name="workcenter" id="workcenter" class="form-control ">
                    <option value="" selected disabled>-- PILIH WORKCENTER --</option>
                    @foreach($workcenter as $w)
                        <option value="{{ $w->id }}">{{ $w->workcenter }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="col-lg-9">
        <div id="pertahun" class="mt-4 p-2 rounded" style="box-shadow: 1px 1px 5px #000"></div>
    </div>
</div>


<script>
    $('#kategori').attr('disabled', true);
    $('#bagian').attr('disabled', true);
    $('#workcenter').attr('disabled', true);
    $('#tahun').change(function () {
        $('#kategori').attr('disabled', false);
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
                        // $.ajax({
                        //     url: '/sentul-apps/utility-online/admin/report/bagian/' + id,
                        //     method: 'GET',
                        //     dataType: 'JSON',
                        //     success: function (data) {
                        //         $('#bagian').attr('disabled', false);
                        //         var option = "";
                        //         option+="<option disabled selected>-- PILIH BAGIAN --</option>"
                        //         for (let i = 0; i < data.length; i++) {
                        //             option+="<option value='"+ data[i].id +"'>"+ data[i].bagian +"</option>"
                        //         }
                        //         $('#bagian').append(option);
                        //         $("#bagian").change(function () {
                                    penggunaanGrafikPerTahun($(this).val());
                        //         })
                        //     }
                        // });
                    })
                }
            });
        });
    })
    function penggunaanGrafikPerTahun(id) { 
        $.ajax({
            url: 'report-grafik/penggunaan/pertahun/'+ $('#tahun').val() +'/' + id,
            method: 'get',
            dataType: 'JSON',
            success: function (data) { 
                highChartPertahun(data);
            }
        })
    }
    function highChartPertahun(data){
        Highcharts.chart('pertahun', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Report Penggunaan Per Bulan'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [
                    'Jan',
                    'Feb',
                    'Mar',
                    'Apr',
                    'May',
                    'Jun',
                    'Jul',
                    'Aug',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dec'
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
                series: {
                    cursor: 'pointer',
                    point: {
                        events: {
                            click: function() {
                                alert('Category: ' + this.category + ', value: ' + this.x);
                            }
                        }
                    }
                },
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: data,
            series: [
                {
                    name: 'jadwal',
                    type: 'column',
                    data: [
                        {
                            y: 9,
                            key: 'aksjdf',
                        },
                        {
                            y: 9,
                            key: 'aksjdf',
                        },
                    ]
                }
            ],
            series: [
                {
                    name: 'name',
                    type: 'column',
                    data: [
                        {
                            y: 7,
                            key: 'aksjdasdff',
                        },
                        {
                            y: 2,
                            key: 'aksjjdf',
                        },
                    ]
                }
            ],
        });
    }
    
</script>
@endsection

