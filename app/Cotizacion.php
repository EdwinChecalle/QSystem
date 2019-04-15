<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    protected $table = 'cotizacion';
    protected $primaryKey = 'n_id';
    protected $fillable = ['n_tabla_tipoprenda','c_tipoprenda',
                           'n_tabla_modeloprenda','c_modeloprenda',
                           'n_tabla_tipotela','c_tipotela',
                           'n_tabla_tonotela','c_tonotela',
                           'n_tabla_tenidotela','c_tenidotela',
                           'n_tabla_grosortela','c_grosortela',
                           'n_precio','t_descripcion','l_estado'
                        ];
}
