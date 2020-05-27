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
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="agregar.html">Agregar</a>
                    </li>

                </ul>
            </div>
        </nav>
        <br>
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        Temperatura
                    </div>
                    <div class="card-body">
                        <figure class="highcharts-figure">
                            <div id="grafica-temperatura">
                                Aqui va la gráfica
                            </div>
                        </figure>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        Humedad
                    </div>
                    <div class="card-body">
                        <figure class="highcharts-figure">
                            <div id="grafica-humedad">
                                Aqui va la gráfica
                            </div>
                        </figure>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Tabla de valores
                    </div>
                    <div class="card-body">

                        <?php

                        // Setear la zona horaria a Ecuador
                        date_default_timezone_set('America/Guayaquil');

                        // Incluir la conexion con la BDD
                        include_once "conexion.php";

                        ?>
                        <table class="table table-striped" style="text-align: center;">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Id</th>
                                    <th>Fecha</th>
                                    <th>Temperatura</th>
                                    <th>Humedad</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Crear la sentencia de consulta SQL 
                                $sentencia = "select * from variables order by fecha DESC limit 10";
                                // Ejecutar la consulta y almacenar el resultado
                                $resultado = $conn->query($sentencia);
                                // Verificar si la consulta arrojó resultados
                                if ($resultado->num_rows > 0) {
                                    // recorrer todos los registros del resultado
                                    while ($registro = $resultado->fetch_assoc()) {
                                        // imprimir los resultados en la tabla
                                        if ($registro["temperatura"] < 10) {
                                            echo '<tr class="table-danger">';
                                        } else if ($registro["temperatura"] < 15) {
                                            echo '<tr class="table-warning">';
                                        } else {
                                            echo '<tr>';
                                        }

                                        echo "<td>" . $registro["id"] . "</td>";
                                        echo "<td>" . $registro["fecha"] . "</td>";
                                        echo "<td>" . $registro["temperatura"] . "</td>";
                                        echo "<td>" . $registro["humedad"] . "</td>";
                                        echo "<td>" . $registro["estado"] . "</td>";
                                        echo '<td>';
                                        echo '<a class="btn btn-primary btn-sm" href="editar.php?id=' . $registro["id"] . '">Editar</a> ';
                                        echo '<a class="btn btn-danger btn-sm" href="eliminar.php?id=' . $registro["id"] . '">Eliminar</a>';
                                        echo '</td>';
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "0 resultados";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

        </div>
    </div>

    <!-- Incluir librearias de javaScript -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/highcharts.js"></script>
    <script src="js/data.js"></script>
    <script src="js/exporting.js"></script>
    <script src="js/export-data.js"></script>
    <script src="js/accessibility.js"></script>
    <script src="js/graficas.js"></script>
</body>

</html>