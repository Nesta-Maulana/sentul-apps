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
        <div class="box-header">
            
        </div>
        {!! Form::open(['route' => 'produk-data', 'method' => 'POST']) !!}
            <input type="hidden" name="id" id="id">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="brand">Brand :</label>
                        <select name="brand" id="brand" class="form-control select2">
                            <option value="" selected disabled>-- PILIH BRAND --</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->brand }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="produk">Nama Produk : </label>
                        <input type="text" name="namaProduk" class="form-control" id="namaProduk">
                    </div>
                    <div class="form-group">
                        <label for="oracle">Kode Oracle : </label>
                        <input type="text" name="kodeOracle" class="form-control" id="kodeOracle">
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
                        <label for="spekPhMin">Spek PH Min : </label>
                        <input type="text" name="spekPhMin" class="form-control" id="spekPhMin">
                    </div>
                </div>
                <div class="col-lg-6">
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
                        <select name="kelompokMesinFillingHead" class="form-control select2" id="kelompokMesinFillingHead">
                            <option value="">-- PILIH MESIN FILLING HEAD --</option>
                            @foreach($mesinFillingHeads as $mesinFillingHead)
                                <option value="{{ $mesinFillingHead->id }}">{{ $mesinFillingHead->nama_kelompok }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jenisProduk">Jenis Produk : </label>
                        <select name="jenisProduk" class="form-control select2" id="jenisProduk">
                            <option value="" selected disabled>-- PILIH JENIS PRODUK --</option>
                            @foreach($jenisProducts as $jenisProduct)
                                <option value="{{ $jenisProduct->id }}">{{ $jenisProduct->jenis_produk }}</option>
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
                </div>
                <div class="p-2">
                    <button class=" btn btn-primary simpan">Simpan</button>
                    <button href="#" class="btn btn-primary update">update</button>
                    <a href="#" class="btn btn-danger batal">Batal</a>
                </div>            
                <table class="table text-center table-bordered table-striped">
                    <thead class="dark">
                        <tr>
                            <td>#</td>
                            <td>Brand</td>
                            <td>Nama Produk</td>
                            <td>Kode Oracle</td>
                            <td>Spek TS Min</td>
                            <td>Spek TS Max</td>
                            <td>Spek PH Min</td>
                            <td>Spek PH Max</td>
                            <td>Sla (dalam Hari)</td>
                            <td>Waktu Analisa Mikro</td>
                            <td>Kelompok Mesin Filling Head</td>
                            <td>Jenis Produk</td>
                            <td>Status</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1 ?>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $product->brand->brand }}</td>
                                <td>{{ $product->nama_produk }}</td>
                                <td>{{ $product->kode_oracle }}</td>
                                <td>{{ $product->spek_ts_min }}</td>
                                <td>{{ $product->spek_ts_max }}</td>
                                <td>{{ $product->spek_ph_min }}</td>
                                <td>{{ $product->spek_ph_max }}</td>
                                <td>{{ $product->sla }}</td>
                                <td>{{ $product->waktu_analisa_mikro }}</td>
                                <td>{{ $product->mesinFillingHead->nama_kelompok }}</td>
                                <td>{{ $product->jenisProduk->jenis_produk }}</td>
                                @if($product->status == '0')
                                    <td>Tidak Aktif</td>
                                @else
                                    <td>Aktif</td>
                                @endif
                                <td><a href="#" class="btn btn-primary edit" onclick="edit('{{ $product->id }}')">Edit</a></td>
                            </tr>
                            <?php $i++ ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
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