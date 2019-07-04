<div class="modal fade" id="tambah-batch-cpp" tabindex="-1" role="dialog" aria-labelledby="tambahBatchCpp" aria-hidden="true" style="margin-left: -144px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 130%;">
            <div class="modal-header">
                <h5>Tambah Batch</h5>
                <button type="button" id="close-button-tambah-wo" class="close" data-dismiss="modal" onclick="close_popup_tambah_batch()">&times;</button>
            </div>
            {!! Form::open(['route'=>'tambah-wo-cpp','enctype'=>'multipart/form-data','method'=>'post']) !!}
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="jenis_tambah" class="col-lg-4">Pilih Jenis Penambahan: </label>
                        <select name="jenis_tambah" id="jenis_tambah" class="form-control jenis col-lg-6" onchange="tambah_wo_batch(this.value,$('#cpp_head_id').val())">
                            <option value="" selected disabled>-- PILIH JENIS PENAMBAHAN  --</option>
                            <option value="1">Tambah WO Beda Mesin</option>
                            <option value="2">Tambah Batch</option>
                        </select>
                    </div>                       
                    <div class="form-group row">
                        <input type="hidden" name="cpp_head_id_nya" value="{{ app('App\Http\Controllers\resourceController')->enkripsi($cpps->id) }}">

                        <label for="nomor_wo_tambah" class="col-lg-4">Pilih Nomor Wo: </label>
                        <select name="nomor_wo_tambah" id="nomor_wo_tambah" class="form-control jenis col-lg-6">
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Tambah Wo">
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>