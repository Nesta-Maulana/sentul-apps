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
                            <th>Nomor Wo</th>
                            <th>Keterangan 1</th>
                            <th>Keterangan 2</th>
                            <th>Keterangan 3</th>
                            <th>Kode Produk</th>
                            <th>Nama Produk</th>
                            <th>PH Plan Qty</th>
                            <th>Status</th>
                            <th>Lot FG</th>
                            <th>Creation Date</th>
                            <th>Actual Start Date</th>
                            <th>Plan Complete Date</th>
                            <th>Actual Complete Date</th>
                            <th>Batch Close Date</th>
                            <th>Actual Qty</th>
                            <th>WIP PLAN Qty</th>
                            <th>Di RTP</th>
                            <th>Category</th>
                            <th>Revisi Formula</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for($i = 1; $i <=100; $i++)
                        <tr class="gradeX">
                            <td>Data 1</td>
                            <td>Data 2</td>
                            <td>Data 3</td>
                            <td>Data 4</td>
                            <td>Data 5</td>
                            <td>Data 6</td>
                            <td>Data 7</td>
                            <td>Data 8</td>
                            <td>Data 9</td>
                            <td>Data 10</td>
                            <td>Data 11</td>
                            <td>Data 12</td>
                            <td>Data 13</td>
                            <td>Data 14</td>
                            <td>Data 15</td>
                            <td>Data 16</td>
                            <td>Data 17</td>
                            <td>Data 18</td>
                            <td>Data 19</td>
                            <td>Data 20</td>
                            <td>Data 21</td>
                            <td>Data 22</td>
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