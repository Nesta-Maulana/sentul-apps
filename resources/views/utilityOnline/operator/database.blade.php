@extends('utilityOnline.operator.templates.layout')
@section('title')
    Utility Online | Database
@endsection
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div id="particles-js"></div>
    <div class="container">
        <div class="row teks mt-5">
            <div class="col teks">
            <h1 class="font-weight-bold d-flex justify-content-center text-white mt-2" style="font-size: 40px">Database</h1>
                <div class="row">
                    <div class="col-lg-4 p-3 teks text-white">
                        <label for="tanggal">Tanggal : </label>
                        <br>
                        <input type="date" id="tanggal" class="form-control">
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
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="idBagian" id="idBagian">
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
                    <a type="button" class="btn btn-danger text-white" data-dismiss="modal">Close</a>
                    <button class="btn btn-primary" id="simpan" onclick="simpan()" data-dismiss="modal">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#kategori').attr('disabled', true);
        $('#workcenter').attr('disabled', true);
        $('#tanggal').change(function () {
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
                            var id = $("#workcenter option:selected").val();
                            var tanggal = $('#tanggal').val();
                            $.ajax({
                                url: 'database/bagian/' + id + '/' + tanggal,
                                method: 'GET',
                                dataType: 'JSON',
                                success: function (data) {
                                    var optionroles = '', $comboroles = $('#table');
                                    for (index = 0; index < data[0].length; index++) 
                                    {
                                        var no = index+1;
                                        optionroles+='<tr>';
                                        optionroles+='<td>'+ no +'</td>';
                                        optionroles+='<td>'+ data[0][index].bagian +'</td>';
                                        // optionroles+='<td>'+ data[0][index].pengamatan.nilai_meteran +'</td>';
                                        if(data[0][index].pengamatan){
                                            optionroles+='<td>'+ data[0][index].pengamatan.nilai_meteran +'</td>'
                                            for (let i = 0; i < data[1].length; i++) {
                                                if (data[0][index].satuan_id == data[1][i].id) {
                                                    optionroles+='<td>'+data[1][i].satuan+'</td>';
                                                }
                                            }
                                            optionroles+='<td> <button class="btn btn-primary edit" data-id="' + data[0][index].pengamatan.id + '" data-toggle="modal" data-target="#exampleModal">Edit</button> </td>';
                                        }else{
                                            optionroles+='<td> No Value </td>';
                                            for (let i = 0; i < data[1].length; i++) {
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

                                    $('.edit').click(function () {
                                        var id = $(this).data('id');
                                        if(id != ""){
                                            $.ajax({
                                                url: 'database/edit/'+id,
                                                method: 'GET',
                                                dataType: 'JSON',
                                                success: function (data) {
                                                    $('#edit_bagian').text(data[0].bagian);
                                                    $('#nilai').val(data[0].pengamatan.nilai_meteran);
                                                    $('#id').val(data[0].pengamatan.id);

                                                } 
                                            })
                                        }else{
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
                        'nilai': $('#nilai').val(), 'id': $('#id').val()
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
                        'nilai': $('#nilai').val(), 'idBagian': idBagian
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
        }
        function reload(){
            var id = $("#workcenter option:selected").val();
            var tanggal = $("#tanggal").val();
            $.ajax({
                url: 'database/bagian/' + id + '/' + tanggal,
                method: 'GET',
                dataType: 'JSON',
                success: function (data) {
                    var optionroles = '', $comboroles = $('#table');
                    for (index = 0; index < data.length; index++) 
                    {
                        var no = index+1;
                        optionroles+='<tr>';
                        optionroles+='<td>'+ no +'</td>';
                        optionroles+='<td>'+ data[index].bagian +'</td>';
                        // optionroles+='<td>'+ data[index].pengamatan.nilai_meteran +'</td>';
                        if(data[index].pengamatan){
                            optionroles+='<td>'+ data[index].pengamatan.nilai_meteran +'</td>'
                            optionroles+='<td> <button class="btn btn-primary edit" data-id="' + data[index].pengamatan.id + '" data-toggle="modal" data-target="#exampleModal">Edit</button> </td>';
                        }else{
                            optionroles+='<td> No Value </td>';
                            optionroles+='<td><button class="btn btn-primary edit" data-idBagian="'+ data[index].id +'" data-bagian="'+ data[index].bagian +'" data-id="" data-toggle="modal" data-target="#exampleModal">Edit</button></td>';
                        }
                        // optionroles+='<td> <button class="btn btn-primary" data-id="' + data[index].pengamatan.id + '">Edit</button> </td>';
                        optionroles+='</tr>';
                    }
                    $comboroles.html(optionroles).on('change');
                    $('.edit').click(function () {
                        var id = $(this).data('id');
                        $.ajax({
                            url: 'database/edit/'+id,
                            method: 'GET',
                            dataType: 'JSON',
                            success: function (data) {
                                $('#edit_bagian').text(data[0].bagian);
                                $('#nilai').val(data[0].pengamatan.nilai_meteran);
                                $('#id').val(data[0].pengamatan.id);
                                

                            } 
                        })
                    })
                }
            });
        }
    </script>
@endsection