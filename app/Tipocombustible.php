<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipocombustible extends Model
{
    protected $fillable = ['nombequipo','descripcionequipo']; 

    public function combustibles(){
        return $this->hasMany('App\Combustible');
    }
}
