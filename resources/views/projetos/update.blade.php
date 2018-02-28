@extends('layouts.app')
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
            .message {
                width: 50%;
                padding: 35px;
            }
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

@if(Session::has('message_error_projeto_update'))
	<p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('message_error_projeto_update') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
@endif
@if(Session::has('message_success_projeto_update'))
	<p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message_succes_projeto_update') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
@endif

	<div class="col-sm-offset-2 col-sm-8">
		<div class="panel panel-default">
			<div class="panel-heading">		
				<div class="form-group">
					<div class="col-sm-offset-0 col-sm-0">						    
						<a href ="{{ route('projetos.show') }}"> <button type="button" class="btn btn-success">
							<i class="fa fa-chevron-left"> Voltar</i> 
						</button></a> <center><b><h3>Atualizar Projeto</h3></b></center>						
					</div>
				</div>
			</div>

			@if ( count($projetos) > 0)
			<div class="panel-body">
				<!-- Display Validation Errors -->
				@include('common.erros')
				</br>	
				<center><b><span id="mensagemVancelar"></span></b>&nbsp;&nbsp;<span id="mensagemVoltar"></span></b></center>		
				<!-- New Projeto Form -->
				<!-- <form action=" route('projetos.updateAfter')" method="route('updateAfter')" enctype="multipart/form-data"> -->
				
				 <form action=" {{ route('projetos.atualizar' ) }} " method="GET">
					{!! csrf_field() !!}
					{{ method_field('GET') }}
													
					<!-- Projeto -->
					<div class="form-group">
						<label for="nomeProjeto" class="control-label">Nome do Projeto: </label>
						<input type="text" name="nomeProjeto" id="nomeProjeto" class="form-control" value="{{$projetos->nome}}">
					</div>		
					<div class="form-group">
						<label for="gerenteResponsavel" class="control-label">Nome do Gerrente Respons&aacute;vel: </label>						
						@if(!is_null($collectionGerentes) && count($collectionGerentes) > 0 )
							<select class="form-control m-b" name="gerenteResponsavel" id="fasedoProjeto" >
								<option value="" disabled="" selected=""> SELECIONE O GERENTE </option> 
									@foreach($collectionGerentes as $gerente)
										@if($projetos->gerente_responsavel == $gerente->id )
											<option selected="" style="color: whitesmoke !important; background: #bf5279 !important;}" value="{{  $gerente->id }}" >{{ $gerente->name }} - GERENTE</option>	
										@else
											<option value="{{  $gerente->id }}" >{{ $gerente->name }}</option>	
										@endif									
									@endforeach				  
							</select>
						@else
							<input type="text" name="gerenteResponsavel" id="gerenteResponsavel" class="form-control">
						@endif
					</div>

					<div class="form-group navbar-form">						
						<label for="dataInicioDia" class="control-label">Data In&iacute;cio:</label>

<!--
						 <input id="dataInicio" type="text" onKeyPress="return mask(this);  function mask(val) { var  value = val.value.split('/');  
						 var maximos = [31, 12, 2100];var novoValor = value.map( function (parcela, i) { if (parseInt(parcela, 10) > maximos[i]){
						 console.log(maximos[i]); 
						 return maximos[i];}
						  console.log(parcela);
						  return parcela; 
						  if (novoValor.toString() != value.toString()){ val.value = novoValor.join('/'); return novoValor;}  } ) }">
						   this.value=(this.value + 0 )"
-->

						<select class="form-control m-b" name="dataInicioDia" id="dataInicioDia" >
								<option value="" disabled="" selected="">Dia</option>
								@php  				
									config(['app.timezone' => 'pt_BR']);  
									$day = date('d', strtotime($projetos->data_de_inicio)); 							
									$days = array();
									for($i = 0; $i < 32; $i++){
										 $days[] = date("d", strtotime('-'. $i .' days'));
									}
								@endphp
								@foreach($days as $d)
									@if($d == $day)
										<option selected="" value="{{ $d }}">{{ $d  }}</option>
									@else
										<option value="{{ $d }}">{{ $d  }}</option>
									@endif
								@endforeach				  
							</select>
							<select class="form-control m-b" name="dataInicioMes" id="dataInicioMes" >
								<option value="" disabled="" selected="">M&ecirc;s</option>
								@php  							   
									$month = date('m', strtotime($projetos->data_de_inicio)); 							
									$months = array();								
									for($i = 0; $i < 13; $i++){
										 $months[] = date("m", strtotime('-'. $i .' month'));
									}							  
								@endphp
								@foreach($months as $m)
									@if($m == $month)
										<option selected="" value="{{ $m }}">{{ $m  }}</option>
									@else
										<option value="{{ $m }}">{{ $m  }}</option>
									@endif
								@endforeach				  
							</select>
											
							 <input id="dataInicioAno" type="number" class="form-control" name="dataInicioAno" 
							  value="{{ date('Y', strtotime($projetos->data_de_inicio)) }}" min="2000" max="2999" required 
							   onkeyup="this.value=this.value.replace(/[^0-9]/g,'');if(parseInt(this.value)>2999){this.value=this.value.replace(this.value,'')}"
							   onclick="this.value=this.value.replace(/[^0-9]/g,'');if(parseInt(this.value)>2999){this.value=this.value.replace(this.value,'')}"
							   onKeyPress="this.value=this.value.replace(/[^0-9]/g,'');  if(parseInt(this.value)>2999){this.value=this.value.replace(this.value,'')}">
				
					</div>

					<div class="form-group navbar-form">						
							<label for="previsaoDeTerminoDia" class="control-label">Data de T&eacute;rmino </label>											
							<select class="form-control m-b" name="previsaoDeTerminoDia" id="previsaoDeTerminoDia" >
								<option value="" disabled="" selected="">Dia</option>
								@php  				
									config(['app.timezone' => 'pt_BR']);  
									$day = date('d', strtotime($projetos->previsao_de_termino));  							
									$days = array();
									for($i = 0; $i < 32; $i++){
										 $days[] = date("d", strtotime('-'. $i .' days'));
									}
								@endphp
								@foreach($days as $d)
									@if($d == $day)
										<option selected="" value="{{ $d }}">{{ $d  }}</option>
									@else
										<option value="{{ $d }}">{{ $d  }}</option>
									@endif
								@endforeach				  
							</select>
							<select class="form-control m-b" name="previsaoDeTerminoMes" id="previsaoDeTerminoMes" >
								<option value="" disabled="" selected="">M&ecirc;s</option>
								@php  							   
									$month = date('m', strtotime($projetos->previsao_de_termino));  							
									$months = array();								
									for($i = 0; $i < 13; $i++){
										 $months[] = date("m", strtotime('-'. $i .' month'));
									}							  
								@endphp
								@foreach($months as $m)
									@if($m == $month)
										<option selected="" value="{{ $m }}">{{ $m  }}</option>
									@else
										<option value="{{ $m }}">{{ $m  }}</option>
									@endif
								@endforeach				  
							</select>
												
							 <input id="previsaoDeTerminoAno" type="number" class="form-control" name="previsaoDeTerminoAno" 
							  value="{{ date('Y', strtotime($projetos->previsao_de_termino)) }}" min="2000" max="2999" required onkeyup="this.value=this.value.replace(/[^0-9]/g,'');if(parseInt(this.value)>2999){this.value=this.value.replace(this.value,'')}"
							   onclick="this.value=this.value.replace(/[^0-9]/g,'');if(parseInt(this.value)>2999){this.value=this.value.replace(this.value,'')}"
							   onKeyPress="this.value=this.value.replace(/[^0-9]/g,''); if(parseInt(this.value)>2999){this.value=this.value.replace(this.value,'')}">								
							
					</div>
					
					<div class="form-group navbar-form">
						<label for="dataRealDeTerminoDia" class="control-label">Data Real de T&eacute;rmino</label>						
							<select class="form-control m-b" name="dataRealDeTerminoDia" id="dataRealDeTerminoDia" >
								<option value="" disabled="" selected="">Dia</option>
								@php  				
									config(['app.timezone' => 'pt_BR']);  
									$day = date('d' , strtotime($projetos->data_real_de_termino));  							
									$days = array();
									for($i = 0; $i < 32; $i++){
										 $days[] = date("d", strtotime('-'. $i .' days'));
									}
								@endphp
								@foreach($days as $d)
									@if($d == $day)
										<option selected="" value="{{ $d }}">{{ $d  }}</option>
									@else
										<option value="{{ $d }}">{{ $d  }}</option>
									@endif
								@endforeach				  
							</select>
							<select class="form-control m-b" name="dataRealDeTerminoMes" id="dataRealDeTerminoMes" >
								<option value="" disabled="" selected="">M&ecirc;s</option>
								@php  							   
									$month = date('m' , strtotime($projetos->data_real_de_termino));  							
									$months = array();								
									for($i = 0; $i < 13; $i++){
										 $months[] = date("m", strtotime('-'. $i .' month'));
									}							  
								@endphp
								@foreach($months as $m)
									@if($m == $month)
										<option selected="" value="{{ $m }}">{{ $m  }}</option>
									@else
										<option value="{{ $m }}">{{ $m  }}</option>
									@endif
								@endforeach				  
							</select>
											
							 <input id="dataRealDeTerminoAno" type="number" class="form-control" name="dataRealDeTerminoAno" 
							  value="{{ date('Y', strtotime($projetos->data_real_de_termino)) }}" min="2000" max="2999" required 
							   onkeyup="this.value=this.value.replace(/[^0-9]/g,'');if(parseInt(this.value)>2999){this.value=this.value.replace(this.value,'')}"
							   onclick="this.value=this.value.replace(/[^0-9]/g,'');if(parseInt(this.value)>2999){this.value=this.value.replace(this.value,'')}"
							   onKeyPress="this.value=this.value.replace(/[^0-9]/g,''); 
							   if(parseInt(this.value)>2999){this.value=this.value.replace(this.value,'')}">
																			

					</div>
					<div class="form-group navbar-form">
						<label for="orcamentoTotal" class="control-label">Or&ccedil;amento Total R$: </label>
						<input type="number" name="orcamentoTotal" id="orcamentoTotal" min="0"  class="form-control" value="{{$projetos->orcamento_total}}">
					</div>
					<output style="background-color:#F0F8FF;">Descri&ccedil;&acirc;o:<span  id="content_descricao">{{$projetos->descricao}}</span></output> 
					<div class="form-group">
						<label for="descricao" class="control-label">Descri&ccedil;&atilde;o:</label>												
						<output> Voc&ecirc; tem: <b style="color:red;"><span id="charNumDescricao">255</span></b> characters sobrando</output> 
						<textarea name="descricao" rows="6" cols="50"  min="15" maxlength="255" value="" placeholder="@php echo utf8_encode('Inserir Texto da justificativa');@endphp" 
								id="descricao" class="acompanhar Aprovada requerido form-control"																
								onKeyPress="return countChar(this); function countChar(val) { var len = val.value.length; if (len >= 255) {val.value = val.value.substring(0, 255);} else { $('#charNumDescricao').text(255 - len);}}; " ></textarea>
					</div>
					<div class="form-group navbar-form">
							<output style="color:red;">* A altera&ccedil;&atilde;o s&oacute; pode ser realizada atrav&eacute;s do menu [Projetos/Alterar status do projeto]!</output>
						    <label for="statusId" class="control-label"><b style="color:red;">*</b>Status: </label>
							<input type="hidden" name="statusId" id="statusId" value="{{$projetos->status_id}}" class="form-control">
							<select disabled class="form-control" name="statusId" id="statusId">
								<option value="1" @if($projetos->status_id === 1) selected>@php echo utf8_encode('ANÁLISE APROVADA'); @endphp</option>  @else >@php echo utf8_encode('ANÁLISE APROVADA'); @endphp</option> @endif
								<option value="2" @if($projetos->status_id === 2) selected>@php echo utf8_encode('ANÁLISE REALIZADA'); @endphp</option> @else >@php echo utf8_encode('ANÁLISE REALIZADA'); @endphp</option> @endif
								<option value="3" @if($projetos->status_id === 3) selected>@php echo utf8_encode('CANCELADO'); @endphp</option>         @else >@php echo utf8_encode('CANCELADO'); @endphp</option> @endif
								<option value="4" @if($projetos->status_id === 4) selected>@php echo utf8_encode('EM ANÁLISE'); @endphp</option>        @else >@php echo utf8_encode('ANÁLISE'); @endphp</option> @endif
								<option value="5" @if($projetos->status_id === 5) selected>@php echo utf8_encode('EM ANDAMENTO'); @endphp</option>      @else >@php echo utf8_encode('EM ANDAMENTO'); @endphp</option> @endif
								<option value="6" @if($projetos->status_id === 6) selected>@php echo utf8_encode('ENCERRADO'); @endphp</option>         @else >@php echo utf8_encode('ENCERRADO'); @endphp</option> @endif
								<option value="7" @if($projetos->status_id === 7) selected>@php echo utf8_encode('INICIADO'); @endphp</option>	        @else >@php echo utf8_encode('INICIADO'); @endphp</option> @endif
								<option value="8" @if($projetos->status_id === 8) selected>@php echo utf8_encode('PLANEJADO'); @endphp</option>         @else >@php echo utf8_encode('PLANEJADO'); @endphp</option> @endif									             							
							</select>				
					</div>
					<div class="form-group navbar-form">
						<label for="classificacaoId" class="control-label">Classifica&ccedil;&atilde;o (Risco): </label>
					    <select class="form-control" name="classificacaoId" id="classificacaoId">
								<option value="1" @php if($projetos->classificacao_id === 1){ echo 'selected>ALTO RISCO</option>';} else{ echo' >ALTO RISCO</option>';}@endphp
								<option value="2" @if($projetos->classificacao_id === 2) selected>BAIXO RISCO</option> @else >BAIXO RISCO</option>@endif
								<option value="3" @if($projetos->classificacao_id === 3) selected>MEDIO RISCO</option>   @else >MEDIO RISCO</option>@endif																	
							</select>
					</div>
					<!-- Add Task Button -->
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-6">
						    <input type="hidden" name="projeto_id" id="projeto_id" value="{{$projetos->id}}" class="form-control">
							<button type="submite" class="btn btn-primary">
								<i class="fa fa-plus"> Adicionar Projeto</i> 
							</button>
						</div>
					</div>
				</form>
			</div>
					<script type="text/javascript">
						$(document).ready(function () {
							$('#content_descricao').find(function (event) {
								//console.log($('#content_descricao').text());
								if($('#content_descricao').val() != 'undefined'){
									$('#descricao').text($('#content_descricao').text());
									$('#charNumDescricao').text(255 - $('#content_descricao').text().length);
								}								
							});
							$('#btn-cancelar').click(function () {
								$("#name").attr("disabled", true);
								$("#atualizar :input").prop("disabled", true);
								var texto = "";
								//$( "#mensagemVancelar" ).val() = '';
								$( "#mensagemVancelar" ).text('@php echo utf8_encode("Operação cancelada!"); @endphp');
								$( "#mensagemVancelar" ).css( "color", "red" ).find( ".special" ).css( "color", "green" );

								$( "#mensagemVoltar" ).text('@php echo utf8_encode("Clique no botão [Voltar] para retornar!"); @endphp');
								$( "#mensagemVoltar" ).css( "color", "green" );
								
							});
							
						 });
					</script>					
			@endif

		</div>
	</div>
	
</div>
      @endsection
  
