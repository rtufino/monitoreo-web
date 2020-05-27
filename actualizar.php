<?php
// Setear la zona horaria a Ecuador
date_default_timezone_set('America/Guayaquil');

// Incluir la conexion con la BDD
include_once "conexion.php";

// Obtener los datos del formulario
$txtId = $_REQUEST['txtId'];
$txtFecha = $_REQUEST['txtFecha'];
$txtTemp = $_REQUEST['txtTemp'];
$txtHum = $_REQUEST['txtHum'];
// Verificar si el checkbox tiene valor
if (isset($_REQUEST['chkEstado'])) {
    $chkEstado = 1;
} else {
    $chkEstado = 0;
}


// Crear consulta SQL para actualziar un registro
$sql = "update variables set fecha = '$txtFecha', 
        temperatura = $txtTemp, 
        humedad = $txtHum, 
        estado = $chkEstado
        where id = $txtId;";
// Ejecutar la sentencia de insert
$respuesta = $conn->query($sql);
// Verificar si todo fue bien
if ($respuesta == TRUE) {
    header("Location: editar.php?id=$txtId&ok=1");
    die();
} else {
    echo "ERROR: " . $sql . "<br>" . $conn->error;
}

$conn->close();


