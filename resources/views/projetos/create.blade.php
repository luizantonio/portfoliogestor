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

@if(Session::has('message_error_projeto_create'))
	<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message_error_projeto_create') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
@endif
@if(Session::has('message_succes_projeto_create'))
	<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message_succes_projeto_create') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
@endif	
	<div class="col-sm-offset-2 col-sm-8">
		<div class="panel panel-default">
			<div class="panel-heading">			
				<div class="form-group">
					<div class="col-sm-offset-0 col-sm-0">						    
						<a href ="{{ route('projetos.index') }}"> <button type="button" class="btn btn-success">
							<i class="fa fa-chevron-left"> Voltar</i> 
						</button></a> <center><b><h3>Cadastrar Novo Projeto</h3></b></center>
					</div>
				</div>
			</div>
		@if(!is_null($collectionGerentes) && count($collectionGerentes) > 0 )

            <div class="panel-body">
                <!-- Display Validation Errors -->
                @include('common.erros')

                <!-- New Projeto Form -->
                <form id="form-cadastro" action="{{ url('projeto') }}" method="GET">
                    {!! csrf_field() !!}
                    
                    <!-- Projeto -->
                    <div class="form-group">
                        <output>Voc&ecirc; tem: <b style="color:red;"><span id="charNumNomeProjeto">255</span></b> characters sobrando</output> 
                        <label for="nomeProjeto" class="control-label">Nome do Projeto: </label>
                        <input type="text" name="nomeProjeto" id="nomeProjeto" class="requerido form-control"
                            min="6" maxlength="255" value="" placeholder="Inserir o nome do projeto"    onKeyPress="return countChar(this); function countChar(val) { var len = val.value.length;
                            if (len >= 255) {val.value = val.value.substring(0, 255);} else { $('#charNumNomeProjeto').text(255 - len);}}; " required autofocus>                  
                    </div>                          
                    <div class="form-group navbar-form">
                        
                        <label for="gerenteResponsavel" class="control-label">Nome do Gerrente Respons&aacute;vel: </label>
                        
                        @if(!is_null($collectionGerentes) && count($collectionGerentes) > 0 )
                            <select class="form-control m-b" name="gerenteResponsavel" id="fasedoProjeto" >
                                <option value="" disabled="" selected=""> SELECIONE O GERENTE </option>
                                    @foreach($collectionGerentes as $gerente)
                                        <option value="{{  $gerente->id }}" >{{ $gerente->name }}</option>                                      
                                    @endforeach               
                            </select>
                        @else
                            
                        @endif
                    </div>
                    <div class="form-group navbar-form">                        
                        <label for="dataInicioDia" class="control-label">Data In&iacute;cio:</label>

<!--
                         <input id="dataInicio" type="text" onKeyPress="return mask(this);  function mask(val) { var  value = val.value.split('/');  
                         var maximos = [31, 12, 2100];var novoValor = value.map( function (parcela, i) { if (parseInt(parcela, 10) > maximos[i]){
                         //console.log(maximos[i]); 
                         return maximos[i];}
                         // console.log(parcela);
                          return parcela; 
                          if (novoValor.toString() != value.toString()){ val.value = novoValor.join('/'); return novoValor;}  } ) }">
                           this.value=(this.value + 0 )"
-->

                        <select class="form-control m-b" name="dataInicioDia" id="dataInicioDia" >
                                <option value="" disabled="" selected="">Dia</option>
                                @php                
                                    config(['app.timezone' => 'pt_BR']);  
                                    $day = date('d');                           
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
                                    $month = date('m');                             
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
                              value="" min="2000" max="2999" required 
                               onkeyup="this.value=this.value.replace(/[^0-9]/g,'');if(parseInt(this.value)>2999){this.value=this.value.replace(this.value,'')}"
                               onclick="this.value=this.value.replace(/[^0-9]/g,'');if(parseInt(this.value)>2999){this.value=this.value.replace(this.value,'')}"
                               onKeyPress="this.value=this.value.replace(/[^0-9]/g,'');  if(parseInt(this.value)>2999){this.value=this.value.replace(this.value,'')}">
                
                    </div>
                    <div class="form-group navbar-form">                        
                            <label for="previsaoDeTerminoDia" class="control-label">@php echo utf8_encode('Data de Término'); @endphp </label>                                          
                            <select class="form-control m-b" name="previsaoDeTerminoDia" id="previsaoDeTerminoDia" >
                                <option value="" disabled="" selected="">Dia</option>
                                @php                
                                    config(['app.timezone' => 'pt_BR']);  
                                    $day = date('d');                           
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
                                    $month = date('m');                             
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
                              value="" min="2000" max="2999" required onkeyup="this.value=this.value.replace(/[^0-9]/g,'');if(parseInt(this.value)>2999){this.value=this.value.replace(this.value,'')}"
                               onclick="this.value=this.value.replace(/[^0-9]/g,'');if(parseInt(this.value)>2999){this.value=this.value.replace(this.value,'')}"
                               onKeyPress="this.value=this.value.replace(/[^0-9]/g,''); if(parseInt(this.value)>2999){this.value=this.value.replace(this.value,'')}">                                
                            
                    </div>
                    
                    <div class="form-group navbar-form">
                        <label for="dataRealDeTerminoDia" class="control-label">Data Real de Término</label>                     
                            <select class="form-control m-b" name="dataRealDeTerminoDia" id="dataRealDeTerminoDia" >
                                <option value="" disabled="" selected="">Dia</option>
                                @php                
                                    config(['app.timezone' => 'pt_BR']);  
                                    $day = date('d');                           
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
                                    $month = date('m');                             
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
                              value="" min="2000" max="2999" required 
                               onkeyup="this.value=this.value.replace(/[^0-9]/g,'');if(parseInt(this.value)>2999){this.value=this.value.replace(this.value,'')}"
                               onclick="this.value=this.value.replace(/[^0-9]/g,'');if(parseInt(this.value)>2999){this.value=this.value.replace(this.value,'')}"
                               onKeyPress="this.value=this.value.replace(/[^0-9]/g,''); 
                               if(parseInt(this.value)>2999){this.value=this.value.replace(this.value,'')}">
                                                                            

                    </div>

                    <div class="form-group navbar-form">
                    
                        <label for="orcamentoTotal" class="control-label">Or&ccedil;amento Total $</label>
                        <input type="number" name="orcamentoTotal" id="orcamentoTotal" class="form-control" placeholder="@php echo utf8_encode('Limite ').PHP_INT_MAX ;@endphp"
                             min="1" max="{{PHP_INT_MAX }}" required 
                            onkeyup="this.value=this.value.replace(/[^0-9]/g,'');if(parseInt(this.value)>{{PHP_INT_MAX }}){this.value=this.value.replace(this.value,'')}"
                            onclick="this.value=this.value.replace(/[^0-9]/g,'');if(parseInt(this.value)>{{PHP_INT_MAX }}){this.value=this.value.replace(this.value,'')}"
                            onKeyPress="this.value=this.value.replace(/[^0-9]/g,'');  if(parseInt(this.value)>{{PHP_INT_MAX }}){this.value=this.value.replace(this.value,'')}">
                    </div>

                    <div class="form-group">
                        <label for="descricao" class="control-label">Descri&ccedil;&atilde;o</label>                       
                        <output> Voc&ecirc; tem: <b style="color:red;"><span id="charNumDescricao">255</span></b> characters sobrando</output> 
                        <textarea name="descricao" rows="6" cols="50"  min="15" maxlength="255" value="" placeholder="@php echo utf8_encode('Inserir Texto da justificativa');@endphp" 
                                id="descricao" class="acompanhar Aprovada requerido form-control"                                                               
                                onKeyPress="return countChar(this); function countChar(val) { var len = val.value.length;
                                 if (len >= 255) {val.value = val.value.substring(0, 255);} else { $('#charNumDescricao').text(255 - len);}}; " ></textarea>
                    </div>

                    <div class="form-group navbar-form">
                            <label for="statusId" class="control-label">Status: </label>
                            <select class="form-control" name="statusId" id="statusId">
                                    <option value="1">@php echo utf8_encode('ANÁLISE APROVADA'); @endphp</option>
                                    <option value="2">@php echo utf8_encode('ANÁLISE REALIZADA'); @endphp</option>
                                    <option value="3">CANCELADO</option>
                                    <option value="4">@php echo utf8_encode('EM ANÁLISE'); @endphp</option>
                                    <option value="5">EM ANDAMENTO</option>
                                    <option value="6">ENCERRADO</option>    
                                    <option value="7">INICIADO</option> 
                                    <option value="8">PLANEJADO</option>                            
                            </select>
                    </div>

                    <div class="form-group navbar-form">
                            <output><b style="color:red;"><span id="restricaoMensagen">&nbsp;</span></b></output> 
                            <label for="classificacaoId" class="control-label">Classifica&ccedil;&atilde;o (Risco): </label>
                            <select class="form-control" name="classificacaoId" id="classificacaoId" class="classificacaoId">
                                    <option title="Ser&aacute; exigido o acompanhamento Semanal!" style="color: whitesmoke !important; background: #bf5279 !important;}" value="1">ALTO RISCO</option>
                                    <option value="2">BAIXO RISCO</option>
                                    <option value="3">M&Eacute;DIO RISCO</option>                            
                            </select>
                    </div>
                    <!-- Add Task Button -->
                    
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-plus">Adicionar Projeto</i> 
                            </button>
                        </div>
                    </div>

                </form>
            </div>
    @else
            <div class="alert-danger">
                <span class="glyphicon glyphicon-alert"> 
                    <b> N&atilde;o existem gerentes cadastrados no sistema&#33;</b></span>
            </div>
            <br>
           
            <div class="alert-info">
                <span class="glyphicon glyphicon-question-sign">
                    <b> O cadstro s&oacute; ser&aacute; permitido se existir algum gerente de projetos cadastrado no sistema&#33;</b></span>
            </div>             
    @endif
        </div>
    </div>

</div>
    <script type="text/javascript">
                        $(document).ready(function () {
                            /*
                             
                            var mask = function (){
                            
                                $("#datainicio").mask("99/99/9999", {
                                completed: function () {
                                    //console.log('complete')
                                    var value = $(this).val().split('/');
                                    var maximos = [31, 12, 2100];
                                    var novoValor = value.map(function (parcela, i) {
                                        if (parseInt(parcela, 10) > maximos[i]) return maximos[i];
                                        return parcela;
                                    });
                                    if (novoValor.toString() != value.toString()) $(this).val(novoValor.join('/')).focus();
                                }
                               });  
                            
                            };
                            */
                            $('#content_descricao').find(function (event) {
                                //console.log($('#content_descricao').text());
                                if($('#content_descricao').val() != 'undefined'){
                                    $('#descricao').text($('#content_descricao').text());
                                    $('#charNumDescricao').text(255 - $('#content_descricao').text().length);
                                }                               
                            });             
                            $('#classificacaoId').find(function () {
                                 var optionSelected = $('#classificacaoId').find("option:selected");
                                 var valueSelected  = optionSelected.val();
                                 var textSelected   = optionSelected.text();
                                 //console.log(valueSelected + '-' + textSelected );    
                                 if(  parseInt(valueSelected) == 1 ) {                                                          
                                    $('#restricaoMensagen').text("Registrar o Acompanhamento Semanal do Projeto com Alto Risco!");                                               
                                 }else{                                 
                                    $('#restricaoMensagen').text(' ');
                                 }
                            });
                            $('#classificacaoId').change(function () {
                                 var optionSelected = $('#classificacaoId').find("option:selected");
                                 var valueSelected  = optionSelected.val();
                                 var textSelected   = optionSelected.text();
                                 //console.log(valueSelected + '-' + textSelected );                                                            
                                 if(  parseInt(valueSelected) == 1 ) {                                                      
                                    $('#restricaoMensagen').text("Registrar o Acompanhamento Semanal do Projeto com Alto Risco!");                                                   
                                 }else{                             
                                    $('#restricaoMensagen').text(' ');
                                 }
                            });
                            /**--------------------------------------------------------------
                                    SUMBMIT THE FORM  by Luiz Silva 08/08/2017 17:00:00
                            --------------------------------------------------------------***/
                            $('.btn-primary').click(function (event) {
                                
                                event.preventDefault();
                                var button = confirm("Quer Cadastro dos Dados?");   // return true or false                             
                                if(button == true)
                                {
                                        var form_id = $(this).closest('form').attr('id');   
                                        //alert('form_id : ' + form_id);                                                                                                
                                        $('#'+form_id).submit();
                                }
                            });;/* FIM click*/                          

                         }); /* end jquerry */
                    </script>
@endsection