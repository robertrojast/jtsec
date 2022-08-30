<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsuariosModel extends Model
{
    protected $table      = TABLA_USUARIOS;
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
    const ID_USER_RESPONSABLE     = 1;
    const ID_USER_PARTICIPANTE    = 2;
    const ID_USER_TODOS_LOS_ROLES = 3;

    /*
    |--------------------------------------------------------------------------
    | FIELD NAMES
    |--------------------------------------------------------------------------
    |
    */

    const FIELD_ID         = 'id';
    const FIELD_EMAIL      = 'email';
    const FIELD_CREATED_AT = 'created_at';
    const FIELD_UPDATED_AT = 'updated_at';

    /*
    |--------------------------------------------------------------------------
    | TABLES RELATIONSHIPS NAMES
    |--------------------------------------------------------------------------
    |
    */

    // const FIELD_RELATIONSHIP_FAMILIES = 'families';

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    |
    */

    public function getIdAttribute() : Int {
        return (Int) $this->attributes[self::FIELD_ID];
    }

    public function getEmailAttribute() : String {
        return (String) $this->attributes[self::FIELD_EMAIL];
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

    public function setEmailAttribute(String $value) {
        $this->attributes[self::FIELD_EMAIL] = $value;
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

}
