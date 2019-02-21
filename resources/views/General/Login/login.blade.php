<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Connect To Promix</title>
        <link rel="shortcut icon" href="{{asset('favicon.ico')}}"> 
        
        <link rel="stylesheet" href="{!!asset('generalStyle/css/bootstrap.min.css')!!}">
        <link rel="stylesheet" href="{!!asset('generalStyle/css/bootstrap.css')!!}">
        <link rel="stylesheet" type="text/css" href="{{asset('generalStyle/loginStyle/css/demo.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{asset('generalStyle/loginStyle/css/style.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{asset('generalStyle/loginStyle/css/animate-custom.css')}}" />
        
        <script src="{{asset('generalStyle/plugins/notifikasi/jquery.js')}}"></script>
        <script src="{{asset('generalStyle/plugins/notifikasi/bootstrap-notify.min.js')}}"></script>
        <script src="{{asset('generalStyle/plugins/notifikasi/bootstrap-notify.js')}}"></script>
        <style>
           
        </style>
    </head>
    <body onload="load()">
        <section class="">		
            <div id="container_demo" >
                <a class="hiddenanchor" id="toregister"></a>
                <a class="hiddenanchor" id="tologin"></a>
                <div id="wrapper">
                    <div id="login" class="animate form" style="margin-top:0px">
                        {!! Form::open(['url'=>'login/user']) !!}
                            <h1>Mollie</h1> 
                            <p> 
                                {!! Form::label('uname','Your Email',['class'=>'uname','data-icon'=>'u'])!!}
                                {!! Form::email('username',null,['id'=>'username','required'=>'required','placeholder'=>'example : nestamaulana@nutrifood.co.id','autocomplete'=>'no']) !!}
                                
                            </p>
                            <p>
                                {!! Form::label('password','Your Password',['class'=>'youpasswd','data-icon'=>'p'])!!}
                                {!! Form::password('password',['id'=>'password','required'=>'required','placeholder'=>'eg. S311135T4'])!!}
                            </p>
                            <p class="login button"> 
                                {!! Form::submit('Login',['name'=>'login']) !!}
							</p>
                            <p class="change_link">
								Don't Have An Account ?
								<a href="#toregister" class="to_register">Join with us</a>
							</p>
                        {!! Form::close() !!}
                    </div>

                    <div id="register" class="animate form" style="margin-top:-80px">
                        {!!Form::open(['url'=>'user/signup'])!!}
                            <h1>Sign up</h1> 
                            <p> 
                                {!! Form::label('usernamesignup','Fullname',['class'=>'uname','data-icon'=>'u'])!!}
                                {!! Form::text('fullname',null,['id'=>'usernamesignup','required'=>'required','placeholder'=>'Your Fullname']) !!}
                            </p>
                            <p> 
                                {!! Form::label('emailsignup','Your Email',['class'=>'youmail','data-icon'=>'e'])!!}
                                {!! Form::email('email',null,['required'=>'required','placeholder'=>'example@nutrifood.co.id']) !!}
                            </p>
                            <p> 
                                {!! Form::label('passwordsignup','Your Password',['class'=>'youpasswd','data-icon'=>'p']) !!}
                                {!! Form::password('password',['id'=>'passwordsignup','required'=>'required','placeholder'=>'eg. S311135T4']) !!}
                            </p>
                            <p>
                                {!! Form::label('passwordsignup_confirm','Please Confirm Your Password',['class'=>'youpasswd','data-icon'=>'p'])!!}
                                {!! Form::password('password_confirmation',['id'=>'passwordsignup_confirm','required'=>'required','placeholder'=>'eg. S311135T4'])!!}
                            </p>
                            <p>
                                {!! Form::label('roles','Roles Apps',['class'=>'select'])!!}
                                {!! Form::select('roles',$roles,'ada',['class'=>'custom-select']) !!}
                            </p>
                            <p class="signin button"> 
                                {!! Form::submit('Sign Up') !!}
                                {{-- <input type="submit" value="Sign up"/>  --}}
							</p>
                            <p class="change_link">  
								Have An Account ?
								<a href="#tologin" class="to_register"> Bring Me To Log In </a>
							</p>
                        {!!Form::close()!!}
                    </div>
					
                </div>
            </div>  
        </section>
        @if ($errors->any())
        <script>
            function load() 
            {    
                @foreach($errors->all() as $error)
                    $.notify({
                        title: "<strong>{{ $error }}</strong>",
                        message: " {{ $pesan }} "
                    },
                    {
                        type:'danger',
                    });
                @endforeach       
                
            }
        </script>
        @endif
    </body>
</html>