@extends('plantilla/portal')
@section('contenido')
<div class="container">
    <template>
        <transparencia-portal></transparencia-portal>
    </template>
</div>

<input class="form-control" type="hidden" name="" id="variable" value="{{$log}}">

@endsection