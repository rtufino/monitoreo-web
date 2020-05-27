<?php
// Setear la zona horaria a Ecuador
date_default_timezone_set('America/Guayaquil');

// Incluir la conexion con la BDD
include_once "conexion.php";

// Obtener los datos del formulario
$txtTemp = $_REQUEST['txtTemp'];
$txtHum = $_REQUEST['txtHum'];
// Verificar si el checkbox tiene valor
if (isset($_REQUEST['chkEstado'])) {
    $chkEstado = 1;
} else {
    $chkEstado = 0;
}

// Obtener la fecha
$fecha = date('Y-m-d H:i:s');

// Crear consulta SQL para insertar un registro
$sql = "insert into variables (fecha, temperatura, humedad, estado)
        values ('$fecha', $txtTemp, $txtHum, $chkEstado)";
// Ejecutar la sentencia de insert
$respuesta = $conn->query($sql);
// Verificar si todo fue bien
if ($respuesta == TRUE) {
    echo "Ok";
    //header("Location: exito.html");
    //die();
} else {
    echo "ERROR: " . $sql . "<br>" . $conn->error;
}

$conn->close();


