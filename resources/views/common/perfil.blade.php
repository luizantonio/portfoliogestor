@extends('layouts.app')

@section('perfil')

@if (count($perfis) > 0)
	<div class="form-group">
		{!! Form::Label('perfil', 'Item:') !!}
		<select class="form-control" name="perfil">
			@foreach ($perfis->all() as $perfil)
				<option value="{{$perfil->id}}">{{$perfil->tipo}}</option>
			@endforeach
		</select>
	</div>

	
	<div class="form-group">
		{!! Form::Label('perfil', 'Perfil:') !!}
		{!! Form::select('perfil_id', $perfis, null, ['class' => 'form-control']) !!}
	</div>

@endif

@endsection
           