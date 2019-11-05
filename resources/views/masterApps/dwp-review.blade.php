<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('masterApps/css/datatable.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/w/dt/dt-1.10.18/b-1.5.6/b-colvis-1.5.6/datatables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="container-fluid">
    <div class="card col" style="margin-top:20px;"> 
    <br>
    <div class="table-responsive">
        <table class="table table-bordered" id="example">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Produk</th>
                <th>No WO</th>
                <th>Kode Produk</th>
                <th>Penyok Mesin Filling</th>
                <th>Penyok Mesin Straw</th>
                <th>Penyok Mesin Autopacker</th>
                <th>Penyok Handling</th>
                <th>Kode Print PAK #OK</th>
                <th>Pack Begaris</th>
                <th>Pinching</th>
                <th>Reject QC</th>
                <th>Pack Koma</th>
                <th>Jumlah Waste</th>
                <th>Waste Box(per WO)</th>
                <th>Waste Straw(per WO</th>
                <th>Total FG</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            </tbody>
            <tfoot>
                <tr>
                    
                </tr>
            </tfoot>
        </table>
        </div>
        <button class="btn btn-primary" style="wid">Report Khusus</button>
        <br>
        <div class="row">
            <div class="form-group col-md-2 ">
                <label for="">Tanggal Dari : </label>
                <input type="date" class="form-control"name="" id="">
                <label for="">Tanggal Sampai</label>
                <input type="date" name="" id="" class="form-control">
            </div>    
            <div class="form-group col-md-2">
                <label for="">Produk</label>
                <input type="text" name="" id="" class="form-control">
                <label for="">Kategori Waste</label>
                <input type="text" name="" id="" class="form-control">
                <label for="">Line Packing</label>
                <input type="text" name="" id="" class="form-control">

            </div>
        </div>
    </div>
</div>
</body>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="{!! asset('masterApps/js/datatable.min.js') !!}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/w/dt/dt-1.10.18/b-1.5.6/b-colvis-1.5.6/datatables.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        columnDefs: [
            {
                targets: 1,
                className: 'noVis'
            }
        ],
        buttons: [
            {
                extend: 'colvis',
                columns: ':not(.noVis)'
            }
        ]
    });
});
</script>
</html>