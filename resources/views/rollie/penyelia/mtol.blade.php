@extends('rollie.penyelia.templates.layout')
@section('title')
    ROLLIE | MTOL
@endsection
@section('content')

<div class="bg-white rounded mt-5">
    <h3 class="pt-2 text-center">Data tables</h3>
    <hr>
    <div class="d-flex justify-content-center">
        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus-square-o"></i> Tambah WO</button>
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="jenis">Pilih Jenis : </label>
                    <select name="jenis" id="jenis" class="form-control jenis">
                        <option value="" selected disabled>-- PILIH JENIS PENAMBAHAN --</option>
                        <option value="1">Upload CPP</option>
                        <option value="0">Tambah 1 Row</option>
                    </select>
                </div>
                <div class="upload">
                    <div class="form-group">
                        <label for="">Upload : </label>
                        <input type="file" name="file" id="file" class="form-control-file">
                    </div>
                </div>
                <div class="add-row">
                    <button class="btn btn-primary addRow">Tambah Row</button>
                    <table class="table" id="tablenya">
                        <thead class="bg-dark text-white text-center">
                            <tr>
                                <th>No</th>
                                <th>No WO</th>
                                <th>Nama Produk</th>
                                <th>Plan Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="no">1</td>
                                <td><input type="text" name="wo" class="form-control"></td>
                                <td><input type="text" name="nama-produk" class="form-control"></td>
                                <td><input type="text" name="plan-date" class="form-control"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>


<script>
    $('.upload').hide();
    $('.add-row').hide();
    $('.jenis').change(function () {
        var isi = $('.jenis option:selected').val();
        
        if(isi == "1"){
            $('.add-row').hide();
            $('.upload').show();
        }
        else if(isi == "0"){
            $('.upload').hide();
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