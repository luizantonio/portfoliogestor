<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicoesaprendidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licoesaprendidas', function (Blueprint $table) {        
            /*$table->increments('id')->length(11)->uns igned()->autoIncrement()->primary();
            $table->integer('user_id')->length(10)->uns igned();
            $table->foreign('user_id')->references('id'   )->on('users');
            $table->integer('projeto_id')->length(10)->u   ns    gned();
            $table->foreign('projeto_id')->references('i   d')->on('projetos');
            $table->mediumText('licao')->nullable()->col  lation('utf8_general_ci');  
            $table->timestamps();*/
            $table->increments('id')->length(10);
            $table->integer('user_id')->length(10);
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('projeto_id')->length(10);
            $table->foreign('projeto_id')->references('id')->on('projetos');
            $table->mediumText('licao')->nullable()->collation('utf8_general_ci');  
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
        Schema::dropIfExists('licoesaprendidas');
    }
}
