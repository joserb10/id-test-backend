## Deploy localhost

1. Para correr la aplicación se necesita primero clonar el repositorio el cual contiene ya un archivo .env definido, en el cual está establecido la conexión a la base de datos.

2. El driver de base de datos que se utiliza es Mysql, la base de datos `id_test`, usuario `root`, y password vacío, si desea puede modificar estos datos antes de ejecutar la migración.

3. Se debe de crear la base de datos que se indica en el .env con el mismo nombre, utilizando xampp, wamp, laragon, etc.

4. Ejecutar el comando `composer install` en el proyecto para descargar todas las dependencias y librerías.

5. Ejecutar el comando `php artisan passport:install` para generar los clientes de autenticación.

6. Ejecutar el comando `php artisan migrate` para generar todas las tablas en la BD.

7. Ejecutar el comando `php artisan passport:client --personal` para poder generar los access tokens de los usuarios.

8. Finalmente ya se puede ejecutar el servidor para correr la aplicación con `php artisan serve` que necesariamente tiene que correr en el puerto 8000 porque el frontend hace request a `http://127.0.0.1:8000` como url base.

9. Para que se ejecute el envío de correos por colas se debe de ejecutar el comando `php artisan queue:work` que empezará a ejecutar el job de envío de corres.


