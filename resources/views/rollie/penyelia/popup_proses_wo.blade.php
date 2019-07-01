<div class="modal fade" id="proses-batch" tabindex="-1" role="dialog" aria-labelledby="prosesBatch" aria-hidden="true" style="margin-left: -144px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 130%;">
            <div class="modal-header">
                <h5 class="text-white">Proses Produksi <span id="proses-produk"></span> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            {!! Form::open(['route'=>'penyelia-proses-wo','enctype'=>'multipart/form-data','method'=>'post']) !!}
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="nomor_wo_proses" class="col-lg-2">Nomor Wo: </label>
                        <input type="text" class="col-lg-8 form-control" id="nomor_wo_proses" name="nomor_wo_proses" readonly>
                        <input type="hidden" class="col-lg-8 form-control" id="proses_id" name="proses_id" readonly>
                    </div> 

                    <div class="form-group row">
                        <label for="plan_date_proses" class="col-lg-2">Plan Date : </label>
                        <input type="text" class="col-lg-8 form-control" id="plan_date_proses" name="plan_date_proses" readonly>
                    </div> 

                    <div class="form-group row">
                        <label for="realisation_date" class="col-lg-2">Realisation Date : </label>
                        <input type="date" class="col-lg-8 form-control" id="realisation_date" name="realisation_date" >
                    </div> 

                    <div class="form-group row">
                        <input type="submit" class="btn btn-info form-control col-md-6 offset-md-3" value="Proses WO">
                    </div>
                </div>

                <div class="modal-footer">
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>