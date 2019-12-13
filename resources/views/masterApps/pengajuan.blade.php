@extends('masterApps.template.index')
@section('title')
    Form Pengajuan Perubahan Form
@endsection
@section('content')
<form action="{{route('pengajuan.store')}}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
<div class="row"> 
    <div class="col-md-4">
        <div class="form-group">
            <label for="">No Perubahan</label>
            <input type="text" name="no_perubahan" id="" class="form-control">
            <label for="">Departemen</label>
            <input type="text" name="departemen" id="" class="form-control">
            <label for="">Nama Form</label>
            <input type="text" name="nama_form" id="" class="form-control">
            <label for="">Workcenter</label>
            <input type="text" name="workcenter" id="" class="form-control">
            <label for="">Tanggal Pengajuan</label>
            <input type="date" name="tgl_pengajuan" id="" class="form-control">
            <label for="">Tanggal Berlaku</label>
            <input type="date" name="tgl_berlaku" id="" class="form-control">
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
            <button class="btn btn-primary">Simpan</button>
        </div>
    </div>
</div>
</form>
@endsection