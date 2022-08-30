**MANUAL DE INSTALACIÓN**

1. La aplicación está hecha en LARAVEL. Para poder instalarla, deberá tener instalado en su equipo COMPOSER. [Página oficial composer](https://getcomposer.org/download/)

2. Instale el proyecto. Desde el terminal (dentro del directorio de instalación) ejecute:

   ```bash
   composer install
   ```

3. Debe crear la base de datos **"jstec"** en su servidor de MYSQL y configurar la conexión con la misma en el fichero .env del proyecto

4. Ejecute el siguiente comando para crear las tablas de la base de datos:

   ```bash
   php artisan migrate
   ```

5. Ejecute el siguiente comando para añadir los datos de prueba en la base de datos:

   ```bash
   php artisan db:seed
   ```

6. Ejecute el siguiente comando ejecutar todos los tests unitarios de la aplicación:

   ```bash
   php artisan test
   ```
