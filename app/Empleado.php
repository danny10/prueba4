<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $fillable = ['empresa_id','cedula','nombre','apellido','telefono','direccion','condicion'];

    public function empresa()
    {
        return $this->belongsTo('App\Empresa'); //hacer referencia al modelo empresa por la relacion que tiene con la tabla
    }
}
