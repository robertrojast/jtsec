<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\UsuariosModel;

class UsuariosIncidenciasModel extends Model
{
    protected $table      = TABLA_USUARIOS_INCIDENCIAS;
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
    const FIELD_ID_USUARIO    = 'id_usuario';
    const FIELD_ID_INCIDENCIA = 'id_incidencia';
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

    public function getIdUsuarioAttribute() : Int {
        return (Int) $this->attributes[self::FIELD_ID_USUARIO];
    }

    public function getIdIncidenciaAttribute() : Int {
        return (Int) $this->attributes[self::FIELD_ID_INCIDENCIA];
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

    public function setIdUsuarioAttribute(Int $value) {
        $this->attributes[self::FIELD_ID_USUARIO] = $value;
    }

    public function setIdIncidenciaAttribute(Int $value) {
        $this->attributes[self::FIELD_ID_INCIDENCIA] = $value;
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
        return $this->hasMany(UsuariosModel::class, UsuariosModel::FIELD_ID, self::FIELD_ID_USUARIO);
    }
}
