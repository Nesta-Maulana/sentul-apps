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

{{ csrf_field() }}
{!! Form::open(['route' => 'mesin-filling-head-detail-save', 'method' => 'POST']) !!}

<div class="row">
    <div class="col-lg-5">
        <div class="box p-2">
            <input type="hidden" name="id" id="id">
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
                <a class=" btn btn-primary simpan text-white" id="save" onclick="save()">Simpan</a>
            </div>
            <a class="btn btn-primary mb-2 text-white" id="tambahCompany" onclick="tambahCompany()">Tambah Company</a>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="box d-flex data-menu {{ Session::get('tambah') }}">
            <div class="box-body table-responsive no-padding" id="mesinFillingDetail">
                    <table class="table table-hover" id="mesin-table">
                        <tr>
                            <!-- <th>NO.</th> -->
                            <th>Mesin Filing</th>
                        </tr>
                        <tr>
                            <!-- <td></td> -->
                            <td>
                                <select class="css-input select2" name="company[]" id="company1">
                                    <option value="" selected disabled>-- PILIH MESIN --</option>
                                    @foreach($mesin as $m)
                                        <option value="{{ $m->id }}"> {{ $m->nama_mesin }} </option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                    </table>
                    <button class="btn btn-primary m-3 float-right">Simpan</button>
                {!! Form::close() !!}
            </div>
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
            success: function (data)
            {
                if(data.success == true)
                {
                    swal({
                    title: "Success",
                    text: data.message,
                    type: "success",
                    });
                    $('#mesinFillingDetail').show();
                    $('#tambahCompany').show();
                    $('#id').val(data.id);
                    $('#kelompok').prop('readonly',true);
                }
                else
                {
                    swal({
                        title: "GAGAL",
                        text: data.message,
                        type: "error",
                    });
                }

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
            $i = document.getElementById(tablenya).getElementsByTagName("select").length;
            $input = $trNew.find('select').attr({
                'id': function(_, id) { return id + $i },
                // 'name': function(_, name) { return name + $i },
            });

            $i++;
            
        }
    </script>

@endsection

