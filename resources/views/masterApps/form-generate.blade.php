@extends('masterApps.template.index')
@section('title')
    Update Actions
@endsection 
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="{!! asset('vendor/fontawesome-free/css/all.min.css') !!}" rel="stylesheet" type="text/css">
    <link href="{!! asset('public/masterApps/css/sb-admin-2.min.css') !!}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Document</title>
</head>
<body id="page-top">
    
    <form action="{{route('form.store')}}" method="post">
    @csrf
    <div class="container-fluid">
        <div class="form-group">
            <br>
            <div class="row">
            <div class="col-md-6">
                <label for="">Select Form : </label> 
                <select name="nama" id="nama" class="form-control">
                <?php
                    $output = [];
                    foreach($head as $value){
                        array_push($output, $value);
                    }
                ?>
                @foreach ($output as $h)
                    <option value="{{$h->id}}">{{$h->nama}}</option>
                @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="">Request No.WO : </label>
                <input type="text" class="form-control" value="" name="request_nowo" id="request_nowo" readonly>
                </div>
            </div>
            <div class="col-md-12">
                <br>    
                <table class="table table-bordered  " id="datatables">
                    <thead>
                        <tr>
                            <th>Kriteria</th>
                            <th>Parameter</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody id="table">
                    
                        <tr>
                            <td id="kriteria"></td>
                            <td id="parameter"></td>
                            <td id="keterangan"></td>
                        </tr>
                    </tbody>
                    </table>
                    <br>
                    <button class="btn btn-primary">Simpan</button>
            </div>
                
        </div>    
    </div>
    

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>  
    <!-- Bootstrap core JavaScript-->
    <script src="{!! asset('vendor/jquery/jquery.min.js') !!}"></script>
    <script src="{!! asset('vendor/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{!! asset('vendor/jquery-easing/jquery.easing.min.js') !!}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{!! asset('public/masterApps/js/sb-admin-2.min.js') !!}  "></script>  


    <script>
        $('#nama').on('change', function(){
            var id = $(this).val();
            if($(this).val() != ''){
                $.ajax({
                    url: "{{ url('/master-apps/cek-wo') }}" + '/' + id,
                    dataType: 'json',
                    success: function(data){
                        console.log(data);
                        if(data.req_no_wo == 'yes'){
                            $('#request_nowo').prop('readonly', false);
                        }else{
                            $('#request_nowo').prop('readonly', true);
                        }

                        var isitable = '', $isitable = $('#table');     
                        for (var i = 0; i < data.form_detail.length; i++)
                        {
                            isitable    += '<tr>';
                            isitable    += '<td name="kriteria">'+data.form_detail[i].kriteria+'</td>';

                            if(data.form_detail.parameter  == 'yes'){
                                isitable    += '<td>'+'<input type="radio">'+'Done'+'<input type="radio">'+'On Progress'+'</td>';
                            }else{
                                isitable    += '<td>'+'<input type="radio" name="not_ok">'+'#OK'+'<input type="radio" name="ok">'+'OK'+'</td>';
                            }
                            
                            isitable    += '<td>'+'<textarea class="form-control" name="keterangan" id="keterangan" cols="30" rows="10"></textarea>'+'</td>';
                            isitable    += '</tr>';
                            
                        }
                        $isitable.html(isitable).on('change');
                        }
                    })
            }else{
                alert('Silahkan Pilih Form');    
            }
        })
    </script>
    
    <script>
        $(document).ready( function () {
            $('#datatables').DataTable();
        });
    </script>

    <!-- <script>
        $('#nama').on('change', function(){
            var kriteria = $(this).find(':selected').data('kriteria');
            $('#kriteria').html(kriteria);

            var keterangan = $(this).find(':selected').data('keterangan');
            $('#keterangan').html('<textarea class="form-control">');
        })
    </script> -->

    <!-- <script>
        $('#nama').change(function(){
            var nama = $(this).find(':selected').data('name');
            var req = $(this).find(':selected').data('req');
            var kriteria = $(this).find(':selected').data('kriteria');
            var parameter = $(this).find(':selected').data('parameter');
            var ifnotok = $(this).find(':selected').data('ifnotok');
            var keterangan = $(this).find(':selected').data('keterangan');

            $('#nama_form').val(nama);
            $('#request_nowo').val(req);
            $('#kriteria').html(kriteria);
            $('#parameter').html(parameter);
            $('#if_notok').html(ifnotok);
            $('#keterangan').html(keterangan);
        });
    </script> -->

    </form>
</body>
</html>
@endsection