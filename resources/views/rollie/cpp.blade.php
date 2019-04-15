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
                <h3 class="d-flex justify-content-center p-3 text-white " style="background: linear-gradient(135deg, #5867dd 30%, #36a3f7 100%)">
                    Lihat CPP
                </h3>
                <div class="row p-3">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="nama_produk">Nama Produk</label>
                            <select class="form-control m-select2 select2" id="nama_produk_cpp" name="nama_produk_cpp">
                                <option value="-" selected disabled>Pilih Produk</option>
                                <option value="Produk1">Produk 2</option>
                                <option value="Produk1">Produk 3</option>
                                <option value="Produk1">Produk 4</option>
                                <option value="Produk1">Produk 5</option>
                                <option value="Produk1">Produk 6</option>
                                <option value="Produk1">Produk 7</option>
                                <option value="Produk1">Produk 8</option>
                            </select>
                              
                        </div>
                          

                        <div class="form-group">
                            <label for="tanggal_produksi">Tanggal Produksi</label>
                            <select class="form-control m-select2 select2" id="tanggal_produksi_cpp" name="tanggal_produksi_cpp">
                                <option value="-" selected disabled>Pilih Tanggal Produksi</option>
                                <option value="Tanggal Produksi 1">Tanggal Produksi 2</option>
                                <option value="Tanggal Produksi 1">Tanggal Produksi 3</option>
                                <option value="Tanggal Produksi 1">Tanggal Produksi 4</option>
                                <option value="Tanggal Produksi 1">Tanggal Produksi 5</option>
                                <option value="Tanggal Produksi 1">Tanggal Produksi 6</option>
                                <option value="Tanggal Produksi 1">Tanggal Produksi 7</option>
                            </select>
                        </div>        

                        <div class="form-group">
                            <label for="kode_oracle">Kode Oracle</label>
                            <input type="text" id="kode_oracle" readonly class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="no_wo" >No WO</label>
                            <input type="text" id="no_wo" readonly class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="jumlah_batch">Jumlah Batch</label>
                            <input type="text" id="jumlah_batch" readonly class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_selesai_filling">Tanggal Selesai Filling</label>
                            <input type="text" readonly id="tanggal_selesai_filling" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="expired_date">Expired Date</label>
                            <input type="text" id="expired_date" readonly class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="status_produk">Status Produk</label>
                            <input type="text" id="status_produk" readonly class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 ">
            <div class="m-portlet">
                <h3 class="d-flex justify-content-center pt-3 pb-3 text-white" style="background: linear-gradient(135deg, #5867dd 30%, #36a3f7 100%)" >
                    Upload CPP File (.xlsx)
                </h3>
                <div class="row p-3">
                    <div class="col-lg-4" >
                        <i class="fa fa-file-excel-o d-flex justify-content-center" style="font-size: 100px;"></i>
                    </div>
                    <div class="col-lg-8">
                        {!! Form::open(['route'=>'import-cpp','enctype'=>'multipart/form-data']) !!}
                            {!! Form::file('cppfile', ['required'=>'required']) !!}
                            <select name="cpptype" class="form-control mt-2">
                                <option value="Pilih" selected disabled required>Pilih Jenis Cpp</option>
                                <option value="<?=$brix?>" >Brix</option>
                                <option value="<?=$prisma?>">Prisma</option>
                            </select>
                            {{-- {!! Form::select('cpptype', ['Pilih'=>'Pilih Jenis Cpp',$brix=>'Brix',$prisma=>'Prisma'],'Pilih',['class'=>'form-control mt-2']) !!} --}}
                            {!! Form::submit('Upload Cpp', ['class'=>'btn m-btn m-btn--gradient-from-primary m-btn--gradient-to-info form-control','style'=>'margin-top:8px;']) !!}
                        {!! Form::close() !!}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="m-portlet">
        <div class="col-lg-12">
            <h3 class="d-flex justify-content-center p-3 text-white font-weight-bold" style="background:linear-gradient(135deg, #5867dd 30%, #36a3f7 100%)">
                Table CPP
            </h3>
        </div>
    </div>
    <div class="m-portlet__body">
        <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
            <div class="row align-items-center">
                 <div class="col-md-6">
                    <div class="row form-inline">
                        <label for="nomor_wo_filter" class="col-lg-2">Nomor Wo </label>
                        <select class="col-lg-6 form-control m-bootstrap-select " id="nomor_wo_filter">
                            <option value="">
                                All
                            </option>
                            <option value="G1904702003">
                                G1904702003
                            </option>
                        </select>
                    </div>
                    <div class="d-md-none m--margin-bottom-10"></div>
                </div>
                <div class="col-md-6">
                    <div class="row form-inline">
                        <label for="mesin_filling_filter" class="col-lg-2">Mesin Filling </label>
                        <select class="col-lg-6 form-control m-bootstrap-select " id="mesin_filling_filter">
                            <option value="">
                                All
                            </option>
                            <option value="A3">
                                A3
                            </option>
                        </select>
                    </div>
                    <div class="d-md-none m--margin-bottom-10"></div>
                </div>
            </div>
        </div>
        <div class="row p-3">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body table-responsive">
                        <table class="m-datatable" id="table-cpp" width="100%">
                            <thead>
                                <tr>
                                    <th title="Field #1">
                                        Nomor Wo
                                    </th>
                                    <th title="Field #2">
                                        Nomor Lot
                                    </th>
                                    <th title="Field #3">
                                        Mesin Filling
                                    </th>
                                    <th title="Field #4">
                                        Palet Start
                                    </th>
                                    <th title="Field #5">
                                        Palet End
                                    </th>
                                    <th title="Field #6">
                                        Tanggal Selesai Filling
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>
                                <tr>
                                    <td>G1904702003</td>
                                    <td>TB0401B-P01G</td>
                                    <td>A3</td>
                                    <td>04:56:45</td>
                                    <td>05:15:44</td>
                                    <td>2019-04-02</td>
                                </tr>            
                            </tbody>
                        </table>
                    </div>
                </div>
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
