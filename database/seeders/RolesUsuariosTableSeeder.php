<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\UsuariosModel;
use App\Models\RolesUsuariosModel;
use App\Models\RolesModel;

class RolesUsuariosTableSeeder extends Seeder
{

    /**
     * Datos que se van a insertar en la tabla
     */
    const TABLE_ROWS = [
        [
            'id_usuario' => UsuariosModel::ID_USER_RESPONSABLE,
            'id_rol'     => RolesModel::ID_ROL_RESPONSABLE,
        ],
        [
            'id_usuario' => UsuariosModel::ID_USER_PARTICIPANTE,
            'id_rol'     => RolesModel::ID_ROL_PARTICIPANTE,
        ],
        [
            'id_usuario' => UsuariosModel::ID_USER_TODOS_LOS_ROLES,
            'id_rol'     => RolesModel::ID_ROL_RESPONSABLE,
        ],
        [
            'id_usuario' => UsuariosModel::ID_USER_TODOS_LOS_ROLES,
            'id_rol'     => RolesModel::ID_ROL_PARTICIPANTE,
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

        RolesUsuariosModel::truncate();

        RolesUsuariosModel::insert(self::TABLE_ROWS);

        DB::statement("SET foreign_key_checks = 1");
    }
}