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
                            @include('masterApps.activity-edit')
                        @else
                            <form action="{{route('activity.store')}}" method="post">
                            {{ csrf_field() }}
                                <div class="form-group">
                                    <label>Activity</label>
                                    <input type="text" class="form-control" value="" name="activity">  
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
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Activity</th>
                                        <th>Status</th>
                                        <th colspan="2">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($show as $r)
                                    <tr>
                                        <td>{{$r->activity}}</td>
                                        <td>{{$r->status}}</td>
                                        <td>
                                            <a href="{{route('activity.ubah', ['id'=> $r->id])}}" name="edit" class="btn btn-primary">Edit</a>
                                            <a href="{{route('activity.destroy', $r->id)}}" class="btn btn-danger" onclick="return confirm('Are You Sure?')">Hapus</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>  

                @endsection
