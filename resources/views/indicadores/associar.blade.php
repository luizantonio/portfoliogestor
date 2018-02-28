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
	@if(Session::has('message'))
		<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
	@endif

	
	<div class="col-sm-offset-1 col-sm-10">
		<div class="panel panel-default">

			<div class="panel-heading">		
				<div class="form-group">
					<div class="col-sm-offset-0 col-sm-0">						    
						<a href ="{{ url('indicadores/fases') }}"> <button type="button" class="btn btn-success" title="Voltar para a tela Anterior" id="btnvoltar">
							<i class="fa fa-chevron-left"> Voltar</i> 
						</button></a> <center><b><h3>Associar Indicador à Fase do projeto</h3></b></center> 
					</div>
				</div>
			</div>


			<center><b><span id="mensagemCancelar"></span></b><span id="mensagemVoltar"></span></b></center>
					
       @if(!is_null($indicadoresall) && count($indicadoresall) > 0)    

       @if(!is_null($fases) && count($fases) > 0)           

		@if(!is_null($projetos) && count($projetos) > 0)
			<div class="panel panel-default">
				
					@foreach($projetos as $projeto) 
							@php echo 'Projeto:<b>'.$projeto->nome.'</b>'; @endphp
							@break
					@endforeach					
			
				<div class="panel-body">
				
			
				<div class="form-group navbar-form">
					@if (count($fases) == 1)
						<output><b>@php echo utf8_encode('Possui Indicador Associado à Fase?'); @endphp</b></output>
					@elseif (count($fases) > 1)
						<output><b>Possui Indicadores Associados às Fases?</b></output>
					@endif

					@foreach($projetos as $projeto)												   
							<!-- Fase Associada com indicadorSim ou não  -->
							@if( $projeto->isQualIndicador( $projeto->id) )
								<label for="1ch-associado" class="col-md-4 control-label"><b style="color:green;">@php echo utf8_encode('Sim'); @endphp</b></label>
								<hr/>
							@else
								<label for="1ch-associado" class="col-md-4 control-label"><b style="color:red;">Não</b></label>
								<hr/>
							@endif					
				    @endforeach	
					<br>
				  </div>
				  <div class="">			
					@foreach($projetos as $projeto)
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
					@endforeach
				</div>

				<div class="panel-body">
				<!-- Display Validation Errors -->
				@include('common.erros')

				<!-- New Projeto Form -->
				<form id="form-cadastro" action="{{ url('indicador/store') }}" method="POST">
					{!! csrf_field() !!}
				
					<div class="form-group navbar-form">
						    <label for="fasedoProjeto" class="control-label">@php echo utf8_encode('Fase do Projeto:'); @endphp </label>
							<select class="form-control m-b" name="fasedoProjeto" id="fasedoProjeto" >
								<option value="" disabled="" selected="">Selecione a Fase</option>
									@foreach($fases as $fase)
										@if($projeto->isQualIndicador( $projeto->id))
											<option value="{{ $fase->id }}" {{ $fase->isQualIndicador($fase->id)  ? 'selected=""' :'' }}>{{ $fase->nome }}</option>
										@else
											<option value="{{  $fase->id }}" >{{ $fase->nome }}</option>
										@endif
									@endforeach				  
							</select>
					</div>
					<div class="form-group navbar-form">
						    <label for="indicadorProjeto" class="control-label">Associar ao Indicador: </label>						
							<select class="form-control m-b" name="indicadorProjeto">

									@foreach($indicadoresall as $indicador)								 
										<option value="{{ $indicador->id }}" selected="">{{ $indicador->nome }}</option>
										
									@endforeach				  
							 </select>
					</div>
					<div class="form-group navbar-form">
						    <label class="control-label">Valores Esperados</label>
					</div>
					 <div class="form-group navbar-form">
                            <label for="valormaximo" class="control-label">Valor M&aacute;ximo:</label>

                       
                                <input id="valormaximo" type="number" class="form-control" name="valormaximo" value="{{ old('valormaximo') }}" min="1" max="100" required onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" onclick="this.value=this.value.replace(/[^0-9]/g,'');">

                                @if ($errors->has('valormaximo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('valormaximo') }}</strong>
                                    </span>
                                @endif
                          
                        </div>

                        <div class="form-group navbar-form">
                            <label for="valorminimo" class="control-label">Valor M&iacute;nimo:</label>

                  
                                <input id="valorminimo" type="number" class="form-control" name="valorminimo" value="{{ old('valorminimo') }}" min="1" max="100" required onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" onclick="this.value=this.value.replace(/[^0-9]/g,'');">

                                @if ($errors->has('valorminimo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('valorminimo') }}</strong>
                                    </span>
                                @endif
                          
                        </div>
					
					<!-- Add Task Button -->
					
					<div class="form-group navbar-form">
						<div class="col-sm-offset-3 col-sm-6">
						
						     <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}" class="form-control">
							 <input type="hidden" name="projeto_id" id="projeto_id" value="{{$projeto->id}}" class="form-control">

							<a href="{{ url('indicadores/associar/'.$projeto->id)}}">
								<button  title="@php echo utf8_encode('Associar Indicador');@endphp" type="submite" class="btn btn-primary" id="'btn-{{$projeto->id}}'">
									<i class="fa fa-exchange"> @php echo utf8_encode('Associar Indicador'); @endphp</i> 
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
								var button = confirm("Quer enviar os dados?");	// return true or false								
								if(button == true)
								{
										var form_id = $(this).closest('form').attr('id');																									
										$('#'+form_id).submit();
								}
							});
							

						 }); /* end jquerry */
					</script>

                @else
                    <br/>
                    <div class="alert-warning">
                        <center><span class="glyphicon glyphicon-alert"> 
                        <b> N&atilde;o existem Projetos Cadastradas&#33;</b></span></center>
                    </div>                  
               @endif

             @else
                    <br/>
                    <div class="alert-warning">
                        <center><span class="glyphicon glyphicon-alert"> 
                        <b> N&atilde;o existem Fases Cadastradas&#33;</b></span></center>
                    </div>        			
			@endif
        @else
                    <br/>
                    <div class="alert-warning">
                        <center><span class="glyphicon glyphicon-alert"> 
                        <b> N&atilde;o existem Indicadores Cadastradas&#33;</b></span></center>
                    </div>
        @endif
		</div>
	</div>
</div>
	@endsection