@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva Articulo</h3>

			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
		</div>
	</div>

		{!!Form::open(array('url'=>'almacen/articulo','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
            {{Form::token()}}

    <div class="row">
    	<div class="col-lg-06 col-sm-6 col-md-6 col-xs-12">
    	  <div class="form-group">
            	<label for="nombre">Nombre</label>
            	<input type="text" name="nombre" required value="{{old('nombre')}}" class="form-control" placeholder="Nombre...">
            </div>
    	</div>
    	<div class="col-lg-06 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
            	<label >Categorias</label>
           		<select name="idcategoria" class="form-control">
           			@foreach($categorias as $cat)
           				<option value="{{$cat->idcategoria}}">{{$cat->nombre}}</option>
           			@endforeach
           		</select>

            </div>
    	</div>
		<div class="col-lg-06 col-sm-6 col-md-6 col-xs-12">
 			<div class="form-group">
            	<label for="codigo">Codigo</label>
            	<input type="text" name="codigo" required value="{{old('codigo')}}" class="form-control" placeholder="codigo">
            </div>
    	</div>
    	<div class="col-lg-06 col-sm-6 col-md-6 col-xs-12">
    		 <div class="form-group">
            	<label for="stock">Stock</label>
            	<input type="text" name="stock" class="form-control" value="{{old('stock')}}" placeholder="Stock del Articulo...">
            </div>
    	</div>
    	<div class="col-lg-06 col-sm-6 col-md-6 col-xs-12">
    		 <div class="form-group">
            	<label for="descripcion">description</label>
            	<input type="text" name="descripcion" class="form-control" value="{{old('descripcion')}}" placeholder="decription del Articulo...">
            </div>
    	</div>
    	<div class="col-lg-06 col-sm-6 col-md-6 col-xs-12">
    		 <div class="form-group">
            	<label for="image">Imagen</label>
            	<input type="file" name="image" class="form-control">
            </div>
    	</div>

    	<div class="col-lg-06 col-sm-6 col-md-6 col-xs-12">
    		 <div class="form-group">
            	<button class="btn btn-primary" type="submit">Guardar</button>
            	<a class="btn btn-danger" href="{{ url('almacen/articulo') }}">Cancelar</a>
            </div>
    	</div>
    </div>

			{!!Form::close()!!}
@endsection
