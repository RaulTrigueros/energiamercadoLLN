<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta name="description" content="Sistema informático para la gestión de procesos municipales">
  <meta name="author" content="Ing. Raúl Trigueros">
  <meta name="keyword" content="Alcaldía, Tacachico, Municipio, Servicios generales, combustible, energia electrica">
  
  <title>Alcaldia SPT</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">


  <link href="css/portal/portal.css" rel="stylesheet">
  <link href="css/general.css" rel="stylesheet">


</head>

<body class="app flex-row align-items-center">
  <div class="container">
    @yield('contenido')
  </div>


  <script src="js/general.js"></script>
  <script src="js/portal/portal.js"></script>
  <script src="js/app.js"></script>


</body>

</html>