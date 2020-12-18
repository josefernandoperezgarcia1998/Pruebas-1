<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('a_paterno');
            $table->string('a_materno');
            $table->string('imagen');
            $table->string('email')->unique();
            $table->enum('rol', ['Supervisor', 'Encargado','Contador','Cliente'])->default('Cliente');
            $table->tinyInteger('activo')->default(0);
            $table->string('password');
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
        Schema::dropIfExists('usuarios');
    }
}
