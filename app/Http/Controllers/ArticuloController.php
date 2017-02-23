<?php

namespace crggWebsite\Http\Controllers;

use Illuminate\Http\Request;

use crggWebsite\Http\Requests;

use crggWebsite\Articulo;


use Illuminate\Support\Facades\Redirect;

// esto es para la imagen
use Illuminate\Support\Facades\Input;

use crggWebsite\Http\Requests\ArticuloFormRequest;


use DB;


class ArticuloController extends Controller
{
    public function __construct()
     {
        $this->middleware('auth');
    }

    public function index(Request $request) 
    {
    	if ($request)
    	{
    		$query = trim($request->get('searchText'));
    		$articulos = DB::table('articulo as a')
    		->join('categoria as c','a.idcategoria','=','c.idcategoria')
    		->select('a.idarticulo','a.nombre','a.codigo','c.nombre as categoria','a.stock','a.description','a.imagen','a.estado')	
    		->where('a.nombre','LIKE','%'.$query.'%')
             ->where('a.estado','ACTIVE')
            ->orwhere('a.codigo','LIKE','%'.$query.'%')
            ->where('a.estado','ACTIVE')
    		->orderBy('a.idarticulo','desc')
    		->paginate(7);

    		return view('almacen.articulo.index',["articulos"=>$articulos,"searchText"=>$query]);
    	}
    }

    public function create()
    {
    	// combo box de la categorias
    	$categorias=DB::table('categoria')->where('condition','=','1')->get();

 
    	return view("almacen.articulo.create",["categorias"=>$categorias]);

    }

    public function store(ArticuloFormRequest $request)
    {

    	$articulo= new articulo;
    	$articulo->idcategoria = $request->get('idcategoria');
    	$articulo->codigo = $request->get('codigo');
    	$articulo->stock =$request->get('stock');
    	$articulo->description =$request->get('description');
    	$articulo->estado='ACTIVE';

    	if (Input::hasFile('image')){
    		$file = Input::file('image');
    		$file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName());
    		$articulo->imagen=$file->getClientOriginalName();
    	}
    	
    	$articulo->save();
    	return Redirect::to('almacen/articulo');

   }
   public function show($id) 
   {


   		return view("almacen.articulo.show",["articulo"=>Articulo::findOrFail($id)]);

   }
   
     public function edit($id)
    {
          $articulo=Articulo::findOrFail($id);
          $categorias = DB::table('categoria as a')->where('condition','=','1')->get();
          return view("almacen.articulo.edit",["articulo"=>$articulo,"categorias"=>$categorias]);

    }
    
    public function update(ArticuloFormRequest $request, $id)
    {
    	$articulo=Articulo::findOrFail($id);
    	$articulo->idcategoria = $request->get('idcategoria');
        $articulo->nombre = $request->get('nombre');
    	$articulo->codigo = $request->get('codigo');
    	$articulo->stock =$request->get('stock');
    	$articulo->description =$request->get('description');    	 
    	if (Input::hasFile('image')){
    		$file = Input::file('image');
    		$file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName());
    		$articulo->imagen=$file->getClientOriginalName();
    	}
 		$articulo->update();
 		return Redirect::to('almacen/articulo');
    }


    public function destroy($id) 
    {
    	$articulo=Articulo::findOrFail($id);
    	$articulo->estado='INACTIVE';
    	$articulo->update();
    	  return Redirect::to('almacen/articulo');

    }
}
