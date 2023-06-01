<?php   

/**
 * Genera un array que representa la información de una fotografía,
 * esto es, una línea que será guardada en el archivo csv.
 *
 * @param array   $headers  Los campos de información de las imágenes
 * @param array $pic_info Contiene la información de la imagen en cuestión
 * 
 * @author Oriol Gonzalo
 * @return array $csv_line
 */ 
function obtain_csv_line($headers, $pic_info)
{
    $csv_line = [];
    foreach($headers as $header)
    {
        array_push($csv_line, $pic_info[$header]);
    }
    return $csv_line;
}

$response_as_json = file_get_contents('https://picsum.photos/v2/list?limit=75'); #Obtenemos la información de las primeras 75 fotos
$response_as_array = json_decode($response_as_json, true);
$csv_file_handle = fopen(__DIR__ . '/pics_info.csv', 'w');
$csv_delimiter = ';';

$response_headers = array_keys($response_as_array[0]); # Obtenemos los nombres de los campos (id, author, etc.)

foreach($response_as_array as $index => $pic_info) 
{
    if ($index === 0) # Guardamos los nombres de los campos en la primera línea del archivo.
    {
        fputcsv($csv_file_handle, $response_headers, $csv_delimiter);
    }
    $csv_line = obtain_csv_line($response_headers, $pic_info); # Obtenemos la línea a guardar. 
    fputcsv($csv_file_handle, $csv_line, $csv_delimiter); # Guardamos la información de la foto actual en el archivo csv.
}
fclose($csv_file_handle);