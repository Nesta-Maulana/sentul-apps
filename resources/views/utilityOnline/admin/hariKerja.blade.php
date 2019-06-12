@extends('utilityOnline.admin.templates.layout')
@section('title')
Master Apps
@endsection
@section('subtitle')
Hari Kerja
@endsection
@section('content')
<style>
    .fc-day-top:hover {
        cursor: pointer !important;
    }
</style>
<div class="section-header">
    <h1>Calendar</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Modules</a></div>
        <div class="breadcrumb-item">Calendar</div>
    </div>
</div>

<div class="section-body">
    <h2 class="section-title">Calendar</h2>
    <p class="section-lead">
        We use 'Full Calendar' made by @fullcalendar. You can check the full documentation <a
            href="https://fullcalendar.io/">here</a>.
    </p>

    <div class="row hariKerja">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Calendar</h4>
                </div>
                <div class="card-body">
                    <div class="fc-overflow">
                        <div id="myEvent"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->


    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    {!! Form::open(['route' => 'form-hari-kerja-save', 'method' => 'POST']) !!}
                    <div class="modal-body">
                        <input type="hidden" name="tgl" id="tgl">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="nfi">Pilih Jam Kerja (NFI) : &emsp;</label>
                            <select name="nfi" id="nfi" class="form-control">
                                <option value="" selected disabled>-- PILIH JAM KERJA --</option>
                                <option value="3">Full Day</option>
                                <option value="2">2 Shift</option>
                                <option value="1">1 Shift</option>
                            </select>
                            <label for="hni">Pilih Jam Kerja (HNI) : &emsp;</label>
                            <select name="hni" id="hni" class="form-control">
                                <option value="" selected disabled>-- PILIH JAM KERJA --</option>
                                <option value="3">Full Day</option>
                                <option value="2">2 Shift</option>
                                <option value="1">1 Shift</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-secondary" id="closeModalHariKerja">Close</a>
                        <button class="btn btn-primary" name="simpan">Save changes</button>
                    </div>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>

<!-- End Modal -->




@endsection