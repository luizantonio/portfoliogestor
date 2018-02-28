<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformarIndicadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informar_indicators', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('user_id')->index();			/* o user then create information */
			$table->integer('user_id_up')->index()->nullable();/* o user then update information */
			$table->integer('fase_projeto_id')->index();	/* o indicador associated the one project */
			$table->integer('valor_minimo');				/* o indicador terá um valor esperado Mínimo */
			$table->integer('valor_maximo');				/* o indicador terá um valor esperado Máximo */
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
        Schema::dropIfExists('informar_indicadores');
    }
}
