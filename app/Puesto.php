<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
    protected $fillable=[
        'idpersona',
        'numpuesto',
        'numcontador',
        'area'
    ];
    
    public function persona(){
        return $this->belongsTo('App\Persona'); 
    }

    public function energias(){
        return $this->hasMany('App\Energia');
    }
}
