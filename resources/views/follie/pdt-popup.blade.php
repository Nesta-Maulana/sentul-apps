<div class="modal fade" id="pdt-popup" tabindex="-1" role="dialog" aria-labelledby="pdtPopUp" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">PDT</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="form-group" id="act">
            <label for="">Activity</label>
            <select name="activity" onchange="popup('filling')" class="form-control" id="activity">
                <option value="">klkl</option>
                <option value="">sdfds</option>
            </select>
        </div>
        <div class="form-group" id="filling" style="display:none;">
            <label for="">Mesin Filling</label>
            <select name="mesin-filling" onchange="popup('category')" class="form-control" id="mesin-filling">
                <option value="">klkl</option>
                <option value="">sdfds</option>
            </select>
        </div>
        <div class="form-group" id="category" style="display:none;">
            <label for="">Kategori DB</label>
            <select name="kategori" onchange="popup('detail')" class="form-control" id="kategori">
                <option value="">klkl</option>
                <option value="">sdfds</option>
            </select>
        </div>
        <div class="form-group" id="detail" style="display:none;">
            <label for="">Detail DB</label>
            <select name="detaildb" class="form-control" id="detaildb">
                <option value="">klkl</option>
                <option value="">sdfds</option>
            </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    function popup(id){
      $('#'+id).show();
    }
</script>