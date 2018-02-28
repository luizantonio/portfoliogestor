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
    
<div class="container">
	@if(Session::has('message_error_permissao'))
	<p class="alert {{ Session::get('alert-class', 'alert-info') }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ Session::get('message_error_permissao') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
	@endif
	@if(Session::has('message_success_permissao'))
		<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message_success_permissao') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
	@endif
	@php echo utf8_encode('<center class="alert alert-default"><h3><b>Permissão de Acesso a Telas</b></h3></center>'); @endphp
	<div class="col-sm-offset-1 col-sm-10">
		<div class="panel panel-default">	
					<div class="form-group">
						<div class="col-sm-offset-0 col-sm-0">						    
							<a href ="{{ route('home') }}"> <button title="@php echo utf8_encode('Voltar para o início');@endphp" type="button" id="btnvoltar" class="btn btn-success">
								<i class="fa fa-chevron-left"> @php echo utf8_encode('Voltar para o Início'); @endphp </i> 
							</button></a>
							<br>
							<center><span><b style="color:blue;">
							@php echo utf8_encode('ADM - Administrador; G.P. - Gerrente de Projetos; L.E.P. - Líde do Escritório de Projetos; L.P. - Líder de Projetos; M.A.D - Membro da alta direção.'); @endphp
							</b></span>
							</center>
						</div>
						<center><b><span id="mensagemCancelar"></span></b><br><span id="mensagemVoltar"></span></b></center>
					</div>		
                    <div id="ativabusca">
						<form action="{{ route('admin.ordenarPorPermissao') }}" method="POST" id="formOrdenar">
							{!! csrf_field() !!}
							<select class="form-control m-b" name="ordenarUsuarioPor" onchange="this.form.submit()">
							   <option value="" disabled="" selected="">Ordenar por...</option>
							   <option value="NOMEDOUSUARIO">Nome</option>
							   <option value="EMAILDOUSUARIO">Email</option>
							   <option value="" disabled="" selected="">Ordenar Apenas por...</option>
							   <option value="PERFIL_ADM">@php echo utf8_encode('ADM Administrador');@endphp</option>
							   <option value="PERFIL_GP">@php echo utf8_encode('G.P. Gerrente de Projetos');@endphp</option>	
							   <option value="PERFIL_LEP">@php echo utf8_encode('L.E.P. Líder do Escritório de Prpjetos');@endphp</option>	
							   <option value="PERFIL_LP">@php echo utf8_encode('L.P. Líder de Prpjetos');@endphp</option>	
							   <option value="PERFIL_MAD">@php echo utf8_encode('M.A.D Membro da Alta Direção');@endphp</option>									    
							 </select>
						</form>
                        <form class="navbar-form " id="buscarusuario" role="form" action="{{ route('admin.buscarPermissao') }}" method="POST">
							{!! csrf_field() !!}
                            <div class="form-group">
                                Filtrar:
								<input type="text" value="" placeholder="Nome do Projeto" name="nomeUsuarioBusca" id="nomeUsuarioBusca" class="form-control">                                
                            </div>          
                            <button title="@php echo utf8_encode('Buscar por');@endphp"type="submit" class="btn btn-sm btn-default" id="button_search"  onclick="this.form.submit()"><span class="glyphicon glyphicon-search active">&nbsp;Buscar</span></button>
                        </form>
                    </div>
		@if (count($users) <= 0 || $users == null)	
			<center><div style="background-color: white;"><h3><b><p class="danger"><b>@php utf8_encode('Usuário não foi encontrado!'); @endphp </b><h3></div></center>	
		@endif
		@if (count($users) > 0)
			<div class="panel panel-default">
				<div class="panel-heading">
					@php echo utf8_encode('Usuários Cadastrados:'); @endphp {{count($users)}}
					<br>
				</div>
				<div class="panel-body">
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
						<!-- <form action="{{ url('admin/change/')}}" id="form-{{$user->id}}" method="POST"> -->
							 <!-- !! csrf_field() !!	-->
							  <!-- method_field('PUT')  -->

							  <td>{{ $user->id }}<input type="hidden" name="id" value="{{ $user->id }}"></td>
							  <td>{{ $user->name }}<input type="hidden" name="name" value="{{ $user->name }}"></td>
							  <td>{{ $user->email }}<input type="hidden" name="email" value="{{ $user->email }}"></td>							  
							  <td><input type="checkbox" disabled style="outline:1px solid red;" {{ $user->isAdmin( $user->id) ? 'checked' :'' }} name="role_admin" class="custom-control custom-checkbox" id="1ch-{{$user->id}}"/></td>
							  <td><input type="checkbox" {{ $user->isGerenteProjetos( $user->id) ? 'checked' :'' }} name="role_gerente_projetos" class="custom-control custom-checkbox" id="2ch-{{$user->id}}"/></td>
							  <td><input type="checkbox" {{ $user->isLiderEscritProjetos( $user->id) ? 'checked' :'' }} name="role_lider_escritorio" class="custom-control custom-checkbox" id="3ch-{{$user->id}}"/></td>
							  <td><input type="checkbox" {{ $user->isLiderProjetos( $user->id) ? 'checked' :'' }} name="role_lider_projeto" class="custom-control custom-checkbox" id="4ch-{{$user->id}}"/></td>
							  <td><input type="checkbox" {{ $user->isMembroAltaDir( $user->id) ? 'checked' :'' }} name="role_membro_alta_direcao" class="custom-control custom-checkbox" id="5ch-{{$user->id}}"/></td>							 
							
							  <td><input type="hidden" name="user_id" id="user_id" value="{{$user->id}}" class="form-control"></td>
							  <td>
							  <!-- 
							     <button title="@php echo utf8_encode('Mudar a Permissão');@endphp" type="submite" class="btn btn-primary" onclick="event.preventDefault();document.getElementById('form-{{$user->id}}').submit();">
									<i class="fa fa-plus">@php echo utf8_encode('Mudar Permissão'); @endphp</i> 
								  </button> 
						       -->
						       @if(!$user->isAdmin( $user->id) )
							   <form id="form-{{$user->id}}"action="{{ url('admin/role/'.$user->id.'/'.$user->isAdmin($user->id).'/'.$user->isGerenteProjetos( $user->id).'/'.$user->isLiderEscritProjetos( $user->id).'/'.$user->isLiderProjetos( $user->id).'/'.$user->isMembroAltaDir( $user->id))}}" method="post">
								  {!! csrf_field() !!} 
								  {{ method_field('PUT') }}
									<a href="{{ url('role/'.$user->id.'/'.$user->isAdmin($user->id).'/'.$user->isGerenteProjetos( $user->id).'/'.$user->isLiderEscritProjetos( $user->id).'/'.$user->isLiderProjetos( $user->id).'/'.$user->isMembroAltaDir( $user->id))}}">
									  <button  title="@php echo utf8_encode('Mudar a Permissão');@endphp" type="submite" class="btn btn-primary" id="'btn-{{$user->id}}'">
										<i class="fa fa-exchange"> @php echo utf8_encode('Mudar Permissão'); @endphp</i> 
									  </button></a>
								  </form>
							  @else
							  	<form id="form-{{$user->id}}"action="{{ url('admin/role/'.$user->id.'/'.$user->isAdmin($user->id).'/'.$user->isGerenteProjetos( $user->id).'/'.$user->isLiderEscritProjetos( $user->id).'/'.$user->isLiderProjetos( $user->id).'/'.$user->isMembroAltaDir( $user->id))}}" method="post">
								  {!! csrf_field() !!} 
								  {{ method_field('PUT') }}
									<a href="{{ url('role/'.$user->id.'/'.$user->isAdmin($user->id).'/'.$user->isGerenteProjetos( $user->id).'/'.$user->isLiderEscritProjetos( $user->id).'/'.$user->isLiderProjetos( $user->id).'/'.$user->isMembroAltaDir( $user->id))}}">
									  <button  disabled="" title="@php echo utf8_encode('Mudar a Permissão');@endphp" type="submite" class="btn btn-primary" id="'btn-{{$user->id}}'">
										<i class="fa fa-exchange"> @php echo utf8_encode('Mudar Permissão'); @endphp</i> 
									  </button></a>
								  </form>
							  @endif
							  </td>
						<!-- </form> -->
						</td>
					  </tr>
					 
					@endforeach
				</tbody>
			  </table>
			
			   <!-- Add Task Button -->
				
					<div class="form-group">
						<div class="col-sm-offset-5 col-sm-6">
							<button title="@php echo utf8_encode('Cancelar Operações');@endphp" type="button" id="btn-cancelar" class="btn btn-warning">
								<i class="fa fa-plus"><b>Cancelar</b></i> 
							</button>
						</div>
					</div>

				</div>
			</div> 
			<script type="text/javascript">
						$(document).ready(function () {
							$('#btn-cancelar').click(function () {
								$("* :button").attr("disabled", true);
								$("* :checkbox").attr("disabled", true);
								$("#atualizar :input").attr("disabled", true);
								$("#buscarusuario :input").prop("disabled", true);
								$("#formOrdenar :input").prop("disabled", true);
								var texto = "";
								$( "#mensagemCancelar" ).text('@php echo utf8_encode("Operação cancelada!"); @endphp');
								$( "#mensagemCancelar" ).css( "color", "red" ).find( ".special" ).css( "color", "green" );
								$( "#mensagemVoltar" ).text('@php echo utf8_encode("Clique no botão [Voltar para o Início] para retornar a tela inicial!"); @endphp');
								$( "#mensagemVoltar" ).css( "color", "green" );
								$("#btnvoltar").attr("disabled", false);
							});
							/** SUMBMIT THE FORM  by Luiz Silva 08/08/2017 17:00:00 **/
							$('.btn-primary').click(function (event) {
								event.preventDefault();
								var button = confirm("Quer enviar os dados?");
								if(button == true){
									var form_id = $(this).closest('form').attr('id');
									$('#'+form_id).submit();
								}
							});
							/** ALTER CHECKBOX VALUE by Luiz Silva 09/08/2017 11:00:00 **/
							$('input[type="checkbox"]').change(function () {
								var name = $(this).val();
								var check = $(this).prop('checked');		
								var check_id = $(this).attr('id');
							    /**console.log("checkbox id: " + check_id + " ");*/
								var tamanho = check_id.length;
								var inicioIDuser =  $(this).attr('id').indexOf('-') +1;
								var stringh = check_id.substring(inicioIDuser, tamanho);
								var iduser = parseInt(stringh);
								var indiceCHAVE = $(this).attr('id').indexOf('ch');
								var resURLstring = check_id.substring(0, indiceCHAVE) ;
								var numeroRole = parseInt(resURLstring);
								/**console.log( " numeroRole: " + numeroRole + "  iduser : "+ iduser);*/
								var urlaction =  $('form[id="form-' + iduser +'"]').closest('form').attr('action');
								var form_id = $('form[id="form-' + iduser +'"]').closest('form').attr('id');	
																					
							   /**console.log('action: ' + urlaction);**/
							   /** console.log('form_id: ' + form_id);**/

								var tamanhoIdform = form_id.length;
								var inicioIdform =  form_id.indexOf('-') +1;
								var stringIdform = form_id.substring(inicioIdform, tamanhoIdform);
								var idUserform = parseInt(stringIdform);

								/**console.log('idUserform: ' + idUserform); */


								var lenthURL = urlaction.length;																
								var indiceURLrole = urlaction.indexOf("role/") + ("role/").length + 2;									
								var resURL = urlaction.substring(indiceURLrole, lenthURL);

								/** console.log("resURL: " + resURL);	**/

								var val= resURL.split('/');
								/** console.log('val inicial: ' + val); **/
								/** console.log(" resURL:" + val); **/
								var valorurl = null;

								/** AO MARCAR UM CHECKBOX by Luiz Silva 09/08/2017 11:00:00**/
								if ($(this).is(':checked')) {
									this.checked = confirm("Quer Marcar o Tipo?");	// return true or false								
									if(this.checked)
									{
										$(this).prop("checked", true);
										$(this).val($(this).is(':checked'));
									}
									
									if(this.checked)
									{

										/** console.log(' AO MARCAR UM CHECKBOX'); */


										/** ALTER THE URL **/
										var selecionado = function (grupo) { 																	
											var result = $('input:checked'); 
											if (result.length > 0 ) { 
												var contador = result.length + " selecionado(s)<br/>"; 
										
										
												result.each(function () { 
													if( (typeof  $(this).attr('id')) != "undefined" &&  $(this).attr('id').indexOf('-') !== -1  ) {
												
														if(numeroRole == 1){
															val[0] = 1;												    													
														}
														if(numeroRole == 2){
															val[1] = 1;
														}
														if(numeroRole == 3){
															val[2] = 1;													
														}
														if(numeroRole == 4){
															val[3] = 1;													
														}
														if(numeroRole == 5){
															val[4] = 1;													
														}
													}

													/*
													const input = 'role/1/1/0/0/0/0';
													const [url, user, role_admin, role_gerentep, role_lider_esc, role_liderp, role_membroad] = input.split('/');
													console.log(url); // 
													console.log(user); // 
													console.log(role_admin); // 
													console.log(role_gerentep); // 
													console.log(role_lider_esc); // 
													console.log(role_liderp); //
													console.log(role_membroad); // 
													*/

													contador += $(this).val() + " "
													/** console.log(contador); **/
												}); 
												/** $('#divFiltros').html(contador);  **/
										
											} 
											else { 
												/** $('#divFiltros').html("Nenhum selecionado"); **/
											} 
											/** console.log("REsult: "); **/
											/** console.log(result); **/
											if( typeof idUserform != "undefined" && typeof iduser != "undefined"){
												if( iduser == idUserform){	
												    /** console.log(' AO MARCAR UM CHECKBOX'); **/
												    

													valorurl = val[0] +'/'+ val[1] +'/'+ val[2] +'/'+ val[3] +'/'+ val[4] ;
													/** console.log(" valorurl------------------> " + valorurl);	**/								
													var finalResultadoURL = urlaction.substring(0, indiceURLrole) + valorurl ;

													/** $(form_id).attr( 'action', finalResultadoURL); **/
													$('#'+form_id).attr('action', finalResultadoURL);
													/** console.log("finalResultadoURL: ------------"); **/
													/** console.log(finalResultadoURL); **/
												}									
											}									
										}; 

										selecionado($(this));

									}
								}
								/** AO DESMARCAR UM CHECKBOX by Luiz Silva 09/08/2017 11:00:00 **/
								if (!$(this).is(':checked')) {
									this.checked = confirm("Quer Desmarcar o Tipo?");  // return true or false								
									if(this.checked)
									{
										$(this).prop("checked", false);
										$(this).val(!$(this).is(':checked'));										
									}
									if(!this.checked)
									{
										/** console.log(' AO DESMARCAR UM CHECKBOX'); **/
										/** ALTERA O URL
										 Case don't have marked checkbox, Don't pass in test  result.length (empty) **/
										if( (typeof  $(this).attr('id')) != "undefined" &&  $(this).attr('id').indexOf('-') !== -1  ) {												
											if(numeroRole == 1){		
												val[0] = 0;
											}
											if(numeroRole == 2){
												val[1] = 0;
											}
											if(numeroRole == 3){
												val[2] = 0;				
											}
											if(numeroRole == 4){
												val[3] = 0;				
											}
											if(numeroRole == 5){
												val[4] = 0;			
											}
											if(numeroRole == 6){
												val[5] = 0;				
											}
										}
										/**Case EXISTS one or more marked checkbox. Pass in test  result.length (don't empty)**/

										var selecionado = function (grupo) { 																	
											var result = $('input:checked'); 
											if (result.length > 0 ) { 
												var contador = result.length + " selecionado(s)<br/>"; 
																				
												result.each(function () { 
													if( (typeof  $(this).attr('id')) != "undefined" &&  $(this).attr('id').indexOf('-') !== -1  ) {
												
														if(numeroRole == 1){				
															val[0] = 0;
														}
														if(numeroRole == 2){
															val[1] = 0;
														}
														if(numeroRole == 3){
															val[2] = 0;
														}
														if(numeroRole == 4){
															val[3] = 0;						
														}
														if(numeroRole == 5){
															val[4] = 0;					
														}
														if(numeroRole == 6){
															val[5] = 0;						
														}
													}


													contador += $(this).val() + " "
													/** console.log(contador); **/
												}); 
												/** $('#divFiltros').html(contador); **/
										
											} 
											else { 
												/** $('#divFiltros').html("Nenhum selecionado"); **/
											} 
											/** console.log("REsult: "); **/
											/** console.log(result); **/
											if( typeof idUserform != "undefined" && typeof iduser != "undefined"){
												if( iduser == idUserform){	
													valorurl = val[0] +'/'+ val[1] +'/'+ val[2] +'/'+ val[3] +'/'+ val[4] ;
													/** console.log(" valorurl----> " + valorurl); **/				
													var finalResultadoURL = urlaction.substring(0, indiceURLrole) + valorurl ;

													/** $(form_id).attr( 'action', finalResultadoURL); **/
													$('#'+form_id).attr('action', finalResultadoURL);
													/** console.log("finalResultadoURL: --"); **/
													/** console.log(finalResultadoURL); **/
												}									
											}									
										}; /** FIM FUNÇÃO **/
										selecionado($(this));
									}/** FIM IF DESCMARCAR **/
								}/** FIM DESMARCAR **/

							});/* FIM input*/

						 }); /* end jquerry */
					</script>			
			@endif
		</div>
	</div>
</div>
	@endsection