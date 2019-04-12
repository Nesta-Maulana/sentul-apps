@extends('masterApps.templates.layout')
@section('title')
    Form Plan
@endsection
@section('subtitle')
    Subtitle
@endsection
@section('content')
<div class="box d-flex data-menu">
    <div class="container">
        <div class="box-header">
            
        </div>
         {!! Form::open(['route' => 'plan-data', 'method' => 'POST']) !!}
            <input type="hidden" name="id" id="id">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="plan">Plan :</label>
                        <input type="text" name="plan" id="plan" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="company">Company :</label>
                        <select name="company" id="company" class="form-control select2">
                            <option value="" disabled selected>-- PILIH COMPANY --</option>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->company }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat :</label>
                        <input type="text" name="alamat" id="alamat" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="status">Status :</label>
                        <select name="status" id="status" class="form-control">
                            <option value="" selected disabled>-- PILIH STATUS -- </option>
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="p-2">
                        <button class=" btn btn-primary simpan">Simpan</button>
                        <button href="#" class="btn btn-primary update">update</button>
                        <a href="#" class="btn btn-danger batal">Batal</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <table class="table text-center table-bordered table-striped">
                        <thead class="bg-dark text-white">
                            <tr>
                                <td>#</td>
                                <td>Plan</td>
                                <td>Company</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1 ?>
                            @foreach($plans as $plan)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $plan->plan }}</td>
                                    <td>{{ $plan->company->company }}</td>
                                    <td><a href="#" class="btn btn-primary edit">Edit</a></td>
                                </tr>
                                <?php $i++ ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
         {!! Form::close() !!}
    </div>
</div>

@endsection