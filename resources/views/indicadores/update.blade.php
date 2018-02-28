@extends('layouts.app')

@section('content')  
<head>
    <!-- 
    <link rel="stylesheet" href="   asset('css/bootstrap-theme.min.css')"> -->
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

@if(Session::has('message_error_indicador_update'))
        <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('message_error_indicador_update') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
@endif

	<div class="col-sm-offset-2 col-sm-8">
		<div class="panel panel-default">

            <div class="panel-heading">         
                <div class="form-group">
                    <div class="col-sm-offset-0 col-sm-0">                          
                        <a href ="{{ url('indicadores/show') }}"> <button type="button" class="btn btn-success">
                            <i class="fa fa-chevron-left"> Voltar</i> 
                        </button></a> <center><b><h3>Atualizar Indicador</h3></b></center>
                    </div>
                </div>
            </div>

            <!-- Display Validation Errors -->
            @include('common.erros')
			@if ( count($indicadores) > 0)		
				@php 
					$indicador	 = null; 
					foreach($indicadores as $indicado){
						if($indicado != null){
							$indicador = $indicado;
						}						
					}				
				@endphp
			<div class="panel-body">	
				<center><b><span id="mensagemVancelar"></span></b>&nbsp;&nbsp;<span id="mensagemVoltar"></span></b></center>		
				<!-- New Form -->	
				 
				 <form  id="atualizar" action=" {{ url('indicador/atualizar/'.$indicador->id)}}" method="post" clsss="float:left">
                        {!! csrf_field() !!} 
                        {{ method_field('PUT') }}
													
					<!-- Projeto -->
					<div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-1 control-label navbar-form">Nome do Indicador:</label>

                            <div class="col-md-5">
                                <input type="hidden" name="indicador_id" value="{{$indicador->id}}">
                                <input id="name" type="text" class="form-control" min="6" maxlength="250" name="name" value="{{ $indicador->nome }}" required autofocus onkeyup="this.value=this.value.replace(/[^a-zA-Záãâäàéêëèíîïìóõôöòúûüùçñ \W]/g,'');" onclick="this.value=this.value.replace(/[^a-zA-Z áãâäàéêëèíîïìóõôöòúûüùçñ \W]/g,'');">                              
                            </div>
							<br>
                    </div>
		
                  <!-- Add Task Button -->
					
					<div class="form-group navbar-form">
						<div class="col-sm-offset-3 col-sm-6">
						    <input type="hidden" name="indicador_id" id="indicador_id" value="{{$indicador->id}}" class="form-control">
							<button type="submite" class="btn btn-primary">
								<i class="fa fa-plus"> Cadastrar</i> 
							</button>

							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							
							<button type="button" id="btn-cancelar" class="btn btn-warning">
								<i class="fa fa-minus"> <b>Cancelar</b></i> 
							</button>
						</div>
					</div>
				</form>

			</div>
					<script type="text/javascript">
						$(document).ready(function () {
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
  
