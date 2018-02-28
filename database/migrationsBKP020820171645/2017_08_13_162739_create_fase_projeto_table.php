<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaseProjetoTable extends Migration
{
	#----------------------------------------------------------------------------------------------------------
	# fase_projeo serve para associar os indicadores das fases do projeto
	# são os indicadores
	#----------------------------------------------------------------------------------------------------------

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fase_projeto', function (Blueprint $table) { 
            $table->increments('id');                           /* o indicador terá um id */
			$table->integer('fase_id')->index();				/* o indicador está associado a fase	 */
			$table->integer('projeto_id')->index();				/* o indicador será associado a um projeto */	
			$table->integer('indicador_id')->index();			/* o indicador será associado a um projeto */			
			$table->smallInteger('valor_minimo');               /* o indicador terá um valor esperado Mínimo */
			$table->smallInteger('valor_maximo');              /* o indicador terá um valor esperado Máximo */
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
        Schema::dropIfExists('fase_projeto');
    }
}
