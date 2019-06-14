@extends('utilityOnline.operator.templates.layout')
@section('title')
    Utility Online | Home
@endsection
@section('content')
<style>
    #particles-js
    {
        height: 190vh;
    }
</style>
<div id="particles-js"></div>
<div class="row ml-3 mr-3 mt-2">
    <div class="col-lg-12 text-white" style="background: transparent;">
        <h2 class="text-center font-weight-bold" style="text-shadow: 1px 1px 1px #000">To Do List</h2>
        <div class=" text-dark">
            <div class="row">
                <div class="card col-lg-6" style="background:transparent;">
                    <div class="card-title text-white text-center ">
                        <h1>Listrik</h1>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered data-tables-to-do-list">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Bagian</th>
                                    <th class="text-center">Workcenter</th>
                                    <th class="text-center">Pengecekan</th> 
                                </tr>
                            </thead>
                            <tbody class="bg-white">
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
                <div class="card col-lg-6" style="background:transparent;">
                    <div class="card-title text-white text-center ">
                        <h1>GAS</h1>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered data-tables-to-do-list">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Bagian</th>
                                    <th class="text-center">Workcenter</th>
                                    <th class="text-center">Pengecekan</th> 
                                </tr>
                            </thead>
                            <tbody class="bg-white">
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
                <div class="card col-lg-12" style="background:transparent;">
                    <div class="card-title text-white text-center ">
                        <h1>AIR</h1>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered data-tables-to-do-list">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Bagian</th>
                                    <th class="text-center">Workcenter</th>
                                    <th class="text-center">Pengecekan</th> 
                                </tr>
                            </thead>
                            <tbody class="bg-white">
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
    </div>
</div>
<div class="row" style="width: 100%;margin-top: 20px">
    <div class="col-md-4 col-xs-4">
        <a href="utility-online/water" class="text-white">
            <button class="btn btn-success tombol" style="width: 100%; height: 100%">
                <h1 class="judul">
                    Air
                </h1>
            </button>
        </a>
    </div>
    <div class="col-md-4 col-xs-4">
        <a href="utility-online/listrik" class="text-white">
            <button class="btn btn-success tombol" style="width: 100%; height: 100%">
                <h1 class="judul">
                    Listrik
                </h1>
            </button>
        </a>
    </div>
    <div class="col-md-4 col-xs-4">
        <a href="utility-online/gas" class="text-white">
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
        <a href="utility-online/database" class="text-white">
            <button class="btn btn-success tombol" style="width: 100%; height: 100%">
                <h1 class="judul">
                    Database
                </h1>
            </button>
        </a>
    </div>
</div>
@endsection