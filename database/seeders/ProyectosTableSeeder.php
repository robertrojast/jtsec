<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\ProyectosModel;

class ProyectosTableSeeder extends Seeder
{

    /**
     * Datos que se van a insertar en la tabla
     */
    const TABLE_ROWS = [
        [
            'id'     => 1,
            'nombre' => 'Proyecto 1',
        ],
        [
            'id'     => 2,
            'nombre' => 'Proyecto 2',
        ],
        [
            'id'     => 3,
            'nombre' => 'Proyecto 3',
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

        ProyectosModel::truncate();

        ProyectosModel::insert(self::TABLE_ROWS);

        DB::statement("SET foreign_key_checks = 1");
    }
}