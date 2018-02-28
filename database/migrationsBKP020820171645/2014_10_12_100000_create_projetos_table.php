<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjetosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projetos', function (Blueprint $table) {
            $table->increments('id');                       // o indice (ID)
			$table->integer('user_id')->index();            // o projeto pertence a um usuário
			$table->string('nome');						    // o projeto tem um nome
			$table->date('data_de_inicio');                 // o projeto tem uma data de início
			$table->string('gerente_responsavel');          // o projeto tem um nome de gerente responsável
			$table->date('previsao_de_termino');            // o projeto tem uma data de previsão de termino
			$table->date('data_real_de_termino');           // o projeto tem uma data real de termino
			$table->string('orcamento_total');              // o projeto tem um custo total
			$table->string('descricao');                    // o projeto tem uma descrição
			$table->integer('status_id')->index();          // o projeto tem uma fase (Ex.: Planejamento)
			$table->integer('classificacao_id')->index();   // o projeto tem uma classificação (Ex.: Alto risco)
            $table->timestamps();                           // o projeto tem data de criação e alteração
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projetos');
    }
}
