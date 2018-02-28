@extends('layouts.app')

@section('content')  
<head>
        <!-- <script src="{{asset('js/jquery.min.js')}}"></script> -->

    <link rel="shortcut icon" type="image/png" href="http://portifoliogestor.com/public/images/portfolio-logo4.png" sizes="16x16">
    
    <!-- 15/09/2016 menu toggle fluid and colappse -->
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
            
         
        
        h1 {
            font-size: 30px;
            font-weight: 600!important;
            color: #333;
        }
        h2 {
            font-size: 24px;
            font-weight: 600;
        }
        h3 {
            font-size: 22px;
            font-weight: 600;
            line-height: 28px;
        }*/
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
            float: right;
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
            color: white;
            margin-left: 3px;
        }
        li > i {
            color: white; 
        }
        .column-wrap a {
            color: #5c34c2;
            font-weight: 600;
            font-size:16px;
            line-height:24px;
        }
        .column-wrap p {
            color: #717171;
            font-size:16px;
            line-height:24px;
            font-weight:300;
        }
        .container {
            margin-top: 100px;
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
            color: #646464 !important;
            font-size: 12px;
        }
        .copyright {
            color: #646464 !important;
            font-size: 12px;
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

@if(Session::has('alert-danger') || Session::has('alert-success'))
	<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))
      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
  </div> 
@endif

	@php echo utf8_encode('<center><h3><b>Desassociar Indicador do Projeto</b></h3></center>'); @endphp
	<div class="col-sm-offset-1 col-sm-10">
		<div class="panel panel-default">	 
					<div class="form-group">
						<div class="col-sm-offset-0 col-sm-0">						    
							<a href ="{{ route('home') }}"> <button title="@php echo utf8_encode('Voltar para o início');@endphp" type="button" id="btnvoltar" class="btn btn-success">
								<i class="fa fa-chevron-left"> @php echo utf8_encode('Voltar para o Início'); @endphp </i> 
							</button></a>
						</div>
						<center><b><span id="mensagemCancelar"></span></b><b><span id="mensagemVoltar"></span></b></center>
					</div>		
		@if(!is_null($projetos) && count($projetos) >= 0) 			
                    <div id="ativabusca" class="navbar-form">
						
						<form action="{{ route('indicador.ordenarPorInformar') }}" method="POST">
							{!! csrf_field() !!}
							<div class="form-group">
								Ordenar Projetos:
							</div> 
							<select class="form-control m-b" name="nomeProjetoOrdenar" onchange="this.form.submit()">
							   <option value="" disabled="" selected="">Ordenar por...</option>
							   <option value="NOMEDOPROJETO">Nome do Projeto</option>						  
							 </select>
						</form>
                        <form class="navbar-form " id="buscarprojeto" role="form" action="{{ route('indicador.buscarInformar') }}" method="POST">
							{!! csrf_field() !!}

                            <div class="form-group">
                                Filtrar Projetos:
								<input type="text" value="" placeholder="Nome do Projeto" name="nomeProjetoBusca" id="nomeProjetoBusca" class="form-control">                                
                            </div>          
                            <button type="submit" class="btn btn-sm btn-default" id="button_search"  onclick="this.form.submit()"><span class="glyphicon glyphicon-search active">&nbsp;Buscar</span></button>
                        </form>
                    </div>

		@else 	
			<div class="alert-warning">
		        <center><span class="glyphicon glyphicon-alert"> 
		        <b> N&atilde;o existem indicadores a serem desassociados do projeto&#33;</b></span></center>
		   </div>
		@endif
		@if (count($projetos) > 0)
			<div class="panel panel-default">
				<div class="panel-heading">
				    @if(!is_null($projetos) && count($projetos) >= 0) 
						{{ utf8_encode('Projetos com Indicadores:') }}
					@endif
					<br>
				</div>
				<div class="panel-body">
			 <table class="table table-condensed">
			    <thead>
					<tr>					
						<th>Projeto</th>
						<th>Fase&nbsp;do&nbsp;Projeto</th>																							
						<th>&nbsp;</th>
						<th>&nbsp;</th>
					</tr>	
				</thead>
				<tbody>
					@php 
					 $contadorFase = 1; 
					 $contadorIndicador= 0;
					 $contadorProjeto= 0;
					 @endphp
					 <!-- projetos início-->
					@foreach($projetos as $projeto)
						@if($projeto->user_id == Auth::user()->id  || $projeto->gerente_responsavel == Auth::user()->id )

						@if( $projeto->associadoAindicadorEmFase( $projeto->id) )
							<tr class="success">		
												
						
							  <!--  Nome do Projeto -->
							  <td>{{ $projeto->nome }}<input type="hidden" name="name" value="{{ $projeto->name. $projeto->isQualIndicador( $projeto->id) }}"></td>
							  <td>
							   <div class="form-group navbar-form">

							   <!-- Fase  -->

								 @if(!is_null($projeto->faseDoProjetoFaseNome($projeto->id, $projeto->idUltimaFaseDoProjeto($projeto->id) )) )
									{{$projeto->faseDoProjetoFaseNome($projeto->id, $projeto->idUltimaFaseDoProjeto($projeto->id) )}}
								 @else
									@php
								    echo '<b style="color:red;">SEM FASE DEFINIDA!</b>';  
								   @endphp
								@endif
								</div>
							  </td>
							   
							  <td class="left">
							   <form id="form-{{$projeto->id}}"action="{{ url('indicadore/desassociar/'.$projeto->id )}}" method="post">
								  {!! csrf_field() !!} 
								  {{ method_field('PUT') }}
								     <input type="hidden" name="projeto_id" id="projeto_id" value="{{$projeto->id}}" class="form-control">
									
									<a href="{{ url('indicadore/desassociar/'.$projeto->id)}}">
									  <button  title="@php echo utf8_encode('Desassociar Indicador do Projeto');@endphp" type="submite" class="btn btn-info" id="'btn-{{$projeto->id}}'">
										<i class="fa fa-exchange"> @php echo utf8_encode('Desassociar Indicador'); @endphp</i> 
									  </button></a>
								  </form>
					
							  </td>
						
						 </tr>
					  	@endif
					  @php 
					 $contadorFase = 1; 
					 $contadorIndicador= 0;
					 $contadorProjeto= 0;
					 @endphp
					 @endif
					@endforeach
					<!-- projetos fim-->
				</tbody>
			  </table>
			
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

							$('select').on('change', function() {
								if (this.value == '-1') {
									$('optgroup option').prop('disabled', true);
								} else {
									$('optgroup option').prop('disabled', false);
								}
							});

							

							$('#btn-cancelar').click(function () {
								$("* :button").attr("disabled", true);

								$("#fasedoProjeto :input").prop("disabled", true);

								$("* :checkbox").attr("disabled", true);
								$("#atualizar :input").attr("disabled", true);
								$("#buscarusuario :input").prop("disabled", true);
								
								$("#formOrdenar :input").prop("disabled", true);
								var texto = "";
								//$( "#mensagemCancelar" ).val() = '';
								$( "#mensagemCancelar" ).text('@php echo utf8_encode("Operação cancelada!"); @endphp');
								$( "#mensagemCancelar" ).css( "color", "red" ).find( ".special" ).css( "color", "green" );

								$( "#mensagemVoltar" ).text('@php echo utf8_encode("Clique no botão [Voltar para o Início] para retornar a tela inicial!"); @endphp');
								$( "#mensagemVoltar" ).css( "color", "green" );
								
								$("#btnvoltar").attr("disabled", false);
							});
							
							/**--------------------------------------------------------------
								    SUMBMIT THE FORM  by Luiz Silva 08/08/2017 17:00:00
							--------------------------------------------------------------***/
							$('.btn-info').click(function (event) {
				
								event.preventDefault();
								var button = confirm("Quer Desassociar Indicador?");	// return true or false								
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