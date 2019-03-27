@extends('rollie.templates.layout2')
@section('title')
    Rollie | Analisa Mikro
@endsection
@section('active-home')
    m-menu__item--active
@endsection
@section('active-mikro')
    m-menu__item--active
@endsection
@section('subheader')
    <h2 class="text-center">ROLLIE | Analisa Mikro</h2>
@endsection
@section('content')

    <div class="row">
    
        <div class="col-lg-12">
            <div class="m-portlet">
                <h3 class="text-white back-purple p-3">
                    Analisa Mikro
                </h3>
                <div class="p-3">
                    <label for="">Nama Produk : </label>
                    <select name="" id="" class="form-control">
                        <option value=""></option>
                    </select>
                    <label for="">Tanggal Produksi : </label>
                    <select name="" id="" class="form-control">
                        <option value=""></option>
                    </select>
                    <label for="">No WO</label>
                    <input type="text" class="form-control" readonly="true" placeholder="No WO">
                    <hr class="back-purple">
                    <div class="row mt-2">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Kode Oracle</label>
                                <input type="text" readonly="true" class="form-control" placeholder="Kode Oracle">
                            </div>
                            <div class="form-group">
                                <label for="">Tanggal Selesai Filling   </label>
                                <input type="text" readonly="true" class="form-control" placeholder="Tgl Selesai Filling">
                            </div>
                            <div class="form-group">
                                <label for="">Tanggal Analisa Mikro</label>
                                <input type="text" readonly="true" class="form-control" placeholder="Tgl Analisa Mikro">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Mesin Filling : </label>
                                <input type="text" readonly="true" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="">No Batch Filling : </label>
                                <input type="text" class="form-control" placeholder="Tgl Selesai Filling">
                            </div>
                            <div class="form-group">
                                <label for="">Inputer :</label>
                                <input type="text" class="form-control" placeholder="Inputer">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">PIC QC Filling :</label>
                                <input type="text" readonly="true" class="form-control" placeholder="PIC QC Filling">
                            </div>
                            <div class="form-group">
                                <label for="">Import File :</label>
                                <input type="file" class="form-control-file">
                            </div>
                            <div class="float-right mt-5">
                                <button class="btn back-purple text-white">Save to Draft</button>
                                <button class="btn back-purple text-white">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="m-portlet">
                <h3 class="d-flex justify-content-center pt-3">Analisa Mikro</h3>
                <div class="p-2">
                    <table class="table table-striped">
                        <thead class="back-purple text-white">
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Kode Oracle</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Nomor WO</th>
                            <th scope="col">Tanggal Produksi</th>
                            <th scope="col">Mesin Filling</th>
                            <th scope="col">Status Akhir</th>                     
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>                            
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection