@extends('layouts.app')
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
	
@section('content')

<div class="container">	

@if(Session::has('message_error_equipe'))
	<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message_error_equipe') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
@endif
@if(Session::has('message_success_equipe'))
	<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message_success_equipe') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
@endif

	<div class="row">
        <div class="panel panel-default">
		@if($projetos->hasMembros($projetos->id ))

			<center><p class="alert alert-info"><span class="glyphicon glyphicon-info-sign"> </span> <b> A lista com os membros cadastrados na equipe encontra-se abaixo do formul&aacute;rio de cadastro&#33;</b> <a href="#" class="close" data-dismiss="alert" aria-label="close"><span class="glyphicon glyphicon-remove" style="color: red; align-content: right"></span></a></p></center>
			
		@else 
			<div class="form-heading">
				<p class="alert alert-warning"> @php echo utf8_encode('Não possui membros na equipe!'); @endphp <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
			</div>			
		@endif
		</div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

            	<div class="panel-heading">		
					<div class="form-group">
						<div class="col-sm-offset-0 col-sm-0">						    
							<a href ="{{ url('equipes/equipes') }}"> <button title="@php echo utf8_encode('Voltar para a tela Anterior');@endphp" type="button" id="btnvoltar" class="btn btn-success">
								<i class="fa fa-chevron-left"> Voltar</i> 
							</button></a>
						</div>
						<div class="col-sm-offset-0 col-sm-0"> 
							</button></a> <center><b><h3>Cadastrar Membro na Equipe</h3></b></center>
						</div>
					</div>
				</div>

				<center><b><span id="mensagemCancelar"></span></b><span id="mensagemVoltar"></span></b></center>
                <div class="panel-body">
				@if(count($projetos)>0)	
						<b>Projeto</b>: {{$projetos->nome}}
				@endif
				
				</div>
				@if(count($projetos->allMembros()) > 0)
					<output for="formCadMembro" class="alert-warning">
						<b>&nbsp;&nbsp;&nbsp;&nbsp;
						<span class="glyphicon glyphicon-alert"> 
			                <b> Utilize apenas um dos formul&aacute;rios abaixo para o cadastro&#33;</b></span>
					</b></output>
					<br/>
				@endif
                <div class="panel-body">

					<!-- Display Validation Errors -->
					@include('common.erros')
				 @if(count($projetos->allMembros()) > 0)
                    <form id="formCadMembroId" class="form-horizontal" method="POST" action="{{ route('equipe.createId') }}">
                        {{ csrf_field() }}
						{{ method_field('POST') }}

						<div class="form-group">							
								@if(count($projetos)>0)	
									
									 <label for="nome" class="col-md-4 control-label">Nome já Cadastrado</label>
										<div class="col-md-6">
											<select  class="form-control m-b" name="membro_id" id="membro_id">
												<option value="0" disabled="" selected="">Nome do Membro...</option>
												@if(count($projetos->allMembros()) > 0)
													@foreach($projetos->allMembros() as $membro)											
																@if(!$projetos->isMembro($projetos->id,  $membro->nome))
																	<option value="{{ $membro->id }}" >{{ $membro->nome }}</option>
																@endif											 
													@endforeach
												@endif
											</select>	
										</div>										
									
								@endif						
						@if(count($projetos->allMembros()) > 0)
                            <div class="col-md-6 col-md-offset-4">
								<input type="hidden" name="projeto_id" id="projeto_id" value="{{$projetos->id}}" class="form-control">
                                <a id="btnMembroCadastrado" href ="{{ route('equipe.createId') }}" >
									<button type="button" id="existente" class="btn btn-primary">
                                    Inserir na Equipe Membro já Cadastrado
                                </button></a>
                            </div>
					  @endif
                        </div>
					</form>
			
			<hr class="alert-danger">
			 @endif
					
					<form id="formCadMembro2" class="form-horizontal" method="POST" action="{{ route('equipe.create') }}">
                        {{ csrf_field() }}
						{{ method_field('POST') }}
                        <div class="form-group">
                            <label  for="nome" class="col-md-4 control-label">Novo Nome de Membro</label>
                            <div class="col-md-6">
                                <input id="nome" type="text" class="form-control calphaonly" name="nome" value="" min="6" maxlength="100" required autofocus onkeyup="this.value=this.value.replace(/[^a-zA-Záãâäàéêëèíîïìóõôöòúûüùçñ \W]/g,'');" onclick="this.value=this.value.replace(/[^a-zA-Z áãâäàéêëèíîïìóõôöòúûüùçñ \W]/g,'');"> 
                            </div>
                        </div>                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
								<input type="hidden" name="projeto_id" id="projeto_id" value="{{$projetos->id}}" class="form-control">
                                <a id="novoMembro" href ="{{ route('equipe.create') }}"><button id="novoMembrobtn" type="button" class="btn btn-primary">
                                    Cadastrar Novo Membro
                                </button></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="panel panel-default">
				
				@if($projetos->hasMembros($projetos->id ))
					<div class="form-heading">
						<div class="col-sm-offset-0 col-sm-0">						    
							<b>Equipe do Projeto</b>:
						</div>
					</div>
					<div class="panel-body">
						@if(count($projetos)>0)	
								@if($projetos->hasMembros($projetos->id ))
										 @php
											$contadorIndicador = 0;
										 @endphp
										@foreach($projetos->getMembrosVetor($projetos->id ) as $membro)
											@php if($contadorIndicador%2===0){ echo '<output style="background-color:#F0F8FF">';}else{echo '<output style="background-color:lien;">';} $contadorIndicador +=1; @endphp		
												{{ $membro->nome }}
											@php echo '</output> '; $contadorIndicador +=1;  @endphp
											@php  $contadorIndicador = $contadorIndicador + 1;  @endphp
										@endforeach	
								@endif
						@endif
				    </div>		
				@endif
		</div>
    </div>





</div>
<script type="text/javascript">
		$(document).ready(function () {
			/*
			$('#nome').oninput = function () {
				if ($('#nome').val.length > 100) {
					$('#nome').val = this.value.slice(0,4); 
				}
			});
							
			$('input[name="nome"]').keypress(function() {
				if (this.value.length >= 100) {
					return false;
				}
			});

			$('input[name="nome"]').on(function() {
				if (this.value.length >= 100) {
					return false;
				}
			});
			*/
	
							
				/**--------------------------------------------------------------
								    SUMBMIT THE FORM  by Luiz Silva 08/08/2017 17:00:00
				--------------------------------------------------------------***/
				$('#existente').click(function (event) {
					event.preventDefault();
					var button = confirm("Quer enviar os dados?");	// return true or false								
					if(button == true)
					{
						var selected_option = $('#membro_id option:selected');						
						//alert( $('#membro_id option').filter(':selected').text() );
						if (selected_option.val() != 'undefined' && selected_option.val() != '0'){

								//alert('1'+':'+ $('#membro_id option').filter(':selected').text() );

								var form_id = $(this).closest('form').attr('id');																									
								$('#'+form_id).submit();
								
						}else{
								//alert('2'+':'+ $('#membro_id option').filter(':selected').text() +'-'+selected_option.val());
							    alert('Valor inadequado para o campo!');
							    return false;
						}
					}
				});	
		
				$('#novoMembrobtn').click(function (event) {
					event.preventDefault(); /*onclick="event.preventDefault();document.getElementById('formCadMembro2').submit();"*/

					var button = confirm("Quer enviar os dados?");	// return true or false								
					if(button == true)
					{
						var textoNome = $('#nome');						
						
						if (textoNome.val() != 'undefined' && textoNome.val().length > 5){
								//alert('1 texto: '+ $('#nome').val() +' length: ' + $('#nome').val().length );
							
								var form_id = $(this).closest('form').attr('id');																									
								$('#'+form_id).submit();
								
						}else{
							   //alert('3 texto: '+textoNome.val().length+':'+ $('#nome').text() +'-'+textoNome.val());
							   alert('Valor inadequado para o campo!');
							   return false;
						}
						/*
						$(".novoMembrobtn").click(function () {
							if ($("input[type=text]").filter(function () {
								return this.value.match(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/);
							})) {
								$("div").text("pass");
							} else {
								$("div").text("fail");
							}
							//(/^
							//(?=.*\d)                //deve conter apenas one digit
							//(?=.*[a-z])             //deve conter apenas one lower case
							//(?=.*[A-Z])             //deve conter apenas one upper case
							//[a-zA-Z0-9]{8,}         //deve conter apenas 8 dos mencionados characters
							//$/)

						});
						*/

					}
				});	
			}); /* end jquerry */		
							
</script>
@endsection