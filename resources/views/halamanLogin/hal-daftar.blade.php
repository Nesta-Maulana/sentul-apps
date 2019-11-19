<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{!! asset('halamanLogin/css/hal-login.css') !!}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Login</title>
</head>
<body>
    <div class="container" style="margin-top: 9%;">
        <br><br>
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1" >Masukan Username</label>
                        <input type="text" name ="username"class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1" >Masukan Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1" >Masukan Nama Anda</label>
                        <input type="text" name="nama" class="form-control">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                            <input type="checkbox" aria-label="Checkbox for following text input">
                            </div>
                        </div>
                            <input type="text" class="form-control" name="remember"aria-label="Text input with checkbox"placeholder="Remember Me">
                    </div>
                    <button type="submit" name="login" class="btn btn-success float-right">Login</button>
                    <a href="/sentul-apps/login" name="daftar" class="btn btn-success float-left">Daftar</a>
                </div>
            </div>
        </div>
    </form>
</body>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html> 