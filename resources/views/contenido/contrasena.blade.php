
<!--@section('contenido')-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
  <meta name="author" content="Łukasz Holeczek">
  <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
  <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
<!--  <title>Modificar Contraseña</title>-->
  <meta name="csrf-token" content="{{ csrf_token() }}">

 <link href="/css/app.css" rel="stylesheet">
  <link href="css/portal/portal.css" rel="stylesheet">
  <link href="css/general.css" rel="stylesheet">

  <style >
      button{align-content: center; align:center}
      a{font-family:Times New Roman;color:black}
      title{background-color: navy;background-size: 12px}
    .text-danger{color: red}
    .errors {color:red}
    .div-error{
        display: flex;
        justify-content: center;
        color: red;
    }
    
    h1{color:black; font-family:Times New Roman}
    form {width:400px;font-family:Times New Roman  ;background:silver;
    padding: 3px 10px;
    border:#3D3D3D 5px solid;
    border-radius: 20px;
    }
    form input {font-family:Arial;}
    form>div {margin:5px; color: black}
   
  </style>
</head>
<body>
@if (Session::has('message'))
 <div class="text-danger">
 {{Session::get('message')}}
 </div>
@endif

<form method="post" action="{{url('user/updatepassword')}}">
 {{csrf_field()}}
 <div>
 <h1>Cambiar mi password</h1>
 </div>
 <hr />
 <div class="form-group">
  <label for="mypassword">Introduce tu actual password:</label>
  <input type="password" name="mypassword" class="form-control">
  <div class="text-danger">{{$errors->first('mypassword')}}</div>
 </div>
 <div class="form-group">
  <label for="password">Introduce tu nuevo password:</label>
  <input type="password" name="password" class="form-control">
  <div class="text-danger">{{$errors->first('password')}}</div>
 </div>
 <div class="form-group">
  <label for="mypassword">Confirma tu nuevo password:</label>
  <input type="password" name="password_confirmation" class="form-control">
 </div>
 <button align="center" type="submit" class="btn btn-primary">Cambiar mi password</button>
 
 </br></br>
 <button type="button" class="btn btn-primary" >
<a class="btn btn-primary" href="/main" target="_blank">Regresar</a>
</button>
</form>


@if(session('message')) {{session('message')}} @endif 
@if(session()->has('alert-success')) 
 {{ session()->get('alert-success') }} 
 @endif 
</body>
</html>

