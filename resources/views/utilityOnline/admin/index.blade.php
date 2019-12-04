@extends('utilityOnline.admin.templates.layout')
@section('title')
    
@endsection
@section('content')
    <div class="row mt-5 d-flex justify-content-center">
        <h1 class="text-primary">Welcome To Utility Online</h1>
    </div>
    <div class="row">
        <div class="col-lg-6">
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
    </div>
<!---->
        <div class="col-lg-6">
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
    </div>
</div>
<!---->
<div class="row">
        <div class="col-lg-4">
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
    </div>
<!---->
    <div class="col-lg-4">
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
</div>
    <!---->
    <div class="col-lg-4">
        <div class="card-content">
    <div class="card-header">
        <h5 class="card-title" style="color: black;">Report</h5>
    </div>
        <div class="card-body">
            <div class="outer">
                <div id="container-hs" class="chart-container"></div>
            </div>
               <script type="text/javascript">
                    Highcharts.chart('container-hs', {
                        chart: {
                            type: 'pie',
                            options3d: {
                                enabled: true,
                                alpha: 45,
                                beta: 0
                            }
                        },
                        title: {
                            text: 'Pie chart'
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                depth: 35,
                                dataLabels: {
                                    enabled: true,
                                    format: '{point.name}'
                                }
                            }
                        },
                        series: [{
                            type: 'pie',
                            name: 'Browser share',
                            data: [
                                ['Water', 45.0],
                                ['Steam', 26.8],
                                {
                                    name: 'Listrik',
                                    y: 12.8,
                                    sliced: true,
                                    selected: true
                                },
                                ['Gas', 8.5]
                            ]
                        }]
                    });
        </script>
            </div>
        </div>
    </div>
    <!---->
</div>                
@endsection