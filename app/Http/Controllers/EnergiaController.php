<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Energia;
use App\Persona;
use App\Puesto;
use App\Services\BitacoraService;
use Carbon\Carbon;

class EnergiaController extends Controller
{
    protected $bitacoraService;

    public function __construct(BitacoraService $bitacoraService)
    {
        $this->bitacoraService = $bitacoraService;
    }

    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;


        if ($buscar == '') {
            $energias = Energia::join('puestos', 'energias.idpuesto', '=', 'puestos.id')
                ->join('personas', 'puestos.idpersona', '=', 'personas.id')
                ->select(
                    'energias.id',
                    'energias.idpuesto',
                    'personas.nombre as nombre_persona',
                    'puestos.numpuesto',
                    'puestos.numcontador',
                    'puestos.area',
                    'energias.lecturaanterior',
                    'energias.lecturaactual',
                    'energias.costokwh',
                    'energias.fechavencimiento',
                    'energias.fechainicio',
                    'energias.fechafin',
                    'energias.mesfacturado',
                    'energias.fechaemision',
                    'energias.consumo',
                    'energias.totalpago',
                    'energias.estado'
                )
                ->orderBy('energias.id', 'desc')->paginate(10);
        } else {
            $energias = Energia::join('puestos', 'energias.idpuesto', '=', 'puestos.id')
                ->join('personas', 'puestos.idpersona', '=', 'personas.id')
                ->select(
                    'energias.id',
                    'energias.idpuesto',
                    'personas.nombre as nombre_persona',
                    'puestos.numpuesto',
                    'puestos.numcontador',
                    'puestos.area',
                    'energias.lecturaanterior',
                    'energias.lecturaactual',
                    'energias.costokwh',
                    'energias.fechavencimiento',
                    'energias.fechainicio',
                    'energias.fechafin',
                    'energias.mesfacturado',
                    'energias.fechaemision',
                    'energias.consumo',
                    'energias.totalpago',
                    'energias.estado'
                )
                //->where('personas.'.$criterio,'like','%'. $buscar .'%')
                ->Where('puestos.' . $criterio, 'like', '%' . $buscar . '%')
                ->orderBy('energias.id', 'desc')->paginate(10);
        }

        return [
            'pagination' => [
                'total' => $energias->total(),
                'current_page' => $energias->currentPage(),
                'per_page' => $energias->perPage(),
                'last_page' => $energias->lastPage(),
                'from' => $energias->firstItem(),
                'to' => $energias->lastItem(),
            ],
            'energias' => $energias
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        //$image_data = $request->imagen;
        //$encoded_image = base64_encode($image_data);

        $energias = new Energia();
        $energias->idpuesto = $request->idpuesto;
        //$energias->idpersona=$request->idpersona;
        /*$energias->numpuesto=$request->numpuesto;
        $energias->numcontador=$request->numcontador;
        $energias->area=$request->area;*/
        $energias->lecturaanterior = $request->lecturaanterior;
        $energias->lecturaactual = $request->lecturaactual;
        $energias->costokwh = $request->costokwh;
        $energias->fechavencimiento = $request->fechavencimiento;
        $energias->fechainicio = $request->fechainicio;
        $energias->fechafin = $request->fechafin;
        $energias->mesfacturado = $request->mesfacturado;
        $energias->fechaemision = $request->fechaemision;
        $energias->consumo = $request->consumo;
        $energias->totalpago = $request->totalpago;
        $energias->estado = '1';
        $energias->save();

        $this->bitacoraService->store('Creación de registro', 'Energia');
        return "Éxito";
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $energias = Energia::findOrFail($request->id);
        $energias->idpuesto = $request->idpuesto;
        $energias->lecturaanterior = $request->lecturaanterior;
        $energias->lecturaactual = $request->lecturaactual;
        $energias->costokwh = $request->costokwh;
        $energias->fechavencimiento = $request->fechavencimiento;
        $energias->fechainicio = $request->fechainicio;
        $energias->fechafin = $request->fechafin;
        $energias->mesfacturado = $request->mesfacturado;
        $energias->fechaemision = $request->fechaemision;
        $energias->consumo = $request->consumo;
        $energias->totalpago = $request->totalpago;
        $energias->estado = '1';
        $energias->save();

        $this->bitacoraService->store('Actualización de registro', 'Energia');
        return "Éxito";
    }

    public function desactivarFactura(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $energia = Energia::findOrFail($request->id);
        $energia->estado = '0';
        $energia->save();

        $this->bitacoraService->store('Factura pagada', 'Energia');
        return "Éxito";
    }

    public function activarFactura(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $energia = Energia::findOrFail($request->id);
        $energia->estado = '1';
        $energia->save();

        $this->bitacoraService->store('Rectificación de pago de factura', 'Energia');
        return "Éxito";
    }

    //Función que obtiene los tipos de equipos activos (taller=equipo)
    public function getFacturasActivas(Request $request)
    {
        $facturas = DB::table('energias')->Where('estado', 1)->get();
        return $facturas;
    }

    //Genera el reporte completo de todos los registros ingresados
    public function generarReporteEnergia()
    {

        $energias = Energia::join('puestos', 'energias.idpuesto', '=', 'puestos.id')
            ->join('personas', 'puestos.idpersona', '=', 'personas.id')
            ->select(
                'energias.id',
                'energias.idpuesto',
                'personas.nombre as nombre_persona',
                'puestos.numpuesto',
                'puestos.numcontador',
                'puestos.area',
                'energias.lecturaanterior',
                'energias.lecturaactual',
                'energias.costokwh',
                'energias.fechavencimiento',
                'energias.fechainicio',
                'energias.fechafin',
                'energias.mesfacturado',
                'energias.fechaemision',
                'energias.consumo',
                'energias.totalpago',
                'energias.estado'
            )
            ->orderBy('energias.mesfacturado', 'desc')->get();

        $cont = $energias->count();
        $sumconsumo = $energias->sum('consumo');
        $sumpagos = $energias->sum('totalpago');
        $pdf = \PDF::loadView('pdf.reporteenergiaspdf', ['energias' => $energias, 'cont' => $cont, 'sumconsumo' => $sumconsumo, 'sumpagos' => $sumpagos]);
        return $pdf->setPaper('letter', 'landscape')->stream('ReporteEnergia.pdf');
    }

    //Filtro para generar reportes por rango de fechas y facturas no pagadas
    public function filtropago()
    {

        $energias = Energia::join('puestos', 'energias.idpuesto', '=', 'puestos.id')
            ->join('personas', 'puestos.idpersona', '=', 'personas.id')
            ->select(
                'energias.id',
                'energias.idpuesto',
                'personas.nombre as nombre_persona',
                'puestos.numpuesto',
                'puestos.numcontador',
                'puestos.area',
                'energias.lecturaanterior',
                'energias.lecturaactual',
                'energias.costokwh',
                'energias.fechavencimiento',
                'energias.fechainicio',
                'energias.fechafin',
                'energias.mesfacturado',
                'energias.fechaemision',
                'energias.consumo',
                'energias.totalpago',
                'energias.estado'
            )
            ->Where('energias.estado', 1)
            ->orderBy('energias.mesfacturado', 'desc')->get();
        $cont = $energias->count();
        $sumconsumo = $energias->sum('consumo');
        $sumpagos = $energias->sum('totalpago');
        $pdf = \PDF::loadView('pdf.reporteenergiaspdf', ['energias' => $energias, 'cont' => $cont, 'sumconsumo' => $sumconsumo, 'sumpagos' => $sumpagos]);
        return $pdf->setPaper('letter', 'landscape')->stream('ReporteEnergia.pdf');
    }

    //Filtro para generar reportes por numero de puesto específico
    public function filtropuesto(Request $request, $puesto)
    {

        $energias = Energia::join('puestos', 'energias.idpuesto', '=', 'puestos.id')
            ->join('personas', 'puestos.idpersona', '=', 'personas.id')
            ->select(
                'energias.id',
                'energias.idpuesto',
                'personas.nombre as nombre_persona',
                'puestos.numpuesto',
                'puestos.numcontador',
                'puestos.area',
                'energias.lecturaanterior',
                'energias.lecturaactual',
                'energias.costokwh',
                'energias.fechavencimiento',
                'energias.fechainicio',
                'energias.fechafin',
                'energias.mesfacturado',
                'energias.fechaemision',
                'energias.consumo',
                'energias.totalpago',
                'energias.estado'
            )
            ->where([['numpuesto', '=', $puesto]])
            ->orderBy('energias.mesfacturado', 'desc')->get();
        $cont = $energias->count();
        $sumconsumo = $energias->sum('consumo');
        $sumpagos = $energias->sum('totalpago');
        $pdf = \PDF::loadView('pdf.reporteenergiaspdf', ['energias' => $energias, 'cont' => $cont, 'sumconsumo' => $sumconsumo, 'sumpagos' => $sumpagos]);
        return $pdf->setPaper('letter', 'landscape')->stream('ReporteEnergia.pdf');
    }

    //Filtro para generar reportes por rango de fechas de todos las facturas ingresadas en ese período
    public function filtrofechamensual(Request $request, $inicio, $fin)
    {

        $energias = Energia::join('puestos', 'energias.idpuesto', '=', 'puestos.id')
            ->join('personas', 'puestos.idpersona', '=', 'personas.id')
            ->select(
                'energias.id',
                'energias.idpuesto',
                'personas.nombre as nombre_persona',
                'puestos.numpuesto',
                'puestos.numcontador',
                'puestos.area',
                'energias.lecturaanterior',
                'energias.lecturaactual',
                'energias.costokwh',
                'energias.fechavencimiento',
                'energias.fechainicio',
                'energias.fechafin',
                'energias.mesfacturado',
                'energias.fechaemision',
                'energias.consumo',
                'energias.totalpago',
                'energias.estado'
            )
            ->where([['mesfacturado', '>=', $inicio]])
            ->Where([['mesfacturado', '<=', $fin]])
            ->orderBy('energias.mesfacturado', 'desc')->get();
        $cont = $energias->count();
        $sumconsumo = $energias->sum('consumo');
        $sumpagos = $energias->sum('totalpago');
        $pdf = \PDF::loadView('pdf.reporteenergiaspdf', ['energias' => $energias, 'cont' => $cont, 'sumconsumo' => $sumconsumo, 'sumpagos' => $sumpagos]);
        return $pdf->setPaper('letter', 'landscape')->stream('ReporteEnergia.pdf');
    }
    //Función para generar factura de energía eléctrica
    public function facturaPDF(Request $request, $id)
    {
        $energias = Energia::join('puestos', 'energias.idpuesto', '=', 'puestos.id')
            ->join('personas', 'puestos.idpersona', '=', 'personas.id')
            ->select(
                'energias.id',
                'energias.idpuesto',
                'personas.nombre as nombre_persona',
                'puestos.numpuesto',
                'puestos.numcontador',
                'puestos.area',
                'energias.lecturaanterior',
                'energias.lecturaactual',
                'energias.costokwh',
                'energias.fechavencimiento',
                'energias.fechainicio',
                'energias.fechafin',
                'energias.mesfacturado',
                'energias.fechaemision',
                'energias.consumo',
                'energias.totalpago',
                'energias.estado'
            )
            ->Where('energias.id', $id)->get();
        // ->orderBy('energias.fechavencimiento','desc')->get();

        $pdf = \PDF::loadView('pdf.facturapdf', ['energias' => $energias]);
        return $pdf->stream('FacturaEnergia.pdf');
    }
}
