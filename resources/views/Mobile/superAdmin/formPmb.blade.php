@extends('mobile.superadmin.templates.layout')
@section('active-pmb')
    active
@endsection
@section('title')
    Form PMB
@endsection
@section('subtitle')
    Subtitle
@endsection
@section('content')

<style>
     ul.nav-wizard li.active{
         color: black !important;
     }
</style>

<div class="container">
<div class="row">
    <div class="col-lg-4">
        <label for="namaProduk">Nama Produk : </label>
        <input type="text" id="namaProduk" value="Hilo School Coklat" readonly class="form-control">
        <label for="nomor"  class="pmb">Nomor WO : </label>
        <select name="" id="wo" class="form-control">
            <option value="" selected disabled>-- Pilih WO --</option>
            <option value="1">WO 1</option>
            <option value="2">WO 2</option>
            <option value="3">WO 3</option>
        </select>
    </div>
    <div class="col-lg-2"></div>
    <div class="col-lg-4">
        <label for="tanggal">Tanggal Produksi : </label>
        <input type="text" value="08/02/2019" id="tanggal" class="form-control">
        <label for="batch" class="pmb">Batch Ke : </label>
        <input type="number" id="batch" readonly class="form-control">
    </div>
</div>
</div>
<br>
<ul class="container">
    <ul class="nav nav-wizard">
        <li class="active">
            <a href="#pheTermisasi" data-toggle="tab">PHE Termisasi</a>
        </li>
        <li>
            <a href="#milkTankyb" data-toggle="tab">Milk Tank YB</a>
        </li>
        <li>
            <a href="#mixingTankyb" data-toggle="tab">Mixing Tank YB</a>
        </li>
        <li>
            <a href="#pheYb" data-toggle="tab">PHE YB</a>
        </li>
        <li>
            <a href="#incubationTank" data-toggle="tab">Incubation Tank</a>
        </li>
        <li>
            <a href="#pheCooler" data-toggle="tab">PHE Cooler</a>
        </li>
        <li>
            <a href="#" data-toggle="tab">Storage Tank YB</a>
        </li>
        {{-- <li>
            <a href="#" data-toggle="tab">XXX Tank</a>
        </li>
        <li>
            <a href="#" data-toggle="tab">Mixing Tank RM</a>
        </li>
        <li>
            <a href="#" data-toggle="tab">CST</a>
        </li>
        <li>
            <a href="#" data-toggle="tab">PHE RM</a>
        </li>
        <li>
            <a href="#" data-toggle="tab">Storage Tank RM</a>
        </li>
        <li>
            <a href="#" data-toggle="tab">UHT</a>
        </li>
        <li>
            <a href="#" data-toggle="tab">AT</a>
        </li> --}}
    </ul>
    <div class="bg-white shade tab-content" id="content contentnya">
    @include('mobile.superAdmin.mesin.phetermisasi')
    @include('mobile.superAdmin.mesin.milktankyb')
    @include('mobile.superAdmin.mesin.mixingtankyb')
    @include('mobile.superAdmin.mesin.pheyb')
    @include('mobile.superAdmin.mesin.incubationtank')
    @include('mobile.superAdmin.mesin.phecooler')
    @include('mobile.superAdmin.mesin.at')
    @include('mobile.superAdmin.mesin.cst')
    @include('mobile.superAdmin.mesin.mixingtankrm')
    @include('mobile.superAdmin.mesin.pherm')
    @include('mobile.superAdmin.mesin.storagetankyb')
    @include('mobile.superAdmin.mesin.storagetankrm')
    @include('mobile.superAdmin.mesin.uht')
    @include('mobile.superAdmin.mesin.xxxtank')
    </div>
</div>
<div id="datawo"></div>
<script src="{!! asset('Mobile-Style/superAdmin/js/jquery-3.3.1.min.js') !!}"></script>
<script>
    $(document).ready(function () {
        $('#wo').change(function(){
            var $wo = $('#wo').val();
            var $batch = $('#batch').val($wo);
            var $active = $(".nav-wizard li.active");

            $active.removeClass('active');
            $content = $('.tab-pane');
            $content.removeClass('active show');
            if($wo == 1){

                $.ajax({
                    url: 'form-pmb/data',
                    method: 'POST',
                    dataType: 'JSON',
                    success: function (data) {
                        $("#datawo").val("adsf");
                    }
                });

                var $target = $('.nav-wizard li:nth-child(4)');
                $target.addClass('active');
                $content = $('.tab-pane#pheYb');
                $content.addClass('active show');
            } else if($wo == 2){
                var $target = $('.nav-wizard li:nth-child(2)');
                $target.addClass('active');
                $content = $('.tab-pane#milkTankyb');
                $content.addClass('active show');
            } else if($wo == 3){
                var $target = $('.nav-wizard li:nth-child(5)');
                $target.addClass('active');
                $content = $('.tab-pane#incubationTank');
                $content.addClass('active show');
            }
        })

        $('a[data-toggle="tab"]').on('show.bs.tab',function () {
                var $active = $(".nav.nav-wizard li.active");
                $active.removeClass('active');
                var $target = $(this).parent();
                $target.addClass('active');
            });
        });
</script>
@endsection