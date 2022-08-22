<?php

namespace App\Services;

use App\Bitacora;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BitacoraService
{
    public function store($accion, $tabla)
    {
        $usuario = Auth::user()->usuario;
        $bitacora = new Bitacora();
        $bitacora->usuario = $usuario;
        $bitacora->accion = $accion;
        $bitacora->tabla = $tabla;

        try {
            $bitacora->save();
        } catch (\Throwable $th) {
            return $th;
        }

    }

}
