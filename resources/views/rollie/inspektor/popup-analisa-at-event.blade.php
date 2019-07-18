<div class="modal fade bd-example-modal-lg" id="analisa-sample-at-event" tabindex="-1" role="dialog" aria-labelledby="analisaSample" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Hasil Analisa At Event Produk Hilo Teen Coklat 200Ml</h5>
                <button type="button" id="close-button-at-event" class="close" data-dismiss="modal" onclick="resetPiAtEvent()">&times;</button>
            </div>
            <meta name="csrf-token" content="{{ csrf_token() }}" />
            <input type="hidden" id="rpd_filling_detail_id_at_event">
            <input type="hidden" id="wo_id_sampel_event">
            <input type="hidden" name="user_id_inputer" id="user_id_inputer" value="{{ app('App\Http\Controllers\resourceController')->enkripsi($username->user->id) }}">
            <input type="hidden" id="rpd_filling_head_id" value="{{ app('App\Http\Controllers\resourceController')->enkripsi($rpd_filling->id) }}">
            <div class="modal-body">
                <div id="eventpoint">
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
                                <label for="sampel_at_event" class="col-lg-4">Sampel</label>
                                <input type="text" name="sampel_at_event" id="sampel_at_event" class="col-lg-7 form-control" readonly>
                                <input type="hidden" name="sampel_at_event" id="sampel_at_event_kode" class="col-lg-7 form-control" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="mesin_filling_at_event" class="col-lg-4">Mesin Filling</label>
                                <input type="text" name="mesin_filling_at_event" id="mesin_filling_at_event" class="col-lg-7 form-control" readonly>
                                <input type="hidden" name="mesin_filling_at_event" id="mesin_filling_at_event_id" class="col-lg-7 form-control" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row" >
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="tanggal_filling_at_event" class="col-lg-4">Tanggal Filling</label>
                                <input type="text" name="tanggal_filling_at_event" id="tanggal_filling_at_event" class="col-lg-7 form-control" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="jam_filling_at_event" class="col-lg-4">Jam Filling</label>
                                <input type="text" name="jam_filling_at_event" id="jam_filling_at_event" class="col-lg-7 form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label for="hasil_ls_sa_proportion" class="col-lg-3">LS/SA Proportion</label>
                        <input type="text" inputmode="tel" class="col-lg-8 form-control" name="hasil_ls_sa_proportion" id="hasil_ls_sa_proportion_event" maxlength="5" placeholder="Ex : 40:60" onfocusout="status_akhir_at_event($('#sampel_at_event_kode').val())">
                        <small class="form-text text-muted" style="margin-left: 216px">Di isi dengan Angka dengan format XX:XX</small>
                    </div>
                    <div class="form-group row">
                        <label for="hasil_ls_sa_sealing_quality" class="col-lg-3">LS/SA Sealing Quality</label>
                        <select onchange="status_akhir_at_event($('#sampel_at_event_kode').val())" name="hasil_ls_sa_sealing_quality" id="hasil_ls_sa_sealing_quality_event" class="select col-lg-8 form-control" style="padding: 0 .8rem;" required="true">
                            <option disabled selected>-- Status LS/SA Sealing Quality --</option>
                            <option value="OK">OK</option>
                            <option value="#OK">#OK</option>
                        </select>
                    </div>

                </div>
                <div id="custom_input">
                    <div id="paper_splicing" class="sembunyi">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="text-center">
                                    <hr>
                                    <h6 class="">Paper Splicing</h6>
                                    <hr>    
                                </div>
                            </div>
                        </div>

                        <div class="form-group has-warning row">
                            <label for="hasil_sideway_sealing_alignment" class="col-lg-3" >Sideway sealing alignment (0-0.5)</label>
                            <input type="number" name="hasil_sideway_sealing_alignment" id="hasil_sideway_sealing_alignment_event" class="form-control col-lg-8" maxlength="3" onfocusout="status_akhir_at_event($('#sampel_at_event_kode').val())" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" required>
                            <small class="form-text text-muted" style="margin-left: 216px">Batas Min. 0 batas Max. 0.5</small>
                        </div>
                        <div class="form-group has-warning row">
                            <label for="hasil_overlap" class="col-lg-3">Overlap (16-17)</label>
                            <input type="number" name="hasil_overlap" id="hasil_overlap_event" class="form-control col-lg-8" onfocusout="status_akhir_at_event($('#sampel_at_event_kode').val())" maxlength="5" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" required>
                            <small class="form-text text-muted" style="margin-left: 216px">Batas Min. 16 Batas Max. 17</small>
                        </div>

                        <div class="form-group has-warning row">
                            <label for="hasil_package_length" class="col-lg-3">Package Length</label>
                            <input type="number" name="hasil_package_length" id="hasil_package_length_event" class="form-control col-lg-8" onfocusout="status_akhir_at_event($('#sampel_at_event_kode').val())" maxlength="6" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" required>
                            <small class="form-text text-muted" style="margin-left: 216px">Batas Min. 118.5 Batas Max. 119.5</small>
                        </div>

                        <div class="form-group row">
                            <label for="hasil_paper_splice_sealing_quality" class="col-lg-3">Paper Splice Sealing Quality</label>
                            <select onchange="status_akhir_at_event($('#sampel_at_event_kode').val())" name="hasil_paper_splice_sealing_quality" id="hasil_paper_splice_sealing_quality_event" class="select col-lg-8 form-control" style="padding: 0 .8rem;" required="true">
                                <option disabled selected>-- Status Paper Sealing Quality --</option>
                                <option value="OK">OK</option>
                                <option value="#OK">#OK</option>
                            </select>
                        </div>
                        <div class="form-group row">
                            <label for="hasil_no_kk" class="col-lg-3">Nomor KK</label>
                            <input type="text" name="hasil_no_kk" id="hasil_no_kk_event" class="form-control col-lg-8" maxlength="14" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 45" required>
                        </div>
                        <div class="form-group row">
                            <label for="nomor_md" class="col-lg-3">Nomor MD</label>
                            <input type="text" name="nomor_md" id="hasil_nomor_md_event" class="form-control col-lg-8" maxlength="14" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                        </div>
                    </div>
                    <div id="strip_splicing" class="sembunyi">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="text-center">
                                    <hr>
                                    <h6 class="">Strip Splicing</h6>
                                    <hr>    
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hasil_ls_sa_sealing_quality_strip" class="col-lg-3">Paper Splice Sealing Quality</label>
                            <select onchange="status_akhir_at_event($('#sampel_at_event_kode').val())" name="hasil_ls_sa_sealing_quality_strip" id="hasil_ls_sa_sealing_quality_strip_event" class="select col-lg-8 form-control" style="padding: 0 .8rem;" required="true">
                                <option disabled selected>-- Status Paper Splice Sealing Quality --</option>
                                <option value="OK">OK</option>
                                <option value="#OK">#OK</option>
                            </select>
                        </div>
                    </div>
                    <div id="short_stop" class="sembunyi">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="text-center">
                                    <hr>
                                    <h6 class="">Short Stop</h6>
                                    <hr>    
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hasil_ls_short_stop_quality" class="col-lg-3">LS Short Stop Quality</label>
                            <select onchange="status_akhir_at_event($('#sampel_at_event_kode').val())" name="hasil_ls_short_stop_quality" id="hasil_ls_short_stop_quality_event" class="select col-lg-8 form-control" style="padding: 0 .8rem;" required="true">
                                <option disabled selected>-- Status LS Short Stop Quality --</option>
                                <option value="OK">OK</option>
                                <option value="#OK">#OK</option>
                            </select>
                        </div>
                        <div class="form-group row">
                            <label for="hasil_sa_short_stop_quality" class="col-lg-3">SA Short Stop Quality</label>
                            <select onchange="status_akhir_at_event($('#sampel_at_event_kode').val())" name="hasil_sa_short_stop_quality" id="hasil_sa_short_stop_quality_event" class="select col-lg-8 form-control" style="padding: 0 .8rem;" required="true">
                                <option disabled selected>-- Status SA Short Stop Quality --</option>
                                <option value="OK">OK</option>
                                <option value="#OK">#OK</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="hasil_status_akhir" class="col-lg-3">Status Akhir</label>
                    <input type="text" name="hasil_status_akhir" id="hasil_status_akhir_event" class="form-control col-lg-8" readonly required>
                </div>

                <div class="form-group row">
                    <label for="hasil_keterangan" class="col-lg-3">Keterangan</label>
                    <textarea name="hasil_keterangan" id="hasil_keterangan_event" cols="30" rows="5" class="col-lg-8 form-control"></textarea>
                </div>

                <div class="form-group row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-3"></div>
                    <button class="btn btn-info col-lg-5 form-control" onclick="submit_at_event($('#sampel_at_event_kode').val(),$('#rpd_filling_detail_id_at_event').val(),$('#wo_id_sampel_event').val(),$('#hasil_ls_sa_sealing_quality_event').val(),$('#hasil_ls_sa_proportion_event').val(),$('#hasil_sideway_sealing_alignment_event').val(),$('#hasil_overlap_event').val(),$('#hasil_package_length_event').val(),$('#hasil_paper_splice_sealing_quality_event').val(),$('#hasil_no_kk_event').val(),$('#hasil_nomor_md_event').val(),$('#hasil_ls_sa_sealing_quality_strip_event').val(),$('#hasil_ls_short_stop_quality_event').val(),$('#hasil_sa_short_stop_quality_event').val(),$('#hasil_status_akhir_event').val(),$('#hasil_keterangan_event').val())">
                        Input Hasil Analisa
                    </button>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var kode_sampel = $('#sampel_at_event_kode').val();

</script>