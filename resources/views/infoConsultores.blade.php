@extends('layouts.app')

@section('content')

@foreach ($data as $key => $value)
	<table class="table">
	  <thead>
	    <tr>
	      <th scope="col"> {{ $value['consultor'] }}</th>
	    </tr>
	  </thead>
	  <tbody>
	    <tr>
	      <td> <strong> Período </strong> </td>
	      <td> <strong> Receita Líquida </strong> </td>
	      <td> <strong> Custo Fixo </strong> </td>
	      <td> <strong> Comissão </strong> </td>
	      <td> <strong> Lucro </strong> </td>
	    </tr>
	    @foreach ($value['meses'] as $clave => $valor)
	    	<tr>
	    		<td> {{ $clave }}</td>
	    		@if (isset($valor['totalMes']))
	    			<td> {{ $valor['totalMes'] }} </td>
	    		@else
	    			<td> Sem informação </td>
	    		@endif
	    		@if (isset($value['salario']))
	    			<td> {{ $value['salario'] }} </td>
	    		@else
	    			<td> Sem informação </td>
	    		@endif
	    		@if (isset($valor['comisionMes']))
	    			<td> {{ $valor['comisionMes'] }} </td>
	    		@else
	    			<td> Sem informação </td>
	    		@endif
	    		@if (isset($valor['lucro']))
	    			<td> {{ $valor['lucro'] }} </td>
	    		@else
	    			<td> Sem informação </td>
	    		@endif
	    	</tr>
	    @endforeach
	  </tbody>
	</table>
	<br>
@endforeach
@endsection