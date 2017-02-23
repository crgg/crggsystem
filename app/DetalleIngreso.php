<?php

namespace crggWebsite;

use Illuminate\Database\Eloquent\Model;

class DetalleIngreso extends Model
{
     protected $table = 'detalle_ingreso';     
     protected $primaryKey='iddetalleingreso';

    
    public $timestamps=false;

    protected $fillable= [
    'idingreso',
    'idarticulo',
    'cantidad',
    'precio_compra',
    'precio_venta'

    ];

    protected $guarded =[
    	
    ];
}
