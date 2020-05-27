<?php

// Setear la zona horaria a Ecuador
date_default_timezone_set('America/Guayaquil');

// Incluir la conexion con la BDD
include_once "conexion.php";

// Crear la sentencia de consulta SQL 
$sentencia = "select * from variables order by fecha DESC limit 10";
// Ejecutar la consulta y almacenar el resultado
$resultado = $conn->query($sentencia);
// Verificar si la consulta arrojó resultados
if ($resultado->num_rows > 0) {
    // recorrer todos los registros del resultado
    echo "Tiempo, Value\n";
    while ($registro = $resultado->fetch_assoc()) {
        echo $registro["fecha"] . "," . $registro["humedad"] . "\n"; 
    }
}
