<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssociacaoFaseIndicadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		// Cria uma associação entre uma fase (status) a um indicador
        Schema::create('associacao_fase_indicadores', function (Blueprint $table) {
            $table->increments('id');			
			$table->integer('projeto_id')->index()->nullable(); /* associação com um projeto */
			$table->integer('indicador_id')->index();           /* indicador associado	     */
			$table->integer('fase_id')->index()->nullable();	/* fase (status) associada	 */
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
        Schema::dropIfExists('fase_indicadores');
    }
}
