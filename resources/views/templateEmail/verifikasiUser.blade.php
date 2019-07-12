<!DOCTYPE html>
<html>
<head>
    <title>Welcome Email</title>
    <style type="text/css">
    	body
    	{
    		width: 100%;
    		margin-left: auto;
			margin-right: auto;
    	}
    	.center {
			display: block;
			margin-left: auto;
			margin-right: auto;
			width: 50%;
			height: 50%;
		}
		.line{
			/*background-image: ;*/
			height: 5px;
		}
		
		.button1 {
		  background-color: #C5C5C5;; 
		  color: black; 
		  border: 2px solid #4CAF50;
		  height: 30px;
		}

		.button1:hover {
		  background-color: #4CAF50;
		  color: white;
		}


    </style>
</head>

<body>
 	<h4>Dear Administrator,</h4>
	<br/>
		User dengan data berikut,
		<table>
			<tr>
				<td>NIK</td>
				<td>:</td>
				<td>{{ $user['username'] }}</td>
			</tr>
			<tr>
				<td>Fullname</td>
				<td>:</td>
				<td>{{ $user->karyawan['fullname'] }}</td>
			</tr>
			<tr>
				<td>Email</td>
				<td>:</td>
				<td>{{ $user->karyawan['email'] }}</td>
			</tr>
			<tr>
				<td>Role</td>
				<td>:</td>
				<td>{{ $user->role['role'] }}</td>
			</tr>
		</table>
	<br/>
		
		Telah mendaftarkan diri di portal Sentul Integrated System, harap verifikasi dan aktivasi akun tersebut jika akun tersebut memang memiliki wewenang untuk mengakses Sentul Integrated System. 

	<br/>
	<br/>
	<br/>

	<img src="{{ asset('emailLogo/line.png') }}" alt="" class="line">
	<br>
	Salam Hangat,
	<br>
	<br>
	<br>
	Sisy's Team
	<br>
	<img src="{{ asset('emailLogo/rsz_1rsz_sisy.png') }}" class="center">
	<br>
	<br>
	<p style="color:red;font-size: 12px">*Email ini dikirim secara otomatis, harap tidak membalas email ini. Apabila anda tidak berkaitan dengan email ini maka abaikan atau hubungi administrator aplikasi.</p>
	<hr>
	<p style="text-align: center;">&copy; 2019 PT. Nutrifood Indonesia | Sentul Integrated System</p>
	
</body>

</html>
