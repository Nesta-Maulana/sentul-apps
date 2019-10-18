@extends('utilityOnline.operator_lite.layouts.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="container">
        <div class="row teks">
            <div class="col teks">
                <div class="row p-3">
                    <div class="col-lg-4 p-3 teks text-white">
                        <p for="workcenter" style="font-size: 2.5em;" class="text-center">Workcenter</p>
                        @foreach($workcenter as $w)
                            <button data-id="{{ $w->id }}" class="btn btn-success d-flex justify-content-center workcenter form-control " >{{ $w->workcenter }}</button><br>
                        @endforeach                
                    </div>
                    <div class="col-lg-8 teks ">
                        <!--Table-->
                        <table id="tablePreview" class="table bg-dark table-striped table-hover mt-3">
                            <!--Table head-->
                            <thead class="thead-light">
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
    $('.workcenter').click(function () {
        var id = $(this).data('id');
        workcenter(id);
    })
    function workcenter(id) {
        $.ajax({
            url: '/sentul-apps/utility-lite/water/workcenter/' + id,
            method: 'GET',
            dataType: 'JSON',
            success: function (data) {
                // console.log(data);
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
                    // console.log(data[0][data[0][index].id]);
                    if(data[0][index].pengamatan !== null)
                    {
                        optionroles+='<td><input type="number" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" id="input'+ data[0][index].id +'" value="'+ data[0][index].pengamatan.nilai_meteran +'" /></td>';
                        cek(data[0][index].id);
                    }
                    else{
                        optionroles+='<td><input type="number" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" id="input'+ data[0][index].id +'"/></td>';
                    }
                    for (let i = 0; i < data[1].length; i++) {
                        if (data[0][index].satuan_id == data[1][i].id) {
                            optionroles+='<td>'+data[1][i].satuan+'</td>';
                        }
                    }
                    optionroles+='<td style="display:none"><input type="number" value="'+data[0][index].id+'" id="idbagian'+ data[0][index].id +'"/></td>'
                    optionroles+='<td><button class="btn btn-primary simpan" id="simpan'+data[0][index].id+'" onclick="simpan($(\'#input'+data[0][index].id+'\').val(),$(\'#idbagian'+data[0][index].id+'\').val())">Simpan</button></td>'
                    optionroles+='</tr>';
                }
                $comboroles.html(optionroles).on('change');
            }
        })
    }

    function simpan(input,idbagian)
    {
        if(input == ""){
            swal({
                title: "Wajib Diisi !!",
                text: "",
                type: 'error'
            });
            return false
        }
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/sentul-apps/utility-lite/water/simpan',
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
            // console.log("asdf");
            
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