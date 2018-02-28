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
	@if(Session::has('message_error_equipe'))
		<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message_error_equipe') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
	@endif
	@if(Session::has('message_success_equipe'))
		<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message_success_equipe') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
	@endif
	<div class="col-sm-offset-1 col-sm-10">
		<div class="panel panel-default">
			<div class="panel-heading">		
				<div class="form-group">
					<div class="col-sm-offset-0 col-sm-0">						    
						<a href ="{{ url('equipes/show') }}"> <button type="button" class="btn btn-success">
							<i class="fa fa-chevron-left"> Voltar</i> 
						</button></a>
					</div>
					<div class="col-sm-offset-0 col-sm-0"> 
						</button></a> <center><b><h3>Atualizar Membro de Equipe</h3></b></center>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<!-- Display Validation Errors -->
				@include('common.erros')
				
			</div>
			
			@if(!is_null($membro) && count($membro) > 0)		
				
			<div class="panel-body">	
				<center><b><span id="mensagemVancelar"></span></b>&nbsp;&nbsp;<span id="mensagemVoltar"></span></b></center>		
				<!-- New Projeto Form -->	
				 
				 <form action=" {{ route('equipe.atualizar') }} " id="atualizar" method="POST">
					{!! csrf_field() !!}
					{{ method_field('PUT') }}
													
					<!-- Projeto -->
					<div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-1 control-label navbar-form">Nome</label>

                            <div class="col-md-5">
								<input id="name" type="hidden" class="form-control" name="nomeOld" value="{{ $membro->nome }}">
                                <input id="name" type="text" class="form-control" min="6" maxlength="100" name="nome" value="{{ $membro->nome }}" required autofocus min="6" onkeyup="this.value=this.value.replace(/[^a-zA-Záãâäàéêëèíîïìóõôöòúûüùçñ \W]/g,'');" onclick="this.value=this.value.replace(/[^a-zA-Z áãâäàéêëèíîïìóõôöòúûüùçñ \W]/g,'');">                               
                            </div>
							<br>
                    </div>
		
                  <!-- Add Task Button -->
					
					<div class="form-group navbar-form">
						<div class="col-sm-offset-3 col-sm-6">
						    <input type="hidden" name="membro_id" id="membro_id" value="{{$membro->id}}" class="form-control">
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
                            $('.btn-primary').click(function (event) {                              
                                event.preventDefault();
                                var button = confirm("Quer Atualizar o Membro?");    // return true or false                             
                                if(button == true)
                                {
                                        var form_id = $(this).closest('form').attr('id');
                                        $('#'+form_id).submit();
                                }
                            });;/* FIM click*/
							
						 });
					</script>
			@else
		    	<br/>
		       <div class="alert-warning">
		           <center><span class="glyphicon glyphicon-alert"> 
		                <b> Membro n&atilde;o encontrado&#33;</b></span></center>
		       </div>
			@endif

		</div>
	</div>
</div>

      @endsection
  
