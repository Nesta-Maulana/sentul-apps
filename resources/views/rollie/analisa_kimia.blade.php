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
    <h2 class="text-center">ROLLIE | Analisa Kimia FG</h2>
@endsection
@section('content')
  	<div class="m-portlet m-portlet--mobile" style="background:#f0f0f0;">
        <h3 class="d-flex justify-content-center p-3 text-white font-weight-bold" style="background:linear-gradient(135deg, #5867dd 30%, #36a3f7 100%)">
            Table Analisa Kimia Produk Jadi
        </h3>
    </div>
    <div class="m-portlet__body" style="background:#f0f0f0;">
        <div class="form-inline row p-3">
        	<label for="nama_produk_filter" class="col-lg-2">Nama Produk </label>
                
            <select class="col-lg-4 form-control m-bootstrap-select " id="nama_produk_filter">
                <option value="">
                    All
                </option>
                @foreach ($produks as $produk)
                    <option value="{{ $produk->id }}">{{ $produk->nama_produk }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-inline row p-3">
        	<label for="tanggal_produksi_filter" class="col-lg-2">Tanggal Produksi</label>
            <select class="col-lg-4 form-control m-bootstrap-select " id="tanggal_produksi_filter">
                <option value="">
                @foreach ($wo->unique('production_realisation_date') as $wosnya)
                    All
                </option>
                    <option value="{{ $wosnya->id }}">{{ $wosnya->production_realisation_date }}</option>
                    }
                @endforeach
            </select>
        </div>
        <div class="row p-3">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body table-responsive">
                        <table class="m-datatable table table-striped table-bordered" id="table-analisa-kimia" width="100%">
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
                                    <th title="Field #4" >
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
                                            <td>
                                                @if ($cpp->analisa_kimia_id == null)
                                                    Belum Analisa
                                                @else
                                                    Sudah Analisa
                                                @endif
                                            </td>
                                            <td>
                                                <input type="submit" class="btn m-btn btn-warning form-control" value="Analisa" onclick="document.location.href='{{ route("analisa-produk",["id"=>app('App\Http\Controllers\resourceController')->enkripsi($cpp->id)]) }}'">
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
@endsection