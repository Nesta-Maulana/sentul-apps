<div class="modal fade bd-example-modal-lg" id="analisa-sample-at-event" tabindex="-1" role="dialog" aria-labelledby="analisaSample" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Hasil Analisa At Event- Sample <label id="hasilanalisasampel"> F (EVENT) </label> Produk Hilo Teen Coklat 200Ml</h5>
                <button type="button" id="close-button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <meta name="csrf-token" content="{{ csrf_token() }}" />
            <input type="hidden" name="user_id_inputer" id="user_id_inputer" value="{{ app('App\Http\Controllers\resourceController')->enkripsi($username->user->id) }}">
            <input type="hidden" id="rpd_filling_head_id" value="{{ app('App\Http\Controllers\resourceController')->enkripsi($rpd_filling->id) }}">
            <div class="modal-body">
                <div class="form-group row">
                    <label for="hasil_ls_sa_sealing_quality" class="col-lg-3">LS/SA Sealing Quality</label>
                    <select name="hasil_ls_sa_sealing_quality" id="hasil_ls_sa_sealing_quality" class="select col-lg-8 form-control" style="padding: 0 .8rem;" required="true">
                        <option value="OK" selected>OK</option>
                        <option value="#OK">#OK</option>
                    </select>
                </div>

                <div class="form-group row">
                    <label for="hasil_ls_sa_proportion" class="col-lg-3">LS/SA Sealing Quality</label>
                    <input type="text" class="col-lg-8 form-control" name="hasil_ls_sa_proportion" id="col-lg-8" maxlength="5" placeholder="Ex : 40:60" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 58">
                    <small class="form-text text-muted" style="margin-left: 216px">Di isi dengan Angka dengan format XX:XX</small>
                </div>
                
                <div class="form-group row">
                    <label for="hasil_ls_sa_proportion" class="col-lg-3">LS/SA Sealing Quality</label>
                    <input type="text" class="col-lg-8 form-control" name="hasil_ls_sa_proportion" id="col-lg-8" maxlength="5" placeholder="Ex : 40:60" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 58">
                    <small class="form-text text-muted" style="margin-left: 216px">Di isi dengan Angka dengan format XX:XX</small>
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
