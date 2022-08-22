<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Combustible extends Model
{
    protected $fillable=[
        'fecha','idtipocombustible','nombre','numrequerimiento','numvale','numgalones','preciogalon','valorfactura','numfactura','descripcion','estado'
    ];
    public function tipocombustible(){
        return $this->belongsTo('App\Tipocombustible'); //tipocombustible hace referencia al tipo de equipo o maquinaria
    }
}
