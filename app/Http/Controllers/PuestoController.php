<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Puesto;
use App\Persona;
use App\Services\BitacoraService;

class PuestoController extends Controller
{
    protected $bitacoraService;

    public function __construct(BitacoraService $bitacoraService)
    {
        $this->bitacoraService = $bitacoraService;
    }

    public function index(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar==''){
            $puestos = Puesto::join('personas','puestos.idpersona','=','personas.id')
            ->select('puestos.id','puestos.idpersona','personas.nombre as nombre_persona',
                     'puestos.numpuesto','puestos.numcontador','puestos.area')
            ->orderBy('puestos.id','desc')->paginate(10);
        }else{
            $puestos = Puesto::join('personas','puestos.idpersona','=','personas.id')
            ->select('puestos.id','puestos.idpersona','personas.nombre as nombre_persona',
                     'puestos.numpuesto','puestos.numcontador','puestos.area')
            ->Where('puestos.'.$criterio,'like','%'. $buscar .'%')
            ->orderBy('puestos.id','desc')->paginate(10);
        }
        
         return [
            'pagination'=> [
                'total' => $puestos->total(),
                'current_page' => $puestos->currentPage(),
                'per_page' => $puestos->perPage(),
                'last_page' => $puestos->lastPage(),
                'from' => $puestos->firstItem(),
                'to' => $puestos->lastItem(),
            ],
            'puestos' => $puestos
        ];
    }

    public function store(Request $request)
    {
        $puestos = new Puesto();
        $puestos->idpersona=$request->idpersona;
        $puestos->numpuesto=$request->numpuesto;
        $puestos->numcontador=$request->numcontador;
        $puestos->area=$request->area;
        $puestos->save();

        $this->bitacoraService->store('Creación de registro', 'Puesto');
        return "Éxito";
    }

    public function update(Request $request)
    {
        $puestos = Puesto::findOrFail($request->id);
        $puestos->idpersona=$request->idpersona;
        $puestos->numpuesto=$request->numpuesto;
        $puestos->numcontador=$request->numcontador;
        $puestos->area=$request->area;
        $puestos->save();

        $this->bitacoraService->store('Actualización de registro', 'Puesto');
        return "Éxito";
    }

    public function selectPuesto(Request $request){
        if (!$request->ajax()) return redirect('/');
 
        $filtro = $request->filtro;
        $puestos = Puesto::where('numpuesto', 'like', '%'. $filtro . '%')
        ->orWhere('area', 'like', '%'. $filtro . '%')
        ->select('id','numpuesto','numcontador','area')
        ->orderBy('numpuesto', 'asc')->get();
 
        return ['puestos' => $puestos];
    }

    public function destroy(Request $request)
    {
        $puestos = Puesto::findOrFail($request->id);
        $puestos->delete();

        $this->bitacoraService->store('Eliminación de registro', 'Puesto');
        return "Éxito";
        
    }

}
