<?php

namespace crggWebsite\Http\Controllers;

use Illuminate\Http\Request;

use crggWebsite\Http\Requests;

use Illuminate\Support\Facades\Redirect;

use DB;

class PdfController extends Controller
{
    

    public function index() 
    {
    	$pdf= \PDF::loadView('pdf_file/pdfView');
    	return $pdf->stream('filepdf.pdf');    	
    }

    public function categorias(Request $request) {

        $categorias = DB::table("categoria")->get();

        // view()->share('categorias',$categorias);

    		$pdf= \PDF::loadView('pdf_file/pdfView', ['categorias' => $categorias]);	
    	    return $pdf->stream('filepdf.pdf');    	
    }

    public function ventas($id){





		$venta= DB::table('venta as v')
    		->join('persona as p', 'v.idcliente','=','p.idpersona') 
    		->join('detalle_venta as dv','v.idventa','=','dv.idventa')   		
    		->select('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado', 'v.total_venta')
    		->where('v.idventa','=',$id)
    		->first();
    	$detalle = DB::table('detalle_venta as d')
    		->join('articulo as a','d.idarticulo','=','a.idarticulo')
    		->select('a.nombre as articulo','d.cantidad','d.descuento', 'd.precio_venta')
    		->where('d.idventa','=',$id)
    		->get();


    		$pdf= \PDF::loadView('pdf_file/pdfventa',["venta"=>$venta,"detalle"=>$detalle]);	
    	    return $pdf->stream('venta.pdf');   

}

    		// return View("ventas.venta.show", ["venta"=>$venta,"detalle"=>$detalle]);    		


}
