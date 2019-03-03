<div class="tab-pane " id="pheCooler">
        <div class="card">
            <div class="card-header">
                PHE Cooler
            </div>
            <div class="card-body">
                <div class="row py-3">
                    <div class="col-lg-6">
                        <div class="form-group form-check row">
                            <input type="checkbox" class="form-check-input ck checkBox" id="Chiller">
                            <label class="form-check-label" for="Chiller">Pastikan chiller sudah tersirkulasi, suhu target chiller <input type="text" name="" id="" class="col-lg-2 textBox" maxlength="2" disabled>&deg;C</label>
                        </div>
                        <div class="form-group form-check row">
                            <input type="checkbox" class="form-check-input ck checkBox" id="jacketst">
                            <label class="form-check-label" for="jacketst">Pastikan Jacket untuk ST sudah dinyalakan sebelum Transfer, suhu Jacket <input type="text" name="" id="" class="col-lg-2 textBox" maxlength="2" disabled>&deg;C</label>
                        </div>
                        <div class="form-group form-check row">
                            <input type="checkbox" class="form-check-input ck checkBox" id="flowrate">
                            <label class="form-check-label" for="flowrate">Transfer WIP dengan flowrate <input type="text" name="" id="" class="col-lg-2 textBox" maxlength="2" disabled><strong>Kg/h</strong></label>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Pengecekan QC :</label>
                            <select class=" form-control" id="Pengecekan" multiple>
                                    <option disabled>Pilih Parameter Pengecekan</option>
                                    <option value="6">Ph</option>
                                    <option value="1">TDS</option>
                                    <option value="2">Sensori</option>
                                    <option value="3">Cek Kelarutan (Cawan Petri)</option>
                                    <option value="4">Suhu Aktual</option>
                                    <option value="5">Ph</option>
                                    <option value="5">Suhu Bagian Atas</option>
                                    <option value="5">Suhu Bagian Tengah</option>
                                    <option value="5">Suhu Bagian Bawah</option>
                                </select>
                        </div>
                        
                        <div class="form-group form-check row">
                            <input type="checkbox" class="form-check-input ck checkBox" id="dorong">
                            <label class="form-check-label" for="dorong">Dorong Product di ITS melalui jalur dorongan dengan penambahan<input type="text" name="" id="" class="col-lg-2 textBox" maxlength="2" disabled><strong>Kg</strong></label>
                        </div>
                        <div class="form-group form-check row">
                            <input type="checkbox" class="form-check-input ck checkBox" id="checkst">
                            <label class="form-check-label" for="checkst">QC Check Level ST setelah dorongan</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <ul class="list-inline pull-right py-3">
            <li><button type="button" class="btn btn-primary next-page">Continue</button></li>
        </ul>
    </div>