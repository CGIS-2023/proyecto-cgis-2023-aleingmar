# Plantilla de proyecto CGIS

Esta es una descripción por defecto de **ProyectoPrueba**. Aquí deberá aparecer la descripción que también aparezca en el documento


## Instrucciones para su uso
1. Clone desde Visual Studio Code (o cualquier IDE de su preferencia) este repositorio.
2. Necesitamos un archivo de entorno `.env` para que nuestra aplicación sepa cómo conectarse a la base de datos y otros parámetros de configuración. Sin embargo, como el archivo `.env` contiene información sensible, como contraseñas, y la configuración depende del equipo, no se suele subir al repositorio (poniendo en `.gitignore` el archivo para que Git no lo considere). En su lugar, hemos subido un ejemplo `.env.example` con valores de ejemplo para los diferentes parámetros. En este caso, los valores de ejemplo son exactamente los mismos que necesitamos para trabajar con sail, así que tendremos que duplicar el archivo `.env.example`, copiándolo y pegándolo en el mismo directorio, y llamándolo `.env`
3. Arrancamos el contenedor de Sail por primera vez `docker run --rm \
   -u "$(id -u):$(id -g)" \
   -v $(pwd):/var/www/html \
   -w /var/www/html \
   laravelsail/php81-composer:latest \
   composer install --ignore-platform-reqs`. Más info: https://laravel.com/docs/master/sail#installing-composer-dependencies-for-existing-projects.
4. Ahora que tenemos disponible la carpeta de vendor, levante Laravel Sail desde Window Terminal (el terminal de la máquina Host Linux) `./vendor/bin/sail up -d` o `sail up -d` si ha realizado el alias de bash.
5. Abra en el navegador `http://localhost`

Recuerde que los comandos como `php artisan xxx` que vea en la documentación, deberán realizarse con `./vendor/bin/sail artisan comandoAEjecutar` o `sail artisan comandoAEjecutar` si ha activado el alias en bash, ya necesitan el entorno de desarrollo con MySQL, PHP, etc., que se encuentra en el contenedor de Sail. Si no, siempre podrá asociar un terminal directamente desde VSCode al contenedor de Sail para otras operaciones que deban ejecutarse en el servidor web que corre dentro del contenedor.

Cuando termine de trabajar, ejecute `./vendor/bin/sail down` o `sail down` si ha activado el alias en bash para parar la ejecución del contenedor. Recuerde que para volver a encenderlo necesitará ejecutar `./vendor/bin/sail up -d` o `sail up -d ` si ha activado el alias en bash desde el terminal de la máquina Host (Linux).

## Herramienta para escribir lenguaje de marcado
https://www.markdownguide.org/basic-syntax/ describe cómo se utiliza el markdown.

[StackEdit](https://stackedit.io/app#) puede ayudaros a trabajar con lenguajes de marca (markdown) para escribir este README.md
> Prueba las posibilidades antes de **Subir** cambios al repositorio.




