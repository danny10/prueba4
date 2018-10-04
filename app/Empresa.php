<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $fillable = ['nit','nombre','telefono','direccion','condicion'];

    public function empleados()
    {
        return $this->hasMany('App\Empleado'); // hace referencia a una relacion de 1 a muchos
    }

}
