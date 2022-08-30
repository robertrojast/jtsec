<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUsuariosProyectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usuarios_proyectos', function (Blueprint $table) {
            $table->foreign(['id_usuario'], 'up_id_usuario')->references(['id'])->on('usuarios')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['id_proyecto'], 'up_id_proyecto')->references(['id'])->on('proyectos')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usuarios_proyectos', function (Blueprint $table) {
            $table->dropForeign('up_id_usuario');
            $table->dropForeign('up_id_proyecto');
        });
    }
}
