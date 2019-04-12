@extends('masterApps.templates.layout')
@section('title')
    Mesin Filling Head
@endsection
@section('subtitle')
    Subtitle
@endsection
@section('active-brand')
    active
@endsection
@section('content')
<div class="container">
    <div class="box-header">
        
    </div>
    {{ csrf_field() }}
        <input type="hidden" name="id" id="id">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="kelompok">Nama Kelompok : </label>
                    <input type="text" name="kelompok" class="form-control" id="kelompok">
                </div>
                <div class="form-group">
                    <label for="status">Status : </label>
                    <select name="status" id="status" class="form-control">
                        <option value="" disabled selected>-- PILIH STATUS --</option>
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                </div>
                <div class="p-2">
                    <button class=" btn btn-primary simpan" id="save" onclick="save()">Simpan</button>
                </div>
            </div>
        </div>
        <button class="btn btn-primary mb-2" id="tambahCompany" onclick="tambahCompany()">Tambah Company</button>
    
</div>
<div class="box d-flex data-menu {{ Session::get('tambah') }}">
    <div class="box-body table-responsive no-padding" id="mesinFillingDetail">
        <table class="table table-hover" id="mesin-table">
            <tr>
                <th>NO.</th>
                <th>Company</th>
                <th>Rasio</th>
            </tr>
            <tr>
                <td>1</td>
                <td>
                    <select name="company" class="css-input select2" id="company">
                        <option value="" selected disabled>-- PILIH MESIN --</option>
                        @foreach($mesin as $m)
                            <option value="{{ $m->id }}"> {{ $m->nama_mesin }} </option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="number" class="form-control input-rasio" name="rasio" min="0" max="100">
                </td>
            </tr>
        </table>
        <button class="btn btn-primary m-3 float-right">Simpan</button>
    </div>
</div>
</div>

<script>
$(document).ready(function () {
    $('#mesinFillingDetail').hide();
    $('#tambahCompany').hide();
})
    function save() {
        $.ajax({
            url: 'mesin-filling-head/save',
            method: 'POST',
            data: {'_token': $('input[name=_token]').val(), 'nama_kelompok': $('#kelompok').val(), 'status': $('#status').val()},
            dataType: 'JSON',
            success: function (data) {
                swal({
                    title: "Success",
                    text: "Berhasil Menambahkan",
                    type: "success",
                });
                $('#mesinFillingDetail').show();
                $('#tambahCompany').show();
                $('#id').val(data.id);
            }
        });
    }
    function tambahCompany(){
        tambahRow('mesin-table');
    }
    function tambahRow(tablenya) 
        {
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
            $input = $trNew.find('select').attr({
                'id': function(_, id) { return id + $i },
                'name': function(_, name) { return name + $i },
            });

            $i++;
            
        }
    </script>

@endsection

