<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;//
use App\Role;//
use App\Administrador;//


class RoleController extends Controller
{
    //
	public function __construct()
	{
		$this->middleware('auth.admin');

	}

	public function remove($idUser, $permissao)
	{

	}
	public function store(Request $request)
	{
		
		$rolesADD = array();
		if(  $request->adm == 1){
			$rolesADD [] = 1;
		}
		if(  $request->ger_proj == 1){
			$rolesADD [] = 2;
		}
		if(  $request->lider_escr_proj == 1){
			$rolesADD [] = 3 ;
		}
		if(  $request->lider_proj == 1){
			$rolesADD [] = 4 ;
		}
		if(  $request->membro_alta_dir == 1){
			$rolesADD [] = 5 ;
		}
		$userw = User::find($request->userid)->roles()->orderBy('id')->get(); 
		#  busca na tabela role_user
		$permissoes = array();
		if($userw != null && count($userw) > 0){
			$nome = '';
			//var_dump($userw);
			foreach ($userw as $role) {
				
				$nome  = $role->role_name;      
								  						 
				$permissoes[] = $nome; 
			}
		}
		
		$user = User::find($request->userid);
		#-----------------------------------------------------------------------------
		# Add role to user there, useing sync method
		#-----------------------------------------------------------------------------
		return $user->roles()->sync($rolesADD);// array de permissões

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
		// Método de recuperação de users do user by Repository
	    $users = array();
		$users = $this->administradorRepository->allUser();
		// view
		return view('admin.show', [	'users' => $users,]);
	}
	/**
	*
    * Access  by user 'Admin' to lists users by name...
	*
	* @param Request, User
	* @return boolean
	*/
	public function buscarPorNome(Request $request, User $user)
	{
		
		$projetos [] = array();
		try{
		    $users =  User::where('name', 'like', '%' . $request->nomeUsuarioBusca . '%')->orderBy('name')->paginate(10);
		
	    }catch(Exception $e){
			throw new Exception ('Não foi possível recuperar os dados!');
			return  $e;
		} 
		return view('admin.show', ['users' => $users,]);
	}

	/**
	*
    * Access  by user 'Administrador' to lists asc users by name...
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
				$ordenarPor = 'perfil_id';
				$users =  $this
				->user
				->orderBy($ordenarPor, 'asc')
                ->get();
			}
	    }catch(Exception $e){
			throw new Exception ('Não foi possível recuperar os dados!');
			return  $e;
		} 
		return view('admin.show', ['users' => $users,]);
	}
	public function buscarTodasRoles()
	{
		$role = new Role();
		$roles [] = array();
		$roles =  $role->orderBy('role_name', 'asc')
					->get();
		return  $roles;
	}
}
