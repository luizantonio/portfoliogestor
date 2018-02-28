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


@if(Session::has('message_error_projeto_show'))
	<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message_error_projeto_show') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
@endif
@if(Session::has('message_succes_projeto_show'))
	<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message_succes_projeto_show') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
@endif

	<div class=" col-sm-12">
		<div class="panel panel-default">
            <div class="panel-heading"><center><b><h3>Projetos Cadastrados</h3></b></center></div>
			@if(!is_null($projetos) && count($projetos) > 0)
			 <div id="ativabusca" class="navbar-form">
				<form action="{{ route('projetos.ordenarPor') }}" method="POST">
					{!! csrf_field() !!}
					<div class="form-group">
						Ordenar Projetos:
					</div> 
					<select class="form-control m-b" name="nomeProjetoBusca" onchange="this.form.submit()">
						<option value="" disabled="" selected="">Ordenar por...</option>
						<option value="NOMEDOPROJETO">Nome do Projeto</option>
						<option value="NOMEDOGERENTE">Gerente Respons&aacute;vel</option>
						<option value="STATUSDAFASE">Status do Projeto</option>
						<option value="TIPODERISCO">Classifica&ccedil;&acirc;o (Risco) </option>							  
					</select>
				</form>
                <form class="navbar-form " id="buscarprojeto" role="form" action="{{ route('projetos.buscar') }}" method="POST">
						{!! csrf_field() !!}
						<div class="form-group">
                            Filtrar Projetos:
							<input type="text" value="" placeholder="Nome do Projeto" name="nomeProjetoBusca" id="nomeProjetoBusca" class="form-control">                                
                        </div>          
                        <button type="submit" class="btn btn-sm btn-default" id="button_search"  onclick="this.form.submit()"><span class="glyphicon glyphicon-search active">&nbsp;Buscar</span></button>
                </form>
            </div>
        @else
        	<br/>
            <div class="alert-warning">
                <center><span class="glyphicon glyphicon-alert"> 
                <b> N&atilde;o existem projetos cadastradas&#33;</b></span></center>
            </div>
        @endif
		@if(!is_null($projetos) && count($projetos) > 0)
			<div class="panel panel-default">
				<div class="panel-heading">
					Projetos Cadastrados: {{count($projetos)}}
				</div>
				<div class="panel-body">
					<table class="table table-striped table-hover">
						<!--  Table Headings -->
						<thead>
							<th style="background-color:lightgrey;">Nome&nbsp;do&nbsp;Projeto</th>
							<th style="background-color:lightgrey;">Data&nbsp;de&nbsp;In&iacute;cio</th>
							<th style="background-color:lightgrey;">Gerente&nbsp;Respons&aacute;vel</th>
							<th style="background-color:lightgrey;">Status&nbsp;do&nbsp;Projeto</th>
							<th style="background-color:lightgrey;">Classifica&ccedil;&acirc;o</th>					
							<th style="background-color:lightgrey;">&nbsp;</th>
							<th style="background-color:lightgrey;">&nbsp;</th>
							<th style="background-color:lightgrey;">&nbsp;</th>
						</thead>
						<!--  Table Body -->
						<tbody>
							@foreach ($projetos as $projeto)							
								<tr>								
									<!-- Atributos -->
									<td class="table-text">
										<div>{{ $projeto->nome }}</div>
									</td>
									<td class="table-text">
										<div>{{ date('d-m-Y', strtotime($projeto->data_de_inicio)) }}</div>
									</td>
									<td class="table-text">
										<div>{{  $projeto->getUserGerenteName($projeto->id) }}</div>
									</td>
									<td class="table-text">
										<div>
											@if($projeto->status_id == 1)
												@php echo utf8_encode('ANÁLISE&nbsp;APROVADA'); @endphp
											@elseif($projeto->status_id == 2)
												@php echo utf8_encode('ANÁLISE&nbsp;REALIZADA'); @endphp
											@elseif($projeto->status_id == 3)
												CANCELADO
											@elseif($projeto->status_id == 4)
												@php echo utf8_encode('EM ANÁLISE'); @endphp
											@elseif($projeto->status_id == 5)
												EM&nbsp;ANDAMENTO
											@elseif($projeto->status_id == 6)
												ENCERRADO
											@elseif($projeto->status_id == 7)
												INICIADO
											@elseif($projeto->status_id == 8) 
												PLANEJADO
											@endif
										</div>
									</td>
									<td>
										@if($projeto->classificacao_id == 1)
											ALTO RISCO
										@elseif($projeto->classificacao_id == 2)
											BAIXO RISCO
										@elseif($projeto->classificacao_id == 3)
											@php echo utf8_encode('MÉDIO RISCO'); @endphp
										@endif
									</td>
									<td>
								   <!-- Detalhes  -->
									<form id="form-{{$projeto->id}}"action="{{ url('projetos/detalhes/'.$projeto->id )}}" method="post">
										{!! csrf_field() !!} 
										{{ method_field('PUT') }}
										<input type="hidden" name="projeto_id" id="projeto_id" value="{{$projeto->id}}" class="form-control">
										<a href="{{ url('projetos/detalhes/'.$projeto->id)}}">
										<button  title="@php echo utf8_encode('Detalhes do Projeto');@endphp" type="submit" class="btn btn-info" id="'btn-{{$projeto->id}}'">
										<i class="fa fa-list"> Detalhes</i> 
										</button></a>
									</form>
								  </td>	
									<td>
										<form id="form_id-{{ $projeto->id }}"action="{{ url('update/'.$projeto->id)}}" method="POST" enctype="multipart/form-data">
											{!! csrf_field() !!}
											{{ method_field('GET') }}
											<button  title="@php echo utf8_encode('Atualizar dados do Projeto');@endphp"type="button" id="update-projeto-{{ $projeto->id }}" class="btn btn-primary">
												<i class="fa fa-pencil" aria-hidden="true"> Atualizar</i>
											</button>					
										</form>
									</td>
									<td>
										<form id="form_del-{{ $projeto->id }}" action="{{ url('/projeto/'.$projeto->id)}}" method="POST">
											{!! csrf_field() !!}
											{!! method_field('DELETE') !!}
											<button  title="@php echo utf8_encode('Excluir Projeto');@endphp"type="button" id="delete-projeto-{{ $projeto->id }}" class="btn btn-danger">
												<i class="fa fa-trash-o" aria-hidden="true"> Delete</i>
											</button>					
										</form>
									</td>								
							</tr>
							@endforeach 
						</tbody>
					</table>					
				</div>
			</div>
			<script type="text/javascript">
						$(document).ready(function () {
							

                            $('.btn-info').click(function (event) {
                                event.preventDefault();
                                var button = confirm("Quer visualizar os detalhes?");   // return true or false 
                                if(button == true)
                                {
                                        var form_id = $(this).closest('form').attr('id');   
                                        //alert('form_id- : ' + form_id);
                                        $('#'+form_id).submit();
                                }
                            });;/* FIM click*/

                            /**--------------------------------------------------------------
								    SUMBMIT THE FORM  by Luiz Silva 08/08/2017 17:00:00
							--------------------------------------------------------------***/
							$('.btn-primary').click(function (event) {
								event.preventDefault();
								var button = confirm("Quer atualizar os dados deste projeto?");	// return true or false	
								if(button == true)
								{
										var form_id = $(this).closest('form').attr('id');	
										//alert('form_id- : ' + form_id);
										$('#'+form_id).submit();
								}
							});;/* FIM click*/
							/**--------------------------------------------------------------
								    SUMBMIT THE FORM  by Luiz Silva 08/08/2017 17:00:00
							--------------------------------------------------------------***/
							$('.btn-danger').click(function (event) {
								event.preventDefault();
								var button = confirm("Quer APAGAR os dados?");	// return true or false	
								if(button == true)
								{
										var form_del = $(this).closest('form').attr('id');
										//alert('form_del- : ' + form_del);
										$('#'+form_del).submit();
								}
							});;/* FIM click*/
						 }); /* end jquerry */
					</script>
			@endif
		</div>
	</div>
</div>
@endsection