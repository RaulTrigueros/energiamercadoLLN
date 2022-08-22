<?php

namespace App\Http\Controllers;

use App\Bitacora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\BitacoraService;

class BitacoraController extends Controller
{
    public function index(Request $request)
    {

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar==''){
            $bitacoras = Bitacora::select('id','usuario','accion','tabla','created_at as fecha')
                ->orderBy('id','desc')->paginate(10);
        }else{
            $bitacoras = Bitacora::select('id','usuario','accion','tabla','created_at as fecha')
                ->where($criterio,'like','%'. $buscar .'%')
                ->orderBy('id','desc')->paginate(10);
        }

        return [
            'pagination'=> [
                'total' => $bitacoras->total(),
                'current_page' => $bitacoras->currentPage(),
                'per_page' => $bitacoras->perPage(),
                'last_page' => $bitacoras->lastPage(),
                'from' => $bitacoras->firstItem(),
                'to' => $bitacoras->lastItem(),
            ],
            'bitacoras' => $bitacoras
        ];
    }

}
