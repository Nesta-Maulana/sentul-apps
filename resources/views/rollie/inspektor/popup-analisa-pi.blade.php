<div class="modal fade bd-example-modal-lg" id="analisa-sample-pi" tabindex="-1" role="dialog" aria-labelledby="analisaSample" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Hasil Analisa PI - <label style="color: black;" id="nama_produk_analisa_pi"></label></h5>
                <button type="button" id="close-button-pi" class="close" data-dismiss="modal" onclick="hapusdatapopupanalisapi()">&times;</button>
            </div>
            <meta name="csrf-token" content="{{ csrf_token() }}" />
            <input type="hidden" name="user_id_inputer" id="user_id_inputer" value="{{ app('App\Http\Controllers\resourceController')->enkripsi($username->user->id) }}">
            <input type="hidden" id="rpd_filling_detail_id_pi">
            <input type="hidden" id="wo_id_sampel">
            <input type="hidden" id="mesin_filling_id_sampel">
            <input type="hidden" id="nama_produk_analisa_pi_kirim">
            <input type="hidden" id="rpd_filling_head_id" value="{{ app('App\Http\Controllers\resourceController')->enkripsi($rpd_filling->id) }}">
            <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <hr>
                                <h6 class="">Event Point</h6>
                                <hr>    
                            </div>
                        </div>
                    </div>
                    <div class="form-group row" >
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="sampel_pi_analisa" class="col-lg-4">Sampel</label>
                                <input type="text" name="sampel_pi_analisa" id="sampel_pi_analisa" class="col-lg-7 form-control" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="mesin_filling_pi_analisa" class="col-lg-4">Mesin Filling</label>
                                <input type="text" name="mesin_filling_pi_analisa" id="mesin_filling_pi_analisa" class="col-lg-7 form-control" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row" >
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="tanggal_filling_pi_analisa" class="col-lg-4">Tanggal Filling</label>
                                <input type="text" name="tanggal_filling_pi_analisa" id="tanggal_filling_pi_analisa" value="2019-05-15" class="col-lg-7 form-control" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="jam_filling_pi_analisa" class="col-lg-4">Jam Filling</label>
                                <input type="text" name="jam_filling_pi_analisa" id="jam_filling_pi_analisa" value="07:02:00" class="col-lg-7 form-control" readonly>
                            </div>
                        </div>
                    </div>
                <hr>

                <div class="form-group has-warning row">
                    <label for="hasil_overlap" class="col-lg-3">Overlap (3.5-4.5)</label>
                    <input type="text" name="hasil_overlap" inputmode="decimal" pattern="[0-9]*" id="hasil_overlap" class="form-control col-lg-8" maxlength="4" max="5" min="3" autocomplete="false" required>
                    <small class="form-text text-muted" style="margin-left: 216px">Batas Min. 3.5 Batas Max. 4.5</small>
                </div>
                <div class="form-group row">
                    <label for="hasil_ls_sa_proportion" class="col-lg-3">LS/SA Proportion</label>
                    <input type="text" class="col-lg-8 form-control" inputmode="tel" id="hasil_ls_sa_proportion" name="hasil_ls_sa_proportion" maxlength="5" placeholder="Ex : 40:60" autocomplete="false">
                    <small class="form-text text-muted" style="margin-left: 216px">Di isi dengan Angka dengan format XX:XX</small>
                </div>

                <div class="form-group row">
                    <label for="hasil_volume_kanan" class="col-lg-3">Hasil Volume Kanan</label>
                    <input type="text" inputmode="numeric" class="col-lg-8 form-control" name="hasil_volume_kanan" id="hasil_volume_kanan" maxlength="3" placeholder="Ex : 200" onkeypress="return event.charCode >= 48 && event.charCode <= 57" autocomplete="false">
                    <small class="form-text text-muted" style="margin-left: 216px">Batas Min. 198 Batas Max. 200</small>
                </div>
                <div class="form-group row">
                    <label for="hasil_volume_kiri" class="col-lg-3">Hasil Volume Kiri</label>
                    <input type="text" inputmode="numeric" class="col-lg-8 form-control" name="hasil_volume_kiri" id="hasil_volume_kiri" maxlength="3" placeholder="Ex : 200" onkeypress="return event.charCode >= 48 && event.charCode <= 57" autocomplete="false">
                    <small class="form-text text-muted" style="margin-left: 216px">Batas Min. 198 Batas Max. 200</small>
                </div>
                <div class="form-group row">
                    <label for="hasil_air_gap" class="col-lg-3">Airgap (Max. 1mm)</label>
                    <select name="hasil_air_gap" id="hasil_air_gap" class="select col-lg-8 form-control" style="padding: 0 .8rem;" required="true">
                        <option value="OK" selected>OK</option>
                        <option value="#OK">#OK</option>
                        <option value="-">-</option>
                    </select>
                </div>
                
                <div class="form-group row">
                    <label for="hasil_ts_accurate_kanan" class="col-lg-3">TS Accurate Kanan</label>
                    
                    <select name="hasil_ts_accurate_kanan" id="hasil_ts_accurate_kanan" class="select col-lg-8 form-control" style="padding: 0 .8rem;" required="true">
                        <option value="OK" selected>OK</option>
                        <option value="#OK">#OK</option>
                        <option value="-">-</option>
                    </select>

                    <select name="ts_accurate_kanan_tidak_ok" id="ts_accurate_kanan_tidak_ok" class="select col-lg-4 form-control sembunyi" style="padding: 0 .8rem;" required="true">
                        <option value="#ok" selected disabled>Pilih Kategori #OK</option>
                        <option value="Block Seal">Block Seal</option>
                        <option value="Crack">Crack</option>
                        <option value="Plastic Lump">Plastic Lump</option>
                    </select>
                </div>
                
                <div class="form-group row">
                    <label for="hasil_ts_accurate_kiri" class="col-lg-3">TS Accurate Kiri</label>
                    
                    <select name="hasil_ts_accurate_kiri" id="hasil_ts_accurate_kiri" class="select col-lg-8 form-control" style="padding: 0 .8rem;" required="true">
                        <option value="OK" selected>OK</option>
                        <option value="#OK">#OK</option>
                        <option value="-">-</option>
                    </select>

                    <select name="ts_accurate_kiri_tidak_ok" id="ts_accurate_kiri_tidak_ok" class="select col-lg-4 form-control sembunyi" style="padding: 0 .8rem;" required="true">
                        <option value="#ok" selected disabled>Pilih Kategori #OK</option>
                        <option value="Block Seal">Block Seal</option>
                        <option value="Crack">Crack</option>
                        <option value="Plastic Lump">Plastic Lump</option>
                    </select>
                </div>

                <div class="form-group row">
                    <label for="hasil_ls_accurate" class="col-lg-3">LS Accurate</label>
                    
                    <select name="hasil_ls_accurate" id="hasil_ls_accurate" class="select col-lg-8 form-control" style="padding: 0 .8rem;" required="true">
                        <option value="OK" selected>OK</option>
                        <option value="#OK">#OK</option>
                        <option value="-">-</option>
                    </select>

                    <select name="ls_accurate_tidak_ok" id="ls_accurate_tidak_ok" class="select col-lg-4 form-control sembunyi" style="padding: 0 .8rem;" required="true">
                        <option value="#ok" selected disabled>Pilih Kategori #OK</option>
                        <option value="Block Seal">Block Seal</option>
                        <option value="Strip Wrinkle">Strip Wrinkle</option>
                    </select>
                </div>
                <div class="form-group row">
                    <label for="hasil_sa_accurate" class="col-lg-3">SA Accurate</label>
                    
                    <select name="hasil_sa_accurate" id="hasil_sa_accurate" class="select col-lg-8 form-control" style="padding: 0 .8rem;" required="true">
                        <option value="OK" selected>OK</option>
                        <option value="#OK">#OK</option>
                        <option value="-">-</option>
                    </select>

                    <select name="sa_accurate_tidak_ok" id="sa_accurate_tidak_ok" class="select col-lg-4 form-control sembunyi" style="padding: 0 .8rem;" required="true">
                        <option value="#ok" selected disabled>Pilih Kategori #OK</option>
                        <option value="Block Seal">Block Seal</option>
                        <option value="Strip Wrinkle">Strip Wrinkle</option>
                    </select>
                </div>
                <div class="form-group row">
                    <label for="hasil_surface_check" class="col-lg-3">Surface Check</label>
                    
                    <select name="hasil_surface_check" id="hasil_surface_check" class="select col-lg-8 form-control" style="padding: 0 .8rem;" required="true">
                        <option value="OK" selected>OK</option>
                        <option value="#OK">#OK</option>
                        <option value="-">-</option>
                    </select>

                    <select name="surface_check_tidak_ok" id="surface_check_tidak_ok" class="select col-lg-4 form-control sembunyi" style="padding: 0 .8rem;" required="true">
                        <option value="#ok" selected disabled>Pilih Kategori #OK</option>
                        <option value="Block Seal">Block Seal</option>
                        <option value="Strip Wrinkle">Strip Wrinkle</option>
                    </select>
                </div>
                <div class="form-group row">
                    <label for="hasil_pinching" class="col-lg-3">Pinching</label>
                    <select name="hasil_pinching" id="hasil_pinching" class="select col-lg-8 form-control" style="padding: 0 .8rem;" required="true">
                        <option value="OK" selected>OK</option>
                        <option value="#OK">#OK</option>
                        <option value="-">-</option>
                    </select>
                </div>
                <div class="form-group row">
                    <label for="hasil_strip_folding" class="col-lg-3">Strip Folding</label>
                    <select name="hasil_strip_folding" id="hasil_strip_folding" class="select col-lg-8 form-control" style="padding: 0 .8rem;" required="true">
                        <option value="OK" selected>OK</option>
                        <option value="#OK">#OK</option>
                        <option value="-">-</option>
                    </select>
                </div>
                <div class="form-group row">
                    <label for="hasil_konduktivity_kanan" class="col-lg-3">Konduktivity Kanan</label>
                    <select name="hasil_konduktivity_kanan" id="hasil_konduktivity_kanan" class="select col-lg-8 form-control" style="padding: 0 .8rem;" required="true">
                        <option value="OK" selected>OK</option>
                        <option value="#OK">#OK</option>
                        <option value="-">-</option>
                    </select>
                </div>
                <div class="form-group row">
                    <label for="hasil_konduktivity_kiri" class="col-lg-3">Konduktivity Kiri</label>
                    <select name="hasil_konduktivity_kiri" id="hasil_konduktivity_kiri" class="select col-lg-8 form-control" style="padding: 0 .8rem;" required="true">
                        <option value="OK" selected>OK</option>
                        <option value="#OK">#OK</option>
                        <option value="-">-</option>
                    </select>
                </div>
                <div class="form-group row">
                    <label for="hasil_design_kanan" class="col-lg-3">Design Kanan</label>
                    <select name="hasil_design_kanan" id="hasil_design_kanan" class="select col-lg-8 form-control" style="padding: 0 .8rem;" required="true">
                        <option value="OK" selected>OK</option>
                        <option value="#OK">#OK</option>
                        <option value="-">-</option>
                    </select>
                </div>
                <div class="form-group row">
                    <label for="hasil_design_kiri" class="col-lg-3">Design Kiri</label>
                    <select name="hasil_design_kiri" id="hasil_design_kiri" class="select col-lg-8 form-control" style="padding: 0 .8rem;" required="true">
                        <option value="OK" selected>OK</option>
                        <option value="#OK">#OK</option>
                        <option value="-">-</option>
                    </select>
                </div>
                <div class="form-group row">
                    <label for="hasil_dye_test" class="col-lg-3">Dye Test*</label>
                    <select name="hasil_dye_test" id="hasil_dye_test" class="select col-lg-8 form-control" style="padding: 0 .8rem;" required="true">
                        <option value="OK" selected>OK</option>
                        <option value="#OK">#OK</option>
                        <option value="-">-</option>
                    </select>
                </div>
                <div class="form-group row">
                    <label for="hasil_residu_h2o2" class="col-lg-3">Residu H2O2 (Maks. 0,5 ppm)</label>
                    <select name="hasil_residu_h2o2" id="hasil_residu_h2o2" class="select col-lg-8 form-control" style="padding: 0 .8rem;" required="true">
                        <option value="OK" selected>OK</option>
                        <option value="#OK">#OK</option>
                        <option value="-">-</option>
                    </select>
                </div>
                <div class="form-group row">
                    <label for="hasil_prod_code_no_md" class="col-lg-3">Prod Code & No Md</label>
                    <select name="hasil_prod_code_no_md" id="hasil_prod_code_no_md" class="select col-lg-8 form-control" style="padding: 0 .8rem;" required="true">
                        <option value="OK" selected>OK</option>
                        <option value="#OK">#OK</option>
                        <option value="-">-</option>
                    </select>
                </div>
                <div class="form-group row">
                    <label for="hasil_correction" class="col-lg-3">Correction</label>
                    <textarea name="hasil_correction" id="hasil_correction" cols="30" rows="10" class="form-control col-lg-8" required>-</textarea>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-3"></div>
                    <button class="btn btn-info col-lg-5 form-control" onclick="submit_analisa_pi($('#rpd_filling_detail_id_pi').val(),$('#rpd_filling_head_id').val(),$('#nama_produk_analisa_pi_kirim').val(),$('#hasil_air_gap').val(),$('#hasil_ts_accurate_kanan').val(),$('#hasil_ts_accurate_kiri').val(),$('#hasil_ls_accurate').val(),$('#hasil_sa_accurate').val(),$('#hasil_surface_check').val(),$('#hasil_pinching').val(),$('#hasil_strip_folding').val(),$('#hasil_konduktivity_kanan').val(),$('#hasil_konduktivity_kiri').val(),$('#hasil_design_kanan').val(),$('#hasil_design_kiri').val(),$('#hasil_dye_test').val(),$('#hasil_residu_h2o2').val(),$('#hasil_prod_code_no_md').val(),$('#hasil_correction').val(),$('#ts_accurate_kanan_tidak_ok').val(),$('#ts_accurate_kiri_tidak_ok').val(),$('#ls_accurate_tidak_ok').val(),$('#sa_accurate_tidak_ok').val(),$('#surface_check_tidak_ok').val(),$('#wo_id_sampel').val(),$('#mesin_filling_id_sampel').val(),$('#hasil_overlap').val(),$('#hasil_ls_sa_proportion').val(),$('#hasil_volume_kanan').val(),$('#hasil_volume_kiri').val(),$('#user_id_inputer').val())">
                        Input Hasil Analisa
                    </button>
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() 
    {
        

        $('#hasil_overlap').focusout(function() {
            var hasil_overlap = this.value;
            if (hasil_overlap.includes('.')) 
            {
                if (hasil_overlap.toString().split(".")[0].length != 1 || hasil_overlap.toString().split(".")[1].length > 2 )
                {
                    swal({
                        title: "Proses Gagal",
                        text : "Overlap diisi dengan format x.yz dan maksimal 2 angka di belakang koma",
                        type : "error",
                    });
                    return false;
                }
                else
                {
                    if ((hasil_overlap <= 4.5 && hasil_overlap >= 3.5) && ($('#hasil_volume_kanan').val() <= 202 && $('#hasil_volume_kanan').val() >= 198) && ($('#hasil_volume_kiri').val() <= 202 && $('#hasil_volume_kiri').val() >= 198) && ($('#hasil_ts_accurate_kanan').val() == 'OK' &&  $('#hasil_ts_accurate_kiri').val() == 'OK' && $('#hasil_ls_accurate').val() == 'OK' && $('#hasil_sa_accurate').val() == 'OK' && $('#hasil_surface_check').val() == 'OK' && $('#hasil_pinching').val() == 'OK' && $('#hasil_strip_folding').val() == 'OK' && $('#hasil_konduktivity_kanan').val() == 'OK' && $('#hasil_konduktivity_kiri').val() == 'OK' && $('#hasil_design_kanan').val() == 'OK' && $('#hasil_design_kiri').val() == 'OK' &&  $('#hasil_dye_test').val() == 'OK' &&  $('#hasil_residu_h2o2').val() == 'OK' && $('#hasil_prod_code_no_md').val() == 'OK') || ($('#hasil_ts_accurate_kanan').val() == '-' &&  $('#hasil_ts_accurate_kiri').val() == '-' && $('#hasil_ls_accurate').val() == '-' && $('#hasil_sa_accurate').val() == '-' && $('#hasil_surface_check').val() == '-' && $('#hasil_pinching').val() == '-' && $('#hasil_strip_folding').val() == '-' && $('#hasil_konduktivity_kanan').val() == '-' && $('#hasil_konduktivity_kiri').val() == '-' && $('#hasil_design_kanan').val() == '-' && $('#hasil_design_kiri').val() == '-' &&  $('#hasil_dye_test').val() == '-' &&  $('#hasil_residu_h2o2').val() == '-' && $('#hasil_prod_code_no_md').val() == '-')) 
                        {
                            $('#hasil_correction').val('-');
                        } 
                        else 
                        {
                            $('#hasil_correction').val('');        
                        }
                }
            } 
            else 
            {
                swal({
                    title: "Proses Gagal",
                    text : "Overlap di isi dengan format maksimal 2 angka dibelakang koma ex. 3.87",
                    type : "error",
                });
                return false;
            }
            
        });
        $('#hasil_volume_kanan').focusout(function() {
            var hasil_volume_kanan = this.value;
            if (($('#hasil_overlap').val() <= 4.5 && $('#hasil_overlap').val() >= 3.5) && ($('#hasil_ls_sa_proportion').val() !== '10:90' && $('#hasil_ls_sa_proportion').val() !== '90:10' && $('#hasil_ls_sa_proportion').val() !== '80:20' && $('#hasil_ls_sa_proportion').val() !== '70:30' ) && (hasil_volume_kanan <= 202 && hasil_volume_kanan >= 198) && ($('#hasil_volume_kiri').val() <= 202 && $('#hasil_volume_kiri').val() >= 198) && ($('#hasil_ts_accurate_kanan').val() == 'OK' &&  $('#hasil_ts_accurate_kiri').val() == 'OK' && $('#hasil_ls_accurate').val() == 'OK' && $('#hasil_sa_accurate').val() == 'OK' && $('#hasil_surface_check').val() == 'OK' && $('#hasil_pinching').val() == 'OK' && $('#hasil_strip_folding').val() == 'OK' && $('#hasil_konduktivity_kanan').val() == 'OK' && $('#hasil_konduktivity_kiri').val() == 'OK' && $('#hasil_design_kanan').val() == 'OK' && $('#hasil_design_kiri').val() == 'OK' &&  $('#hasil_dye_test').val() == 'OK' &&  $('#hasil_residu_h2o2').val() == 'OK' && $('#hasil_prod_code_no_md').val() == 'OK') || ($('#hasil_ts_accurate_kanan').val() == '-' &&  $('#hasil_ts_accurate_kiri').val() == '-' && $('#hasil_ls_accurate').val() == '-' && $('#hasil_sa_accurate').val() == '-' && $('#hasil_surface_check').val() == '-' && $('#hasil_pinching').val() == '-' && $('#hasil_strip_folding').val() == '-' && $('#hasil_konduktivity_kanan').val() == '-' && $('#hasil_konduktivity_kiri').val() == '-' && $('#hasil_design_kanan').val() == '-' && $('#hasil_design_kiri').val() == '-' &&  $('#hasil_dye_test').val() == '-' &&  $('#hasil_residu_h2o2').val() == '-' && $('#hasil_prod_code_no_md').val() == '-')) 
            {
                $('#hasil_correction').val('-');
            } 
            else 
            {
                $('#hasil_correction').val('');        
            }
        });

        $('#hasil_ls_sa_proportion').focusout(function() {
            ls_sa_proportion = this.value;
            if (ls_sa_proportion.includes('(') || ls_sa_proportion.includes('/') || ls_sa_proportion.includes(')') ||ls_sa_proportion.includes('N') || ls_sa_proportion.includes('.') || ls_sa_proportion.includes('-') ||ls_sa_proportion.includes(',') || ls_sa_proportion.includes(' ') || ls_sa_proportion.includes('*') || ls_sa_proportion.includes('#')) 
            {
                swal({
                    title: "Proses Gagal",
                    text : "LS/SA Proportion Di isi dengan Angka dengan format XX:XX",
                    type : "error",
                });
                return false;
            } 
            else 
            {
                if (ls_sa_proportion.includes(';'))
                {  
                    if (ls_sa_proportion.toString().split(";")[1].length != 2 || ls_sa_proportion.toString().split(";")[0].length != 2)
                    {
                        swal({
                            title: "Proses Gagal",
                            text : "LS/SA Proportion Di isi dengan Angka dengan format XX:XX",
                            type : "error",
                        });
                        return false;
                    }
                    else
                    {
                        var replacenya = ls_sa_proportion.replace(';',':');
                        $('#hasil_ls_sa_proportion').val(replacenya);
                        if (($('#hasil_overlap').val() <= 4.5 && $('#hasil_overlap').val() >= 3.5) && ( $('#ls_sa_proportion').val() !== '10:90' &&  $('#ls_sa_proportion').val() !== '90:10' &&  $('#ls_sa_proportion').val() !== '80:20' &&  $('#ls_sa_proportion').val() !== '70:30' ) && ($('#hasil_volume_kanan').val() <= 202 && $('#hasil_volume_kanan').val() >= 198) && ($('#hasil_volume_kiri').val() <= 202 && $('#hasil_volume_kiri').val() >= 198) && ($('#hasil_ts_accurate_kanan').val() == 'OK' &&  $('#hasil_ts_accurate_kiri').val() == 'OK' && $('#hasil_ls_accurate').val() == 'OK' && $('#hasil_sa_accurate').val() == 'OK' && $('#hasil_surface_check').val() == 'OK' && $('#hasil_pinching').val() == 'OK' && $('#hasil_strip_folding').val() == 'OK' && $('#hasil_konduktivity_kanan').val() == 'OK' && $('#hasil_konduktivity_kiri').val() == 'OK' && $('#hasil_design_kanan').val() == 'OK' && $('#hasil_design_kiri').val() == 'OK' &&  $('#hasil_dye_test').val() == 'OK' &&  $('#hasil_residu_h2o2').val() == 'OK' && $('#hasil_prod_code_no_md').val() == 'OK') || ($('#hasil_ts_accurate_kanan').val() == '-' &&  $('#hasil_ts_accurate_kiri').val() == '-' && $('#hasil_ls_accurate').val() == '-' && $('#hasil_sa_accurate').val() == '-' && $('#hasil_surface_check').val() == '-' && $('#hasil_pinching').val() == '-' && $('#hasil_strip_folding').val() == '-' && $('#hasil_konduktivity_kanan').val() == '-' && $('#hasil_konduktivity_kiri').val() == '-' && $('#hasil_design_kanan').val() == '-' && $('#hasil_design_kiri').val() == '-' &&  $('#hasil_dye_test').val() == '-' &&  $('#hasil_residu_h2o2').val() == '-' && $('#hasil_prod_code_no_md').val() == '-')) 
                        {
                            $('#hasil_correction').val('-');
                        } 
                        else 
                        {
                            $('#hasil_correction').val('');        
                        }
                    }
                }
                else
                {
                    swal({
                        title: "Proses Gagal",
                        text : "LS/SA Proportion Di isi dengan Angka dengan format XX:XX",
                        type : "error",
                    });
                    return false;
                }
            }
        });

        $('#hasil_volume_kiri').focusout(function() {
            var hasil_volume_kiri = this.value;
            if (($('#hasil_overlap').val() <= 4.5 && $('#hasil_overlap').val() >= 3.5) && ( $('#ls_sa_proportion').val() !== '10:90' &&  $('#ls_sa_proportion').val() !== '90:10' &&  $('#ls_sa_proportion').val() !== '80:20' &&  $('#ls_sa_proportion').val() !== '70:30' ) && ($('#hasil_volume_kanan').val() <= 202 && $('#hasil_volume_kanan').val() >= 198) && ($('#hasil_volume_kiri').val() <= 202 && $('#hasil_volume_kiri').val() >= 198) && ($('#hasil_ts_accurate_kanan').val() == 'OK' &&  $('#hasil_ts_accurate_kiri').val() == 'OK' && $('#hasil_ls_accurate').val() == 'OK' && $('#hasil_sa_accurate').val() == 'OK' && $('#hasil_surface_check').val() == 'OK' && $('#hasil_pinching').val() == 'OK' && $('#hasil_strip_folding').val() == 'OK' && $('#hasil_konduktivity_kanan').val() == 'OK' && $('#hasil_konduktivity_kiri').val() == 'OK' && $('#hasil_design_kanan').val() == 'OK' && $('#hasil_design_kiri').val() == 'OK' &&  $('#hasil_dye_test').val() == 'OK' &&  $('#hasil_residu_h2o2').val() == 'OK' && $('#hasil_prod_code_no_md').val() == 'OK') || ($('#hasil_ts_accurate_kanan').val() == '-' &&  $('#hasil_ts_accurate_kiri').val() == '-' && $('#hasil_ls_accurate').val() == '-' && $('#hasil_sa_accurate').val() == '-' && $('#hasil_surface_check').val() == '-' && $('#hasil_pinching').val() == '-' && $('#hasil_strip_folding').val() == '-' && $('#hasil_konduktivity_kanan').val() == '-' && $('#hasil_konduktivity_kiri').val() == '-' && $('#hasil_design_kanan').val() == '-' && $('#hasil_design_kiri').val() == '-' &&  $('#hasil_dye_test').val() == '-' &&  $('#hasil_residu_h2o2').val() == '-' && $('#hasil_prod_code_no_md').val() == '-')) 
            {
                $('#hasil_correction').val('-');
            } 
            else 
            {
                $('#hasil_correction').val('');        
            }
        });

        $('#hasil_ts_accurate_kanan').on('change',function(e) 
        {
            var hasil_ts_accurate_kanan = e.target.value;
            switch(hasil_ts_accurate_kanan)
            {
                case 'OK':
                    if (($('#hasil_overlap').val() <= 4.5 && $('#hasil_overlap').val() >= 3.5) && ( $('#ls_sa_proportion').val() !== '10:90' &&  $('#ls_sa_proportion').val() !== '90:10' &&  $('#ls_sa_proportion').val() !== '80:20' &&  $('#ls_sa_proportion').val() !== '70:30' ) && ($('#hasil_volume_kanan').val() <= 202 && $('#hasil_volume_kanan').val() >= 198) && ($('#hasil_volume_kiri').val() <= 202 && $('#hasil_volume_kiri').val() >= 198) && ($('#hasil_ts_accurate_kanan').val() == 'OK' &&  $('#hasil_ts_accurate_kiri').val() == 'OK' && $('#hasil_ls_accurate').val() == 'OK' && $('#hasil_sa_accurate').val() == 'OK' && $('#hasil_surface_check').val() == 'OK' && $('#hasil_pinching').val() == 'OK' && $('#hasil_strip_folding').val() == 'OK' && $('#hasil_konduktivity_kanan').val() == 'OK' && $('#hasil_konduktivity_kiri').val() == 'OK' && $('#hasil_design_kanan').val() == 'OK' && $('#hasil_design_kiri').val() == 'OK' &&  $('#hasil_dye_test').val() == 'OK' &&  $('#hasil_residu_h2o2').val() == 'OK' && $('#hasil_prod_code_no_md').val() == 'OK') || ($('#hasil_ts_accurate_kanan').val() == '-' &&  $('#hasil_ts_accurate_kiri').val() == '-' && $('#hasil_ls_accurate').val() == '-' && $('#hasil_sa_accurate').val() == '-' && $('#hasil_surface_check').val() == '-' && $('#hasil_pinching').val() == '-' && $('#hasil_strip_folding').val() == '-' && $('#hasil_konduktivity_kanan').val() == '-' && $('#hasil_konduktivity_kiri').val() == '-' && $('#hasil_design_kanan').val() == '-' && $('#hasil_design_kiri').val() == '-' &&  $('#hasil_dye_test').val() == '-' &&  $('#hasil_residu_h2o2').val() == '-' && $('#hasil_prod_code_no_md').val() == '-'))
                    {
                        $('#hasil_correction').val('-');
                    }   
                    $('#hasil_ts_accurate_kanan').addClass('col-lg-8');
                    $('#hasil_ts_accurate_kanan').removeClass('col-lg-4');
                    $('#ts_accurate_kanan_tidak_ok').addClass('sembunyi');
                break;

                case '#OK':
                    $('#hasil_ts_accurate_kanan').removeClass('col-lg-8');
                    $('#hasil_ts_accurate_kanan').addClass('col-lg-4');
                    $('#ts_accurate_kanan_tidak_ok').removeClass('sembunyi');
                    if ($('#hasil_ts_accurate_kanan').val() == '#OK' || $('#hasil_ts_accurate_kiri').val() == '#OK' ||$('#hasil_ls_accurate').val() == '#OK' ||$('#hasil_sa_accurate').val() == '#OK' ||$('#hasil_surface_check').val() == '#OK' ||$('#hasil_pinching').val() == '#OK' ||$('#hasil_strip_folding').val() == '#OK' ||$('#hasil_konduktivity_kanan').val() == '#OK' ||$('#hasil_konduktivity_kiri').val() == '#OK' ||$('#hasil_design_kanan').val() == '#OK' ||$('#hasil_design_kiri').val() == '#OK' || $('#hasil_dye_test').val() == '#OK' || $('#hasil_residu_h2o2').val() == '#OK' || $('#hasil_prod_code_no_md').val() == '#OK' || $('#ls_sa_proportion').val() == '10:90' ||  $('#ls_sa_proportion').val() == '90:10' ||  $('#ls_sa_proportion').val() == '80:20' ||  $('#ls_sa_proportion').val() == '70:30' )
                    {
                        $('#hasil_correction').val('');
                    }
                break;

                case '-':
                    $('#hasil_ts_accurate_kanan').addClass('col-lg-8');
                    $('#hasil_ts_accurate_kanan').removeClass('col-lg-4');
                    $('#ts_accurate_kanan_tidak_ok').addClass('sembunyi');
                break;
            }

        });
        $('#hasil_ts_accurate_kiri').on('change',function(e) 
        {
            var hasil_ts_accurate_kiri = e.target.value;
            switch(hasil_ts_accurate_kiri)
            {
                case 'OK':
                if (($('#hasil_overlap').val() <= 4.5 && $('#hasil_overlap').val() >= 3.5) && ( $('#ls_sa_proportion') !== '10:90' &&  $('#ls_sa_proportion') !== '90:10' &&  $('#ls_sa_proportion') !== '80:20' &&  $('#ls_sa_proportion') !== '70:30' ) && ($('#hasil_volume_kanan').val() <= 202 && $('#hasil_volume_kanan').val() >= 198) && ($('#hasil_volume_kiri').val() <= 202 && $('#hasil_volume_kiri').val() >= 198) && ($('#hasil_ts_accurate_kanan').val() == 'OK' &&  $('#hasil_ts_accurate_kiri').val() == 'OK' && $('#hasil_ls_accurate').val() == 'OK' && $('#hasil_sa_accurate').val() == 'OK' && $('#hasil_surface_check').val() == 'OK' && $('#hasil_pinching').val() == 'OK' && $('#hasil_strip_folding').val() == 'OK' && $('#hasil_konduktivity_kanan').val() == 'OK' && $('#hasil_konduktivity_kiri').val() == 'OK' && $('#hasil_design_kanan').val() == 'OK' && $('#hasil_design_kiri').val() == 'OK' &&  $('#hasil_dye_test').val() == 'OK' &&  $('#hasil_residu_h2o2').val() == 'OK' && $('#hasil_prod_code_no_md').val() == 'OK') || ($('#hasil_ts_accurate_kanan').val() == '-' &&  $('#hasil_ts_accurate_kiri').val() == '-' && $('#hasil_ls_accurate').val() == '-' && $('#hasil_sa_accurate').val() == '-' && $('#hasil_surface_check').val() == '-' && $('#hasil_pinching').val() == '-' && $('#hasil_strip_folding').val() == '-' && $('#hasil_konduktivity_kanan').val() == '-' && $('#hasil_konduktivity_kiri').val() == '-' && $('#hasil_design_kanan').val() == '-' && $('#hasil_design_kiri').val() == '-' &&  $('#hasil_dye_test').val() == '-' &&  $('#hasil_residu_h2o2').val() == '-' && $('#hasil_prod_code_no_md').val() == '-'))
                {
                    $('#hasil_correction').val('-');
                }   
                    $('#hasil_ts_accurate_kiri').addClass('col-lg-8');
                    $('#hasil_ts_accurate_kiri').removeClass('col-lg-4');
                    $('#ts_accurate_kiri_tidak_ok').addClass('sembunyi');
                break;

                case '#OK':
                    $('#hasil_ts_accurate_kiri').removeClass('col-lg-8');
                    $('#hasil_ts_accurate_kiri').addClass('col-lg-4');
                    $('#ts_accurate_kiri_tidak_ok').removeClass('sembunyi');
                    if ($('#hasil_ts_accurate_kanan').val() == '#OK' || $('#hasil_ts_accurate_kiri').val() == '#OK' ||$('#hasil_ls_accurate').val() == '#OK' ||$('#hasil_sa_accurate').val() == '#OK' ||$('#hasil_surface_check').val() == '#OK' ||$('#hasil_pinching').val() == '#OK' ||$('#hasil_strip_folding').val() == '#OK' ||$('#hasil_konduktivity_kanan').val() == '#OK' ||$('#hasil_konduktivity_kiri').val() == '#OK' ||$('#hasil_design_kanan').val() == '#OK' ||$('#hasil_design_kiri').val() == '#OK' || $('#hasil_dye_test').val() == '#OK' || $('#hasil_residu_h2o2').val() == '#OK' || $('#hasil_prod_code_no_md').val() == '#OK' || $('#ls_sa_proportion').val() == '10:90' ||  $('#ls_sa_proportion').val() == '90:10' ||  $('#ls_sa_proportion').val() == '80:20' ||  $('#ls_sa_proportion').val() == '70:30')
                    {
                        $('#hasil_correction').val('');
                    }
                break;

                case '-':
                    if (($('#hasil_overlap').val() <= 4.5 && $('#hasil_overlap').val() >= 3.5) && ( $('#ls_sa_proportion') !== '10:90' &&  $('#ls_sa_proportion') !== '90:10' &&  $('#ls_sa_proportion') !== '80:20' &&  $('#ls_sa_proportion') !== '70:30' ) && ($('#hasil_volume_kanan').val() <= 202 && $('#hasil_volume_kanan').val() >= 198) && ($('#hasil_volume_kiri').val() <= 202 && $('#hasil_volume_kiri').val() >= 198) && ($('#hasil_ts_accurate_kanan').val() == 'OK' &&  $('#hasil_ts_accurate_kiri').val() == 'OK' && $('#hasil_ls_accurate').val() == 'OK' && $('#hasil_sa_accurate').val() == 'OK' && $('#hasil_surface_check').val() == 'OK' && $('#hasil_pinching').val() == 'OK' && $('#hasil_strip_folding').val() == 'OK' && $('#hasil_konduktivity_kanan').val() == 'OK' && $('#hasil_konduktivity_kiri').val() == 'OK' && $('#hasil_design_kanan').val() == 'OK' && $('#hasil_design_kiri').val() == 'OK' &&  $('#hasil_dye_test').val() == 'OK' &&  $('#hasil_residu_h2o2').val() == 'OK' && $('#hasil_prod_code_no_md').val() == 'OK') || ($('#hasil_ts_accurate_kanan').val() == '-' &&  $('#hasil_ts_accurate_kiri').val() == '-' && $('#hasil_ls_accurate').val() == '-' && $('#hasil_sa_accurate').val() == '-' && $('#hasil_surface_check').val() == '-' && $('#hasil_pinching').val() == '-' && $('#hasil_strip_folding').val() == '-' && $('#hasil_konduktivity_kanan').val() == '-' && $('#hasil_konduktivity_kiri').val() == '-' && $('#hasil_design_kanan').val() == '-' && $('#hasil_design_kiri').val() == '-' &&  $('#hasil_dye_test').val() == '-' &&  $('#hasil_residu_h2o2').val() == '-' && $('#hasil_prod_code_no_md').val() == '-'))
                    {
                        $('#hasil_correction').val('-');
                    }   
                    $('#hasil_ts_accurate_kiri').addClass('col-lg-8');
                    $('#hasil_ts_accurate_kiri').removeClass('col-lg-4');
                    $('#ts_accurate_kiri_tidak_ok').addClass('sembunyi');
                break;
            }

        });
        $('#hasil_ls_accurate').on('change',function(e) 
        {
            var hasil_ls_accurate = e.target.value;
            switch(hasil_ls_accurate)
            {
                case 'OK':
                    if (($('#hasil_overlap').val() <= 4.5 && $('#hasil_overlap').val() >= 3.5) && ( $('#ls_sa_proportion') !== '10:90' &&  $('#ls_sa_proportion') !== '90:10' &&  $('#ls_sa_proportion') !== '80:20' &&  $('#ls_sa_proportion') !== '70:30' ) && ($('#hasil_volume_kanan').val() <= 202 && $('#hasil_volume_kanan').val() >= 198) && ($('#hasil_volume_kiri').val() <= 202 && $('#hasil_volume_kiri').val() >= 198) && ($('#hasil_ts_accurate_kanan').val() == 'OK' &&  $('#hasil_ts_accurate_kiri').val() == 'OK' && $('#hasil_ls_accurate').val() == 'OK' && $('#hasil_sa_accurate').val() == 'OK' && $('#hasil_surface_check').val() == 'OK' && $('#hasil_pinching').val() == 'OK' && $('#hasil_strip_folding').val() == 'OK' && $('#hasil_konduktivity_kanan').val() == 'OK' && $('#hasil_konduktivity_kiri').val() == 'OK' && $('#hasil_design_kanan').val() == 'OK' && $('#hasil_design_kiri').val() == 'OK' &&  $('#hasil_dye_test').val() == 'OK' &&  $('#hasil_residu_h2o2').val() == 'OK' && $('#hasil_prod_code_no_md').val() == 'OK') || ($('#hasil_ts_accurate_kanan').val() == '-' &&  $('#hasil_ts_accurate_kiri').val() == '-' && $('#hasil_ls_accurate').val() == '-' && $('#hasil_sa_accurate').val() == '-' && $('#hasil_surface_check').val() == '-' && $('#hasil_pinching').val() == '-' && $('#hasil_strip_folding').val() == '-' && $('#hasil_konduktivity_kanan').val() == '-' && $('#hasil_konduktivity_kiri').val() == '-' && $('#hasil_design_kanan').val() == '-' && $('#hasil_design_kiri').val() == '-' &&  $('#hasil_dye_test').val() == '-' &&  $('#hasil_residu_h2o2').val() == '-' && $('#hasil_prod_code_no_md').val() == '-'))
                    {
                        $('#hasil_correction').val('-');
                    }   
                    $('#hasil_ls_accurate').addClass('col-lg-8');
                    $('#hasil_ls_accurate').removeClass('col-lg-4');
                    $('#ls_accurate_tidak_ok').addClass('sembunyi');
                break;

                case '#OK':
                    $('#hasil_ls_accurate').removeClass('col-lg-8');
                    $('#hasil_ls_accurate').addClass('col-lg-4');
                    $('#ls_accurate_tidak_ok').removeClass('sembunyi');
                    if ($('#hasil_ts_accurate_kanan').val() == '#OK' || $('#hasil_ts_accurate_kiri').val() == '#OK' ||$('#hasil_ls_accurate').val() == '#OK' ||$('#hasil_sa_accurate').val() == '#OK' ||$('#hasil_surface_check').val() == '#OK' ||$('#hasil_pinching').val() == '#OK' ||$('#hasil_strip_folding').val() == '#OK' ||$('#hasil_konduktivity_kanan').val() == '#OK' ||$('#hasil_konduktivity_kiri').val() == '#OK' ||$('#hasil_design_kanan').val() == '#OK' ||$('#hasil_design_kiri').val() == '#OK' || $('#hasil_dye_test').val() == '#OK' || $('#hasil_residu_h2o2').val() == '#OK' || $('#hasil_prod_code_no_md').val() == '#OK' || $('#ls_sa_proportion').val() == '10:90' ||  $('#ls_sa_proportion').val() == '90:10' ||  $('#ls_sa_proportion').val() == '80:20' ||  $('#ls_sa_proportion').val() == '70:30')
                    {
                        $('#hasil_correction').val('');
                    }
                break;

                case '-':
                    if (($('#hasil_overlap').val() <= 4.5 && $('#hasil_overlap').val() >= 3.5) && ( $('#ls_sa_proportion') !== '10:90' &&  $('#ls_sa_proportion') !== '90:10' &&  $('#ls_sa_proportion') !== '80:20' &&  $('#ls_sa_proportion') !== '70:30' ) && ($('#hasil_volume_kanan').val() <= 202 && $('#hasil_volume_kanan').val() >= 198) && ($('#hasil_volume_kiri').val() <= 202 && $('#hasil_volume_kiri').val() >= 198) && ($('#hasil_ts_accurate_kanan').val() == 'OK' &&  $('#hasil_ts_accurate_kiri').val() == 'OK' && $('#hasil_ls_accurate').val() == 'OK' && $('#hasil_sa_accurate').val() == 'OK' && $('#hasil_surface_check').val() == 'OK' && $('#hasil_pinching').val() == 'OK' && $('#hasil_strip_folding').val() == 'OK' && $('#hasil_konduktivity_kanan').val() == 'OK' && $('#hasil_konduktivity_kiri').val() == 'OK' && $('#hasil_design_kanan').val() == 'OK' && $('#hasil_design_kiri').val() == 'OK' &&  $('#hasil_dye_test').val() == 'OK' &&  $('#hasil_residu_h2o2').val() == 'OK' && $('#hasil_prod_code_no_md').val() == 'OK') || ($('#hasil_ts_accurate_kanan').val() == '-' &&  $('#hasil_ts_accurate_kiri').val() == '-' && $('#hasil_ls_accurate').val() == '-' && $('#hasil_sa_accurate').val() == '-' && $('#hasil_surface_check').val() == '-' && $('#hasil_pinching').val() == '-' && $('#hasil_strip_folding').val() == '-' && $('#hasil_konduktivity_kanan').val() == '-' && $('#hasil_konduktivity_kiri').val() == '-' && $('#hasil_design_kanan').val() == '-' && $('#hasil_design_kiri').val() == '-' &&  $('#hasil_dye_test').val() == '-' &&  $('#hasil_residu_h2o2').val() == '-' && $('#hasil_prod_code_no_md').val() == '-'))
                    {
                        $('#hasil_correction').val('-');
                    }   
                    $('#hasil_ls_accurate').addClass('col-lg-8');
                    $('#hasil_ls_accurate').removeClass('col-lg-4');
                    $('#ls_accurate_tidak_ok').addClass('sembunyi');
                break;
            }

        });
        $('#hasil_sa_accurate').on('change',function(e) 
        {
            var hasil_sa_accurate = e.target.value;
            switch(hasil_sa_accurate)
            {
                case 'OK':
                    if (($('#hasil_overlap').val() <= 4.5 && $('#hasil_overlap').val() >= 3.5) && ( $('#ls_sa_proportion') !== '10:90' &&  $('#ls_sa_proportion') !== '90:10' &&  $('#ls_sa_proportion') !== '80:20' &&  $('#ls_sa_proportion') !== '70:30' ) && ($('#hasil_volume_kanan').val() <= 202 && $('#hasil_volume_kanan').val() >= 198) && ($('#hasil_volume_kiri').val() <= 202 && $('#hasil_volume_kiri').val() >= 198) && ($('#hasil_ts_accurate_kanan').val() == 'OK' &&  $('#hasil_ts_accurate_kiri').val() == 'OK' && $('#hasil_ls_accurate').val() == 'OK' && $('#hasil_sa_accurate').val() == 'OK' && $('#hasil_surface_check').val() == 'OK' && $('#hasil_pinching').val() == 'OK' && $('#hasil_strip_folding').val() == 'OK' && $('#hasil_konduktivity_kanan').val() == 'OK' && $('#hasil_konduktivity_kiri').val() == 'OK' && $('#hasil_design_kanan').val() == 'OK' && $('#hasil_design_kiri').val() == 'OK' &&  $('#hasil_dye_test').val() == 'OK' &&  $('#hasil_residu_h2o2').val() == 'OK' && $('#hasil_prod_code_no_md').val() == 'OK') || ($('#hasil_ts_accurate_kanan').val() == '-' &&  $('#hasil_ts_accurate_kiri').val() == '-' && $('#hasil_ls_accurate').val() == '-' && $('#hasil_sa_accurate').val() == '-' && $('#hasil_surface_check').val() == '-' && $('#hasil_pinching').val() == '-' && $('#hasil_strip_folding').val() == '-' && $('#hasil_konduktivity_kanan').val() == '-' && $('#hasil_konduktivity_kiri').val() == '-' && $('#hasil_design_kanan').val() == '-' && $('#hasil_design_kiri').val() == '-' &&  $('#hasil_dye_test').val() == '-' &&  $('#hasil_residu_h2o2').val() == '-' && $('#hasil_prod_code_no_md').val() == '-'))
                    {
                        $('#hasil_correction').val('-');
                    }   
                    $('#hasil_sa_accurate').addClass('col-lg-8');
                    $('#hasil_sa_accurate').removeClass('col-lg-4');
                    $('#sa_accurate_tidak_ok').addClass('sembunyi');
                break;

                case '#OK':
                    $('#hasil_sa_accurate').removeClass('col-lg-8');
                    $('#hasil_sa_accurate').addClass('col-lg-4');
                    $('#sa_accurate_tidak_ok').removeClass('sembunyi');
                    if ($('#hasil_ts_accurate_kanan').val() == '#OK' || $('#hasil_ts_accurate_kiri').val() == '#OK' ||$('#hasil_ls_accurate').val() == '#OK' ||$('#hasil_sa_accurate').val() == '#OK' ||$('#hasil_surface_check').val() == '#OK' ||$('#hasil_pinching').val() == '#OK' ||$('#hasil_strip_folding').val() == '#OK' ||$('#hasil_konduktivity_kanan').val() == '#OK' ||$('#hasil_konduktivity_kiri').val() == '#OK' ||$('#hasil_design_kanan').val() == '#OK' ||$('#hasil_design_kiri').val() == '#OK' || $('#hasil_dye_test').val() == '#OK' || $('#hasil_residu_h2o2').val() == '#OK' || $('#hasil_prod_code_no_md').val() == '#OK' || $('#ls_sa_proportion').val() == '10:90' ||  $('#ls_sa_proportion').val() == '90:10' ||  $('#ls_sa_proportion').val() == '80:20' ||  $('#ls_sa_proportion').val() == '70:30')
                    {
                        $('#hasil_correction').val('');
                    }
                break;

                case '-':
                    if (($('#hasil_overlap').val() <= 4.5 && $('#hasil_overlap').val() >= 3.5) && ( $('#ls_sa_proportion') !== '10:90' &&  $('#ls_sa_proportion') !== '90:10' &&  $('#ls_sa_proportion') !== '80:20' &&  $('#ls_sa_proportion') !== '70:30' ) && ($('#hasil_volume_kanan').val() <= 202 && $('#hasil_volume_kanan').val() >= 198) && ($('#hasil_volume_kiri').val() <= 202 && $('#hasil_volume_kiri').val() >= 198) && ($('#hasil_ts_accurate_kanan').val() == 'OK' &&  $('#hasil_ts_accurate_kiri').val() == 'OK' && $('#hasil_ls_accurate').val() == 'OK' && $('#hasil_sa_accurate').val() == 'OK' && $('#hasil_surface_check').val() == 'OK' && $('#hasil_pinching').val() == 'OK' && $('#hasil_strip_folding').val() == 'OK' && $('#hasil_konduktivity_kanan').val() == 'OK' && $('#hasil_konduktivity_kiri').val() == 'OK' && $('#hasil_design_kanan').val() == 'OK' && $('#hasil_design_kiri').val() == 'OK' &&  $('#hasil_dye_test').val() == 'OK' &&  $('#hasil_residu_h2o2').val() == 'OK' && $('#hasil_prod_code_no_md').val() == 'OK') || ($('#hasil_ts_accurate_kanan').val() == '-' &&  $('#hasil_ts_accurate_kiri').val() == '-' && $('#hasil_ls_accurate').val() == '-' && $('#hasil_sa_accurate').val() == '-' && $('#hasil_surface_check').val() == '-' && $('#hasil_pinching').val() == '-' && $('#hasil_strip_folding').val() == '-' && $('#hasil_konduktivity_kanan').val() == '-' && $('#hasil_konduktivity_kiri').val() == '-' && $('#hasil_design_kanan').val() == '-' && $('#hasil_design_kiri').val() == '-' &&  $('#hasil_dye_test').val() == '-' &&  $('#hasil_residu_h2o2').val() == '-' && $('#hasil_prod_code_no_md').val() == '-'))
                    {
                        $('#hasil_correction').val('-');
                    }   
                    $('#hasil_sa_accurate').addClass('col-lg-8');
                    $('#hasil_sa_accurate').removeClass('col-lg-4');
                    $('#sa_accurate_tidak_ok').addClass('sembunyi');
                break;
            }

        });
        $('#hasil_surface_check').on('change',function(e) 
        {
            var hasil_surface_check = e.target.value;
            switch(hasil_surface_check)
            {
                case 'OK':
                    if (($('#hasil_overlap').val() <= 4.5 && $('#hasil_overlap').val() >= 3.5) && ( $('#ls_sa_proportion') !== '10:90' &&  $('#ls_sa_proportion') !== '90:10' &&  $('#ls_sa_proportion') !== '80:20' &&  $('#ls_sa_proportion') !== '70:30' ) && ($('#hasil_volume_kanan').val() <= 202 && $('#hasil_volume_kanan').val() >= 198) && ($('#hasil_volume_kiri').val() <= 202 && $('#hasil_volume_kiri').val() >= 198) && ($('#hasil_ts_accurate_kanan').val() == 'OK' &&  $('#hasil_ts_accurate_kiri').val() == 'OK' && $('#hasil_ls_accurate').val() == 'OK' && $('#hasil_sa_accurate').val() == 'OK' && $('#hasil_surface_check').val() == 'OK' && $('#hasil_pinching').val() == 'OK' && $('#hasil_strip_folding').val() == 'OK' && $('#hasil_konduktivity_kanan').val() == 'OK' && $('#hasil_konduktivity_kiri').val() == 'OK' && $('#hasil_design_kanan').val() == 'OK' && $('#hasil_design_kiri').val() == 'OK' &&  $('#hasil_dye_test').val() == 'OK' &&  $('#hasil_residu_h2o2').val() == 'OK' && $('#hasil_prod_code_no_md').val() == 'OK') || ($('#hasil_ts_accurate_kanan').val() == '-' &&  $('#hasil_ts_accurate_kiri').val() == '-' && $('#hasil_ls_accurate').val() == '-' && $('#hasil_sa_accurate').val() == '-' && $('#hasil_surface_check').val() == '-' && $('#hasil_pinching').val() == '-' && $('#hasil_strip_folding').val() == '-' && $('#hasil_konduktivity_kanan').val() == '-' && $('#hasil_konduktivity_kiri').val() == '-' && $('#hasil_design_kanan').val() == '-' && $('#hasil_design_kiri').val() == '-' &&  $('#hasil_dye_test').val() == '-' &&  $('#hasil_residu_h2o2').val() == '-' && $('#hasil_prod_code_no_md').val() == '-'))
                    {
                        $('#hasil_correction').val('-');
                    }   
                    $('#hasil_surface_check').addClass('col-lg-8');
                    $('#hasil_surface_check').removeClass('col-lg-4');
                    $('#surface_check_tidak_ok').addClass('sembunyi');
                break;

                case '#OK':
                    $('#hasil_surface_check').removeClass('col-lg-8');
                    $('#hasil_surface_check').addClass('col-lg-4');
                    $('#surface_check_tidak_ok').removeClass('sembunyi');
                    if ($('#hasil_ts_accurate_kanan').val() == '#OK' || $('#hasil_ts_accurate_kiri').val() == '#OK' ||$('#hasil_ls_accurate').val() == '#OK' ||$('#hasil_sa_accurate').val() == '#OK' ||$('#hasil_surface_check').val() == '#OK' ||$('#hasil_pinching').val() == '#OK' ||$('#hasil_strip_folding').val() == '#OK' ||$('#hasil_konduktivity_kanan').val() == '#OK' ||$('#hasil_konduktivity_kiri').val() == '#OK' ||$('#hasil_design_kanan').val() == '#OK' ||$('#hasil_design_kiri').val() == '#OK' || $('#hasil_dye_test').val() == '#OK' || $('#hasil_residu_h2o2').val() == '#OK' || $('#hasil_prod_code_no_md').val() == '#OK' || $('#ls_sa_proportion').val() == '10:90' ||  $('#ls_sa_proportion').val() == '90:10' ||  $('#ls_sa_proportion').val() == '80:20' ||  $('#ls_sa_proportion').val() == '70:30')
                    {
                        $('#hasil_correction').val('');
                    }
                break;

                case '-':
                    if (($('#hasil_overlap').val() <= 4.5 && $('#hasil_overlap').val() >= 3.5) && ( $('#ls_sa_proportion') !== '10:90' &&  $('#ls_sa_proportion') !== '90:10' &&  $('#ls_sa_proportion') !== '80:20' &&  $('#ls_sa_proportion') !== '70:30' ) && ($('#hasil_volume_kanan').val() <= 202 && $('#hasil_volume_kanan').val() >= 198) && ($('#hasil_volume_kiri').val() <= 202 && $('#hasil_volume_kiri').val() >= 198) && ($('#hasil_ts_accurate_kanan').val() == 'OK' &&  $('#hasil_ts_accurate_kiri').val() == 'OK' && $('#hasil_ls_accurate').val() == 'OK' && $('#hasil_sa_accurate').val() == 'OK' && $('#hasil_surface_check').val() == 'OK' && $('#hasil_pinching').val() == 'OK' && $('#hasil_strip_folding').val() == 'OK' && $('#hasil_konduktivity_kanan').val() == 'OK' && $('#hasil_konduktivity_kiri').val() == 'OK' && $('#hasil_design_kanan').val() == 'OK' && $('#hasil_design_kiri').val() == 'OK' &&  $('#hasil_dye_test').val() == 'OK' &&  $('#hasil_residu_h2o2').val() == 'OK' && $('#hasil_prod_code_no_md').val() == 'OK') || ($('#hasil_ts_accurate_kanan').val() == '-' &&  $('#hasil_ts_accurate_kiri').val() == '-' && $('#hasil_ls_accurate').val() == '-' && $('#hasil_sa_accurate').val() == '-' && $('#hasil_surface_check').val() == '-' && $('#hasil_pinching').val() == '-' && $('#hasil_strip_folding').val() == '-' && $('#hasil_konduktivity_kanan').val() == '-' && $('#hasil_konduktivity_kiri').val() == '-' && $('#hasil_design_kanan').val() == '-' && $('#hasil_design_kiri').val() == '-' &&  $('#hasil_dye_test').val() == '-' &&  $('#hasil_residu_h2o2').val() == '-' && $('#hasil_prod_code_no_md').val() == '-'))
                    {
                        $('#hasil_correction').val('-');
                    }   
                    $('#hasil_surface_check').addClass('col-lg-8');
                    $('#hasil_surface_check').removeClass('col-lg-4');
                    $('#surface_check_tidak_ok').addClass('sembunyi');
                break;
            }
        });
        $('#hasil_strip_folding').on('change',function(e) 
        {
            var hasil_strip_folding = e.target.value;
            switch(hasil_strip_folding)
            {
                case 'OK':
                    if (($('#hasil_overlap').val() <= 4.5 && $('#hasil_overlap').val() >= 3.5) && ( $('#ls_sa_proportion') !== '10:90' &&  $('#ls_sa_proportion') !== '90:10' &&  $('#ls_sa_proportion') !== '80:20' &&  $('#ls_sa_proportion') !== '70:30' ) && ($('#hasil_volume_kanan').val() <= 202 && $('#hasil_volume_kanan').val() >= 198) && ($('#hasil_volume_kiri').val() <= 202 && $('#hasil_volume_kiri').val() >= 198) && ($('#hasil_ts_accurate_kanan').val() == 'OK' &&  $('#hasil_ts_accurate_kiri').val() == 'OK' && $('#hasil_ls_accurate').val() == 'OK' && $('#hasil_sa_accurate').val() == 'OK' && $('#hasil_surface_check').val() == 'OK' && $('#hasil_pinching').val() == 'OK' && $('#hasil_strip_folding').val() == 'OK' && $('#hasil_konduktivity_kanan').val() == 'OK' && $('#hasil_konduktivity_kiri').val() == 'OK' && $('#hasil_design_kanan').val() == 'OK' && $('#hasil_design_kiri').val() == 'OK' &&  $('#hasil_dye_test').val() == 'OK' &&  $('#hasil_residu_h2o2').val() == 'OK' && $('#hasil_prod_code_no_md').val() == 'OK') || ($('#hasil_ts_accurate_kanan').val() == '-' &&  $('#hasil_ts_accurate_kiri').val() == '-' && $('#hasil_ls_accurate').val() == '-' && $('#hasil_sa_accurate').val() == '-' && $('#hasil_surface_check').val() == '-' && $('#hasil_pinching').val() == '-' && $('#hasil_strip_folding').val() == '-' && $('#hasil_konduktivity_kanan').val() == '-' && $('#hasil_konduktivity_kiri').val() == '-' && $('#hasil_design_kanan').val() == '-' && $('#hasil_design_kiri').val() == '-' &&  $('#hasil_dye_test').val() == '-' &&  $('#hasil_residu_h2o2').val() == '-' && $('#hasil_prod_code_no_md').val() == '-'))
                    {
                        $('#hasil_correction').val('-');
                    }   
                break;
                case '#OK':
                    if ($('#hasil_ts_accurate_kanan').val() == '#OK' || $('#hasil_ts_accurate_kiri').val() == '#OK' ||$('#hasil_ls_accurate').val() == '#OK' ||$('#hasil_sa_accurate').val() == '#OK' ||$('#hasil_surface_check').val() == '#OK' ||$('#hasil_pinching').val() == '#OK' ||$('#hasil_strip_folding').val() == '#OK' ||$('#hasil_konduktivity_kanan').val() == '#OK' ||$('#hasil_konduktivity_kiri').val() == '#OK' ||$('#hasil_design_kanan').val() == '#OK' ||$('#hasil_design_kiri').val() == '#OK' || $('#hasil_dye_test').val() == '#OK' || $('#hasil_residu_h2o2').val() == '#OK' || $('#hasil_prod_code_no_md').val() == '#OK' || $('#ls_sa_proportion').val() == '10:90' ||  $('#ls_sa_proportion').val() == '90:10' ||  $('#ls_sa_proportion').val() == '80:20' ||  $('#ls_sa_proportion').val() == '70:30')
                    {
                        $('#hasil_correction').val('');
                    }
                break;
                case '-':
                    if (($('#hasil_overlap').val() <= 4.5 && $('#hasil_overlap').val() >= 3.5) && ( $('#ls_sa_proportion') !== '10:90' &&  $('#ls_sa_proportion') !== '90:10' &&  $('#ls_sa_proportion') !== '80:20' &&  $('#ls_sa_proportion') !== '70:30' ) && ($('#hasil_volume_kanan').val() <= 202 && $('#hasil_volume_kanan').val() >= 198) && ($('#hasil_volume_kiri').val() <= 202 && $('#hasil_volume_kiri').val() >= 198) && ($('#hasil_ts_accurate_kanan').val() == 'OK' &&  $('#hasil_ts_accurate_kiri').val() == 'OK' && $('#hasil_ls_accurate').val() == 'OK' && $('#hasil_sa_accurate').val() == 'OK' && $('#hasil_surface_check').val() == 'OK' && $('#hasil_pinching').val() == 'OK' && $('#hasil_strip_folding').val() == 'OK' && $('#hasil_konduktivity_kanan').val() == 'OK' && $('#hasil_konduktivity_kiri').val() == 'OK' && $('#hasil_design_kanan').val() == 'OK' && $('#hasil_design_kiri').val() == 'OK' &&  $('#hasil_dye_test').val() == 'OK' &&  $('#hasil_residu_h2o2').val() == 'OK' && $('#hasil_prod_code_no_md').val() == 'OK') || ($('#hasil_ts_accurate_kanan').val() == '-' &&  $('#hasil_ts_accurate_kiri').val() == '-' && $('#hasil_ls_accurate').val() == '-' && $('#hasil_sa_accurate').val() == '-' && $('#hasil_surface_check').val() == '-' && $('#hasil_pinching').val() == '-' && $('#hasil_strip_folding').val() == '-' && $('#hasil_konduktivity_kanan').val() == '-' && $('#hasil_konduktivity_kiri').val() == '-' && $('#hasil_design_kanan').val() == '-' && $('#hasil_design_kiri').val() == '-' &&  $('#hasil_dye_test').val() == '-' &&  $('#hasil_residu_h2o2').val() == '-' && $('#hasil_prod_code_no_md').val() == '-'))
                    {
                        $('#hasil_correction').val('-');
                    } 
                break;
            }        
        });
        $('#hasil_konduktivity_kanan').on('change',function(e) 
        {
            var hasil_konduktivity_kanan = e.target.value;
            switch(hasil_konduktivity_kanan)
            {
                case 'OK':
                    if (($('#hasil_overlap').val() <= 4.5 && $('#hasil_overlap').val() >= 3.5) && ( $('#ls_sa_proportion') !== '10:90' &&  $('#ls_sa_proportion') !== '90:10' &&  $('#ls_sa_proportion') !== '80:20' &&  $('#ls_sa_proportion') !== '70:30' ) && ($('#hasil_volume_kanan').val() <= 202 && $('#hasil_volume_kanan').val() >= 198) && ($('#hasil_volume_kiri').val() <= 202 && $('#hasil_volume_kiri').val() >= 198) && ($('#hasil_ts_accurate_kanan').val() == 'OK' &&  $('#hasil_ts_accurate_kiri').val() == 'OK' && $('#hasil_ls_accurate').val() == 'OK' && $('#hasil_sa_accurate').val() == 'OK' && $('#hasil_surface_check').val() == 'OK' && $('#hasil_pinching').val() == 'OK' && $('#hasil_strip_folding').val() == 'OK' && $('#hasil_konduktivity_kanan').val() == 'OK' && $('#hasil_konduktivity_kiri').val() == 'OK' && $('#hasil_design_kanan').val() == 'OK' && $('#hasil_design_kiri').val() == 'OK' &&  $('#hasil_dye_test').val() == 'OK' &&  $('#hasil_residu_h2o2').val() == 'OK' && $('#hasil_prod_code_no_md').val() == 'OK') || ($('#hasil_ts_accurate_kanan').val() == '-' &&  $('#hasil_ts_accurate_kiri').val() == '-' && $('#hasil_ls_accurate').val() == '-' && $('#hasil_sa_accurate').val() == '-' && $('#hasil_surface_check').val() == '-' && $('#hasil_pinching').val() == '-' && $('#hasil_strip_folding').val() == '-' && $('#hasil_konduktivity_kanan').val() == '-' && $('#hasil_konduktivity_kiri').val() == '-' && $('#hasil_design_kanan').val() == '-' && $('#hasil_design_kiri').val() == '-' &&  $('#hasil_dye_test').val() == '-' &&  $('#hasil_residu_h2o2').val() == '-' && $('#hasil_prod_code_no_md').val() == '-'))
                    {
                        $('#hasil_correction').val('-');
                    }   
                break;
                case '#OK':
                    if ($('#hasil_ts_accurate_kanan').val() == '#OK' || $('#hasil_ts_accurate_kiri').val() == '#OK' ||$('#hasil_ls_accurate').val() == '#OK' ||$('#hasil_sa_accurate').val() == '#OK' ||$('#hasil_surface_check').val() == '#OK' ||$('#hasil_pinching').val() == '#OK' ||$('#hasil_strip_folding').val() == '#OK' ||$('#hasil_konduktivity_kanan').val() == '#OK' ||$('#hasil_konduktivity_kiri').val() == '#OK' ||$('#hasil_design_kanan').val() == '#OK' ||$('#hasil_design_kiri').val() == '#OK' || $('#hasil_dye_test').val() == '#OK' || $('#hasil_residu_h2o2').val() == '#OK' || $('#hasil_prod_code_no_md').val() == '#OK' || $('#ls_sa_proportion').val() == '10:90' ||  $('#ls_sa_proportion').val() == '90:10' ||  $('#ls_sa_proportion').val() == '80:20' ||  $('#ls_sa_proportion').val() == '70:30')
                    {
                        $('#hasil_correction').val('');
                    }
                break;
                case '-':
                    if (($('#hasil_overlap').val() <= 4.5 && $('#hasil_overlap').val() >= 3.5) && ( $('#ls_sa_proportion') !== '10:90' &&  $('#ls_sa_proportion') !== '90:10' &&  $('#ls_sa_proportion') !== '80:20' &&  $('#ls_sa_proportion') !== '70:30' ) && ($('#hasil_volume_kanan').val() <= 202 && $('#hasil_volume_kanan').val() >= 198) && ($('#hasil_volume_kiri').val() <= 202 && $('#hasil_volume_kiri').val() >= 198) && ($('#hasil_ts_accurate_kanan').val() == 'OK' &&  $('#hasil_ts_accurate_kiri').val() == 'OK' && $('#hasil_ls_accurate').val() == 'OK' && $('#hasil_sa_accurate').val() == 'OK' && $('#hasil_surface_check').val() == 'OK' && $('#hasil_pinching').val() == 'OK' && $('#hasil_strip_folding').val() == 'OK' && $('#hasil_konduktivity_kanan').val() == 'OK' && $('#hasil_konduktivity_kiri').val() == 'OK' && $('#hasil_design_kanan').val() == 'OK' && $('#hasil_design_kiri').val() == 'OK' &&  $('#hasil_dye_test').val() == 'OK' &&  $('#hasil_residu_h2o2').val() == 'OK' && $('#hasil_prod_code_no_md').val() == 'OK') || ($('#hasil_ts_accurate_kanan').val() == '-' &&  $('#hasil_ts_accurate_kiri').val() == '-' && $('#hasil_ls_accurate').val() == '-' && $('#hasil_sa_accurate').val() == '-' && $('#hasil_surface_check').val() == '-' && $('#hasil_pinching').val() == '-' && $('#hasil_strip_folding').val() == '-' && $('#hasil_konduktivity_kanan').val() == '-' && $('#hasil_konduktivity_kiri').val() == '-' && $('#hasil_design_kanan').val() == '-' && $('#hasil_design_kiri').val() == '-' &&  $('#hasil_dye_test').val() == '-' &&  $('#hasil_residu_h2o2').val() == '-' && $('#hasil_prod_code_no_md').val() == '-'))
                    {
                        $('#hasil_correction').val('-');
                    }
                break;
            }        
        });
        $('#hasil_konduktivity_kiri').on('change',function(e) 
        {
            var hasil_konduktivity_kiri = e.target.value;
            switch(hasil_konduktivity_kiri)
            {
                case 'OK':
                    if (($('#hasil_overlap').val() <= 4.5 && $('#hasil_overlap').val() >= 3.5) && ( $('#ls_sa_proportion') !== '10:90' &&  $('#ls_sa_proportion') !== '90:10' &&  $('#ls_sa_proportion') !== '80:20' &&  $('#ls_sa_proportion') !== '70:30' ) && ($('#hasil_volume_kanan').val() <= 202 && $('#hasil_volume_kanan').val() >= 198) && ($('#hasil_volume_kiri').val() <= 202 && $('#hasil_volume_kiri').val() >= 198) && ($('#hasil_ts_accurate_kanan').val() == 'OK' &&  $('#hasil_ts_accurate_kiri').val() == 'OK' && $('#hasil_ls_accurate').val() == 'OK' && $('#hasil_sa_accurate').val() == 'OK' && $('#hasil_surface_check').val() == 'OK' && $('#hasil_pinching').val() == 'OK' && $('#hasil_strip_folding').val() == 'OK' && $('#hasil_konduktivity_kanan').val() == 'OK' && $('#hasil_konduktivity_kiri').val() == 'OK' && $('#hasil_design_kanan').val() == 'OK' && $('#hasil_design_kiri').val() == 'OK' &&  $('#hasil_dye_test').val() == 'OK' &&  $('#hasil_residu_h2o2').val() == 'OK' && $('#hasil_prod_code_no_md').val() == 'OK') || ($('#hasil_ts_accurate_kanan').val() == '-' &&  $('#hasil_ts_accurate_kiri').val() == '-' && $('#hasil_ls_accurate').val() == '-' && $('#hasil_sa_accurate').val() == '-' && $('#hasil_surface_check').val() == '-' && $('#hasil_pinching').val() == '-' && $('#hasil_strip_folding').val() == '-' && $('#hasil_konduktivity_kanan').val() == '-' && $('#hasil_konduktivity_kiri').val() == '-' && $('#hasil_design_kanan').val() == '-' && $('#hasil_design_kiri').val() == '-' &&  $('#hasil_dye_test').val() == '-' &&  $('#hasil_residu_h2o2').val() == '-' && $('#hasil_prod_code_no_md').val() == '-'))
                    {
                        $('#hasil_correction').val('-');
                    }   
                break;
                case '#OK':
                    if ($('#hasil_ts_accurate_kanan').val() == '#OK' || $('#hasil_ts_accurate_kiri').val() == '#OK' ||$('#hasil_ls_accurate').val() == '#OK' ||$('#hasil_sa_accurate').val() == '#OK' ||$('#hasil_surface_check').val() == '#OK' ||$('#hasil_pinching').val() == '#OK' ||$('#hasil_strip_folding').val() == '#OK' ||$('#hasil_konduktivity_kanan').val() == '#OK' ||$('#hasil_konduktivity_kiri').val() == '#OK' ||$('#hasil_design_kanan').val() == '#OK' ||$('#hasil_design_kiri').val() == '#OK' || $('#hasil_dye_test').val() == '#OK' || $('#hasil_residu_h2o2').val() == '#OK' || $('#hasil_prod_code_no_md').val() == '#OK' || $('#ls_sa_proportion').val() == '10:90' ||  $('#ls_sa_proportion').val() == '90:10' ||  $('#ls_sa_proportion').val() == '80:20' ||  $('#ls_sa_proportion').val() == '70:30')
                    {
                        $('#hasil_correction').val('');
                    }
                break;
                case '-':
                    if (($('#hasil_overlap').val() <= 4.5 && $('#hasil_overlap').val() >= 3.5) && ( $('#ls_sa_proportion') !== '10:90' &&  $('#ls_sa_proportion') !== '90:10' &&  $('#ls_sa_proportion') !== '80:20' &&  $('#ls_sa_proportion') !== '70:30' ) && ($('#hasil_volume_kanan').val() <= 202 && $('#hasil_volume_kanan').val() >= 198) && ($('#hasil_volume_kiri').val() <= 202 && $('#hasil_volume_kiri').val() >= 198) && ($('#hasil_ts_accurate_kanan').val() == 'OK' &&  $('#hasil_ts_accurate_kiri').val() == 'OK' && $('#hasil_ls_accurate').val() == 'OK' && $('#hasil_sa_accurate').val() == 'OK' && $('#hasil_surface_check').val() == 'OK' && $('#hasil_pinching').val() == 'OK' && $('#hasil_strip_folding').val() == 'OK' && $('#hasil_konduktivity_kanan').val() == 'OK' && $('#hasil_konduktivity_kiri').val() == 'OK' && $('#hasil_design_kanan').val() == 'OK' && $('#hasil_design_kiri').val() == 'OK' &&  $('#hasil_dye_test').val() == 'OK' &&  $('#hasil_residu_h2o2').val() == 'OK' && $('#hasil_prod_code_no_md').val() == 'OK') || ($('#hasil_ts_accurate_kanan').val() == '-' &&  $('#hasil_ts_accurate_kiri').val() == '-' && $('#hasil_ls_accurate').val() == '-' && $('#hasil_sa_accurate').val() == '-' && $('#hasil_surface_check').val() == '-' && $('#hasil_pinching').val() == '-' && $('#hasil_strip_folding').val() == '-' && $('#hasil_konduktivity_kanan').val() == '-' && $('#hasil_konduktivity_kiri').val() == '-' && $('#hasil_design_kanan').val() == '-' && $('#hasil_design_kiri').val() == '-' &&  $('#hasil_dye_test').val() == '-' &&  $('#hasil_residu_h2o2').val() == '-' && $('#hasil_prod_code_no_md').val() == '-'))
                    {
                        $('#hasil_correction').val('-');
                    }
                break;
            }        
        });
        $('#hasil_design_kanan').on('change',function(e) 
        {
            var hasil_design_kanan = e.target.value;
            switch(hasil_design_kanan)
            {
                case 'OK':
                    if (($('#hasil_overlap').val() <= 4.5 && $('#hasil_overlap').val() >= 3.5) && ( $('#ls_sa_proportion') !== '10:90' &&  $('#ls_sa_proportion') !== '90:10' &&  $('#ls_sa_proportion') !== '80:20' &&  $('#ls_sa_proportion') !== '70:30' ) && ($('#hasil_volume_kanan').val() <= 202 && $('#hasil_volume_kanan').val() >= 198) && ($('#hasil_volume_kiri').val() <= 202 && $('#hasil_volume_kiri').val() >= 198) && ($('#hasil_ts_accurate_kanan').val() == 'OK' &&  $('#hasil_ts_accurate_kiri').val() == 'OK' && $('#hasil_ls_accurate').val() == 'OK' && $('#hasil_sa_accurate').val() == 'OK' && $('#hasil_surface_check').val() == 'OK' && $('#hasil_pinching').val() == 'OK' && $('#hasil_strip_folding').val() == 'OK' && $('#hasil_konduktivity_kanan').val() == 'OK' && $('#hasil_konduktivity_kiri').val() == 'OK' && $('#hasil_design_kanan').val() == 'OK' && $('#hasil_design_kiri').val() == 'OK' &&  $('#hasil_dye_test').val() == 'OK' &&  $('#hasil_residu_h2o2').val() == 'OK' && $('#hasil_prod_code_no_md').val() == 'OK') || ($('#hasil_ts_accurate_kanan').val() == '-' &&  $('#hasil_ts_accurate_kiri').val() == '-' && $('#hasil_ls_accurate').val() == '-' && $('#hasil_sa_accurate').val() == '-' && $('#hasil_surface_check').val() == '-' && $('#hasil_pinching').val() == '-' && $('#hasil_strip_folding').val() == '-' && $('#hasil_konduktivity_kanan').val() == '-' && $('#hasil_konduktivity_kiri').val() == '-' && $('#hasil_design_kanan').val() == '-' && $('#hasil_design_kiri').val() == '-' &&  $('#hasil_dye_test').val() == '-' &&  $('#hasil_residu_h2o2').val() == '-' && $('#hasil_prod_code_no_md').val() == '-'))
                    {
                        $('#hasil_correction').val('-');
                    }   
                break;
                case '#OK':
                    if ($('#hasil_ts_accurate_kanan').val() == '#OK' || $('#hasil_ts_accurate_kiri').val() == '#OK' ||$('#hasil_ls_accurate').val() == '#OK' ||$('#hasil_sa_accurate').val() == '#OK' ||$('#hasil_surface_check').val() == '#OK' ||$('#hasil_pinching').val() == '#OK' ||$('#hasil_strip_folding').val() == '#OK' ||$('#hasil_konduktivity_kanan').val() == '#OK' ||$('#hasil_konduktivity_kiri').val() == '#OK' ||$('#hasil_design_kanan').val() == '#OK' ||$('#hasil_design_kiri').val() == '#OK' || $('#hasil_dye_test').val() == '#OK' || $('#hasil_residu_h2o2').val() == '#OK' || $('#hasil_prod_code_no_md').val() == '#OK' || $('#ls_sa_proportion').val() == '10:90' ||  $('#ls_sa_proportion').val() == '90:10' ||  $('#ls_sa_proportion').val() == '80:20' ||  $('#ls_sa_proportion').val() == '70:30')
                    {
                        $('#hasil_correction').val('');
                    }
                break;
                case '-':
                    if (($('#hasil_overlap').val() <= 4.5 && $('#hasil_overlap').val() >= 3.5) && ( $('#ls_sa_proportion') !== '10:90' &&  $('#ls_sa_proportion') !== '90:10' &&  $('#ls_sa_proportion') !== '80:20' &&  $('#ls_sa_proportion') !== '70:30' ) && ($('#hasil_volume_kanan').val() <= 202 && $('#hasil_volume_kanan').val() >= 198) && ($('#hasil_volume_kiri').val() <= 202 && $('#hasil_volume_kiri').val() >= 198) && ($('#hasil_ts_accurate_kanan').val() == 'OK' &&  $('#hasil_ts_accurate_kiri').val() == 'OK' && $('#hasil_ls_accurate').val() == 'OK' && $('#hasil_sa_accurate').val() == 'OK' && $('#hasil_surface_check').val() == 'OK' && $('#hasil_pinching').val() == 'OK' && $('#hasil_strip_folding').val() == 'OK' && $('#hasil_konduktivity_kanan').val() == 'OK' && $('#hasil_konduktivity_kiri').val() == 'OK' && $('#hasil_design_kanan').val() == 'OK' && $('#hasil_design_kiri').val() == 'OK' &&  $('#hasil_dye_test').val() == 'OK' &&  $('#hasil_residu_h2o2').val() == 'OK' && $('#hasil_prod_code_no_md').val() == 'OK') || ($('#hasil_ts_accurate_kanan').val() == '-' &&  $('#hasil_ts_accurate_kiri').val() == '-' && $('#hasil_ls_accurate').val() == '-' && $('#hasil_sa_accurate').val() == '-' && $('#hasil_surface_check').val() == '-' && $('#hasil_pinching').val() == '-' && $('#hasil_strip_folding').val() == '-' && $('#hasil_konduktivity_kanan').val() == '-' && $('#hasil_konduktivity_kiri').val() == '-' && $('#hasil_design_kanan').val() == '-' && $('#hasil_design_kiri').val() == '-' &&  $('#hasil_dye_test').val() == '-' &&  $('#hasil_residu_h2o2').val() == '-' && $('#hasil_prod_code_no_md').val() == '-'))
                    {
                        $('#hasil_correction').val('-');
                    }
                break;
            }        
        });
        $('#hasil_design_kiri').on('change',function(e) 
        {
            var hasil_design_kiri = e.target.value;
            switch(hasil_design_kiri)
            {
                case 'OK':
                    if (($('#hasil_overlap').val() <= 4.5 && $('#hasil_overlap').val() >= 3.5) && ( $('#ls_sa_proportion') !== '10:90' &&  $('#ls_sa_proportion') !== '90:10' &&  $('#ls_sa_proportion') !== '80:20' &&  $('#ls_sa_proportion') !== '70:30' ) && ($('#hasil_volume_kanan').val() <= 202 && $('#hasil_volume_kanan').val() >= 198) && ($('#hasil_volume_kiri').val() <= 202 && $('#hasil_volume_kiri').val() >= 198) && ($('#hasil_ts_accurate_kanan').val() == 'OK' &&  $('#hasil_ts_accurate_kiri').val() == 'OK' && $('#hasil_ls_accurate').val() == 'OK' && $('#hasil_sa_accurate').val() == 'OK' && $('#hasil_surface_check').val() == 'OK' && $('#hasil_pinching').val() == 'OK' && $('#hasil_strip_folding').val() == 'OK' && $('#hasil_konduktivity_kanan').val() == 'OK' && $('#hasil_konduktivity_kiri').val() == 'OK' && $('#hasil_design_kanan').val() == 'OK' && $('#hasil_design_kiri').val() == 'OK' &&  $('#hasil_dye_test').val() == 'OK' &&  $('#hasil_residu_h2o2').val() == 'OK' && $('#hasil_prod_code_no_md').val() == 'OK') || ($('#hasil_ts_accurate_kanan').val() == '-' &&  $('#hasil_ts_accurate_kiri').val() == '-' && $('#hasil_ls_accurate').val() == '-' && $('#hasil_sa_accurate').val() == '-' && $('#hasil_surface_check').val() == '-' && $('#hasil_pinching').val() == '-' && $('#hasil_strip_folding').val() == '-' && $('#hasil_konduktivity_kanan').val() == '-' && $('#hasil_konduktivity_kiri').val() == '-' && $('#hasil_design_kanan').val() == '-' && $('#hasil_design_kiri').val() == '-' &&  $('#hasil_dye_test').val() == '-' &&  $('#hasil_residu_h2o2').val() == '-' && $('#hasil_prod_code_no_md').val() == '-'))
                    {
                        $('#hasil_correction').val('-');
                    }   
                break;
                case '#OK':
                    if ($('#hasil_ts_accurate_kanan').val() == '#OK' || $('#hasil_ts_accurate_kiri').val() == '#OK' ||$('#hasil_ls_accurate').val() == '#OK' ||$('#hasil_sa_accurate').val() == '#OK' ||$('#hasil_surface_check').val() == '#OK' ||$('#hasil_pinching').val() == '#OK' ||$('#hasil_strip_folding').val() == '#OK' ||$('#hasil_konduktivity_kanan').val() == '#OK' ||$('#hasil_konduktivity_kiri').val() == '#OK' ||$('#hasil_design_kanan').val() == '#OK' ||$('#hasil_design_kiri').val() == '#OK' || $('#hasil_dye_test').val() == '#OK' || $('#hasil_residu_h2o2').val() == '#OK' || $('#hasil_prod_code_no_md').val() == '#OK' || $('#ls_sa_proportion').val() == '10:90' ||  $('#ls_sa_proportion').val() == '90:10' ||  $('#ls_sa_proportion').val() == '80:20' ||  $('#ls_sa_proportion').val() == '70:30')
                    {
                        $('#hasil_correction').val('');
                    }
                break;
                case '-':
                    if (($('#hasil_overlap').val() <= 4.5 && $('#hasil_overlap').val() >= 3.5) && ( $('#ls_sa_proportion') !== '10:90' &&  $('#ls_sa_proportion') !== '90:10' &&  $('#ls_sa_proportion') !== '80:20' &&  $('#ls_sa_proportion') !== '70:30' ) && ($('#hasil_volume_kanan').val() <= 202 && $('#hasil_volume_kanan').val() >= 198) && ($('#hasil_volume_kiri').val() <= 202 && $('#hasil_volume_kiri').val() >= 198) && ($('#hasil_ts_accurate_kanan').val() == 'OK' &&  $('#hasil_ts_accurate_kiri').val() == 'OK' && $('#hasil_ls_accurate').val() == 'OK' && $('#hasil_sa_accurate').val() == 'OK' && $('#hasil_surface_check').val() == 'OK' && $('#hasil_pinching').val() == 'OK' && $('#hasil_strip_folding').val() == 'OK' && $('#hasil_konduktivity_kanan').val() == 'OK' && $('#hasil_konduktivity_kiri').val() == 'OK' && $('#hasil_design_kanan').val() == 'OK' && $('#hasil_design_kiri').val() == 'OK' &&  $('#hasil_dye_test').val() == 'OK' &&  $('#hasil_residu_h2o2').val() == 'OK' && $('#hasil_prod_code_no_md').val() == 'OK') || ($('#hasil_ts_accurate_kanan').val() == '-' &&  $('#hasil_ts_accurate_kiri').val() == '-' && $('#hasil_ls_accurate').val() == '-' && $('#hasil_sa_accurate').val() == '-' && $('#hasil_surface_check').val() == '-' && $('#hasil_pinching').val() == '-' && $('#hasil_strip_folding').val() == '-' && $('#hasil_konduktivity_kanan').val() == '-' && $('#hasil_konduktivity_kiri').val() == '-' && $('#hasil_design_kanan').val() == '-' && $('#hasil_design_kiri').val() == '-' &&  $('#hasil_dye_test').val() == '-' &&  $('#hasil_residu_h2o2').val() == '-' && $('#hasil_prod_code_no_md').val() == '-'))
                    {
                        $('#hasil_correction').val('-');
                    }
                break;
            }        
        });
        $('#hasil_dye_test').on('change',function(e) 
        {
            var hasil_dye_test = e.target.value;
            switch(hasil_dye_test)
            {
                case 'OK':
                    if (($('#hasil_overlap').val() <= 4.5 && $('#hasil_overlap').val() >= 3.5) && ( $('#ls_sa_proportion') !== '10:90' &&  $('#ls_sa_proportion') !== '90:10' &&  $('#ls_sa_proportion') !== '80:20' &&  $('#ls_sa_proportion') !== '70:30' ) && ($('#hasil_volume_kanan').val() <= 202 && $('#hasil_volume_kanan').val() >= 198) && ($('#hasil_volume_kiri').val() <= 202 && $('#hasil_volume_kiri').val() >= 198) && ($('#hasil_ts_accurate_kanan').val() == 'OK' &&  $('#hasil_ts_accurate_kiri').val() == 'OK' && $('#hasil_ls_accurate').val() == 'OK' && $('#hasil_sa_accurate').val() == 'OK' && $('#hasil_surface_check').val() == 'OK' && $('#hasil_pinching').val() == 'OK' && $('#hasil_strip_folding').val() == 'OK' && $('#hasil_konduktivity_kanan').val() == 'OK' && $('#hasil_konduktivity_kiri').val() == 'OK' && $('#hasil_design_kanan').val() == 'OK' && $('#hasil_design_kiri').val() == 'OK' &&  $('#hasil_dye_test').val() == 'OK' &&  $('#hasil_residu_h2o2').val() == 'OK' && $('#hasil_prod_code_no_md').val() == 'OK') || ($('#hasil_ts_accurate_kanan').val() == '-' &&  $('#hasil_ts_accurate_kiri').val() == '-' && $('#hasil_ls_accurate').val() == '-' && $('#hasil_sa_accurate').val() == '-' && $('#hasil_surface_check').val() == '-' && $('#hasil_pinching').val() == '-' && $('#hasil_strip_folding').val() == '-' && $('#hasil_konduktivity_kanan').val() == '-' && $('#hasil_konduktivity_kiri').val() == '-' && $('#hasil_design_kanan').val() == '-' && $('#hasil_design_kiri').val() == '-' &&  $('#hasil_dye_test').val() == '-' &&  $('#hasil_residu_h2o2').val() == '-' && $('#hasil_prod_code_no_md').val() == '-'))
                    {
                        $('#hasil_correction').val('-');
                    }   
                break;
                case '#OK':
                    if ($('#hasil_ts_accurate_kanan').val() == '#OK' || $('#hasil_ts_accurate_kiri').val() == '#OK' ||$('#hasil_ls_accurate').val() == '#OK' ||$('#hasil_sa_accurate').val() == '#OK' ||$('#hasil_surface_check').val() == '#OK' ||$('#hasil_pinching').val() == '#OK' ||$('#hasil_strip_folding').val() == '#OK' ||$('#hasil_konduktivity_kanan').val() == '#OK' ||$('#hasil_konduktivity_kiri').val() == '#OK' ||$('#hasil_design_kanan').val() == '#OK' ||$('#hasil_design_kiri').val() == '#OK' || $('#hasil_dye_test').val() == '#OK' || $('#hasil_residu_h2o2').val() == '#OK' || $('#hasil_prod_code_no_md').val() == '#OK' || $('#ls_sa_proportion').val() == '10:90' ||  $('#ls_sa_proportion').val() == '90:10' ||  $('#ls_sa_proportion').val() == '80:20' ||  $('#ls_sa_proportion').val() == '70:30')
                    {
                        $('#hasil_correction').val('');
                    }
                break;
                case '-':
                    if (($('#hasil_overlap').val() <= 4.5 && $('#hasil_overlap').val() >= 3.5) && ( $('#ls_sa_proportion') !== '10:90' &&  $('#ls_sa_proportion') !== '90:10' &&  $('#ls_sa_proportion') !== '80:20' &&  $('#ls_sa_proportion') !== '70:30' ) && ($('#hasil_volume_kanan').val() <= 202 && $('#hasil_volume_kanan').val() >= 198) && ($('#hasil_volume_kiri').val() <= 202 && $('#hasil_volume_kiri').val() >= 198) && ($('#hasil_ts_accurate_kanan').val() == 'OK' &&  $('#hasil_ts_accurate_kiri').val() == 'OK' && $('#hasil_ls_accurate').val() == 'OK' && $('#hasil_sa_accurate').val() == 'OK' && $('#hasil_surface_check').val() == 'OK' && $('#hasil_pinching').val() == 'OK' && $('#hasil_strip_folding').val() == 'OK' && $('#hasil_konduktivity_kanan').val() == 'OK' && $('#hasil_konduktivity_kiri').val() == 'OK' && $('#hasil_design_kanan').val() == 'OK' && $('#hasil_design_kiri').val() == 'OK' &&  $('#hasil_dye_test').val() == 'OK' &&  $('#hasil_residu_h2o2').val() == 'OK' && $('#hasil_prod_code_no_md').val() == 'OK') || ($('#hasil_ts_accurate_kanan').val() == '-' &&  $('#hasil_ts_accurate_kiri').val() == '-' && $('#hasil_ls_accurate').val() == '-' && $('#hasil_sa_accurate').val() == '-' && $('#hasil_surface_check').val() == '-' && $('#hasil_pinching').val() == '-' && $('#hasil_strip_folding').val() == '-' && $('#hasil_konduktivity_kanan').val() == '-' && $('#hasil_konduktivity_kiri').val() == '-' && $('#hasil_design_kanan').val() == '-' && $('#hasil_design_kiri').val() == '-' &&  $('#hasil_dye_test').val() == '-' &&  $('#hasil_residu_h2o2').val() == '-' && $('#hasil_prod_code_no_md').val() == '-'))
                    {
                        $('#hasil_correction').val('-');
                    }
                break;
            }        
        });
        $('#hasil_residu_h2o2').on('change',function(e) 
        {
            var hasil_residu_h2o2 = e.target.value;
            switch(hasil_residu_h2o2)
            {
                case 'OK':
                    if (($('#hasil_overlap').val() <= 4.5 && $('#hasil_overlap').val() >= 3.5) && ( $('#ls_sa_proportion') !== '10:90' &&  $('#ls_sa_proportion') !== '90:10' &&  $('#ls_sa_proportion') !== '80:20' &&  $('#ls_sa_proportion') !== '70:30' ) && ($('#hasil_volume_kanan').val() <= 202 && $('#hasil_volume_kanan').val() >= 198) && ($('#hasil_volume_kiri').val() <= 202 && $('#hasil_volume_kiri').val() >= 198) && ($('#hasil_ts_accurate_kanan').val() == 'OK' &&  $('#hasil_ts_accurate_kiri').val() == 'OK' && $('#hasil_ls_accurate').val() == 'OK' && $('#hasil_sa_accurate').val() == 'OK' && $('#hasil_surface_check').val() == 'OK' && $('#hasil_pinching').val() == 'OK' && $('#hasil_strip_folding').val() == 'OK' && $('#hasil_konduktivity_kanan').val() == 'OK' && $('#hasil_konduktivity_kiri').val() == 'OK' && $('#hasil_design_kanan').val() == 'OK' && $('#hasil_design_kiri').val() == 'OK' &&  $('#hasil_dye_test').val() == 'OK' &&  $('#hasil_residu_h2o2').val() == 'OK' && $('#hasil_prod_code_no_md').val() == 'OK') || ($('#hasil_ts_accurate_kanan').val() == '-' &&  $('#hasil_ts_accurate_kiri').val() == '-' && $('#hasil_ls_accurate').val() == '-' && $('#hasil_sa_accurate').val() == '-' && $('#hasil_surface_check').val() == '-' && $('#hasil_pinching').val() == '-' && $('#hasil_strip_folding').val() == '-' && $('#hasil_konduktivity_kanan').val() == '-' && $('#hasil_konduktivity_kiri').val() == '-' && $('#hasil_design_kanan').val() == '-' && $('#hasil_design_kiri').val() == '-' &&  $('#hasil_dye_test').val() == '-' &&  $('#hasil_residu_h2o2').val() == '-' && $('#hasil_prod_code_no_md').val() == '-'))
                    {
                        $('#hasil_correction').val('-');
                    }   
                break;
                case '#OK':
                    if ($('#hasil_ts_accurate_kanan').val() == '#OK' || $('#hasil_ts_accurate_kiri').val() == '#OK' ||$('#hasil_ls_accurate').val() == '#OK' ||$('#hasil_sa_accurate').val() == '#OK' ||$('#hasil_surface_check').val() == '#OK' ||$('#hasil_pinching').val() == '#OK' ||$('#hasil_strip_folding').val() == '#OK' ||$('#hasil_konduktivity_kanan').val() == '#OK' ||$('#hasil_konduktivity_kiri').val() == '#OK' ||$('#hasil_design_kanan').val() == '#OK' ||$('#hasil_design_kiri').val() == '#OK' || $('#hasil_dye_test').val() == '#OK' || $('#hasil_residu_h2o2').val() == '#OK' || $('#hasil_prod_code_no_md').val() == '#OK' || $('#ls_sa_proportion').val() == '10:90' ||  $('#ls_sa_proportion').val() == '90:10' ||  $('#ls_sa_proportion').val() == '80:20' ||  $('#ls_sa_proportion').val() == '70:30')
                    {
                        $('#hasil_correction').val('');
                    }
                break;
                case '-':
                    if (($('#hasil_overlap').val() <= 4.5 && $('#hasil_overlap').val() >= 3.5) && ( $('#ls_sa_proportion') !== '10:90' &&  $('#ls_sa_proportion') !== '90:10' &&  $('#ls_sa_proportion') !== '80:20' &&  $('#ls_sa_proportion') !== '70:30' ) && ($('#hasil_volume_kanan').val() <= 202 && $('#hasil_volume_kanan').val() >= 198) && ($('#hasil_volume_kiri').val() <= 202 && $('#hasil_volume_kiri').val() >= 198) && ($('#hasil_ts_accurate_kanan').val() == 'OK' &&  $('#hasil_ts_accurate_kiri').val() == 'OK' && $('#hasil_ls_accurate').val() == 'OK' && $('#hasil_sa_accurate').val() == 'OK' && $('#hasil_surface_check').val() == 'OK' && $('#hasil_pinching').val() == 'OK' && $('#hasil_strip_folding').val() == 'OK' && $('#hasil_konduktivity_kanan').val() == 'OK' && $('#hasil_konduktivity_kiri').val() == 'OK' && $('#hasil_design_kanan').val() == 'OK' && $('#hasil_design_kiri').val() == 'OK' &&  $('#hasil_dye_test').val() == 'OK' &&  $('#hasil_residu_h2o2').val() == 'OK' && $('#hasil_prod_code_no_md').val() == 'OK') || ($('#hasil_ts_accurate_kanan').val() == '-' &&  $('#hasil_ts_accurate_kiri').val() == '-' && $('#hasil_ls_accurate').val() == '-' && $('#hasil_sa_accurate').val() == '-' && $('#hasil_surface_check').val() == '-' && $('#hasil_pinching').val() == '-' && $('#hasil_strip_folding').val() == '-' && $('#hasil_konduktivity_kanan').val() == '-' && $('#hasil_konduktivity_kiri').val() == '-' && $('#hasil_design_kanan').val() == '-' && $('#hasil_design_kiri').val() == '-' &&  $('#hasil_dye_test').val() == '-' &&  $('#hasil_residu_h2o2').val() == '-' && $('#hasil_prod_code_no_md').val() == '-'))
                    {
                        $('#hasil_correction').val('-');
                    }
                break;
            }        
        });

        $('#hasil_prod_code_no_md').on('change',function(e) 
        {
            var hasil_prod_code_no_md = e.target.value;
            switch(hasil_prod_code_no_md)
            {
                case 'OK':
                    if (($('#hasil_overlap').val() <= 4.5 && $('#hasil_overlap').val() >= 3.5) && ( $('#ls_sa_proportion') !== '10:90' &&  $('#ls_sa_proportion') !== '90:10' &&  $('#ls_sa_proportion') !== '80:20' &&  $('#ls_sa_proportion') !== '70:30' ) && ($('#hasil_volume_kanan').val() <= 202 && $('#hasil_volume_kanan').val() >= 198) && ($('#hasil_volume_kiri').val() <= 202 && $('#hasil_volume_kiri').val() >= 198) && ($('#hasil_ts_accurate_kanan').val() == 'OK' &&  $('#hasil_ts_accurate_kiri').val() == 'OK' && $('#hasil_ls_accurate').val() == 'OK' && $('#hasil_sa_accurate').val() == 'OK' && $('#hasil_surface_check').val() == 'OK' && $('#hasil_pinching').val() == 'OK' && $('#hasil_strip_folding').val() == 'OK' && $('#hasil_konduktivity_kanan').val() == 'OK' && $('#hasil_konduktivity_kiri').val() == 'OK' && $('#hasil_design_kanan').val() == 'OK' && $('#hasil_design_kiri').val() == 'OK' &&  $('#hasil_dye_test').val() == 'OK' &&  $('#hasil_residu_h2o2').val() == 'OK' && $('#hasil_prod_code_no_md').val() == 'OK') || ($('#hasil_ts_accurate_kanan').val() == '-' &&  $('#hasil_ts_accurate_kiri').val() == '-' && $('#hasil_ls_accurate').val() == '-' && $('#hasil_sa_accurate').val() == '-' && $('#hasil_surface_check').val() == '-' && $('#hasil_pinching').val() == '-' && $('#hasil_strip_folding').val() == '-' && $('#hasil_konduktivity_kanan').val() == '-' && $('#hasil_konduktivity_kiri').val() == '-' && $('#hasil_design_kanan').val() == '-' && $('#hasil_design_kiri').val() == '-' &&  $('#hasil_dye_test').val() == '-' &&  $('#hasil_residu_h2o2').val() == '-' && $('#hasil_prod_code_no_md').val() == '-'))
                    {
                        $('#hasil_correction').val('-');
                    }   
                break;
                case '#OK':
                    if ($('#hasil_ts_accurate_kanan').val() == '#OK' || $('#hasil_ts_accurate_kiri').val() == '#OK' ||$('#hasil_ls_accurate').val() == '#OK' ||$('#hasil_sa_accurate').val() == '#OK' ||$('#hasil_surface_check').val() == '#OK' ||$('#hasil_pinching').val() == '#OK' ||$('#hasil_strip_folding').val() == '#OK' ||$('#hasil_konduktivity_kanan').val() == '#OK' ||$('#hasil_konduktivity_kiri').val() == '#OK' ||$('#hasil_design_kanan').val() == '#OK' ||$('#hasil_design_kiri').val() == '#OK' || $('#hasil_dye_test').val() == '#OK' || $('#hasil_residu_h2o2').val() == '#OK' || $('#hasil_prod_code_no_md').val() == '#OK' || $('#ls_sa_proportion').val() == '10:90' ||  $('#ls_sa_proportion').val() == '90:10' ||  $('#ls_sa_proportion').val() == '80:20' ||  $('#ls_sa_proportion').val() == '70:30')
                    {
                        $('#hasil_correction').val('');
                    }
                break;
                case '-':
                    if (($('#hasil_overlap').val() <= 4.5 && $('#hasil_overlap').val() >= 3.5) && ( $('#ls_sa_proportion') !== '10:90' &&  $('#ls_sa_proportion') !== '90:10' &&  $('#ls_sa_proportion') !== '80:20' &&  $('#ls_sa_proportion') !== '70:30' ) && ($('#hasil_volume_kanan').val() <= 202 && $('#hasil_volume_kanan').val() >= 198) && ($('#hasil_volume_kiri').val() <= 202 && $('#hasil_volume_kiri').val() >= 198) && ($('#hasil_ts_accurate_kanan').val() == 'OK' &&  $('#hasil_ts_accurate_kiri').val() == 'OK' && $('#hasil_ls_accurate').val() == 'OK' && $('#hasil_sa_accurate').val() == 'OK' && $('#hasil_surface_check').val() == 'OK' && $('#hasil_pinching').val() == 'OK' && $('#hasil_strip_folding').val() == 'OK' && $('#hasil_konduktivity_kanan').val() == 'OK' && $('#hasil_konduktivity_kiri').val() == 'OK' && $('#hasil_design_kanan').val() == 'OK' && $('#hasil_design_kiri').val() == 'OK' &&  $('#hasil_dye_test').val() == 'OK' &&  $('#hasil_residu_h2o2').val() == 'OK' && $('#hasil_prod_code_no_md').val() == 'OK') || ($('#hasil_ts_accurate_kanan').val() == '-' &&  $('#hasil_ts_accurate_kiri').val() == '-' && $('#hasil_ls_accurate').val() == '-' && $('#hasil_sa_accurate').val() == '-' && $('#hasil_surface_check').val() == '-' && $('#hasil_pinching').val() == '-' && $('#hasil_strip_folding').val() == '-' && $('#hasil_konduktivity_kanan').val() == '-' && $('#hasil_konduktivity_kiri').val() == '-' && $('#hasil_design_kanan').val() == '-' && $('#hasil_design_kiri').val() == '-' &&  $('#hasil_dye_test').val() == '-' &&  $('#hasil_residu_h2o2').val() == '-' && $('#hasil_prod_code_no_md').val() == '-'))
                    {
                        $('#hasil_correction').val('-');
                    }
                break;
            }        
        });

    });
</script>