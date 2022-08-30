<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUsuariosIncidenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usuarios_incidencias', function (Blueprint $table) {
            $table->foreign(['id_usuario'], 'ui_id_usuario')->references(['id'])->on('usuarios')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['id_incidencia'], 'ui_id_incidencia')->references(['id'])->on('incidencias')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usuarios_incidencias', function (Blueprint $table) {
            $table->dropForeign('ui_id_usuario');
            $table->dropForeign('ui_id_incidencia');
        });
    }
}
