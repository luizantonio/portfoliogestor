@extends('layouts.app')
@section('content')

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

	<link href="//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,700" rel="stylesheet" type="text/css">
	<link href="//fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900" rel="stylesheet" type="text/css">
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>

	

	<div id="container" style="min-width: 310px height: 600px; margin:0 auto">
	
	@if(Session::has('message_error_informar'))
	<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message_error_informar') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
	@endif
	@if(Session::has('message_success_informar'))
		<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message_success_informar') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
	@endif
	
	
	</div>

	


	@if (count($fases) > 0)
		@php //echo  @endphp	
		@foreach ($fases as $fase)	
			@php //echo $fase->role_name @endphp			
		@endforeach
		@php //echo  @endphp	
	@endif

	
	<div class="col-sm-offset-1 col-sm-10">
			
                  

		@if ( is_null($projetos) )	
			<center><div style="background-color: white;"><b><p class="danger"><b>@php utf8_encode('Projeto não foi encontrado!'); @endphp </b></p></div></center>	
		@endif
		@if (!is_null($projetos))
			<div class="panel panel-default">
				<div class="panel panel-heading">
					<div class="col-sm-offset-0 col-sm-0">						    
							<a href ="{{ url('relatorio/projetos') }}"> <button title="@php echo utf8_encode('Voltar para a tela Anterior');@endphp" type="button" id="btnvoltar" class="btn btn-success">
								<i class="fa fa-angle-left"> Voltar</i> 
							</button></a>
						</div>
					<center><b> @php echo utf8_encode('Relatório Geral dos Indicadores dos Projeto'); @endphp </b></center>			
					<center><b>@php echo date('d/m/Y'); @endphp<center><b>
				</div>
				<div class="panel-body">
		@foreach($projetos as $projeto)
				<strong class="alert-info">Nome do Projeto: {{ $projeto->nome }}</strong>
				<div class="">
					
					@php echo '<strong>'; echo utf8_encode('Atual Fase do Projeto:'); echo'</strong>&nbsp;'; if(!is_null($projeto->faseDoProjetoFaseNome($projeto->id, $projeto->idUltimaFaseDoProjeto($projeto->id) )) ){ 
					echo $projeto->faseDoProjetoFaseNome($projeto->id, $projeto->idUltimaFaseDoProjeto($projeto->id) ); }else{ echo '<b style="color:red;">SEM FASE DEFINIDA!</b>'; }  @endphp
				  </div>
				
				  <div class="form-group">			
					@if(!is_null($projeto->isQualIndicador( $projeto->id)) )
							<!-- Indicador  -->
							<div class="form-group navbar-form">
								
								<output><b>@php echo utf8_encode('Valores dos Indicadores do Projeto:'); @endphp</b></output>								
								@php
									$contadorIndicador = 0;
									$contadorValor = 0;
									$indicadores = $projeto->indicadoresDoProjeto( $projeto->id); 
																	
								@endphp
								@foreach($indicadores as $indic)
									@if($projeto->isQualIndicador( $projeto->id))								
										@php
											$valoresInformados = $indic->valoresInformados($indic->id, $projeto->id);												
										@endphp
										 @if(!is_null($valoresInformados))
											@foreach($valoresInformados as $valoresInf)		
											   @if( $indic->id == $valoresInf->fase_projeto_id )								
													@php if($contadorValor%2==0){ echo '<output style="background-color:#F0F8FF">';}else{echo '<output style="background-color:lien;">';} @endphp		
														<strong>Fase: </strong>{{ $indic->nomeFase($indic->fase_id) }}<br>
														@if(  ((int) $valoresInf->valor_maximo) <=  ((int) $indic->valor_maximo) && ((int) $valoresInf->valor_maximo) >=  ((int) $indic->valor_minimo))
															<div class="alert alert-success"><strong>Indicador: </strong>{{ $indic->nome }} </div>
														@else
															<div class="alert alert-danger"><strong>Indicador: </strong>{{ $indic->nome }} </div>
														@endif
														
														@if(  ((int) $valoresInf->valor_maximo) >  ((int) $indic->valor_maximo) )
															<p class="alert alert-danger"><span>
															@php echo utf8_encode('Fora do limite esperado. Ultapassou o limite máximo esperado de: ');@endphp{{$indic->valor_maximo }}
															@php echo utf8_encode(' com excesso: ');@endphp{{   ((int) $valoresInf->valor_maximo) - ((int) $indic->valor_maximo)  }}
															</span><a href="#" class="close" data-dismiss="alert" aria-label="close" title="Fechar">&times;</a></p>
														@elseif(  ((int) $valoresInf->valor_maximo) < ((int) $indic->valor_minimo) )
															<p  class="alert alert-danger"><span>
															@php echo utf8_encode('Fora do limite esperado. Ficou abaixo do valor mínimo esperado de: ');@endphp{{$indic->valor_minimo }}
															@php echo utf8_encode(' com deficit: ');@endphp{{ ((int) $indic->valor_minimo) - ((int) $valoresInf->valor_maximo)  }} @php echo utf8_encode(' para alcançar o valor mínimo esperado! ');@endphp
															</span><a href="#" class="close" data-dismiss="alert" aria-label="close" title="Fechar">&times;</a></p>
														@endif														
														<br>
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

																	
								@endforeach
							</div>							  
					@endif
				 </div>

		@endforeach

				</div>
			</div> 
			<style>

			<script type="text/javascript">
						$(document).ready(function () {

								@foreach($indicadores as $indic)
									@if($projeto->isQualIndicador( $projeto->id))								
										@php
											$valoresInformados = $indic->valoresInformados($indic->id, $projeto->id);
																						
										@endphp
										 @if(!is_null($valoresInformados))
											@foreach($valoresInformados as $valoresInf)		
											   @if( $indic->id == $valoresInf->fase_projeto_id )																							
														@php 
														
														echo 'console.log(';
														echo $indic->nome;
														echo ')';
														@endphp
											   @endif	
											@endforeach
										 @endif	
									  @endif
								@endforeach

/*

var chart = Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Indicadores Esperados versus Indicadores Informados'
    },
    subtitle: {
        text: 'Projeto: xxxxxxxxxxxxxxxxxxxxxxxxxx'
    },
    xAxis: {
        categories: 
		
		 [
		 'Jan', 'Feb', 'Mar',  'Apr', 'May', 'Jun', 'Jul',  'Aug', 'Sep', 'Oct','Nov','Dec','Jan', 'Feb', 'Mar',  'Apr', 'May', 'Jun', 'Jul',  'Aug', 'Sep', 'Oct','Nov','Dec'
        ]
		,
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Rainfall (mm)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Valor @php echo utf8_encode('Máximo'); @endphp Esperado',
        data:
		
		[49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

    }, {
        name: 'Valor @php echo utf8_encode('Míximo'); @endphp  Esperado',
        data: 
		[83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

    }, {
        name: 'Valor @php echo utf8_encode('Máximo'); @endphp Informado',
        data:
		 [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]

    }, {
        name: 'Valor @php echo utf8_encode('Míximo'); @endphp  Informado',
        data: 
		[42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

    }]
});

*/







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
											console.log('Texto.. '+name);
											console.log('TamanhoTexto.. '+TamanhoTexto);
											console.log("idArea id: " + area_id + " ");
											console.log( "idar : "+ idar);

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
										console.log(form_id)	;																							
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

							    console.log("checkbox id: " + check_id + " ");

								var tamanho = check_id.length;
								var inicioIDuser =  $(this).attr('id').indexOf('-') +1;
								var stringh = check_id.substring(inicioIDuser, tamanho);
								var iduser = parseInt(stringh);
								var indiceCHAVE = $(this).attr('id').indexOf('ch');
								var resURLstring = check_id.substring(0, indiceCHAVE) ;
								
								console.log(  "  iduser : "+ iduser);
								
								var urlaction =  $('form[id="form-' + iduser +'"]').closest('form').attr('action');
								var form_id = $('form[id="form-' + iduser +'"]').closest('form').attr('id');	
																					
								console.log(  "  urlaction : "+ urlaction);


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

										console.log(' AO MARCAR UM CHECKBOX');
										

										/**-------------------------------------------
											   ALTER THE URL
									    -------------------------------------------**/
										var selecionado = function (grupo) { 																	
											var result = $('input:checked'); 
											if (result.length > 0 ) { 
												var contador = result.length + " selecionado(s)<br/>"; 
										
										
												result.each(function () { 
													if( (typeof  $(this).attr('id')) != "undefined" &&  $(this).attr('id').indexOf('-') !== -1  ) {
														console.log(' alter the url selecionado');														
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
												    console.log(' ALTER URL AO MARCAR UM CHECKBOX');

												    
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
										console.log(' AO DESMARCAR UM CHECKBOX');										
										$(this).prop("checked", true);
										$(this).val($(this).is(':checked'));											
										if($(this).is(':checked')){											
											console.log($(this).is(':checked'));
										}
										/**----------------------------------------------------------------------------
														ALTERA O URL
										----------------------------------------------------------------------------**/
										/***----------------------- by Luiz-----------------------------------------------------------
											   Case don't have marked checkbox, Don't pass in test  result.length (empty)
										-------------------------------------------------------------------------------------------**/
										if( (typeof  $(this).attr('id')) != "undefined" &&  $(this).attr('id').indexOf('-') !== -1  ) {												
											
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
	
	@endsection