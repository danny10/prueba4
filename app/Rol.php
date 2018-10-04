<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{   
    protected $table = 'roles';
    protected $fillable = ['nombre','descripcion','condicion'];
    public $timestamps = false;

    public function user()
    {
        return $this->hasMany('App\User'); // hace referencia a una relacion de 1 a muchos
    }
}
