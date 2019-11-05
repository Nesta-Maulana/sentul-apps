
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- CSS -->
    <style>
        #my_camera{
        width: 320px;
        height: 240px;
        border: 1px solid black;
        }
    </style>
    <title>Document</title>
</head>
<body>
    <div class="container-fluid">
        <div class="card col">
            <div class="card-body">
            <br><br>
            <input id="myFileInput" type="file" accept="image/*;capture=camera">
            <input type="file" name="" id="">
            

                <div class="form-group">
                    <label for="">Nama Form</label>
                    <input type="text" name="" class="form-control" id="">
                    <label for="">Requested No WO</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Requested No WO</th>
                                <th>Kriteria</th>
                                <th>Parameter</th>
                                <th>If #OK</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($head as $h)
                            <tr>
                                <td>{{$h->nama}}</td>
                                <td>{{$h->req_no_wo}}</td>
                        @endforeach
                        @foreach($detail as $d)                        
                                <td>{{$d->kriteria}}</td>
                                <td>{{$d->parameter}}</td>
                                <td>{{$d->if_not_ok}}</td>
                                <td>{{$d->keterangan}}</td>
                        @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>

                <a href="{{route('form.export')}}" class="btn btn-success" target="_blank">Excel</a>

                <!-- <div id="my_camera"></div>
                <input type=button value="Take Snapshot" onClick="take_snapshot()">
                <div id="results"></div> -->
            </div>
        </div>
    </div>
    <script>
        var myInput = document.getElementById('myFileInput');

        function sendPic() {
            var file = myInput.files[0];

            // Send file here either by adding it to a `FormData` object 
            // and sending that via XHR, or by simply passing the file into 
            // the `send` method of an XHR instance.
        }

        myInput.addEventListener('change', sendPic, false);var myInput = document.getElementById('myFileInput');

        function sendPic() {
            var file = myInput.files[0];

            // Send file here either by adding it to a `FormData` object 
            // and sending that via XHR, or by simply passing the file into 
            // the `send` method of an XHR instance.
        }

        myInput.addEventListener('change', sendPic, false);
    </script>
    <script type="text/javascript" src="webcamjs/webcam.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>