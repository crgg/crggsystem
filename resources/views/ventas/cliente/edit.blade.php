@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Cliente: {{ $persona->nombre}}</h3>
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
		{!!Form::model($persona,['method'=>'PATCH','route'=>['ventas.cliente.update',$persona->idpersona]])!!}
            {{Form::token()}}
        <div class="row">
    	<div class="col-lg-06 col-sm-6 col-md-6 col-xs-12">
    	  <div class="form-group">
            	<label for="nombre">Nombre</label> 
            	<input type="text" name="nombre" required value="{{$persona->nombre}}" class="form-control" >
            </div>
    	</div>
    	<div class="col-lg-06 col-sm-6 col-md-6 col-xs-12">
    		<div class="form-group">
                <label for="tipo_documento">Tipo Documento</label>
                <input type="text" name="tipo_documento" required value="{{$persona->tipo_documento}}" class="form-control" >
            </div>    
    	</div>
		<div class="col-lg-06 col-sm-6 col-md-6 col-xs-12">
 			<div class="form-group">
            	<label for="num_documento">Num Documento</label>
            	<input type="text" name="num_documento" required value="{{$persona->num_documento}}" class="form-control" >
            </div>   
    	</div>
    	<div class="col-lg-06 col-sm-6 col-md-6 col-xs-12">
    		 <div class="form-group">
            	<label for="direccion">Direccion</label>
            	<input type="text" name="direccion" class="form-control" value="{{$persona->direccion}}" >
            </div>
    	</div>
    	<div class="col-lg-06 col-sm-6 col-md-6 col-xs-12">
    		 <div class="form-group">
            	<label for="telefono">Telefono</label>
            	<input type="text" name="telefono" class="form-control" value="{{$persona->telefono}}" placeholder="Telefono...">
            </div>
    	</div>
    	 <div class="col-lg-06 col-sm-6 col-md-6 col-xs-12">
             <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="{{$persona->email}}" placeholder="email...">
            </div>
        </div>

    	<div class="col-lg-06 col-sm-6 col-md-6 col-xs-12">
    		 <div class="form-group">
            	<button class="btn btn-primary" type="submit">Guardar</button>
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
    	</div>
    </div>	

			{!!Form::close()!!}		

@endsection