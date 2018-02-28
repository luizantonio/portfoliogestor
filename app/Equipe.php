<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
/**
* Classe mmodelo que possui os atributoa da equipe do projeto
*
**/
class Equipe extends Model
{
    use Notifiable;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'user_id', 'projeto_id', 'membro_id',
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
	/**
    * The equipe have many members associated with your ID
    *
    * @return Membro
    */
	public function membros()
	{
		return $this->belongsToMany(Membro::class, 'equipes');
	}
}
