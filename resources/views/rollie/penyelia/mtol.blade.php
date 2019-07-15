@extends('rollie.penyelia.templates.layout')
@section('title')
ROLLIE | MTOL
@endsection
@section('active-$menu->link')
active
@endsection

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
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
                        <h5 class="text-center text-danger" tool>
                            <a data-toggle="modal" data-target="#tambah-jadwal">
                                <i class="fa fa-plus-square-o"></i> Tambah WO Produksi
                            </a>
                        </h4>
                    </div>
                </div>
                <table cellpadding="0" cellspacing="0" border="0" class="display nowrap table" width="100%"
                    id="data-tables-wo">
                    <thead>
                        <tr>
                            <th title="Field #1">No</th>
                            <th title="Field #2">Nomor Wo</th>
                            <th title="Field #3">Kode Produk</th>
                            <th title="Field #4">Nama Produk</th>
                            <th title="Field #5" class="hidden-phone">Plan Date</th>
                            <th title="Field #6" class="hidden-phone">Realisation Date</th>
                            <th title="Field #7">Status</th>
                            <th title="Field #8">Plan Batch Size</th>
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
                        <?php $id=app('App\Http\Controllers\resourceController')->enkripsi($wo->id) ?>
                        <tr class="text-center">
                            <td>{{ $i }}</td>

                            <td>
                                <a data-toggle="modal" data-target="#proses-batch" onclick="prosesbatch('{{ $wo->produk->nama_produk }}','{{ $id }}','{{ $wo->nomor_wo }}','{{ $wo->production_plan_date }}')">
                                    {{ $wo->nomor_wo }}
                                </a>
                            </td>

                            <td>{{ $wo->produk->kode_oracle }}</td>

                            <td class="text-left">{{ $wo->produk->nama_produk }}</td>

                            <td>{{ $wo->production_plan_date }}</td>

                            {{-- Pengecekan apa tanggal realisasinya belum ada atau sudah ada --}}
                            @if (is_null($wo->production_realisation_date))
                                <td>-</td>
                            @else
                                <td>{{ $wo->production_realisation_date }}</td>
                            @endif

                            {{-- end pengecekan --}}
                            @switch($wo->status)
                                @case('0')        
                                    <td>Pending</td>
                                @break

                                @case('1')        
                                    <td>On Progress Mixing</td>
                                @break

                                @case('2')        
                                    <td>WIP Fillpack</td>
                                @break

                                @case('3')        
                                    <td>On Progress Fillpack</td>
                                @break

                                @case('4')        
                                    <td>Waiting For Close</td>
                                @break

                                @case('5')        
                                    <td>Close</td>
                                @break
                                
                                @case('6')        
                                    <td>Canceled</td>
                                @break
                            @endswitch
                            
                            
                            @if (!is_null($wo->plan_batch_size) && $wo->plan_batch_size !== "")
                                <td>{{ $wo->plan_batch_size }} KG</td>
                            @else
                                <td>-</td>
                            @endif
                            
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
                            <td> 
                                <a class="btn btn-danger text-white" onclick="deleteJadwal('{{ $id }}')">Delete</a>
                            </td><!-- href="/sentul-apps/rollie-penyelia/{{ $id }}" -->
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

<div class="modal" id="cancelJadwal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="id">
                <div class="form-group">
                    <div class="form-group">
                        <label for="alasan">Alasan : </label>
                        <textarea name="alasan" id="alasan" class="form-control" rows="10"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="simpan" data-dismiss="modal">Save changes</button>
            </div>
        </div>
    </div>
</div>
@include('rollie.penyelia.popup_tambah_jadwal')
@include('rollie.penyelia.popup_proses_wo')
<script>
    $('.jenis').change(function () {
        var isi = $('.jenis option:selected').val();
        var upload = document.getElementById('upload');
        var table = document.getElementById('tablenya-jadwal');
        if (isi == "1") {
            upload.classList.remove('hilang');
            table.classList.add('hilang');
            $("input[type=text]").prop('required', false);
            $("input[type=file]").prop('required', true);
        } else if (isi == "0") {
            upload.classList.add('hilang');
            table.classList.remove('hilang');
            $("input[type=text]").prop('required', true);
            $("input[type=file]").prop('required', false);
        }
    });

    $('.addRow').click(function () {
        var $tableBody = $('#tablenya').find("tbody"),
            $trLast = $tableBody.find("tr:last"),
            $trNew = $trLast.clone();
        $trLast.after($trNew);
        $i = 1;
        $input = $trNew.find('input').attr({

            'name': function (_, name) {
                return name
            }
        });
    })

    function deleteJadwal(id) {

        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah anda ingin menghapus data ini ?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.value) {
                $('#cancelJadwal').modal('show');
                // $('#cancelJadwal').modal('hide');
                $('#id').val(id);
                $('#simpan').click(function () {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: 'rollie-penyelia/jadwal-produksi/delete/' + id,
                        method: 'POST',
                        dataType: 'JSON',
                        data: {
                            'alasan': $('#alasan').val(),
                            'id': $('#id').val()
                        },
                        success: function (data) {
                            swal({
                                title: 'Berhasil',
                                text: 'Berhasil Menghapus',
                                type: 'success'
                            }).then((result) => {
                                if (result.value) {
                                    document.location.href = "";
                                }
                            })
                        }
                    });
                })
            }
        })

    }

</script>
@endsection
