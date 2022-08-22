@extends('plantilla/principal')
@section('contenido')

  


<div class="container">
  <template v-if="menu==0">

    <div align="center">
      <img class="navbar-brand-full" src="img/isotipo_blanco.png" width="50%" height="auto" alt="Logo AMSPT">
    </div>

  </template>

  @if (Auth::check())
          @if(Auth::user()->idrol==1)
          <template v-if="menu==70">
          <energia></energia>
          </template>
          <template v-if="menu==71">
          <cliente></cliente>
          </template>
          <template v-if="menu==72">
          <puesto></puesto>
          </template>
          <template v-if="menu==1">
            <combustible></combustible>
          </template>
          <template v-if="menu==2">
            <anuncio>
            </anuncio>
          </template>
          <template v-if="menu==3">
            <usuario></usuario>
          </template>
          <template v-if="menu==4">
            <rol></rol>
          </template>
          <template v-if="menu==5">
            <transparencia-dashboard></transparencia-dashboard>
          </template>
          <template v-if="menu==6">
            <logout></logout>
          </template>
          <template v-if="menu==7">
            <noticia></noticia>
          </template>
          <template v-if="menu==8">
            <Solicituddocumento></Solicituddocumento>
          </template>
          <template v-if="menu==9">
            <Solicitudpartida></Solicitudpartida>
          </template>
          <template v-if="menu==10">
            <servicios></servicios>
          </template>
          <template v-if="menu==11">
            <nacimiento></nacimiento>
          </template>
          <template v-if="menu==12">
            <defuncion></defuncion>
          </template>
          <template v-if="menu==16">
            <matrimonio></matrimonio>
          </template>
          <template v-if="menu==20">
            <proyecto></proyecto>
          </template>
          <template v-if="menu==21">
            <encargado></encargado>
          </template>
          <template v-if="menu==22">
            <actividad></actividad>
          </template>
          <template v-if="menu==23">
            <manuales-dash></manuales-dash>
          </template>
          <template v-if="menu==30">
            <carrusel-dash></carrusel-dash>
          </template>
          <template v-if="menu==50">
            <bitacora></bitacora>
          </template>
          <template v-if="menu==60">
            <contactos></contactos>
          </template>
          <template v-if="menu==61">
            <preguntas></preguntas>
          </template>
            <template v-if="menu==62">
            <organigrama></organigrama>
          </template>  

          @elseif(Auth::user()->idrol==2)
          <template v-if="menu==70">
          <energia></energia>
          </template>
          <template v-if="menu==71">
          <cliente></cliente>
          </template>
          <template v-if="menu==72">
          <puesto></puesto>
          </template>
          
          @elseif(Auth::user()->idrol==3)
          <template v-if="menu==1">
            <combustible></combustible>
          </template>
          <template v-if="menu==2">
            <anuncio>
            </anuncio>
          </template>
          <template v-if="menu==3">
            <usuario></usuario>
          </template>
          <template v-if="menu==4">
            <rol></rol>
          </template>
          <template v-if="menu==5">
            <transparencia-dashboard></transparencia-dashboard>
          </template>
          <template v-if="menu==6">
            <logout></logout>
          </template>
          <template v-if="menu==7">
            <noticia></noticia>
          </template>
          <template v-if="menu==8">
            <Solicituddocumento></Solicituddocumento>
          </template>
          <template v-if="menu==9">
            <Solicitudpartida></Solicitudpartida>
          </template>

          <template v-if="menu==10">
            <servicios></servicios>
          </template>
          <template v-if="menu==11">
            <nacimiento></nacimiento>
          </template>
          <template v-if="menu==12">
            <defuncion></defuncion>
          </template>
          <template v-if="menu==16">
            <matrimonio></matrimonio>
          </template>
          <template v-if="menu==20">
            <proyecto></proyecto>
          </template>
          <template v-if="menu==21">
            <encargado></encargado>
          </template>
          <template v-if="menu==22">
            <actividad></actividad>
          </template>
          <template v-if="menu==23">
            <manuales-dash></manuales-dash>
          </template>
          <template v-if="menu==30">
            <carrusel-dash></carrusel-dash>
          </template>
          <template v-if="menu==50">
            <bitacora></bitacora>
          </template>
          <template v-if="menu==60">
            <contactos></contactos>
          </template>
          <template v-if="menu==61">
            <preguntas></preguntas>
          </template>
            <template v-if="menu==62">
            <organigrama></organigrama>
          </template>     
          @else
          @endif
  @endif

  <input class="form-control" type="hidden" name="" id="rol-admin" value="{{$rol}}">
</div>
@endsection