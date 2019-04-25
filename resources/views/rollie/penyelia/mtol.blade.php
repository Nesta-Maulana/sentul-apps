@extends('rollie.penyelia.templates.layout')
@section('title')
    ROLLIE | MTOL
@endsection
@section('active-$menu->link')
    active
@endsection

@section('content')

<div class="bg-white rounded mt-5">
    <div class="row">
        <div class="col-lg-12">
            <div class="content-panel">
                <div class="row">
                    <div class="col-md-4">
                        <h4 class="text-dark">
                            <i class="fa fa-calendar"></i> Jadwal Produksi
                        </h4>
                    </div>
                    <div class="col-md-5"></div>
                    <div class="col-md-3">
                        <h4 class="text-center text-danger" tool>
                            <a data-toggle="modal" data-target="#tambah-jadwal">
                                <i class="fa fa-plus-square-o"></i> Tambah WO
                            </a>
                        </h4>
                    </div>
                </div>
                <table cellpadding="0" cellspacing="0" border="0" class="display nowrap table" width= "100%" id="data-tables-wo">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th class="hidden-phone">Plan Date</th>
                            <th class="hidden-phone">Realisation Date</th>
                            <th>Nomor Wo</th>
                            <th>Kode Produk</th>
                            <th>Nama Produk</th>
                            <th>Batch Size</th>
                            <th>Status</th>
                            <th>Keterangan 1</th>
                            <th>Lot FG</th>
                            <th>Actual Qty</th>
                            <th>Revisi Formula</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('rollie.penyelia.popup_tambah_jadwal')

<script>
    $('.jenis').change(function () {
        var isi = $('.jenis option:selected').val();
        var upload = document.getElementById('upload');
        var table = document.getElementById('tablenya-jadwal');
        if(isi == "1")
        {
            upload.classList.remove('hilang');
            table.classList.add('hilang');
            $("input[type=text]").prop('required',false);
            $("input[type=file]").prop('required',true);
        }
        else if(isi == "0")
        {
            upload.classList.add('hilang');
            table.classList.remove('hilang');
            $("input[type=text]").prop('required',true);
            $("input[type=file]").prop('required',false);
        }
    });


    $('.addRow').click(function () 
    {
        var $tableBody = $('#tablenya').find("tbody"),
            $trLast = $tableBody.find("tr:last"),
            $trNew = $trLast.clone();
            $trLast.after($trNew);
    })

</script>
@endsection