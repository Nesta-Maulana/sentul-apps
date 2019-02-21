<div class="tab-pane" id="incubationTank">
        <div class="card">
            <div class="card-header">
                Incubation Tank
            </div>
            <div class="card-body">
                <div class="form-inline row" >
                    <div class="col align-self-end">
                        <button type="submit" class="btn-table btn-info mb-2 right" onclick="tambahRow($('#contentnya').find('.active').attr('id'));">Tambah Row (ALT + A)</button>
                        <button type="submit" class="btn-table btn-info mb-2" onclick="hapusRow($('#contentnya').find('.active').attr('id'));">Hapus Row (ALT + Z)</button>
                    </div>
                </div>
    
                <div class="row py-3">
                    <div class="col-lg-12 centered" style="overflow-x: auto;">
                        <table class="table-sendiri" id="incubationTankybtable">
                            <thead>
                                <tr class="text-center">
                                    <th class="align-middle">Kode Kegiatan</th>
                                    <th class="align-middle">Bahan Baku</th>
                                    <th class="align-middle" colspan="2">Jumlah</th>
                                    <th class="align-middle">Jalur BB</th>
                                    <th class="align-middle">Waktu Mixing</th>
                                    <th class="align-middle">Scanima</th>
                                    <th class="align-middle" >Agitator</th>
                                    <th class="align-middle">Suhu Air</th>
                                    <th class="align-middle">Parameter QC</th>
                                    <th class="align-middle">Catatan Tambahan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="tr_clone">
                                    <td>
                                        <select class="custom-select form-control" id="KodeKegiatan">
                                            <option selected disabled>- Kode Kegiatan -</option>
                                            <option value="1">A -  Tuang Bahan Baku</option>
                                            <option value="2">B -  Tambahkan Air Dorongan</option>
                                            <option value="3">C -  Checking QC</option>
                                            <option value="4">D -  Mixing</option>
                                            <option value="5">E -  Sirkulasi 5 Menit</option>
                                            <option value="6">F -  Adjust Brix</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="custom-select form-control" id="BahanBaku">
                                            <option selected disabled>- Bahan Baku -</option>
                                            <option value="1">Premix A</option>
                                            <option value="2">Premix B</option>
                                            <option value="3">Air Demin</option>
                                            <option value="4">Whey</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="input-sendiri" placeholder="Utuh" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="3">
                                        <small id="passwordHelpBlock" class="form-text text-muted" style="text-align: justify">
                                            * SAK / Kg
                                        </small>
                                    </td>
                                    
                                    <td>
                                        <input type="text" class="input-sendiri" placeholder="Koma" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="3">
                                        <small id="passwordHelpBlock" class="form-text text-muted" style="text-align: justify">
                                            * Kantong 
                                        </small>
                                    </td>
                                    <td>
                                        <select class="custom-select form-control" id="Jalur">
                                            <option selected disabled>- Via Jalur -</option>
                                            <option value="1">Scanima</option>
                                            <option value="2">Man Hole</option>
                                            <option value="3">--</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="input-sendiri" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="3">
                                        <small id="passwordHelpBlock" class="form-text text-muted" style="text-align: justify">
                                            * Menit   
                                        </small>
                                    </td>
                                    <td>
                                        <input type="radio" name="scanima"> ON
                                        <input type="radio" name="scanima"> OFF
                                    </td>
                                    <td>
                                        <input type="radio" name="agitator"> ON
                                        <input type="radio" name="agitator"> OFF
                                    </td>
                                    <td>
                                        <input type="text" class="input-sendiri" maxlength="3" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="2">
                                        <small id="passwordHelpBlock" class="form-text text-muted" style="text-align: justify">
                                            &deg; C   
                                        </small>
                                    </td>
                                    <td>
                                        <select class="custom-select" id="Pengecekan" multiple>
                                            <option disabled>Pilih Parameter Pengecekan</option>
                                            <option value="6">Ph</option>
                                            <option value="1">TDS</option>
                                            <option value="2">Sensori</option>
                                            <option value="3">Cek Kelarutan (Cawan Petri)</option>
                                            <option value="4">Suhu Aktual</option>
                                            <option value="5">pH</option>
                                        </select>
                                        <small id="passwordHelpBlock" class="form-text text-muted" style="text-align: justify">
                                            Parameter Pengecekan Sesudah Kegiatan   
                                        </small>
                                    </td>
                                    <td>
                                        <textarea name="" id="" cols="30" rows="4" class="form-control"></textarea>
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