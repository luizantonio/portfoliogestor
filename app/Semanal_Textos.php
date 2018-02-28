<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semanal_Textos extends Model
{
    //
	/**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = ['user_id', 'nome', 'data_de_inicio', 'gerente_responsavel', 'previsao_de_termino',
	 'data_real_de_termino', 'orcamento_total', 'descricao', 'status_id', 'classificacao_id',];

	//constructor
	public function __construct() {}

}
