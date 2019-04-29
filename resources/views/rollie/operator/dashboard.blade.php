@extends('rollie.operator.templates.layout')
@section('title')
    ROLLIE | Dashboard
@endsection
@section('content')
	<div class="row mt-5 mb-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <h4 class="header-title mb-0">Jadwal Produksi</h4>
                    </div>
                    <div class="market-status-table mt-4">
                        <div class="table-responsive">
                            <table class="dbkit-table">
                                <thead>
                                    <tr class="heading-td" >
                                        <th class="mv-icon">Nomor Wo</th>
                                        <th class="coin-name">Produk</th>
                                        <th class="buy">Tanggal Produksi</th>
                                        <th class="sell">Batch Size</th>
                                        <th class="trends">Formula</th>
                                        <th class="stats-chart">Status</th>
                                        <th class="attachments">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($wos as $wo)
                                    <tr>
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	   
@endsection
