@extends('masterApps.templates.layout')
@section('title')
    Master Apps
@endsection
@section('subtitle')
    Rasio
@endsection
@section('content')

    {{ csrf_field() }}
    <div class="form-group">
        <label for="kategori" class="mr-5">Pilih Kategori : &ensp;</label>
        <select name="kategori" id="kategori" class="css-input">
            <option value="" disabled selected>-- PILIH KATEGORI --</option>
            @foreach($kategori as $k)
                <option value="{{ $k->id }}">{{ $k->kategori }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="workcenter" class="mr-3">Pilih Workcenter : &emsp;</label>
        <select name="workcenter" id="workcenter" class="css-input">
            <option value="" disabled selected>-- PILIH WORKCENTER --</option>
        </select>
    </div>
    <div class="form-group">
        <label for="bagian" class="mr-5">Pilih Bagian : &emsp;</label>
        <select name="bagian" id="bagian" class="css-input">
            <option value="" disabled selected>-- PILIH BAGIAN --</option>
        </select>
    </div>
    <div class="row">
        <div class="col-lg-3 mr-4">
            <button class="btn btn-primary mb-3 pr-5 pl-5" id="save">Please Select All of Checkbox</button>
        </div>
        <div class="col-lg-2">
            <button class="btn btn-primary mb-3 mr-5" id="tambahCompany">Tambah Company</button>
        </div>
    </div>
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
             @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
             @endforeach
        </ul>
    </div>
@endif  
    <form action="rasio/save" method="post">
    <input type="hidden" name="id" id="id">
    <input type="hidden" name="jumlah" id="jumlah">
    {{ csrf_field() }}
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data Rasio</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover" id="rasio-table">
                    <tr>
                        <th>NO.</th>
                        <th>Company</th>
                        <th>Rasio</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>
                            <select name="company1" class="css-input" id="company1">
                                <option value="" selected disabled>-- PILIH COMPANY --</option>
                                @foreach($company as $c)
                                    <option value="{{ $c->id }}"> {{ $c->company }} </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="number" class="form-control input-rasio" name="rasio1" min="0" max="100">
                        </td>
                    </tr>
                </table>
                <button class="btn btn-primary m-3 float-right">Simpan</button>
            </div>
        </div>
    </form>

    <script src="{!! asset('masterApps/js/jquery-3.3.1.min.js') !!}"></script>
    
    <script>
    $(document).ready(function() {
            $('.box').hide();
            $('#tambahCompany').hide();
            $('#save').prop("disabled", true);
            $('#workcenter').prop("disabled", true);
            $('#bagian').prop("disabled", true);
            $('.css-input').select2();

        $('#kategori').change(function () {
            $('#workcenter').prop("disabled", false);
            var id = $('#kategori option:selected').val();
            
            $.ajax({
                url: 'rasio/workcenter/' +id,
                method: 'GET',
                dataType: 'JSON',
                success: function (data) {
                    var optionroles = '<option selected disabled>-- PILIH WORKCENTER --</option>', $comboroles = $('#workcenter');
                    for (index = 0; index < data.length; index++) 
                    {
                        optionroles+='<option  value="'+data[index].id+'">'+data[index].workcenter+'</option>';   
                    }
                    $comboroles.html(optionroles).on('change');
                    }
            });
            $('#workcenter').change(function () {
                $('#bagian').prop("disabled", false);
                var idworkcenter = $('#workcenter option:selected').val();
                $.ajax({
                    url: 'rasio/bagian/' +idworkcenter,
                    method: 'GET',
                    dataType: 'JSON',
                    success: function (data) {
                        var optionroles = '<option selected disabled>-- PILIH BAGIAN --</option>', $comboroles = $('#bagian');
                        for (index = 0; index < data.length; index++) 
                        {
                            optionroles+='<option  value="'+data[index].id+'">'+data[index].bagian+'</option>';   
                        }
                        $comboroles.html(optionroles).on('change');
                    }
                });
                $('#bagian').change(function () {
                    $('#save').prop("disabled", false);
                    $('#save').text("Save");
                })
            });
        });
        $('#tambahCompany').click(function () {
            tambahRow('rasio-table');
        });
        $('#save').click(function () {
            
            $.ajax({
                url: 'rasio/rasio-head/save',
                method: 'POST',
                data: {'_token': $('input[name=_token]').val(), 'bagian': $('#bagian').val()},
                dataType: 'JSON',
                success: function (data) {
                    swal({
                        title: "Success",
                        text: "Berhasil Menambahkan",
                        type: "success",
                    });
                    $('.box').show();
                    $('#tambahCompany').show();
                    $('#id').val(data.id);
                    $('#jumlah').val('1');
                }
            });
        });
    });
    function tambahRow(tablenya) 
        {
            var jumlah = +$('#jumlah').val() + 1;
            $('#jumlah').val(jumlah);
            var $tableBody = $('#'+tablenya).find("tbody");
            $trLast = $tableBody.find("tr:last");
            $trLast.find('.css-input').select2('destroy'); // Un-instrument original row
            $trNew = $trLast.clone();
            $trLast.find('.css-input').select2(); // Re-instrument original row
            $trNew.find('.css-input').select2(); // Instrument clone
            $trLast.after($trNew);
            $i = 1;
            $input = $trNew.find('input').attr({
                'id': function(_, id) { return id + $i },
                'name': function(_, name) { return name + $i }
            });
            $input = $trNew.find('.css-input').attr({
                'id': function(_, id) { return id + $i },
                'name': function(_, name) { return name + $i }
            });
            $i++;
            
        }
    </script>
    
@endsection 