@extends('masterApps.Mobile.superAdmin.templates.layout')
@section('title')
    Master Apps
@endsection
@section('subtitle')
    WorkCenter
@endsection
@section('content')

    <div id="particles-js"></div>
    <div class="container">
        <div class="row">
            <div class="col teks mt-3 rounded">
                    <form action="workcenter/data" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" id="id" name="id">
                        <div class="row">
                            <div class="col-lg-6 ">
                                <div class="form-group">
                                    <label for="">WorkCenter :</label>
                                    <input type="text" name="workcenter" id="workcenter" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Status :</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="" selected disabled>-- PILIH STATUS --</option>
                                        <option value="0">Tidak Aktif</option>
                                        <option value="1">Aktif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 ">
                                <div class="form-group">
                                    <label for="">Kategori :</label>
                                    <select name="kategori" id="kategori" class="form-control">
                                        <option value="" selected disabled>-- PILIH KATEGORI --</option>
                                        @foreach($kategori as $k)
                                            <option value="{{ $k->id }}">{{ $k->kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-primary pr-5 pt-2 pb-2 pl-5 ml-3 d-flex-justify-content-center text-center">SIMPAN</button>
                        </div>
                    </form>

                    <table class="table bg-white mt-4">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">WorkCenter</th>
                                <th scope="col">Kategori ID</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i=1 ?>
                            @foreach($workcenter as $w)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $w->workcenter }}</td>
                                    <td>{{ $w->kategori_id }}</td>
                                    <td>{{ $w->status }}</td>
                                    <td><button class="btn btn-primary edit" data-id="{{ $w->id }}"><i class="fa fa-edit"></i> Edit</button></td>
                                </tr>
                                <?php $i++ ?>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
<script src="{{ asset('masterApps/mobileStyle/js/sweetalert2.all.min.js') }}"></script>
<script src="{!! asset('masterApps/mobileStyle/superAdmin/js/jquery-3.3.1.min.js') !!}"></script>
<script>

$(".edit").click(function () {
    var id = $(this).data('id');
    $.ajax({
        url: 'workcenter/edit/' + id,
        method: 'GET',
        dataType: 'JSON',
        success: function (data) {
            
            $('#workcenter').val(data[0].workcenter);
            $("#status option[value= '" + data[0].status + "']").prop('selected', true);
        }
    });
});
// var optionroles = '<option disabled>-- PILIH KATEGORI --</option>', $comboroles = $('#kategori');
// for (index = 0; index < data[1].length; index++) 
// {
//     if (data[1][index].id == data[0].kategori_id) 
//     {
        
//         optionroles+='<option  value="'+data[1][index].id+'" selected>'+data[1][index].kategori+'</option>';   
//     }
//     else
//     {
//         optionroles+='<option  value="'+data[1][index].id+'">'+data[1][index].kategori+'</option>';   
//     }
// }
// $comboroles.html(optionroles).on('change');

</script>
@endsection