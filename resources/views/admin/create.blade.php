@extends('layouts.app')
@section('content')
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
	<form action="{{route('admin.changeRole',null)}}" id="form-0" method="POST">
		{!! csrf_field() !!}
		<input type="hidden" name="user_id" id="user_id" value="3" class="form-control">
		<button type="submite" class="btn btn-primary" onclick="event.preventDefault();document.getElementById('form-0').submit();">
			<i class="fa fa-exchange"> @php echo utf8_encode('Teste Mudar Permissão'); @endphp</i> 
		</button>
	</form>
	<hr class="danger" style="color:red;"><br>
	@php echo utf8_encode('<center class="alert alert-default"><h3><b>Permmissão de Acesso a Telas</b></h3></center>'); @endphp 
	<div class="col-sm-offset-1 col-sm-10">
		<div class="panel panel-default">			
                    <div id="ativabusca">
						<form action=" admin.ordenarPor" method="POST">						
							{!! csrf_field() !!}
							<select class="form-control m-b" name="ordenarUsuarioPor" onchange="this.form.submit()">
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
                            <button type="submit" class="btn btn-sm btn-default" id="button_search"  onclick="this.form.submit()"><span class="glyphicon glyphicon-search active">&nbsp;Buscar</span></button>
                        </form>
                    </div>
		@if (count($users) <= 0 || $users == null)	
			<center><div style="background-color: white;"><h3><b><p class="danger"><b>@php utf8_encode('Usuário não foi encontrado!'); @endphp </b><h3></div></center>	
		@endif
		@if (count($users) > 0)
			<div class="panel panel-default">
				<div class="panel-heading">
					@php echo utf8_encode('Usuários Cadastrados:'); @endphp {{count($users)}}
				</div>
				<div class="panel-body">
				<center><b><span id="mensagemVancelar"></span></b>&nbsp;&nbsp;<span id="mensagemVoltar"></span></b></center>
			 <table class="table">
			    <thead>
					<tr>	
						<th></th>					
						<th>Id</th>
						<th>Nome</th>
						<th>Email</th>
						<th>ADM</th>
						<th>G.P.</th>						
						<th>L.E.P.</th>
						<th>L.P.</th>
						<th>M.A.D</th>
					</tr>	
				</thead>
				<tbody>
					@foreach($users as $user)
						<tr>
						<td> <!-- if remove this tag make problem with the token . Should exists one token to all line table -->
						<form action="{{ url('admin/change/')}}" id="form-{{$user->id}}" method="POST">
							  {!! csrf_field() !!}
							  {{ method_field('PUT') }}
							  <td>{{ $user->id }}<input type="hidden" name="id" value="{{ $user->id }}"></td>
							  <td>{{ $user->name }}<input type="hidden" name="name" value="{{ $user->name }}"></td>
							  <td>{{ $user->email }}<input type="hidden" name="email" value="{{ $user->email }}"></td>							  
							  <td><input type="checkbox" {{ $user->hasRole('Administrador') ? 'checked' :'' }} name="role_admin"/></td>
							  <td><input type="checkbox" {{ $user->hasRole('Gerente de Projetos') ? 'checked' :'' }} name="role_gerente_projetos"/></td>
							  <td><input type="checkbox" {{ $user->hasRole('Lider do Escritório de Projetos') ? 'checked' :'' }} name="role_lider_escritorio"/></td>
							  <td><input type="checkbox" {{ $user->hasRole('Líder de Projeto') ? 'checked' :'' }} name="role_gerente_projeto"/></td>
							  <td><input type="checkbox" {{ $user->hasRole('Membro da Alta Direção') ? 'checked' :'' }} name="role_membro_alta_direcao"/></td>
							  <td><input type="hidden" name="user_id" id="user_id" value="{{$user->id}}" class="form-control"></td>
							  <td>
								  <button type="submite" class="btn btn-primary" onclick="event.preventDefault();document.getElementById('form-{{$user->id}}').submit();">
									<i class="fa fa-exchange"> @php echo utf8_encode('Mudar Permissão'); @endphp</i> 
								  </button>
							  </td>
						</form>
						</td>
					  </tr>
					  @break
					@endforeach
				</tbody>
			  </table>
			   <!-- Add Task Button -->
					<div class="form-group">
						<div class="col-sm-offset-5 col-sm-6">
							<button type="button" id="btn-cancelar" class="btn btn-warning">
								<i class="fa fa-minus"> <b>Cancelar</b></i> 
							</button>
						</div>
					</div>
				</div>
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
								$('form#3').submit();
								event.preventDefault();
							});
						 });
					</script>
			@endif
		</div>
	</div>
	@endsection