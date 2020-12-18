<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreguntasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preguntas', function (Blueprint $table) {
            $table->id();
            $table->text('pregunta');
            $table->string('respuesta')->nullable();
            // $table->tinyInteger('repuesta_id')->nullable()
            $table->unsignedbigInteger('quien_p');
            $table->timestamp('hora_p');
            $table->foreignId('producto_id')->references('id')->on('productos')->nullable();


            $table->foreign('quien_p')->references('id')->on('usuarios');

            $table->timestamp('p_autorizada')->nullable();
            $table->timestamp('r_autorizada')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('preguntas');
    }
}
