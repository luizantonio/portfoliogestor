<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Statusmodificado extends Model
{
	use Notifiable;

	/**-----------------------------------------------------------------------------
    * Class used to modify project status 
	* users [Lider do Esccritório de Projetos] & [Gerente de Projetos]
	*--------------------------------------------------------------------------------*/

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'user_id', 'projeto_id', 'status_id', 'justificativa_analise_aprovada', 'justificativa_cancelado', 'created_at', 'updated_at',
    ];

	/**
    * The equipe is associated with user ID
    *
    */ 
	public function __construct()
	{
		
	}

	/**
    * The equipe is associated with user ID
    *
    * @return User
    */ 
	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
