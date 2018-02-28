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
	@if(Session::has('message_error_informar'))
		<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message_error_informar') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
	@endif
	@if(Session::has('message_success_informar'))
		<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message_success_informar') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
	@endif
	@if(Session::has('message'))
		{{ Session::get('message') }}
	@endif




	<div class="col-sm-offset-1 col-sm-10">
		<div class="panel panel-default">	


            <div class="panel panel-heading">
                <div class="col-sm-offset-0 col-sm-0">                          
                     <a href ="{{ url('indicadores/informar') }}">  <button title="Voltar para a tela Anterior" type="button" id="btnvoltar" class="btn btn-success">
                                <i class="fa fa-chevron-left"> Voltar </i> 
                    </button></a>
                </div>
                <center><h3><b>Informar Valores do Indicador</b></h3></center>

             </div>

             <center><b><span id="mensagemCancelar"></span></b><span id="mensagemVoltar"></span></b></center>	
                  

		@if ( is_null($projeto) )	
			<center><div style="background-color: white;"><b><p class="danger"><b>@php utf8_encode('Projeto não foi encontrado!'); @endphp </b></p></div></center>	
		@endif
		@if (!is_null($projeto) > 0)
			<div class="panel panel-default">
				<div class="panel alert-info">
					@php echo '<center>Projeto:&nbsp;<p><b>'.$projeto->nome.'</b></p></center>'; @endphp				
				</div>
				<div class="panel-body">
				
			
				<div class="form-group navbar-form">
					@if (count($fases) == 1)
						<output><b>@php echo utf8_encode('Possui Indicador Associado à Fase?'); @endphp</b></output>
					@elseif (count($fases) > 1)
						<output><b>@php echo utf8_encode('Possui Indicadores Associados às Fases?'); @endphp</b></output>
					@endif

					<!-- Fase Associada com indicadorSim ou não  -->
					@if( $projeto->isQualIndicador( $projeto->id) )
						<label for="1ch-associado" class="col-md-4 control-label"><b style="color:green;">@php echo utf8_encode('Sim'); @endphp</b></label>
						<hr/>
					@else
						<label for="1ch-associado" class="col-md-4 control-label"><b style="color:red;">@php echo utf8_encode('Não'); @endphp</b></label>
						<hr/>
					@endif
					<br>
				  </div>
				  <div class="">			
					@if($projeto->isQualIndicador( $projeto->id))													  
							<!-- Indicador  -->
							<div class="form-group navbar-form">
								<output><b>@php echo utf8_encode('Fase - Indicador:'); @endphp</b></output>								
								@php
									$contadorIndicador = 0;
									$indicadores = $projeto->indicadoresDoProjeto( $projeto->id); 
								@endphp												
								@foreach($indicadores as $indic)
									@if($projeto->isQualIndicador( $projeto->id))
										@php if($contadorIndicador%2===0){ echo '<output style="background-color:lightgray;">';}else{echo '<output style="background-color:lien;">';} @endphp		
											 {{ $indic->nomeFase($indic->fase_id) }} - {{ $indic->nome }}
										@php echo '</output> '; $contadorIndicador = $contadorIndicador + 1; @endphp
									@endif										
								@endforeach
							</div>							  
					@endif
				 </div>

				<div class="panel-body">
				<!-- Display Validation Errors -->
				@include('common.erros')

				<!-- New Projeto Form -->
				<form id="form-cadastro" action="{{ url('indicadores/valores/'.$projeto->id) }}"  method="POST">
					{!! csrf_field() !!}
					{{ method_field('PUT') }}
					<div class="form-group navbar-form">
						    <label for="fasedoProjeto" class="control-label">@php echo utf8_encode('Atual Fase do Projeto:'); @endphp </label>
							@php
								$contadorIndicador = 0;
								$indicadores = $projeto->indicadoresDoProjeto( $projeto->id);							
							@endphp
							@if((!is_null($indicadores)) && (count($indicadores) > 0))
							
								@foreach($indicadores as $indic)
									@if($projeto->isQualIndicador( $projeto->id))
										<input type="hidden" name="relacaoFaseProjeto" id="relacaoFaseProjeto" value="{{$indic->id}}" class="form-control">
									@endif										
								@endforeach				  
								<select  disabled class="form-control m-b" name="fasedoProjetoDisabled" id="fasedoProjetoDisabled" >
									<option value="" disabled="" selected="">Selecione a Fase</option>
										@foreach($indicadores as $indic)
											@if($projeto->isQualIndicador( $projeto->id))
												<option selected="" value="{{ $indic->fase_id }}">{{ $indic->nomeFase($indic->fase_id)  }}</option>
											@else
												<option value="{{  $indic->fase_id }}" >{{ $indic->nomeFase($indic->fase_id) }}{{$indic->id}}</option>
											@endif
										@endforeach				  
								</select>
							
							@endif	
							
					</div>
					<div class="form-group navbar-form">
						    <label for="indicadorProjeto" class="control-label">Selecionar Indicador: </label>						
							<select class="form-control m-b" name="indicadorProjeto">
									@foreach($indicadores as $indicador)	
										
										<option value="{{ $indicador->id }}">{{ $indicador->nome }} - {{ $projeto->faseDoProjetoFaseNome($projeto->id, $indicador->fase_id) }}</option>
									
									@endforeach				  
							 </select>
					</div>
					 <div class="form-group navbar-form">
                            <label for="valormaximo" class="control-label">Informar Valor:</label>

                       
                                <input id="valormaximo" type="number" class="form-control" name="valormaximo" value="{{ old('valormaximo') }}" min="0" max="99999999999" required autofocus="true"a onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" onclick="this.value=this.value.replace(/[^0-9]/g,'');">

                                @if ($errors->has('valormaximo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('valormaximo') }}</strong>
                                    </span>
                                @endif
                          
                        </div>
				<!--
                        <div class="form-group navbar-form">
                            <label for="valorminimo" class="control-label">@php echo utf8_encode('Valor Mínimo:'); @endphp</label>

                  
                                <input id="valorminimo" type="number" class="form-control" name="valorminimo" value="{{ old('valorminimo') }}" min="0" max="99999999999" required onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" onclick="this.value=this.value.replace(/[^0-9]/g,'');">

                                @if ($errors->has('valorminimo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('valorminimo') }}</strong>
                                    </span>
                                @endif
                          
                        </div>
					-->
					<!-- Add Task Button -->
					
					<div class="form-group navbar-form">
						<div class="col-sm-offset-3 col-sm-6">
						
						     <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}" class="form-control">
							 <input type="hidden" name="projeto_id" id="projeto_id" value="{{$projeto->id}}" class="form-control">
							<a href="{{ url('indicadores/valores/'.$projeto->id)}}">
								<button  title="@php echo utf8_encode('Informar Valor do Indicador');@endphp" type="submite" class="btn btn-primary" id="'btn-{{$projeto->id}}'">
									<i class="fa fa-bar-chart"> @php echo utf8_encode('Informar Valore'); @endphp</i> 
								</button></a>
						</div>
					</div>
				</form>
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
							//$("#btnvoltar").attr("disabled", true);
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
							$('.btn-primary').click(function (event) {
				
								event.preventDefault();
								var button = confirm("Quer informar o valor do indicador?");	// return true or false								
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