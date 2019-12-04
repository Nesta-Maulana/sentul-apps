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
    <!---->
        <div class="">
            <div class="card card-tasks">
                <div class="card-header ">
                    <h3 class="title d-inline text-primary">Listrik</h3>
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
                    <h3 class="title d-inline text-success">Gas</h3>
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
                    <h3 class="title d-inline text-info">Air</h3>
                </div>
                <div class="card-body">
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
    <div class="row" style="width: 100%;margin-top: 20px">
    <div class="col-md-4 col-xs-4">
        <a href="utility-lite/water" class="text-white">
            <button class="btn btn-success tombol" style="width: 100%; height: 100%">
                <h1 class="judul">
                    Air
                </h1>
            </button>
        </a>
    </div>
    <div class="col-md-4 col-xs-4">
        <a href="utility-lite/listrik" class="text-white">
            <button class="btn btn-success tombol" style="width: 100%; height: 100%">
                <h1 class="judul">
                    Listrik
                </h1>
            </button>
        </a>
    </div>
    <div class="col-md-4 col-xs-4">
        <a href="utility-lite/gas" class="text-white">
            <button class="btn btn-success tombol" style="width: 100%; height: 100%">
                <h1 class="judul">
                    Gas
                </h1>
            </button>
        </a>
    </div>
</div>
<div class="row" style="width: 100%;margin-top: 20px">
    <div class="col-md-12 col-xs-12">
        <a href="utility-lite/database" class="text-white">
            <button class="btn btn-success tombol" style="width: 100%; height: 100%">
                <h1 class="judul">
                    Database
                </h1>
            </button>
        </a>
    </div>
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
