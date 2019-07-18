@extends('rollie.inspektor.template.layout2')

@section('subheader')
    <h2 class="text-center">ROLLIE | PPQ - FG</h2>
@endsection
@section('content')
    {{-- {{ dd($cpp_detail) }} --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="m-portlet">
                {!! Form::open(['route'=>'ppq-fg-input','enctype'=>'multipart/form-data','method'=>'post']) !!}
                    <h3 class="text-white back-purple p-3 text-center">Input PPQ FG</h3>
                    <input type="hidden" name="jenis_ppq" value="{{ $data['jenis_ppq'] }}">
                    <input type="hidden" name="user_inputer_id" value="{{ $username['id'] }}">
                    <input type="hidden" name="rpd_filling_head_id" value="{{ $data['rpd_filling_head_id'] }}">
                    <div class="row p-3">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Nomor PPQ</label>
                                <input type="text" class="form-control" name="nomor_ppq" readonly="true" placeholder="Nomor PPQ" value="{{ $data['nomor_ppq'] }}">
                            </div>
                            <div class="form-group">
                                <label for="">No WO</label>
                                <input type="text" name="nomor_wo" value="{{ $data['nomor_wo'] }}" readonly class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Nama Produk</label>
                                <input type="text" name="nama_produk" value="{{ $data['nama_produk'] }}" readonly class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Kode Oracle</label>
                                <input type="text" class="form-control" name="kode_oracle" readonly="true" placeholder="Kode Oracle" value="{{ $data['kode_oracle'] }}">
                            </div>
                            <div class="form-group">
                                <label for="">Tanggal Produksi</label>
                                <input type="text" name="tanggal_produksi" value="{{ $data['tanggal_produksi'] }}" readonly class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Tanggal PPQ FG</label>
                                <input type="text" name="tanggal_ppq" value="{{ $data['tanggal_ppq'] }}" readonly class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Mesin Filling</label>
                                <input type="text" name="mesin_filling" value="{{ $data['mesin_filling'] }}" readonly class="form-control">
                                <input type="hidden" name="mesin_filling_id" value="{{ $data['mesin_filling_id'] }}" readonly class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Nomor LOT</label>
                                <input type="text" class="form-control" name="nomor_lot" value="@foreach ($data['palet'] as $value){{ $value->cpp_detail->nolot }}-{{ $value->palet }}, @endforeach" readonly>
                                <input type="hidden" class="form-control" name="nomor_lot_id" value="@foreach ($data['palet'] as $value){{ $value->id }},@endforeach">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Jam Filling Awal PPQ : </label>
                                <input type="text" class="form-control" name="jam_filling_mulai"    placeholder="Jam Filiing Awal" value="{{ $data['jam_filling_mulai'] }} "readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Jam Filling Akhir PPQ : </label>
                                <input type="text" class="form-control"  name="jam_filling_akhir" value="{{ $data['jam_filling_akhir'] }} "readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Jumlah (pack) : </label>
                                <input type="text" class="form-control" name="jumlah_pack" value="{{ $data['jumlah_pack'] }}">
                            </div>
                            <div class="form-group">
                                <label for="">Alasan PPQ : </label>
                                <textarea class="form-control" inputmode="url" name="alasan_ppq" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Detail Titik PPQ : </label>
                                <textarea class="form-control" name="detail_titik_ppq" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Kategori PPQ : </label>
                                <select name="kategori_ppq_value" class="form-control" name="kategori_ppq_value" required>
                                    <option value="" selected disabled> Pilih Kategori PPQ </option>
                                    <option value="0"> Man </option>
                                    <option value="1"> Machine </option>
                                    <option value="2"> Methode </option>
                                    <option value="3"> Material </option>
                                    <option value="4"> Environment </option>
                                    <option value="5"> Sortasi </option>
                                    <option value="6"> Miss Handling </option>
                                    <option value="7"> Lain-lain </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">PIC Input: </label>
                                <input type="text" class="form-control" value="{{ $username->fullname }}" readonly>
                            </div>
                                <button class="btn back-purple text-white pt-3 pb-3 pr-5 pl-5 float-right mt-auto">Kirim</button>                        
                        </div>
                    </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection