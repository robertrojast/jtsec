<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToRolesUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roles_usuarios', function (Blueprint $table) {
            $table->foreign(['id_usuario'], 'roles_usuarios_usuario_id')->references(['id'])->on('usuarios')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['id_rol'], 'roles_usuarios_rol_id')->references(['id'])->on('roles')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roles_usuarios', function (Blueprint $table) {
            $table->dropForeign('roles_usuarios_usuario_id');
            $table->dropForeign('roles_usuarios_rol_id');
        });
    }
}
