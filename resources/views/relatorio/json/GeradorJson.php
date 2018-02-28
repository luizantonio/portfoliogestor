<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeradorJson extends Model
{
   public static function f()
  {
    $inner = function()
    {
      self::solicitacoes();
    };
    $inner();
  }
  private static function solicitacoes()
  {
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");   
     
 
    $json = array('Erro' => utf8_encode('Não comtém Solicitações!') );
    $_json = json_encode($json);
  
    echo($_json);
  }
}
RetornaSolicitacoes::f();

