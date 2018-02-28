@extends('layouts.app')
@section('content')
<head>
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> -->
	<!--<link rel="stylesheet" href="{{asset('css/bootstrap-theme.min.css')}}"> -->
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
            /*.dropdown-submenu {
                position: relative;
            }
            .dropdown-submenu>.dropdown-menu {
                top: 0;
                left: 100%;
                margin-top: -6px;
                margin-left: -1px;
                -webkit-border-radius: 0 6px 6px 6px;
                -moz-border-radius: 0 6px 6px 6px;
                border-radius: 0 6px 6px 6px;
            }
            .dropdown-submenu:hover>.dropdown-menu { 
                background-color: lightgreen;
                display: block;
            }
            .dropdown-submenu>a:after {
                display: block;
                content: " ";
                i: right;
                width: 0;
                height: 0;
                border-color: transparent;
                border-style: solid;
                border-width: 5px 0 5px 5px;
                border-left-color: #cccccc;
                margin-top: 5px;
                margin-right: -10px;
            }
            .dropdown-submenu:hover>a:after {
                border-left-color: #ffffff;
            }
            .dropdown-submenu.pull-left {
                float: none;
            }
            .dropdown-submenu.pull-left>.dropdown-menu {
                left: -100%;
                margin-left: 10px;
                -webkit-border-radius: 6px 0 6px 6px;
                -moz-border-radius: 6px 0 6px 6px;
                border-radius: 6px 0 6px 6px;
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
        .congratz {
            margin: 0 auto;
            text-align: center;
        }
        .message::before {
            content: " ";
           background: url();
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
    }
</style>
</head>
<div class="container">
	<center><h3><b>{{ utf8_encode('Lista de Usuários Cadastrados')}}</b></h3></center>
	@if(Session::has('message_error_usuario_show'))
		<p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('message_error_usuario_show') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
	@endif
	@if(Session::has('message_succes_usuario_show'))
		<p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message_succes_usuario_show') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
	@endif
	<div class="col-sm-offset-1 col-sm-10">
		<div class="panel panel-default">
                    <div id="ativabusca">
						<form class="navbar-form "action="{{ route('admin.ordenarPor') }}" method="POST">
							{!! csrf_field() !!}
							Ordenar:
							<select class="form-control m-b" name="ordenarUsuarioPor" onchange="this.form.submit()" title="@php echo utf8_encode('Ordenar por...');@endphp">
							   <option value="" disabled="" selected="">Ordenar por...</option>
							   <option value="NOMEDOUSUARIO">Nome</option>
							   <option value="EMAILDOUSUARIO">Email</option>
							   <option value="PERFILDOUSUARIO">Perfil</option>  
							 </select>
						</form>
                        <form class="navbar-form " id="buscarusuario" role="form" action="{{ route('admin.buscar') }}" method="POST">
							{!! csrf_field() !!}
                            <div class="form-group">
                                Filtrar:
								<input type="text" value="" placeholder="Nome do Projeto" name="nomeUsuarioBusca" id="nomeUsuarioBusca" class="form-control">
                            </div>          
                            <button type="submit" title="Buscar" class="btn btn-sm btn-default" id="button_search"  onclick="this.form.submit()"><span class="glyphicon glyphicon-search active">&nbsp;Buscar</span></button>
                        </form>
                    </div>
		@if (count($users) <= 0)	
			<center><div style="background-color: white;"><h3><b><p class="danger"><b>@php utf8_encode('Projeto não foi encontrado!'); @endphp </b><h3></div></center>	
		@endif
		@if (count($users) > 0)
			<div class="panel panel-default">
				<div class="panel-heading">
					{{ utf8_encode('Usuários Cadastrados: ')}} {{count($users)}}
				</div>
				<div class="panel-body">
					<table class="table table-striped table-hover table-condensed">
					
						<!--  Table Headings -->
						<thead>
							<th>@php echo utf8_encode('Usuário'); @endphp</th>
							<th>&nbsp;E-mail</th>							
							<th>&nbsp;Perfil (Tipo)</th>
							<th>&nbsp;</th>
							<th>&nbsp;</th>
						</thead>
						<!--  Table Body -->
						<tbody>
							@php
								$contadorColor = 0;
							@endphp
							@foreach ($users as $user)		
								@php
									if($contadorColor %2==0 ){
										echo '<tr style="background-color: lightgray">';	
									}else{
										echo '<tr>';
									}
									$contadorColor = $contadorColor +1;
								@endphp
									<!-- Atributos -->
									<td class="table-text">
										<div>{{ $user->name }}</div>
									</td>
									<td class="table-text">
										<div>{{ $user->email }}</div>
									</td>										
									<td>						
										<div>
											@if($user->isNotRole($user->id)  )
												@php echo utf8_encode('<b style=color:red;">NÃO DEFINIDO</b>'); @endphp
											@elseif($user->isAdmin($user->id) )
												ADMINISTRADOR
											@elseif($user->isGerenteProjetos($user->id) )
												GERENTE DE PROJETOS
											@elseif($user->isLiderEscritProjetos($user->id) )
												@php echo utf8_encode('LÌDER DO ESCRITÓRIO DE PROJETOS'); @endphp
											@elseif($user->isLiderProjetos($user->id) )
												@php echo utf8_encode('LÌDER DE PROJETOS'); @endphp	
											@elseif($user->isMembroAltaDir($user->id) )
												@php echo utf8_encode('MEMBRO DA ALTA DIREÇÃO'); @endphp
											@elseif($user->isNotRole($user->id) )
												@php echo utf8_encode('<b style=color:red;">NÃO DEFINIDO</b>'); @endphp
											@endif
										</div>
									</td>
									<td>
										<form id="form_UP-{{ $user->id }}" action="{{ url('admin/update/'.$user->id)}}" method="POST" enctype="multipart/form-data">
											{!! csrf_field() !!}
											{{ method_field('PUT') }}
											<button type="button" id="update-usuario-{{ $user->id }}" class="btn btn-primary" title="@php echo utf8_encode('Atualizar dados do usuário');@endphp">
												<i class="fa fa-pencil-square-o" aria-hidden="true"> Atualizar</i>
											</button>					
										</form>
									</td>
									<td>
										<form id="form_DEL-{{ $user->id }}" action="{{ url('admin/'.$user->id)}}" method="POST">
											{!! csrf_field() !!}
											{!! method_field('DELETE') !!}
											<button type="button" id="delete-usuario-{{ $user->id }}" class="btn btn-danger" title="@php echo utf8_encode('Deletar usuário');@endphp">
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
							
							/**--------------------------------------------------------------
								    SUMBMIT THE FORM  by Luiz Silva 08/08/2017 17:00:00
							--------------------------------------------------------------***/
							$('.btn-primary').click(function (event) {
								
								event.preventDefault();
								var button = confirm("Quer atualizar os dados?");	// return true or false								
								if(button == true)
								{
										var form_UP = $(this).closest('form').attr('id');	
										//alert('form_UP : ' + form_UP);
										//alert('form_UP : ' + $(this).closest('form').attr('action') );																									
										$('#'+form_UP).submit();
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
										
										var form_DEL = $(this).closest('form').attr('id');
										//alert('form_DEL : ' + form_DEL);	
										//alert('form_DEL : ' + $(this).closest('form').attr('action') );																									
										$('#'+form_DEL).submit();
								}
							});;/* FIM click*/
							

						 }); /* end jquerry */
					</script>
			@endif

		</div>
	</div>
 </div>	

      @endsection