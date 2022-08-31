<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUsuariosProyectosRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usuarios_proyectos_roles', function (Blueprint $table) {
            $table->foreign(['id_rol'], 'upr_id_rol')->references(['id'])->on('roles')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['id_proyecto'], 'upr_id_proyecto')->references(['id'])->on('proyectos')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['id_usuario'], 'upr_id_usuario')->references(['id'])->on('usuarios')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usuarios_proyectos_roles', function (Blueprint $table) {
            $table->dropForeign('upr_id_rol');
            $table->dropForeign('upr_id_proyecto');
            $table->dropForeign('upr_id_usuario');
        });
    }
}
