<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolesModel extends Model
{
    protected $table      = TABLA_ROLES;
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
    | TABLE VALUES
    |--------------------------------------------------------------------------
    |
    */
    const ID_ROL_RESPONSABLE  = 1;
    const ID_ROL_PARTICIPANTE = 2;

    /*
    |--------------------------------------------------------------------------
    | FIELD NAMES
    |--------------------------------------------------------------------------
    |
    */

    const FIELD_ID         = 'id';
    const FIELD_NOMBRE     = 'nombre';
    const FIELD_CREATED_AT = 'created_at';
    const FIELD_UPDATED_AT = 'updated_at';

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

}
