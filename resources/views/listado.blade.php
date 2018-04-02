@extends('layouts.app')

@section('content')

<form method="post" target="_blank" >
	{{ csrf_field() }}
	<div class="row">
		<div class="col-6 col-md-5"> 
			<div> Desde: </div>
			<select id="monthsFrom" name="monthsFrom" style="width: 180px;" required="">
				<option></option>
				@foreach ($months as $month)
					<option value="{{ $month['number'] }}"> {{ $month['name'] }} </option>
				@endforeach
			</select>
			<select id="yearsFrom" name="yearsFrom" style="width: 180px;" required="">
				<option></option>
				@foreach ($years as $key => $year)
					<option value="{{ $years[$key] }}"> {{ $year }} </option>
				@endforeach
			</select>
		</div>
		<div class="col-6 col-md-5">
			<div> Hasta: </div>
			<select id="monthsTo" name="monthsTo" style="width: 180px;" required="">
				<option></option>
				@foreach ($months as $month)
					<option value="{{ $month['number'] }}"> {{ $month['name'] }} </option>
				@endforeach
			</select>
			<select id="yearsTo" name="yearsTo" style="width: 180px;" required="">
				<option></option>
				@foreach ($years as $key => $year)
					<option value="{{ $years[$key] }}"> {{ $year }} </option>
				@endforeach
			</select>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-6 col-md-8">
			<select multiple id="listadoConsultores" name="listadoConsultores[]">
				@foreach ($consultores as $consultor)
					<option value="{{ $consultor['co_usuario'] }}"> {{ $consultor['no_usuario'] }} </option>
				@endforeach
			</select>
		</div>
		<div class="col-6 col-md-3">
			<button class="btn btn-primary btn-sm"> Relatorio </button>
		</div>
	</div>
</form>

<script type="text/javascript">
	var boxes = Array();
	boxes['listConsultores'] = $("#listadoConsultores");
	boxes['consultoresEnviar'] = $("#consultoresEnviar");
	classConsultores.options(boxes);
	classConsultores.initializeInputs();
	classConsultores.onEvents();
</script>
@endsection