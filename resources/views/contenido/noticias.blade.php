@extends('plantilla/portal')
@section('contenido')
<div class="container">
    <template>
        <noticiaportal></noticiaportal>
    </template>
</div>

<input class="form-control" type="hidden" name="" id="variable" value="{{$log}}">

@endsection
