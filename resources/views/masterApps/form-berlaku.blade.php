@extends('masterApps.template.index')
@section('title')
    Download Form Berlaku 
@endsection
@section('content')

    <div class="form-group">
        <label>Pilih Departemen</label>
        <select name="departemen" class="form-control" id="departemen">
            @foreach($departemen as $dpt)
                <option value="{{$dpt->id}}" data-download="">{{$dpt->departemen}}</option>
            @endforeach
        </select>
    </div>
    <br><br>

    <table class="table table-bordered d-none" id="table">
        <thead>
            <tr>
                <th>No Perubahan</th>
                <th>Dept</th>
                <th>Nama Form</th>
                <th>Tanggal Pengajuan</th>
                <th>Tanggal Berlaku</th>
                <th>Nama Pengaju</th>
                <th>Manager Approval</th>
                <th>Kriteria Perubahan</th>
                <th>File Attachment</th>
            </tr>
        </thead>
        <tbody id="table_body">
            
        </tbody>
    </table>

    
@endsection

@section('script')
   <script>
        $('#departemen').change(function(){
            var departemen_id = $(this).find(':selected').val();
            var route_get = "{{ route('getDepartemenData') }}";

            $.ajax({
                type:'GET',
                url: route_get,
                data: {
                    departemen_id : departemen_id
                },
                success:function(result){
                    $('#table_body').html(result);
                    $('#table').removeClass('d-none');
                }
            })
        })
   </script>
@endsection