@extends('plantilla/portal')
@section('contenido')
<div class="container">
    <template>
        <anuncioportal></anuncioportal>
    </template>
</div>

<input class="form-control" type="hidden" name="" id="variable" value="{{$log}}">

@endsection