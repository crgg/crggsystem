<?php

namespace crggWebsite\Http\Controllers;

use Illuminate\Http\Request;

use crggWebsite\Http\Requests;

use crggWebsite\Categoria;

use Illuminate\Support\Facades\Redirect;

use crggWebsite\Http\Requests\CategoriaFormRequest;

use App;
use PDF;

use DB;




class CategoriaController extends Controller
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
    		$categorias = DB::table('categoria')->where('nombre','LIKE','%'.$query.'%')
    		->where ('condition','=','1')
    		->orderBy('idcategoria','desc')
    		->paginate(7);
    		return view('almacen.categoria.index',["categorias"=>$categorias,"searchText"=>$query]);
    	}
    }
    public function create()
        {

    	return view("almacen.categoria.create");
    }
    public function store(CategoriaFormRequest $request)
    {

    	$categoria= new categoria;
    	$categoria->nombre = $request->get('nombre');
    	$categoria->description =$request->get('description');
    	$categoria->condition='1';
    	$categoria->save();
    	return Redirect::to('almacen/categoria');

   }
   public function show($id) 
   {


   		return view("almacen.categoria.show",["categoria"=>Categoria::findOrFail($id)]);

   }
   
     public function edit($id)
    {
             
          return view("almacen.categoria.edit",["categoria"=>Categoria::findOrFail($id)]);
    }
    
    public function update(CategoriaFormRequest $request, $id)
    {
    	$categoria=Categoria::findOrFail($id);
    	$categoria->nombre=$request->get('nombre');
    	$categoria->description=$request->get('description');
 		$categoria->update();
 		return Redirect::to('almacen/categoria');
    }


    public function destroy($id) 
    {
    	$categoria=Categoria::findOrFail($id);
    	$categoria->condition='0';
    	$categoria->update();
    	  return Redirect::to('almacen/categoria');

    }
    
}
