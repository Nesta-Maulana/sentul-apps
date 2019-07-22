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
    {!! Form::open(['route'=>'input-analisa-kimia','enctype'=>'multipart/form-data','method'=>'post']) !!}
        <div class="row">
            <div class="col-lg-12">
                <div class="m-portlet">
                    <h3 class="d-flex justify-content-center p-2 text-white" style="background: #716aca;">Detail Produk</h3>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="p-2">
                                <div class="form-group">
                                    <label for="">Nama Produk</label>
                                    <input class="form-control" type="text" name="nama_produk" value="{{ $cpps->wo[0]->produk->nama_produk }}" readonly>
                                    <input class="form-control" type="hidden" name="cpp_head_id" value="{{ app('App\Http\Controllers\resourceController')->enkripsi($cpps->id) }}" readonly>
                                    <input class="form-control" type="hidden" name="analisa_kimia_id" @if (!is_null($cpps->analisaKimia))
                                        value="{{ app('App\Http\Controllers\resourceController')->enkripsi($cpps->analisaKimia->id) }}"
                                    @else
                                        value=""
                                    @endif readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Tgl Produksi</label>
                                    <input class="form-control" type="date" value="{{ $cpps->wo[0]->production_realisation_date }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Nomor WO</label>
                                    <textarea class="form-control" name="nomor_wo" id="" rows="3" readonly>@foreach ($cpps->wo as $wo) <?=$wo->nomor_wo."&#13;&#10;"?> @endforeach</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Nomor LOT</label>
                                    <textarea class="form-control" name="nomor_lot" id="" rows="3" readonly><?php
                                    $paletjam   =array();
                                    foreach ($cpps->cppDetail as $key => $cpp_detail) 
                                    {
                                        foreach ($cpp_detail->palet as $kunci => $palet) 
                                        {
                                            array_push($paletjam, $palet);
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
                                    <input type="text" class="form-control" id="ts_awal_1" name="ts_awal_1" @if (!is_null($cpps->analisaKimia))
                                        value="{{ $cpps->analisaKimia->ts_awal_1 }}" 
                                    @endif onfocusout="ts_awal()" placeholder="Awal Pertama" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="5" required>
                                    <input type="text" class="form-control mt-2" id="ts_awal_2" name="ts_awal_2" @if (!is_null($cpps->analisaKimia))
                                        value="{{ $cpps->analisaKimia->ts_awal_2 }}" 
                                    @endif onfocusout="ts_awal()" placeholder="Awal Kedua" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="5" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Tengah</label>
                                    <input type="text" class="form-control" id="ts_tengah_1" name="ts_tengah_1" @if (!is_null($cpps->analisaKimia))
                                        value="{{ $cpps->analisaKimia->ts_tengah_1 }}" 
                                    @endif onfocusout="ts_tengah()" placeholder="Tengah Pertama" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="5" required>
                                    <input type="text" class="form-control mt-2" id="ts_tengah_2" name="ts_tengah_2" @if (!is_null($cpps->analisaKimia))
                                        value="{{ $cpps->analisaKimia->ts_tengah_2 }}" 
                                    @endif onfocusout="ts_tengah()" placeholder="Tengah Kedua" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="5" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Akhir</label>
                                    <input type="text" class="form-control" id="ts_akhir_1" name="ts_akhir_1" @if (!is_null($cpps->analisaKimia))
                                        value="{{ $cpps->analisaKimia->ts_akhir_1 }}" 
                                    @endif onfocusout="ts_akhir()" placeholder="Akhir Pertama" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="5" required>
                                    <input type="text" class="form-control mt-2" id="ts_akhir_2" name="ts_akhir_2" @if (!is_null($cpps->analisaKimia))
                                        value="{{ $cpps->analisaKimia->ts_akhir_2 }}" 
                                    @endif onfocusout="ts_akhir()" placeholder="Akhir Kedua" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="5" required>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="">Awal</label>
                                    <textarea name="ts_awal_sum"  rows="3" class="form-control" readonly="true" id="ts_awal_sum">@if (!is_null($cpps->analisaKimia)){{ $cpps->analisaKimia->ts_awal_sum }}@endif</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Tengah</label>
                                    <textarea name="ts_tengah_sum"  rows="3" class="form-control" readonly="true" id="ts_tengah_sum">@if (!is_null($cpps->analisaKimia)){{ $cpps->analisaKimia->ts_tengah_sum }}@endif</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Akhir</label>
                                    <textarea name="ts_akhir_sum"  rows="3" class="form-control" readonly="true" id="ts_akhir_sum">@if (!is_null($cpps->analisaKimia)){{ $cpps->analisaKimia->ts_akhir_sum }}@endif</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="m-portlet">
                    <h3 class="p-2 text-white d-flex justify-content-center" style="background: #716aca;">Kode Batch Standar</h3>
                    <div class="p-2" style="padding: 0.2rem !important">
                        <div class="form-group">
                            <input type="text" class="form-control" id="kode_batch" onfocusout="ubah_status_akhir()" maxlength="7" required placeholder="Ex: TC0901C" name="kode_batch" @if (!is_null($cpps->analisaKimia))
                                value="{{ $cpps->analisaKimia->kode_batch_standar }}"
                            @endif style="text-transform: uppercase;">
                        </div>
                    </div>
                </div>  
                <div class="m-portlet">
                    <h3 class="p-2 text-white d-flex justify-content-center" style="background: #716aca;">Data PH</h3>
                    <div class="p-2" >
                        <div class="form-group">
                            <label for="">Awal</label>
                            <input type="text" class="form-control" name="ph_awal" @if (!is_null($cpps->analisaKimia))
                                value="{{ $cpps->analisaKimia->ph_awal }}"}}
                            @endif id="ph_awal" onfocusout="ubah_status_akhir()" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="4" required>
                        </div>
                        <div class="form-group">
                            <label for="">Tengah</label>
                            <input type="text" class="form-control" name="ph_tengah" @if (!is_null($cpps->analisaKimia))
                                value="{{ $cpps->analisaKimia->ph_tengah }}"}}
                            @endif id="ph_tengah" onfocusout="ubah_status_akhir()" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="4" required >
                        </div>
                        <div class="form-group">
                            <label for="">Akhir</label>
                            <input type="text" class="form-control" name="ph_akhir" @if (!is_null($cpps->analisaKimia))
                                value="{{ $cpps->analisaKimia->ph_akhir }}"}}
                            @endif id="ph_akhir" onfocusout="ubah_status_akhir()" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 " maxlength="4" required>
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
                            <input type="text" class="form-control" style="text-transform: uppercase;" name="visco_awal" @if (!is_null($cpps->analisaKimia))
                                value="{{ $cpps->analisaKimia->visco_awal }}"
                            @endif id="visco_awal" onfocusout="ubah_status_akhir()" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 || event.charCode == 101" maxlength="5"  required>
                        </div>
                        <div class="form-group">
                            <label for="">Tengah</label>
                            <input type="text" class="form-control" style="text-transform: uppercase;" name="visco_tengah" @if (!is_null($cpps->analisaKimia))
                                value="{{ $cpps->analisaKimia->visco_tengah }}"
                            @endif id="visco_tengah" onfocusout="ubah_status_akhir()" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 || event.charCode == 101" maxlength="5"  required>
                        </div>
                        <div class="form-group">
                            <label for="">Akhir</label>
                            <input type="text" class="form-control" style="text-transform: uppercase;" name="visco_akhir" @if (!is_null($cpps->analisaKimia))
                                value="{{ $cpps->analisaKimia->visco_akhir }}"
                            @endif id="visco_akhir" onfocusout="ubah_status_akhir()" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47 || event.charCode == 101" maxlength="5"  required>
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
                                <option value="OK" @if (!is_null($cpps->analisaKimia)) @if ($cpps->analisaKimia->sensory_awal == 'OK') selected @endif @endif>OK</option>
                                <option value="#OK" @if (!is_null($cpps->analisaKimia)) @if ($cpps->analisaKimia->sensory_awal == '#OK') selected @endif @endif>#OK</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Tengah</label>
                            <select name="sensory_tengah" onchange="ubah_status_akhir()" id="sensory_tengah" class="form-control" required>
                                <option value="Pilih Status" selected disabled>Pilih Status</option>
                                <option value="OK" @if (!is_null($cpps->analisaKimia)) @if ($cpps->analisaKimia->sensory_tengah == 'OK') selected @endif @endif>OK</option>
                                <option value="#OK" @if (!is_null($cpps->analisaKimia)) @if ($cpps->analisaKimia->sensory_tengah == '#OK') selected @endif @endif>#OK</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Akhir</label>
                            <select name="sensory_akhir" onchange="ubah_status_akhir()" id="sensory_akhir" class="form-control" required>
                                <option value="Pilih Status" selected disabled>Pilih Status</option>
                                <option value="OK" @if (!is_null($cpps->analisaKimia)) @if ($cpps->analisaKimia->sensory_akhir == 'OK') selected @endif @endif>OK</option>
                                <option value="#OK" @if (!is_null($cpps->analisaKimia)) @if ($cpps->analisaKimia->sensory_tengah == '#OK') selected @endif @endif>#OK</option>
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
                            <input type="text" name="jam_filling_awal" class="form-control datetimepickernya" value="{{ $paletjam[0]->start }}">
                        </div>
                        <div class="form-group">
                            <label for="">Tengah</label>
                            <input type="text" name="jam_filling_tengah" @if (!is_null($cpps->analisaKimia)) value="{{ $cpps->analisaKimia->jam_filling_tengah }}" @endif class="form-control datetimepickernya">
                        </div>
                        <div class="form-group">
                            <label for="">Akhir</label>
                            <input type="text" name="jam_filling_akhir" class="form-control datetimepickernya" value="{{ $paletjam[count($paletjam)-1]->end }}">
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
                            <input type="text" @if (!is_null($cpps->analisaKimia)) value="{{ $cpps->analisaKimia->keterangan }}" @endif readonly="true" class="form-control" id="status_akhir" name="status_akhir" >
                        </div>
                        <div class="form-group">
                            <label for="">Nama Inspektor :</label>
                            <input type="text" class="form-control" name="fullname_input" value="{{ $username->fullname }}" readonly>
                            <input type="hidden" class="form-control" name="user_inputer_id" value="{{ app('App\Http\Controllers\resourceController')->enkripsi($username->user->id) }}" readonly>
                        </div>
                    </div>
                </div>
                <div class="float-right mb-5">
                    <button class="btn text-white p-3" style="background: #716aca;" name="simpan" value="simpan">Simpan</button>
                    <button class="btn text-white p-3" style="background: #716aca;" name="simpan" value="draft">Save to draft</button>
                </div>

            </div>
        </div>
        {!! Form::close() !!}
@endsection
