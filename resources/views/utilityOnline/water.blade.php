@extends('utilityOnline.templates.layout')
@section('title')
    Utility Online | Water
@endsection
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div id="particles-js"></div>
<div class="container">
    <div class="row mt-5 justify-content-center">
        <div class="col-lg-4 teks rounded-top-left pt-3">
            <h3 class="text-white mb-4">Water</h3>
            <div class="form-group">
                <label for="workcenter" class="text-white">Pilih Jenis : </label>
                <select name="workcenter" id="workcenter" class="form-control select2   ">
                    <option value="" selected disabled>-- PILIH WORKCENTER --</option>
                    @foreach($workcenter as $k)
                        <option value="{{ $k->id }}" >{{ $k->workcenter }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-4 teks rounded-top-right"></div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-1"></div>
        <div class="col-lg-8 teks rounded-top-right rounded-bottoms align-middle pt-2">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Bagian</th>
                    <th scope="col">Input</th>
                    <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-secondary text-white" id="table">
                    <form action="">
                        {{ csrf_field() }}
                    </form>
                </tbody>
            </table>
        </div>
        <div class="col-lg-1"></div>
    </div>
</div>

<script src="{!! asset('masterApps/mobileStyle/superAdmin/js/jquery-3.3.1.min.js') !!}"></script>
<script>
    $('#workcenter').change(function () {
        var id = $('#workcenter option:selected').val();
        $.ajax({
            url: 'water/workcenter/' + id,
            method: 'GET',
            dataType: 'JSON',
            success: function (data) {
                // console.log(data);
                
                var optionroles = '', $comboroles = $('#table');
                for (index = 0; index < data.length; index++) 
                {
                    var no = index + 1;
                    optionroles+='<tr>';
                    optionroles+='<td>' +no+ '</td>';
                    optionroles+='<td>'+data[index].bagian+'</td>';  
                    // console.log(data[0][data[index].id]);
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
                // $('.simpan').click(function () {
                //     var id = $(this).data('id');
                //     var input = $('#input'+id).val();
                //     console.log(input);
                // });
            }
        });

    })
    function simpan(input,idbagian)
    {
        // console.log(input+" == "+idbagian);
        if(input == ""){
            swal({
                title: "Wajib Diisi",
                text: "!!",
                type: 'error'
            });
            return false
        }
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'water/simpan',
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
            console.log("asdf");
            
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