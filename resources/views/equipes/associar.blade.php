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
            .message {
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

	@php echo utf8_encode('<center><h3><b>Associar Indicador à Fase do projeto</b></h3></center>'); @endphp
	<div class="col-sm-offset-1 col-sm-10">
		<div class="panel panel-default">	
					<div class="form-group">
						<div class="col-sm-offset-0 col-sm-0">						    
							<a href ="{{ url('indicadores/fases') }}"> <button title="@php echo utf8_encode('Voltar para a tela Anterior');@endphp" type="button" id="btnvoltar" class="btn btn-success">
								<i class="fa fa-chevron-left"> @php echo utf8_encode('Voltar'); @endphp </i> 
							</button></a>
						</div>
						<center><b><span id="mensagemCancelar"></span></b><span id="mensagemVoltar"></span></b></center>
					</div>		
                  

		@if (count($projetos) <= 0 || $projetos == null)	
			<center><div style="background-color: white;"><h3><b><p class="danger"><b>@php utf8_encode('Projeto não foi encontrado!'); @endphp </b><h3></div></center>	
		@endif
		@if (count($projetos) > 0)
			<div class="panel panel-default">
				<div class="panel alert-info">
					@foreach($projetos as $projeto) 
							@php echo '<center><h3><b>'.$projeto->nome.'</b></h3></center>'; @endphp
							@break
					@endforeach					
				</div>
				<div class="panel-body">
				
			
				<div class="form-group navbar-form">
					@if (count($fase) == 1)
						<output><b>@php echo utf8_encode('Possui Indicador Associado à Fase?'); @endphp</b></output>
					@elseif (count($fase) > 1)
						<output><b>@php echo utf8_encode('Possui Indicadores Associados às Fases?'); @endphp</b></output>
					@endif

					@foreach($projetos as $projeto)												   
							<!-- Fase Associada com indicadorSim ou não  -->
							@if( $projeto->isQualIndicador( $projeto->id) )
								<label for="1ch-associado" class="col-md-4 control-label"><b style="color:green;">@php echo utf8_encode('Sim'); @endphp</b></label>
								<hr/>
							@else
								<label for="1ch-associado" class="col-md-4 control-label"><b style="color:red;">@php echo utf8_encode('Não'); @endphp</b></label>
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
								@foreach($fases as $fase)
									@if($projeto->isQualIndicador( $projeto->id))									   
										@if($fase->isQualIndicador($fase->id))
											@if($fase->isQualIndicador($fase->id))											   
												<span id="indicadoresDaFase">{{$fase->nome }} - </span>
												<span id="indicadoresDaFase">{{ $fase->isQualIndicadorArray($fase->id) }}</span><br>							
											@endif
										@endif																					
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
								<option value="" disabled="" selected="">Buscar por Fase...</option>
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
									@foreach($indicadores as $indicador)								 
										<option value="{{ $indicador->id }}" selected="">{{ $indicador->nome }}</option>
										
									@endforeach				  
							 </select>
					</div>
					<div class="form-group navbar-form">
						    <label class="control-label">Valores Esperados</label>
					</div>
					 <div class="form-group navbar-form">
                            <label for="valormaximo" class="control-label">@php echo utf8_encode('Valor Máximo:'); @endphp</label>

                       
                                <input id="valormaximo" type="number" class="form-control" name="valormaximo" value="{{ old('valormaximo') }}" min="1" max="100" required>

                                @if ($errors->has('valormaximo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('valormaximo') }}</strong>
                                    </span>
                                @endif
                          
                        </div>

                        <div class="form-group navbar-form">
                            <label for="valorminimo" class="control-label">@php echo utf8_encode('Valor Mínimo:'); @endphp</label>

                  
                                <input id="valorminimo" type="number" class="form-control" name="valorminimo" value="{{ old('valorminimo') }}" min="1" max="100" required>

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
									<i class="fa fa-plus">@php echo utf8_encode('Associar Indicador'); @endphp</i> 
								</button></a>
						</div>
					</div>
				</form>
			</div>

			
			   <!-- Add Task Button -->
				
					<div class="form-group">
						<div class="col-sm-offset-5 col-sm-6">
							<button title="@php echo utf8_encode('Cancelar Operações');@endphp" type="button" id="btn-cancelar" class="btn btn-warning">
								<i class="fa fa-minus-square"><b>Cancelar</b></i> 
							</button>
						</div>
					</div>

				</div>
			</div> 
			<script type="text/javascript">
						$(document).ready(function () {
							$("#btnvoltar").attr("disabled", true);
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