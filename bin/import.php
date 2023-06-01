<?php

const STARSHIPS_CSV = "naves.csv";

/**
 * Modifica la primera línea del archivo csv "naves.csv" para evitar que 
 * el título de cada columna de la tabla contenga "results/".
 * Para ello sobrescribe el archivo, por ello no retorna nada.
 *
 * @author Oriol Gonzalo
 */ 
function fix_csv_header()
{
    $tmp_csv_handle = fopen('php://temp', 'r+');
    
    if ((is_writable(STARSHIPS_CSV)))
    {
        if (($csv_read_handle = fopen(STARSHIPS_CSV, "r+")) !== FALSE)
        {
            $first_line = true;
            while (($current_csv_line = fgetcsv($csv_read_handle, 1000, ";")) !== false) 
            {
                if($first_line) # Eliminamos "results/" de la primera línea del archivo csv
                {
                    $pattern = "/results\//";
                    $current_csv_line = preg_replace($pattern, '', $current_csv_line);
                    $first_line = false;
                }
                // El resto de líneas del csv las dejamos igual
                $current_csv_line_as_string = implode(';', $current_csv_line) . "\n";
                fwrite($tmp_csv_handle, $current_csv_line_as_string);
            }
            // Obtenemos los contenidos del archivo temporal
            rewind($tmp_csv_handle);
            $file_contents = stream_get_contents($tmp_csv_handle);
    
            // Sobreescribimos el archivo "../naves.csv" con los contenidos del archivo temporal
            fclose($csv_read_handle); # Cerramos el stream de lectura
            # Abrimos stream en modo escritura
            if (($csv_write_handle = fopen(STARSHIPS_CSV, "w")) !== FALSE)
            {
                fwrite($csv_write_handle, $file_contents);
                fclose($csv_write_handle);
            }
            fclose($tmp_csv_handle);
        }
    }
}

fix_csv_header(); # Nos deshacemos de cada aparición de "results/" en la primera línea del csv.

$output = NULL;
$retVal = NULL;

exec("sqlite3 ../starships.sqlite < import.sqlite", $output, $retVal); # Importamos el csv a la BBDD sqlite.

if ($retVal >= 1) # El programa no ha podido importar el archivo csv.
{
    echo "\nNO se ha podido importar el archivo \"" . STARSHIPS_CSV . "\" correctamente.\n";
    exit(1);
}
echo "Se ha importado el archivo \"" . STARSHIPS_CSV . "\" correctamente.\n";
exit(0); 