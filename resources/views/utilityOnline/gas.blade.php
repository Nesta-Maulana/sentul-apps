@extends('utilityOnline.templates.layout')
@section('title')
    Utility Online | Gas
@endsection
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div id="particles-js"></div>
    <div class="container">
        <div class="row teks mt-5">
            <div class="col teks">
            <h1 class="font-weight-bold d-flex justify-content-center text-white mt-2" style="font-size: 40px"><i class="fa fa-star"></i>&ensp;Gas&ensp;<i class="fa fa-star"></i></h1>
                <div class="row">
                    <div class="col-lg-4 p-3 teks text-white">
                        <label for="workcenter">Workcenter :</label>
                        <br>
                        <select name="workcenter" id="workcenter" class="form-control select2">
                            <option value="" selected disabled>-- PILIH WORKCENTER --</option>
                            @foreach($workcenter as $w)
                                <option value="{{ $w->id }}">{{ $w->workcenter }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-8 teks ">
                        <!--Table-->
                        <table id="tablePreview" class="table bg-white table-striped table-hover mt-3">
                            <!--Table head-->
                            <thead class="thead-dark">
                                <tr>
                                <th>#</th>
                                <th>Bagian</th>
                                <th>Input</th>
                                <th>Aksi</th>
                                </tr>
                            </thead>
                            <!--Table head-->
                            <!--Table body-->
                            <tbody id="table">
                                
                            </tbody>
                            <!--Table body-->
                        </table>
                        <!--Table-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('masterApps/mobileStyle/js/sweetalert2.all.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#workcenter').change(function () {
            var id = $('#workcenter option:selected').val();
            $.ajax({
                url: 'gas/workcenter/' + id,
                method: 'GET',
                dataType: 'JSON',
                success: function (data) {
                    
                    var optionroles = '', $comboroles = $('#table');
                    for (index = 0; index < data.length; index++) 
                    {
                    
                        var no = index + 1;
                        optionroles+='<tr>';
                        optionroles+='<td>' +no+ '</td>';
                        optionroles+='<td>'+data[index].bagian+'</td>';  
                        if(data[index].pengamatan !== null)
                        {
                            optionroles+='<td><input type="text" onload="cek()" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" id="input'+ data[index].id +'" value="'+ data[index].pengamatan.nilai_meteran +'" /></td>';
                            cek(data[index].id);
                        }
                        else{
                            optionroles+='<td><input type="text" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" id="input'+ data[index].id +'"/></td>';
                        }

                        optionroles+='<td style="display:none"><input type="text" value="'+data[index].id+'" id="idbagian'+ data[index].id +'"/></td>'
                        optionroles+='<td><button class="btn btn-primary simpan" id="simpan'+data[index].id+'" onclick="simpan($(\'#input'+data[index].id+'\').val(),$(\'#idbagian'+data[index].id+'\').val())">Simpan</button></td>'
                        optionroles+='</tr>';
                    }
                    $comboroles.html(optionroles).on('change');
                }
            });
        });
    });
    function simpan(input,idbagian)
    {
        if(input == ""){
            swal({
                title: "Wajib Diisi",
                text: "",
                type: 'error'
            });
            return false
        }
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'gas/simpan',
            method: 'POST',
            dataType: 'JSON',
            data: { 'input': input, 'idBagian': idbagian},
            success: function (data) {
                swal({
                    title: "Success",
                    text: "Berhasil Menyimpan",
                    type: 'success'
                });
                var inp = '#input'+idbagian;
                var simpan = '#simpan'+idbagian;
                $(inp).attr('disabled', true);
                $(inp).attr('class', 'text-center');
                $(simpan).attr('class', ' btn bg-white text-primary font-weight-bold');
                $(simpan).text('Tersimpan');
                $(simpan).attr('disabled', true);
            },
        });
    }
    function cek(id) {
        setTimeout(function () {
            var inp = '#input'+id;
            var simpan = '#simpan'+id;
            $(inp).attr('disabled', true);
            $(inp).attr('class', 'text-center');
            $(simpan).attr('class', ' btn bg-white text-primary font-weight-bold');
            $(simpan).text('Tersimpan');
            $(simpan).attr('disabled', true);
        }, 1);
    }
</script>
@endsection