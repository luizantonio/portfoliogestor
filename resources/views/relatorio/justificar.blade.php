@extends('layouts.app')

@section('content')  
<head>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="   asset('css/bootstrap-theme.min.css')"> -->
        <!-- <script src="{{asset('js/jquery.min.js')}}"></script> -->

    <link rel="shortcut icon" type="image/png" href="http://portifoliogestor.com/public/images/portfolio-logo4.png" sizes="16x16">
    <!-- 15/09/2016 menu toggle fluid and colappse -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet"> -->
    <!-- 15/09/2016 menu toggle fluid and colappse -->
    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <!-- Luiz -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
    <script>
        // $(document).on('click','#app-navbar-collapse',function(e) {
  //           if( $(e.target).is('a') && $(e.target).attr('class') != 'navbar-toggle' ) {
  //               $(this).collapse('hide');
  //           }
  //       });
    </script>
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
    
	<!--
	utilizado para colocar um editor de texto javascript
	<script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
	 -->
	

@if(Session::has('message_error_justificar'))
	<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message_error_justificar') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
@endif
@if(Session::has('message_succes_justificar'))
	<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message_succes_justificar') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
@endif

	<div class="col-sm-offset-1 col-sm-10">
		<div class="panel panel-default">
		@if ( is_null($projeto) )	
			<center><div style="background-color: white;"><b><p class="danger"><b>@php utf8_encode('Projeto não foi encontrado!'); @endphp </b></p></div></center>	
		@endif
		@if (!is_null($projeto) > 0)
			<div class="panel panel-default">
				<div class="panel panel-heading">

					<div class="form-group">
						<div class="col-sm-offset-0 col-sm-0">						    
							<a href ="{{ route('relatorio.show') }}"> <button type="button" class="btn btn-success">
								<i class="fa fa-angle-left">Voltar</i> 
							</button></a> 
							<center><b><span id="mensagemCancelar"></span></b><span id="mensagemVoltar"></span></b></center>
							<center><b><h3>Alterar Status do Projeto</h3></b></center>
						</div>
				    </div>
							
				</div>
				<center><b style="color:blue;">{{ $projeto->nome }}</b></center>
								
                <div class="panel-body">
					@if(!is_null($projeto))						
						 @php
							$contadorIndicador = 0;
						@endphp
						@for($contadorIndicador; $contadorIndicador < 9; $contadorIndicador++)
							@php if($contadorIndicador%2==0){ echo '<output style="background-color:lightgray;">';}else{echo '<output style="background-color:lien;">';} @endphp		
							@php if($contadorIndicador == 0){ echo '<strong>'; echo utf8_encode('Data&nbsp;de&nbspInício:'); echo'</strong>&nbsp;'; echo $projeto->data_de_inicio;  } @endphp
							@php if($contadorIndicador == 1){ echo '<strong>'; echo utf8_encode('Gerente&nbsp;Responsávvel:'); echo'</strong>&nbsp;'; echo $projeto->getUserGerenteName($projeto->id);   } @endphp
							@php if($contadorIndicador == 2){ echo '<strong>'; echo utf8_encode('Previsão&nbsp;de&nbspTérmino:'); echo'</strong>&nbsp;'; echo $projeto->previsao_de_termino;  } @endphp
							@php if($contadorIndicador == 3){ echo '<strong>'; echo utf8_encode('Data&nbsp;Real&nbsp;de&nbspTérmino:'); echo'</strong>&nbsp;'; echo $projeto->data_real_de_termino;  } @endphp
							@php if($contadorIndicador == 4){ echo '<strong>'; echo utf8_encode('Orçamento&nbsp;Total R$'); echo'</strong>&nbsp;';echo $projeto->orcamento_total.',00'; } @endphp							
							@php if($contadorIndicador == 5){ 
								 echo '<strong>'; echo utf8_encode('Atual Status do Projeto:'); echo'</strong>&nbsp;';
								if($projeto->status_id == 1)
								    echo '<b style="color:orange;">'. utf8_encode('ANÁLISE APROVADA').'</b>';
								elseif($projeto->status_id == 2)
									echo '<b style="color:orange;">'.utf8_encode('ANÁLISE REALIZADA').'</b>';
								elseif($projeto->status_id == 3)
									echo '<b style="color:orange;">'. 'CANCELADO'.'</b>';
								elseif($projeto->status_id == 4)
									echo '<b style="color:orange;">'. utf8_encode('EM ANÁLISE').'</b>';
								elseif($projeto->status_id == 5)
									echo '<b style="color:orange;">'. 'EM ANDAMENTO'.'</b>';
								elseif($projeto->status_id == 6)
									echo '<b style="color:orange;">'. 'ENCERRADO'.'</b>';
								elseif($projeto->status_id == 7)
									echo '<b style="color:orange;">'. 'INICIADO'.'</b>';
								elseif($projeto->status_id == 8) 
									echo '<b style="color:orange;">'. 'PLANEJADO'.'</b>';
							} @endphp
							@php if($contadorIndicador == 6){ 
								 echo '<strong>'; echo utf8_encode('Classificação (Risco):'); echo'</strong>&nbsp;';
								if($projeto->classificacao_id == 1)
									echo 'ALTO RISCO';
								elseif($projeto->classificacao_id == 2)
									echo 'BAIXO RISCO';
								elseif($projeto->classificacao_id == 3)
									echo utf8_encode('MÉDIO RISCO');										
							  } @endphp
							@php if($contadorIndicador == 7){ echo '<strong>'; echo utf8_encode('Descrição:'); echo'</strong>&nbsp;';echo $projeto->descricao;  } @endphp
							@php if($contadorIndicador == 8){ echo '<strong>'; echo utf8_encode('Atual Fase do Projeto:'); echo'</strong>&nbsp;'; if(!is_null($projeto->faseDoProjetoFaseNome($projeto->id, $projeto->idUltimaFaseDoProjeto($projeto->id) )) ){ echo $projeto->faseDoProjetoFaseNome($projeto->id, $projeto->idUltimaFaseDoProjeto($projeto->id) ); }else{ echo '<b style="color:red;">SEM FASE DEFINIDA!</b>'; }  } @endphp
							@php echo '</output> '; @endphp	
											
						@endfor
					
					@endif
				</div>
				<div class="panel-body">
					<div class="form-group">			
						@if(!is_null($projeto->id))	
							@if( !is_null($projeto->temJustificativa( $projeto->id) ))								
								@if( !is_null($projeto->getJustificativaAprovada( $projeto->id) ))	
									@if( !is_null($projeto->getUserJustificativa( $projeto->id) ))	
										<output style="background-color:lien;"><strong>@php  echo utf8_encode('Data da Atualização: ');@endphp </strong>@php $strtotimes = strtotime( $projeto->getDateJustificativa( $projeto->id) );echo  date( 'd/m/Y',$strtotimes); @endphp</output>
										<output style="background-color:lightgray;"><strong>@php  echo utf8_encode('Usuário: ');@endphp</strong> {{   $projeto->getUserJustificativa( $projeto->id) }}</output>
									@endif						
									<output><strong>@php echo utf8_encode('Justificativa para Status Análise Aprovada '); @endphp</strong></output>							
									<output style="background-color:#F0F8FF;"><span id="content_aprovada">@php echo $projeto->getJustificativaAprovada( $projeto->id); @endphp</span></output> 
								@endif
								@if( !is_null($projeto->getJustificativaCancelado( $projeto->id) ))	
									@if( !is_null($projeto->getUserJustificativa( $projeto->id) ))	
										<output style="background-color:lien;"><strong>@php  echo utf8_encode('Data da Atualização: ');@endphp </strong>@php $strtotimes = strtotime( $projeto->getDateJustificativa( $projeto->id) );echo  date( 'd/m/Y',$strtotimes); @endphp</output><br>
										<output style="background-color:lightgray;"><strong>@php  echo utf8_encode('Usuário: ');@endphp </strong>{{   $projeto->getUserJustificativa( $projeto->id) }}</output>
									@endif							
									<strong style="color:blue">@php echo utf8_encode('Justificativa para Status'); @endphp</strong> @php echo utf8_encode(' Cancelado'); @endphp</strong>  
									<output style="background-color:#F0F8FF;"><span  id="content_cancelada">@php echo   $projeto->getJustificativaCancelado( $projeto->id); @endphp</span></output> 
								@endif
							@endif
							@if( !is_null($projeto->notHaveJustificativa( $projeto->id) ) && is_null($projeto->getJustificativaCancelado( $projeto->id)) && 
									is_null($projeto->getJustificativaAprovada( $projeto->id)) )								
									@if( !is_null($projeto->getUserJustificativa( $projeto->id) ))	
										<output style="background-color:lien;"><strong>@php  echo utf8_encode('Data da Atualização: ');@endphp </strong>@php $strtotimes = strtotime( $projeto->getDateJustificativa( $projeto->id) );echo  date( 'd/m/Y',$strtotimes); @endphp</output>
										<output style="background-color:lightgray;"><strong>@php  echo utf8_encode('Usuário: ');@endphp</strong> {{   $projeto->getUserJustificativa( $projeto->id) }}</output>
									@endif															
							@endif
					@endif
				<div>
				  <div class="form-group">			
					@if(!is_null($projeto->id))		
						<form id="form-{{$projeto->id}}" action=" {{ route('status.storejustificar',$projeto->id  ) }} " method="post">
							{!! csrf_field() !!}
							{{ method_field('PUT') }}
													
							<!-- Status -->							
							<div class="form-group navbar-form">
									<label for="statusId" class="control-label">Status: </label>
									<select class="form-control" name="statusId" id="statusId">
										<option title="@php echo utf8_encode('Preenchimento Obrigatório da justificativa'); @endphp" style="color: whitesmoke !important; background: #bf5279 !important;}" value="1" @if($projeto->status_id === 1) selected>@php echo utf8_encode('ANÁLISE APROVADA'); @endphp</option>  @else >@php echo utf8_encode('ANÁLISE APROVADA'); @endphp</option> @endif
										<option value="2" @if($projeto->status_id === 2) selected>@php echo utf8_encode('ANÁLISE&nbsp;REALIZADA'); @endphp</option> @else >@php echo utf8_encode('ANÁLISE REALIZADA'); @endphp</option> @endif
										<option title="@php echo utf8_encode('Preenchimento Obrigatório da justificativa'); @endphp" style="color: whitesmoke !important; background: #bf5279 !important;}" value="3" @if($projeto->status_id === 3) selected>@php echo utf8_encode('CANCELADO'); @endphp</option>         @else >@php echo utf8_encode('CANCELADO'); @endphp</option> @endif
										<option value="4" @if($projeto->status_id === 4) selected>@php echo utf8_encode('EM ANÁLISE'); @endphp</option>        @else >@php echo utf8_encode('EM ANÁLISE'); @endphp</option> @endif
										<option value="5" @if($projeto->status_id === 5) selected>@php echo utf8_encode('EM ANDAMENTO'); @endphp</option>      @else >@php echo utf8_encode('EM ANDAMENTO'); @endphp</option> @endif
										<option value="6" @if($projeto->status_id === 6) selected>@php echo utf8_encode('ENCERRADO'); @endphp</option>         @else >@php echo utf8_encode('ENCERRADO'); @endphp</option> @endif
										<option value="7" @if($projeto->status_id === 7) selected>@php echo utf8_encode('INICIADO'); @endphp</option>	        @else >@php echo utf8_encode('INICIADO'); @endphp</option> @endif
										<option value="8" @if($projeto->status_id === 8) selected>@php echo utf8_encode('PLANEJADO'); @endphp</option>         @else >@php echo utf8_encode('PLANEJADO'); @endphp</option> @endif									             							
									</select>
							</div>

							<output><b style="color:red;"><span id="restricaoMensagen">&nbsp;</span></b></output> 
							<!-- Add Task JUSTIFY -->
							<div class="form-group navbar-form">								
								<div id="div_jus_aprovada" style='display:none' class="formAcomp">									
									@if (!is_null(Auth::user()->acompanhamentoByValorId(Auth::user()->id , $projeto->id) ) )
										<output style="background-color:#F0F8AF;">{{ Auth::user()->acompanhamentoByValorId(Auth::user()->id , $projeto->id) }}</output>   
									@endif		
									<output> @php echo utf8_encode('Você tem: ');@endphp<b style="color:red;"><span id="charNumAprov">255</span></b> characters sobrando</output> 
									<label for="justificativaAprovada" class="control-label">@php echo utf8_encode('Justificativa/Aprovada'); @endphp											
									<textarea rows="6" cols="50"  min="15" maxlength="255" value="" placeholder="@php echo utf8_encode('Inserir Texto da justificativa');@endphp" name="aprovada" 
											id="justificativaAprovada" class="acompanhar Aprovada requerido form-control"																
											onKeyPress="return countChar(this); function countChar(val) { var len = val.value.length; if (len >= 255) {val.value = val.value.substring(0, 255);} else { $('#charNumAprov').text(255 - len);}}; " ></textarea>
								</div>
							</div>
							<!-- Add Task JUSTIFY -->
							<div class="form-group navbar-form">								
								<div id="div_jus_cancelada" style='display:none' class="formAcomp">		  									
									@if (!is_null(Auth::user()->acompanhamentoByValorId(Auth::user()->id , $projeto->id)))
										<output style="background-color:#F0F8AF;">{{ Auth::user()->acompanhamentoByValorId(Auth::user()->id , $projeto->id) }}</output>   
									@endif		
									<output> @php echo utf8_encode('Você tem:');@endphp<b style="color:red;"><span id="charNumCancelado">255</span></b> characters sobrando</output> 
									<label for="JustificativaCancelado" class="control-label">@php echo utf8_encode('Justificativa/Cancelado'); @endphp											
									<textarea rows="6" cols="50"  min="6" maxlength="255" value="" placeholder="@php echo utf8_encode('Inserir Texto da justificativa');@endphp" name="cancelada" 
											id="JustificativaCancelado" class="acompanhar requerido form-control"																
											onKeyPress="return countChar(this); function countChar(val) { var len = val.value.length; if (len >= 255) {val.value = val.value.substring(0, 255);} else { $('#charNumCancelado').text(255 - len);}}; " ></textarea>

									
								</div>
							</div>

							<!-- Add Task Button -->
							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-6">									
									<input type="hidden" name="user"          id="user"          value="{{Auth::user()->id}}" class="form-control">
									<input type="hidden" name="projeto"       id="projeto"       value="{{$projeto->id}}"     class="form-control">
									<input type="hidden" name="projeto_id" id="projeto_id" value="{{$projeto->id}}" class="form-control">
									<button type="submite" class="btn btn-primary">
										<span class="glyphicon glyphicon-pencil">Alterar Status Projeto</span> 
									</button>
								</div>
							</div>
						</form>											  
														  
					@endif
				 </div>

				

				</div>
			</div> 

			<script type="text/javascript">
						$(document).ready(function () {		
					/*	
							tinymce.init({
								selector: 'textarea',
								height: 245,
								theme: 'modern',
								plugins: [
								'advlist autolink lists link image charmap print preview hr anchor pagebreak',
								'searchreplace wordcount visualblocks visualchars code fullscreen',
								'insertdatetime media nonbreaking save table contextmenu directionality',
								'emoticons template paste textcolor colorpicker textpattern imagetools'
								],
								toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
								toolbar2: 'print preview media | forecolor backcolor emoticons',
								image_advtab: true,
								language : "pt_BR",
						   forced_root_block : false,
						   force_br_newlines : true,
						   force_p_newlines : false
							});

							*/
/*
	tinymce.init({
        selector: 'textarea',
        body_class: 'sp-mce-editor',
        content_css : "path/to/styles/mce.css",
        plugins: ['advlist autolink lists link image charmap print preview hr anchor pagebreak searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking table contextmenu directionality emoticons template paste textcolor fullscreen autoresize'],
        toolbar: "bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | fontsizeselect forecolor backcolor | preview fullscreen | template",
        toolbar_items_size: 'small',
        relative_urls : false,
        convert_urls : true,
        external_plugins: { "nanospell": "path/to/mce4/nanospell/plugin.js" },
        nanospell_server:"php",
        file_browser_callback: RoxyFileBrowser,
        init_instance_callback: (typeof processEditor != 'undefined' ? processEditor : null)
   });
   */
							
							$('#content_aprovada').find(function (event) {
								//console.log($('#content_aprovada').text());
								if($('#content_cancelada').val() != 'undefined'){
									$('#justificativaAprovada').text($('#content_aprovada').text());
									$('#charNumAprov').text(255 - $('#content_aprovada').text().length);
								}
																
							});
							$('#content_cancelada').find(function (event) {
								//console.log($('#content_cancelada').text());
								if($('#content_cancelada').val() != 'undefined'){
									$('#JustificativaCancelado').text($('#content_cancelada').text());
									$('#charNumCancelado').text(255 - $('#content_cancelada').text().length);
								}
									
							});
							$('#btn-cancelar').click(function (event) {
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
									console.log(form_id);																							
									$('#'+form_id).submit();	
								}
							});
							
							/**--------------------------------------------------------------
								  ALTER select VALUE by Luiz Silva 09/08/2017 11:00:00
							--------------------------------------------------------------***/							
							$('input[type="select"]').find(function () {
								 var optionSelected = $(this).find("option:selected");
								 var valueSelected  = optionSelected.val();
								 var textSelected   = optionSelected.text();
									 
								 if(  parseInt(valueSelected) == 1 ) {	
									//console.log(  valueSelected+ ' - ' + textSelected );						
								    $('#div_jus_aprovada').css("display", "block");
									$('#div_jus_cancelada').css("display", "none");
									$('#restricaoMensagen').text("@php echo utf8_encode('Preenchimento Obrigatório da justificativa!'); @endphp");		 
								 }else if( parseInt(valueSelected) == 3) {	
									//console.log(  valueSelected+ ' - ' + textSelected );
								    $('#div_jus_cancelada').css("display", "block");	
									$('#div_jus_aprovada').css("display", "none");
								    $('#restricaoMensagen').text("@php echo utf8_encode('Preenchimento Obrigatório da justificativa!'); @endphp");	
																 
								 }else{
									 //console.log(  valueSelected+ ' - ' + textSelected );
									$('.formAcomp').css("display", "none");
									$('#restricaoMensagen').text('');
								 }
							});
							$('select').change(function () {
								 var optionSelected = $(this).find("option:selected");
								 var valueSelected  = optionSelected.val();
								 var textSelected   = optionSelected.text();														
								 if(  parseInt(valueSelected) == 1 ) {	
									// console.log(  valueSelected+ ' - ' + textSelected );
									$('#div_jus_cancelada').css("display", "none");
									$('#div_jus_aprovada').css("display", "block");
								    $('#restricaoMensagen').text("@php echo utf8_encode('Preenchimento Obrigatório da justificativa!'); @endphp");							 
								 }else if( parseInt( valueSelected) == 3) {	
									// console.log(  valueSelected+ ' - ' + textSelected );
									$('#div_jus_aprovada').css("display", "none");
									$('#div_jus_cancelada').css("display", "block");
									$('#restricaoMensagen').text("@php echo utf8_encode('Preenchimento Obrigatório da justificativa!'); @endphp");									 
								 }else{
									// console.log(  valueSelected+ ' - ' + textSelected );
									$('.formAcomp').css("display", "none");
									$('#restricaoMensagen').text('');
								 }
							});
							

						 }); /* end jquerry */
					</script>			
			@endif
		</div>
	</div>
</div>
	@endsection