<?php

namespace crggWebsite;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
     protected $table = 'venta';
     protected $primaryKey='idventa';

    
    public $timestamps=false;

    protected $fillable= [
    'idcliente',
    'tipo_comprobante',
    'serie_comprabante',
    'num_comprobante',
    'fecha_hora',
    'impuesto',
    'total_venta',
    'estado'
    ];

    protected $guarded =[
    ];
}
