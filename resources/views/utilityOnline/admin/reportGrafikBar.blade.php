@extends('utilityOnline.admin.templates.layout')
@section('title')
    Utility Online | Reports
@endsection
@section('active-report-grafik-perbulan')
    active
@endsection
@section('content')
<div class="section-header">
    <h1>Report Grafik Perbulan</h1>
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
            <label for="">Kategori : </label>
            <select name="kategori" id="kategori" class="form-control">
                <option value="" selected disabled>-- PILIH KATEGORI --</option>
                @foreach($kategori as $k)
                <option value="{{ $k->id }}">{{ $k->kategori }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

@for($i = 1; $i <= 12; $i++)
    <div class="pertahun_{{ $i }}" class="mt-5"></div>
@endfor
<script>
$('#kategori').attr('disabled', true);
$('#bagian').attr('disabled', true);
$('#workcenter').attr('disabled', true);
$("#tahun").change(function () {
    $('#kategori').attr('disabled', false);
    $('#kategori').change(function () {
        var id = $('#kategori option:selected').val();
                    penggunaanGrafikPerTahun($(this).val());
    });
});

function penggunaanGrafikPerTahun(id) {
    $.ajax({
        url: '/sentul-apps/utility-online/admin/report-grafik-pertahun-bar/report-3/' + $("#tahun").val()  + '/' + id,
        method: 'get',
        dataType: 'JSON',
        success: function (data) {
            highChartPertahun(data);
        }
    })
}
function highChartPertahun(data) { 
    Highcharts.chart({
        chart: {
            renderTo: $('.pertahun_1')[0],
            type: 'bar'
        },
        title: {
            text: 'Report Bar 1.3 NFI Januari'
        },
        subtitle: {
            text: 'Source: '
        },
        xAxis: {
            categories: [
                "Januari"
                ],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Population (millions)',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ''
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 80,
            floating: true,
            borderWidth: 1,
            backgroundColor:
                Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: data[0][1],
    });
    Highcharts.chart({
        chart: {
            renderTo: $('.pertahun_2')[0],
            type: 'bar'
        },
        title: {
            text: 'Report Bar 1.3 NFI Februari'
        },
        subtitle: {
            text: 'Source: '
        },
        xAxis: {
            categories: [
                "Februari"
                ],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Population (millions)',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ''
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 80,
            floating: true,
            borderWidth: 1,
            backgroundColor:
                Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: data[0][2],
    });
    Highcharts.chart({
        chart: {
            renderTo: $('.pertahun_3')[0],
            type: 'bar'
        },
        title: {
            text: 'Report Bar 1.3 NFI Maret'
        },
        subtitle: {
            text: 'Source: '
        },
        xAxis: {
            categories: [
                "Maret"
                ],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Population (millions)',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ''
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 80,
            floating: true,
            borderWidth: 1,
            backgroundColor:
                Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: data[0][3],
    });
    Highcharts.chart({
        chart: {
            renderTo: $('.pertahun_4')[0],
            type: 'bar'
        },
        title: {
            text: 'Report Bar 1.3 NFI April'
        },
        subtitle: {
            text: 'Source: '
        },
        xAxis: {
            categories: [
                "April"
                ],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Population (millions)',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ''
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 80,
            floating: true,
            borderWidth: 1,
            backgroundColor:
                Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: data[0][4],
    });
    Highcharts.chart({
        chart: {
            renderTo: $('.pertahun_5')[0],
            type: 'bar'
        },
        title: {
            text: 'Report Bar 1.3 NFI Mei'
        },
        subtitle: {
            text: 'Source: '
        },
        xAxis: {
            categories: [
                "Mei"
                ],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Population (millions)',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ''
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 80,
            floating: true,
            borderWidth: 1,
            backgroundColor:
                Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: data[0][5],
    });
    Highcharts.chart({
        chart: {
            renderTo: $('.pertahun_6')[0],
            type: 'bar'
        },
        title: {
            text: 'Report Bar 1.3 NFI Juni'
        },
        subtitle: {
            text: 'Source: '
        },
        xAxis: {
            categories: [
                "Juni"
                ],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Population (millions)',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ''
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 80,
            floating: true,
            borderWidth: 1,
            backgroundColor:
                Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: data[0][6],
    });
    Highcharts.chart({
        chart: {
            renderTo: $('.pertahun_7')[0],
            type: 'bar'
        },
        title: {
            text: 'Report Bar 1.3 NFI Juli'
        },
        subtitle: {
            text: 'Source: '
        },
        xAxis: {
            categories: [
                "Juli"
                ],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Population (millions)',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ''
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 80,
            floating: true,
            borderWidth: 1,
            backgroundColor:
                Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: data[0][7],
    });
    Highcharts.chart({
        chart: {
            renderTo: $('.pertahun_8')[0],
            type: 'bar'
        },
        title: {
            text: 'Report Bar 1.3 NFI Agustus'
        },
        subtitle: {
            text: 'Source: '
        },
        xAxis: {
            categories: [
                "Agustus"
                ],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Population (millions)',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ''
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 80,
            floating: true,
            borderWidth: 1,
            backgroundColor:
                Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: data[0][8],
    });
    Highcharts.chart({
        chart: {
            renderTo: $('.pertahun_9')[0],
            type: 'bar'
        },
        title: {
            text: 'Report Bar 1.3 NFI September'
        },
        subtitle: {
            text: 'Source: '
        },
        xAxis: {
            categories: [
                "September"
                ],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Population (millions)',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ''
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 80,
            floating: true,
            borderWidth: 1,
            backgroundColor:
                Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: data[0][9],
    });
    Highcharts.chart({
        chart: {
            renderTo: $('.pertahun_10')[0],
            type: 'bar'
        },
        title: {
            text: 'Report Bar 1.3 NFI Oktober'
        },
        subtitle: {
            text: 'Source: '
        },
        xAxis: {
            categories: [
                "Oktober"
                ],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Population (millions)',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ''
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 80,
            floating: true,
            borderWidth: 1,
            backgroundColor:
                Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: data[0][10],
    });
    Highcharts.chart({
        chart: {
            renderTo: $('.pertahun_11')[0],
            type: 'bar'
        },
        title: {
            text: 'Report Bar 1.3 NFI November'
        },
        subtitle: {
            text: 'Source: '
        },
        xAxis: {
            categories: [
                "November"
                ],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Population (millions)',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ''
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 80,
            floating: true,
            borderWidth: 1,
            backgroundColor:
                Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: data[0][11],
    });
    Highcharts.chart({
        chart: {
            renderTo: $('.pertahun_12')[0],
            type: 'bar'
        },
        title: {
            text: 'Report Bar 1.3 NFI Desember  '
        },
        subtitle: {
            text: 'Source: '
        },
        xAxis: {
            categories: [
                "Desember"
                ],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Population (millions)',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ''
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 80,
            floating: true,
            borderWidth: 1,
            backgroundColor:
                Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: data[0][12],
    });
    Highcharts.chart({
        chart: {
            renderTo: $('.pertahun')[0],
            type: 'bar'
        },
        title: {
            text: 'Report Bar 1.3 NFI'
        },
        subtitle: {
            text: 'Source: '
        },
        xAxis: {
            categories: [
                "Januari"
                ],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Population (millions)',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ''
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 80,
            floating: true,
            borderWidth: 1,
            backgroundColor:
                Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: data[0][5],
    });
}

</script>

@endsection

