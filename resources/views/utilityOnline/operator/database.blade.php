@extends('utilityOnline.operator.templates.layout')
@section('title')
    Utility Online | Database
@endsection
@section('content')
<style>
    #particles-js{
        height: 170vh;
    }
</style>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div id="particles-js"></div>
    <div class="row back-img-bg d-flex justify-content-center">
        <div class="img-bg">
            <div class="mt-5">
                <h2 class="d-flex justify-content-center mt-5 xtreem" style="color: rgba(240, 248, 254, 0.69); text-shadow: 1px 1px 1px #000; font-size: 100px;"><span style="color: rgba(251, 251, 242, 0.69);">Data</span> base</h2>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col teks" >
                <div class="row p-3 rounded">
                    <div class="col-lg-4 p-2 teks text-white">
                        <label for="tanggal">Tanggal : </label>
                        <br>
                        <input class="form-control" placeholder="Harap Pilih Tanggal Pengamatan" onfocus="(this.type='date')" id="tanggal">
                        <label for="kategori">Kategori :</label>
                        <br>
                        <select name="kategori" id="kategori" class="form-control select2">
                            <option value="" selected disabled>-- PILIH KATEGORI --</option>
                            @foreach($kategori as $k)
                                <option value="{{ $k->id }}">{{ $k->kategori }}</option>
                            @endforeach
                        </select>
                        <br>
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
                        <table id="tablePreview" class="table bg-white table-striped table-hover mt-3 tablePreview">
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
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="idBagian" id="idBagian">
                    <input type="hidden" name="tgl" id="tgl">
                    <h5 class="modal-title" id="exampleModalLabel">Form Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nilai" id="edit_bagian"></label>
                        <input type="text" name="" class="form-control" id="nilai">
                    </div>
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-danger text-white" id="batal" data-dismiss="modal">Close</a>
                    <button class="btn btn-primary" id="simpan" onclick="simpan()" >Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <script>

        $('#kategori').attr('disabled', true);
        $('#workcenter').attr('disabled', true);
        $('#tanggal').change(function () {
            $('#tgl').val($('#tanggal').val());
            $('#kategori').attr('disabled', false);
            if($('#workcenter option:selected').val() == ""){

            }else{
                reload();
            }
            $('#kategori').change(function () {
                var id = $('#kategori option:selected').val();
                $.ajax({
                    url: 'database/workcenter/' + id,
                    method: 'GET',
                    dataType: 'JSON',
                    success: function (data) {
                        var optionroles = '', $comboroles = $('#workcenter');
                        $('#workcenter').attr('disabled', false);
                        optionroles+='<option selected disabled>-- PILIH WORKCENTER --</option>';
                        for (index = 0; index < data.length; index++) 
                        {
                            optionroles+='<option value="'+data[index].id+'">'+data[index].workcenter+'</option>'
                        }
                        $comboroles.html(optionroles).on('change');

                        $('#workcenter').change(function () {
                            $('.tablePreview').DataTable().destroy();
                            var id = $("#workcenter option:selected").val();
                            var tanggal = $('#tanggal').val();
                            $.ajax({
                                url: 'database/bagian/' + id + '/' + tanggal,
                                method: 'GET',
                                dataType: 'JSON',
                                success: function (data) {
                                    var optionroles = '', $comboroles = $('#table');
                                    var nomor  = 0;
                                    for (index = 0; index < data[0].length; index++) 
                                    {
                                        if(data[0][index].pengamatan.length > 0){
                                            for (indek = 0; indek < data[0][index].pengamatan.length; indek++)
                                            {   
                                            
                                                // optionroles+='<td>'+ data[0][index].pengamatan.nilai_meteran +'</td>';
                                                if(data[0][index].pengamatan[indek])
                                                {   
                                                    var nomor = nomor+1;
                                                    optionroles+='<tr>';
                                                    optionroles+='<td>'+ nomor +'</td>';
                                                    optionroles+='<td>'+ data[0][index].pengamatan[indek].bagian +'</td>';
                                                    optionroles+='<td>'+ data[0][index].pengamatan[indek].nilai_meteran +'</td>'
                                                    for (let i = 0; i < data[1].length; i++) {
                                                        if (data[0][index].satuan_id == data[1][i].id) {
                                                            optionroles+='<td>'+data[1][i].satuan+'</td>';
                                                        }
                                                    }
                                                    optionroles+='<td><button class="btn btn-primary edit" data-id="' + data[0][index].pengamatan[indek].pengamatan_id + '" data-tgl="' + data[0][index].pengamatan[indek].created_at + '" data-toggle="modal" data-target="#exampleModal">Edit</button> </td>';
                                                }
                                                else
                                                {
                                                    
                                                }
                                            }
                                            
                                        }else{
                                            var nomor = nomor+1;
                                            optionroles+='<tr>';
                                            optionroles+='<td>'+ nomor +'</td>';
                                            optionroles+='<td>'+ data[0][index].bagian +'</td>';
                                            optionroles+='<td> No Value </td>';
                                            for (let i = 0; i < data[1].length; i++) 
                                            {
                                                if (data[0][index].satuan_id == data[1][i].id) {
                                                    optionroles+='<td>'+data[1][i].satuan+'</td>';
                                                }
                                            }
                                            optionroles+='<td><button class="btn btn-primary edit" data-idBagian="'+ data[0][index].id +'" data-bagian="'+ data[0][index].bagian +'" data-id="" data-toggle="modal" data-target="#exampleModal">Edit</button></td>';
                                        }
                                        
                                        
                                        // optionroles+='<td> <button class="btn btn-primary" data-id="' + data[0][index].pengamatan.id + '">Edit</button> </td>';
                                        optionroles+='</tr>';
                                    }
                                    $comboroles.html(optionroles).on('change');
                                    $('.tablePreview').DataTable().draw({
                                        pageLength: 5
                                    });
                                    $('.edit').click(function () {
                                        var id = $(this).data('id');
                                        var idBagian = $(this).data('idBagian');
                                        var tgl = $(this).data('tgl');
                                        if(id != ""){
                                            // console.log('ada');
                                            $.ajax({
                                                url: 'database/edit/'+id+'/'+tgl,
                                                method: 'GET',
                                                dataType: 'JSON',
                                                success: function (data) {
                                                    $('#edit_bagian').text(data[0].bagian.bagian);
                                                    $('#nilai').val(data[0].nilai_meteran);
                                                    $('#id').val(data[0].id);
                                                }
                                            })
                                        }else{
                                            // console.log('g ada');
                                            var bagian = $(this).data('bagian');
                                            var idBagian = $(this).data('idbagian');
                                            $('#edit_bagian').text(bagian);
                                            $('#idBagian').val(idBagian);
                                        }
                                    })
                                }
                            });
                        })
                    }
                });
            });
        });
        function simpan() {    
            var id = $('#id').val();
            if(id != ""){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: 'database/update',
                    method: 'POST',
                    dataType: 'JSON',
                    data: {
                        'nilai': $('#nilai').val(), 'id': $('#id').val(), 'tgl': $('#tgl').val()
                    },
                    success: function (data) {
                        reload();
                        swal({
                            title: "Berhasil",
                            text: "Data Berhasil DiUpdate",
                            type: "success"
                        });
                    }
                })
            }else{
                var idBagian = $('#idBagian').val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    url: 'database/simpan',
                    method: 'POST',
                    dataType: 'JSON',
                    data: {
                        'nilai': $('#nilai').val(), 'idBagian': idBagian, 'tgl': $('#tgl').val()
                    },
                    success: function (data) {
                        reload();
                        swal({
                            title: "Berhasil",
                            text: "Data Berhasil DiUpdate",
                            type: "success"
                        });
                    }
                })
            }
            $('#exampleModal').modal('hide');
        }

        function reload(){
            
            $('.tablePreview').DataTable().destroy();
            var id = $("#workcenter option:selected").val();
            var tanggal = $("#tanggal").val();
            $.ajax({
                url: 'database/bagian/' + id + '/' + tanggal,
                method: 'GET',
                dataType: 'JSON',
                success: function (data) {
                    var optionroles = '', $comboroles = $('#table');
                    var nomor  = 0;
                    for (index = 0; index < data[0].length; index++) 
                    {
                        if(data[0][index].pengamatan.length > 0){
                            for (indek = 0; indek < data[0][index].pengamatan.length; indek++)
                            {   
                            
                                // optionroles+='<td>'+ data[0][index].pengamatan.nilai_meteran +'</td>';
                                if(data[0][index].pengamatan[indek])
                                {
                                    var nomor = nomor+1;
                                    optionroles+='<tr>';
                                    optionroles+='<td>'+ nomor +'</td>';
                                    optionroles+='<td>'+ data[0][index].pengamatan[indek].bagian +'</td>';
                                    optionroles+='<td>'+ data[0][index].pengamatan[indek].nilai_meteran +'</td>'
                                    for (let i = 0; i < data[1].length; i++) {
                                        if (data[0][index].satuan_id == data[1][i].id) {
                                            optionroles+='<td>'+data[1][i].satuan+'</td>';
                                        }
                                    }
                                    optionroles+='<td><button class="btn btn-primary edit" data-id="' + data[0][index].pengamatan[indek].pengamatan_id + '" data-tgl="' + data[0][index].pengamatan[indek].created_at + '" data-toggle="modal" data-target="#exampleModal">Edit</button> </td>';
                                }
                                else
                                {
                                    
                                }
                            }
                        }else{
                            var nomor = nomor+1;
                            optionroles+='<tr>';
                            optionroles+='<td>'+ nomor +'</td>';
                            optionroles+='<td>'+ data[0][index].bagian +'</td>';
                            optionroles+='<td> No Value </td>';
                            for (let i = 0; i < data[1].length; i++) 
                            {
                                if (data[0][index].satuan_id == data[1][i].id) {
                                    optionroles+='<td>'+data[1][i].satuan+'</td>';
                                }
                            }
                            optionroles+='<td><button class="btn btn-primary edit" data-idBagian="'+ data[0][index].id +'" data-bagian="'+ data[0][index].bagian +'" data-id="" data-toggle="modal" data-target="#exampleModal">Edit</button></td>';
                        }
                        
                        
                        // optionroles+='<td> <button class="btn btn-primary" data-id="' + data[0][index].pengamatan.id + '">Edit</button> </td>';
                        optionroles+='</tr>';
                    }
                    $comboroles.html(optionroles).on('change');
                    $('.tablePreview').DataTable().draw({
                        pageLength: 5
                    });

                    $('.edit').click(function () {
                        var id = $(this).data('id');
                        var idBagian = $(this).data('idBagian');
                        var tgl = $(this).data('tgl');
                        if(id != ""){
                            $.ajax({
                                url: 'database/edit/'+id+'/'+tgl,
                                method: 'GET',
                                dataType: 'JSON',
                                success: function (data) {
                                    $('#edit_bagian').text(data[0].bagian.bagian);
                                    $('#nilai').val(data[0].nilai_meteran);
                                    $('#id').val(data[0].id);
                                }
                            })
                        }else{
                            var bagian = $(this).data('bagian');
                            var idBagian = $(this).data('idbagian');
                            $('#edit_bagian').text(bagian);
                            $('#idBagian').val(idBagian);
                            $('#nilai').val(" ");
                        
                        }
                    })
                }
            });
        }
    </script>
@endsection