<form action="{{route('detail.update', $aksi->id)}}" method="post">
{{ csrf_field() }}
@method('PUT')
<input type="hidden" name="id" value="{{$aksi->id}}">
    <div class="form-group">
        <label>Kategori BD</label>
        <select name="kategori_bd_id" id="kategori_bd_id" class="form-control" required>
        @foreach($tampil as $s)
            <option value="{{$s->id}}"{{$s->id == ($aksi->kategori_bd_id) ?'selected':''}}>{{$s->kategori_bd}}</option>
        @endforeach
        </select>
    </div>

    <div class="form-group">
    <label>Detail</label>
    <input type="text" class="form-control" value="{{$aksi->detail}}" name="detail">  
</div>
        <button class="btn btn-primary float-right">Update</button>
    <br><br>
</form> 