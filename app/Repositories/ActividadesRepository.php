<?php

    namespace App\Repositories;

    use App\Repositories\Repository;
    use Illuminate\Database\Eloquent\Collection;

    use App\Models\UsuariosModel;
    use App\Models\ActividadesModel;
    use App\Models\UsuariosActividadesModel;
    use App\Models\RolesModel;

    use App\Repositories\ProyectosRepository;

    class ActividadesRepository extends Repository {

        /**
         * Asigna una nueva actividad al proyecto especificado (si ya existe una con el mismo nombre, la actualiza)
         *
         * @param Object $request       Valores de los campos del formulario
         * @return Bool
         */
        public static function NuevaActividad(Object $request) : Bool {
            $data             = $request->all();
            $id_proyecto      = $data[FORM_FIELD_ID_PROYECTO];
            $nombre_actividad = $data[FORM_FIELD_NOMBRE_ACTIVIDAD];

            // Comprobamos si existe una actividad con el mismo nombre
            $actividad = ActividadesModel::where(ActividadesModel::FIELD_NOMBRE, $nombre_actividad)->first();

            // START - Si no existe, la creamos
            if(!$actividad) {
                $actividad = new ActividadesModel();
            }
            // END - Si no existe, la creamos

            // START - Insertamos la configuración de la actividad
            $actividad->{ ActividadesModel::FIELD_ID_PROYECTO } = $id_proyecto;
            $actividad->{ ActividadesModel::FIELD_NOMBRE }      = $nombre_actividad;
            // END - Insertamos la configuración de la actividad

            return $actividad->save();
        }

        /**
         * Asigna un usuario a una actividad. Si ya está asignado, se actualiza su configuración.
         * Solo puede ser asignado si el usuario tiene el rol "participante" en el proyecto al que pertenece la actividad
         *
         * @param Object $request       Valores de los campos del formulario
         * @return Bool
         */
        public static function NuevoUsuarioActividad(Object $request) : Bool {
            $data         = $request->all();
            $id_usuario   = $data[FORM_FIELD_ID_USUARIO];
            $id_actividad = $data[FORM_FIELD_ID_ACTIVIDAD];
            $id_rol       = $data[FORM_FIELD_ID_ROL];

            // Obtenemos el id_proyecto de la actividad
            $actividad   = ActividadesModel::where(ActividadesModel::FIELD_ID, $id_actividad)->first();
            $id_proyecto = $actividad->{ ActividadesModel::FIELD_ID_PROYECTO };

            if(!ProyectosRepository::usuarioEsParticipanteEnProyecto($id_usuario, $id_proyecto)) {
                return FALSE;
            }

            // Comprobamos si el usuario ya está asignado a la actividad especificada
            $usuario_actividad = UsuariosActividadesModel::where(UsuariosActividadesModel::FIELD_ID_USUARIO, $id_usuario)
                ->where(UsuariosActividadesModel::FIELD_ID_ACTIVIDAD, $id_actividad)
                ->first();

            // START - Si no existe, lo creamos
            if(!$usuario_actividad) {
                $usuario_actividad = new UsuariosActividadesModel();
            }
            // END - Si no existe, lo creamos

            // START - Insertamos la configuración de la actividad
            $usuario_actividad->{ UsuariosActividadesModel::FIELD_ID_USUARIO }   = $id_usuario;
            $usuario_actividad->{ UsuariosActividadesModel::FIELD_ID_ACTIVIDAD } = $id_actividad;
            $usuario_actividad->{ UsuariosActividadesModel::FIELD_ID_ROL }       = $id_rol;
            // END - Insertamos la configuración de la actividad

            return $usuario_actividad->save();
        }

        /**
         * Obtiene el listado de actividades del usuario especificado.
         *
         * @param Int $id_usuario
         * @return object
         */
        public static function ListadoActividadesUsuario(Int $id_usuario) : Collection {
            $usuario             = UsuariosModel::where(UsuariosModel::FIELD_ID, $id_usuario)->first();
            $usuario_actividades = $usuario->{ UsuariosModel::FIELD_RELATIONSHIP_ACTIVIDADES };

            return $usuario_actividades;
        }

        /**
         * Comprueba si el usuario en cuestión es resposable de la actividad especificada.
         *
         * @param Int $id_usuario
         * @param Int $id_actividad
         * @return Bool
         */
        public static function usuarioEsResponsable(Int $id_usuario, Int $id_actividad) : Bool {
            $es_reponsable = UsuariosActividadesModel::where(UsuariosActividadesModel::FIELD_ID_USUARIO, $id_usuario)
                ->where(UsuariosActividadesModel::FIELD_ID_ACTIVIDAD, $id_actividad)
                ->where(UsuariosActividadesModel::FIELD_ID_ROL, RolesModel::ID_ROL_RESPONSABLE)
                ->count();

            return (Bool) $es_reponsable;
        }
    }
