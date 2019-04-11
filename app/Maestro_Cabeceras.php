<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maestro_Cabeceras extends Model
{
    protected $table = 'maestro_cabeceras';
    protected $primaryKey = 'n_id';
    protected $fillable = ['t_nombre','t_descripcion','l_estado'];

    public function maestrodetalles ()
    {
        return $this->hasMany('App\Maestro_Detalles');
    }
}
