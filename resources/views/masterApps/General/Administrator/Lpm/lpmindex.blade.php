@extends('general.administrator.master')
@section('judul')
    LPM
@endsection
@section('active-lpm')
    active
@endsection
@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">
            Lembar Proses Mixing
        </div>
        <div class="card-body">
            {{-- Filter LPM --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header primary-color-background text-white">
                            Filter LPM
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="input-group mb-3">
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="pilihbrand">Brand</label>
                                        </div>
                                        <select class="custom-select" id="pilihbrand">
                                            <option selected disabled>Pilih Brand</option>
                                            <option value="1">Brand A</option>
                                            <option value="2">Brand B</option>
                                            <option value="3">Brand C</option>
                                            <option value="3">Brand D</option>
                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="col-lg-5">
                                        <div class="input-group mb-3">
                                            <div class="input-group-append">
                                                <label class="input-group-text" for="PilihCompany">Company</label>
                                            </div>
                                            <select class="custom-select form-control" id="PilihCompany">
                                                <option selected disabled>Pilih Product</option>
                                                <option value="1">Product 1</option>
                                                <option value="2">Product 2</option>
                                                <option value="3">Product 3</option>
                                            </select>
                                        </div>
                                    </div>
                                <div class="col-lg-2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary">Tampilkan Semua</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-stripped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Form</th>
                                <th scope="col">Kode Formula</th>
                                <th scope="col">Revisi Ke</th>
                                <th scope="col">Versi Ke</th>
                                <th scope="col">Tanggal Berlaku</th>
                                <th scope="col" colspan="2" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 1; $i < 11; $i++)   
                            <tr>
                                <th scope="row">{{$i}}</th>
                                <td>HB Yoghurt Blackcurrant - HNI</td>
                                <td>03/HBYB/2018-2.3</td>
                                <td>3</td>
                                <td>3</td>
                                <td>23/08/2018</td>
                                <td><button class="btn btn-primary secondary-color-background col-lg-12">Lihat</button></td>
                                <td><button class="btn btn-info primary-color-background col-lg-12">Revisi</button></td>                                
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                    <nav aria-label="...">
                            <ul class="pagination">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="#">1 <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav>
                </div>
            </div>
        </div>
    </div>
@endsection