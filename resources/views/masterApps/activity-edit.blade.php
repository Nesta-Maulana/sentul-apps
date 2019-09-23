<form action="{{route('activity.update', ['id' => $aksi->id])}}" method="post">
{{csrf_field()}}
@method('PUT')
<input type="hidden" value="{{$aksi->id}}">
<div class="form-group">
    <label>Activity</label>
    <input type="text" class="form-control" value="{{$aksi->activity}}" name="activity">  
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