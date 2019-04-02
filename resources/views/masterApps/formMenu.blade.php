@extends('masterApps.templates.layout')
@section('title')
    Form Menu
@endsection
@section('subtitle')
    Subtitle
@endsection
@section('active-menu')
    active
@endsection
@section('content')

<input id="interval" type="hidden" data-tambah="{{ Session::get('tambah') }}"/>

<?php $conn = mysqli_connect('localhost', "root", "", "master_apps"); ?>

<link rel='stylesheet' href='http://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css'>
<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>

<div class="box d-flex data-menu {{ Session::get('tambah') }}">
    <div class="container">
        <div class="box-header">
            <h3>Data Menu</h3>
        </div>
        <form action="form-menu/data" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="id" id="id">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="menu">Nama Menu :</label>
                        <input type="text" name="menu" id="menu" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="icon">Icon :</label>
                        <select name="icon" id="icons" class="form-control">
                            <option value="" disabled selected>-- PILIH ICON --</option>
                            @foreach($icons as $icon)
                                <option value="{{$icon->icons}}" data-icon="{{$icon->icons}}">{{$icon->icons}}</option>
                            @endforeach
                        </select>
                        
                    </div>
                    <div class="form-group mt-4">
                        <label for="urutan">Urutan :</label>
                        <input type="text" name="urutan" value="0" readonly id="urutan" class="form-control">
                    </div>
                    <div class="form-group mt-4">
                        <label for="aplikasi">Aplikasi :</label>
                        <select name="aplikasi" id="aplikasi" class="form-control">
                        <option value="" selected disabled>-- PILIH APLIKASI --</option>
                        
                            @foreach($aplikasi as $aps)
                                <option value="{{ $aps->id }}"> {{ $aps->aplikasi }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                        <div class="form-group">
                            <label for="link">Link :</label>
                            <input type="text" name="link" id="link" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="status">Status :</label>
                            <select name="status" id="status" class="form-control">
                                <option value="" selected disabled>-- PILIH STATUS --</option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="parent">Parent :</label>
                            <select name="parent" id="parent" class="form-control">
                                <option value="" disabled selected>-- PILIH PARENT --</option>
                                <option value="0">JADIKAN PARENT</option>
                                @foreach($parents as $parent)
                                <?php  
                                    $b = "SELECT COUNT(id) from menus WHERE parent_id='$parent->id'";
                                    $b = mysqli_query($conn, $b);
                                    $b = mysqli_fetch_array($b); 
                                ?>
                                    @if($b[0] == 0)
                                        <option value="{{ $parent->id }}" data-icon="{{$parent->icon}}">{{ $parent->menu }}</option>
                                    @else
                                    <?php
                                        $sql = "SELECT * FROM menus WHERE parent_id='$parent->id'";
                                        $anak = mysqli_query($conn, $sql)
                                    ?>
                                        <option value="{{ $parent->id }}" data-icon="{{$parent->icon}}">{{ $parent->menu }}</option>
                                    
                                        @while($a = mysqli_fetch_assoc($anak))
                                            <?php $query = mysqli_query($conn, "SELECT * FROM menus WHERE parent_id = '$a[id]'") ?>
                                            <?php $query = mysqli_fetch_array($query) ?>
                                            @if($query[0] == 0)
                                                <option value="{{ $a['id'] }}" data-icon="{{$a['icon']}}">&emsp;&emsp;{{ $a['menu'] }}</option>
                                            @else
                                                <option value="{{ $a['id'] }}" data-icon="{{$a['icon']}}">&emsp;&emsp;<i class="fa {{ $a['icon'] }}"></i>{{ $a['menu'] }}</option>
                                            @endif
                                        @endwhile
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <input type="submit" value="Simpan" id="simpan" class="btn btn-primary m-4 float-right">
                        <input type="submit" value="update" id="update" class="btn btn-primary m-4 float-right">
                        <a href="" class="btn btn-danger m-4 float-right text-white" id="batal" onclick="batal()">Batal</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="box tabel-menu">
        <div class="container">
            <div class="box-header">
                <h3>Data Menu</h3>
            </div>
            <table class="table text-center table-bordered table-striped">
                <thead class="dark">
                    <tr>
                        <td>#</td>
                        <td>Menu</td>
                        <td>Parent</td>
                        <td>Link</td>
                        <td>Urutan</td>
                        <td>Status</td>
                        <td>Aplikasi</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody>
                        <?php $i =1 ?>
                        @foreach($allMenu as $menu)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $menu->menu }}</td>
                                
                                    @if($menu->parent_id == '0')
                                        <td>Parent</td>
                                    @else
                                        @foreach($allMenu as $m)
                                            @if($menu->parent_id == $m->id)
                                                <td>{{ $m->menu }}</td>
                                            @endif
                                        @endforeach
                                    @endif
                                
                                <td>{{ $menu->link }}</td>
                                <td>{{ $menu->posisi }}</td>
                                @if($menu->status == 0)
                                    <td>Tidak Aktif</td>
                                @else
                                    <td>Aktif</td>
                                @endif
                                @foreach($aplikasi as $a)
                                    @if($menu->aplikasi_id == $a->id)
                                        <td>{{$a->aplikasi}}</td>
                                    @endif
                                @endforeach
                                <td>
                                    <button class="btn btn-primary edit" id="edit" data-id="{{ $menu->id }}" data-aplikasi="{{$menu->aplikasi_id}}">Edit</button>
                                </td>
                                <?php $i++ ?>
                            </tr>
                        @endforeach
                        
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
.margin-top{
    margin-top: -430px !important;
}
.margin-top-mobile{
    margin-top: -700px !important;
}
</style>

<script src="{!! asset('masterApps/js/jquery-3.3.1.min.js') !!}"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script>
function batal(){
       // e.preventDefault();
       $('#interval').val("");
        $('#simpan').show();
        $('#update').hide();
        $('#batal').hide();
    };

$(document).ready(function(){
    
    $('#simpan').show();
    $('#update').hide();
    $('#batal').hide();

    $('#aplikasi').change(function () {
        var parent = $('#aplikasi').val();
        $.ajax({
            url: 'form-menu/parent/' + parent,
            method: 'GET',
            dataType:'JSON',
            success: function(data){
                var optionparent = '<option disabled selected>-- PILIH PARENT --</option>', $comboparent = $('#parent');
                optionparent+= '<option value="0"> -- JADIKAN PARENT -- </option>';
                for (index = 0; index < data.length; index++) 
                {   
                    optionparent+='<option  value="'+data[index].id+'" data-icon="' + data[index].icon + '">'+data[index].menu+'</option>';
                }
                $comboparent.html(optionparent).on('change');
            }
        });
    });

    window.setInterval(function () {
        var cek = $('#interval').val();
        var tambah = $('#interval').data('tambah');
        if(cek == "" && tambah == "hidden"){
            var myVar = setInterval( setMargin(), 200);
        }else {
            clearInterval(myVar);
            $('.tabel-menu').removeClass('margin-top-mobile');
            $('.tabel-menu').removeClass('margin-top');
        }
    }, 200);

    function setMargin(){
        if($(window).width() >= 992){
            $('.tabel-menu').removeClass('margin-top-mobile');
            $('.tabel-menu').addClass('margin-top');
        }else{
            $('.tabel-menu').removeClass('margin-top');
            $('.tabel-menu').addClass('margin-top-mobile');
        }
    }

    window.setInterval(function(){
        if($(window).width() <= 558){
            $('.table').addClass('table-responsive');
        }else{
            $('.table').removeClass('table-responsive');
        }
    }, 200);
    $("button").click(function () {
        $('#interval').val("edit");
        $('.data-menu').removeClass('hidden');
        $('.tabel-menu').removeClass('margin-top');
        $('.tabel-menu').removeClass('margin-top-mobile');
        $('#simpan').hide();
        $('#update').show();
        $('#batal').show();
    const id = $(this).data('id');
    const aplikasi = $(this).data('aplikasi');

    $.ajax({
            url: 'form-menu/edit/' + id + '/' + aplikasi,
            method: 'GET',
            dataType:'JSON',
            success: function(data)
            {
                $('#menu').val(data[0][0]['menu']);
                $('#id').val(data[0][0]['id']);
                $('#urutan').val(data[0][0]['posisi']);
                $('#link').val(data[0][0]['link']);
                $("#status option[value= '" + data[0][0].status + "']").prop('selected', true);
                var optionroless = '<option disabled>-- PILIH APLIKASI --</option>', $comboroless = $('#aplikasi');
                for (index = 0; index < data[3].length; index++) 
                {
                    if (data[3][index].id == data[0][0].aplikasi_id) 
                    {
                        
                        optionroless+='<option  value="'+data[3][index].id+'" selected>'+data[3][index].aplikasi+'</option>';   
                    }
                    else
                    {
                        optionroless+='<option  value="'+data[3][index].id+'">'+data[3][index].aplikasi+'</option>';   
                    }
                }
                $comboroless.html(optionroless).on('change');

                var optionroles = '<option disabled>-- PILIH PARENT --</option>', $comboroles = $('#icons');
                
                for (index = 0; index < data[1].length; index++) 
                {
                    if (data[1][index].icons == data[0][0].icon) 
                    {
                        
                        optionroles+='<option  value="'+data[1][index].icons+'" selected>'+data[1][index].icons+'</option>';   
                    }
                    else
                    {
                        optionroles+='<option  value="'+data[1][index].icons+'">'+data[1][index].icons+'</option>';   
                    }
                }
                $comboroles.html(optionroles).on('change');
                var i = 0;
                var optionparent = '<option disabled>-- PILIH PARENT --</option>', $comboparent = $('#parent');
                optionparent += '<option value="0">Jadikan Parent</option>';
                for (index = 0; index < data[2].length; index++) 
                {   
                    if (data[2][index].id == data[0][0].parent_id) 
                    {
                        optionparent+='<option  value="'+data[2][index].id+'" data-icon="' + data[2][index].icon + '" selected>'+data[2][index].menu+'</option>';
                    } 
                    else
                    {
                        
                        if(data[2][index].parent_id == "0"){
                            if(i == 0){
                                optionparent+="<option value='0' selected> PARENT </option>"
                                i++;
                            } else{
                                if(data[2][index].id == data[0][0].id){

                                } else {
                                    optionparent+='<option  value="'+data[2][index].id+'" data-icon="' + data[2][index].icon + '">'+data[2][index].menu+'</option>'; 
                                }
                            }
                        }else{
                            if(data[2][index].id == data[0][0].id){

                            } else {
                            optionparent+='<option  value="'+data[2][index].id+'" data-icon="' + data[2][index].icon + '">'+data[2][index].menu+'</option>';   
                            }
                        }
                        
                    }
                }
                $comboparent.html(optionparent).on('change');
            }
        });
    });
    $('#parent').change(function(){
        id = $(this).val();
        $.ajax({
            url: 'form-menu/urutan/' + id,
            method: 'GET',
            dataType:'JSON',
            success: function(data)
            {  
                if(data.length==0)
                {
                    
                    $('#urutan').val('0');
                }
                else
                {
                    var j = data.length*1-1
                    $('#urutan').val((data[j].posisi*1)+1);
                }
            }
        });
    });

    function iformat(icon) {
        var originalOption = icon.element;
        return $('<span><i class="fa ' + $(originalOption).data('icon') + '"></i> ' + icon.text + '</span>');
    }
    $('#icons').select2({
        width: "100%",
        templateSelection: iformat,
        templateResult: iformat,
        allowHtml: true
    });
    $('#parent').select2({
        width: "100%",
        templateSelection: iformat,
        templateResult: iformat,
        allowHtml: true
    });
});

</script>
@endsection