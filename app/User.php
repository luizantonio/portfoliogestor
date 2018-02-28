<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [ 'password', 'remember_token',];

	/**
	* USE is $this->user()->projetos()...
    * The funcion that should have many projects asssociated with your ID
    *
    * @return Projeto
    */
	public function projetos()
	{
		return $this->hasMany(Projeto::class);	#[ok]	--ok-- Não Modificar
	}
	/**
	* USE is $this->user()->projetos()...
    * The funcion that should have many projects asssociated with your ID
    *
    * @return Projeto
    */
	public function membros()
	{
		return $this->hasMany(Membro::class);	#[ok]	--ok-- Não Modificar in 18/08/2017 10:50:00
	}

	/**
	* USE is $this->user()->indicadores()...
    * The funcion that should have many indicadores asssociated with your ID
    *
    * @return Indicador
    */
	public function indicadores()
	{
		return $this->hasMany(Indicador::class, 'user_id');	#[ok]	--ok-- Não Modificar
	}

	/**
	* USE is $this->user()->role()...
    * The funcion that should have many roles asssociated with your ID
    *
    * @return Role
    */
	public function role()
	{
		return $this->belongsToMany(Role::class, 'role_user');	#[ok]	--ok-- Não Modificar
	}

	/**
	* USE is $this->user()->role()...
    * The roles that belong to the user. Muitos usuários podem ter o mesmo Role(Perfil - tipo)
    */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');	#[ok]	--ok-- Não Modificar
    }
	/**
	*  USE is $this->user()->RolesP()...
	* Muitos usuários podem ter o mesmo Role(Perfil - tipo)
	*/
	public function RolesP() { 
		return $this->belongsToMany('Role', 'roles')->withTimestamps(); 
	}

	/**
	* USE is $this->user()->equipes()...
    * The funcion that should have many 'equipes' (team) asssociated with your ID
    *
    * @return Equipe
    */
	public function equipes()
	{
		return $this->hasMany(Equipe::class);	
	}
	/**	22/08/2017 or 2017-08-22 10:54:00
    * The funcion that should have many informarIndicadores asssociated with your ID
    *
    * @return Informar_Indicador
    */
	public function valores()
	{
		return $this->hasMany(Valor::class, 'user_id');
	}
	/**
	* 31/08/2017 or 2017-08-31 10:54:00
	* The funcion that should have many informarIndicadores asssociated with your ID
	* @return User
	*/ 
	public function acompanhamentos()
	{
		return $this->hasMany(Acompanhamento::class, 'user_id');
	}
	/**
	* 31/08/2017 or 2017-08-31 10:54:00
	* The funcion that should have many licoes asssociated with your ID
	* @return User
	*/ 
	public function licoesaprendidas()
	{
		return $this->hasMany(Licoesaprendidas::class, 'user_id');
	}
	/**	01/09/2017 or 2017-09-01 22:00:00
    * The funcion that should have many Statusmodificado asssociated with your ID
    *
    * @return Statusmodificado
    */
	public function statusProjeto()
	{
		return $this->hasMany(Statusmodificado::class, 'user_id');
	}
	public function hasRole(String $string, $id)
	{
		
		$id = (int) $id;
		//echo utf8_encode($string);

		$userw = User::find($id)->roles()->orderBy('id')->get(); # ----------------------------- busca na tabela role_user
		$result = 0;
		foreach ($userw as $role) {
		   // var_dump($role->role_name);
			if( utf8_encode($string) == 'ADMINISTRADOR' ){                  /*return*/echo  ( utf8_encode($string) == utf8_encode($role->role_name)) ? 1 : 0; }
			if( utf8_encode($string) == 'GERENTE DE PROJETOS'){             /*return*/ echo ( utf8_encode($string) == utf8_encode($role->role_name)) ? 1 : 0; }		
			if( utf8_encode($string) == 'LÍDER DO ESCRITÓRIO DE PROJETOS'){ return   utf8_encode($string) === utf8_encode($role->role_name) ? 0 : 1; }		
			if( utf8_encode($string) == 'LÍDER DE PROJETOS'){               /*return*/ echo ( utf8_encode($string) == utf8_encode($role->role_name)) ? 1 : 0; }
			if( utf8_encode($string) == 'MEMBRO DA ALTA DIREÇÃO'){          /*return*/  echo( utf8_encode($string) == utf8_encode($role->role_name)) ? 1 : 0; }
			if( utf8_encode($string) == 'null'){                            /*return*/ echo ( utf8_encode($string) == null) ? 0 : 1;             }				  						 
							
		}
		return $result;

		
	}
	// Return the name of the role, for examplo 'GERENTE DE PROJETOS'
	public function roleNAME($id)
	{
		$id = (int) $id;
		$userw = User::find($id)->roles()->orderBy('id')->get(); # ------- busca na tabela role_user
		$permissoes = array();
		if($userw != null && count($userw) > 0){
			if(count($userw) == 1){
				foreach ($userw as $role) {	
					$roleName = utf8_encode($role->role_name);
					return utf8_encode($roleName);
					break;						                         			  						 
				}
			}else{
				$patternADM = '/' . 'ADMINISTRADOR' . '/';//Padrão a ser encontrado na string
				$patternGERP = '/' . 'GERENTE DE PROJETOS' . '/';//Padrão a ser encontrado na string
				$patternLEP = '/' . 'ESCRITORIO' . '/';//Padrão a ser encontrado na string
				$patternLP = '/' . 'LIDER DE PROJETOS' . '/';//Padrão a ser encontrado na string
				$patternMAD = '/' . 'MEMBRO DA ALTA DIRECAO' . '/';//Padrão a ser encontrado na string
				$Multipapel ='';
				foreach ($userw as $role) {	
					$roleName = utf8_encode($role->role_name);

					if (   preg_match( $patternADM,  $roleName)	)   { $Multipapel = 'ADM-';}	
					if (   preg_match( $patternADM,  $roleName)	)	{ $Multipapel = 'GERP-';}	
					if (   preg_match( $patternADM,  $roleName)	)	{ $Multipapel = 'LEP-';}	
					if (   preg_match( $patternADM,  $roleName)	)	{ $Multipapel = 'LP-';}		
					if (   preg_match( $patternADM,  $roleName)	)	{ $Multipapel = 'MAD-';}	
																                         			  						 
				}
				return utf8_encode($Multipapel);
			}
		}
		else{
			return utf8_encode('Não Definido');
		}
	}
	/**
    * The funcion verify if one user is admin by your ID
    *
    * @return boolean
    */
	public function isAdmin($id)
	{
		$userw = User::find($id)->roles()->orderBy('id')->get(); 
		$permissoes = array();
		if($userw != null && count($userw) > 0){
			//var_dump($userw);			                         			  						 
			$pattern = '/' . 'ADMINISTRADOR' . '/';//Padrão a ser encontrado na string
			foreach ($userw as $role) {	
			    $roleName = utf8_encode($role->role_name);

				return (   preg_match( $pattern,  $roleName)	)		? 1 : 0;			
				//return (utf8_encode($role->role_name) == 'ADMINISTRADOR' ) ? 1 : 0;
				                         			  						 
			}
		}
		else{
			return 0;
		}
	}
	/**
    * The funcion verify if one user is 'gerente de projetos' by your ID
    *
    * @return boolean
    */
	public function isGerenteProjetos($id)
	{
		$userw = User::find($id)->roles()->orderBy('id')->get(); # ------- busca na tabela role_user
		$permissoes = array();
		
		if($userw != null && count($userw) > 0){
			//var_dump($userw);
			$pattern = '/' . 'GERENTE DE PROJETOS' . '/';//Padrão a ser encontrado na string

			foreach ($userw as $role) {	

			    $roleName = utf8_encode($role->role_name);

				return (   preg_match( $pattern,  $roleName)	)		? 1 : 0;						                         			  						 
			}
		}
		else{
			return 0;
		}
	}
	/**
    * The funcion verify if one user is 'office lider projects' by your ID
    *
    * @return boolean
    */
	public function isLiderEscritProjetos($id)
	{
		$userw = User::find($id)->roles()->orderBy('id')->get(); # ------- busca na tabela role_user
		$permissoes = array();
		
		if($userw != null && count($userw) > 0){
			//var_dump($userw);
			$pattern = '/' . 'ESCRITORIO' . '/';//Padrão a ser encontrado na string
			foreach ($userw as $role) {	
			    $roleName = utf8_encode($role->role_name);

				return (   preg_match( $pattern,  $roleName)	)		? 1 : 0;			
				//return (utf8_encode($role->role_name) == 'LIDER DO ESCRITORIO DE PROJETOS' ) ? 1 : 0;			                         			  						 
			}
		}
		else{
			return 0;
		}
	}
	/**
    * The funcion verify if one user is 'project lider' by your ID
    *
    * @return boolean
    */
	public function isLiderProjetos($id)
	{
		$userw = User::find($id)->roles()->orderBy('id')->get(); # ------- busca na tabela role_user
		$permissoes = array();
		if($userw != null && count($userw) > 0){
			//var_dump($userw);			                         			  						 
			$pattern = '/' . 'LIDER DE PROJETOS' . '/';//Padrão a ser encontrado na string
			foreach ($userw as $role) {	
			    $roleName = utf8_encode($role->role_name);

				return (   preg_match( $pattern,  $roleName)	)		? 1 : 0;			
				//return (utf8_encode($role->role_name) == 'LÍDER DE PROJETOS' ) ? 1 : 0;			                         			  						 
			}
		}
		else{
			return 0;
		}
	}
	/**
    * The funcion verify if one user is 'hight director - CEO - boss' by your ID
    *
    * @return boolean
    */
	public function isMembroAltaDir($id)
	{
		$userw = User::find($id)->roles()->orderBy('id')->get(); # ------- busca na tabela role_user
		$permissoes = array();
		if($userw != null && count($userw) > 0){
			//var_dump($userw);			                         			  						 
			$pattern = '/' . 'MEMBRO DA ALTA DIRECAO' . '/';//Padrão a ser encontrado na string
			foreach ($userw as $role) {	
			    $roleName = utf8_encode($role->role_name);

				return (   preg_match( $pattern,  $roleName)	)		? 1 : 0;			
				//return (utf8_encode($role->role_name) == 'MEMBRO DA ALTA DIRECAO'  ) ? 1 : 0;			                         			  						 
			}
		}
		else{
			return 0;
		}
	}
	/**
    * The funcion verify if one user not have role by your ID
    *
    * @return boolean
    */
	public function isNotRole($id)
	{
		$userw = User::find($id)->roles()->orderBy('id')->get(); # ------- busca na tabela role_user
		# The user have role
		if($userw != null && count($userw) > 0){				
				return  count($userw) ? 0 : 1;
		}
		else{
			# The user not have role
			return 1; 
		}
	}
	/**
    * The funcion return one vector of members by project lider ID
    *
    * @return boolean
    */
	public function getMembrosVetor($id){
		$result = User::find($id)->membros()->orderBy('nome')->get();	
		if($result != null && count($result) > 0){
			return $result;
		}
	}
	
	/**
    * The funcion that should have one user asssociated by id
    * retorna a descricao do acompanhamento
    * @return string
    */
	public function acompanhamentoByValorId($userid, $valorid)
	{		
		$user = User::find($userid);

		$acompts = Acompanhamento::select('acompanhamentos.*', 'valors.*' )
            ->join('valors', 'acompanhamentos.valor_id', '=', 'valors.id')->where('valors.id', '=', $valorid)
            ->get();

		//$acompts = $user->acompanhamentos()->where('acompanhamentos.valor_id', $valorid);		
		if($acompts != null ){
			foreach ($acompts as $acom) {	
			    return $acom->descricao;  						 
			}
		}
		return null;	
	}
	/**
    * The funcion retur the user's name by your ID
    *
    * @return string
    */
	public function getUserName($id)
	{
		$user = User::find($id)->orderBy('id');
		if($user != null){
			foreach ($user as $wanted) {	
			   return $wanted->name;
				break;                 			  						 
			}
		}
		return null;
	}

	/**
	*-WARNING:---------------------------------------------------------------
	*-NÃO ESTÁ SENDO CHAMADO PELO USER, MAS ESTÁ PELO PROJETO NA VIEW
    * The funcion get gerente de projetos by your ID
    *
    * @return string
    */
	public function getGerenteProjetos()
	{
		$collectionGerentes = User::select('users.*', 'role_user.*' )
            ->join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id', '=', 2)
            ->get();

		if($collectionGerentes != null && count($collectionGerentes) > 0){
			//var_dump($collectionGerentes);
			return $collectionGerentes;
		}
		return null;
	}
}