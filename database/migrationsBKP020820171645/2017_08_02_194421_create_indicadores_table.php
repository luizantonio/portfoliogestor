<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndicadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('indicadores', function (Blueprint $table) {*/
            $table->increments('id');              /* o indicador terá um id */
			$table->integer('user_id')->index();   /* o indicador será associado a um membro da equipe (lider do ecr. de proj.) */			
			$table->string('nome', 255);           /* o indicador terá um nome */			
            $table->timestamps();                  /* o projeto tem data de criação e alteração */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indicadores');
    }
}
