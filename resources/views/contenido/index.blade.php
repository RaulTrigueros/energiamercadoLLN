@extends('plantilla/portal')
@section('contenido')
<!-- Masthead -->
<header class="masthead bg-primary text-white text-center" style="margin-top:-150px">
  <div class="container d-flex align-items-center flex-column">

    <carrusel-portal></carrusel-portal>

    <!-- Masthead Heading -->
    <h1 class="masthead-heading text-uppercase mb-0 mt-5">Alcaldía Municipal de La Libertad Norte
    <!-- Icon Divider -->
    <div class="divider-custom divider-light">
      <div class="divider-custom-line"></div>
     
      <div class="divider-custom-line"></div>
    </div>

    <!-- Masthead Subheading -->
    <p class="masthead-subheading font-weight-light mb-0">Alcalde: Jorge Escamilla</p>
  </div>
  <input class="form-control" type="hidden" name="" id="variable" value="{{$log}}">
</header>
@endsection