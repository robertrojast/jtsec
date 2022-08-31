<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUsuariosActividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usuarios_actividades', function (Blueprint $table) {
            $table->foreign(['id_rol'], 'ua_id_rol')->references(['id'])->on('roles')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['id_actividad'], 'ua_id_actividad')->references(['id'])->on('actividades')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['id_usuario'], 'ua_id_usuario')->references(['id'])->on('usuarios')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usuarios_actividades', function (Blueprint $table) {
            $table->dropForeign('ua_id_rol');
            $table->dropForeign('ua_id_actividad');
            $table->dropForeign('ua_id_usuario');
        });
    }
}
