<?php
// Setear la zona horaria a Ecuador
date_default_timezone_set('America/Guayaquil');

// Incluir la conexion con la BDD
include_once "conexion.php";

// Obtener los datos del formulario
$txtId = $_REQUEST['txtId'];


// Crear consulta SQL para actualziar un registro
$sql = "delete from variables where id = $txtId;";
// Ejecutar la sentencia de insert
$respuesta = $conn->query($sql);
// Verificar si todo fue bien
if ($respuesta == TRUE) {
    header("Location: index.php");
    die();
} else {
    echo "ERROR: " . $sql . "<br>" . $conn->error;
}

$conn->close();


