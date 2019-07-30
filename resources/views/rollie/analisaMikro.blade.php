@extends('rollie.templates.layout2')
@section('title')
    Rollie | Analisa Mikro
@endsection
@section('active-home')
    m-menu__item--active
@endsection
@section('active-analisa-mikro')
    m-menu__item--active
@endsection
@section('subheader')
    ROLLIE | Analisa Mikro FG <hr>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="m-portlet">
                <div class="m-portlet__head" style="background:linear-gradient(135deg, #5867dd 30%, #36a3f7 100%)">
                    <div class="m-portlet__head-caption"  >
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text text-white">
                                Draft Analisa Mikro 
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body" style="background:#f0f0f0; padding: 0;">
                    <div class="form-inline row p-3" style="margin-left: -60px">
                        <label for="nama_produk_filter_analisa_mikro" class="col-lg-2">Nama Produk</label>
                        <select class="col-lg-4 form-control m-bootstrap-select " id="nama_produk_filter_analisa_mikro">
                            <option value="">
                                All
                            </option>
                            @foreach ($produks as $produk)
                                <option value="{{ $produk->nama_produk }}">{{ $produk->nama_produk }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row p-3">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-body table-responsive">
                                    <table class="m-datatable table-bordered" id="table-analisa-mikro" style="overflow-x: none;">
                                        <thead class="text-center">
                                            <tr>
                                                <th title="Field #1">
                                                    Nama Produk
                                                </th>
                                                <th title="Field #2">
                                                    Tanggal Produksi
                                                </th>
                                                <th title="Field #3">
                                                    Status Analisa Kimia
                                                </th>
                                                <th title="Field #4">
                                                    Aksi
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cpps as $cpp)
                                                @if ($cpp->status === '1')
                                                    <tr>
                                                        <td>{{ $cpp->wo[0]->produk->nama_produk }}</td>
                                                        <td>{{ $cpp->wo[0]->production_realisation_date }}</td>
                                                        <td class="text-center">
                                                            @if ($cpp->analisa_mikro_id == null)
                                                                Belum Analisa
                                                            @else
                                                                @if ($cpp->analisaKimia->status == '0')
                                                                    Draft Analisa
                                                                @else
                                                                    Sudah Analisa
                                                                @endif
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($cpp->analisa_mikro_id == null)
                                                                <input type="submit" class="btn m-btn btn-danger form-control" value="Analisa" onclick="document.location.href='{{ route("proses-analisa-mikro",["id"=>app('App\Http\Controllers\resourceController')->enkripsi($cpp->id)]) }}'">
                                                            @else
                                                                @if ($cpp->analisaKimia->status == '0')
                                                                    <input type="submit" class="btn m-btn btn-warning form-control text-white" value="Lengkapi Analisa" onclick="document.location.href='{{ route("proses-analisa-mikro",["id"=>app('App\Http\Controllers\resourceController')->enkripsi($cpp->id)]) }}'">
                                                                @else
                                                                    <input type="submit" class="btn m-btn btn-success form-control text-white" value="Lihat Hasil Analisa" onclick="document.location.href='{{ route("lihat-analisa-produk",["id"=>app('App\Http\Controllers\resourceController')->enkripsi($cpp->analisaKimia->id)]) }}'">
                                                                @endif
                                                                
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
@endsection