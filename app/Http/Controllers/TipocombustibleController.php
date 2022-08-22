<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tipocombustible;

class TipocombustibleController extends Controller
{
    public function selectTipocombustible(Request $request){
        //if(!$request->ajax()) return redirect('/');
        $tipocombustibles = Tipocombustible::select('id','nombequipo')->orderBy('nombequipo','asc')->get();

        return ['tipocombustibles' => $tipocombustibles];
    }
}
