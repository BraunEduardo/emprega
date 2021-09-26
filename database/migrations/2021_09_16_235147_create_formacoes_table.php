<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formacoes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('instituicao');
            $table->string('curso');
            $table->string('situacao');
            $table->integer('pessoa_id');
            $table->foreign('pessoa_id')->references('id')->on('pessoas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('formacoes');
    }
}
