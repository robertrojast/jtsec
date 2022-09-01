<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosProyectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios_proyectos', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_usuario')->index('upr_id_usuario');
            $table->integer('id_rol')->index('upr_id_rol');
            $table->integer('id_proyecto')->index('upr_id_proyecto');
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
        Schema::dropIfExists('usuarios_proyectos');
    }
}
