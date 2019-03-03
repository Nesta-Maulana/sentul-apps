<div class="tab-pane" id="milkTankyb">
        <div class="card">
            <div class="card-header">
                Milk Tank Yobase
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-2">
                        <button class="btn-table btn-primary mb-2" onclick="tambahAktivitas()">Tambah Aktivitas (Alt + A)</button>
                    </div>
                    <div class="col-lg-2" style="margin-left: -60px;">
                        <button class="btn-table btn-danger mb-2 btn-hapus" style="visibility: hidden" onclick="hapusRow($('#contentnya').find('.active').attr('id') == 'pheTermisasi')">Hapus Aktivitas (Alt + Z)</button>
                    </div>
                </div>
                <div class="row py-3">
                    <div class="col-lg-6">
                        <div class="form-group form-check row">
                            <input type="checkbox" class="form-check-input ck checkBox" id="jacketsuhu">
                            <label class="form-check-label" for="jacketsuhu">Pastikan jacket sudah dinyalakan dan setting suhu jacket <input type="suhu" name="" id="" class="col-lg-2 textBox" maxlength="2" disabled>&deg;C</label>
                        </div>
                        <div class="form-group form-check row">
                            <input type="checkbox" class="form-check-input ck checkBox" id="boaedan">
                            <label class="form-check-label" for="boaedan">Set Agitator : 
                                <input type="text" name="" id="" class="col-lg-2 textBox" maxlength="2" disabled > On 
                                <input type="text" name="" id="" class="col-lg-2 caca" maxlength="2" disabled > OFF 
                        </div>
                    </div>
                    <div class="col-lg-6 table-aktivitas-milkTankyb" style="overflow-x: auto;visibility:hidden" >
                        <table class="table-sendiri" id="milkTankybtable">
                            <thead>
                                <tr>
                                    <th>Kegiatan</th>
                                    <th>Keterangan</th>
                                    <th>Parameter</th>
                                    <th>Satuan</th>
                                    <th>Target</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select class="custom-select form-control select-phe" id="KodeKegiatan">
                                            <option selected disabled>- Kode Kegiatan -</option>
                                            <option value="1">Informasi</option>
                                            <option value="2">Pengecekan</option>
                                            <option value="3">Check QC</option>
                                        </select>
                                    </td>
                                    <td>
                                        <textarea name="keterangan" id="" cols="30" rows="4"></textarea>
                                    </td>
                                    <td>
                                        <select class="custom-select form-control" id="KodeKegiatan">
                                            <option selected disabled>- Pilih Parameter -</option>
                                            <option value="1">Suhu Aktual</option>
                                            <option value="2">Main Heat</option>
                                            <option value="3">Final Cool</option>
                                            <option value="4">Suhu Display</option>
                                            <option value="4">Massa Larutan</option>
                                            <option value="4">Massa Display</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="custom-select form-control" id="KodeKegiatan">
                                            <option selected disabled>- Pilih Satuan -</option>
                                            <option value="1">&deg; C</option>
                                            <option value="2">Kg / h</option>
                                            <option value="3">Bar</option>
                                            <option value="4">Lainnya</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="3">
                                        <small id="target" class="form-text text-muted" style="text-align: justify">
                                            Hanya Tulis Angka Tanpa Satuan  
                                        </small>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <ul class="list-inline pull-right py-3">
            <li><button type="button" class="btn btn-primary next-page">Continue</button></li>
        </ul>
    </div>