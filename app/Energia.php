<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Energia extends Model
{
    protected $fillable=[
      /*  'idpersona',
        'numpuesto',
        'numcontador',
        'area',*/
        'idpuesto',
        'lecturaanterior',
        'lecturaactual',
        'costokwh',
        'fechavencimiento',
        'fechainicio',
        'fechafin',
        'mesfacturado',
        'fechaemision',
        'consumo',
        'totalpago',
        'estado'
    ];
   /* public function persona(){
        return $this->belongsTo('App\Persona'); 
    }*/
    public function puesto(){
        return $this->belongsTo('App\Puesto'); 
    }
}
