<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('auth/login');
});

// Route::get('/ventas', 'Controller@index');
Route::resource('dashboard', 'DashboardController');
Route::resource('almacen/categoria','CategoriaController');
Route::resource('almacen/articulo','ArticuloController');
Route::resource('ventas/cliente','ClienteController');
Route::resource('compras/proveedor','ProveedorController');
Route::resource('compras/ingreso','IngresoController');
Route::resource('ventas/venta','VentaController');

Route::resource('seguridad/usuario','UsuarioController');
Route::resource('pdf_file', 'PdfController');

Route::get('pdfview',array('as'=>'pdfview','uses'=>'PdfController@categorias'));
Route::get('pdfventa',array('as'=>'pdfventa','uses'=>'PdfController@ventas'));

Route::auth();
Route::get('login', function(){
    return view('auth/login');
});
Route::get('/home', 'HomeController@index');
Route::get('/{slug?}', 'HomeController@index');
/* imagenes router*/
Route::get(
	'/images/{file}',
	'ImageController@getImage'
);
Route::get(
	'/image/{size}/{file}',
	'ImageController@getImage'
);
