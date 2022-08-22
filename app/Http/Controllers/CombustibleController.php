<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Combustible;
use App\Inscripcion;
use App\Services\BitacoraService;

class CombustibleController extends Controller
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
            $combustibles = Combustible::join('tipocombustibles','combustibles.idtipocombustible','=','tipocombustibles.id')
            ->select('combustibles.id','combustibles.fecha','combustibles.idtipocombustible','tipocombustibles.nombequipo as nombre_tipocombustible',
                     'combustibles.nombre','combustibles.numrequerimiento','combustibles.numvale','combustibles.numgalones','combustibles.preciogalon',
                     'combustibles.valorfactura','combustibles.numfactura','combustibles.descripcion','combustibles.estado')
            ->orderBy('combustibles.id','desc')->paginate(3);
        }else{
            $combustibles = Combustible::join('tipocombustibles','combustibles.idtipocombustible','=','tipocombustibles.id')
            ->select('combustibles.id','combustibles.fecha','combustibles.idtipocombustible','tipocombustibles.nombequipo as nombre_tipocombustible',
                     'combustibles.nombre','combustibles.numrequerimiento','combustibles.numvale','combustibles.numgalones','combustibles.preciogalon',
                     'combustibles.valorfactura','combustibles.numfactura','combustibles.descripcion','combustibles.estado')
            ->where('tipocombustibles.'.$criterio,'like','%'. $buscar .'%')
          //  ->Where('combustibles.'.$criterio,'like','%'. $buscar .'%')
            ->orderBy('combustibles.id','desc')->paginate(3);
        }
        
         return [
            'pagination'=> [
                'total' => $combustibles->total(),
                'current_page' => $combustibles->currentPage(),
                'per_page' => $combustibles->perPage(),
                'last_page' => $combustibles->lastPage(),
                'from' => $combustibles->firstItem(),
                'to' => $combustibles->lastItem(),
            ],
            'combustibles' => $combustibles
        ];
    }
    
    public function store(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        //$image_data = $request->imagen;
        //$encoded_image = base64_encode($image_data);

        $combustible = new Combustible();
        $combustible->fecha=$request->fecha;
        $combustible->idtipocombustible=$request->idtipocombustible;
        $combustible->nombre = $request->nombre;
        $combustible->numrequerimiento=$request->numrequerimiento;
        $combustible->numvale=$request->numvale;
        $combustible->numgalones=$request->numgalones;
        $combustible->preciogalon=$request->preciogalon;
        $combustible->valorfactura=$request->valorfactura;
        $combustible->numfactura=$request->numfactura;
        $combustible->descripcion = $request->descripcion;
        $combustible->estado= '1';
        $combustible->save();

        $this->bitacoraService->store('Creación de registro', 'Combustible');
        return "Éxito";
    }
    
    public function update(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        $combustible = Combustible::findOrFail($request->id);
        $combustible->fecha=$request->fecha;
        $combustible->idtipocombustible=$request->idtipocombustible;
        $combustible->nombre = $request->nombre;
        $combustible->numrequerimiento=$request->numrequerimiento;
        $combustible->numvale=$request->numvale;
        $combustible->numgalones=$request->numgalones;
        $combustible->preciogalon=$request->preciogalon;
        $combustible->valorfactura=$request->valorfactura;
        $combustible->numfactura=$request->numfactura;
        $combustible->descripcion = $request->descripcion;
        $combustible->estado= '1';
        $combustible->save();

        $this->bitacoraService->store('Actualización de registro', 'Combustible');
        return "Éxito";
    }
    
    public function desactivar(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        $combustible = Combustible::findOrFail($request->id);
        $combustible-> estado = '0';
        $combustible->save();

        $this->bitacoraService->store('Desactivación de registro', 'Combustible');
        return "Éxito";
    }

    public function activar(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        $combustible = Combustible::findOrFail($request->id);
        $combustible-> estado = '1';
        $combustible->save();

        $this->bitacoraService->store('Activación de registro', 'Combustible');
        return "Éxito";
    }
    
    //Función que obtiene los tipos de equipos activos (taller=equipo)
    public function getTalleresActivos(Request $request){
        $talleres = DB::table('combustibles')->Where('estado', 1)->get();
        return $talleres;
    }
  
    //Genera el reporte completo de todos los registros ingresados
    public function generarReporteCombustible(){
        
         $combustibles = Combustible::join('tipocombustibles','combustibles.idtipocombustible','=','tipocombustibles.id')
         ->select('combustibles.id','combustibles.fecha','combustibles.idtipocombustible','tipocombustibles.nombequipo as nombre_tipocombustible',
                  'combustibles.nombre','combustibles.numrequerimiento','combustibles.numvale','combustibles.numgalones','combustibles.preciogalon',
                  'combustibles.valorfactura','combustibles.numfactura','combustibles.descripcion','combustibles.estado')
         ->Where('estado', 1)
         ->orderBy('combustibles.fecha','desc')->get();
        
         $cont=$combustibles->count();
         $sumgalones=$combustibles->sum('numgalones');
         $sumfactura=$combustibles->sum('valorfactura');
         $pdf= \PDF::loadView('pdf.combustiblespdf',['combustibles'=>$combustibles,'cont'=>$cont,'sumgalones'=>$sumgalones,'sumfactura'=>$sumfactura]);
         return $pdf->setPaper('letter', 'landscape')->stream('ReporteCombustible.pdf');
    }
    
    //Filtro para generar reportes por rango de fechas y equipo específico
    public function filtrofecha(Request $request,$inicio,$fin,$equipo){
        
        $combustibles = Combustible::join('tipocombustibles','combustibles.idtipocombustible','=','tipocombustibles.id')
        ->select('combustibles.id','combustibles.fecha','combustibles.idtipocombustible','tipocombustibles.nombequipo as nombre_tipocombustible',
                 'combustibles.nombre','combustibles.numrequerimiento','combustibles.numvale','combustibles.numgalones','combustibles.preciogalon',
                 'combustibles.valorfactura','combustibles.numfactura','combustibles.descripcion','combustibles.estado')
        ->where([['fecha','>=',$inicio]])
        ->Where([['fecha','<=',$fin]])
        ->where([['idtipocombustible','=',$equipo]])
        ->Where('estado', 1)
        ->orderBy('combustibles.fecha','desc')->get();
     $cont=$combustibles->count();
     $sumgalones=$combustibles->sum('numgalones');
     $sumfactura=$combustibles->sum('valorfactura');
     $pdf= \PDF::loadView('pdf.combustiblespdf',['combustibles'=>$combustibles,'cont'=>$cont,'sumgalones'=>$sumgalones,'sumfactura'=>$sumfactura]);
     return $pdf->setPaper('letter', 'landscape')->stream('ReporteCombustible.pdf');
      
    }

     //Filtro para generar reportes por equipo específico
    public function filtroequipo(Request $request,$equipo){
        
        $combustibles = Combustible::join('tipocombustibles','combustibles.idtipocombustible','=','tipocombustibles.id')
        ->select('combustibles.id','combustibles.fecha','combustibles.idtipocombustible','tipocombustibles.nombequipo as nombre_tipocombustible',
                 'combustibles.nombre','combustibles.numrequerimiento','combustibles.numvale','combustibles.numgalones','combustibles.preciogalon',
                 'combustibles.valorfactura','combustibles.numfactura','combustibles.descripcion','combustibles.estado')
        ->where([['idtipocombustible','=',$equipo]])
        ->Where('estado', 1)
        ->orderBy('combustibles.fecha','desc')->get();
     $cont=$combustibles->count();
     $sumgalones=$combustibles->sum('numgalones');
     $sumfactura=$combustibles->sum('valorfactura');
     $pdf= \PDF::loadView('pdf.combustiblespdf',['combustibles'=>$combustibles,'cont'=>$cont,'sumgalones'=>$sumgalones,'sumfactura'=>$sumfactura]);
     return $pdf->setPaper('letter', 'landscape')->stream('ReporteCombustible.pdf');
      
    }

     //Filtro para generar reportes por rango de fechas de todos los equipos ingresados en ese período
    public function filtrofechamensual(Request $request,$inicio,$fin){
        
        $combustibles = Combustible::join('tipocombustibles','combustibles.idtipocombustible','=','tipocombustibles.id')
        ->select('combustibles.id','combustibles.fecha','combustibles.idtipocombustible','tipocombustibles.nombequipo as nombre_tipocombustible',
                 'combustibles.nombre','combustibles.numrequerimiento','combustibles.numvale','combustibles.numgalones','combustibles.preciogalon',
                 'combustibles.valorfactura','combustibles.numfactura','combustibles.descripcion','combustibles.estado')
        ->where([['fecha','>=',$inicio]])
        ->Where([['fecha','<=',$fin]])
        ->Where('estado', 1)
        ->orderBy('combustibles.fecha','desc')->get();
     $cont=$combustibles->count();
     $sumgalones=$combustibles->sum('numgalones');
     $sumfactura=$combustibles->sum('valorfactura');
     $pdf= \PDF::loadView('pdf.combustiblespdf',['combustibles'=>$combustibles,'cont'=>$cont,'sumgalones'=>$sumgalones,'sumfactura'=>$sumfactura]);
     return $pdf->setPaper('letter', 'landscape')->stream('ReporteCombustible.pdf');
      
    }

   public function destroy(Request $request)
    {
        $combustible = Combustible::findOrFail($request->id);
        $combustible->delete();

        $this->bitacoraService->store('Eliminación de registro', 'Combustible');
        return "Éxito";
        
    }
    
   
}
