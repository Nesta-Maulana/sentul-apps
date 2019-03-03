@extends('general.administrator.master')
@section('judul')
    PMB
@endsection
@section('active-pmb')
    active
@endsection
@section('content')
    <div class="card">
        <div class="card-header primary-color-background text-white">
            Permohonan Mixing Baru
        </div>
        <div class="card-body">
            {{-- Start Inputan Header  --}}
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group row">
                        <label for="PilihCompany" class="col-lg-4 col-form-label">Company</label>
                        <div class="col-lg-8">
                            <select class="custom-select" id="PilihCompany">
                                <option selected disabled>Pilih Company</option>
                                <option value="1">NFI</option>
                                <option value="2">HNI</option>
                                <option value="3">WRP</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group row">
                        <label for="KodeFormula" class="col-lg-4 col-form-label">Kode Formula</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="KodeFormula" placeholder="Kode Formula" readonly >
                        </div>
                    </div>
                </div>
                <div class="col-lg-4"> 
                    <div class="form-group row">
                        <label for="PilihLini" class="col-lg-4 col-form-label">Lini Produksi</label>
                        <div class="col-lg-8">
                            <select class="custom-select" id="PilihLini">
                                <option selected disabled>Pilih Lini Produksi</option>
                                <option value="1">Yobase</option>
                                <option value="2">RM</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4"> 
                   <div class="form-group row">
                        <label for="PilihProduk" class="col-lg-4 col-form-label">Produk</label>
                        <div class="col-lg-8">
                            <select class="custom-select" id="PilihProduk">
                                <option selected disabled>Pilih Produk</option>
                                <option value="1">Produk 1</option>
                                <option value="2">Produk 2</option>
                                <option value="3">Produk 3</option>
                                <option value="4">Produk 4</option>
                                <option value="5">Produk 5</option>
                                <option value="6">Produk 6</option>
                                <option value="7">Produk 7</option>
                                <option value="8">Produk 8</option>
                            </select>
                        </div>
                   </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group row">
                        <label for="BatchSize" class="col-lg-4 col-form-label">Batch Size</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="BatchSize" placeholder="Batch Size" readonly >
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="form-group row">
                        <label for="EstimasiBerlaku" class="col-lg-5 col-form-label">Estimasi Berlaku</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control datepicker" id="EstimasiBerlaku">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4"></div>
                    <div class="col-lg-4">
                        <div class="form-group row">
                            <div class="col-lg-5"></div>
                            <div class="col-lg-7">
                                <button class="btn btn-info form-control primary-color-background" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    Simpan
                                </button>
                            </div>
                        </div>
                </div>
            </div>
            {{-- End Inputan Header --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="wizard">
                        <ul class="nav nav-wizard">
                            <li class="active">
                                <a href="#pheTermisasi" data-toggle="tab">PHE Termisasi</a>
                            </li>
                            <li class="disabled">
                                <a href="#milkTankyb" data-toggle="tab">Milk Tank YB</a>
                            </li>
                            <li class="disabled">
                                <a href="#mixingTankyb" data-toggle="tab">Mixing Tank YB</a>
                            </li>
                            <li class="disabled">
                                <a href="#pheYb" data-toggle="tab">PHE YB</a>
                            </li>
                            <li class="disabled">
                                <a href="#incubationTank" data-toggle="tab">Incubation Tank</a>
                            </li>
                            <li class="disabled">
                                <a href="#pheCooler" data-toggle="tab">PHE Cooler</a>
                            </li>
                            <li class="disabled">
                                <a href="#" data-toggle="tab">Storage Tank YB</a>
                            </li>
                            {{-- <li class="disabled">
                                <a href="#" data-toggle="tab">XXX Tank</a>
                            </li>
                            <li class="disabled">
                                <a href="#" data-toggle="tab">Mixing Tank RM</a>
                            </li>
                            <li class="disabled">
                                <a href="#" data-toggle="tab">CST</a>
                            </li>
                            <li class="disabled">
                                <a href="#" data-toggle="tab">PHE RM</a>
                            </li>
                            <li class="disabled">
                                <a href="#" data-toggle="tab">Storage Tank RM</a>
                            </li>
                            <li class="disabled">
                                <a href="#" data-toggle="tab">UHT</a>
                            </li>
                            <li class="disabled">
                                <a href="#" data-toggle="tab">AT</a>
                            </li> --}}
                        </ul>
                        <div class="tab-content py-3" id="contentnya">
                            @include('general.administrator.pmb.mesin.phetermisasi')                            
                            @include('general.administrator.pmb.mesin.milktankyb')
                            @include('general.administrator.pmb.mesin.mixingtankyb')
                            @include('general.administrator.pmb.mesin.pheyb')
                            @include('general.administrator.pmb.mesin.incubationtank')
                            @include('general.administrator.pmb.mesin.phecooler')
                            @include('general.administrator.pmb.mesin.at')
                            @include('general.administrator.pmb.mesin.cst')
                            @include('general.administrator.pmb.mesin.mixingtankrm')
                            @include('general.administrator.pmb.mesin.pherm')
                            @include('general.administrator.pmb.mesin.storagetankyb')
                            @include('general.administrator.pmb.mesin.storagetankrm')
                            @include('general.administrator.pmb.mesin.uht')
                            @include('general.administrator.pmb.mesin.xxxtank')
                             
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

@endsection