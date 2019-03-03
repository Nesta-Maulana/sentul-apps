<div class="tab-pane" id="pheYb">
    <div class="card">
        <div class="card-header">
            PHE YB
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
                    <div class="form-group row">
                        <label for="PilihFilter" class="col-lg-4 col-form-label">Filter</label>
                        <div class="col-lg-8">
                            <select class="custom-select form-control" id="PilihRecipe">
                                <option selected disabled>-- Pilih Filter --</option>
                                <option value="1">177 Mikron</option>
                                <option value="2">150 Mikron</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row" >
                        <label for="PilihFilter" class="col-lg-4 col-form-label">Recipe</label>
                        <div class="col-lg-8">
                            <select class="custom-select form-control" id="PilihRecipe">
                                <option selected disabled>-- Pilih Recipe --</option>
                                <option value="1">Recipe 1</option>
                                <option value="2">Recipe 2</option>
                                <option value="3">Recipe 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row"  style="margin-left: 0px;">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="checkbox" class="checkBox">
                                </div>
                            </div>
                            <textarea class="form-control textBox" name="text" id="" cols="30" rows="3" disabled>Pastikan kesesuaian jalur sesuai lampiran konfigurasi PHE YB</textarea>
                        </div>
                    </div>
                    
                    <div class="form-group row" style="margin-left: 0px;">
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input ck checkBox" id="bar">
                            <label for="bar">Saat Step Push Water To Drain Aktifkan pressure homogenizer <input type="text" class="col-lg-2 textBox" name="" disabled> BAR</label>
                        </div>
                    </div>
                    
                    <div class="form-group row" style="margin-left: 0px;">
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input ck checkBox" id="levelmt">
                            <label for="levelmt">Saat level MT &nbsp;<input type="text" class="col-lg-2 textBox" name="" disabled> L, tambahkan air demin <input type="text" name="" class="col-lg-2 caca" disabled > Liter untuk mendorong</label>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6 table-aktivitas-pheYb"  style="overflow-x: auto;visibility:hidden" >
                    <table class="table-sendiri" id="pheYbtable">
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