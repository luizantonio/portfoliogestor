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

        }
    
</style>
</head>


<div class="container">

@php echo '<center><b style="color:gray; position:relative; float: center; top:0px;">'.Auth::user()->roleNAME(Auth::user()->id).'</b></br></center>' @endphp

@if(Session::has('message_error_acompanahamento'))
	<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message_error_acompanahamento') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
@endif
@if(Session::has('message_success_acompanahamento'))
	<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message_success_acompanahamento') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
@endif


    <div class="row">
        <div class="col-md-8 col-md-offset-2">
			<center>Bem vindo ao sistema de gerenciamento do seu portf&oacute;lio de projetos.</center>
			<!-- <a href="{{ route('sendemail')}}" class="btn ntn-block btn-primary">Enviar Um Email</a> -->
			<!-- para o gerente e  o lider de escritório  início -->
			@if(Auth::user()->isGerenteProjetos(Auth::user()->id) || Auth::user()->isLiderEscritProjetos(Auth::user()->id) )				
			   @if(is_null($projetos) || count($projetos) == 0)
					<div class="alert-info">
						<output><b>{{ utf8_encode('Não existem projetos aguardando a realização do acompanahamento semanal!') }}</b></output>
					</div>
				@endif		
				@if(!is_null($projetos) && count($projetos) > 0)
					<div class="panel panel-primary">
						<div class="panel-heading"><b>Painel de Ações</b></div>	
							<div class="panel-body">	
							   <!-- projetos inicio  -->
									@php $quantidadeDeProjetos = 0; @endphp
									@foreach($projetos as $projeto)
										@if($projeto->user_id == Auth::user()->id  || $projeto->gerente_responsavel == Auth::user()->id )
											@php $quantidadeDeProjetos = $quantidadeDeProjetos +1; @endphp
										@endif
									@endforeach
									@if( $quantidadeDeProjetos >= 1)
											<div class="alert-info">
								                <span class="glyphicon glyphicon-info-sign"> 
								                <b>Aguardando Acompanahamento Semanal&#33; Projeto de "Alto Risco" com "Fase" definida&#33;</b></span>
								            </div>
									@else
								            <div class="alert-warning">
								                <center><span class="glyphicon glyphicon-alert"> 
								                <b> N&atilde;o existe Acompanahamento Semanal&#33;</b></span></center>
								            </div>

									@endif
									@foreach($projetos as $projeto)
										@if($projeto->user_id == Auth::user()->id  || $projeto->gerente_responsavel == Auth::user()->id )
											<div class="form-group navbar-form">
												
											@if( $projeto->classificacao_id == 1 )
												<label for="" class="control-label"><b style="background-color:#F0F8AF;">{{$projeto->nome}}</b> - Marque para Editar:</label>  										
												<input type="checkbox"  name="ch-{{$projeto->id}}" class="custom-control custom-checkbox" id="ch-{{$projeto->id}}"/></td>
												<div id="div-{{$projeto->id}}" style='display:none' class="formAcomp">

													<div id="acomp-{{$projeto->id}}"  class="table-responsive">
													  
													   

													@php 
														$semanal =  $projeto->getSemanal( $projeto->id);
													@endphp
													@if (!is_null($semanal))

														Atualizado em: {{ date('d/m/Y', strtotime($projeto->getUpdateSemanal($projeto->id) ) ) }}
														<table class="table">
															<tbody>
															    <tr>
															      <th scope="row">Texto</th>
															      <td style="background-color:#F0F8AF;"><span id="content_acompanhamento-{{$projeto->id}}">{{ $semanal }}</span></td>
															  </tr>
															</tbody>

													  </table>
													@endif
												</div>
													<form id='form-{{$projeto->id}}' action='{{ route("semanal.update")}}' method='post'>
														{!! csrf_field() !!} 
														{{ method_field('PUT') }}
														<input type="hidden" name="user" id="user"          value="{{Auth::user()->id}}" class="form-control">
														<input type="hidden" name="projeto" id="projeto"       value="{{$projeto->id}}" class="form-control">
														<output>Você tem:<b style="color:red;"><span id="charNum-{{$projeto->id }}">1000</span></b> characters sobrando</output> 
														<label for="Acompanhamento" class="control-label">@php echo utf8_encode('Acompanhamento'); @endphp</label>		
														<textarea rows="4" cols="50"  min="6" required autofocus maxlength="1000" value="" placeholder="@php echo utf8_encode('Inserir Texto do Acompanhamento do Projeto');@endphp" 
																name="Acompanhamento" id="Acompanhamento-{{$projeto->id }}" class="acompanhar form-control"
																onKeyPress="return countChar(this); function countChar(val) { var len = val.value.length;if (len >= 1000) {val.value = val.value.substring(0, 1000);}
																else { $('#charNum-'+{{$projeto->id }}).text(1000 - len);}}; " ></textarea>
														<button  title="@php echo utf8_encode('Acompanhamento do Projeto');@endphp" type="button" class="btn btn-info" id="'btn-{{$projeto->id}}'">
															<span class="glyphicon glyphicon-pencil"></span> 
															&nbsp; Acompanhar
														</button>  
													</form>
												</div>
											@endif
											<br>
											</div>	
										@endif
									@endforeach			 
						 </div>				 
					</div>
				</div>
			<!-- projetos fim  -->											  
			@endif	
		@else
		@endif <!-- para o gerente e  o lider de escritório  início -->
</div>
    </div>
</div>


<script type="text/javascript">
						$(document).ready(function () {
							$(document).click(function(event) { 
								if(!$(event.target).closest('#Acompanhamento').length) {
									if($('#Acompanhamento').is(":visible")) {
										$('#Acompanhamento').hide();
									}
								}        
							});
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
							$('.btn-info').click(function (event) {
								event.preventDefault();
								var button = confirm("Quer enviar os dados?");	// return true or false	
								if(button == true)
								{
										$('textarea').change(function (event) {
											var idArea = event.target.id;
											var name = $(this).val();
											var TamanhoTexto = name.length;
											var area_id = $(this).attr('id');
											var tamanho = area_id.length;
											var inicioIDarea =  $(this).attr('id').indexOf('-') +1;
											var stringh = area_id.substring(inicioIDarea, tamanho);
											var idar = parseInt(stringh);
											//console.log('Texto.. '+name);
											//console.log('TamanhoTexto.. '+TamanhoTexto);
											//console.log("idArea id: " + area_id + " ");
											//console.log( "idar : "+ idar);
											function countChar(val) {
												var len = val.value.length;
												if (len >= 40) {
												  val.value = val.value.substring(0, 40);
												} else {
												  $('#'+area_id).text(40 - len);
												}
											  };
										});
										var form_id = $(this).closest('form').attr('id');	
										//console.log(form_id)	;											
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
								var iddoprojeto = parseInt(stringh);
								var indiceCHAVE = $(this).attr('id').indexOf('ch');
								var resURLstring = check_id.substring(0, indiceCHAVE) ;
								//console.log(  "  iddoprojeto : "+ iddoprojeto);
								var urlaction =  $('form[id="form-' + iddoprojeto +'"]').closest('form').attr('action');
								var form_id = $('form[id="form-' + iddoprojeto +'"]').closest('form').attr('id');											
								//console.log(  "  urlaction : "+ urlaction);
								 $('#content_acompanhamento-' + iddoprojeto).find(function (event) {
									//console.log($('#content_descricao').text());
									if($('#content_acompanhamento-' + iddoprojeto).text() != 'undefined'){
										$('#Acompanhamento-' + iddoprojeto).text($('#content_acompanhamento-' + iddoprojeto).text());
										//console.log($('#content_acompanhamento-' + iddoprojeto).text());
										$('#charNum' + iddoprojeto).text(1000 - $('#content_acompanhamento-' + iddoprojeto).text().length);
									}								
								});
								/**--------------------------------------------------------------
								    AO MARCAR UM CHECKBOX by Luiz Silva 09/08/2017 11:00:00
							   ---------------------------------------------------------------**/
								if ($(this).is(':checked')) {
									this.checked = confirm("Quer Acompanhar o Indicador?");	// return true or false								
									if(this.checked)
									{
										if($(this).is(':checked')){
											$('input[type="checkbox"]').prop("checked", false);
											$('.formAcomp').css("display", "none");
										}
										$(this).prop("checked", true);
										$(this).val($(this).is(':checked'));
										$('#div-'+iddoprojeto).css("display", "block");
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
														//console.log(' alter the url selecionado');
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
											if( typeof idUserform != "undefined" && typeof iddoprojeto != "undefined"){
												if( iddoprojeto == idUserform){	
												    //console.log(' ALTER URL AO MARCAR UM CHECKBOX');  
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
									this.checked = confirm("Quer Desacompanhar o Indicador?");  // return true or false								
									if(this.checked)
									{
										$(this).prop("checked", false);										
										$('#div-'+iddoprojeto).css("display", "none");					
										if($(this).is(':checked')){
											$('input[type="checkbox"]').prop("checked", false);
										}							
									}
									else if(!this.checked)
									{
										//console.log(' AO DESMARCAR UM CHECKBOX');		
										$(this).prop("checked", true);
										$(this).val($(this).is(':checked'));			
										if($(this).is(':checked')){											
											//console.log($(this).is(':checked'));
										}
										/**---------------------------------------------
														ALTERA O URL
										------------------------------------------------**/
										/***------------- by Luiz---------------------
											   Case don't have marked checkbox, Don't pass in test  result.length (empty)
										----------------------------------------**/
										if( (typeof  $(this).attr('id')) != "undefined" &&  $(this).attr('id').indexOf('-') !== -1  ) {
										}
										/***---------------------------by luiz ---------------------------
											   Case EXISTS one or more marked checkbox. Pass in test  result.length (don't empty)
										-------------------------------------------------------**/
										var selecionado = function (grupo) {
											var result = $('input:checked'); 
											if (result.length > 0 ) { 
												var contador = result.length + " selecionado(s)<br/>";
												result.each(function () { 
													if( (typeof  $(this).attr('id')) != "undefined" &&  $(this).attr('id').indexOf('-') !== -1  ) {
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
											if( typeof idUserform != "undefined" && typeof iddoprojeto != "undefined"){
												if( iddoprojeto == idUserform){	
												}									
											}									
										}; //FIM FUNÇÃO
										selecionado($(this));
									}//FIM IF DESCMARCAR
								}// FIM DESMARCAR
							});/* FIM input*/
						 }); /* end jquerry */
					</script>	
@endsection
