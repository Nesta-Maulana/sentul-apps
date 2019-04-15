@extends('rollie.templates.layout2')
@section('title')
    Rollie | Analisa Kimia FG
@endsection
@section('active-home')
    m-menu__item--active
@endsection
@section('active-analisa-kimia')
    m-menu__item--active
@endsection
@section('subheader')
    <h2 class="text-center">ROLLIE | Analisa Kimia FG | Analisa</h2>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="m-portlet">
                <h3 class="d-flex justify-content-center p-2 text-white" style="background: #716aca;">Detail Produk</h3>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="p-2">
                            <div class="form-group">
                                <label for="">Nama Produk</label>
                                <input class="form-control" type="text">
                            </div>
                            <div class="form-group">
                                <label for="">Tgl Produksi</label>
                                <input class="form-control" type="date">
                            </div>
                            <div class="form-group">
                                <label for="">Nomor WO</label>
                                <textarea class="form-control" name="" id="" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Nomor LOT</label>
                                <textarea class="form-control" name="" id="" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="p-2">
                            <div class="form-group">
                                <label for="">Kode Oracle</label>
                                <input class="form-control" type="text">
                            </div>
                            <div class="form-group">
                                <label for="">Spek TS Minimal</label>
                                <input class="form-control" type="text">
                            </div>
                            <div class="form-group">
                                <label for="">Spek TS Maximal</label>
                                <input class="form-control" type="text">
                            </div>
                            <div class="form-group">
                                <label for="">Spek TS PH Minimal</label>
                                <input class="form-control" type="text">
                            </div>
                            <div class="form-group">
                                <label for="">Spek TS Maximal</label>
                                <input class="form-control" type="text">
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="m-portlet">
                <h3 class="p-2 text-white d-flex justify-content-center" style="background: #716aca;">Data TS</h3>
                <div class="p-2">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="form-group">
                                <label for="">Awal</label>
                                <input type="text" class="form-control" placeholder="Awal Pertama">
                                <input type="text" class="form-control mt-2" placeholder="Awal Kedua">
                            </div>
                            <div class="form-group">
                                <label for="">Tengah</label>
                                <input type="text" class="form-control" placeholder="Tengah Pertama">
                                <input type="text" class="form-control mt-2" placeholder="Tengah Kedua">
                            </div>
                            <div class="form-group">
                                <label for="">Akhir</label>
                                <input type="text" class="form-control" placeholder="Akhir Pertama">
                                <input type="text" class="form-control mt-2" placeholder="Akhir Kedua">
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label for="">Awal</label>
                                <textarea name="" id="" rows="3" class="form-control" readonly="true" ></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Tengah</label>
                                <textarea name="" id="" rows="3" class="form-control" readonly="true" ></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Akhir</label>
                                <textarea name="" id="" rows="3" class="form-control" readonly="true" ></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="m-portlet">
                <h3 class="p-2 text-white d-flex justify-content-center" style="background: #716aca;">Data PH</h3>
                <div class="p-2">
                    <div class="form-group">
                        <label for="">Awal</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Tengah</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Akhir</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
            </div>  
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="m-portlet">
                <h3 class="p-2 text-white d-flex justify-content-center" style="background: #716aca;">Visco</h3>
                <div class="p-2">
                    <div class="form-group">
                        <label for="">Awal</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Tengah</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Akhir</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="m-portlet">
                <h3 class="p-2 text-white d-flex justify-content-center" style="background: #716aca;">Sensory</h3>
                <div class="p-2">
                    <div class="form-group">
                        <label for="">Awal</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Tengah</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Akhir</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="m-portlet">
                <h3 class="p-2 text-white d-flex justify-content-center" style="background: #716aca;">Jam Filling</h3>
                <div class="p-2">
                    <div class="form-group">
                        <label for="">Awal</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Tengah</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Akhir</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="m-portlet">
                <h3 class="p-2 text-white d-flex justify-content-center" style="background: #716aca;">Status Akhir</h3>
                <div class="p-2">
                    <div class="form-group">
                        <label for="">Status Akhir : </label>
                        <input type="text" readonly="true" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Nama Inspektor :</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
            </div>
            <div class="float-right mb-5">
                <button class="btn text-white p-3" style="background: #716aca;">Simpan</button>
                <button class="btn text-white p-3" style="background: #716aca;">Save to draft</button>
            </div>
        </div>
    </div>
@endsection