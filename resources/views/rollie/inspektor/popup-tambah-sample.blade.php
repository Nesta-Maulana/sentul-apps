<div class="modal fade" id="tambah-sample" tabindex="-1" role="dialog" aria-labelledby="tambahSampleAnalisa" aria-hidden="true" style="margin-left: -144px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 130%;">
            <div class="modal-header">
                <h5>Tambah Sampel Analisa</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <meta name="csrf-token" content="{{ csrf_token() }}" />
            <input type="hidden" name="user_id_inputer" id="user_id_inputer" value="{{ app('App\Http\Controllers\resourceController')->enkripsi($username->user->id) }}">
            <input type="hidden" id="rpd_filling_head_id" value="{{ app('App\Http\Controllers\resourceController')->enkripsi($rpd_filling->id) }}">
            <div class="modal-body">
                <div class="form-group row">
                    <label for="nomorwosampel" class="col-lg-4">Nomor Batch / Nomor Wo </label>
                    <select name="nomorwosampel" id="nomorwosampel" class="select col-lg-7 form-control" style="padding: 0 .8rem;" required="true">
                        <option selected disabled value="">Pilih Wo / Batch</option>
                    @php
                        $batchke = 1;    
                    @endphp
                    @if (count($rpd_filling->detail_pi) == 0)
                        @foreach ($rpd_filling->wo as $detail_pi)
                            <option value="{{ app('App\Http\Controllers\resourceController')->enkripsi($detail_pi->id) }}">Batch Ke {{ $batchke }} - {{ $detail_pi->nomor_wo }}</option>
                        @php $batchke++; @endphp 
                        @endforeach                        
                    @else
                        @foreach ($rpd_filling->detail_pi->unique('wo_id')->sortBy('jam_filling') as $detail_pi)
                            <option value="{{ app('App\Http\Controllers\resourceController')->enkripsi($detail_pi->wo->id) }}">Batch Ke {{ $batchke }} - {{ $detail_pi->wo->nomor_wo }}</option>
                        @php $batchke++; @endphp 
                        @endforeach
                    @endif
                    </select>
                </div>
                <div class="form-group row">
                    <label for="mesinfillingsampel" class="col-lg-4">Mesin Filling</label>
                    <select name="mesinfillingsampel" id="mesinfillingsampel" class="select col-lg-7 form-control" style="padding: 0 .8rem;" required="true">
                        <option selected disabled value="">Pilih Mesin Filling</option>
                        @foreach ($rpd_filling->wo[0]->produk->mesinFillingHead->mesinFillingDetail as $mesinFillingDetail)
                            <option value="{{ app('App\Http\Controllers\resourceController')->enkripsi($mesinFillingDetail->mesinfilling->id) }}">{{ $mesinFillingDetail->mesinfilling->kode_mesin }}</option>
                        @endforeach
                    </select>
                </div>
        
                <div class="form-group row">
                    <label for="tanggalfillingsampel" class="col-lg-4">Tanggal Filling</label>
                    <div class='input-group date col-lg-7 datepickernya'  style="margin-left: -15px;">
                        <input type='text' class="form-control" name="tanggalfillingsampel" id="tanggalfillingsampel" value="<?=date('Y-m-d')?>">
                        <span class="input-group-addon" style="margin-top: 5px; font-size: 20px; margin-left: 2px;">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>                        
                </div>

                <div class="form-group row">
                    <label for="jamfillingsampel" class="col-lg-4">Jam Filling</label>
                    <div class='input-group date col-lg-7 timepickernya'  style="margin-left: -15px;">
                        <input type='text' class="form-control" name="jamfillingsampel" id="jamfillingsampel" value="<?=date('H:i:s')?>">
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
                        <option value="{{ app('App\Http\Controllers\resourceController')->enkripsi($kode_sampel->id) }}">{{ $kode_sampel->kode_sampel }} - {{ $kode_sampel->event }}</option>
                        @endforeach
                        
                    </select>
                </div>
                <div class="form-group row">
                    <label for="eventsampel" class="col-lg-4">Keterangan Event</label>
                    <select name="eventsampel" id="eventsampel" class="select col-lg-6 form-control" style="padding: 0 .8rem;">
                        <option value="0"># Event</option>
                        <option value="1">Event</option>
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
                    <button class="btn btn-info col-lg-5 form-control" onclick="tambahSampelAnalisa($('#nomorwosampel').val(),$('#mesinfillingsampel').val(),$('#tanggalfillingsampel').val(),$('#jamfillingsampel').val(),$('#kodeanalisasampel').val(),$('#eventsampel').val(),$('#beratkanansampel').val(),$('#beratkirisampel').val(),$('#user_id_inputer').val(),$('#rpd_filling_head_id').val())" >Save To Draft</button>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

