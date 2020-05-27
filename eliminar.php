<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-with, initial-scale=1">
    <title>Control de Ambiente</title>
    <!-- Incluir los estilos de Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <span class="navbar-brand mb-0 h1">Control Ambiental</span>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="agregar.html">Agregar <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
            </div>
        </nav>
        <br>
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        Eliminar un registro
                    </div>
                    <div class="card-body">
                        <?php
                        // Setear la zona horaria a Ecuador
                        date_default_timezone_set('America/Guayaquil');

                        // Incluir la conexion con la BDD
                        include_once "conexion.php";

                        // Obtener los datos del formulario
                        $id = $_REQUEST['id'];

                        // si se recibe la variable ok
                        if (isset($_REQUEST['ok'])) {
                            echo '<div class="alert alert-success" role="alert">';
                            echo 'Registro actualizado exitosamente!';
                            echo '</div>';
                        }
                        
                        // Consultar los datos de este registro SQL
                        $sentencia = "select * from variables where id = $id";
                        // Ejecutar la consulta y almacenar el resultado
                        $resultado = $conn->query($sentencia);

                        // Obtener el registro
                        $registro = $resultado->fetch_assoc();

                        $check = "";
                        // Validar si el registro está activo
                        if ($registro["estado"] == 1){
                            $check = "checked";
                        }

                        ?>
                        <div class="alert alert-danger" role="alert">
                            ¿Está seguro que desea eliminar el siguiente registro?
                        </div>
                        <form method="POST" action="suprimir.php">
                            <input type="hidden" name="txtId" value="<?php echo $id; ?>">
                            <ul>
                                <li>Id: <?php echo $registro["id"]; ?></li>
                                <li>Fecha: <?php echo $registro["fecha"]; ?></li>
                                <li>Tempertura: <?php echo $registro["temperatura"]; ?></li>
                                <li>Humedad: <?php echo $registro["humedad"]; ?></li>
                                <li>Estado: <?php echo $registro["estado"]; ?></li>
                            </ul>
                            <button type="submit" class="btn btn-danger">Eliminar</button> 
                            <a href="index.php" class="btn btn-secondary">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Incluir librearias de javaScript -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>