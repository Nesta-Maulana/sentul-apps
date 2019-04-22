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
                        <h4>
                            <i class="fa fa-calendar"></i> Jadwal Produksi
                        </h4>
                    </div>
                    <div class="col-md-5"></div>
                    <div class="col-md-3">
                        <h4 class="text-center" tool>
                            <a data-toggle="modal" data-target="#tambah-jadwal">
                                <i class="fa fa-plus-square-o"></i> Tambah WO
                            </a>
                        </h4>
                    </div>
                </div>
                <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="data-tables-wo">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No WO.</th>
                            <th>Nama Produk</th>
                            <th class="hidden-phone">Plan Date</th>
                            <th class="hidden-phone">Tanggal Realisasi</th>
                            <th class="hidden-phone">Revisi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for($i = 1; $i <=100; $i++)
                            <tr class="gradeX">
                                <td>{{ $i }}</td>
                                <td>Trident {{ $i }}</td>
                                <td>Internet Explorer {{$i}}.0</td>
                                <td class="hidden-phone">Win 9{{$i}}+</td>
                                <td class="center hidden-phone">4</td>
                                <td class="center hidden-phone">X</td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('rollie.penyelia.popup_tambah_jadwal')



<script>
    $('.uploadnya').hide();
    $('.add-row').hide();
    $('.jenis').change(function () {
        var isi = $('.jenis option:selected').val();
        
        if(isi == "1"){
            $('.add-row').hide();
            $('.uploadnya').show();
        }
        else if(isi == "0"){
            $('.uploadnya').hide();
            $('.add-row').show();
        }
    });
    $('.addRow').click(function () {
        var $tableBody = $('#tablenya').find("tbody"),
            $trLast = $tableBody.find("tr:last"),
            $trNew = $trLast.clone();
            $trLast.after($trNew);
    })

</script>
@endsection