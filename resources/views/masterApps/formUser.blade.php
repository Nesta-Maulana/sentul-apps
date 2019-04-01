@extends('masterApps.templates.layout')
@section('title')
    Form User
@endsection
@section('subtitle')
    Subtitle
@endsection
@section('active-user')
    active
@endsection
@section('content')

<div class="row">
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
        <div class="inner">
            <h3>{{ $countLogin }}</h3>

            <p>Users Online</p>
        </div>
        <div class="icon">
            <i class="fa fa-users"></i>
        </div>
        <span href="#" class="small-box-footer">&emsp;</i></span>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-blue">
        <div class="inner">
            <h3>{{ $countVerify }}</h3>

            <p>User Verify</p>
        </div>
        <div class="icon">
            <i class="fa fa-users"></i>
        </div>
        <span href="#" class="small-box-footer">&emsp;</i></span>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
        <div class="inner">
            <h3>{{ $countUnverify }}</h3>

            <p>User Unverify</p>
        </div>
        <div class="icon">
            <i class="fa fa-users"></i>
        </div>
        <span href="#" class="small-box-footer">&emsp;</i></span>
        </div>
    </div>
</div>


<div class="box">
    <div class="box-header">
        <h3 class="box-title">Data User</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>NIK / Username</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Status</th>
                <th>Verified</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($user as $s)
        <tr>
                <td>{{ $s->username }}</td>
                @foreach($karyawan as $k)
                    @if($k->nik == $s->username)
                        <td>{{ $k->email }}</td>
                    @endif
                @endforeach
                @if($s->rolesId == "1")
                    <?php $roles = "Super Administrator" ?>
                @elseif($s->rolesId == "2")
                    <?php $roles = "Administrator" ?>
                @elseif($s->rolesId == "3")
                    <?php $roles = "R & D Produk" ?>
                @else
                    <?php $roles = "Roles tidak terdaftar" ?>
                @endif
                <!-- Roles -->
                <td>{{ $roles }}</td>
                <!-- End Roles -->
                @if($s->status == "1")
                    <?php $status = "ON" ?>
                @else
                    <?php $status = "OFF" ?>
                @endif
                <td>{{ $status }}</td>
                @if($s->verifiedByAdmin == "1") 
                    <td class="text-success"> <i class="fa fa-check"></i> Verified</td>
                @else
                    <form action="form-user/verify/{{ $s->id }}" method="get">
                        <td><input type="submit" class="btn btn-danger" value="Verify"></td>
                    </form>

                @endif
                <td>
                        <input type="submit" class="btn btn-primary edit isi {{ Session::get('ubah') }}" id="isi"  data-toggle="modal" 
                        data-id="{{ $s->id }}" data-target="#exampleModal" value="Edit">
                </td>
        </tr>
        @endforeach
        </table>
    </div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <form action="form-user/update" method="post">
      <div class="modal-body" id="wow" >
      {{ csrf_field() }}
      <input type="hidden" name='nik' id='nik'>
      <input type="hidden" name="id" id="key">
            <div class="form-group">
                <label for="fullname">Full Name :</label>
                <input type="text" name="fullname"readonly id="fullname" class="form-control" placeholder="Enter Full Name">
            </div>
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email">
            </div>
            <div class="form-group">
                <label for="loginStatus">Status :</label>
                <select name="loginstatus" class="form-control" id="loginstatus">
                    <option value="" disabled>-- PILIH STATUS --</option>
                    <option value="0">Tidak Aktif</option>
                    <option value="1">Aktif</option>
                </select>
            </div>
            <div class="form-group">
                <label for="roles">Roles :</label>
                <select name="rolesId" class="form-control" id="rolesId">
                    
                </select>
            </div>
            <input type="submit" class="btn btn-primary " value="Save">
      </div>
	  </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
    
<script src="{!! asset('masterApps/js/jquery-3.3.1.min.js') !!}"></script>

<script>
window.setInterval(function(){
    
        if($(window).width() <= 1000){
            $('.table').addClass('table-responsive');
        }else{
            $('.table').removeClass('table-responsive');
        }
    }, 200);

    jQuery( document ).ready( function($) {
   $('#exampleModal').on('show.bs.modal', function(e) {

   var id = $(e.relatedTarget).data('id');

     $.ajax({

            url: 'form-user/edit/' + id,
            method: 'GET',
            dataType:'JSON',
            success: function(data)
            {
                
                console.log(data);
                $('#nik').val(data[0].username);
                $("#fullname").val(data[2].fullname);
                $("#email").val(data[2].email);
                $("#loginstatus option[value= '" + data[0].status + "']").prop('selected', true);
                $("#roles").val(data[0].rolesId);
                $("#key").val(data[0].id);
                
                var optionroles = '<option disabled>-- PILIH ROLES --</option>', $comboroles = $('#rolesId');
                for (index = 0; index < data[1].length; index++) 
                {
                    if (data[1][index].id == data[0].rolesId) 
                    {
                        optionroles+='<option  value="'+data[1][index].id+'" selected>'+data[1][index].role+'</option>';   
                    }
                    else
                    {
                        optionroles+='<option  value="'+data[1][index].id+'">'+data[1][index].role+'</option>';   
                    }
                }
                $comboroles.html(optionroles).on('change');
            }
         });

    });
});
</script>
@endsection