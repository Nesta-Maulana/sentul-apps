@extends('rollie.templates.layout2')
@section('title')
    Rollie | PPQ - FG
@endsection
@section('active-home')
    m-menu__item--active
@endsection
@section('active-ppq')
    m-menu__item--active
@endsection
@section('subheader')
    <h2 class="text-center">ROLLIE | PPQ - FG</h2>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="m-portlet">
                <h3 class="text-white back-purple p-3 text-center">Input PPQ FG</h3>
                <div class="row p-3">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Nama Produk</label>
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
                            <label for="">No WO</label>
                            <select name="" id="" class="form-control">
                                <option value=""></option>
                            </select>
                            <button class="btn back-purple text-white mt-2">Select All</button>
                        </div>
                        <div class="form-group">
                            <label for="">Mesin Filling</label>
                            <select name="" id="" class="form-control">
                                <option value=""></option>
                            </select>
                            <button class="btn back-purple text-white mt-2">Select All</button>
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal PPQ FG</label>
                            <input type="date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Nomor PPQ</label>
                            <input type="text" class="form-control" readonly="true" placeholder="Nomor PPQ">
                        </div>
                        <div class="form-group">
                            <label for="">Kode Oracle</label>
                            <input type="text" class="form-control" readonly="true" placeholder="Kode Oracle">
                        </div>
                        <div class="form-group">
                            <label for="">Nomor LOT</label>
                            <input type="text" class="form-control">
                            <button class="btn back-purple text-white mt-2">Select All</button>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Jam Filling Awal PPQ : </label>
                            <input type="text" class="form-control" placeholder="Jam Filiing Awal">
                        </div>
                        <div class="form-group">
                            <label for="">Jam Filling Akhir PPQ : </label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Jumlah (pack) : </label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Alasan PPQ : </label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Detail Titik PPQ : </label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Kategori PPC : </label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">PIC : </label>
                            <input type="text" class="form-control">
                        </div>
                            <button class="btn back-purple text-white pt-3 pb-3 pr-5 pl-5 float-right mt-auto">Kirim</button>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="m-portlet">
                <h3 class="d-flex justify-content-center pt-3">PPQ - FG List</h3>
                <div class="p-2">
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