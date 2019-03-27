@extends('rollie.templates.layout2')
@section('title')
    Rollie | Sortasi
@endsection
@section('active-home')
    m-menu__item--active
@endsection
@section('active-sortasi')
    m-menu__item--active
@endsection
@section('subheader')
    <h2 class="text-center">ROLLIE | Sortasi</h2>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="m-portlet">
                <h3 class="p-3 text-center back-purple text-white">Permohonan Sortasi</h3>
                <div class="p-3">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Nama Produk/Item Desc</label>
                                <select name="" id="" class="form-control">
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Tanggal Produksi</label>
                                <select name="" id="" class="form-control">
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Item Code</label>
                                <input type="text" class="form-control" readonly="true" placeholder="Item Code">
                            </div>
                            <div class="form-group">
                                <label for="">Brand</label>
                                <input type="text" class="form-control" readonly="true" placeholder="Brand">
                            </div>
                            <div class="form-group">
                                <label for="">Mesin Filling</label>
                                <input type="text" class="form-control" readonly="true" placeholder="Mesin Filling">
                            </div>
                            <div class="form-group">
                                <label for="">Nomor Sortasi</label>
                                <input type="text" class="form-control" readonly="true" placeholder="Nomor Sortasi">
                            </div>
                            <button class="color-purple btn font-weight-bold" style="border: 3px solid #716aca">Index Pengisian</button>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">No WO</label>
                                <input type="text" class="form-control" placeholder="No Wo">
                                <button class="btn back-purple text-white mt-2" >Select All</button>
                            </div>
                            <div class="form-group">
                                <label for="">No Lot</label>
                                <input type="text" class="form-control" placeholder="No Lot">
                                <button class="btn back-purple text-white mt-2" >Select All</button>
                            </div>
                            <div class="form-group">
                                <label for="">Tanggal Permohonan sortasi</label>
                                <input type="date" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Alasan Sortasi</label>
                                <select name="" id="" class="form-control">
                                    <option value="">Mutu</option>
                                    <option value="">Marketing</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Nomor Batch</label>
                                <input type="text" class="form-control" placeholder="Nomor Batch">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button class="text-white btn back-purple mt-2 d-flex justify-content-center">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="m-portlet">
                <h3 class="text-white back-purple p-3 text-center">List</h3>
                <div class="p-3">
                    <table class="table table-striped">
                        <thead class="back-purple text-white">
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">No PPQ</th>
                            <th scope="col">Tanggal PPQ</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Tanggal Produksi</th>
                            <th scope="col">Palet</th>
                            <th scope="col">Kategori PPQ</th>
                            <th scope="col">PIC</th>
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
                                <td>Mark</td>
                                <td>Mark</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <td>Mark</td>
                                <td>Mark</td>                                
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <td>Mark</td>
                                <td>Mark</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="m-portlet">
                <div class="back-purple p-3">
                    <h3 class="text-center"><span class="text-white"> Report Sortasi </span> <button class="btn btn-secondary float-right color-purple font-weight-bold" style="font-size: 12px;">Export to Excel</button></h3>
                    
                </div>
                <div class="p-3">
                    <table class="table table-striped">
                        <thead class="back-purple text-white">
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">No PPQ</th>
                            <th scope="col">Tanggal PPQ</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Tanggal Produksi</th>
                            <th scope="col">Palet</th>
                            <th scope="col">Kategori PPQ</th>
                            <th scope="col">PIC</th>
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
                                <td>Mark</td>
                                <td>Mark</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <td>Mark</td>
                                <td>Mark</td>                                
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <td>Mark</td>
                                <td>Mark</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection