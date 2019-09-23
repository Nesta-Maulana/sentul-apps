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
              <select name="activity" onchange="activity()" class="form-control" id="activity">
              @foreach($activity as $a)
                  <option value="{{$a->id}}">{{$a->activity}}</option>
              @endforeach
              </select>
          </div>
          <div class="form-group" id="filling" style="display:none;">
              <label for="">Mesin Filling</label>
              <!-- <select name="mesin-filling" onchange="popup('category')" class="form-control" id="mesin-filling"> -->
                <div class="fill"></div>
              <!-- </select>  -->
          </div>
          <div class="form-group" id="category" style="display:none;">
              <label for="">Kategori DB</label>
                <div class="categ"></div>
          </div>
          <div class="form-group" id="detail" style="display:none;">
              <label for="">Detail DB</label>
              <div class="det"></div>
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
      function detail(){
       var id =  $('#kategoribd').val();
        $.ajax({
          url : 'getdetail/' + id,
          type : 'get',
          data : '',
          success:function(data){
            var detail = '';
            detail += '<select name="detail" id="detaill"  class="form-control">';
            detail += '<option disabled selected>-- Pilih Detail --</option>';
            $.each(data, function(index,element){
              detail += '<option value="'+element.id+'">'+element.detail+'</option>';
            })
            detail += '</select>';
            $('.det').html(detail);
            $('#detail').show();
          }
        });
      };

      function mesin(){
        var id = $('#mesin').val();
        $.ajax({
          url : 'getkategoribd/' + id + '/' + activity_id,
          type : 'get',
          data : '',
          success:function(data){
          
            var kategori = '';
            kategori += '<select name="kategoribd" onchange="detail()" id="kategoribd"  class="form-control">';
            kategori += '<option disabled selected>-- Pilih Kategoridb --</option>';
            $.each(data, function(index,element){
              kategori += '<option value="'+element.id+'">'+element.kategori_bd+'</option>';
            })
            kategori += '</select>';
            $('.categ').html(kategori);
            $('#category').show();
          }
        });
      }
    function activity(){
        var id = $("#activity").val();
        $('#category').hide();
        $('#detail').hide();
        activity_id = id;
        $.ajax({
          url : 'getfill/' + id,
          type : 'get',
          data : '',
          success:function(data){
             var filling = '';
            filling += '<select name="mesin-filling" id="mesin" onchange="mesin()" class="form-control">';
            filling += '<option disabled selected>-- Pilih Mesin Filling --</option>';
            $.each(data, function(index,element){
              filling += '<option value="'+element.id+'">'+element.nama_mesin+'</option>';
            })
             filling += '</select>';
            $('.fill').html(filling);
            $('#filling').show();
          }
        });
    }  
</script>