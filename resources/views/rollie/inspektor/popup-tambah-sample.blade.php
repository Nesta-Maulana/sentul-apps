<div class="modal fade" id="tambah-sample" tabindex="-1" role="dialog" aria-labelledby="tambahSampleAnalisa" aria-hidden="true" style="margin-left: -144px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 130%;">
            <div class="modal-header">
                <h5>Tambah Sampel Analisa</h5>
            </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="nomorwosampel" class="col-lg-4">Nomor Batch / Nomor Wo </label>
                        <select name="nomorwosampel" id="nomorwosampel" class="select col-lg-7 form-control" style="padding: 0 .8rem;" required="true">
                            <option selected disabled value="">Pilih Wo / Batch</option>
                        @php
                            $batchke = 1;    
                        @endphp
                        @foreach ($rpd_filling->detail_pi->unique('wo_id')->sortBy('jam_filling') as $detail_pi)
                            <option value="{{ $detail_pi->wo->id }}">Batch Ke {{ $batchke }} - {{ $detail_pi->wo->nomor_wo }}</option>
                        @php $batchke++; @endphp 
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group row">
                        <label for="mesinfillingsampel" class="col-lg-4">Mesin Filling</label>
                        <select name="mesinfillingsampel" id="mesinfillingsampel" class="select col-lg-7 form-control" style="padding: 0 .8rem;" required="true">
                            <option selected disabled value="">Pilih Mesin Filling</option>
                            @foreach ($rpd_filling->wo[0]->produk->mesinFillingHead->mesinFillingDetail as $mesinFillingDetail)
                                <option value="{{ $mesinFillingDetail->mesinfilling->id }}">{{ $mesinFillingDetail->mesinfilling->kode_mesin }}</option>
                            @endforeach
                        </select>
                    </div>
            
                    <div class="form-group row">
                        <label for="tanggalfillingsampel" class="col-lg-4">Tanggal Filling</label>
                        <div class='input-group date col-lg-7 datepickernya' id="tanggalfillingsampel" style="margin-left: -15px;">
                            <input type='text' class="form-control" name="tanggalfillingsampel" >
                            <span class="input-group-addon" style="margin-top: 5px; font-size: 20px; margin-left: 2px;">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>                        
                    </div>

                    <div class="form-group row">
                        <label for="jamfillingsampel" class="col-lg-4">Jam Filling</label>
                        <div class='input-group date col-lg-7 timepickernya' id="jamfillingsampel" style="margin-left: -15px;">
                            <input type='text' class="form-control" name="jamfillingsampel" >
                            <span class="input-group-addon" style="margin-top: 5px; font-size: 20px; margin-left: 2px;">
                               <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>                        
                    </div>

                    <div class="form-group row">
                        <label for="kodeanalisasampel" class="col-lg-4">Kode Analisa</label>
                        <select name="kodeanalisasampel" id="kodeanalisasampel" class="select col-lg-7 form-control" style="padding: 0 .8rem;" required="true">
                            <option selected disabled value="">Pilih Kode Sampel</option>
                            @foreach ($kode_sampel as $kode_sampel)
                            <option value="{{ $kode_sampel->id }}">{{ $kode_sampel->kode_sampel }} - {{ $kode_sampel->event }}</option>
                            @endforeach
                            
                        </select>
                    </div>
                    <div class="form-group row">
                        <label for="eventsampel" class="col-lg-4">Keterangan Event</label>
                        <select name="eventsampel" id="eventsampel" class="select col-lg-7 form-control" style="padding: 0 .8rem;">
                            <option value="idnya1"># Event</option>
                            <option value="idnya2">Event</option>
                        </select>
                    </div>
                    <div class="form-group has-warning row">
                        <label for="beratkanansampel" class="col-lg-4">Berat Kanan</label>
                        <input type="text" name="beratkanansampel" id="beratkanansampel" class="form-control col-lg-7" maxlength="6" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" required>
                        <small class="form-text text-muted" style="margin-left: 216px">Pemisah desimal menggunakan titik. <br> Desimal 2 angka dibelakang koma contoh : 222.30</small>
                    </div>

                    <div class="form-group has-warning row">
                        <label for="beratkirisampel" class="col-lg-4">Berat Kiri</label>
                        <input type="text" name="beratkirisampel" id="beratkirisampel" class="form-control col-lg-7" maxlength="6" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" required>
                        <small class="form-text text-muted" style="margin-left: 216px">Pemisah desimal menggunakan titik. <br> Desimal 2 angka dibelakang koma contoh : 222.30</small>
                    </div>
                    <div class="form-group has-warning row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-3"></div>
                        <input type="submit" class="btn btn-info col-lg-5 form-control" value="Save To Draft" onclick="">
                    </div>
                </div>

                <div class="modal-footer">
                </div>
        </div>
    </div>
</div>

