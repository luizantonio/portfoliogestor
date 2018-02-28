@extends('layouts.app')

use Illuminate\Http\Response;
use Illuminate\Http\Request;

@section('content')


	@if (count($indicadores) > 0)
		{{$indicadores}}
		return redirect('indicadores/fases')->with('indicadores',$indicadores);
	@endif


	
@endsection