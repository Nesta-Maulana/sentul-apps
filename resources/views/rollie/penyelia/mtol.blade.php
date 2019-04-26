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
                            <th title="Field #1">No</th>
                            <th title="Field #2" class="hidden-phone">Plan Date</th>
                            <th title="Field #3" class="hidden-phone">Realisation Date</th>
                            <th title="Field #4">Nomor Wo</th>
                            <th title="Field #5">Kode Produk</th>
                            <th title="Field #6">Nama Produk</th>
                            <th title="Field #7">Plan Batch Size</th>
                            <th title="Field #8">Status</th>
                            <th title="Field #9">Actual Batch Size</th>
                            <th title="Field #10">Keterangan 1</th>
                            <th title="Field #11">Keterangan 2</th>
                            <th title="Field #12">Keterangan 3</th>
                            <th title="Field #13">Lot FG</th>
                            <th title="Field #14">Revisi Formula</th>
                            <th title="Field #15">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                    @foreach ($wos as $wo)
                        <tr class="text-center">
                            <td>{{ $i }}</td>
                            <td>{{ $wo->production_plan_date }}</td>
                            {{-- Pengecekan apa tanggal realisasinya belum ada atau sudah ada --}}
                            @if (is_null($wo->production_realisation_date))
                                <td >-</td>
                            @else
                                <td>{{ $wo->production_realisation_date }}</td>
                            @endif
                            {{-- end pengecekan --}}
                            <td>{{ $wo->nomor_wo }}</td>
                            <td>{{ $wo->produk->kode_oracle }}</td>
                            <td class="text-left">{{ $wo->produk->nama_produk }}</td>
                            <td>{{ $wo->plan_batch_size }} KG</td>
                            <td>{{ $wo->status }}</td>
                            @if (is_null($wo->actual_batch_size))
                                <td>0</td>
                            @else
                                <td>{{ $wo->actual_batch_size }} KG</td>
                            @endif
                            <td>{{ $wo->keterangan_1 }}</td>
                            <td>{{ $wo->keterangan_2 }}</td>
                            <td>{{ $wo->keterangan_3 }}</td>
                            <td>-</td>
                            <td class="text-left">{{ $wo->revisi_formula }}</td>
                            <td></td>
                        </tr>
                        @php
                            $i++;
                        @endphp
                    @endforeach
                    </tbody>
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