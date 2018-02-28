@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-danger">
                <div class="panel-heading">@php echo  utf8_encode('Acesso não autorizado'); @endphp</div>

                <div class="panel-body">
					<br>
                    <h2>@php echo  utf8_encode($error); @endphp</h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
