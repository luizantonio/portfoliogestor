@extends('layouts.app')
@section('content')

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

	@if (count($roles) > 0)
		@php echo '<center>'; @endphp	
		@foreach ($roles as $role)	
			@php //echo $role->role_name.';  '; @endphp			
		@endforeach
		@php echo '</center>'; @endphp	
	@endif

	<form action="{{route('admin.changeRole',null)}}" id="form-0" method="POST">
		{!! csrf_field() !!}
		<input type="hidden" name="user_id" id="user_id" value="3" class="form-control">
		<button type="submite" class="btn btn-primary" onclick="event.preventDefault();document.getElementById('form-0').submit();">
			<i class="fa fa-plus">@php echo utf8_encode('Teste Mudar Permissão'); @endphp</i> 
		</button>
	</form>

	<hr class="danger" style="color:red;"><br>

	@php echo utf8_encode('<center class="alert alert-default"><h3><b>Permissão de Acesso a Telas</b></h3></center>'); @endphp 
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
					<a href="{{ url('role/'.$user->id.'/'.$user->hasRole('ADMINISTRADOR', $user->id).'/'.$user->hasRole('GERENTE DE PROJETOS', $user->id).'/'.$user->hasRole('LIDER DO ESCRITÓRIO DE PROJETOS', $user->id).'/'.$user->hasRole('LIDER DE PROJETOS', $user->id).'/'.$user->hasRole('MEMBRO DA ALTA DIREÇÃO', $user->id))}}">dd </a>
						<tr>
						<td> <!-- if remove this tag make problem with the token . Should exists one token to all line table -->
						<!-- <form action="{{ url('admin/change/')}}" id="form-{{$user->id}}" method="POST"> -->
							 <!-- !! csrf_field() !!	-->
							  <!-- method_field('PUT')  -->
							  <td>{{ $user->id }}<input type="hidden" name="id" value="{{ $user->id }}"></td>
							  <td>{{ $user->name }}<input type="hidden" name="name" value="{{ $user->name }}"></td>
							  <td>{{ $user->email }}<input type="hidden" name="email" value="{{ $user->email }}"></td>							  
							  <td><input type="checkbox" {{ $user->hasRole('ADMINISTRADOR', $user->id) ? 'checked' :'' }} name="role_admin" class="custom-control custom-checkbox" id="textbox1"/></td>
							  <td><input type="checkbox" {{ $user->hasRole('GERENTE DE PROJETOS', $user->id) ? 'checked' :'' }} name="role_gerente_projetos" class="custom-control custom-checkbox" id="textbox2"/></td>
							  <td><input type="checkbox" {{ $user->hasRole('LIDER DO ESCRITÓRIO DE PROJETOS', $user->id) ? 'checked' :'' }} name="role_lider_escritorio" class="custom-control custom-checkbox" id="textbox3"/></td>
							  <td><input type="checkbox" {{ $user->hasRole('LIDER DE PROJETOS', $user->id) ? 'checked' :'' }} name="role_gerente_projeto" class="custom-control custom-checkbox" id="textbox4"/></td>
							  <td><input type="checkbox" {{ $user->hasRole('MEMBRO DA ALTA DIREÇÃO', $user->id) ? 'checked' :'' }} name="role_membro_alta_direcao" class="custom-control custom-checkbox" id="textbox5"/></td>
							  <td><input type="hidden" name="user_id" id="user_id" value="{{$user->id}}" class="form-control"></td>
							  <td>
							  <!-- 
							     <button type="submite" class="btn btn-primary" onclick="event.preventDefault();document.getElementById('form-{{$user->id}}').submit();">
									<i class="fa fa-angle-double-left">@php echo utf8_encode('Mudar Permissão'); @endphp</i> 
								  </button> 
						       -->
							   <form id="form-{{$user->id}}"action="{{ url('role/'.$user->id.'/'.$user->hasRole('ADMINISTRADOR', $user->id).'/'.$user->hasRole('GERENTE DE PROJETOS', $user->id).'/'.$user->hasRole('LIDER DO ESCRITÓRIO DE PROJETOS', $user->id).'/'.$user->hasRole('LIDER DE PROJETOS', $user->id).'/'.$user->hasRole('MEMBRO DA ALTA DIREÇÃO', $user->id))}}" method="post">
								  {!! csrf_field() !!} 
								  {{ method_field('PUT') }}
									<a href="{{ url('role/'.$user->id.'/'.$user->hasRole('ADMINISTRADOR', $user->id).'/'.$user->hasRole('GERENTE DE PROJETOS', $user->id).'/'.$user->hasRole('LIDER DO ESCRITÓRIO DE PROJETOS', $user->id).'/'.$user->hasRole('LIDER DE PROJETOS', $user->id).'/'.$user->hasRole('MEMBRO DA ALTA DIREÇÃO', $user->id))}}">
									  <button type="submite" class="btn btn-primary" onclick="event.preventDefault();document.getElementById('form-{{$user->id}}').submit();">
										<i class="fa fa-exchange">@php echo utf8_encode('Mudar Permissão'); @endphp</i> 
									  </button></a>
								  </form>
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
							<button type="button" id="btn-cancelar" class="btn btn-warning">
								<i class="fa fa-plus"><b>Cancelar</b></i> 
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
							
							$('input[type="checkbox"]').change(function () {
								var name = $(this).val();
								var check = $(this).prop('checked');
								
								if ($(this).is(':checked')) {
									this.checked = confirm("Quer Marcar o Tipo?");									
									if(this.checked)
									{
										$(this).prop("checked", true);
										$(this).val($(this).is(':checked'));
									}
									//console.log("Change: " + name + " to " + check);
								}
								if (!$(this).is(':checked')) {
									this.checked = confirm("Quer Desmarcar o Tipo?");
									//$(this).trigger("change");
									if(this.checked)
									{
										$(this).prop("checked", false);
										$(this).val(!$(this).is(':checked'));
									}
									//console.log("Change: " + name + " to " + check);
								}
							});/* input*/
						 }); /* end jquerry */
					</script>
			@endif
		</div>
	</div>
	@endsection