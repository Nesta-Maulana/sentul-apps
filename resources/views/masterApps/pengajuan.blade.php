@extends('masterApps.template.index')
@section('title')
    Form Pengajuan Perubahan Form
@endsection
@section('content')
<form action="{{route('pengajuan.store')}}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="">No Perubahan</label>
            <input type="text" name="no_perubahan" id="" class="form-control">
            <label for="">Departemen</label>
            <select name="departemen_id" id="" class="custom-select">      
                @foreach($depart as $dpt)
                    <option value="{{$dpt->id}}">{{$dpt->departemen}}</option>
                @endforeach
            </select>
            <label for="">Nama Form</label>
            <input type="text" name="nama_form" id="" class="form-control">
            <label for="">Workcenter</label>
            <input type="text" name="workcenter" id="" class="form-control">
            <label for="">Tanggal Pengajuan</label>
            <input type="date" name="tgl_pengajuan" id="" class="form-control">
            <label for="">Tanggal Berlaku</label>
            <input type="date" name="tgl_berlaku" id="" class="form-control">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="">Nama Pengaju</label>
            <input type="text" name="nama_pengaju" id="" class="form-control">
            <label for="">Manager Approval</label>
            <input type="text" name="manager_approval" id="" class="form-control">
            <label for="">Kriteria Perubahan</label>
            <input type="text" name="kriteria_perubahan" id="" class="form-control">
            <label for="">No revisi Form</label>
            <input type="text" name="no_revisi_form" id="" class="form-control">
            <label for="">File Attachment</label>
            <input type="file" name="file_attachment" id="" class="form-control">
            <br>
            <div class="d-flex">
                <div class="ml-auto">
                    <button class="btn btn-primary" style="width:150px;">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection