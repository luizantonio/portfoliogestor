<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FaseProjeto extends Model
{    
	
	protected $fillable = ['id', 'fase_id', 'projeto_id', 'indicador_id', 'valor_minimo', 'valor_maximo', 'created_at', 'updated_at',];

	//constructor
	public function __construct()
	{
		
	}

	public function projeto()
	{
		return $this->belongsTo(Projeto::class, 'projeto_id');	#[ok] 18/08/2017 11:10:00
	}
}
