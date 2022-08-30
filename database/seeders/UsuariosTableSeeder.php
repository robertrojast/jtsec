<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\UsuariosModel;

class UsuariosTableSeeder extends Seeder
{

    /**
     * Datos que se van a insertar en la tabla
     */
    const TABLE_ROWS = [
        [
            'id'    => 1,
            'email' => 'responsable@prueba.com',
        ],
        [
            'id'    => 2,
            'email' => 'participante@prueba.com',
        ],
        [
            'id'    => 3,
            'email' => 'todos_los_roles@prueba.com',
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

        UsuariosModel::truncate();

        UsuariosModel::insert(self::TABLE_ROWS);

        DB::statement("SET foreign_key_checks = 1");
    }
}