@extends('layouts.app')
@section('content')

	<head>
	<!-- <link rel="stylesheet" href="   asset('css/bootstrap-theme.min.css')"> -->
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

@if(Session::has('alert-danger') || Session::has('alert-success'))
	<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))

      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
  </div> 
@endif

	@if (count($fases) > 0)
		@php echo '<center>'; @endphp	
		@foreach ($fases as $fase)	
			@php //echo $fase->role_name.';  '; @endphp			
		@endforeach
		@php echo '</center>'; @endphp	
	@endif

	@php echo utf8_encode('<center><h3><b>Associar Equipe ao Projeto</b></h3></center>'); @endphp
	<div class="col-sm-offset-1 col-sm-10">
		<div class="panel panel-default">
			<div class="panel-heading">		
				<div class="form-group">
					<div class="col-sm-offset-0 col-sm-0">						    
						<a href ="{{ route('home') }}"> <button type="button" class="btn btn-success">
							<i class="fa fa-chevron-left"> Voltar</i> 
						</button></a>
					</div>
					<div class="col-sm-offset-0 col-sm-0"> 
						</button></a> <center><b><h3>Associar Equipe ao Projeto</h3></b></center>
					</div>
				</div>
			</div>




			<div class="form-group">
				<div class="col-sm-offset-0 col-sm-0">						    
					<a href ="{{ route('home') }}"> <button title="@php echo utf8_encode('Voltar para o início');@endphp" type="button" id="btnvoltar" class="btn btn-success">
					<i class="fa fa-plus">@php echo utf8_encode('Voltar para o Início'); @endphp </i> 
					</button></a>
				</div>
				<center><b><span id="mensagemCancelar"></span></b><span id="mensagemVoltar"></span></b></center>
			</div>		
            <div id="ativabusca"> <b style="color:red;">BUG: envia para show</b>
						<form action="{{ route('indicador.ordenarPor') }}" method="POST" id="formOrdenar">						
							{!! csrf_field() !!}
							<select class="form-control m-b" name="ordenarUsuarioPor" onchange="this.form.submit()">
							   <option value="" disabled="" selected="">Ordenar por...</option>
							   <option value="NOMEDOUSUARIO">Nome</option>
							   <option value="EMAILDOUSUARIO">Email</option>
							   <option value="PERFILDOUSUARIO">Perfil</option>							  
							 </select>
						</form>
                        <form class="navbar-form " id="buscarusuario" role="form" action="{{ route('indicador.buscar') }}" method="POST">
							{!! csrf_field() !!}

                            <div class="form-group">
                                Filtrar: <b style="color:red;">BUG: envia para show</b>
								<input type="text" value="" placeholder="Nome do Projeto" name="nomeUsuarioBusca" id="nomeUsuarioBusca" class="form-control">                                
                            </div>          
                            <button title="@php echo utf8_encode('Buscar por');@endphp"type="submit" class="btn btn-sm btn-default" id="button_search"  onclick="this.form.submit()"><span class="glyphicon glyphicon-search active">&nbsp;Buscar</span></button>
                        </form>
                    </div>

		@if (count($projetos) <= 0 || $projetos == null)	
			<center><div style="background-color: white;"><h3><b><p class="danger"><b>@php utf8_encode('Usuário não foi encontrado!'); @endphp </b><h3></div></center>	
		@endif
		@if (count($projetos) > 0)
			<div class="panel panel-default">
				<div class="panel-heading">
				    @if (count($projetos) == 1)
						@php echo utf8_encode('Projeto Cadastrado:'); @endphp {{count($projetos)}}
					@elseif (count($projetos) > 1)
						@php echo utf8_encode('Projetos Cadastrados:'); @endphp {{count($projetos)}}
					@endif
					<br>
				</div>
				<div class="panel-body">
			 <table class="table">
			    <thead>
					<tr>					
						<th>Projeto</th>
						<th>Fase</th>						
						<th>Possui Indicador Associado?</th>
						<th>Indicador(es)</th>																
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
					@foreach($projetos as $projeto)
						<tr>
							  <!--  Nome do Projeto -->
							  <td>{{ $projeto->nome }}<input type="hidden" name="name" value="{{ $projeto->name. $projeto->isQualIndicador( $projeto->id) }}"></td>
							  <td>
							   <div class="form-group navbar-form">

							   <!-- Fase  -->

								  <form action="{{ route('indicador.indicadoresDaFase') }}" method="POST" id="fasedoProjeto">						
									{!! csrf_field() !!}
									
									 <select  disabled=""class="form-control m-b" name="fasedoProjeto" id="fasedoProjeto" onchange="this.form.submit()">
										<option value="" disabled="" selected="">Buscar por Fase...</option>
										@foreach($fases as $fase)
											@if($projeto->isQualIndicador( $projeto->id))
												<option value="{{ $contadorFase }}" {{ $fase->isQualIndicador($fase->id)  ? 'selected=""' :'' }}>{{ $fase->nome }}</option>
											@else
												<option value="{{ $contadorFase }}" >{{ $fase->nome }}</option>
											@endif
										
											@php $contadorFase += 1; @endphp

										 @endforeach				  
									 </select>	
								  </form>
								</div>
							  </td>
							   <td>
							   <!-- Fase Associada com indicadorSim ou não  -->
								@if( $projeto->isQualIndicador( $projeto->id) )
									<label for="1ch-associado" class="col-md-4 control-label"><b style="color:green;">@php echo utf8_encode('Sim'); @endphp</b></label>
								@else
									<label for="1ch-associado" class="col-md-4 control-label"><b style="color:red;">@php echo utf8_encode('Não'); @endphp</b></label>
								@endif								
								<input  title="@php echo utf8_encode('Possui Indicador Associado');@endphp" type="checkbox" {{ $projeto->isQualIndicador( $projeto->id) ? 'checked' :'' }} disabled="true" name="1ch-associado" class="custom-control custom-checkbox" id="1ch-{{$projeto->id}}"/>								
							 </td>
							  <td>
							   <!-- Indicador  -->
								<div class="form-group navbar-form">
									<span id="indicadoresDaFase"></span>									
									@foreach($fases as $fase)
										@if($projeto->isQualIndicador( $projeto->id))
										  
											@if($fase->isQualIndicador($fase->id))											   
												<span id="indicadoresDaFase"><strong>{{$fase->nome }}</strong> - </span>
												<span id="indicadoresDaFase">{{ $fase->isQualIndicadorArray($fase->id) }}</span><br>							
											@endif		
																			
										@endif										
								   @endforeach
								</div>
							  </td>	
							 
							  <td>
								<input type="hidden" name="projeto_id" id="projeto_id" value="{{$projeto->id}}" class="form-control">
							  </td>
							  <td>
							 
							   <form id="form-{{$projeto->id}}"action="{{ url('indicadores/associar/'.$projeto->id )}}" method="post">
								  {!! csrf_field() !!} 
								  {{ method_field('PUT') }}
								     <input type="hidden" name="projeto_id" id="projeto_id" value="{{$projeto->id}}" class="form-control">
									<a href="{{ url('indicadores/associar/'.$projeto->id)}}">
									  <button  title="@php echo utf8_encode('Associar Indicador');@endphp" type="submite" class="btn btn-primary" id="'btn-{{$projeto->id}}'">
										<i class="fa fa-plus">@php echo utf8_encode('Associar Indicador'); @endphp</i> 
									  </button></a>
								  </form>
							  </td>
						
						
					  </tr>

					  @php 
					 $contadorFase = 1; 
					 $contadorIndicador= 0;
					 $contadorProjeto= 0;
					 @endphp

					@endforeach
				</tbody>
			  </table>
			
			   <!-- Add Task Button -->
				
					<div class="form-group">
						<div class="col-sm-offset-5 col-sm-6">
							<button title="@php echo utf8_encode('Cancelar Operações');@endphp" type="button" id="btn-cancelar" class="btn btn-warning">
								<i class="fa fa-plus"><b>Cancelar</b></i> 
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

							$("#btnvoltar").attr("disabled", true);

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
							$('.btn-primary').click(function (event) {
				
								event.preventDefault();
								var button = confirm("Quer Associar Indicador?");	// return true or false								
								if(button == true)
								{
										var form_id = $(this).closest('form').attr('id');																									
										$('#'+form_id).submit();
								}
							});
							
							/**--------------------------------------------------------------
								  ALTER CHECKBOX VALUE by Luiz Silva 09/08/2017 11:00:00
							--------------------------------------------------------------***/
							$('input[type="checkbox"]').change(function () {
								var name = $(this).val();
								var check = $(this).prop('checked');																								
								var check_id = $(this).attr('id');

							    //console.log("checkbox id: " + check_id + " ");

								var tamanho = check_id.length;
								var inicioIDuser =  $(this).attr('id').indexOf('-') +1;
								var stringh = check_id.substring(inicioIDuser, tamanho);
								var iduser = parseInt(stringh);
								var indiceCHAVE = $(this).attr('id').indexOf('ch');
								var resURLstring = check_id.substring(0, indiceCHAVE) ;
								var numeroRole = parseInt(resURLstring);

								//console.log( " numeroRole: " + numeroRole + "  iduser : "+ iduser);
								
								var urlaction =  $('form[id="form-' + iduser +'"]').closest('form').attr('action');
								var form_id = $('form[id="form-' + iduser +'"]').closest('form').attr('id');	
																					
								//console.log('action: ' + urlaction);
							   // console.log('form_id: ' + form_id);

								var tamanhoIdform = form_id.length;
								var inicioIdform =  form_id.indexOf('-') +1;
								var stringIdform = form_id.substring(inicioIdform, tamanhoIdform);
								var idUserform = parseInt(stringIdform);

								//console.log('idUserform: ' + idUserform);


								var lenthURL = urlaction.length;																
								var indiceURLrole = urlaction.indexOf("role/") + ("role/").length + 2;									
								var resURL = urlaction.substring(indiceURLrole, lenthURL);

								//console.log("resURL: " + resURL);	

								var val= resURL.split('/');
								//console.log('val inicial: ' + val);
								//console.log(" resURL:" + val);
								var valorurl = null;

								/**--------------------------------------------------------------
								    AO MARCAR UM CHECKBOX by Luiz Silva 09/08/2017 11:00:00
							   ---------------------------------------------------------------**/
								if ($(this).is(':checked')) {
									this.checked = confirm("Quer Marcar o Tipo?");	// return true or false								
									if(this.checked)
									{
										$(this).prop("checked", true);
										$(this).val($(this).is(':checked'));
									}
									
									if(this.checked)
									{

										//console.log(' AO MARCAR UM CHECKBOX');


										/**-------------------------------------------
											   ALTER THE URL
									    -------------------------------------------**/
										var selecionado = function (grupo) { 																	
											var result = $('input:checked'); 
											if (result.length > 0 ) { 
												var contador = result.length + " selecionado(s)<br/>"; 
										
										
												result.each(function () { 
													if( (typeof  $(this).attr('id')) != "undefined" &&  $(this).attr('id').indexOf('-') !== -1  ) {
												
														if(numeroRole == 1){
															val[0] = 1;												    													
														}
														if(numeroRole == 2){
															val[1] = 1;
														}
														if(numeroRole == 3){
															val[2] = 1;													
														}
														if(numeroRole == 4){
															val[3] = 1;													
														}
														if(numeroRole == 5){
															val[4] = 1;													
														}
													}

													/*
													const input = 'role/1/1/0/0/0/0';
													const [url, user, role_admin, role_gerentep, role_lider_esc, role_liderp, role_membroad] = input.split('/');
													console.log(url); // 
													console.log(user); // 
													console.log(role_admin); // 
													console.log(role_gerentep); // 
													console.log(role_lider_esc); // 
													console.log(role_liderp); //
													console.log(role_membroad); // 
													*/

													contador += $(this).val() + " "
													//console.log(contador);
												}); 
												//$('#divFiltros').html(contador); 
										
											} 
											else { 
												//$('#divFiltros').html("Nenhum selecionado"); 
											} 
											//console.log("REsult: ------------");
											//console.log(result);
											if( typeof idUserform != "undefined" && typeof iduser != "undefined"){
												if( iduser == idUserform){	
												    //console.log(' AO MARCAR UM CHECKBOX');
												    

													valorurl = val[0] +'/'+ val[1] +'/'+ val[2] +'/'+ val[3] +'/'+ val[4] ;
													//console.log(" valorurl------------------> " + valorurl);									
													var finalResultadoURL = urlaction.substring(0, indiceURLrole) + valorurl ;

													//$(form_id).attr( 'action', finalResultadoURL);
													$('#'+form_id).attr('action', finalResultadoURL);
													//console.log("finalResultadoURL: ------------");
													//console.log(finalResultadoURL);
												}									
											}									
										}; 

										selecionado($(this));

									}
								}
								/**---------------------------------------------------------------
								    AO DESMARCAR UM CHECKBOX by Luiz Silva 09/08/2017 11:00:00
							   ---------------------------------------------------------------**/
								if (!$(this).is(':checked')) {
									this.checked = confirm("Quer Desmarcar o Tipo?");  // return true or false								
									if(this.checked)
									{
										$(this).prop("checked", false);
										$(this).val(!$(this).is(':checked'));										
									}
									if(!this.checked)
									{
										//console.log(' AO DESMARCAR UM CHECKBOX');
										/**----------------------------------------------------------------------------
														ALTERA O URL
										----------------------------------------------------------------------------**/
										/***----------------------- by Luiz-----------------------------------------------------------
											   Case don't have marked checkbox, Don't pass in test  result.length (empty)
										-------------------------------------------------------------------------------------------**/
										if( (typeof  $(this).attr('id')) != "undefined" &&  $(this).attr('id').indexOf('-') !== -1  ) {												
											if(numeroRole == 1){												
												val[0] = 0;																																							    													
											}
											if(numeroRole == 2){
												val[1] = 0;
											}
											if(numeroRole == 3){
															val[2] = 0;													
											}
											if(numeroRole == 4){
												val[3] = 0;													
											}
											if(numeroRole == 5){
												val[4] = 0;													
											}
											if(numeroRole == 6){
												val[5] = 0;													
											}
										}
										/***---------------------------by luiz --------------------------------------------------------
											   Case EXISTS one or more marked checkbox. Pass in test  result.length (don't empty)
										-------------------------------------------------------------------------------------------**/

										var selecionado = function (grupo) { 																	
											var result = $('input:checked'); 
											if (result.length > 0 ) { 
												var contador = result.length + " selecionado(s)<br/>"; 
																				
												result.each(function () { 
													if( (typeof  $(this).attr('id')) != "undefined" &&  $(this).attr('id').indexOf('-') !== -1  ) {
												
														if(numeroRole == 1){											
															val[0] = 0;											    													
														}
														if(numeroRole == 2){
															val[1] = 0;
														}
														if(numeroRole == 3){
															val[2] = 0;													
														}
														if(numeroRole == 4){
															val[3] = 0;													
														}
														if(numeroRole == 5){
															val[4] = 0;													
														}
														if(numeroRole == 6){
															val[5] = 0;													
														}
													}


													contador += $(this).val() + " "
													//console.log(contador);
												}); 
												//$('#divFiltros').html(contador); 
										
											} 
											else { 
												//$('#divFiltros').html("Nenhum selecionado"); 
											} 
											//console.log("REsult: ------------");
											//console.log(result);
											if( typeof idUserform != "undefined" && typeof iduser != "undefined"){
												if( iduser == idUserform){	
													valorurl = val[0] +'/'+ val[1] +'/'+ val[2] +'/'+ val[3] +'/'+ val[4] ;
													//console.log(" valorurl------------------> " + valorurl);								
													var finalResultadoURL = urlaction.substring(0, indiceURLrole) + valorurl ;

													//$(form_id).attr( 'action', finalResultadoURL);
													$('#'+form_id).attr('action', finalResultadoURL);
													//console.log("finalResultadoURL: ------------");
													//console.log(finalResultadoURL);
												}									
											}									
										}; //FIM FUNÇÃO
										selecionado($(this));
									}//FIM IF DESCMARCAR
								}// FIM DESMARCAR

							});/* FIM input*/

						 }); /* end jquerry */
					</script>			
			@endif
		</div>
	</div>
</div>
	@endsection