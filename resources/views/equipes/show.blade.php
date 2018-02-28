@extends('layouts.app')
@section('content')
<head>

	<head>
	<!--<link rel="stylesheet" href="   asset('css/bootstrap-theme.min.css')"> -->
	<link rel="shortcut icon" type="image/png" href="http://portifoliogestor.com/public/images/portfolio-logo4.png" sizes="16x16">
    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <!-- Luiz -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">

	   <style type="text/css">
            body {
                background-color: lightgray;
                widith: 100%;
                higth:100%;
            }
           
        hr {
            margin-top: 35px;
            margin-bottom: 35px;
            border: 0;
            border-top: 1px solid #bfbebe;
        }
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
        li {
            display: inline-block;
            float: left;
            margin-left: 20px;
            line-height: 35px;
            font-weight: 100;
        }
        a {
            text-decoration: none;
            cursor: pointer;
            -webkit-transition: all .3s ease-in-out;
            -moz-transition: all .3s ease-in-out;
            -ms-transition: all .3s ease-in-out;
            -o-transition: all .3s ease-in-out;
            transition: all .3s ease-in-out;
        }
        li a {
            color: red; /*    white;  */
            margin-left: 3px;
        }
        li > i {
            color: black;  /*  color: white;  */
        }
        .column-wrap a {
            color: #5c34c2;
            font-weight: 600;
            font-size:16px;
            line-height:24px;
        }
        .column-wrap p {
            color: gray;  /*     #717171; */
            font-size:16px;
            line-height:24px;
            font-weight:300;
        }
        .container {
            margin-top: 100px;
        }
        .navbar {
            background-color: black;
            position: relative;
            min-height: 45px;
            margin-bottom: 20px;
            border: 1px solid transparent;
        }
        .navbar-brand {
            float: left;
            height: auto;
            padding: 10px 10px;
            font-size: 18px;
            line-height: 20px;
        }
        .navbar-nav>li>a {
            padding-top: 11px;
            padding-bottom: 11px;
            font-size: 13px;
            padding-left: 5px;
            padding-right: 5px;
        }
        .navbar-nav>li>a:hover {
            text-decoration: none;
            color: #cdc3ea!important;
        }
        .navbar-nav>li>a i {
            margin-right: 5px;
        }
        .nav-bar img {
            position: relative;
            top: 3px;
        }
        
        .column-custom {
            border-radius: 5px;
            background-color: #eeecf9;
            padding: 35px;
            margin-bottom: 20px;
        }
        .footer {
            font-size: 13px;
            color: gray !important;
            margin-top: 25px;
            line-height: 1.4;
            margin-bottom: 45px;
        }
        .footer a {
            cursor: pointer;
            color: red !important; /*   color: #646464 !important; */
            font-size: 12px;
        }
        .copyright {
            color: yellow !important; /*  color: #646464 !important; */
            font-size: 12px;
        }
        .navbar a {
            color: color: white !important;
        }
        .navbar {
            border-radius: 0px !important;
        }
        .navbar-inverse {
            background-color: *#434343;
            border: none;
        }
        .column-custom-wrap{
            padding-top: 10px 20px;
        }
        @media screen and (max-width: 768px) {
            .container {
                margin-top: 30px;
            }
        }
        @media screen and (max-width: 650px) {
            .container {
                margin-top: 30px;
                margin-bottom: 45px;
                margin-height: 25px;
                margin-left: 25px;
            }
        }
</style>
</head>
	
</head>


@section('content')

<div class="container">
		
	@if(Session::has('message_error_equipe'))
		<p class="alert {{ Session::get('alert-class', 'alert-info') }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ Session::get('message_error_equipe') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
	@endif
	@if(Session::has('message_success_equipe'))
		<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message_success_equipe') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
	@endif





	@if(Session::has('alert-danger') || Session::has('alert-success'))
		<div class="flash-message">
		@foreach (['danger', 'warning', 'success', 'info'] as $msg)
		  @if(Session::has('alert-' . $msg))

		  <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
		  @endif
		@endforeach
	  </div> 
	@endif
	@if(Session::has('message_error_equipes'))
		<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message_error_informar') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
	@endif
	@if(Session::has('message_success_equipes'))
		<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message_success_informar') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
	@endif

	<div class="col-sm-offset-1 col-sm-10">
		<div class="panel panel-default">
			<div class="panel-heading">		
				<div class="form-group">
					<div class="col-sm-offset-0 col-sm-0"> 
						</button></a> <center><b><h3>Membros Cadastrados</h3></b></center>
					</div>
				</div>
			</div>
		@if(!is_null($membros) && count($membros) > 0)
            <div id="ativabusca">
				<form action="{{ route('equipe.showMembroOrdenarPor') }}" method="POST">
					{!! csrf_field() !!}
					<div class="form-group navbar-form">
						Ordenar:
						<select class="form-control m-b" name="ordenarMembroPor" id="ordenarMembroPor" onchange="this.form.submit()" title="@php echo utf8_encode('Ordenar os nomes dos membros');@endphp">
							<option value="" disabled="" selected="">Ordenar por...</option>
							<option value="NOMEDOMEMBROASC">@php echo utf8_encode('Nome (A-->Z)'); @endphp</option>
							<option value="NOMEDOMEMBRODESC">@php echo utf8_encode('Nome (Z-->A)'); @endphp</option>
							<option value="POSSUIEQUIPE">@php echo utf8_encode('Está Alocado em Projeto'); @endphp</option>							   					  
						</select>
					</div>
				</form>
                <form class="navbar-form " id="buscarmembro" role="form" action="{{ route('equipe.showMembroBuscar') }}" method="POST">
					{!! csrf_field() !!}
                    <div class="form-group navbar-form">
                          Filtrar:
						<input type="text" value="" placeholder="Nome do Membro" name="nomeMembroBusca" id="nomeMembroBusca" class="form-control">
                       </div>          
                       <button type="submit" class="btn btn-sm btn-default" id="button_search"  onclick="this.form.submit()" title="@php echo utf8_encode('Buscar por Nome de Membro');@endphp"><span class="glyphicon glyphicon-search active">&nbsp;Buscar</span></button>
                </form>
            </div>
        @else
		    <br/>
		       <div class="alert-warning">
		           <center><span class="glyphicon glyphicon-alert"> 
		                <b> N&atilde;o existem membros cadastradas&#33;</b></span></center>
		       </div>
		@endif
		@if (count($membros) > 0)
			<div class="panel panel-default">
				<div class="panel-heading">
					Membros Cadastrados: {{count($membros)}}
				</div>
				<div class="panel-body">
					<!-- Display Validation Errors -->
					@include('common.erros')
					<div style="background-color:#F5FFFA">
						<div style="text-align: justify"><span><b style="color:blue;">@php echo utf8_encode('Atualizar - Atualizar o nome do membro'); @endphp </b></span></div>
						<div style="text-align: justify"><span><b style="color:red;">@php echo utf8_encode('Remover de Equipe - Remove o membro da equipe'); @endphp </b></span></div>
						<div style="text-align: justify"><span><b style="color:red;">@php echo utf8_encode('Deletar do Sistema - Apaga os dados definitivamente'); @endphp </b></span></div>
					</div>
					</center>
					<table class="table table-striped table-hover">
						<!--  Table Headings -->
						<thead>
							<th>Nome do Membro</th>							
							<th>&nbsp;</th>
							<th>&nbsp;</th>
							<th>&nbsp;</th>	
						</thead>
						<!--  Table Body -->
						<tbody>
							@foreach ($membros as $membro)
								<tr>								
									<!-- Atributos -->
									<td class="table-text">
										<div>{{ $membro->nome }}</div>
									</td>
									<td>
									<!-- Atualizar -->
										<form id="form_idUP-{{ $membro->id }}" action="{{ url('equipe/update/'.$membro->id)}}" method="POST" enctype="multipart/form-data">
											{!! csrf_field() !!}
											{{ method_field('PUT') }}
											 <input type="hidden" name="membro_id" id="membro_id" value="{{$membro->id}}" class="form-control">
											<button type="submit" id="update-projeto-{{ $membro->id }}" class="btn btn-primary" title="@php echo utf8_encode('Atualizar Nome do Membro');@endphp">
												<i class="fa fa-pencil" aria-hidden="true"> Atualizar</i>
											</button>					
										</form>
									</td>
									<td>
										<!-- Deletar da Equipe-->
										<form id="form_idREM-{{ $membro->id }}" action="{{ url('membro/projetos/'.$membro->id)}}" method="POST">
											{!! csrf_field() !!}
											{!! method_field('PUT') !!}
											<input type="hidden" name="membro_id" id="membro_id" value="{{$membro->id}}" class="form-control">
											@if( !$membro->isMembro( $membro->id) )
												<button type="submit" disabled="" id="delete-projeto-{{ $membro->id }}" class="btn btn-warning" title="@php echo utf8_encode('Membro foi removido da Equipe');@endphp">
												<i class="fa fa-trash-o" aria-hidden="true"> Removido de Equipe</i>
												</button>
											@else
												<button type="submit" id="delete-projeto-{{ $membro->id }}" class="btn btn-danger" title="@php echo utf8_encode('Remover Membro da Equipe');@endphp">
													<i class="fa fa-trash-o" aria-hidden="true"> Remover de Equipe&nbsp;</i>
												</button>
											@endif		
										</form>
									</td>
									<td>
										<!-- Deletar -->
										<form id="form_idDEL-{{ $membro->id }}" action="{{ url('destroy/'.$membro->id)}}" method="POST">
											{!! csrf_field() !!}
											{!! method_field('DELETE') !!}
											<input type="hidden" name="membro_id" id="membro_id" value="{{$membro->id}}" class="form-control">
											@if( $membro->isMembro( $membro->id) )
												<button type="submit" disabled="" id="delete-projeto-{{ $membro->id }}" class="btn btn-warning" title="@php echo utf8_encode('Deletar do sistema após Remover de Equipe');@endphp">
													<i class="fa fa-trash-o" aria-hidden="true"> Deletar do Sistema</i>
												</button>
											@else
												<button type="submit" id="delete-projeto-{{ $membro->id }}" class="btn btn-danger" title="@php echo utf8_encode('Deletar do sistema Permanentemente');@endphp">
													<i class="fa fa-trash-o" aria-hidden="true"> Deletar do Sistema</i>
												</button>
											@endif			
										</form>
									</td>
							</tr>
							@endforeach 
						</tbody>
					</table>
				</div>
			</div> 
			<script type="text/javascript">
						$(document).ready(function () {
							
							/**--------------------------------------------------------------
								    SUMBMIT THE FORM  by Luiz Silva 08/08/2017 17:00:00
							--------------------------------------------------------------***/
							$('.btn-primary').click(function (event) {
								
								event.preventDefault();
								var button = confirm("Quer atualizar o membro?");	// return true or false								
								if(button == true)
								{
										var form_id = $(this).closest('form').attr('id');	
										$('#'+form_id).submit();
								}
							});;/* FIM click*/

							/**--------------------------------------------------------------
								    SUMBMIT THE FORM  by Luiz Silva 08/08/2017 17:00:00
							--------------------------------------------------------------***/
							$('.btn-danger').click(function (event) {								
								event.preventDefault();
								var button = confirm("Quer APAGAR definitivamente do sistema?");	// return true or false								
								if(button == true)
								{
										var form_id = $(this).closest('form').attr('id');
										$('#'+form_id).submit();
								}
							});;/* FIM click*/
							
							/**--------------------------------------------------------------
								    SUMBMIT THE FORM  by Luiz Silva 08/08/2017 17:00:00
							--------------------------------------------------------------***/
							$('.btn-warning').click(function (event) {								
								event.preventDefault();
								var button = confirm("Quer Remover de Equipe?");	// return true or false								
								if(button == true)
								{
										var form_id = $(this).closest('form').attr('id');
										$('#'+form_id).submit();
								}
							});;/* FIM click*/

						 }); /* end jquerry */
					</script>
			@endif

		</div>
	</div>
	
	</div>
      @endsection
  
