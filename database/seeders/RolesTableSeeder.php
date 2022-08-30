<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\RolesModel;

class RolesTableSeeder extends Seeder
{

    /**
     * Datos que se van a insertar en la tabla
     */
    const TABLE_ROWS = [
        [
            'id'     => RolesModel::ID_ROL_RESPONSABLE,
            'nombre' => 'Responsable',
        ],
        [
            'id'     => RolesModel::ID_ROL_PARTICIPANTE,
            'nombre' => 'Participante',
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

        RolesModel::truncate();

        RolesModel::insert(self::TABLE_ROWS);

        DB::statement("SET foreign_key_checks = 1");
    }
}