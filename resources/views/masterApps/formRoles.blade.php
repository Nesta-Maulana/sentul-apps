@extends('masterApps.templates.layout')
@section('title')
    Form Roles
@endsection
@section('subtitle')
    Subtitle
@endsection
@section('active-roles')
    active
@endsection
@section('content')
<section class="content">
      <div class="row">
      <?php $i = 0 ?>
      <?php $j = 3 ?>

        @foreach($users as $s)    
        
        <?php if($j % 3 == "0") { ?>
          <?php $warna = "green" ?>
        <?php }
        else if($j % 3 == "1"){
            $warna = "blue";
        }
         else { ?>
          <?php $warna = "red" ?>
        <?php }?>

        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-{{$warna}}">
            <div class="inner">
              <h3>{{$s}}</h3>

              <p>{{ $roles[$i]->role }}</p>
            </div>
            <div class="icon">
              <i class="fa fa-user"></i>
            </div>
            <a href="#" class="small-box-footer"><br></a>
          </div>
        </div>
        <?php $j++ ?>
        <?php $i++ ?>

        @endforeach
      </div>

<div class="row">
    <div class="col-lg-6 s12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title d-flex justify-content-center">Data Roles</h3>
            </div>
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $no= 1 ?>
                        @foreach($roles as $r)
                                <tr> 
                                    <td>{{ $no }}</td>
                                    <td>{{ $r->role }}</td>
                                    @if($r->status == 1) 
                                        <td>Aktif</td>
                                    @else
                                        <td>Tidak Aktif</td>
                                    @endif
                                    <td>
                                        <button data-id="{{ $r->id }}" class="edit btn btn-primary {{ Session::get('ubah') }}" value="Edit" id="edit" name="edit">Edit</button>
                                    </td>
                                </tr>
                                <?php $no++ ?>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
</div>
<div class="col-lg-5">
    <div class="box data {{ Session::get('tambah') }}">
        <div class="container">
            <div class="box-header">
                <h3 class="box-title">Data Roles</h3>
            </div>
            <form action="form-roles/save"  method="post" id="wow">
            {{ csrf_field() }}
                <div class="form-group">
                    <label for="role">Role :</label>
                    <input type="text" name="role" class="form-control" placeholder="Enter Role">
                </div>
                <div class="form-group">
                    <label for="status">Status :</label>
                    <select name="status" class="form-control" id="status">
                        <option value="" selected disabled>-- Pilih Status --</option>
                        <option value="0">Tidak Aktif</option>
                        <option value="1">Aktif</option>
                    </select>
                </div>
                <div class="pb-3">
                    <input type="submit" class="btn btn-primary" value="Simpan">
                </div>
            </form>

            <!-- wow -->
            <div id="formsimpan">
            <form action="form-roles/update" method="post">
            <input type="hidden" id="id" name="id" value="">
            {{ csrf_field() }}
                <div class="form-group">
                    <label for="role">Role :</label>
                    <input type="text" id="roles" name="role" class="form-control" placeholder="Enter Role">
                </div>
                <div class="form-group">
                    <label for="status">Status :</label>
                    <select name="status" id="status" class="form-control" id="status">
                        <option value="" selected disabled>-- Pilih Status --</option>
                        <option value="0">Tidak Aktif</option>
                        <option value="1">Aktif</option>
                    </select>
                </div>
                <div class="pb-3">
                    <input type="submit" class="btn btn-primary" value="Update">
                    </form>
                    <a href="" id="batal" class="btn btn-danger">Batal</a>
                </div>
            </div>
        </div>
    </div>
</div>

</section>

<script src="{!! asset('masterApps/js/jquery-3.3.1.min.js') !!}"></script>
 


<script>

$(document).ready(function () {
    $('#wow').first().show();
    $('#formsimpan').first().hide();
    window.setInterval(function(){
        if($(window).width() <= 558){
            $('.table').addClass('table-responsive');
        }else{
            $('.table').removeClass('table-responsive');
        }
    }, 200);
});

$('#batal').click(function(e){
    e.preventDefault();
    $('#wow').first().show();
    $('#formsimpan').first().hide();
    $("#status option[value= '']").prop('selected', true);
});

$(".edit").click(function () {
    $('.data').removeClass('hidden');
    $('#wow').first().hide();
    $('#formsimpan').first().show();

   const id = $(this).data('id');
     $.ajax({
            url: 'form-roles/edit/' + id,
            method: 'GET',
            dataType:'JSON',
            success: function(data)
            {
                $("#roles").val(data[0].role);
                $("#id").val(data[0].id);
                $("#status option[value= '" + data[0].status + "']").prop('selected', true);
            }
         });
});
</script>
@endsection
