<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tipodocumento;

class TipodocumentoController extends Controller
{
    public function selectTipodocumento(Request $request){
        //if(!$request->ajax()) return redirect('/');
        $tipodocumentos = Tipodocumento::select('id','nombre')->orderBy('nombre','asc')->get();

        return ['tipodocumentos' => $tipodocumentos];
    }
}
