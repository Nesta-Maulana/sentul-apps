@extends('utilityOnline.admin.templates.layout')
@section('title')
    Utility Online | Reports
@endsection
@section('content')
<div class="row mt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Basic DataTables</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>                                 
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th>Bagian</th>
                                <th>Nilai</th>
                                <th>Tanggal Penggunaan</th>                            
                            </tr>
                        </thead>
                        <tbody> 
                            <?php $i=0 ?>                                
                            @foreach($report as $r)
                            <?php $i++ ?>
                                <tr>
                                    <td>{{ $i }}</td>
                                        @foreach($bagian as $b)
                                            @if($r->id_bagian == $b->id)
                                                <td>{{ $b->bagian }}</td>
                                            @endif
                                        @endforeach
                                    <td>{{ $r->nilai }}</td>
                                    <td>{{ $r->tgl_penggunaan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
