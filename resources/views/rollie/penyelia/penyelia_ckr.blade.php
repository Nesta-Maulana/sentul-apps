@extends('rollie.penyelia.templates.layout')
@section('title')
ROLLIE | MTOL
@endsection
@section('active-$menu->link')
active
@endsection

@section('content')
<br>
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">  
      	</div>
        </div>
        <div class="content-body">
        	<!-- bordered table mulai -->
<div class="row">
	<div class="col-12">
		<div class="card-content show">
			<div class="card-header">
				<h4 class="card-title" style="color: black;">
					<i class="fa fa-history"></i> CKR View
				</h4>
				<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
				<div class="heading-elements">
					<ul class="list-inline mb-1">
						<li><a data-action="show">Signed as, {{ $username->user->role->role }}<i class="fa fa-user"></i></a></li>
						<li><a data-action="collapse"><i class="fa fa-minus"></i></a></li>
						<li><a data-action="reload"><i class="fa fa-refresh"></i></a></li>
						<li><a data-action="expand"><i class="fa fa-arrows-alt"></i></a></li>
						<li><a data-action="close"><i class="fa fa-close"></i></a></li>
					</ul>
				</div>
			</div>

			<div class="card-content show">
				<div class="card-body">	
					<div class="table-responsive">
						<table class="table table-bordered table-dark mb-0" width="100%">
							<thead class="thead-dark" align="center">
								<tr>
									<th>Tanggal</th>
									<th>Nama Mesin</th>
									<th>Nama Operator</th>
									<th>Nama Produk</th>
									<th>No WO</th>
									<!-- SD -->
									<th>
										<div class="btn-group mr-1 mb-1 btn-group-sm">
		                                	<button type="button" class="btn btn-dark">Kategori Activity</button>
		                                	<button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		                                	</button>
			 							<div class="dropdown-menu">
											<a class="dropdown-item" href="#">PDT</a>
		                                    <a class="dropdown-item" href="#">UPDT</a>
		                                    <a class="dropdown-item" href="#">Prod Time</a>
										</div>
										</div>
									</th>
									<!-- SD -->
									<th>Activity</th>
									<th>Kategori BD</th>
									<th>Detail BD</th>
									<th>Start</th>
									<th>Stop</th>
									<th>Durasi(menit)</th>
									<th>
										<div class="btn-group mr-1 mb-1 btn-group-sm">
		                                	<button type="button" class="btn btn-dark">Keterangan</button>
		                                	<button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		                                	</button>
										<div class="dropdown-menu">
											<a class="dropdown-item" href="#">Input Manual Tiap Row</a>
										</div>
										</div>
									</th>
									<th>Aksi</th>
								</tr>
								</thead>
								<tbody>
									<tr>
										<th><input type="date" name=""></th>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td>=(Stop=start)</td>
										<td></td>
										<td>
											<div class="btn-group btn-group-sm"><a href="rollie-penyelia-penyelia_ckr-edit" class="btn btn-warning" value="edit"><i class="fa fa-edit"></i> Edit</a></div>
										</td>
									</tr>
									<tr>
										<th><input type="date" name=""></th>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td>=(Stop=start)</td>
										<td></td>
									</tr>
									<tr>
										<th><input type="date" name=""></th>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td>=(Stop=start)</td>
										<td></td>
									</tr>
									<tr>
										<th><input type="date" name=""></th>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td>=(Stop=start)</td>
										<td></td>
									</tr>
								</tbody>
						</table>		
					</div>
				</div>
			</div>
		</div>
	</div>
</div><!-- bordered table selesai-->
	 </div>
      </div>
    </div>
    <br>

<!--////////////////////////BEGIN ALL CHART////////////////////////////////////-->
    	
    <!--BEGIN GAUGE CHART-->
<div class="card-content">
	<div class="card-header">
		<h5 class="card-title" style="color: black;">Report</h5>
	</div>
		<div class="card-body" >
			<div class="outer">
		    	<div id="container-speedometer" class="chart-container"></div>
			</div>
		<script type="text/javascript">
Highcharts.chart('container-speedometer', {

    chart: {
        type: 'gauge',
        plotBackgroundColor: null,
        plotBackgroundImage: null,
        plotBorderWidth: 0,
        plotShadow: false
    },

    title: {
        text: 'OEE Today'
    },
    subtitle: {
        text: 'NUTRIFOOD INDONESIA SENTUL'
    },

    pane: {
        startAngle: -150,
        endAngle: 150,
        background: [{
            backgroundColor: {
                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                stops: [
                    [0, '#FFF'],
                    [1, '#333']
                ]
            },
            borderWidth: 0,
            outerRadius: '109%'
        }, {
            backgroundColor: {
                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                stops: [
                    [0, '#333'],
                    [1, '#FFF']
                ]
            },
            borderWidth: 1,
            outerRadius: '107%'
        }, {
            // default background
        }, {
            backgroundColor: '#DDD',
            borderWidth: 0,
            outerRadius: '105%',
            innerRadius: '103%'
        }]
    },

    // the value axis
    yAxis: {
        min: 0,
        max: 100,

        minorTickInterval: 'auto',
        minorTickWidth: 1,
        minorTickLength: 10,
        minorTickPosition: 'inside',
        minorTickColor: '#666',

        tickPixelInterval: 30,
        tickWidth: 2,
        tickPosition: 'inside',
        tickLength: 10,
        tickColor: '#666',
        labels: {	
            step: 2,
            rotation: 'auto'
        },
        title: {
            text: 'OEE'
        },
        plotBands: [{
            from: 0,
            to: 50,
            color: '#DF5353' // RED
        }, {
            from: 50,
            to: 100,
            color: '#55BF3B' // GREEN
        } /*{
            from: 160,
            to: 200,
            color: '#DDDF0D' // YELLOW
        }*/]
    },

    series: [{
        name: 'Speed',
        data: [0],
        tooltip: {
            valueSuffix: ' %'
        }
    }]

},
// Add some life
function (chart) {
    if (!chart.renderer.forExport) {
        setInterval(function () {
            var point = chart.series[0].points[0],
                newVal,
                inc = Math.round((Math.random() - 0.5) * 20);

            newVal = point.y + inc;
            if (newVal < 0 || newVal > 100) {
                newVal = point.y - inc;
            }

            //point.update(newVal);

        }, 3000);
    }
});
		</script>
	</div>
</div>
	<!--END GAUGE CHART-->
        <br>
    <!--BEGIN COLUMN CHART-->
<div class="card-content">
	<div class="card-header">
  		<h5 class="card-title" style="color: black;">Report</h5>
	</div>
  		<div class="card-body" >
  			<div class="outer">
		    	<div id="container-column" class="chart-container"></div>
			</div>
				<script type="text/javascript">
				Highcharts.chart('container-column', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'OEE Details - Last 1 day'
    },
    subtitle: {
        text: 'NUTRIFOOD INDONESIA SENTUL'
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Total percent market share'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.1f}%'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
    },

    series: [
        {
            name: "Browsers",
            colorByPoint: true,
            data: [
                {
                    name: "Quality",
                    y: 68.75,
                    drilldown: "Quality"
                },
                {
                    name: "Availibility",
                    y: 70.83,
                    drilldown: "Availibility"
                },
                {
                    name: "Performance",
                    y: 107.56,
                    drilldown: "Performance"
                },
                {
                    name: "OEE",
                    y: 52.38,
                    drilldown: "OEE"
                }
            ]
        }
    ],
    drilldown: {
        series: [
            {
                name: "Quality",
                id: "Quality",
                data: [
                    [
                        "v65.0",
                        0.1
                    ],
                    [
                        "v64.0",
                        1.3
                    ],
                    [
                        "v63.0",
                        53.02
                    ],
                 -   [
                        "v62.0",
                        1.4
                    ],
                    [
                        "v61.0",
                        0.88
                    ],
                    [
                        "v60.0",
                        0.56
                    ],
                    [
                        "v59.0",
                        0.45
                    ],
                    [
                        "v58.0",
                        0.49
                    ],
                    [
                        "v57.0",
                        0.32
                    ],
                    [
                        "v56.0",
                        0.29
                    ],
                    [
                        "v55.0",
                        0.79
                    ],
                    [
                        "v54.0",
                        0.18
                    ],
                    [
                        "v51.0",
                        0.13
                    ],
                    [
                        "v49.0",
                        2.16
                    ],
                    [
                        "v48.0",
                        0.13
                    ],
                    [
                        "v47.0",
                        0.11
                    ],
                    [
                        "v43.0",
                        0.17
                    ],
                    [
                        "v29.0",
                        0.26
                    ]
                ]
            },
            {
                name: "Availibility",
                id: "Availibility",
                data: [
                    [
                        "v11.0",
                        6.2
                    ],
                    [
                        "v10.0",
                        0.29
                    ],
                    [
                        "v9.0",
                        0.27
                    ],
                    [
                        "v8.0",
                        0.47
                    ]
                ]
            },
            {
                name: "Performance",	
                id: "Performance",
                data: [
                    [
                        "v11.0",
                        3.39
                    ],
                    [
                        "v10.1",
                        0.96
                    ],
                    [
                        "v10.0",
                        0.36
                    ],
                    [
                        "v9.1",
                        0.54
                    ],
                    [
                        "v9.0",
                        0.13
                    ],
                    [
                        "v5.1",
                        0.2
                    ]
                ]
            },
            {
                name: "OEE",
                id: "OEE",
                data: [
                    [
                        "v16",
                        2.6
                    ],
                    [
                        "v15",
                        0.92
                    ],
                    [
                        "v14",
                        0.4
                    ],
                    [
                        "v13",
                        0.1
                    ]
                ]
            },
        ]
    }
});
		</script>
  </div>
</div>
	<!--END COLUMN CHART-->
        <br>
	<!--BEGIN PARETO CHART-->
	<div class="card-content">
	<div class="card-header">
		<h5 class="card-title" style="color: black;">Report</h5>
	</div>
		<div class="card-body" >
			<div class="outer">
		    	<div id="container-pareto" class="chart-container"></div>
			</div>
				<script type="text/javascript">
Highcharts.chart('container-pareto', {
    chart: {
        renderTo: 'container',
        type: 'column'
    },
    title: {
        text: 'Report Pareto Double Line'
    },
    tooltip: {
        shared: true
    },
    xAxis: {
        categories: [
            'Overpriced',
            'Small portions',
            'Wait time',
            'Food is tasteless',
            'No atmosphere',
            'Not clean',
            'Too noisy',
            'Unfriendly staff'
        ],
        crosshair: true
    },
    yAxis: [{
        title: {
            text: ''
        }
    }, {
        title: {
            text: ''
        },
        minPadding: 0,
        maxPadding: 0,
        max: 100,
        min: 0,
        opposite: true,
        labels: {
            format: "{value}%"
        }
    }],
    series: [{
        type: 'pareto',
        name: 'Pareto',
        yAxis: 1,
        zIndex: 10,
        baseSeries: 1
    }, {
        name: 'Complaints',
        type: 'column',
        zIndex: 2,
        data: [755, 400, 151, 86, 456, 51, 267, 10]
    },{
    	type: 'pareto',
        name: 'Line baru',
        data: [600, 600, 600, 600, 600, 600, 600, 600]
    }]
});
		</script>
	</div>
</div>	
			<!--END PARETO CHART-->
            <br>
			<!--BEGIN THE COMBOS CHART-->
<div class="card-content">
	<div class="card-header">
		<h5 class="card-title" style="color: black;">Report</h5>
	</div>
		<div class="card-body" >
			<div class="outer">
		    	<div id="container-combos" class="chart-container"></div>
		  	       </div>
				<script type="text/javascript">
Highcharts.chart('container-combos', {
    chart: {
        renderTo: 'container',
        type: 'column'
    },
    title: {
        text: 'Report Pareto with Area and Column'
    },
    tooltip: {
        shared: true
    },
    xAxis: {
        categories: [
            'Overpriced',
            'Small portions',
            'Wait time',
            'Food is tasteless',
            'No atmosphere',
            'Not clean',
            'Too noisy',
            'Unfriendly staff'
        ],
        crosshair: true
    },
    yAxis: [{
        title: {
            text: ''
        }
    }, {
        title: {
            text: ''
        },
        minPadding: 0,
        maxPadding: 0,
        max: 100,
        min: 0,
        opposite: true,
        labels: {
            format: "{value}%"
        }
    }],
    series: [{
        type: 'pareto',
        name: 'Pareto',
        yAxis: 1,
        zIndex: 10,
        baseSeries: 1
    }, {
        name: 'Complaints',
        type: 'column',
        zIndex: 2,
        data: [755, 400, 151, 86, 456, 51, 267, 10]
    },{
    	type: 'area',
        name: 'Area baru',
        data: [900, 800, 50, 86, 456, 51, 267, 10]
    }]
});
</script>
    </div>
</div>  
			<!--END THE COMBOS CHART-->
            <br>
			<!--BEGIN AREA AND DOUBLE LINE CHART-->
<div class="card-content">
	<div class="card-header">
		<h5 class="card-title" style="color: black;">Report</h5>
	</div>
		<div class="card-body" >
			<div class="outer">
		    	<div id="container-areatwo" class="chart-container"></div>
			     </div>
				<script type="text/javascript">
                Highcharts.chart('container-areatwo', {
                    chart: {
                        type: 'area'
                    },
                    title: {
                        text: 'Area Double Line'
                    },
                    subtitle: {
                        text: '',
                        align: 'right',
                        verticalAlign: 'bottom'
                    },
                    legend: {
                        enabled: true,
                        layout: 'vertical',
                        align: 'left',
                        verticalAlign: 'top',
                        x: 100,
                        y: 70,
                        floating: true,
                        borderWidth: 1,
                        backgroundColor:
                            Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF'
                    },
                    xAxis: {
                        allowDecimals: false,
                        categories: ['Hilo', 'WRP', 'Tropicana Slim', 'Nutrisari', 'L-Men', 'HB-Yogurt', 'W Dank ', 'NASSI']
                    },
                    yAxis: {
                        title: {
                            text: 'Y-Axis'
                        }
                    }, tooltip: {
                       pointFormat: '{series.name} had stockpiled <b>{point.y:,.0f}</b><br/>warheads in {point.x}'
                    }, plotOptions: {
                        area: {
                            pointStart: 0,
                            marker: {
                            enabled: false,
                            symbol: 'circle',
                            radius: 2,
                            states: {
                            hover: {
                            enabled: true,
                            fillOpacity: 0.5
                                    }
                                }
                            }
                        }
                    },
                    credits: {
                        enabled: false
                    },
                    series: [{
                        type: 'area',
                        name: 'area1',
                        line: false,
                        data: [5, 1, 4, 4, 5, 2, 3, 7]
                    }, {
                        type: 'pareto',
                        name: 'Line 1',
                        data: [4, 0, 3, 3, 4, 1, 2, 6]
                    }, {    
                        type: 'pareto',
                        color: 'orange',
                        name: 'Line 2',
                        data: [2, 2, 2, 2, 2, 2, 2, 2]
                    }]
                });
            </script>
	</div>
</div>
			<!--END AREA AND DOUBLE LINE CHART-->
                <br>
            <!--BEGIN PYRAMID CHART-->
            <div class="card-content">
    <div class="card-header">
        <h5 class="card-title" style="color: black;">Report</h5>
    </div>
        <div class="card-body" >
            <div class="outer">
                <div id="container-pyramid" class="chart-container"></div>
            </div>
                <script type="text/javascript">
                        // Data gathered from http://populationpyramid.net/germany/2015/

                        // Age categories
                        var categories = [
                            '0-4', '5-9', '10-14', '15-19',
                            '20-24', '25-29', '30-34', '35-39', '40-44',
                            '45-49', '50-54', '55-59', '60-64', '65-69',
                            '70-74', '75-79', '80-84', '85-89', '90-94',
                            '95-99', '100 + '
                        ];

                        Highcharts.chart('container-pyramid', {
                            chart: {
                                type: 'bar'
                            },
                            title: {
                                text: 'Population pyramid for Bogor, 2019'
                            },
                            subtitle: {
                                text: 'hiyahiya'
                            },
                            xAxis: [{
                                categories: categories,
                                reversed: false,
                                labels: {
                                    step: 1
                                }
                            }, { // mirror axis on right side
                                opposite: true,
                                reversed: false,
                                categories: categories,
                                linkedTo: 0,
                                labels: {
                                    step: 1
                                }
                            }],
                            yAxis: {
                                title: {
                                    text: null
                                },
                                labels: {
                                    formatter: function () {
                                        return Math.abs(this.value) + '%';
                                    }
                                }
                            },

                            plotOptions: {
                                series: {
                                    stacking: 'normal'
                                }
                            },

                            tooltip: {
                                formatter: function () {
                                    return '<b>' + this.series.name + ', age ' + this.point.category + '</b><br/>' +
                                        'Population: ' + Highcharts.numberFormat(Math.abs(this.point.y), 0);
                                }
                            },

                            series: [{
                                name: 'Male',
                                color: 'orange',
                                data: [
                                    -10.5, -10.0, -9.5, -9.0,
                                    -8.5, -8.0, -7.5, -7.0,
                                    -6.5, -6.0, -5.5, -5.0,
                                    -4.5, -4.0, -3.5, -3.0,
                                    -2.5, -2.0, -1.5, -1.0,
                                    -0.3
                                ]
                            }, {
                                name: '',
                                color: 'orange',
                                data: [
                                    10.5, 10.0, 9.5, 9.0, 8.5,
                                    8.0, 7.5, 7.0, 6.5, 6.0,
                                    5.5, 5.0, 4.5, 4.0, 3.5,
                                    3.0, 2.5, 2.0, 1.5, 1.0,
                                    0.3
                                ]
                            }]
                        });

                </script>
        </div>
</div>  
            <!--END PYRAMID CHART-->
            <br>
            <!--BEGIN BASIC COLUMN-->
    <div class="card-content">
    <div class="card-header">
        <h5 class="card-title" style="color: black;">Report</h5>
    </div>
        <div class="card-body" >
            <div class="outer">
                <div id="container-basic" class="chart-container"></div>
                <div id="container-basic2" class="chart-container"></div>
            </div>
                <script type="text/javascript">
                    Highcharts.chart('container-basic', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Deepwell compliance average per day (m3/day)'
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
                        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
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
                    series: [{
                        name: 'Deepwell 1 ESDM',
                        data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

                    }, {
                        name: 'Deepwell 2 ESDM',
                        data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

                    }, {
                        name: 'Deepwell 3 ESDM',
                        data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]

                    }, {
                        name: 'Deepwell 4 ESDM',
                        data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

                    }, {    
                        type: 'pareto',
                        color: 'red',
                        name: 'Ijin',
                        data: [100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100,]
                    
                    }]
                });
                </script>
        </div>
</div>  
            <!--BEGIN BASIC COLUMN 2-->
                <script type="text/javascript">
                    Highcharts.chart('container-basic2', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Deepwell usage Nutrifood Sentul'
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
                        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
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
                    series: [{
                        name: '2017',
                        data: [500]

                    },{
                        name: 'ydt',
                        data: [400]

                    },{
                        name: 'Deepwell 1 ESDM',
                        data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

                    }, {
                        name: 'Deepwell 2 ESDM',
                        data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

                    }, {
                        name: 'Deepwell 3 ESDM',
                        data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]

                    }, {
                        name: 'Deepwell 4 ESDM',
                        data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

                    }, {
                        type: 'pareto',
                        color: 'blue',
                        name: 'line',
                        data: [230, 210, 190, 170, 150, 130, 110, 90, 70, 50, 30, 10]
                    }]
                });
                </script>
        </div>
</div>  
            <!--END BASIC COLUMN-->
<!--////////////////////////////////END CHART/////////////////////////////////////////////////////////////-->
@endsection	