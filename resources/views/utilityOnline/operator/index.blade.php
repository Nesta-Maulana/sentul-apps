@extends('utilityOnline.operator.templates.layout')
@section('title')
    Utility Online | Home
@endsection
@section('content')

<div id="particles-js"></div>
<div class="row ml-3 mr-3 mt-2">
    <div class="col-lg-12 text-white" style="background: transparent;">
        <h2 class="text-center font-weight-bold" style="text-shadow: 1px 1px 1px #000">To Do List</h2>
        <div class=" text-dark">
            <div class="row">
                <div class="col-lg-4">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr class="text-center">
                                <th scope="col" colspan="">#</th>
                                <th colspan="3">Air</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <tr>
                                <td class="text-center">0</td>
                                <td class="text-center">Bagian</td>
                                <td class="text-center">Workcenter</td>
                                <td class="text-center">Pengecekan</td> 
                            </tr>
                            <tr>
                            <?php $i=1 ?>
                                @foreach($water as $b)
                                        @if(!$b->pengamatan)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td><a href="utility-online/water/{{ $b->workcenter_id }}">{{ $b->bagian }}</a></td>
                                            @foreach($workcenter as $w)
                                                @if($b->workcenter_id == $w->id)
                                                    <td>{{ $w->workcenter }}</td>
                                                @endif
                                            @endforeach
                                            @foreach($kategoriPencatatan as $k)
                                                @if($b->kategori_pencatatan_id == $k->id)
                                                    <td>{{ $k->kategori_pencatatan }}</td>
                                                @endif
                                            @endforeach
                                        </tr>   
                                        <?php $i++ ?>
                                        @endif
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div> 
                <div class="col-lg-4">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr class="text-center">
                                <th colspan="3">listrik</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <tr>
                                <td class="text-center">Bagian</td>
                                <td class="text-center">Workcenter</td>
                                <td class="text-center">Pengecekan</td>
                            </tr>
                            <tr>
                                @foreach($listrik as $b)
                                    <tr>
                                        @if(!$b->pengamatan)
                                            <td><a href="utility-online/listrik/{{ $b->workcenter_id }}">{{ $b->bagian }}</a></td>
                                            @foreach($workcenter as $w)
                                                @if($b->workcenter_id == $w->id)
                                                    <td>{{ $w->workcenter }}</td>
                                                @endif
                                            @endforeach
                                            @foreach($kategoriPencatatan as $k)
                                                @if($b->kategori_pencatatan_id == $k->id)
                                                    <td>{{ $k->kategori_pencatatan }}</td>
                                                @endif
                                            @endforeach
                                        @endif
                                    </tr>
                                    <?php $i++ ?>
                                @endforeach
                            </tr>
                        </tbody class="bg-white">
                    </table>
                </div>
                <div class="col-lg-4">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr class="text-center">
                                <th colspan="3">Gas</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <tr>
                                <td class="text-center">Bagian</td>
                                <td class="text-center">Workcenter</td>
                                <td class="text-center">Pengecekan</td>
                            </tr>
                            <tr>
                            
                                @foreach($gas as $b)
                                    <tr>
                                        @if(!$b->pengamatan)
                                            <td><a href="utility-online/gas/{{ $b->workcenter_id }}">{{ $b->bagian }}</a></td>
                                            @foreach($workcenter as $w)
                                                @if($b->workcenter_id == $w->id)
                                                    <td>{{ $w->workcenter }}</td>
                                                @endif
                                            @endforeach
                                            @foreach($kategoriPencatatan as $k)
                                                @if($b->kategori_pencatatan_id == $k->id)
                                                    <td>{{ $k->kategori_pencatatan }}</td>
                                                @endif
                                            @endforeach
                                        @else
                                        
                                        @endif
                                    </tr>
                                    <?php $i++ ?>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-lg-4 mt-4 justify-content-center d-flex">
        <a class="text-white" href="utility-online/water"><button class="btn btn-success tombol"><h1 class="judul">Air</h1></button></a>
    </div>
    <div class="col-lg-4 mt-4 justify-content-center d-flex">
        <a class="text-white" href="utility-online/listrik"><button class="btn btn-success tombol"><h1 class="judul">Listrik</h4></button></a>
    </div>
    <div class="col-lg-4 mt-4 justify-content-center d-flex">
        <a class="text-white" href="utility-online/gas"><button class="btn btn-success tombol"><h1 class="judul">Gas</h1></button></a>
    </div>
    <div class="col-lg-4 mt-4 justify-content-center d-flex">
        <a class="text-white" href="utility-online/database"><button class="btn btn-success tombol"><h1 class="judul">Database</h1></button></a>
    </div>
</div>
@endsection