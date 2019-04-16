@extends('rollie.templates.layout2')
@section('title')
    Rollie | CPP
@endsection
@section('active-home')
    m-menu__item--active
@endsection
@section('active-rkj')
    m-menu__item--active
@endsection
@section('subheader')
    <h2 class="text-center">ROLLIE | RKJ | Input</h2>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="m-portlet">
                <h3 class="p-2 text-white d-flex justify-content-center back-purple">Data RKJ</h3>
                <div class="p-2">
                    <div class="form-group">
                        <label for="">No RKJ : </label>
                        <input type="text" readonly="true" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Tgl RKJ :</label>
                        <input type="date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Inspektor QC :</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <h3 class="p-2 text-white d-flex justify-content-center back-purple"> </h3>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="m-portlet">
                <h3 class="p-2 text-white d-flex justify-content-center back-purple">Data Produk</h3>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="p-2">
                            <div class="form-group">
                                <label for="">Nama Produk : </label>
                                <select name="" id="nama_produk_rkj" class="form-control m-select2 select2">
                                    <option value="">Produk 1</option>
                                    <option value="">Produk 2</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Kode Oracle :</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Tgl Produksi :</label>
                                <input type="date" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Batch Size :</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="p-2">
                            <div class="form-group">
                                <label for="">No WO : </label>
                                <select name="" id="" class="form-control">
                                    <option value="">WO 1</option>
                                    <option value="">WO 2</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Mesin Filling :</label>
                                <select name="" id="" class="form-control">
                                    <option value="">Mesin 1</option>
                                    <option value="">Mesin 2</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">No Lot :</label>
                                <select name="" id="" class="form-control">
                                    <option value="">Lot 1</option>
                                    <option value="">Lot 2</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
               <h3 class="p-2 text-white d-flex justify-content-center back-purple"> </h3>      
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="m-portlet">
                <h3 class="p-2 text-white d-flex justify-content-center back-purple">Detail RKJ</h3>
                <div class="p-2">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Alasan Ditahan</label>
                                <textarea name="" id="" rows="3" class="form-control"></textarea>
                            </div> 
                            <div class="form-group">
                                <label for="">Dugaan penyebab</label>
                                <textarea name="" id="" rows="3" class="form-control"></textarea>
                            </div> 
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Spesifikasi</label>
                                <textarea name="" id="" rows="3" class="form-control"></textarea>
                            </div> 
                            <div class="form-group">
                                <label for="">Jumlah</label>
                                <input type="text" class="form-control col-lg-12">

                            </div> 
                            <div class="float-right">
                                <button class="btn text-white p-3 back-purple">Input RKJ</button>
                            </div>
                        </div>
                    </div>
                </div>
                <h3 class="p-2 text-white d-flex justify-content-center back-purple"> </h3>
            </div>
        </div>
    </div>
    
@endsection