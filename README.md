# digyna-CMS
Gestor administrador de contenido para páginas dinámicas e implementación de eCommerce.

## Cómo colaborar
Si estás interesado en colaborar en este proyecto, envia tus contribuciones o comentarios. Te invitamos a hacerlo, utilizando el sistema de issues de GitHub.
* En el repositorio se encuentra el archivo tasks.txt, en el se encuentra la lista de tareas para desarrollar.

## Licencia
Ya que es una aplicacción web en base al software libre, usted puede redistribuirlo bajo ciertas condiciones;
+ La firma de pie de página "Gracias por usar digyna-cms" junto con la versión, el hash y el enlace a la distribución original del código. DEBE SER RETENIDO, DEBE SER VISIBLE EN CADA PÁGINA Y NO PUEDE SER MODIFICADO.

[GNU General Public License version 3 (GPLv3)](https://github.com/digyna/digyna-CMS/blob/master/LICENSE)

## Instalacción
1. Crea una base de datos en mysql o mariadb.

2. Ejecuta el script database/database.sql para crear las tablas.

3. Si piensas en colaborar, crea un archivo application/config/.env del .env.example, salta hasta el paso 6.

4. Modifica application/config/database.php y configura los datos necesarios para conectarte a la base de datos.

5. Modifca application/config/config.php encryption key con uno propio.

6. ingresa en tu navegador http://localhost/digyna-cms/mypanel

7. Inicia sesión usando:  
* username: admin 
  
* password: digyna

9. ¿Algún fallo? Notifícalo utilizando el sistema de Issues de GitHub, detallando el fallo.
