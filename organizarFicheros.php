<?php

// Define el directorio base en el escritorio y el nombre de la carpeta de destino
$desktop = getenv('USERPROFILE') . '\Desktop';
$destDir = $desktop . '\ficheros_organizados_por_fecha';

// Crea la carpeta de destino si no existe
if (!is_dir($destDir)) {
    mkdir($destDir);
}

// Obtén la lista de todos los archivos en el directorio actual
$dir = '.';
$files = array_diff(scandir($dir), array('..', '.', basename(__FILE__)));  // Excluir el directorio actual, el superior y este mismo script.

foreach ($files as $file) {
    // Asegurarse de que sea un archivo y no una carpeta
    if (is_file($file)) {
        // Obtén la fecha de creación del archivo
        $creationDate = filectime($file);
        $folderName = date('Y-m-d', $creationDate);
        $subDir = $destDir . '\\' . $folderName;

        // Si el subdirectorio no existe en la carpeta de destino, créalo
        if (!is_dir($subDir)) {
            mkdir($subDir);
        }

        // Copia el archivo al directorio correspondiente en la carpeta de destino
        copy($file, $subDir . '\\' . $file);
    }
}

echo "¡Archivos copiados y organizados por fecha de creación en el escritorio!";

?>