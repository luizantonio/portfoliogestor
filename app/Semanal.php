<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
#----------------------------------------------------------------
# Class usada para manter o acompanhamento semanal do projeto
# Usada em Semanalcontroller class para view home.blade.php form
#----------------------------------------------------------------
class Semanal extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'projeto_id', 'descricao', 'status', 'created_at', 'updated_at'
    ];

	//constructor
	public function __construct() {}
	/**
	* O acompanhamento semanal pertence a um único projeto
	*/
	public function projeto()
    {
        return $this->belongsTo('Projeto::class');
    }
}
