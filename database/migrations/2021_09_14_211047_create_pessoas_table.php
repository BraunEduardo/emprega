<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePessoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('nome');
            $table->string('cpf', 15);
            $table->string('telefone', 15);
            $table->string('email');
            $table->date('nascimento');
            $table->string('grau_ensino');
            $table->integer('municipio_id');
            $table->foreign('municipio_id')->references('id')->on('municipios');
            $table->string('estado_civil');
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
        Schema::dropIfExists('pessoas');
    }
}
