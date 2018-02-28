<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdministradorPolicy
{
    use HandlesAuthorization;

	protected $administrador = 1;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
		/**
     * Verify if user 'administrador' have access restrict to create users.
	 *
     * @param User, Projeto
     * @return boolean
     */
	public function create(User $user, Administrador $projeto)
	{	
		return ($user->isAdmin($user->id) );
		
	}

	/**
     * Verify if user have access restrict to remove users.
     * 
     * @return boolean
     */
	public function destroy(User $user, User $remover)
	{
		//echo '<script>alert("'.$user->isAdmin($user->id).'");</script>';
		return ($user->isAdmin($user->id));
	
	}

	/**
     * Verify if user 'administrador' have access restrict to update users.
	 *
     * @param User, Projeto
     * @return boolean
     */
	public function update(User $user)
	{	
	
		return ($user->isAdmin($user->id) );
	}
}