@section('content1')
<ul class="nav navbar-nav">
    <li><a href="{{ route('home')  }}"><span class="glyphicon glyphicon-home"> Home&nbsp;</span></a></li>
    <li class="menu-item dropdown">
	<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">Projetos<b class="caret"></b></a>
		<ul class="dropdown-menu">
			<li class="menu-item dropdown dropdown-submenu">
               <a href="{{ route('index')  }}"><span class="glyphicon glyphicon-plus"> Associar Indicador</span></a>
               <ul class="dropdown-menu">
                   <li class="menu-item dropdown">
                       <a href="{{ route('index')  }}">Associar Indicador ao Projeto</a>
                   </li>                                      
               </ul>
			   <li class="menu-item dropdown dropdown-submenu">
				 <a href="{{ route('index')  }}"><span class="glyphicon glyphicon-plus"> Alterar Status</span></a>
                 <ul class="dropdown-menu">
					<li class="menu-item dropdown">
                       <a href="{{ route('index')  }}">Alterar Status Projeto</a>
                    </li>                                      
                 </ul>
                </li>
             </li>
			 <li class="menu-item dropdown dropdown-submenu">
                   <a href="{{ route('index')  }}"><span class="glyphicon glyphicon-plus"> Cadastrar</span></a>
                   <ul class="dropdown-menu">
                      <li class="menu-item dropdown">
						<a href="{{ route('index')  }}">Novo Projeto</a>
                      </li>                                      
                   </ul>
             </li>
             <li class="divider"></li>
             <li class="menu-item dropdown">
                 <a href="{{ route('show') }}"><span class="glyphicon glyphicon-user"> Listar</span></a>
             </li>
			 <li class="divider"></li>
                   <li class="menu-item dropdown">
                        <a href="{{ route('show') }}"><span class="glyphicon glyphicon-user"> Atualizar</span></a>
                   </li>
			 <li class="divider"></li>
             <li class="menu-item dropdown">
                   <a href="{{ route('show') }}"><span class="glyphicon glyphicon-user"> Excluir</span></a>
             </li>
           </ul>
        </li>
         <li class="menu-item dropdown">
              <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">Indicador<b class="caret"></b></a>
                            <ul class="dropdown-menu">
								<li class="menu-item dropdown dropdown-submenu">
                                    <a href="{{ route('index')  }}"><span class="glyphicon glyphicon-plus"> Associar Indicador</span></a>
                                    <ul class="dropdown-menu">
                                        <li class="menu-item dropdown">
                                           <a href="{{ route('index')  }}">Associar Indicador ao Projeto</a>
                                        </li>                                      
                                    </ul>		
                                </li>
                                </li>
								<li class="menu-item dropdown dropdown-submenu">
                                    <a href="{{ route('index')  }}"><span class="glyphicon glyphicon-plus"> Cadastrar</span></a>
                                    <ul class="dropdown-menu">
                                        <li class="menu-item dropdown">
                                           <a href="{{ route('index')  }}">Novo Indicador</a>
                                        </li>                                      
                                    </ul>
                                </li>
                                <li class="divider"></li>
                                <li class="menu-item dropdown">
                                    <a href="{{ route('show') }}"><span class="glyphicon glyphicon-user"> Listar</span></a>
                                </li>
								<li class="divider"></li>
                                <li class="menu-item dropdown">
                                    <a href="{{ route('show') }}"><span class="glyphicon glyphicon-user"> Atualizar</span></a>
                                </li>
								<li class="divider"></li>
                                <li class="menu-item dropdown">
                                    <a href="{{ route('show') }}"><span class="glyphicon glyphicon-user"> Excluir</span></a>
                                </li>
                            </ul>
                        </li>                   
						<li><a href="{{ route('show') }}"><span class="glyphicon glyphicon-user"> Habilitar</span></a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="menu-item dropdown active">
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}&nbsp;<span class="glyphicon glyphicon-user"></span><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="menu-item dropdown">
                                    <a href="./perfil.php"><span class="glyphicon glyphicon-user"></span> Perfil</a>
                                </li>
                                <li class="divider"></li>
                                <li class="menu-item dropdown">
                                    <a href="./logout.php"><span class="glyphicon glyphicon-log-out"></span> Sair</a>
                                </li>
                            </ul>
                        </li>
                    </ul>



@endsection


           