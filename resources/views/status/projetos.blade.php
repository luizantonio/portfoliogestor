@extends('layouts.app')

@section('content')  
<head>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
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

		<center><h3>Projetos para Alterar Status do Projeto</h3></center>
			
@if(Session::has('message_error_justificar'))
	<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message_error_justificar') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
@endif
@if(Session::has('message_succes_justificar'))
	<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message_succes_justificar') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
@endif			
			
				
	<div class="col-sm-offset-1 col-sm-10">
		<div class="panel panel-default">
			
			
			
                    <div id="ativabusca" class="navbar-form">
						
						<form action="{{ route('status.ordenarPorStatus') }}" method="POST">
							{!! csrf_field() !!}
							<div class="form-group">
								Ordenar Projetos:
							</div> 
							<select class="form-control m-b" name="ordenarPorStatus" onchange="this.form.submit()">
							   <option value="" disabled="" selected="">Ordenar por...</option>
							   <option value="NOMEDOPROJETO">Nome do Projeto</option>
							   <option value="NOMEDOGERENTE">Nome do Gerente Responsável</option>	
							   <option value="DATAINICIAL">Data de Início</option>
							   <option value="DATAFINAL">Data de Termino</option>	
							   <option value="STATUS">Status do Projeto</option>					  
							 </select>
						</form>
                        <form class="navbar-form " id="formbuscarJustificar" role="form" action="{{ route('status.buscarStatus') }}" method="POST">
							{!! csrf_field() !!}

                            <div class="form-group">
                                Filtrar Projetos:
								<input type="text" value="" placeholder="Nome do Projeto" name="buscarStatus" id="buscarStatus" class="form-control">                                
                            </div>          
                            <button type="submit" class="btn btn-sm btn-default" id="button_search"  onclick="this.form.submit()"><span class="glyphicon glyphicon-search active">&nbsp;Buscar</span></button>
                        </form>
                    </div>

		@if (count($projetos) <= 0)	
			<center><div style="background-color: white;"><h3><b><p class="danger"><b>Projeto não foi encontrado! </b><h3></div></center>	
		@endif
		
		@if (count($projetos) > 0)
			<div class="panel panel-default">
				<div class="panel-heading">
					Projetos Cadastrados: {{count($projetos)}}
				</div>				
				<div class="panel-body">
					<table class="table table-striped table-hover">
						<!--  Table Headings -->
						<thead>
							<th style="background-color:lightgrey;">@php echo utf8_encode('Nome&nbsp;do&nbsp;Projeto'); @endphp</th>
							<th style="background-color:lightgrey;">@php echo utf8_encode('Data&nbsp;de&nbsp;Início&nbsp;/&nbsp;Término'); @endphp</th>
							<th style="background-color:lightgrey;">@php echo utf8_encode('Gerente&nbsp;Responsável'); @endphp</th>							
							<th style="background-color:lightgrey;">@php echo utf8_encode('Status&nbsp;do&nbsp;Projeto'); @endphp</th>
							<th style="background-color:lightgrey;">&nbsp;</th>					
							<th style="background-color:lightgrey;">&nbsp;</th>

						</thead>
						<!--  Table Body -->
						<tbody>						  
							@foreach ($projetos as $projeto)	
								<!-- possui indicador? -->	
								@if($projeto->user_id == Auth::user()->id  || $projeto->gerente_responsavel == Auth::user()->id )
								<!-- if( ( $projeto->isQualIndicador( $projeto->id) && $projeto->gerente_responsavel == th::user()->id ) ||   th::user()->isLiderProjetos(h::user()->id) )	 ) -->		
								<tr>						
									<!-- Atributos -->
									<td class="table-text">
										<div>{{ $projeto->nome }}</div>
									</td>
									<td class="table-text">
										<div>@php echo date('d-m-Y',  strtotime($projeto->data_de_inicio)); @endphp &nbsp;<b style="color:red;">/</b>&nbsp;@php echo date('d-m-Y',  strtotime($projeto->previsao_de_termino)); @endphp</div>
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
								   <!-- Detalhes  -->
										 <form id="form-{{$projeto->id}}"action="{{ url('/status/status/'.$projeto->id )}}" method="post">
											  {!! csrf_field() !!} 
											  {{ method_field('PUT') }}
												 <input type="hidden" name="projeto_id" id="projeto_id" value="{{$projeto->id}}" class="form-control">
													<a href="{{ url('/status/status/'.$projeto->id)}}">
													  <button  title="@php echo utf8_encode('Alterar Staus do Projeto');@endphp" type="submit" class="btn btn-success" id="'btn-{{$projeto->id}}'">
														<i class="fa fa-exchange"> @php echo utf8_encode('Alterar Status do Projeto'); @endphp</i> 
													</button></a>
										</form>
								  </td>
							</tr>
							@endif
							@endforeach 
						</tbody>
					</table>					
				</div>
			</div>
			<script type="text/javascript">
						$(document).ready(function () {
							/** SUMBMIT THE FORM  by Luiz Silva 08/08/2017 17:00:00 ***/
							$('.btn-success').click(function (event) {
								event.preventDefault();
								var button = confirm("Quer alterar o status deste projeto?"); /** return true or false	*/				
								if(button == true)
								{
									var form_id = $(this).closest('form').attr('id');	
									/** alert('form_id- : ' + form_id); */
									$('#'+form_id).submit();
								}
							});;/* FIM click*/
							/** SUMBMIT THE FORM  by Luiz Silva 08/08/2017 17:00:00 **/
							$('.btn-danger').click(function (event) {
								event.preventDefault();
								var button = confirm("Quer APAGAR os dados?");	// return true or false								
								if(button == true)
								{
									var form_id = $(this).closest('form').attr('id');
									/** alert('form_id- : ' + form_id); */				
									$('#'+form_id).submit();
								}
							});;/* FIM click*/
						 }); /* end jquerry */
					</script>
			@endif
		</div>
	</div>
</div>	
 @endsection
  
