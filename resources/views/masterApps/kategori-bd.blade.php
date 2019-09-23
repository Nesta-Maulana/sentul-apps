@extends('masterApps.templates.layout')
@section('title')
           Master Apps        
@endsection
@section('subtitle')
@endsection 
@section('content')
<div class="card-body">
    <div class="col-md-12">
    @if(!empty($aksi))
        @include('masterApps.kategori-bd-edit')
    @else
        <form action="{{route('kategoribd.store')}}" method="post">
        {{ csrf_field() }}

            <div class="form-group">
                <label>List Activity</label>
                <select name="list_activity_id" id="list_activity_id" class="form-control" required>
                @foreach($list as $l)
                    <option value="{{$l->id}}">{{$l->activity}}</option>
                @endforeach
                </select> 
            </div>

            <div class="form-group">
                <label>Kategori BD</label>
                <input type="text" class="form-control" value="" name="kategori_bd">  
            </div>

            <div class="form-group">
                <label>Mesin Filling</label>
                <select name="mesin_filling_id" id="mesin_filling_id" class="form-control" required>
                @foreach($filling as $f)
                    <option value="{{$f->id}}">{{$f->nama_mesin}}</option>
                @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="0">Tidak Aktif</option>
                    <option value="1" >Aktif</option>
                </select>
            </div>
            @if(Session::has('message'))
            <div>
                <span class="alert alert-success">{{Session::get('message')}}</span>
            </div>
            @endif
                <button class="btn btn-primary float-right">Simpan</button>
            <br><br>
        </form> 
    @endif
        <table class="table table-bordered" id="datatables()">
            <thead>
                <tr>
                    <th>List Activity</th>
                    <th>Kategori BD</th>
                    <th>Mesin Filling</th>
                    <th>Status</th>
                    <th colspan="2">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $output= [];
                foreach ($tampil as $value) {
                    array_push($output, $value);
                }
            ?>
            @foreach($output as $a)
                <tr>                       
                    <td>{{$a->Activity->activity}}</td>
                    <td>{{$a->kategori_bd}}</td>
                    <td>{{$a->mesinFilling->nama_mesin}}</td>
                    <td>{{$a->status}}</td>
                    <td>
                    <a href="{{route('kategoribd.edit', ['id'=> $a->id])}}" name="edit" class="btn btn-primary">Edit</a>
                    <a href="{{route('kategoribd.destroy', $a->id)}}" class="btn btn-danger" onclick="return confirm('Are You Sure?')">Hapus</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
