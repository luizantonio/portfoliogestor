<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Administrador;
use App\UserRole;
use App\Projeto;
use App\Http\Controllers\Controller;
use App\Repositorios\AdministradorRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Response;
use App\Exceptions\Handler;
use Gate;
use App\Http\Controllers\AdminRoleController;
# Class used to manager users
class AdministradorController extends Controller
{
    protected $administradorRepository;
	protected $user;
	protected $users;
	protected $roleController;
	protected $ERRO_DE_CADASTRO = 'Dados invalidos: Sem possibilidade de cadastrar o perfil! Usuario inexistente'; 
	protected $SUCESSO_DE_CADSTRO_DE_PERMISSAO = 'Perfil alterado com sucesso!'; 
	protected $ERRO_DE_CADASTRO_MESMO_PERFIL = 'Dados invalidos: Apenas um perfil permitido!'; 
	protected $ERROR_USUARIO_REMOVER = 'Existem projetos associados ao usuario!'; 	
	protected $ERROR_USUARIO_NAO_ENCONTRADO = 'Usuario inexistente!';
	protected $SUCESSO_USUARIO_REMOVIDO = 'Usuario removido com sucesso!'; 
	

    //constructor
	public function __construct(AdministradorRepository $administradorRepository, RoleController $roleController)
	{
		$this->middleware('auth.admin');
		$this->administradorRepository = $administradorRepository;
		$this->user = new User();
		$this->users = array();
		$this->roleController = $roleController;
	}
	/**
	*
    * Access  by user 'Administrador' .
	*
	* @param Request
	* @return view
	*/
	public function home(Request $request)
	{
		return view('home');
	}
	/**
	*
    * Access  by user 'Administrador' to create a new user form.
	*
	* @param Request
	* @return view
	*/
	public function index(Request $request)
	{
		// vem de ProjetoRepository
	    $users = $this->administradorRepository->allUser();

		return view('admin.index', ['users' => $users,]);
	}
	/**
	*
    * Access  by user Administrador' to create new users.
	*
	* @param User, Request
	* @return boolean
	*/
	public function create(Request $request, User $user)
	{

		
		$adminstrador = new Administrador();
		$adminstrador = $request->user();
	
		/**---------------------------------------------------------
		* Verifica se o user possui autorização para criar users
		* através da política (regra) de autorização
		*-----------------------------------------------------------
		*/
		
		try{

			//$this->authorize('create', $adminstrador );
				
		}catch(AuthorizationException $exception){
			$code = [403];
			if ($exception != null)
			{				
				// vetor com a exception e  codigo para serem exibidos na view
				
				$error = array( 'error' => $exception->getMessage(), 'code' => $code);				
				switch ($code[0])
				{
					case 403:
						return view('/common.403', $error, $code);
						break;
					default:	
						return view('/common.default', $error, $code);
						break;
				}//switch
			}//if
		}//catch
	
		# vetor de mensagens de erros personalizadas
		$messages = array(
			'required' => 'O campo :attribute é obrigatório!',
		);
		# O metodo validate ($input, $rules, $messages) recebe três parametros;
		$this->validate($request, [
			'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
			
		],
        $messages
		);
		# return se deixar o return ele retorna um json na página de registro
		User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),		
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'), 
        ]);
		
		# redireciona para a view de listar os ususários cadastrados
		return redirect('/admin/show');
	}
	/**
	*
    * Access  by user 'Administrador' to lists users.
	*
	* @param Request
	* @return boolean
	*/
	public function show(Request $request)
	{
		// Método de recuperação de projetos do user do ProjetoRepository
	    $users = array();
		$users = $this->administradorRepository->allUser();
		// view
		return view('admin.show', [
			'users' => $users,
		]);
	}
	/**
	*
    * Access  by user 'Adminnstrador' to remove users.
	*
	* @param User, Projeto
	* @return boolean
	*/
	public function destroy(Request $request)
	{
		/**---------------------------------------------------------
		* Verifica se o user possui autorização para excluir usuário
		* através da role - perfil
		*-----------------------------------------------------------
		*/
			
		if(!$request->user()->isAdmin($request->user()->id)){	
			$code = [403];
			// vetor com a exception e  codigo para serem exibidos na view
			$error = array( 'error' => 'Você não tem privilégio suficiente para excluir usuário!', 'code' => $code);								
			return view('/common.403', $error, $code);
		}//if
		
		$id = (int)  $request->id;
		$user = User::find($request->id);
		# verify if user exists and case positive remove if  haven't associated project
		if(!is_null($user )){		
			
				$projetos = Projeto::where('gerente_responsavel', '=', $id)->orWhere('user_id', '=', $id)->first();

				if(!is_null($projetos )){							
						$request->session()->flash('message_error_usuario_show', $this->ERROR_USUARIO_REMOVER); 
						$request->session()->flash('alert-class', 'alert-danger'); 
						return redirect('/admin/show');
				}else{						
					$result = User::where('id', '=', $request->id)->delete();
					
					$request->session()->flash('message_succes_usuario_show', $this->SUCESSO_USUARIO_REMOVIDO); 
					$request->session()->flash('alert-class', 'alert-success');
					return redirect('/admin/show');
				}	
		}else{
			$request->session()->flash('message_error_usuario_show', $this->ERROR_USUARIO_NAO_ENCONTRADO); 
			$request->session()->flash('alert-class', 'alert-danger'); 
			return redirect('/admin/show');
		}	

		return redirect('/admin/show');
	}

	/**
	*
    * Access  by user 'Adminstrador' to update users to form.
	*
	* @param Request, User
	* @return boolean
	*
	*/
	public function update(Request $request, User $user)
	{

		# o objeto que chea através da requisição request é com o nome passado na route, ou seja se passo {id}
		# para recuperar deve ser chamado $request->id
		# se coloco na route {usuario} para recuperar deve ser chamado $request->usuario
		if(!$request->user()->isAdmin($request->user()->id)){	
			$code = [403];
			// vetor com a exception e  codigo para serem exibidos na view
			$error = array( 'error' => 'Você não tem privilégio suficiente para excluir usuário!', 'code' => $code);								
			return view('/common.403', $error, $code);
		}//if

		$users = User::findOrFail($request->id);
   
		return view('admin/update', ['users' => $users]);

	}
	/**
	*
    * Access  by user 'Adminstrador' to update users.
	*
	* @param User, Request
	* @return boolean
	*
	*/
	public function atualizar(Request $request, User $user)
	{

		# config(['app.timezone' => 'UTC']);
		# DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
		date_default_timezone_set('America/Sao_Paulo');

		# vetor de mensagens de erros personalizadas
		$messages = array(
			'required' => 'O campo :attribute é obrigatório!',
			'unique' => 'O campo :attribute deveser único!',
		);	

		# ($input, $rules, $messages)
		# pode ocorre um erro de "NotMethodAloewedException" se ocorrer um erro de validação no email se tiver unique:user
		$this->validate($request, [
			'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|confirmed',
		],
        $messages
		);
		# update user
		User::where('id', $request->usuario_id)
		->update([
			'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
			'updated_at' => date('Y-m-d H:i:s'), 	
		]);
	
		return redirect('/admin/show');
	}

	/**
	*
    * Access  by user 'Admin' to lists users by name.
	*
	* @param Request, User
	* @return boolean
	*/
	public function buscarPorNome(Request $request, User $user)
	{
		$users =  User::where('name', 'like', '%' . $request->nomeUsuarioBusca . '%')->orderBy('name')->paginate(10);
		return view('admin.show', [	'users' => $users,]);
	}
	/**
	*
    * Access  by user 'Admin' to lists users by name...
	*
	* @param Request, User
	* @return boolean
	*/
	public function buscarPorNomePermissao(Request $request, User $user)
	{
		try{

		    $users =  User::where('name', 'like', '%' . $request->nomeUsuarioBusca . '%')->orderBy('name')->paginate(10);
			$roles = Role::all();
		
	    }catch(Exception $e){
			 throw new Exception ('Não foi possível recuperar os dados!');
		} 
		return view('admin.permissao', ['users' => $users, 'roles' => $roles,]);
	}

	/**
	*
    * Access  by user 'Administrador' to lists users by name....
	*
	* @param Request, User
	* @return array
	*/
	public function buscarOrdenarPor(Request $request, User $user)
	{
		$ordenarPor = $request->ordenarUsuarioPor;

		$users [] = array();
		try{			
			if($ordenarPor === 'NOMEDOUSUARIO'){
				$ordenarPor = 'name';
				 $users =  $this
				    ->user
					->orderBy($ordenarPor, 'asc')
					->get();
			}
			elseif($ordenarPor === 'EMAILDOUSUARIO'){
				$ordenarPor = 'email';
				$users =  $this
				->user
				->orderBy($ordenarPor, 'asc')
                ->get();
			}
			elseif($ordenarPor === 'PERFILDOUSUARIO'){
				try{
					$users =User::whereHas('roles', function($q){	$q->where('role_name',   'ADMINISTRADOR')
					                                                  ->orWhere('role_name', 'GERENTE DE PROJETOS')
																	  ->orWhere('role_name', 'LIDER DO ESCRITORIO DE PROJETOS')
																	  ->orWhere('role_name', 'LIDER DE PROJETOS')
																	  ->orWhere('role_name', 'MEMBRO DA ALTA DIRECAO') ; } )->get();			  

				}catch( ErrorException $e){
					echo $e->messages();
				}
			}
	    }catch(Exception $e){
			 throw new Exception ('Não foi possível recuperar os dados!');			 
		} 
		
		return view('admin.show', ['users' => $users,]);
	}
	/**
	*
    * Access  by user 'Administrador' to lists users by name...
	*
	* @param Request, User
	* @return array
	*/
	public function buscarOrdenarPorPermissao(Request $request, User $user)
	{
		$ordenarPor = $request->ordenarUsuarioPor;
		$users [] = array();
		try{			
			if($ordenarPor === 'NOMEDOUSUARIO'){
				$ordenarPor = 'name';
				 $users =  $this
				    ->user
					->orderBy($ordenarPor, 'asc')
					->get();
			}
			elseif($ordenarPor === 'EMAILDOUSUARIO'){
				$ordenarPor = 'email';
				$users =  $this
				->user
				->orderBy($ordenarPor, 'asc')
                ->get();
			}
			elseif($ordenarPor === 'PERFILDOUSUARIO'){
				$users =User::whereHas('roles', function($q){	$q->where('role_name', 'ADMINISTRADOR'); } )->get();
				try{
					$users =User::whereHas('roles', function($q){	$q->where('role_name', '>' , 0); } )->get();
				}catch( ErrorException $e){
					//$e->messages()
			
					return Redirect::back()->withInput()->withErrors("Ocorreu um erro!");
				}
			}
			elseif($ordenarPor === 'PERFIL_ADM'){
				$users =User::whereHas('roles', function($q){	$q->where('role_name', 'ADMINISTRADOR'); } )->get();
			}
			elseif($ordenarPor === 'PERFIL_GP'){
				$users =User::whereHas('roles', function($q){	$q->where('role_name', 'GERENTE DE PROJETOS'); } )->get();
			}
			elseif($ordenarPor === 'PERFIL_LEP'){
				$users =User::whereHas('roles', function($q){	$q->where('role_name', 'LIDER DO ESCRITORIO DE PROJETOS'); } )->get();
			}
			elseif($ordenarPor === 'PERFIL_LP'){
				$users =User::whereHas('roles', function($q){	$q->where('role_name', 'LIDER DE PROJETOS'); } )->get();
			}
			elseif($ordenarPor === 'PERFIL_MAD'){
				$users =User::whereHas('roles', function($q){	$q->where('role_name', 'MEMBRO DA ALTA DIRECAO'); } )->get();	
			}
			$roles = Role::all();

	    }catch(Exception $e){
			 throw new Exception ('Não foi possível recuperar os dados!');
		} 
		return view('admin.permissao', ['users' => $users, 'roles' => $roles,]);
	}
	/**
	*
    * Access  by user Administrador' to attribut role to user.
	*
	* @param Request, User
	* @return boolean
	*/
	public function permissaoRole(Request $request, User $user)
	{
	    $users = array();
		$users = User::all();
		$roles = Role::all(); 
		$userw = User::find(1)->roles()->orderBy('id')->get(); 
		return view('admin.permissao', ['users' => $users, 'roles' => $roles,]);
		
	}
	public function validaDigito($digito)
	{	
		 $result = 1;
		 $valor = ctype_digit( $digito) ? true : false;
		 if( $valor == false || $valor == 0 ){ $result = 0;}
		 $valor =  is_numeric( $digito) ? true : false;
		 if( $valor == false || $valor == 0 ){ $result = 0;}
		 if( ((int) $digito) > PHP_INT_MAX || ((int) $digito) <= 0 ){ $result = 0;}
		 return $result;
	}
	/**
	*
    * Access  by user Administrador' to change attributes role to user.
	*
	* @param Request, User
	* @return boolean
	*/
	public function mudarPermissao(Request $request, User $user)
	{
		echo ' userid: '. $request->userid;
		echo ' [adm: '. $request->adm;
		echo ' gerproj: '. $request->ger_proj;
		echo ' liderescrproj: '. $request->lider_escr_proj;
		echo ' liderproj: '. $request->lider_proj;
		echo ' mad: '. $request->membro_alta_dir .']';
		echo '<br><hr style="color:red;"><br>' ;

		$users = User::find($request->userid);
		
		if( $this->validaDigito($request->adm) == 0 && $this->validaDigito($request->ger_proj) == 0  && $this->validaDigito($request->lider_escr_proj) == 0  
												  && $this->validaDigito($request->lider_proj) == 0  && $this->validaDigito($request->membro_alta_dir) == 0 ){

			if(!$users->roles()->where('user_id', $request->userid)->exists()){
				$request->session()->flash('message_error_permissao', $this->ERRO_DE_CADASTRO); 
				$request->session()->flash('alert-class', 'alert-danger'); 
				return redirect('/admin/permissao');
			}
			
		}
		# se a quntidade for maior que 1, não permite o cadastro
		$quntidadeDePerfil = ( (int)  $request->adm)  + ( (int)  $request->ger_proj) +  ( (int)  $request->lider_escr_proj )
		                   + ( (int)  $request->lider_proj) + ( (int) $request->membro_alta_dir);
		if( $quntidadeDePerfil > 1 ){
			$request->session()->flash('message_error_permissao', $this->ERRO_DE_CADASTRO_MESMO_PERFIL);  
			$request->session()->flash('alert-class', 'alert-danger'); 
			return redirect('/admin/permissao');
		}
		
		if($request != null){
			if($request->userid != null){
				$permissao = $this->roleController ->store($request);
				if($permissao != null && isset($permissao) == true){				
					foreach ($permissao as $role) {		
						foreach ($role as $ro) {	
							if(!is_null($ro)){
								$request->session()->flash('message_success_permissao', $this->SUCESSO_DE_CADSTRO_DE_PERMISSAO); 
								$request->session()->flash('alert-class', 'alert-success'); 
								break;
							}
						}				
					}						
				}else{
					$request->session()->flash('message_error_permissao',  $this->SUCESSO_DE_CADSTRO_DE_PERMISSAO); 
					$request->session()->flash('alert-class', 'alert-danger'); 
				}
			}
		}
		$users = User::find($request->userid);
		return redirect('/admin/permissao');
	}
}# end class