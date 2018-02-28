<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipes', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('user_id')->index();				/* o indicador está associado a user	     */
			$table->integer('projeto_id')->index();				/* o indicador será associado a um projeto   */			
			$table->integer('membro_id')->index()->change();					/* o indicador terá um valor esperado Mínimo */
			
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
        Schema::dropIfExists('equipes');
    }
}
