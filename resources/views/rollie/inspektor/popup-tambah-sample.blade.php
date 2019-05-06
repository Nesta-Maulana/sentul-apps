<div class="modal fade" id="tambah-sample" tabindex="-1" role="dialog" aria-labelledby="tambahSampleAnalisa" aria-hidden="true" style="margin-left: -144px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 130%;">
            <div class="modal-header">
                <h5>Tambah Sampel Analisa</h5>
            </div>
            {!! Form::open(['route'=>'import-jadwal-produksi','enctype'=>'multipart/form-data','method'=>'post']) !!}
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="nomorwosampel" class="col-lg-4">Nomor Batch / Nomor Wo </label>
                        <select name="nomorwosampel" id="nomorwosampel" class="select col-lg-7 form-control" style="font-size: 13px;">
                            <option value="idnya1">Batch 1 - G00000898789</option>
                            <option value="idnya2">Batch 2 - G00000012987</option>
                        </select>
                    </div>
                    <div class="form-group row">
                        <label for="mesinfillingsampel" class="col-lg-4">Nomor Batch / Nomor Wo </label>
                        <select name="mesinfillingsampel" id="mesinfillingsampel" class="select col-lg-7 form-control" style="font-size: 13px;">
                            <option value="idnya1">TBA C</option>
                            <option value="idnya2">A3CF B</option>
                            <option value="idnya2">TPA</option>
                        </select>
                    </div>

                    <div class="form-group row">
                        <label for="tanggalfillingsampel" class="col-lg-4">Tanggal Filling</label>
                        <input type="text" id="tanggalfillingsampel" class="form-control timepicker col-lg-7" >
                    </div>

                    <div class="form-group row">
                        <label for="tanggalfillingsampel" class="col-lg-4">Tanggal Filling</label>
                       <div class='input-group date' id='startDate'>
                            <input type='text' class="form-control" name="startDate" />
                            <span class="input-group-addon">
                                   <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                        
                    </div>
                </div>

                <div class="modal-footer">
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>