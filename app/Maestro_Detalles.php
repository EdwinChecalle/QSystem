<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maestro_Detalles extends Model
{
    protected $table = 'maestro_detalles';
    protected $primaryKey = 'n_id';
    protected $fillable = ['n_id_maestrocabecera','c_codigodetalle','t_nombre','t_nombrecorto','t_referencia','l_estado'
    ];

    public function maestrocabecera(){
        return $this->belongsTo('App\Maestro_Cabeceras');
    }
}
