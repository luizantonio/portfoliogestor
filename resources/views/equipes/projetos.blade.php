@extends('layouts.app')
@section('content')

	<head>
	<!-- <link rel="stylesheet" href="   asset('css/bootstrap-theme.min.css')"> -->
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
    
<div class="container">
@if(Session::has('message'))
	<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>';
@endif




	@php echo utf8_encode('<center><h3><b>Remover o membro da Equipe do Projeto</b></h3></center>'); @endphp
	<div class="col-sm-offset-1 col-sm-10">
		<div class="panel panel-default">	
					<div class="form-group">
						<div class="col-sm-offset-0 col-sm-0">						    
							<a href ="{{ url('equipes/show') }}"> <button title="@php echo utf8_encode('Voltar para a tela Anterior');@endphp" type="button" id="btnvoltar" class="btn btn-success">
								<i class="fa fa-chevron-left"> Voltar</i> 
							</button></a>
						</div>
						<center><b><span id="mensagemCancelar"></span></b><span id="mensagemVoltar"></span></b></center>
					</div>		
                  

		@if (count($projetos) <= 0 || $projetos == null)	
			<center><div style="background-color: white;"><h3><b><p class="danger"><b>@php utf8_encode('Projeto não foi encontrado!'); @endphp </b><h3></div></center>	
		@endif
		@if (count($projetos) > 0)
			<div class="panel panel-default">
				<div class="panel alert-info">Membro:
					@if(!is_null($membro)) 
							@php echo '<center><b>'.$membro->nome.'</b></center>'; @endphp					
					@endif				
				</div>
				<div class="panel-body">
				
				  <div class="">			
					<table class="table table-striped table-hover">
						<!--  Table Headings -->
						<thead>
							<th>Est&aacute; na equipe do projeto</th>							
							<th>&nbsp;</th>
					
						</thead>
						<!--  Table Body -->
						<tbody>
							@foreach ($projetos as $projeto)		
									
								<tr>								
									<!-- Atributos -->
									<td class="table-text">
										<div>{{ $projeto->nome }}</div>
									</td>

									<td>
										<!-- Deletar -->
										<form id="form_idDEL-{{ $membro->id }}" action="{{ url('equipe/'.$membro->id)}}" method="POST">
											{!! csrf_field() !!}
											{!! method_field('DELETE') !!}
											<input type="hidden" name="membro_id" id="membro_id" value="{{$membro->id}}" class="form-control">
											<input type="hidden" name="projeto_id" id="projeto_id" value="{{$projeto->id}}" class="form-control">
											<button type="submit" id="delete-projeto-{{ $membro->id }}" class="btn btn-danger" title="@php echo utf8_encode('remover membro da equipe deste projeto');@endphp">
												<span class="glyphicon glyphicon-remove" aria-hidden="true"> Remover da Equipe deste Projeto</ispan>
											</button>
														
										</form>
									</td>
																		
							</tr>
							@endforeach 
						</tbody>
					</table>

				</div>

				<div class="panel-body">
				<!-- Display Validation Errors -->
				@include('common.erros')


				</div>

			
			   <!-- Add Task Button -->
				
					<div class="form-group">
						<div class="col-sm-offset-5 col-sm-6">
							<button title="@php echo utf8_encode('Cancelar Operações');@endphp" type="button" id="btn-cancelar" class="btn btn-warning">
								<i class="fa fa-minus"> <b>Cancelar</b></i> 
							</button>
						</div>
					</div>

				</div>
			</div> 
			<script type="text/javascript">
						$(document).ready(function () {
							
							$('#btn-cancelar').click(function () {
								$("* :button").attr("disabled", true);
								$("* :checkbox").attr("disabled", true);
								$("#atualizar :input").attr("disabled", true);
								$("#buscarusuario :input").prop("disabled", true);
								
								$("#form-cadastro :input").prop("disabled", true);
								var texto = "";
								//$( "#mensagemCancelar" ).val() = '';
								$( "#mensagemCancelar" ).text('@php echo utf8_encode("Operação cancelada!"); @endphp');
								$( "#mensagemCancelar" ).css( "color", "red" ).find( ".special" ).css( "color", "green" );

								$( "#mensagemVoltar" ).text('@php echo utf8_encode("Clique no botão [Volta] para retornar a tela anterior!"); @endphp');
								$( "#mensagemVoltar" ).css( "color", "green" );
								
								$("#btnvoltar").attr("disabled", false);
							});
							
							/**--------------------------------------------------------------
								    SUMBMIT THE FORM  by Luiz Silva 08/08/2017 17:00:00
							--------------------------------------------------------------***/
							$('.btn-danger').click(function (event) {
				
								event.preventDefault();
								var button = confirm("Quer realmente excluir o membro desta equipe?");	// return true or false								
								if(button == true)
								{
										var form_id = $(this).closest('form').attr('id');																									
										$('#'+form_id).submit();
								}
							});
							
							

						 }); /* end jquerry */
					</script>			
			@endif
		</div>
	</div>
</div>
	@endsection