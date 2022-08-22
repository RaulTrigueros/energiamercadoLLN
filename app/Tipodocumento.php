<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipodocumento extends Model
{
    protected $fillable = ['nombre','descripcion']; 

    public function solicituddocumento(){
        return $this->hasMany('App\Solicituddocumento');
    }
    
}
