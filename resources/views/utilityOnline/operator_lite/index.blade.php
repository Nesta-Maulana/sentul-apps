@extends('utilityOnline.operator_lite.layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
<div class="menu-fixed-dark">
    <div class="sidebar-wrapper navbar">
        <div class="logo">
            <a href="#" class="simple-text logo-mini"></a>
            <a href="#" class="simple-text logo-normal"></a>
        </div>
        <ul class="nav">
            <li class="active">
                    <i class="tim-icons icon-minimal-down text-primary"></i>
                    <p></p>
            </li>
        </ul>
        <ul class="nav">
            <li class="active">
                    <i class="tim-icons icon-chart-pie-36 text-primary" hidden="true"></i>
                    <p></p>
            </li>
        </ul>
        <ul class="nav">  
            <li class="active">
                    <i class="tim-icons icon-atom text-primary" hidden="true"></i>
                    <p></p>
            </li>
        </ul>
        <ul class="nav">
            <li class="active">
                    <i class="tim-icons icon-double-left text-primary"></i>
                    <p></p>
            </li>
        </ul>
        <div style="font-size: 20px"><p class="text-success">Utility Online</p></div>
        <ul class="nav">    
            <li class="active">
                    <i class="tim-icons icon-double-right text-primary"></i>
                    <p></p>
            </li>
        </ul>    
        <ul class="nav">
            <li class="active">
                    <i class="tim-icons icon-puzzle-10 text-primary" hidden="true"></i>
                    <p></p>
            </li>
        </ul>
        <ul class="nav">    
            <li class="active">
                    <i class="tim-icons icon-align-center text-primary" hidden="true"></i>
                    <p></p>
            </li>
        </ul>    
        <ul class="nav">    
            <li class="active">
                    <i class="tim-icons icon-minimal-down text-primary"></i>
                    <p></p>
            </li>
        </ul>
        <ul class="nav">    
            <li class="">
                    <i class="tim-icons icon-spaceship text-primary" hidden="true"></i>
                    <p></p>
            </li>
        </ul>
    </div>
</div>
<!--END SB-->
    <div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header ">
                    <div class="row">
                        <div class="col-sm-6 text-left">
                            <h5 class="card-category"></h5>
                            <h2 class="card-title"></h2>
                        </div>
                        <div class="col-sm-6">
                            <div class="btn-group btn-group-toggle float-right" data-toggle="buttons">
                            <label class="btn btn-sm btn-primary btn-simple active" id="0">
                                <input type="radio" name="options" checked>
                                <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Accounts</span>
                                <span class="d-block d-sm-none">
                                    <i class="tim-icons icon-single-02"></i>
                                </span>
                            </label>
                            <label class="btn btn-sm btn-primary btn-simple" id="1">
                                <input type="radio" class="d-none d-sm-none" name="options">
                                <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Purchases</span>
                                <span class="d-block d-sm-none">
                                    <i class="tim-icons icon-gift-2"></i>
                                </span>
                            </label>
                            <label class="btn btn-sm btn-primary btn-simple" id="2">
                                <input type="radio" class="d-none" name="options">
                                <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Sessions</span>
                                <span class="d-block d-sm-none">
                                    <i class="tim-icons icon-tap-02"></i>
                                </span>
                            </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="chartBig1"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">Listrik</h5>
                    <h3 class="card-title"><i class="tim-icons icon-sound-wave text-primary"></i> 763,215</h3>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="chartLinePurple"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">Air</h5>
                    <h3 class="card-title"><i class="tim-icons icon-vector text-info"></i> 3,500€</h3>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="CountryChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">Gas</h5>
                    <h3 class="card-title"><i class="tim-icons icon-molecule-40 text-success"></i> 12,100K</h3>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="chartLineGreen"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!---->
        <div class="">
            <div class="card card-tasks">
                <div class="card-header ">
                    <h3 class="title d-inline">Listrik</h3>
                </div>
                <div class="card-body ">
                    <div class="table-full-width table-responsive">
                        <table class="table text-white">
                            <tbody>
                                 <tr>
                                    <th>
                                        #
                                    </th>
                                    <th>
                                        Bagian
                                    </th>
                                    <th>
                                        Workcenter
                                    </th>
                                    <th class="text-center">
                                        Pengecekan
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php $i=1 ?>
                                    @foreach($listrik as $b)
                                            @if(!$b->pengamatan)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td><a href="utility-online/listrik/{{ $b->workcenter_id }}">{{ $b->bagian }}</a></td>
                                                <td>{{ $b->workcenter->workcenter }}</td>        
                                                <td>{{ $b->kategoriPencatatan->kategori_pencatatan }}</td>
                                            </tr>   
                                            <?php $i++ ?>
                                            @endif
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <!---->
        <div class="">
        <div class="">
            <div class="card card-tasks">
                <div class="card-header ">
                    <h3 class="title d-inline">Gas</h3>
                </div>
                <div class="card-body ">
                    <div class="table-full-width table-responsive">
                        <table class="table">
                            <tbody>
                                 <tr>
                                    <th>
                                        #
                                    </th>
                                    <th>
                                        Bagian
                                    </th>
                                    <th>
                                        Workcenter
                                    </th>
                                    <th class="text-center">
                                        Pengecekan
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php $i=1 ?>
                                    @foreach($gas as $b)
                                            @if(!$b->pengamatan)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td><a href="utility-online/gas/{{ $b->workcenter_id }}">{{ $b->bagian }}</a></td>
                                                <td>{{ $b->workcenter->workcenter }}</td>        
                                                <td>{{ $b->kategoriPencatatan->kategori_pencatatan }}</td>
                                            </tr>   
                                            <?php $i++ ?>
                                            @endif
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!---->
        <div class="">
        <div class="">
            <div class="card card-tasks">
                <div class="card-header ">
                    <h3 class="title d-inline">Air</h3>
                </div>
                <div class="card-body">
                    <div class="table-full-width table-responsive">
                        <table class="table">
                            <tbody>
                                 <tr>
                                    <th>
                                        #
                                    </th>
                                    <th>
                                        Bagian
                                    </th>
                                    <th>
                                        Workcenter
                                    </th>
                                    <th class="text-center">
                                        Pengecekan
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php $i=1 ?>
                                    @foreach($water as $b)
                                            @if(!$b->pengamatan)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td><a href="utility-online/water/{{ $b->workcenter_id }}">{{ $b->bagian }}</a></td>
                                                <td>{{ $b->workcenter->workcenter }}</td>        
                                                <td>{{ $b->kategoriPencatatan->kategori_pencatatan }}</td>
                                            </tr>   
                                            <?php $i++ ?>
                                            @endif
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!---->
    </div>
@endsection

@push('js')
    <script src="{{ asset('utilityOnline/assets') }}/js/plugins/chartjs.min.js"></script>
    <script>
        $(document).ready(function() {
          demo.initDashboardPageCharts();
        });
    </script>
@endpush
