@extends('masterApps.template.index')
@section('title')
    
@endsection
@section('content')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No Perubahan</th>
                <th>Departemen</th>
                <th>Nama Form</th>
                <th>Tanggal Pengajuan</th>
                <th>Tanggal Berlaku</th>
                <th>Nama Pengaju</th>
                <th>Manager Approval</th>
                <th>Kriteria Perubahan</th>
                <th>No Revisi Form</th>
                <th>File Attachment</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        @foreach($show as $s)
            <tr>
                <td>{{$s->no_perubahan}}</td>
                <td>{{$s->departemen->departemen}}</td>
                <td>{{$s->nama_form}}</td>
                <td>{{$s->tgl_pengajuan}}</td>
                <td>{{$s->tgl_berlaku}}</td>
                <td>{{$s->nama_pengaju}}</td>
                <td>{{$s->manager_approval}}</td>
                <td>{{$s->kriteria_perubahan}}</td>
                <td>{{$s->no_revisi_form}}</td>
                <td>
                    <a href="{{route('download')}}" class="btn btn-primary">Download Form</a>
                </td>
                <td>{{$s->status}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection