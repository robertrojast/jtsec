<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\UsuariosModel;
use App\Models\UsuariosProyectosRolesModel;
use App\Models\RolesModel;

class UsuariosProyectosRolesTableSeeder extends Seeder
{

    /**
     * Datos que se van a insertar en la tabla
     */
    const TABLE_ROWS = [
        [
            'id_usuario'  => UsuariosModel::ID_USER_RESPONSABLE,
            'id_rol'      => RolesModel::ID_ROL_RESPONSABLE,
            'id_proyecto' => 1,
        ],
        [
            'id_usuario'  => UsuariosModel::ID_USER_PARTICIPANTE,
            'id_rol'      => RolesModel::ID_ROL_PARTICIPANTE,
            'id_proyecto' => 1,
        ],
        [
            'id_usuario'  => UsuariosModel::ID_USER_TODOS_LOS_ROLES,
            'id_rol'      => RolesModel::ID_ROL_RESPONSABLE,
            'id_proyecto' => 1,
        ],
        [
            'id_usuario'  => UsuariosModel::ID_USER_TODOS_LOS_ROLES,
            'id_rol'      => RolesModel::ID_ROL_PARTICIPANTE,
            'id_proyecto' => 1,
        ],
    ];

    /**
     * Ejecutamos el seeder
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks = 0");

        UsuariosProyectosRolesModel::truncate();

        UsuariosProyectosRolesModel::insert(self::TABLE_ROWS);

        DB::statement("SET foreign_key_checks = 1");
    }
}