@extends('layouts.app')

@section('content')  
<head>
    <!-- <link rel="stylesheet" href="   asset('css/bootstrap-theme.min.css')"> -->
        <!-- <script src="{{asset('js/jquery.min.js')}}"></script> -->

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
    



        .congratz {
            margin: 0 auto;
            text-align: center;
        }
        .message::before {
            content: " ";
           /* background: url(https://...);*/
            width: 141px;
            height: 175px;
            position: absolute;
            left: -150px;
            top: 0;
        }
        .message {
            width: 50%;
            margin: 0 auto;
            height: auto;
            padding: 40px;
            background-color: #eeecf9;
            margin-bottom: 100px;
            border-radius: 5px;
            position:relative;
        }
        .message p {
            font-weight: 300;
            font-size: 16px;
            line-height: 24px;
        }
        #pathName {
            margin: 20px 10px;
            color: grey;
            font-weight: 300;
            font-size:18px;
            font-style: italic;
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
            .message {
                width: 50%;
                padding: 35px;
            }
            .container {
                margin-top: 30px;
            }
        }
        @media screen and (max-width: 650px) {
            .message {
                width: 100%;
                padding: 35px;
            }
            .message::before {
                width: 100px;
                height: 123px;
                position: relative;
                left: auto;
                top: 0;
                float: left;
                margin-right: 15px;
                background-size: 100px;
            }
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
@if(Session::has('message_error_remover_acomp'))
	<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message_error_remover_acomp') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
@endif
@if(Session::has('message_success_remover_acomp'))
	<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message_success_remover_acomp') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
@endif
	</center>
	<div class="col-sm-offset-1 col-sm-10">
		<div class="panel panel-default">
			<div class="panel-heading">		
				<div class="form-group">
					<div class="col-sm-offset-0 col-sm-0">						    
						<a href ="{{ route('home') }}"> <button type="button" id="btnvoltar" class="btn btn-success">
							<i class="fa fa-chevron-left"> Voltar</i> 
						</button></a> <center><b><h3>Remover Acompanhamento Semanal de Projeto</h3></b></center>
					</div>
				</div>
			</div>
			<center><b><span id="mensagemCancelar"></span></b><span id="mensagemVoltar"></span></b></center>
		
		
		@if(!is_null($projetos) && count($projetos) > 0)
			<div class="panel panel-default">

				<div class="panel-body">
				  <div class="alert-warning">
				  	<span class="glyphicon glyphicon-alert"> 
		                <b style="text-align:justify;"> Caso o acompanhamento semanal possua texto informado, estes ser&atilde;o removidos definitivamennte&#33;</b></span>
				  </div>
				  <div class="alert-info">
				  	<span class="glyphicon glyphicon-info-sign"> 
		                <b style="text-align:justify;"> O formul&aacute;rio do acompanhamento semanal continuar&aacute; sendo exibido na p&aacute;gina inicial se possuir indicadores associados ao projeto. Caso todos os indicadores sejam desassociados atrav&eacute;s do menu "Indicadores/ Desassociar Indicador do Projeto" este deixar&aacute; de ser exibido&#33;</b></span>
				  </div>
				  <div class="alert-warning">
				  	<span class="glyphicon glyphicon-alert"> 
		                <b style="text-align:justify;"> Cuidado&#33; Os valores dos indicadores informados e o acompanhamento destes ser&atilde;o perdidos definitivamennte&#33;</b></span>
				  </div>
				  <div class="">
				   <output>Projetos:</output>		
				   <table class="table table-condensed table-striped">
				   <tbody>	
					@foreach($projetos as $projeto)
							<!-- Indicador  -->
							<div class="form-group navbar-form">
								<tr><td>
									<output>		
										{{ $projeto->nome }}
											</output>
											</td>
											<td>
											   <form id="formIndic-{{$projeto->id}}"action="{{ url('semanal/'.$projeto->id)}}" method="post" clsss="float:left">
												  {!! csrf_field() !!} 
												  {{ method_field('DELETE') }}
													 <input type="hidden" name="projeto" id="projeto" value="{{$projeto->id}}" class="form-control">
													 <input type="hidden" name="user" id="user" value="{{Auth::user()->id}}" class="form-control">
												
													<a href="{{ url('semanal/'.$projeto->id)}}">
													  <button  title="Remover Acompanhamento Semanal do Projeto." type="submite" class="btn btn-sm btn-danger" id="'btn-{{$projeto->id}}'">
														<i class="fa fa-trash-o"> Remover</i> 
													  </button></a>
											  </form>
											</td></tr>
									
							</div>
					@endforeach
					</tbody>	
				</table> 
				</div>
			   <!-- Add Task Button -->
				
					<div class="form-group">
						<div class="col-sm-offset-5 col-sm-6">
							<button title="@php echo utf8_encode('Cancelar Operações');@endphp" type="button" id="btn-cancelar" class="btn btn-warning">
								<i class="fa fa-minus"><b>Cancelar</b></i> 
							</button>
						</div>
					</div>
				</div>
			</div> 
			<script type="text/javascript">
						$(document).ready(function () {
							$("#btnvoltar").attr("disabled", false);
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
								var button = confirm("Quer remover o aconpanhamento?");	// return true or false								
								if(button == true)
								{
										var formIndic = $(this).closest('form').attr('id');	
										//alert($(this).closest('form').attr('action'));																								
										$('#'+formIndic).submit();
								}
							});
							
							

						 }); /* end jquerry */
					</script>	
			@else
			<div class="alert-warning">
		        <center><span class="glyphicon glyphicon-alert"> 
		        <b> N&atilde;o existem acompanhamentos a serem removidos&#33;</b></span></center>
		   </div>		
			@endif
		</div>
	</div>
</div>
	@endsection