<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!--<html lang=" app()->getLocale() "> -->
<html lang="pt-BR" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="sisttema de Gerenciamento de Portifólio de Projetos (Portifólio Gestor) - é um sistema de cadastro de projetos onde usuários podem realizar atividades inerentes ao seu perfil.">
    <meta name="author" content="Luiz Antôniô Silva">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

	<!-- 15/09/2016 menu toggle fluid and colappse -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <!-- 15/09/2016 menu toggle fluid and colappse -->
	
    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->

    <!-- Luiz -->

	<style type="text/css">
		
            body {
                background-color: lightgray;
				widith: 100%;
				higth:100%;
            }
            /* Style The Dropdown Button */
            
            .dropdown-submenu {
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
				background-color: lightgreen; /*luiz*/
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
			
</style>
	
</head>
<body>
	<div id="app">
    
		<div class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Branding Image -->                  
					<a class="navbar-brand" href="javascript:void(0)"> {{ config('app.name', 'Laravel') }}</a> 
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

				<!-- ************ Membro da alta direção ************ -->
				@if (Auth::guest())
					
				@elseif (Auth::user()->isMembroAltaDir(Auth::user()->id) )
					<ul class="nav navbar-nav">
                        <li><a href="{{ route('home')  }}"><span class="glyphicon glyphicon-home"> Home&nbsp;</span></a></li>
                        <li class="menu-item dropdown">			    
		
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-folder-close" > Relat&oacute;rios dos Projetos</span><b class="caret"></b></a>
                            <ul class="dropdown-menu">								
								<li class="menu-item dropdown">
                                   <a href="{{ route('relatorio.show')  }}"><span class="glyphicon glyphicon-stats"> Relat&oacute;rio de Indicadores Por Projeto</span></a>
                                </li>                            								
                                <li class="divider"></li>
								<li class="menu-item dropdown">
                                   <a href="{{ route('relatorio.geral')  }}"><span class="glyphicon glyphicon-stats"> Relat&oacute;rio de Indicadores de Todos os Projetos</span></a>
                                </li>                            								
                                <li class="divider"></li>
                                <li class="menu-item dropdown">
                                    <a href="{{ route('relatorio.show') }}"><span class="glyphicon glyphicon-list"> Listar</span></a>
                                </li>								                                
                            </ul>
                        </li>                   
						
						<li class="menu-item dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-stats" > Email</span><b class="caret"></b></a>
                            <ul class="dropdown-menu">
								<li class="menu-item dropdown">
                                    <a href="{{ route('relatorio.email')  }}"><span class="glyphicon glyphicon-check"> Meus Emails</span></a>                                    		
                                </li>																
                            </ul>
						
                        </li>                    
						
                    </ul>
				@endif
				<!-- fim Membro da alta direção -->

				<!--lider do escritorio de projetos -->
				@if (Auth::guest())
					
				@elseif (Auth::user()->isLiderEscritProjetos(Auth::user()->id) )
						

					<ul class="nav navbar-nav">
                        <li><a href="{{ route('home')  }}"><span class="glyphicon glyphicon-home"> Home&nbsp;</span></a></li>
                        <li class="menu-item dropdown">
							<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-folder-close" > Projetos</span><b class="caret"></b></a>
                            <ul class="dropdown-menu">								
                                <li class="menu-item dropdown">
                                    <a href="{{ route('status.show')  }}"><span class="glyphicon glyphicon-check"> Alterar Status do Projeto</span></a>
                                </li>
								<li class="divider"></li>
                                <li class="menu-item dropdown">
                                    <a href="{{ route('projetos.cadastro')  }}"><span class="glyphicon glyphicon-plus"> Cadastrar Projeto</span></a>
                                </li>								
                                <li class="divider"></li>
                                <li class="menu-item dropdown">
                                    <a href="{{ url('projetos/show') }}"><span class="glyphicon glyphicon-list"> Listar Projeto</span></a>
                                </li>
								<li class="divider"></li>
                                <li class="menu-item dropdown">
                                    <a href="{{ url('projetos/show') }}"><span class="glyphicon glyphicon-pencil"> Atualizar Projeto</span></a>
                                </li>
								<li class="divider"></li>
                                <li class="menu-item dropdown">
                                    <a href="{{ url('projetos/show')}}"><span class="glyphicon glyphicon-trash"> Excluir Projeto</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-pencil glyphicon-stats"> Indicador</span><b class="caret"></b></a>
                            <ul class="dropdown-menu">								
                                <li class="menu-item dropdown">
                                    <a href="{{ route('indicador.fases')  }}"><span class="glyphicon glyphicon-log-in"> Associar Indicador ao Projeto</span></a>                   		
                                </li>
                                <li class="divider"></li>
                                <li class="menu-item dropdown">
                                    <a href="{{ route('analisar.analisar') }}"><span class="glyphicon glyphicon-stats"> Analisar Valores dos indicador</span></a>
                                </li>
								<li class="divider"></li>
                                <li class="menu-item dropdown">
                                    <a href="{{ route('indicador.cadastro')  }}"><span class="glyphicon glyphicon-plus"> Cadastrar Indicador</span></a>                                    
                                </li>								
                                <li class="divider"></li>
                                <li class="menu-item dropdown">
                                    <a href="{{ route('indicador.show') }}"><span class="glyphicon glyphicon-list"> Listar Indicadores</span></a>
                                </li>
								<li class="divider"></li>
                                <li class="menu-item dropdown">
                                    <a href="{{ route('indicador.show') }}"><span class="glyphicon glyphicon-pencil"> Atualizar Indicador</span></a>
                                </li>
								<li class="divider"></li>
                                <li class="menu-item dropdown">
                                    <a href="{{ route('indicador.show') }}"><span class="glyphicon glyphicon-trash"> Excluir Indicador</span></a>
                                </li>
                            </ul>
                        </li>                   						
                    </ul>				
                   
				@endif
				<!-- fim lider do escritorio de projetos -->

				<!-- líder de projetos -->
				@if (Auth::guest())
					
				@elseif (Auth::user()->isLiderProjetos(Auth::user()->id) )
					<ul class="nav navbar-nav">
                        <li><a href="{{ route('home')  }}"><span class="glyphicon glyphicon-home"> Home&nbsp;</span></a></li>
						<li class="menu-item dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user">&nbsp;Equipe</span><b class="caret"></b></a>
                            <ul class="dropdown-menu">
								<li class="menu-item dropdown">
                                    <a href="{{ route('equipe.fases') }}"><span class="glyphicon glyphicon-plus"> Cadastrar Equipe</span></a>
                                </li>
                                <li class="divider"></li>
                                <li class="menu-item dropdown">
                                    <a href="{{ route('equipe.show') }}"><span class="glyphicon glyphicon-list"> Listar Membro</span></a>
                                </li>
								<li class="divider"></li>
                                <li class="menu-item dropdown">
                                    <a href="{{ route('equipe.show') }}"><span class="glyphicon glyphicon-pencil"> Atualizar Membro</span></a>
                                </li>
								<li class="divider"></li>
                                <li class="menu-item dropdown">
                                    <a href="{{ route('equipe.show') }}"><span class="glyphicon glyphicon-trash"> Excluir Membro</span></a>
                                </li>
                            </ul>
                        </li>
				  </ul>
				@endif
				<!-- fim líder de projetos -->
						
				<!-- gerente de projetos -->
				@if (Auth::guest())
					
				@elseif (Auth::user()->isGerenteProjetos(Auth::user()->id) )						
					<ul class="nav navbar-nav">
                        <li><a href="{{ route('home')  }}"><span class="glyphicon glyphicon-home"> Home&nbsp;</span></a></li>
                        <li class="menu-item dropdown">			    
		
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-folder-close" > Projetos</span><b class="caret"></b></a>
                            <ul class="dropdown-menu">								
								<li class="menu-item dropdown">
                                   <a href="{{ route('status.show')  }}"><span class="glyphicon glyphicon-check"> Alterar Status do Projeto</span></a>
                                </li>                            								                                                             
                            </ul>
                        </li>
                        <li class="menu-item dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-stats" > Indicador</span><b class="caret"></b></a>
                            <ul class="dropdown-menu">
								<li class="menu-item dropdown">
                                    <a href="{{ route('indicador.informar')  }}"><span class="glyphicon glyphicon-check"> Informar Valores do Indicador</span></a>                                    		
                                </li>															
                            </ul>						
                        </li>                   						
                    </ul>
				@endif
				<!-- fim gerente de projetos -->


				<!--admin -->
				@if (Auth::guest())

				@elseif (Auth::user()->isAdmin(Auth::user()->id) )
						
					<ul class="nav navbar-nav">
                        <li><a href="{{ route('home')  }}"><span class="glyphicon glyphicon-home"> Home&nbsp;</span></a></li>
						<li class="divider"><hr style="color:red;"/></li>  
                        <li class="menu-item dropdown">			    
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"> Usuarios</span><b class="caret"></b></a>
                            <ul class="dropdown-menu">
							   @if (Auth::check())
								<li class="menu-item dropdown">
                                    <a href="{{ url('/admin') }}"><span class="glyphicon glyphicon-plus"> Cadastrar Usuario</span></a>                                    
								</li>
								@endif
                                <li class="divider"></li>
                                <li class="menu-item dropdown">
                                    <a href="{{ url('admin/show') }}"><span class="glyphicon glyphicon-list"> Listar</span></a>
                                </li>
								<li class="divider"></li>
                                <li class="menu-item dropdown">
                                    <a href="{{ url('admin/show') }}"><span class="glyphicon glyphicon-pencil"> Atualizar</span></a>
                                </li>
								<li class="divider"></li>
                                <li class="menu-item dropdown">
                                    <a href="{{ url('admin/show') }}"><span class="glyphicon glyphicon-trash"> Excluir</span></a>
                                </li>
                            </ul>
                        </li>
						<li class="divider"><hr style="color:red;"/></li>  
                        <li class="menu-item dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-check"> @php echo utf8_encode('Permissão');@endphp</span><b class="caret"></b></a>
                            <ul class="dropdown-menu">
								<li class="menu-item dropdown">
                                    <a href="{{ url('admin/permissao')  }}"><span class="glyphicon glyphicon-check"> @php echo utf8_encode('Gerenciar Permissão de Acesso as Telas');@endphp</span></a>                                   		
                                </li>
                            </ul>
                        </li>       
						<li class="divider"><hr style="color:red;"/></li>
                    </ul>

				@endif
			   <!-- fim admin -->






                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in" > Login</span></a></li>
                            <!--<li><a href="{{ route('register') }}">Register</a></li> -->
                        @else
							<li><a href="javascript:void(0)">@php echo '<b style="color:white">'.Auth::user()->roleNAME(Auth::user()->id).'</b>' @endphp</a></li>
                            <li class="dropdown active">							    
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">									
                                    <span class="glyphicon glyphicon-user">&nbsp;{{ Auth::user()->name }}</span> <span class="caret"></span>	
											
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <span class="glyphicon glyphicon-log-out"></span> Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif



						@if (Auth::guest())
						

						@elseif (  (Auth::user()->isNotRole( Auth::user()->id) ) )
							<ul class="nav navbar-nav navbar-brand navbar-right">
								<li><a href="javascript:void(0)"><span class="active panel panel-danger" ><b style="color=red;">@php echo utf8_encode('Você não tem permissão de acesso as telas da aplicação!');@endphp</b>&nbsp;&nbsp;&nbsp;</span></a></li>
								<li class="menu-item dropdown">		
							</ul>

							@php 						
									return Redirect::intended('/home'); 					
									return view('home');										
							@endphp 
						@endif


                    </ul>
                </div>
            </div>
        </nav>
	
       
    </div>
	 @yield('content')
	 
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

