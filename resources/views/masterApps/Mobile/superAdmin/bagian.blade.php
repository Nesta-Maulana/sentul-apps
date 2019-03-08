@extends('masterApps.Mobile.superAdmin.templates.layout')
@section('title')
    Master Apps
@endsection
@section('subtitle')
    Bagian
@endsection
@section('content')
<div class="container">
    <form action="bagian/data" method="post">
        <div class="row">
            {{ csrf_field() }}
            <div class="col-lg-6 ">
                <div class="form-group">
                    <label for="">WorkCenter :</label>
                    <select name="workcenter" id="workcenter" class="form-control">
                        <option value="" selected disabled>-- PILIH WORKCENTER --</option>
                        @foreach($workcenter as $w)
                            <option value="{{ $w->id }}">{{ $w->workcenter }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Bagian :</label>
                    <input type="text" name="bagian" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Satuan :</label>
                    <input type="number" name="satuan" class="form-control">
                </div>   
            </div>
            <div class="col-lg-6 ">
                <div class="form-group">
                    <label for="">Status :</label>
                    <select name="status" id="status" class="form-control">
                        <option value="" selected disabled>-- PILIH STATUS --</option>
                        <option value="0">Tidak Aktif</option>
                        <option value="1">Aktif</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Spesifikasi Minimal :</label>
                    <input type="number" name="spek_min" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Spesifikasi Maksimal :</label>
                    <input type="number" name="spek_max" class="form-control">
                </div>
            </div>
            <button class="btn btn-primary pr-5 pt-2 pb-2 pl-5 ml-3 d-flex-justify-content-center text-center">SIMPAN</button>
        </div>
    </form>
    <table class="table bg-white mt-4">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">WorkCenter</th>
                <th scope="col">Bagian</th>
                <th scope="col">Status</th>
                <th scope="col">Satuan</th>
                <th scope="col">Spesifikasi Minimal</th>
                <th scope="col">Spesifikasi Maksimal</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1 ?>
            @foreach($bagian as $b)
                <tr>
                    <td>{{ $i }}</td>
                    @foreach($workcenter as $work)
                        @if($b->workcenter_id == $work->id)
                            <td>{{ $work->workcenter }}</td>
                        @endif 
                    @endforeach
                    <td>{{ $b->bagian }}</td>
                    <!-- <td>{{ $b->status }}</td> -->
                    @if($b->status == "1")
                        <td>Aktif</td>
                    @else
                        <td>Tidak Aktif</td>
                    @endif
                    <td>{{ $b->satuan }}</td>
                    <td>{{ $b->spek_min }}</td>
                    <td>{{ $b->spek_max }}</td>
                    <td><button class="btn btn-primary"><i class="fa fa-edit"></i> Edit</button></td>
                </tr>
                <?php $i++ ?>
            @endforeach
        </tbody>
    </table>
</div>
<script src="{{ asset('masterApps/mobileStyle/js/sweetalert2.all.min.js') }}"></script>
<script src="{!! asset('masterApps/mobileStyle/superAdmin/js/jquery-3.3.1.min.js') !!}"></script>
@endsection