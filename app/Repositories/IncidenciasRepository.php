<?php

    namespace App\Repositories;

    use App\Repositories\Repository;
    use Illuminate\Database\Eloquent\Collection;

    use App\Models\IncidenciasModel;
    use App\Models\UsuariosActividadesModel;
    use App\Models\UsuariosIncidenciasModel;

    use App\Repositories\ActividadesRepository;

    class IncidenciasRepository extends Repository {

        /**
         * Asigna una nueva incidencia a la actividad especificada (si ya existe una con el mismo nombre, la actualiza)
         *
         * @param Object $request       Valores de los campos del formulario
         * @return Bool
         */
        public static function NuevaIncidencia(Object $request) : Bool {
            $data              = $request->all();
            $id_actividad      = $data[FORM_FIELD_ID_ACTIVIDAD];
            $nombre_incidencia = $data[FORM_FIELD_NOMBRE_INCIDENCIA];

            // Comprobamos si existe una incidencia con el mismo nombre
            $incidencia = IncidenciasModel::where(IncidenciasModel::FIELD_NOMBRE, $nombre_incidencia)->first();

            // START - Si no existe, la creamos
            if(!$incidencia) {
                $incidencia = new IncidenciasModel();
            }
            // END - Si no existe, la creamos

            // START - Insertamos la configuración de la incidencia
            $incidencia->{ IncidenciasModel::FIELD_ID_ACTIVIDAD } = $id_actividad;
            $incidencia->{ IncidenciasModel::FIELD_NOMBRE }       = $nombre_incidencia;
            // END - Insertamos la configuración de la incidencia

            return $incidencia->save();
        }

        /**
         * Asigna un usuario a una incidencia (si ya estaba asignado, lo actualiza).
         *
         * @param Object $request       Valores de los campos del formulario
         * @return Bool
         */
        public static function NuevoUsuarioIncidencia(Object $request) : Bool {
            $data          = $request->all();
            $id_usuario    = $data[FORM_FIELD_ID_USUARIO];
            $id_incidencia = $data[FORM_FIELD_ID_INCIDENCIA];

            // Comprobamos si el usuario ya está asignado a la incidencia
            $usuario_incidencia = UsuariosIncidenciasModel::where(UsuariosIncidenciasModel::FIELD_ID_USUARIO, $id_usuario)
                ->where(UsuariosIncidenciasModel::FIELD_ID_INCIDENCIA, $id_incidencia)
                ->first();

            // START - SI NO ESTÁ ASIGNADO, LO AÑADIMOS
            if(!$usuario_incidencia) {
                $usuario_incidencia = new UsuariosIncidenciasModel();
            }
            // END - SI NO ESTÁ ASIGNADO, LO AÑADIMOS

            $usuario_incidencia->{ UsuariosIncidenciasModel::FIELD_ID_USUARIO }    = $id_usuario;
            $usuario_incidencia->{ UsuariosIncidenciasModel::FIELD_ID_INCIDENCIA } = $id_incidencia;

            return $usuario_incidencia->save();
        }

        /**
         * Obtiene el listado de todas las incidencias de la actividad especificada (si el usuario tiene rol "responsable" en la misma).
         *
         * @param Int $id_usuario
         * @param Int $id_actividad
         * @return Collection|null
         */
        public static function ListadoIncidenciasUsuario(Int $id_usuario, Int $id_actividad) : ?Collection {
            $incidencias = new Collection();

            // START - SI EL USUARIO ES RESPONSABLE DE LA ACTIVIDAD, PODRÁ CONSULTAR TODAS LAS INCIDENCIAS DE LA MISMA
            if(ActividadesRepository::usuarioEsResponsable($id_usuario, $id_actividad)) {
                $incidencias = IncidenciasModel::where(IncidenciasModel::FIELD_ID_ACTIVIDAD, $id_actividad)->get();
            }
            // END - SI EL USUARIO ES RESPONSABLE DE LA ACTIVIDAD, PODRÁ CONSULTAR TODAS LAS INCIDENCIAS DE LA MISMA

            return $incidencias;
        }
    }
