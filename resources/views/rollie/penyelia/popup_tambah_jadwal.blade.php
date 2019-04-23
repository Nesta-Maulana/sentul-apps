<div class="modal fade" id="tambah-jadwal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-left: -614px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 226%;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Jadwal Produksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-inline row">
                    <label for="jenis" class="col-lg-2">Pilih Jenis Penambahan: </label>
                    <select name="jenis" id="jenis" class="form-control jenis col-lg-9">
                        <option value="" selected disabled>-- PILIH JENIS PENAMBAHAN Jadwal --</option>
                        <option value="1">Upload CPP</option>
                        <option value="0">Tambah 1 Row</option>
                    </select>
                </div>
                <div class="form-inline uploadnya row">
                    <label for="upload_mtol" class="col-lg-2">Upload Mtol : </label>
                    <input id="uploadFile" class="f-input" readonly>
                    <div class="fileUpload btn btn--browse">
                        <span>Browse</span>
                        <input id="uploadBtn" type="file" class="upload" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/>
                    </div>
                </div>
                <div class="add-row" style="margin-top: 10px;">
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>