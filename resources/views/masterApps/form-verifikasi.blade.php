
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
            <br>
            <div class="form-group">
                <label for="">Download Template berikut untuk pengisian Form</label> <br>
                <a href="{{route('upload.download')}}">Template Form Excel</a>
            </div>
            <br>
            {{ csrf_field() }}
                <div class="card">
                    <!-- <div class="row"> -->
                    <button type="button" class="btn btn-primary mr-5" data-toggle="modal" data-target="#importExcel">
                        IMPORT EXCEL
                    </button>
            
                    <!-- Import Excel -->
                    <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form method="post" action="{{route('form.import')}}" enctype="multipart/form-data">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                                    </div>
                                    <div class="modal-body">
            
                                        {{ csrf_field() }}
            
                                        <label>Pilih file excel</label>
                                        <div class="form-group">
                                            <input type="file" name="file" required="required">
                                        </div>
            
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Import</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="form-group col-md-12">
                           
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </form>
           
                <!-- <div id="my_camera"></div>
                <input type=button value="Take Snapshot" onClick="take_snapshot()">
                <div id="results"></div> -->
            <!-- </div>
        </div> -->
    </div>
    <script type="text/javascript" src="webcamjs/webcam.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    
</body>
</html>

