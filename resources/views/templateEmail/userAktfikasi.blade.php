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
 	<h4>Dear {{$user->karyawan['fullname']}},</h4>
		Selamat ! Akunmu telah terverifikasi dan diaktivasi oleh tim Sisy. Berikut adalah data user untuk login pertama mu. 
		<br/>
		<br/>
		<table>
			<tr>
				<td>Username</td>
				<td>:</td>
				<td>{{ $user['username'] }}</td>
			</tr>
			<tr>
				<td>Password</td>
				<td>:</td>
				<td>sentulappuser</td>
			</tr>
		</table> 
		<br>
		Anda bisa mengakses Sisy dengan klik <a href="{{route('halaman-login')}}">tautan ini</a> atau copy paste link {{ route('halaman-login') }} dibrowser anda.
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
	<p style="color:red;font-size: 12px">The information contained in this communication is intended solely for the use of the individual or entity to whom it is addressed and others authorized to receive it. It may contain confidential or legally privileged information. If you are not the intended recipient you are notified that any disclosure, copying, distribution or taking any action in reliance on the contents of this information is strictly prohibited and may be unlawful.</p>
	<hr>
	<p style="text-align: center;">&copy; 2019 PT. Nutrifood Indonesia | Sentul Integrated System</p>
	
</body>

</html>
