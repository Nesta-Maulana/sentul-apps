<div class="modal fade" id="updt-popup" tabindex="-1" role="dialog" aria-labelledby="updtPopUp" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">UPDT</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <div class="form-group" id="act2">
              <label for="">Activity</label>
              <select name="activity" onchange="aktifitas()" class="form-control" id="aktifitas">
              @foreach($activity as $a)
                  <option value="{{$a->id}}">{{$a->activity}}</option>
              @endforeach
              </select>
          </div>
          <div class="form-group" id="fillings" style="display:none;">
              <label for="">Mesin Filling</label>
              <!-- <select name="mesin-filling" onchange="popup('category')" class="form-control" id="mesin-filling"> -->
                <div class="fills"></div>
              <!-- </select>  -->
          </div>
          <div class="form-group" id="categories" style="display:none;">
              <label for="">Kategori DB</label>
                <div class="categs"></div>
          </div>
          <div class="form-group" id="details" style="display:none;">
              <label for="">Detail DB</label>
              <div class="dets"></div>
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
  var activity_id = 0;
    // $('#mesin').change(function(){
    //   alert('test');
    // });
      function details(){
       var id =  $('#kategoribds').val();
        $.ajax({
          url : 'getdetail/' + id,
          type : 'get',
          data : '',
          success:function(data){
            var detail = '';
            detail += '<select name="detail" id="detailll"  class="form-control">';
            detail += '<option disabled selected>-- Pilih Detail --</option>';
            $.each(data, function(index,element){
              detail += '<option value="'+element.id+'">'+element.detail+'</option>';
            })
            detail += '</select>';
            $('.dets').html(detail);
            $('#details').show();
          }
        });
      };

      function mesinf(){
        var id = $('#mesinf').val();
        $.ajax({
          url : 'getkategoribd/' + id + '/' + activity_id,
          type : 'get',
          data : '',
          success:function(data){
            var kategori = '';
            kategori += '<select name="kategoribds" onchange="details()" id="kategoribds"  class="form-control">';
              kategori += '<option disabled selected>-- Pilih Kategoridb --</option>';
            $.each(data, function(index,element){
              kategori += '<option value="'+element.id+'">'+element.kategori_bd+'</option>';
            })
            kategori += '</select>';
            $('.categs').html(kategori);
            $('#categories').show();
          }
        });
      }
    function aktifitas(){
        var id = $("#aktifitas").val();
        $('#categories').hide();
        $('#details').hide();
        activity_id = id;
        $.ajax({
          url : 'getfill/' + id,
          type : 'get',
          data : '',
          success:function(data){
            var filling = '';
            filling += '<select name="mesin-filling" id="mesinf" onchange="mesinf()" class="form-control">';
            filling += '<option disabled selected>-- Pilih Mesin Filling --</option>';
            $.each(data, function(index,element){
              filling += '<option value="'+element.id+'">'+element.nama_mesin+'</option>';
            })
             filling += '</select>';
            $('.fills').html(filling);
            $('#fillings').show();
          }
        });
    }  
</script>