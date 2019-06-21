@extends('utilityOnline.operator.templates.layout')
@section('title')
    Utility Online | Listrik
@endsection
@section('content')
<style>
    #particles-js{
        height: 190vh;
    }
    @media only screen and (max-width: 991px){
        #particles-js{
            height: 200vh;
        }
    }
    @media only screen and (max-width: 767px){
        #particles-js{
            height: 240vh;
        }
    }
</style>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div id="particles-js"></div>
    <div class="row back-img-bg d-flex justify-content-center">
        <div class="img-bg">
            <div class="mt-2">
                <h2 class="d-flex justify-content-center mt-2 xtreem" style="color: rgba(253, 255, 0, 0.8); text-shadow: 1px 1px 1px #000; font-size: 100px;">Listrik</h2>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row teks">
            <div class="col teks">
                <div class="row p-3">
                    <div class="col-lg-4 p-3 teks text-white">
                        <p for="workcenter" style="font-size: 2.5em;" class="text-center">Workcenter</p>
                        @foreach($workcenter as $w)
                            <button data-id="{{ $w->id }}" class="btn d-flex justify-content-center workcenter form-control " style="background: #212529;color: #a3a400" >{{ $w->workcenter }}</button><br>
                        @endforeach
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
                                <th>Satuan</th>
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
    
<script>
    $(document).ready(function () {
        $('.workcenter').click(function () {
            var id = $(this).data('id');
            workcenter(id);
        });
    });

    function workcenter(id) {
        $.ajax({
                url: '/sentul-apps/utility-online/listrik/workcenter/' + id,
                method: 'GET',
                dataType: 'JSON',
                success: function (data) {
                    window.setInterval(function(){
                        if($(window).width() <= 767){
                            $('.table').addClass('table-responsive');
                        }else{
                            $('.table').removeClass('table-responsive');
                        }
                    }, 200);
                    var optionroles = '', $comboroles = $('#table');
                    for (index = 0; index < data[0].length; index++) 
                    {
                        var no = index + 1;
                        optionroles+='<tr>';
                        optionroles+='<td>' +no+ '</td>';
                        optionroles+='<td>'+data[0][index].bagian+'</td>';  
                        if(data[0][index].pengamatan !== null)
                        {
                            optionroles+='<td><input type="text" onload="cek()" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" id="input'+ data[0][index].id +'" value="'+ data[0][index].pengamatan.nilai_meteran +'" /></td>';
                            cek(data[0][index].id);
                        }
                        else{
                            optionroles+='<td><input type="text" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" id="input'+ data[0][index].id +'"/></td>';
                        }
                        for (let i = 0; i < data[1].length; i++) {
                            if (data[0][index].satuan_id == data[1][i].id) {
                                optionroles+='<td>'+data[1][i].satuan+'</td>';
                            }
                        }
                        optionroles+='<td style="display:none"><input type="text" value="'+data[0][index].id+'" id="idbagian'+ data[0][index].id +'"/></td>'
                        optionroles+='<td><button class="btn btn-primary simpan" id="simpan'+data[0][index].id+'" onclick="simpan($(\'#input'+data[0][index].id+'\').val(),$(\'#idbagian'+data[0][index].id+'\').val())">Simpan</button></td>'
                        optionroles+='</tr>';
                    }
                    $comboroles.html(optionroles).on('change');
                }
            });
    }

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
            url: '/sentul-apps/utility-online/listrik/simpan',
            method: 'POST',
            dataType: 'JSON',
            data: { 'input': input, 'idBagian': idbagian},
            success: function (data) {
                if (data.success == true)
                {
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
                }
                else 
                {
                    swal({
                        title: "Failed",
                        text: "Harap cek meteran kembali !",
                        type: 'error'
                    })
                }
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
@if($id)
    <script>
        workcenter({{ $id }})
    </script>
@endif
@endsection