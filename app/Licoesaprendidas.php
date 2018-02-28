<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
* Class Licoesaprendidas:  Atende ao requisito extra e pessoal
* Em: 09-02-2018 14:16:00 - Brasil 
* By Luiz
**/
class Licoesaprendidas extends Model
{
    // Fields then update by web requests, using label fillable
	protected $fillable = ['user_id', 'projeto_id', 'licao', 'created_at', 'updated_at',];
	//constructor
	public function __construct(){}
	
	public function getFillable() {
	  return $this->fillable;
	}

	/**
    * The funcion that should have one user asssociated with many inform id
	*                  1 user tem * lic ---->
	*             <---- 1 lic pertence 1 user
	*	[user]-----------1------<>-------*----------[acomp]
    *
    * @return User
    */
	public function user()
	{
		return $this->belongsTo(User::class);	#[ok] 31/08/2017 10:50:00
	}

	public function projetos()
	{
		return $this->belongsTo(Projetos::class);	#[ok] 31/08/2017 10:50:00
	}
}