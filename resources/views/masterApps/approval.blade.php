@extends('masterApps.template.index')
@section('title')
    Form Approval
@endsection
@section('content')
<div class="row">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No Perubahan</th>
                <th>Dept</th>
                <th>Nama Form</th>
                <th>Detail Kategori</th>
                <th>Tanggal Pengajuan</th>
                <th>Tanggal Berlaku</th>
                <th>Nama Pengaju</th>
                <th>Manager Approval</th>
                <th>Kriteria Perubahan</th>
                <th>No Revisi Form</th>
                <th>File Attachment</th>
                <th>File Revisi Sebelumnya</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1/I/FQC/2019</td>
                <td>FQC</td>
                <td>VMF</td>
                <td>Form Filling</td>
                <td>07/11/2019</td>
                <td>11/11/2019</td>
                <td>Paula Wulandari</td>
                <td>Hilda Utami</td>
                <td>Inspeksi Tambahan</td>
                <td>2</td>
                <td>Dapat di Download</td>
                <td>Dapat di Dowmload</td>
                <td>
                    <button class="btn btn-primary">Approve</button>
                    <button class="btn btn-danger">Reject</button>                    
                </td>
            </tr>
        </tbody>
    </table>

</div>

@endsection