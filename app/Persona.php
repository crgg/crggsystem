<?php

namespace crggWebsite;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
   protected $table = 'persona';
   protected $primaryKey='idpersona';

    
    public $timestamps=false;

    protected $fillable= [
    	'tipo_persona',
    	'nombre',
    	'tipo documento',
    	'num_documento',
    	'direccion',
    	'telefono',
    	'email',
    ];

    protected $guarded =[
    ];
}
