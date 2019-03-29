@extends('masterApps.mobile.superAdmin.templates.layout')
@section('title')
    Form Hak Akses
@endsection
@section('content')

    <div class="box">
        <div class="container">
            <div class="box-header">
                <h3>Data Hak Akses</h3>
                <div class="row">
                    <div class="col-lg-4">
                        <h4>
                            <div class="form-group">
                                <select name="hakUser" id="hakUser" class="form-control">
                                    <option value="" selected disabled>-- PILIH USER -- </option>
                                    @foreach($users as $user)

                                        @foreach($karyawan as $k)
                                            @if($k->nik == $user->username)
                                                <option value="{{ $user->id }}" data-id="{{ $user->id }}">{{ $k->fullname }}</option>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                        </h4>
                    </div>
                </div>
            </div>
            <table class="table text-center table-bordered table-striped"> 
                <thead class="dark">
                    <tr>
                        <td>#</td>
                        <td>Menu</td>
                        <td>Read</td>
                        <td>Create</td>
                        <td>Update</td>
                        <td>Delete</td>
                    </tr>
                </thead>
                <tbody id="coba">
                </tbody>
            </table>
        </div>
    </div>
    <script src="{!! asset('masterApps/mobileStyle/superAdmin/js/jquery-3.3.1.min.js') !!}"></script>
    <script src="{{ asset('masterApps/mobileStyle/js/sweetalert2.all.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            window.setInterval(function(){
                if($(window).width() <= 558){
                    $('.table').addClass('table-responsive');
                }else{
                    $('.table').removeClass('table-responsive');
                }
            }, 200);
            $('#hakUser').change(function(){
                const id = $(this).val();
                $.ajax({
                    url: 'form-hak-akses/' + id,
                    method: 'GET',
                    dataType: 'JSON',
                    success: function(data)
                    {
                        $('#coba tr').empty();
                        var no = 1;
                        for (let index = 0; index < data.length; index++) 
                        {
                            var $table = "<tr>";
                            $table += "<td>"+no+"</td>";
                            $table += "<td>"+data[index].menu+"</td>";
                            if (data[index].lihat =='1') 
                            {
                                $table+="<td> <label for=''>Y</label> <input type='radio' onclick='ubahakses("+data[index].id+",\"1\",\"lihat\", " + id + ")' name='lihat_"+data[index].id+"' id='cek' checked> <label for=''>T</label> <input type='radio' onclick='ubahakses("+data[index].id+",\"0\",\"lihat\", " + id + ")' name ='lihat_"+data[index].id+"' id='cek'> </td>"; 
                            }
                            else
                            {
                                $table += "<td> <label for=''>Y</label> <input type='radio' onclick='ubahakses("+data[index].id+",\"1\",\"lihat\", " + id + ")' name='lihat_"+data[index].id+"' id='cek'> <label for=''>T</label> <input type='radio' onclick='ubahakses("+data[index].id+",\"0\",\"lihat\", " + id + ", " + id + ")' name='lihat_"+data[index].id+"' id='cek' checked> </td>";
                            }
                            if (data[index].tambah =='1') 
                            {
                                $table+="<td> <label for=''>Y</label> <input type='radio' onclick='ubahakses("+data[index].id+",\"1\",\"tambah\", " + id + ")' name='tambah_"+data[index].id+"' id='cek' checked> <label for=''>T</label> <input type='radio' onclick='ubahakses("+data[index].id+",\"0\", \"tambah\", " + id + ")' name='tambah_"+data[index].id+"' id='cek'> </td>"; 
                            }
                            else
                            {
                                $table += "<td> <label for=''>Y</label> <input type='radio' onclick='ubahakses("+data[index].id+",\"1\",\"tambah\", " + id + ")' name='tambah_"+data[index].id+"' id='cek'> <label for=''>T</label> <input type='radio' onclick='ubahakses("+data[index].id+",\"0\", \"tambah\", " + id + ")' name='tambah_"+data[index].id+"' id='cek' checked> </td>";     
                            }
                            if (data[index].ubah =='1') 
                            {
                                $table+="<td> <label for=''>Y</label> <input type='radio' onclick='ubahakses("+data[index].id+",\"1\",\"ubah\", " + id + ")' name='ubah_"+data[index].id+"' id='cek' checked> <label for=''>T</label> <input type='radio' onclick='ubahakses("+data[index].id+  ",\"0\", \"ubah\", " + id + ")' name='ubah_"+data[index].id+"' id='cek'> </td>"; 
                            }
                            else
                            {
                                $table += "<td> <label for=''>Y</label> <input type='radio' onclick='ubahakses("+data[index].id+",\"1\",\"ubah\", " + id + ")' name='ubah_"+data[index].id+"' id='cek'> <label for=''>T</label> <input type='radio' onclick='ubahakses("+data[index].id+",\"0\", \"ubah\", " + id + ")' name='ubah_"+data[index].id+"' id='cek' checked> </td>"; 
                            }        
                            if (data[index].hapus =='1') 
                            {
                                $table+="<td> <label for=''>Y</label> <input type='radio' onclick='ubahakses("+data[index].id+",\"1\",\"hapus\", " + id + ")' name='hapus_"+data[index].id+"' id='cek' checked> <label for=''>T</label> <input type='radio' onclick='ubahakses("+data[index].id+",\"0\",\"hapus\", " + id + ")' name='hapus_"+data[index].id+"' id='cek'> </td>"; 
                            }
                            else
                            {
                                $table += "<td> <label for=''>Y</label> <input type='radio' onclick='ubahakses("+data[index].id+",\"1\",\"hapus\", " + id + ")' name='hapus_"+data[index].id+"' id='cek'> <label for=''>T</label> <input type='radio' onclick='ubahakses("+data[index].id+",\"0\",\"hapus\", " + id + ")' name='hapus_"+data[index].id+"' id='cek' checked> </td>"; 
                            }
                            $table+="</tr>";
                            no++;
                            $("#coba").append($table);               

                        }
                        //console.log('asdf');
                    
                    }
                    
                });
            });
        });
        function ubahakses(id,isinya, apa, idUser) 
        {
            $.ajax({
                url: 'form-hak-akses/update/' +id+ '/'+isinya+'/'+apa+'/'+idUser,
                method: 'GET',
                dataType: 'JSON',
                success: function (data) {
                    swal({
                        title: "Success",
                        text: "Berhasil Diubah",
                        type: "success"
                    });
                }
            });
        }
    </script>
@endsection
