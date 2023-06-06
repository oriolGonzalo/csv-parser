# CSV parser: 

### 1 - Carga de un fichero CSV en una base de datos

* Partimos del archivo **naves.csv**.
* Para importar el fichero CSV a la base de datos sqlite, debemos dirigirnos al directorio ```/bin``` y desde ahí ejecutar el siguiente comando:

```$ php -f import.php```

  * Se editará el archivo CSV para eliminar "results/" de la primera línea del archivo
  * Se importarán los datos del archivo a la base de datos starships.sqlite

  Nota: El archivo de base de datos resultante lo podréis encontrar en el directorio raíz del proyecto

### 1.1 - Visualización de los datos en el navegador

* Para consultar los datos almacenados en el archivo sqlite desde el navegador, iniciamos el servidor de php con el siguiente comando:

```$ php -S localhost:3000```

  Nota: No es necesario especificar un archivo de inicio porque el router de la aplicación se encuentra en el archivo de inicio index.php.

* Abrimos un navegador y accedemos al proyecto escribiendo:

```localhost:3000```

* Visualizaremos en el navegador un listado con información resumida de todos los registros. 

### 1.2 - Operaciones sobre los datos desde el navegador

* Para cada registro podremos llevar a cabo, desde la columna "acciones" las siguientes operaciones:

  * Ver detalle del registro en otra pagina

  * Eliminar ese registro

* También podremos añadir un nuevo registro pulsando el botón que se encuentra en la parte superior izquierda, justo encima de la tabla.

  * Seremos desviados a otra página en la que podremos cumplimentar un formulario para añadir la nave.

  * Para comprobar que la nave ha sido añadida tan solo tendremos que volver a la página de inicio de la aplicación escribiendo:

  ```localhost:3000```

## 2. Descargar datos de una API Publica y convertir a CSV

* Utilizaremos la API de [PICSUM](https://picsum.photos/).
* Para ejecutar el programa, nos dirigirnos al directorio ```/bin``` y desde ahí ejecutamos el siguiente comando:

```$ php -f storePicsInfoToCsv.php```

* El script generará un archivo CSV en el mismo directorio ```bin```.