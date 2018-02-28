<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSemanalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semanals', function (Blueprint $table) {
            $table->increments('id');		
			$table->integer('projeto_id')->index();									/* o projeto associated */
			$table->text('descricao')->nullable()->collation('utf8_general_ci');	/* o acompanhamento terá um texto descricao */
			$table->tinyInteger('status')->default('0');							/* o status: was check in all weeks */
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
        Schema::dropIfExists('semanals');
    }
}
