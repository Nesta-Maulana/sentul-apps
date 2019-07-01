@extends('masterApps.templates.layout')
@section('title')
    Form Products
@endsection
@section('subtitle')
    Subtitle
@endsection
@section('active-brand')
    active
@endsection
@section('content')
<div class="box d-flex data-menu {{ Session::get('tambah') }}">
    <div class="container">
        {!! Form::open(['route' => 'produk-data', 'method' => 'POST']) !!}
            <input type="hidden" name="id" id="id">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="produk">Nama Produk : </label>
                        <input type="text" name="namaProduk" class="form-control" id="namaProduk">
                    </div>
                    <div class="form-group">
                        <label for="oracle">Kode Oracle : </label>
                        <input type="text" name="kodeOracle" class="form-control" id="kodeOracle">
                    </div>

                    <div class="form-group">
                        <label for="kode_trial">Kode Trial : </label>
                        <input type="text" name="kode_trial" class="form-control" id="kode_trial">
                    </div>
                    <div class="form-group">
                        <label for="spekTsMin">Spek TS Min : </label>
                        <input type="text" name="spekTsMin" class="form-control" id="spekTsMin">
                    </div>
                    <div class="form-group">
                        <label for="spekTsMax">Spek TS Max : </label>
                        <input type="text" name="spekTsMax" class="form-control" id="spekTsMax">
                    </div>

                    <div class="form-group">
                        <label for="brand">Sub Brand :</label>
                        <select name="brand" id="brand" class="form-control">
                            <option value="" selected disabled>-- PILIH SUB BRAND --</option>
                            @foreach($brands as $subbrand)
                                <option value="{{ $subbrand->id }}">{{ $subbrand->sub_brand }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="jenisProduk">Jenis Produk : </label>
                        <select name="jenisProduk" class="form-control" id="jenisProduk">
                            <option value="" selected disabled>-- PILIH JENIS PRODUK --</option>
                            @foreach($jenisProducts as $jenisProduct)
                                <option value="{{ $jenisProduct->id }}">{{ $jenisProduct->jenis_produk }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">

                    <div class="form-group">
                        <label for="spekPhMin">Spek PH Min : </label>
                        <input type="text" name="spekPhMin" class="form-control" id="spekPhMin">
                    </div>
                    <div class="form-group">
                        <label for="spekPhMax">Spek PH Max : </label>
                        <input type="text" name="spekPhMax" class="form-control" id="spekPhMax">
                    </div>
                    <div class="form-group">
                        <label for="sla">sla : </label>
                        <input type="text" name="sla" class="form-control" id="sla">
                    </div>
                    <div class="form-group">
                        <label for="waktuAnalisaMikro">Waktu Analisa Mikro : </label>
                        <input type="text" name="waktuAnalisaMikro" class="form-control" id="waktuAnalisaMikro">
                    </div>
                    <div class="form-group">
                        <label for="kelompokMesinFillingHead">Kelompok Mesing Fillng Head : </label>
                        <select name="kelompokMesinFillingHead" class="form-control" id="kelompokMesinFillingHead">
                            <option value="">-- PILIH MESIN FILLING HEAD --</option>
                            @foreach($mesinFillingHeads as $mesinFillingHead)
                                <option value="{{ $mesinFillingHead->id }}">{{ $mesinFillingHead->nama_kelompok }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status : </label>
                        <select  name="status" class="form-control" id="status">
                            <option value="" disabled selected> -- PILIH STATUS -- </option>
                            <option value="0">Tidak Aktif</option>
                            <option value="1">Aktif</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="expiredRange">Expired Range (dalam bulan): </label>
                        <input type="text" name="expiredRange" class="form-control" id="expiredRange">
                    </div>
                </div>
                <div class="p-2">
                    <button class=" btn btn-primary simpan">Simpan</button>
                    <button href="#" class="btn btn-primary update">update</button>
                    <a href="#" class="btn btn-danger batal">Batal</a>
                </div>            
            </div>
                <table class="display nowrap" id="table-produk" width= "100%">
                    <thead >
                        <tr>
                            <th>#</th>
                            <th>Brand</th>
                            <th>Nama Produk</th>
                            <th>Kode Oracle</th>
                            <th>Spek TS Min</th>
                            <th>Spek TS Max</th>
                            <th>Spek PH Min</th>
                            <th>Spek PH Max</th>
                            <th>Sla (dalam Hari)</th>
                            <th>Waktu Analisa Mikro</th>
                            <th>Kelompok Mesin Filling Head</th>
                            <th>Jenis Produk</th>
                            <th>Status</th>
                            <th>aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1 ?>
                        @foreach($products as $product)
                        <?php $id=app('App\Http\Controllers\resourceController')->enkripsi($product->id) ?>
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $product->subbrand->sub_brand }}</td>
                                <td>{{ $product->nama_produk }}</td>
                                <td>{{ $product->kode_oracle }}</td>
                                <td>{{ $product->spek_ts_min }}</td>
                                <td>{{ $product->spek_ts_max }}</td>
                                <td>{{ $product->spek_ph_min }}</td>
                                <td>{{ $product->spek_ph_max }}</td>
                                <td>{{ $product->sla }}</td>
                                <td>{{ $product->waktu_analisa_mikro }}</td>
                                @if ($product->kelompok_mesin_filling_head_id === 0)
                                    <td>Yobase</td>
                                @else
                                    <td>@foreach ($product->mesinFillingHead->mesinFillingDetail as $detail){{ $detail->mesinFilling->nama_mesin }} @endforeach
                                    </td>   
                                @endif
                                {{-- <td>{{ $product->kelompok_mesin_filling_head_id }}</td> --}}
                                <td>{{ $product->jenisProduk->jenis_produk }}</td>
                                @if($product->status == '0')
                                    <td>Tidak Aktif</td>
                                @else
                                    <td>Aktif</td>
                                @endif
                                <td>
                                    <a href="#" class="btn btn-primary edit" onclick="edit('{{ $id }}')">Edit</a>
                                    <a href="delete/mysql4/produk/{{$product->id}}" class="text-white btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            <?php $i++ ?>
                        @endforeach
                    </tbody>
                </table>
        {!! Form::close() !!}
    </div>
</div>
<script>
    
    $('.update').hide();
    $('.batal').hide();
    function edit(id){
        $.ajax({
            url: '/sentul-apps/master-apps/produk/edit/' + id,
            method: 'GET',
            dataType: 'JSON',
            success: function (data) {
                
                $('#namaProduk').val(data[0].nama_produk);
                $('#kodeOracle').val(data[0].kode_oracle);
                $('#spekTsMin').val(data[0].spek_ts_min);
                $('#spekTsMax').val(data[0].spek_ts_max);
                $('#spekPhMin').val(data[0].spek_ph_min);
                $('#spekPhMax').val(data[0].spek_ph_max);
                $('#sla').val(data[0].sla);
                $('#waktuAnalisaMikro').val(data[0].waktu_analisa_mikro);
                var td = '<option disabled>-- PILIH BRANDS --</option>';
                for (index = 0; index < data[1].length; index++) 
                {   
                    if(data[0].brand_id == data[1][index].id){
                        td+='<option value="'+ data[1][index].id +'" selected>'+data[1][index].brand+'</option>';
                    }else{
                        td+='<option  value="'+data[1][index].id+'">'+data[1][index].brand+'</option>';
                    }
                }
                $('#brand').html(td).on('change');
                var td = '<option disabled>-- PILIH MESIN FILLING HEAD --</option>';
                for (index = 0; index < data[3].length; index++) 
                {   
                    if(data[0].kelompok_mesin_filling_head_id == data[3][index].id){
                        td+='<option value="'+ data[3][index].id +'" selected>'+data[3][index].nama_kelompok+'</option>';
                    }else{
                        td+='<option  value="'+data[3][index].id+'">'+data[3][index].nama_kelompok+'</option>';
                    }
                }
                $('#kelompokMesinFillingHead').html(td).on('change');
                var td = '<option disabled>-- PILIH JENIS PRODUK --</option>';
                for (index = 0; index < data[2].length; index++) 
                {   
                    if(data[0].jenis_produk_id == data[2][index].id){
                        td+='<option value="'+ data[2][index].id +'" selected>'+data[2][index].jenis_produk+'</option>';
                    }else{
                        td+='<option  value="'+data[2][index].id+'">'+data[2][index].jenis_produk+'</option>';
                    }
                }
                $('#jenisProduk').html(td).on('change');
                $('.update').show();
                $('.batal').show();
                $('.simpan').hide();
                $('#id').val(data[0].id);
                $("#status option[value= '" + data[0].status + "']").prop('selected', true);
            }
        })
    }   
    $('.batal').click(function () {
        $('#id').val("");
        $('#namaProduk').val(" ");
        $('#kodeOracle').val(" ");
        $('#spekTsMin').val(" ");
        $('#spekTsMax').val(" ");
        $('#spekPhMin').val(" ");
        $('#spekPhMax').val(" ");
        $('#jenisProduk').val(" ");
        $('#kelompokMesinFillingHead').val(" ");
        $('#sla').val(" ");
        $('#waktuAnalisaMikro').val(" ");
        $('#brand option[value=" "]').prop("selected", true);
        $('.update').hide();
        $('.batal').hide();
        $('.simpan').show();
    })
</script>
@endsection