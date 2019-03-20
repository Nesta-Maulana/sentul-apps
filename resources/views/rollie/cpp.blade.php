@extends('rollie.templates.layout2')
@section('title')
    Rollie | CPP
@endsection
@section('active-home')
    m-menu__item--active
@endsection
@section('active-cpp')
    m-menu__item--active
@endsection
@section('subheader')
    <h2 class="text-center">ROLLIE | CPP</h2>
@endsection
@section('content')
    
    <div class="row">
        <div class="col-lg-8">
            <div class="m-portlet">
                <h3 class="d-flex justify-content-center p-3 text-white" style="background: #716aca;">
                    INPUT CPP
                </h3>
                <div class="row p-3">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Nama Produk</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal Produksi</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Kode Oracle</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">No WO</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">No Batch</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal Produksi</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal Selesai Filling</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Expired Date</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <button class="btn text-white ml-3" style="background: #716aca">Simpan</button>
                </div>
            </div>
        </div>
        <div class="col-lg-4 ">
            <div class="m-portlet">
                <h3 class="d-flex justify-content-center pt-3 pb-3 text-white" style="background: #716aca;" >
                    Upload CPP File (.xlsx)
                </h3>
                <div class="row p-3">
                    <div class="col-lg-4" >
                        <i class="fa fa-file-excel-o d-flex justify-content-center" style="font-size: 100px;"></i>
                    </div>
                    <div class="col-lg-8">
                        <input type="file">
                        <select name="" id="" class="form-control mt-2">
                            <option value="">BRIX</option>
                            <option value="">PRISMA</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="m-portlet">
        <div class="col-lg-12">
        <h3 class="d-flex justify-content-center p-3 text-white font-weight-bold" style="background: #716aca">
            Table CPP
        </h3>
        <div class="row p-3">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body table-responsive">
                    <table id ="analisa-kimia-table" class="table table-striped" >
                        <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Tanggal Produksi</th>
                            <th>Status</th>
                            <th> </th>
                        </tr>
                        </thead>
                        <tbody>
                        
                        @for($i = 1; $i<=100; $i++)
                            <tr>
                                <td>{{$i}}</td>
                                <td>Produk {{$i}}</td>
                                <td>{{$i}} - 12 -2018</td>
                            </tr>
                        @endfor
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
<script>
    setInterval(function () {
        if($(document).width() <= 500){
            $("#table").addClass('table-responsive');
        }else{
            $("#table").removeClass('table-responsive');
        }
    }, 100);
</script>
@endsection