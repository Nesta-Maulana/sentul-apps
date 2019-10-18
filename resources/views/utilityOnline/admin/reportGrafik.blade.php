@extends('utilityOnline.admin.templates.layout')
@section('title')
    Utility Online | Reports
@endsection
@section('active-report-grafik-perbulan')
    active
@endsection
@section('content')

<div class="section-header">
    <h1>Report Water</h1>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="bg-white p-2 rounded" style="box-shadow: 1px 1px 10px #000; width: 49rem; height:60px">
            <div class="card" style="width: 40rem; height: 50px;">
                <div class="card-header">
            <div class="form-group">
                <div class="">
                
                <select name="tahun" id="tahun" class="form-control">
                    <option value="" selected disabled>-- PILIH TAHUN --</option>
                    <option value="2016">2016</option>
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                </select>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                
                <select name="kategori" id="kategori" class="form-control">
                    <option value="" selected disabled>-- PILIH KATEGORI --</option>
                    @foreach($kategori as $k)
                        <option value="{{ $k->id }}">{{ $k->kategori }}</option>
                    @endforeach
                </select>
                </div>
            </div>
            <br>
            <div class="form-group">
                <div class="">
                
                <select name="workcenter" id="workcenter" class="form-control ">
                    <option value="" selected disabled>-- PILIH WORKCENTER --</option>
                    @foreach($workcenter as $w)
                        <option value="{{ $w->id }}">{{ $w->workcenter }}</option>
                    @endforeach
                </select>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
    <div class="col-lg-9">
        <div id="pertahun" class="mt-4 p-2 rounded" style="box-shadow: 1px 1px 5px #000"></div>
        <table id="datatable" style="visibility: hidden">
            <thead>

            </thead>
            <tbody>

            </tbody>
        </table>
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
                    var optionroles = '',
                        $comboroles = $('#workcenter');
                    $('#workcenter').attr('disabled', false);
                    optionroles += '<option selected disabled>-- PILIH WORKCENTER --</option>';
                    for (index = 0; index < data.length; index++) {
                        optionroles += '<option value="' + data[index].id + '">' + data[index].workcenter + '</option>'
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
            url: 'report-grafik/penggunaan/pertahun/' + $('#tahun').val() + '/' + id,
            method: 'get',
            dataType: 'JSON',
            success: function (data) {
                
                var td = "";
                td += '<tr>';
                td += '<th></th>';
                for (let i = 0; i < data[0].length; i++) {
                    td += '<th>' + data[0][i].bagian +'</th>';
                }
                td += '</tr>';
                $('#datatable thead').html(td).on('change');
                var table = "";
                for (let i = 0; i < data[1].length; i++) 
                {
                table += '<tr>';
                    for (let a = 0; a < data[1][i].length; a++)
                    {
                        if (data[1][i][a] == null) 
                        {
                            data[1][i][a] = 0;
                        }

                        if(a == 0)
                        {
                            table += '<th>' + data[1][i][a] + '</th>';
                        }
                        else
                        {
                            table += '<td>' + data[1][i][a] + '</td>';
                        }
                    }
                    
                table += '</tr>';
                }
                $('#datatable tbody').html(table).on('change');
                highChartPertahun(data);
            }
        });
    }

    function highChartPertahun(data) {
    
        Highcharts.chart('pertahun', {
            data: {
                table: 'datatable'
            },
            chart: {
                type: 'column'
            },
            title: {
                text: 'Report Pertahun'
            },
            yAxis: {
                allowDecimals: true,
                title: {
                    text: 'Nilai'
                }
            },
            plotOptions: {
                series: {
                    cursor: 'pointer',
                    point: {
                        events: {
                            click: function() {
                                document.location.href = 'http://localhost/sentul-apps/utility-online/admin/report-penggunaan/nama-bagian/' + this.series.name + '/' + this.x + '/' + $('#tahun').val();
                            }
                        }
                    }
                }
            },
            tooltip: {
                formatter: function () {
                    console.log(this);
                    switch (this.point.category) {
                        case 1:
                            this.point.category = "Januari";
                            break;
                        case 2:
                            this.point.category = "Februari";
                            break;
                        case 3:
                            this.point.category = "Maret";
                            break;
                        case 4:
                            this.point.category = "April";
                            break;
                        case 5:
                            this.point.category = "Mei";
                            break;
                        case 6:
                            this.point.category = "Juni";
                            break;
                        case 7:
                            this.point.category = "Juli";
                            break;
                        case 8:
                            this.point.category = "Agustus";
                            break;
                        case 9:
                            this.point.category = "September";
                            break;
                        case 10:
                            this.point.category = "Oktober";
                            break;
                        case 11:
                            this.point.category = "November";
                            break;
                        case 12:
                            this.point.category = "Desember";
                            break;
                        default:
                            break;
                    }
                    return '<b>' + this.series.name + '</b><br/>' + this.point.y + '<br />' + this.point.category;
                    
                }
            }
        });
    
    }
</script>

@endsection

