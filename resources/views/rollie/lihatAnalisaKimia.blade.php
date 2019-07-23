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
    ROLLIE | Analisa Kimia FG {{ $analisa_kimia->cppHead->produk->nama_produk }} <hr>
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
                                    <input class="form-control" type="text" name="nama_produk" value="{{ $analisa_kimia->cppHead->produk->nama_produk }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="">Tgl Produksi</label>
                                    <input class="form-control" type="date" value="{{ $analisa_kimia->cppHead->wo[0]->production_realisation_date }}" readonly>
                                </div>
                                
                                <div class="form-group">
                                    <label for="">Nomor WO</label>
                                    <textarea class="form-control" name="nomor_wo" id="" rows="3" readonly>@foreach ($analisa_kimia->cppHead->wo as $wo) <?=$wo->nomor_wo."&#13;&#10;"?>@endforeach</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="p-2">
                                <div class="form-group">
                                    <label for="">Kode Oracle</label>
                                    <input class="form-control" type="text" name="kode_oracle" value="{{ $analisa_kimia->cppHead->produk->kode_oracle }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Kode Batch Standar</label>
                                    <input class="form-control" type="text" value="{{ $analisa_kimia->kode_batch_standar }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Nomor Lot</label>
                                    <textarea class="form-control" name="nomor_lot" id="" rows="3" readonly><?php
                                    $paletfix   = '';
                                    foreach ($analisa_kimia->cppHead->cppDetail as $key => $cpp_detail) 
                                    {
                                        foreach ($cpp_detail->palet as $kunci => $palet) 
                                        {
                                             $paletfix .= $cpp_detail->nolot."-".$palet->palet." ,";
                                        }
                                    }
                                        $paletfix     = rtrim($paletfix,',');
                                        echo $paletfix;

                                    ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
        <div class="row m-portlet">
            <div class="col-lg-5">
                <div class="m-portlet">
                    <h3 class="p-2 text-white d-flex justify-content-center" style="background: #716aca;">Data TS</h3>
                    <div class="p-2">
                        <div class="row">
                            <div class="col-lg-6">
                                 <div class="form-group">
                                    <label for="">Spek TS min.</label>
                                    <input type="text" class="form-control" id="ts_awal_1" name="ts_awal_1"  value="{{ number_format($analisa_kimia->cppHead->produk->spek_ts_min, 2, '.', ',') }}" readonly>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                 <div class="form-group">
                                    <label for="">Spek TS max.</label>
                                    <input type="text" class="form-control" id="ts_awal_1" name="ts_awal_1" value="{{ number_format($analisa_kimia->cppHead->produk->spek_ts_max,2,'.',',') }}"  readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">TS Awal</label>
                                    <input type="text" class="form-control" id="ts_awal_1" name="ts_awal_1" value="{{ number_format($analisa_kimia->ts_awal_1,2,'.',',') }}"  readonly>
                                    <input type="text" class="form-control mt-2" id="ts_awal_1" name="ts_awal_1" value="{{ number_format($analisa_kimia->ts_awal_2,2,'.',',') }}"  readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                 <div class="form-group">
                                    <label for="">X&#x0304; TS Awal</label>
                                    <textarea name="ts_awal_sum"  rows="3" class="form-control" readonly="true" id="ts_awal_sum" @if ($analisa_kimia->ts_awal_sum >= $analisa_kimia->cppHead->produk->spek_ts_min && $analisa_kimia->ts_awal_sum <= $analisa_kimia->cppHead->produk->spek_ts_max)
                                        style="background-color: #8affaa;color: black"
                                    @else
                                    style="background-color: #ff8a8a;color: black"
                                    @endif>{{ number_format($analisa_kimia->ts_awal_sum,2,'.',',') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">TS Tengah</label>
                                    <input type="text" class="form-control" id="ts_awal_1" name="ts_awal_1" value="{{ number_format($analisa_kimia->ts_tengah_1,2,'.',',') }}"  placeholder="Tengah Pertama" readonly>
                                    <input type="text" class="form-control mt-2" id="ts_awal_1" name="ts_awal_1" value="{{ number_format($analisa_kimia->ts_tengah_2,2,'.',',') }}"  placeholder="Tengah Pertama" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                 <div class="form-group">
                                    <label for="">X&#x0304; TS Tengah</label>
                                    <textarea name="ts_awal_sum"  rows="3" class="form-control" readonly="true" id="ts_awal_sum" @if ($analisa_kimia->ts_tengah_sum >= $analisa_kimia->cppHead->produk->spek_ts_min && $analisa_kimia->ts_tengah_sum <= $analisa_kimia->cppHead->produk->spek_ts_max)
                                        style="background-color: #8affaa;color: black"
                                    @else
                                    style="background-color: #ff8a8a;color: black"
                                    @endif>{{ number_format($analisa_kimia->ts_tengah_sum,2,'.',',') }}</textarea>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">TS Akhir</label>
                                    <input type="text" class="form-control" id="ts_awal_1" name="ts_awal_1" value="{{ number_format($analisa_kimia->ts_akhir_1,2,'.',',') }}"  placeholder="Akhir Pertama" readonly>
                                    <input type="text" class="form-control mt-2" id="ts_awal_1" name="ts_awal_1" value="{{ number_format($analisa_kimia->ts_awal_2,2,'.',',') }}"  placeholder="Akhir Pertama" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                 <div class="form-group">
                                    <label for="">X&#x0304; TS Akhir</label>
                                    <textarea name="ts_awal_sum"  rows="3" class="form-control" readonly="true" id="ts_awal_sum"  @if ($analisa_kimia->ts_akhir_sum >= $analisa_kimia->cppHead->produk->spek_ts_min && $analisa_kimia->ts_akhir_sum <= $analisa_kimia->cppHead->produk->spek_ts_max)
                                        style="background-color: #8affaa;color: black"
                                    @else
                                    style="background-color: #ff8a8a;color: black"
                                    @endif>{{ number_format($analisa_kimia->ts_akhir_sum,2,'.',',') }}</textarea>
                                    
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
                        <div class="row">
                            <div class="col-lg-6">
                                 <div class="form-group">
                                    <label for="">Spek pH min.</label>
                                    <input type="text" class="form-control" id="ts_awal_1" name="ts_awal_1" value="{{ number_format($analisa_kimia->cppHead->produk->spek_ph_min,2,'.',',') }}"  readonly>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                 <div class="form-group">
                                    <label for="">Spek pH max.</label>
                                    <input type="text" class="form-control" id="ts_awal_1" name="ts_awal_1" value="{{ number_format($analisa_kimia->cppHead->produk->spek_ph_max,2,'.',',') }}"  readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                 <div class="form-group">
                                    <label for="">pH awal</label>
                                    <input type="text" class="form-control" id="ts_awal_1" name="ts_awal_1" value="{{ number_format($analisa_kimia->ph_awal,2,'.',',') }}" @if ($analisa_kimia->ph_awal >= $analisa_kimia->cppHead->produk->spek_ph_min && $analisa_kimia->ph_awal <= $analisa_kimia->cppHead->produk->spek_ph_max)
                                        style="background-color: #8affaa;color: black"
                                    @else
                                        style="background-color: #ff8a8a;color: black"
                                    @endif  readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                 <div class="form-group">
                                    <label for="">pH tengah</label>
                                    <input type="text" class="form-control" id="ts_tengah_1" name="ts_tengah_1" value="{{ number_format($analisa_kimia->ph_tengah,2,'.',',') }}" @if ($analisa_kimia->ph_tengah >= $analisa_kimia->cppHead->produk->spek_ph_min && $analisa_kimia->ph_tengah <= $analisa_kimia->cppHead->produk->spek_ph_max)
                                        style="background-color: #8affaa;color: black"
                                    @else
                                        style="background-color: #ff8a8a;color: black"
                                    @endif onfocusout="ts_tengah()" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                 <div class="form-group">
                                    <label for="">pH Akhir</label>
                                    <input type="text" class="form-control" id="ts_Akhir_1" name="ts_Akhir_1" value="{{ number_format($analisa_kimia->ph_akhir,2,'.',',') }}" @if ($analisa_kimia->ph_akhir >= $analisa_kimia->cppHead->produk->spek_ph_min && $analisa_kimia->ph_akhir <= $analisa_kimia->cppHead->produk->spek_ph_max)
                                        style="background-color: #8affaa;color: black"
                                    @else
                                        style="background-color: #ff8a8a;color: black"
                                    @endif onfocusout="ts_Akhir()" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
            <div class="col-lg-3">
                <div class="m-portlet">
                    <h3 class="p-2 text-white d-flex justify-content-center" style="background: #716aca;">Data Sensori</h3>
                    <div class="p-2">
                        <div class="row">
                            <div class="col-lg-12">
                                 <div class="form-group">
                                    <label for="">Sensori awal</label>
                                    <input type="text" class="form-control" id="ts_awal_1" name="ts_awal_1" value="{{ $analisa_kimia->sensory_awal }}"  @if ($analisa_kimia->sensory_awal == 'OK')
                                        style="background-color: #8affaa;color: black"
                                    @else
                                        style="background-color: #ff8a8a;color: black"
                                    @endif readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                 <div class="form-group">
                                    <label for="">Sensori tengah</label>
                                    <input type="text" class="form-control" id="ts_tengah_1" name="ts_tengah_1" value="{{ $analisa_kimia->sensory_tengah }}" onfocusout="ts_tengah()" @if ($analisa_kimia->sensory_tengah == 'OK')
                                        style="background-color: #8affaa;color: black"
                                    @else
                                        style="background-color: #ff8a8a;color: black"
                                    @endif readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                 <div class="form-group">
                                    <label for="">Sensori Akhir</label>
                                    <input type="text" class="form-control" id="ts_Akhir_1" name="ts_Akhir_1" value="{{ $analisa_kimia->sensory_akhir }}" onfocusout="ts_Akhir()" @if ($analisa_kimia->sensory_akhir == 'OK')
                                        style="background-color: #8affaa;color: black"
                                    @else
                                        style="background-color: #ff8a8a;color: black"
                                    @endif readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
                
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="m-portlet">
                    <h3 class="p-2 text-white d-flex justify-content-center" style="background: #716aca;">Data Visco</h3>
                    <div class="p-2">
                        <div class="row">
                            <div class="col-lg-12">
                                 <div class="form-group">
                                    <label for="">Visco awal</label>
                                    <input type="text" class="form-control" id="ts_awal_1" name="ts_awal_1" value="{{ $analisa_kimia->visco_awal }}"  readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                 <div class="form-group">
                                    <label for="">Visco tengah</label>
                                    <input type="text" class="form-control" id="ts_tengah_1" name="ts_tengah_1" value="{{ $analisa_kimia->visco_tengah }}" onfocusout="ts_tengah()" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                 <div class="form-group">
                                    <label for="">Visco Akhir</label>
                                    <input type="text" class="form-control" id="ts_Akhir_1" name="ts_Akhir_1" value="{{ $analisa_kimia->visco_akhir }}" onfocusout="ts_Akhir()" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="col-lg-4">
                <div class="m-portlet">
                    <h3 class="p-2 text-white d-flex justify-content-center" style="background: #716aca;">Jam Filling</h3>
                    <div class="p-2">
                        <div class="form-group">
                            <label for="">Awal</label>
                            <input type="text" name="jam_filling_awal" class="form-control datetimepickernya" value="{{ $analisa_kimia->jam_filling_awal }}" readonly="">
                        </div>
                        <div class="form-group">
                            <label for="">Tengah</label>
                            <input type="text" name="jam_filling_tengah" value="{{ $analisa_kimia->jam_filling_tengah }}" readonly="" class="form-control datetimepickernya">
                        </div>
                        <div class="form-group">
                            <label for="">Akhir</label>
                            <input type="text" name="jam_filling_akhir" class="form-control datetimepickernya" value="{{ $analisa_kimia->jam_filling_akhir }}" readonly="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="m-portlet">
                    <h3 class="p-2 text-white d-flex justify-content-center" style="background: #716aca;">Status Akhir</h3>
                    <div class="p-2">
                        <div class="form-group">
                            <label for="">Status Akhir : </label>
                            <input type="text" value="{{ $analisa_kimia->keterangan }}" readonly="true" class="form-control" id="status_akhir" name="status_akhir" @if ($analisa_kimia->status_akhir =='OK')
                                style="background-color: #8affaa;color: black" @else style="background-color: #ff8a8a;color: black"
                            @endif >
                        </div>
                        <div class="form-group">
                            <label for="">Nama Inspektor :</label>
                            <input type="text" class="form-control" name="fullname_input" value="{{ $analisa_kimia->user->karyawan->fullname }}" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
@endsection
