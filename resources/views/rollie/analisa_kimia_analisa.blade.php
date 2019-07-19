@extends('rollie.templates.layout2')
@section('title')
    Rollie | Analisa Kimia FG
@endsection
@section('active-home')
    m-menu__item--active
@endsection
@section('active-analisa-kimia')
    m-menu__item--active
@endsection
@section('subheader')
    <h2 class="text-center">ROLLIE | Analisa Kimia FG | Analisa</h2>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="m-portlet">
                <h3 class="d-flex justify-content-center p-2 text-white" style="background: #716aca;">Detail Produk</h3>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="p-2">
                            <div class="form-group">
                                <label for="">Nama Produk</label>
                                <input class="form-control" type="text" value="{{ $cpps->wo[0]->produk->nama_produk }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Tgl Produksi</label>
                                <input class="form-control" type="date" value="{{ $cpps->wo[0]->production_realisation_date }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Nomor WO</label>
                                <textarea class="form-control" name="" id="" rows="3" readonly>@foreach ($cpps->wo as $wo) <?=$wo->nomor_wo."&#13;&#10;"?> @endforeach</textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Nomor LOT</label>
                                <textarea class="form-control" name="" id="" rows="3" readonly><?php
                                foreach ($cpps->cppDetail as $key => $cpp_detail) 
                                {
                                    foreach ($cpp_detail->palet as $kunci => $palet) 
                                    {
                                        echo $cpp_detail->nolot."-".$palet->palet." , ";
                                    }
                                }
                                ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="p-2">
                            <div class="form-group">
                                <label for="">Kode Oracle</label>
                                <input class="form-control" type="text" id="kode_oracle" name="kode_oracle"  value="{{ $cpps->wo[0]->produk->kode_oracle }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Spek TS Minimal</label>
                                <input class="form-control" type="text" id="spek_ts_min" name="spek_ts_min" value="{{ number_format($cpps->wo[0]->produk->spek_ts_min, 2, '.', ',') }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Spek TS Maximal</label>
                                <input class="form-control" type="text" id="spek_ts_max" name="spek_ts_max" value="{{ number_format($cpps->wo[0]->produk->spek_ts_max,2,'.',',') }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Spek  PH Minimal</label>
                                <input class="form-control" type="text" id="spek_ph_min" name="spek_ph_min" value="{{ number_format($cpps->wo[0]->produk->spek_ph_min,2,'.',',') }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Spek  Maximal</label>
                                <input class="form-control" type="text" id="spek_ph_max" name="spek_ph_max" value="{{ number_format($cpps->wo[0]->produk->spek_ph_max,2,'.',',') }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="m-portlet">
                <h3 class="p-2 text-white d-flex justify-content-center" style="background: #716aca;">Data TS</h3>
                <div class="p-2">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="form-group">
                                <label for="">Awal</label>
                                <input type="text" class="form-control" id="ts_awal_1" onfocusout="ts_awal()" placeholder="Awal Pertama" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="5" required>
                                <input type="text" class="form-control mt-2" id="ts_awal_2" onfocusout="ts_awal()" placeholder="Awal Kedua" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="5" required>
                            </div>
                            <div class="form-group">
                                <label for="">Tengah</label>
                                <input type="text" class="form-control" id="ts_tengah_1" onfocusout="ts_tengah()" placeholder="Tengah Pertama" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="5" required>
                                <input type="text" class="form-control mt-2" id="ts_tengah_2" onfocusout="ts_tengah()" placeholder="Tengah Kedua" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="5" required>
                            </div>
                            <div class="form-group">
                                <label for="">Akhir</label>
                                <input type="text" class="form-control" id="ts_akhir_1" onfocusout="ts_akhir()" placeholder="Akhir Pertama" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="5" required>
                                <input type="text" class="form-control mt-2" id="ts_akhir_2" onfocusout="ts_akhir()" placeholder="Akhir Kedua" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="5" required>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label for="">Awal</label>
                                <textarea name=""  rows="3" class="form-control" readonly="true" id="ts_awal_sum"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Tengah</label>
                                <textarea name=""  rows="3" class="form-control" readonly="true" id="ts_tengah_sum"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Akhir</label>
                                <textarea name=""  rows="3" class="form-control" readonly="true" id="ts_akhir_sum"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="m-portlet">
                <h3 class="p-2 text-white d-flex justify-content-center" style="background: #716aca;">Data PH</h3>
                <div class="p-2">
                    <div class="form-group">
                        <label for="">Awal</label>
                        <input type="text" class="form-control" id="ph_awal" onfocusout="ubah_status_akhir()" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="4" required>
                    </div>
                    <div class="form-group">
                        <label for="">Tengah</label>
                        <input type="text" class="form-control" id="ph_tengah" onfocusout="ubah_status_akhir()" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="4" required >
                    </div>
                    <div class="form-group">
                        <label for="">Akhir</label>
                        <input type="text" class="form-control" id="ph_akhir" onfocusout="ubah_status_akhir()" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="4" required>
                    </div>
                </div>
            </div>  
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="m-portlet">
                <h3 class="p-2 text-white d-flex justify-content-center" style="background: #716aca;">Visco</h3>
                <div class="p-2">
                    <div class="form-group">
                        <label for="">Awal</label>
                        <input type="text" class="form-control" id="visco_awal" onfocusout="ubah_status_akhir()" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 || event.charCode == 101" maxlength="5" required>
                    </div>
                    <div class="form-group">
                        <label for="">Tengah</label>
                        <input type="text" class="form-control" id="visco_tengah" onfocusout="ubah_status_akhir()" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 || event.charCode == 101" maxlength="5" required>
                    </div>
                    <div class="form-group">
                        <label for="">Akhir</label>
                        <input type="text" class="form-control" id="visco_akhir" onfocusout="ubah_status_akhir()" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 || event.charCode == 101" maxlength="5" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="m-portlet">
                <h3 class="p-2 text-white d-flex justify-content-center" style="background: #716aca;">Sensory</h3>
                <div class="p-2">
                    <div class="form-group">
                        <label for="">Awal</label>
                        <select name="sensory_awal" onchange="ubah_status_akhir()" id="sensory_awal" class="form-control" required>
                            <option value="Pilih Status" selected disabled>Pilih Status</option>
                            <option value="OK">OK</option>
                            <option value="#OK">#OK</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Tengah</label>
                        <select name="sensory_tengah" onchange="ubah_status_akhir()" id="sensory_tengah" class="form-control" required>
                            <option value="Pilih Status" selected disabled>Pilih Status</option>
                            <option value="OK">OK</option>
                            <option value="#OK">#OK</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Akhir</label>
                        <select name="sensory_akhir" onchange="ubah_status_akhir()" id="sensory_akhir" class="form-control" required>
                            <option value="Pilih Status" selected disabled>Pilih Status</option>
                            <option value="OK">OK</option>
                            <option value="#OK">#OK</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="m-portlet">
                <h3 class="p-2 text-white d-flex justify-content-center" style="background: #716aca;">Jam Filling</h3>
                <div class="p-2">
                    <div class="form-group">
                        <label for="">Awal</label>
                        <input type="text" class="form-control datetimepickernya">
                    </div>
                    <div class="form-group">
                        <label for="">Tengah</label>
                        <input type="text" class="form-control datetimepickernya">
                    </div>
                    <div class="form-group">
                        <label for="">Akhir</label>
                        <input type="text" class="form-control datetimepickernya">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="m-portlet">
                <h3 class="p-2 text-white d-flex justify-content-center" style="background: #716aca;">Status Akhir</h3>
                <div class="p-2">
                    <div class="form-group">
                        <label for="">Status Akhir : </label>
                        <input type="text" readonly="true" class="form-control" id="status_akhir">
                    </div>
                    <div class="form-group">
                        <label for="">Nama Inspektor :</label>
                        <input type="text" class="form-control" value="{{ $username->fullname }}" readonly>
                    </div>
                </div>
            </div>
            <div class="float-right mb-5">
                <button class="btn text-white p-3" style="background: #716aca;">Simpan</button>
                <button class="btn text-white p-3" style="background: #716aca;">Save to draft</button>
            </div>
        </div>
    </div>
@endsection