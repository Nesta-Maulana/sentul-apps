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
        @include('masterApps.detail-bd-edit')
    @else
        <form action="{{route('detail.store')}}" method="post">
        {{ csrf_field() }}
            <div class="form-group">
                <label>Kategori BD</label>
                <select name="kategori_bd_id" id="kategori_bd_id" class="form-control" required>
                @foreach($tampil as $s)
                    <option value="{{$s->id}}">{{$s->kategori_bd}}</option>
                @endforeach
                </select>
            </div>

            <div class="form-group">
            <label>Detail</label>
            <input type="text" class="form-control" value="" name="detail">  
        </div>
                <button class="btn btn-primary float-right">Simpan</button>
            <br><br>
        </form> 
        @endif
        <table class="table table-bordered" id="datatables()">
            <thead>
                <tr>
                    <th>Kategori BD</th>
                    <th>Detail</th>
                    
                    <th colspan="2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>       
                

                @foreach($show as $s) 
                    <td>{{$s->kategori_bd_id}}</td>
                    <td>{{$s->detail}}</td>
                    <td>
                    <a href="{{route('detail.edit', ['id'=> $s->id])}}" name="edit" class="btn btn-primary">Edit</a>
                    <a href="{{route('detail.destroy', $s->id)}}" class="btn btn-danger" onclick="return confirm('Are You Sure?')">Hapus</a>
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>
</div>
@endsection