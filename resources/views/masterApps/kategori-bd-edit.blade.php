<form action="{{route('kategoribd.update', ['id' => $aksi->id])}}" method="post">
{{csrf_field()}}
<input type="hidden" name="id" value="{{$aksi->id}}">
    <div class="form-group">
        <label>List Activity</label>
        <select name="list_activity_id" id="list_activity_id" class="form-control" required>
        @foreach($list as $l)
            <option value="{{$l->id}}"{{$l->id == ($aksi->list_activity_id) ?'selected':''}}>{{$l->activity}}</option>
        @endforeach
        </select> 
    </div>

    <div class="form-group">
        <label>Kategori BD</label>
        <input type="text" class="form-control" value="{{$aksi->kategori_bd}}" name="kategori_bd">  
    </div>

    <div class="form-group">
        <label>Mesin Filling</label>
        <select name="mesin_filling_id" id="mesin_filling_id" class="form-control" required>
        @foreach($filling as $f)
            <option value="{{$f->id}}"{{$f->id == ($aksi->mesin_filling_id) ?'selected':''}}>{{$f->nama_mesin}}</option>
        @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Status</label>
        <select name="status" id="status" class="form-control">
        <option value="0" {{ $aksi->status == 0 ? 'selected' : '' }}>Tidak Aktif</option>
        <option value="1" {{ $aksi->status == 1 ? 'selected' : '' }}>Aktif</option>
        </select>
    </div>
    @if(Session::has('message'))
    <div>
        <span class="alert alert-success">{{Session::get('message')}}</span>
    </div>
    @endif
        <button class="btn btn-primary float-right">Update</button>
    <br><br>
</form> 