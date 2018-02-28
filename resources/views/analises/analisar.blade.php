@extends('layouts.app')
@section('content')

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
    }
</style>
	
<div class="container">
@if(Session::has('message_error_informar'))
	<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message_error_informar') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
@endif
@if(Session::has('message_success_informar'))
	<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message_success_informar') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
@endif
<div class="col-sm-offset-1 col-sm-10">
	<div class="panel panel-default">	


        <div class="panel-heading">         
                <div class="form-group">
                    <div class="col-sm-offset-0 col-sm-0">                          
                         <a href ="{{ url('analises/analisar') }}"> <button type="button" title="Projetos para Analizar Indicador" class="btn btn-success" id="btnvoltar" >
                            <i class="fa fa-chevron-left"> Voltar</i> 
                        </button></a> <center><b><h3>Analisar Valores do Indicador</h3></b></center>
                    </div>
                </div>
            </div>


		<center><b><span id="mensagemCancelar"></span></b><b><span id="mensagemVoltar"></span></b></center>
		@if ( is_null($projeto) )	
		<center><div style="background-color: white;"><b><p class="danger"><b>@php utf8_encode('Projeto não foi encontrado!'); @endphp </b></p></div></center>	
		@endif
		@if (!is_null($projeto) > 0)
	    <div class="panel panel-default">
			
			<div class="panel-body">
				<div class="">
					@php echo '<strong>'; echo utf8_encode('Atual Fase do Projeto:'); echo'</strong>&nbsp;'; if(!is_null($projeto->faseDoProjetoFaseNome($projeto->id, $projeto->idUltimaFaseDoProjeto($projeto->id) )) ){ 
					echo $projeto->faseDoProjetoFaseNome($projeto->id, $projeto->idUltimaFaseDoProjeto($projeto->id) ); }else{ echo '<b style="color:red;">SEM FASE DEFINIDA!</b>'; }  @endphp
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
				  </div>
				  <div class="form-group">			
					@if($projeto->isQualIndicador( $projeto->id))
							<!-- Indicador  -->
							<div class="form-group navbar-form">						
								@php
                                    $contadorLABEL=0;
									$contadorIndicador = 0;
									$contadorValor = 0;
									$indicadores = $projeto->indicadoresDoProjeto( $projeto->id);
								@endphp
								@foreach($indicadores as $indic)
									@if($projeto->isQualIndicador( $projeto->id))
										@php
											$valoresInformados = $indic->valoresInformados($indic->id, $projeto->id);
                                            if( !is_null($valoresInformados) && count($valoresInformados) > 0 && $contadorLABEL <=1 ){
                                                $contadorLABEL= $contadorLABEL + 1;
                                                echo '<output><b>';
                                                 echo utf8_encode('Fase - Indicador:'); 
                                                echo '</b></output>'; 
                                            }else{
                                                echo '<br/>';
                                                echo '<div class="alert-warning"><center>';
                                                echo '<span class="glyphicon glyphicon-alert"><b>'; 
                                                echo utf8_encode('Não existem indicadores com valores informados para serem analisados!' ); 
                                                echo '</b></span></center></div>'; 


                                            }
                                            
										@endphp
										 @if(!is_null($valoresInformados))
											@foreach($valoresInformados as $valoresInf)		
											   @if( $indic->id == $valoresInf->fase_projeto_id )
													@php if($contadorValor%2==0){ echo '<output style="background-color:#F0F8FF">';}else{echo '<output style="background-color:lien;">';} @endphp		
														<strong>{{ $indic->nomeFase($indic->fase_id) }}</strong> - {{ $indic->nome }} <br>
														<strong style="color:blue;">VALOR ESPERADO:</strong>  @php echo utf8_encode('Mínimo');@endphp:<strong style="color:black;">{{ $indic->valor_minimo }}</strong>
														 /@php echo utf8_encode('Máximo');@endphp :<strong style="color:black;">{{ $indic->valor_maximo }}</strong> <br>
														<strong style='color:orange;'>VALOR INFORMADO: </strong><strong style="color:black;">{{ $valoresInf->valor_maximo }}</strong> 
													@php echo '</output>';  @endphp 
											   @endif	
											@endforeach
										 @else
											@php if($contadorIndicador%2==0){ echo '<output style="background-color:#F0F8FF;">';}else{echo '<output style="background-color:lien;">';} @endphp		
												<strong>{{ $indic->nomeFase($indic->fase_id) }}</strong> - {{ $indic->nome }} - @php echo utf8_encode('Valor Mínimo');@endphp:{{ $indic->valor_minimo }} 
												/@php echo utf8_encode('Valor Máximo');@endphp :{{ $indic->valor_maximo }} 
											@php echo '</output> '; $contadorIndicador = $contadorIndicador + 1; @endphp
										 @endif			
										@php							
											$contadorValor = $contadorValor + 1;
										@endphp
									  @endif
									  		@foreach($valoresInformados as $valoresInf)
													@if( $indic->id == $valoresInf->fase_projeto_id )
														@if (!is_null(Auth::user()->acompanhamentoByValorId(Auth::user()->id , $valoresInf->id)))
															<label for="ch-{{$valoresInf->fase_projeto_id}}" class="control-label"> <b style="background-color:#ADFF2F;">[Possui]</b> Acompanhar?</label>  
														@else
															<label for="ch-{{$valoresInf->fase_projeto_id}}" class="control-label">Acompanhar?</label>
														@endif
													<input type="checkbox"  name="ch-{{$valoresInf->fase_projeto_id}}" class="custom-control custom-checkbox" id="ch-{{$valoresInf->fase_projeto_id}}"/></td>
													 <div id="div-{{$valoresInf->fase_projeto_id}}" style='display:none' class="formAcomp">
														<form id='form-{{$valoresInf->fase_projeto_id}}' action='{{ url("/analises/acompanhamento/".$valoresInf->fase_projeto_id )}}' method='post'>
															  {!! csrf_field() !!} 
															  {{ method_field('PUT') }}
															  <input type="hidden" name="faseProjeto"   id="faseProjeto"   value="{{$indic->id}}" class="form-control">
															  <input type="hidden" name="fase" id="fase" value="{{$indic->fase_id}}"  class="form-control">
															  <input type="hidden" name="valor" id="valor" value="{{$valoresInf->id }}" class="form-control">
															  <input type="hidden" name="faseDoProjeto" id="faseDoProjeto" value="{{$valoresInf->fase_projeto_id }}" class="form-control">
															  <input type="hidden" name="user" id="user" value="{{Auth::user()->id}}" class="form-control">
															  <input type="hidden" name="projeto"id="projeto" value="{{$projeto->id}}"     class="form-control">
															  @if (!is_null(Auth::user()->acompanhamentoByValorId(Auth::user()->id , $valoresInf->id)))
																<output style="background-color:#F0F8AF;"><span id="content_acompanhamento-{{$valoresInf->fase_projeto_id}}">{{ Auth::user()->acompanhamentoByValorId(Auth::user()->id , $valoresInf->id) }}</span></output>   
															  @endif		
															  <output> @php echo utf8_encode('Você tem: ');@endphp<b style="color:red;"><span id="charNum-{{$valoresInf->fase_projeto_id }}">255</span></b> characters sobrando</output> 
															  <label for="Acompanhamento" class="control-label">@php echo utf8_encode('Acompanhamento'); @endphp
															  <textarea rows="4" cols="50"  min="6" maxlength="255" value="{{ Auth::user()->acompanhamentoByValorId(Auth::user()->id , $valoresInf->id)   }}" placeholder="@php echo utf8_encode('Inserir Texto do Acompanhamento do Indicador');@endphp" name="Acompanhamento" 
																id="Acompanhamento-{{$valoresInf->fase_projeto_id }}" class="acompanhar form-control"		
																onKeyPress="return countChar(this); function countChar(val) { var len = val.value.length;if (len >= 255) {val.value = val.value.substring(0, 255);} else { $('#charNum-'+{{$valoresInf->fase_projeto_id }}).text(255 - len);}}; " ></textarea>
															  <button  title="@php echo utf8_encode('Acompanhamento do Indicador do Projeto');@endphp" type="button" class="btn btn-primary" id="'btn-{{$valoresInf->fase_projeto_id}}'">
																		<span class="glyphicon glyphicon-plus">&nbsp;@php echo utf8_encode('Acompanhamento'); @endphp</span> 
															  </button>
														</form>
													</div>
													@endif
											@endforeach
								@endforeach
							</div>							  
					@endif
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
				( "#mensagemVoltar" ).text('@php echo utf8_encode("Clique no botão [Volta] para retornar a tela anterior!"); @endphp');
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
		var iduser = parseInt(stringh);
		var indiceCHAVE = $(this).attr('id').indexOf('ch');
		var resURLstring = check_id.substring(0, indiceCHAVE) ;			
		//console.log(  "  iduser : "+ iduser);		
		var urlaction =  $('form[id="form-' + iduser +'"]').closest('form').attr('action');
		var form_id = $('form[id="form-' + iduser +'"]').closest('form').attr('id');	
																					
								//console.log(  "  urlaction : "+ urlaction);

								 $('#content_acompanhamento-' + iduser).find(function (event) {
									//console.log($('#content_descricao').text());
									if($('#content_acompanhamento-' + iduser).text() != 'undefined'){
										$('#Acompanhamento-' + iduser).text($('#content_acompanhamento-' + iduser).text());
										//console.log($('#content_acompanhamento-' + iduser).text());
										$('#charNum' + iduser).text(255 - $('#content_acompanhamento-' + iduser).text().length);
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
										$('#div-'+iduser).css("display", "block");

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
											if( typeof idUserform != "undefined" && typeof iduser != "undefined"){
												if( iduser == idUserform){	
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
										$('#div-'+iduser).css("display", "none");											
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
										
										/***------ by Luiz--------------
											   Case don't have marked checkbox, Don't pass in test  result.length (empty)
										------------------------------**/
										if( (typeof  $(this).attr('id')) != "undefined" &&  $(this).attr('id').indexOf('-') !== -1  ) {												
											
										}
										/***-------by luiz--------------------------------
											   Case EXISTS one or more marked checkbox. Pass in test  result.length (don't empty)
										----------------------------------**/

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
											if( typeof idUserform != "undefined" && typeof iduser != "undefined"){
												if( iduser == idUserform){	
													
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