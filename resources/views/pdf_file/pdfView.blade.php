<style type="text/css">

	table td, table th{

		border:1px solid black;

	}

</style>

<div class="container">


	<br/>

<!-- 	<a href="{{ route('pdfview',['download'=>'pdf']) }}">Download PDF</a>
 -->

	<table>

		<tr>

			<th>No</th>

			<th>Title</th>

			<th>Description</th>

		</tr>

		  @foreach ($categorias as $cat) 

		<tr>
				    <td>{{ $cat->idcategoria}}</td>
					<td>{{ $cat->nombre}}</td>
					<td>{{ $cat->descripcion}}</td>
		</tr>

		@endforeach

	</table>

</div>
