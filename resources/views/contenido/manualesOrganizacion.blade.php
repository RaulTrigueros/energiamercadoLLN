@extends('plantilla/portal')
@section('contenido')
<div class="container">
    <template>
        <manuales-portal></manuales-portal>
    </template>
</div>

<input class="form-control" type="hidden" name="" id="variable" value="{{$log}}">

@endsection