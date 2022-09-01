<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

use App\Models\UsuariosProyectosModel;
use App\Models\RolesModel;

class ProyectosModel extends Model
{
    protected $table      = TABLA_PROYECTOS;
    protected $primaryKey = self::FIELD_ID;

    /**
     * Specifing which fields is mass-assignable in this model
     *
     * @var array
     */
    protected $fillable   = [
        self::FIELD_ID
    ];

    /*
    |--------------------------------------------------------------------------
    | FIELD NAMES
    |--------------------------------------------------------------------------
    |
    */

    const FIELD_ID            = 'id';
    const FIELD_NOMBRE        = 'nombre';
    const FIELD_PARTICIPANTES = 'participantes';
    const FIELD_CREATED_AT    = 'created_at';
    const FIELD_UPDATED_AT    = 'updated_at';

    /*
    |--------------------------------------------------------------------------
    | TABLES RELATIONSHIPS NAMES
    |--------------------------------------------------------------------------
    |
    */

    const FIELD_RELATIONSHIP_USUARIOS = 'usuarios';

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    |
    */

    public function getIdAttribute() : Int {
        return (Int) $this->attributes[self::FIELD_ID];
    }

    public function getNombreAttribute() : String {
        return (String) $this->attributes[self::FIELD_NOMBRE];
    }

    public function getParticipantesAttribute() : Collection {
        $id_proyecto = $this->attributes[self::FIELD_ID];

        $participantes = UsuariosProyectosModel::select(UsuariosProyectosModel::FIELD_ID_USUARIO)
            ->where(UsuariosProyectosModel::FIELD_ID_ROL, RolesModel::ID_ROL_PARTICIPANTE)
            ->where(UsuariosProyectosModel::FIELD_ID_PROYECTO, $id_proyecto)
            ->get();

        return $participantes;
    }

    public function getCreatedAtAttribute() : String {
        return (String) $this->attributes[self::FIELD_CREATED_AT];
    }

    public function getUpdatedAtAttribute() : String {
        return (String) $this->attributes[self::FIELD_UPDATED_AT];
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    |
    */

    public function setIdAttribute(Int $value) {
        $this->attributes[self::FIELD_ID] = $value;
    }

    public function setNombreAttribute(String $value) {
        $this->attributes[self::FIELD_NOMBRE] = $value;
    }

    public function setCreatedAtAttribute(String $value) {
        $this->attributes[self::FIELD_CREATED_AT] = $value;
    }

    public function setUpdatedAtAttribute(String $value) {
        $this->attributes[self::FIELD_UPDATED_AT] = $value;
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    |
    */

    public function usuarios() {
        return $this->hasMany(UsuariosProyectosModel::class, UsuariosProyectosModel::FIELD_ID_PROYECTO, self::FIELD_ID);
    }

}
