<?php
// Setear la zona horaria a Ecuador
date_default_timezone_set('America/Guayaquil');

// Incluir la conexion con la BDD
include_once "conexion.php";

// Obtener los datos del Node ESP8266
$temp = $_REQUEST['temp'];
$hum = $_REQUEST['hum'];
$code = $_REQUEST['code'];
$estado = 1;


if ($code == "5447eb73757c3c007d675ee1d79d2762") {

    // Obtener la fecha
    $fecha = date('Y-m-d H:i:s');

    // CAlcular indicador
    $dht = $temp / (0.39 * $hum);

    // Crear consulta SQL para insertar un registro
    $sql = "insert into variables (fecha, temperatura, humedad, estado, dht)
        values ('$fecha', $temp, $hum, $estado, $dht)";
    // Ejecutar la sentencia de insert
    $respuesta = $conn->query($sql);

    // Verificar si todo fue bien
    if ($respuesta == TRUE) {
        echo "Registro agregado con éxito!";
    } else {
        echo "ERROR: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}else {
    echo "codigo del dispositivo incorrecto!";
}
