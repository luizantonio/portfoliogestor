<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSemanalTextosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semanal_textos', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('user_id')->index();									/* o user then create information */
			$table->integer('semanals_id')->index();								/* o acompanhamento associated the one valor */
			$table->text('descricao')->nullable()->collation('utf8_general_ci');	/* o acompanhamento terá um texto descricao */
			$table->tinyInteger('status')->default('0');							/* o status: was check in this week */
            $table->timestamps();													/* created and update date */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('semanal_textos');
    }
}
