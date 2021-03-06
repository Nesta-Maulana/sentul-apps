<div class="modal fade" id="tambah-jadwal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-left: -614px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 226%;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Jadwal Produksi</h5>
                l
            </div>
            {!! Form::open(['route'=>'import-jadwal-produksi','enctype'=>'multipart/form-data','method'=>'post']) !!}
                <div class="modal-body">
                    <div class="form-inline row">
                        <label for="jenis_upload" class="col-lg-2">Pilih Jenis Penambahan: </label>
                        <select name="jenis_upload" id="jenis_upload" class="form-control jenis col-lg-9">
                            <option value="" selected disabled>-- PILIH JENIS PENAMBAHAN Jadwal --</option>
                            <option value="1">Upload MTOL</option>
                            <option value="0">Tambah 1 Row</option>
                        </select>
                    </div>
                    <div class="form-inline uploadnya row hilang" id="upload">
                        <label for="upload_mtol" class="col-lg-2">Upload Mtol : </label>
                        <input id="uploadFile" class="f-input" readonly>
                        <div class="fileUpload btn btn--browse">
                            <span>Browse</span>
                            <input name="jadwalUpload" id="uploadBtn" type="file" class="upload" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required="true" />
                        </div>
                    </div>
                    <div class="add-row hilang" style="margin-top: 10px;" id="tablenya-jadwal">
                        <div class="row">
                            <div class="col-lg-12">                            
                                <button class="btn btn-primary addRow ">Tambah Row</button>
                            </div>
                        </div>
                        <div class="row">
                            <table class="table text-center table-bordered table-striped col-lg-12" id="tablenya">
                                <thead class="bg-dark text-white text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>No WO</th>
                                        <th>Nama Produk</th>
                                        <th>Plan Date</th>
                                        <th>Nama Plan</th>
                                        <th>Plan Batch Size</th>
                                        <th>Status</th>
                                        <th>Revisi Formula</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="no">1</td>
                                        <td><input type="text" id="wo[]" name="wo[]" class="form-control"></td>
                                        <td><input type="text" id="nama-produk[]" name="nama_produk[]" class="form-control"></td>
                                        <td><input type="date" id="plan-date[]" name="plan_date[]" class="form-control" ></td>
                                        <td><input type="text" id="nama-plan[]" name="nama_plan[]" class="form-control" ></td>
                                        <td><input type="text" id="plan-batch[]" name="plan_batch_size[]" class="form-control" ></td>
                                        <td><input type="text" id="status[]" name="status[]" class="form-control" ></td>
                                        <td><input type="text" id="revisi-formula[]" name="revisi_formula[]" class="form-control" ></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Tambah Jadwal">
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>