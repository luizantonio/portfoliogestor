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

	<div id="container" style="min-width: 310px height: 600px; margin:0 auto"></div>
	<div id="container2"style="min-width: 310px height: 400px"></div>
	<button id="button" class="autocompare">Get selected points</button>
						<script>
						
			</script>
						




<!--
	<div class="col-sm-offset-2 col-sm-8">
		<div class="panel panel-danger">
			<div class="panel-heading">
				<p> php var_dump(Auth::user()->name ) endphp </p>
			</div>
		</div>				
	</div>
-->
@if(Session::has('message_error_informar'))
	<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message_error_informar') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
@endif
@if(Session::has('message_success_informar'))
	<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message_success_informar') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
@endif

	@if (count($fases) > 0)
		@php //echo  @endphp	
		@foreach ($fases as $fase)	
			@php //echo $fase->role_name @endphp			
		@endforeach
		@php //echo  @endphp	
	@endif

	
	<div class="col-sm-offset-1 col-sm-10">
		<div class="panel panel-default">	
					<div class="form-group">
						<div class="col-sm-offset-0 col-sm-0">						    
							<a href ="{{ url('relatorio/projetos') }}"> <button title="@php echo utf8_encode('Voltar para a tela Anterior');@endphp" type="button" id="btnvoltar" class="btn btn-success">
								<i class="fa fa-plus">@php echo utf8_encode('Voltar'); @endphp </i> 
							</button></a>
						</div>
						<center><b><span id="mensagemCancelar"></span></b><span id="mensagemVoltar"></span></b></center>
					</div>		
                  

		@if ( is_null($projeto) )	
			<center><div style="background-color: white;"><b><p class="danger"><b>@php utf8_encode('Projeto não foi encontrado!'); @endphp </b></p></div></center>	
		@endif
		@if (!is_null($projeto) > 0)
			<div class="panel panel-default">
				<div class="panel panel-heading">
					@php echo '<center><b>Analisar Valores do Indicador</b></center>'; @endphp				
				</div>
				<div class="panel-body">
		
				<div class="">
					@php echo '<strong>'; echo utf8_encode('Atual Fase do Projeto:'); echo'</strong>&nbsp;'; if(!is_null($projeto->faseDoProjetoFaseNome($projeto->id, $projeto->idUltimaFaseDoProjeto($projeto->id) )) ){ 
					echo $projeto->faseDoProjetoFaseNome($projeto->id, $projeto->idUltimaFaseDoProjeto($projeto->id) ); }else{ echo '<b style="color:red;">SEM FASE DEFINIDA!</b>'; }  @endphp
					@if (count($fase) == 1)
						<output><b>@php echo utf8_encode('Possui Indicador Associado à Fase?'); @endphp</b></output>
					@elseif (count($fase) > 1)
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
								<output><b>@php echo utf8_encode('Fase - Indicador:'); @endphp</b></output>								
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
														<strong>{{ $indic->nomeFase($indic->fase_id) }}</strong> - {{ $indic->nome }} <br>
														<strong style="color:blue;">VALOR ESPERADO:</strong>  @php echo utf8_encode('Mínimo');@endphp:<strong style="color:black;">{{ $indic->valor_minimo }}</strong>
														 /@php echo utf8_encode('Máximo');@endphp :<strong style="color:black;">{{ $indic->valor_maximo }}</strong> <br>
														<strong style='color:orange;'>VALOR INFORMADO:</strong> @php echo utf8_encode('Mínimo');@endphp:<strong style='color:black;'>{{ $valoresInf->valor_minimo }}</strong>
														 /@php echo utf8_encode('Máximo');@endphp :<strong style="color:black;">{{ $valoresInf->valor_maximo }}</strong> 
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
															  
															  <input type="hidden" name="faseProjeto"   id="faseProjeto"   value="{{$indic->id}}"       class="form-control">
															  <input type="hidden" name="fase"          id="fase"          value="{{$indic->fase_id}}"  class="form-control">															 
															  <input type="hidden" name="valor"         id="valor"         value="{{$valoresInf->id }}" class="form-control">
															  <input type="hidden" name="faseDoProjeto" id="faseDoProjeto" value="{{$valoresInf->fase_projeto_id }}" class="form-control">
															  <input type="hidden" name="user"          id="user"          value="{{Auth::user()->id}}" class="form-control">
															  <input type="hidden" name="projeto"       id="projeto"       value="{{$projeto->id}}"     class="form-control">
															  @if (!is_null(Auth::user()->acompanhamentoByValorId(Auth::user()->id , $valoresInf->id)))
																<output style="background-color:#F0F8AF;">{{ Auth::user()->acompanhamentoByValorId(Auth::user()->id , $valoresInf->id) }}</output>   
															  @endif															  <output> @php echo utf8_encode('Você tem: ');@endphp<b style="color:red;"><span id="charNum-{{$valoresInf->fase_projeto_id }}">255</span></b> characters sobrando</output> 
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
			<style>



</style>
			<script type="text/javascript">
						$(document).ready(function () {
/*
						var chart = Highcharts.chart('container2', {
    chart: {
         // type: 'errorbar'
		//type: 'spline'
		type: 'column'
	   // type: 'bar'
		//type: 'pie'
	    //type: 'column'
		//  type: 'column'
		 // type: 'column'
		//  type: 'column'
		//  type: 'column'
    },
    xAxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    },
    plotOptions: {
        series: {
            allowPointSelect: true
        }
    },
    series: [{
        data: [29.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

    }]
});
*/

// the button action
$('#button').click(function () {
    var selectedPoints = chart.getSelectedPoints();

    if (chart.lbl) {
        chart.lbl.destroy();
    }
    chart.lbl = chart.renderer.label('You selected ' + selectedPoints.length + ' points', 100, 60)
        .attr({
            padding: 10,
            r: 5,
            fill: Highcharts.getOptions().colors[1],
            zIndex: 5
        })
        .css({
            color: 'white'
        })
        .add();
});

/*


	var chart = Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Efficiency Optimization by Branch'
    },
    xAxis: {
        categories: [
            'Seattle HQ',
            'San Francisco',
            'Tokyo'
        ]
    },
    yAxis: [{
        min: 0,
        title: {
            text: 'Employees'
        }
    }, {
        title: {
            text: 'Profit (millions)'
        },
        opposite: true
    }],
    legend: {
        shadow: false
    },
    tooltip: {
        shared: true
    },
    plotOptions: {
        column: {
            grouping: false,
            shadow: false,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Employees',
        color: 'rgba(165,170,217,1)',
        data: [150, 73, 20],
        pointPadding: 0.3,
        pointPlacement: -0.2
    }, {
        name: 'Employees Optimized',
        color: 'rgba(126,86,134,.9)',
        data: [140, 90, 40],
        pointPadding: 0.4,
        pointPlacement: -0.2
    }, {
        name: 'Profit',
        color: 'rgba(248,161,63,1)',
        data: [183.6, 178.8, 198.5],
        tooltip: {
            valuePrefix: '$',
            valueSuffix: ' M'
        },
        pointPadding: 0.3,
        pointPlacement: 0.2,
        yAxis: 1
    }, {
        name: 'Profit Optimized',
        color: 'rgba(186,60,61,.9)',
        data: [203.6, 198.8, 208.5],
        tooltip: {
            valuePrefix: '$',
            valueSuffix: ' M'
        },
        pointPadding: 0.4,
        pointPlacement: 0.2,
        yAxis: 1
    }]
});
*/


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
        categories: [
		 'Jan', 'Feb', 'Mar',  'Apr', 'May', 'Jun', 'Jul',  'Aug', 'Sep', 'Oct','Nov','Dec'
        ],
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
        name: 'Tokyo',
        data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

    }, {
        name: 'New York',
        data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

    }, {
        name: 'London',
        data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]

    }, {
        name: 'Berlin',
        data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

    }]
});




































						/********************************************************************************************************************************************/






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