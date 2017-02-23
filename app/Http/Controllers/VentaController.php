<?php

namespace crggWebsite\Http\Controllers;

use Illuminate\Http\Request;

use crggWebsite\Http\Requests;


use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Input;

use crggWebsite\Http\Requests\VentaFormRequest;

use crggWebsite\Venta;

use crggWebsite\DetalleVenta;

use DB;

// obtener la fecha
use Carbon\Carbon;

use Response;

use Illuminate\Support\Colletion;

class VentaController extends Controller

{
    public function __construct()
     {
        $this->middleware('auth');
    }


   public function index(Request $request)

     {
    	//  dd(Auth::user()->name);

    	if ($request)
    	{
    		$query = trim($request->get('searchText'));

    		$ventas = DB::table('ventas as v')
    		->join('persona as p', 'v.idcliente','=','p.idpersona')
    		->select('v.idventas','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante', 'v.num_comprobante','v.impuesto','v.estado','v.total_venta')
    		->where('v.num_comprobante','LIKE','%'.$query.'%')
    		->orderBy('idventas','desc')
    		->groupBY('v.idventas','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado')
    		->paginate(7);
    		return view('ventas.venta.index',["ventas"=>$ventas,"searchText"=>$query]);
    	}
    }

	public function create()
	{
		$personas=DB::table('persona')->where('tipo_persona','=','Cliente')->get();

		$articulos =DB::table('articulo as art')
			->join('detalle_ingreso as di','art.idarticulo','=','di.idarticulo')
			->select(DB::raw('CONCAT(art.codigo," ",art.nombre) AS articulo'), 'art.idarticulo','art.stock',
				DB::raw('avg(di.precio_venta) as precio_promedio'))
			->where('art.estado','=','ACTIVE')
			->where('art.stock','>', '0')
			->groupBY('articulo','art.idarticulo','art.stock')
			->get();
				// dd($articulos);
		return view("ventas.venta.create",["personas"=>$personas,"articulos"=>$articulos]);
	}

	public function store(VentaFormRequest $request)
	{
		try {

			DB::beginTransaction();

			$venta=new Venta;
			$venta->idcliente=$request->get('idcliente');
			$venta->tipo_comprobante=$request->get('tipo_comprobante');
			$venta->serie_comprobante=$request->get('serie_comprobante');
			$venta->num_comprobante=$request->get('num_comprobante');
			$venta->total_venta=$request->get('total_venta');
			$venta->fecha_hora = Carbon::now();
			$venta->impuesto='18';
			$venta->estado='A';
			$venta->save();

			$idarticulo = $request->get('idarticulo');
			$cantidad = $request->get('cantidad');
			$precio_venta = $request->get('precio_venta');
			$descuento = $request->get('descuento');

			 // var_dump($ingreso);

			$cont = 0;

			while($cont < count($idarticulo))
			{
				$detalle = new DetalleVenta();
				$detalle->idventa= $venta->idventa;
				$detalle->idarticulo= $idarticulo[$cont];
				$detalle->cantidad= $cantidad[$cont];
				$detalle->precio_venta= $precio_venta[$cont];
				$detalle->descuento=$descuento[$cont];
				$detalle->save();
				$cont=$cont+1;
			}


			// for ($i=0,$i < count($idarticulo, $i++)) {

			// }
			DB::commit();

		} catch(\Exception $e)

		{
			// var_dump($e);


			DB::rollback();
		}
			return Redirect::to('ventas/venta');

	}

	public function show($id)
	{
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
    		return View("ventas.venta.show", ["venta"=>$venta,"detalle"=>$detalle]);

	}

 	public function destroy($id)
 	{
 		$venta=Venta::findOrFail($id);
 		$venta->Estado ='C';
 		$venta->update();
 		return Redirect::to('ventas/venta');
 	}
}
