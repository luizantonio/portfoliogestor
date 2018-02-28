<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusModificadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statusmodificados', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('user_id')->index();
			$table->integer('projeto_id')->index();
			$table->integer('status_id')->index();
			$table->string('justificativa_analise_aprovada');
			$table->string('justificativa_cancelado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statusmodificados');
    }
}
