@extends('plantilla/portal')
@section('contenido')
<div class="container">
    <template>
        <Solicituddocumentoregistro></Solicituddocumentoregistro>
    </template>
</div>

<input class="form-control" type="hidden" name="" id="variable" value="{{$log}}">

@endsection

