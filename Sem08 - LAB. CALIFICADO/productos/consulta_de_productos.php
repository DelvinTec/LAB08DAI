<?php

include('../conexion/conexion.php');

// Abrimos la conexión a la BD
$conexion = conectar();

// Consulta a la BD
if (isset($_POST['botonbuscador'])) {
    $nombre = $_POST['Nombre'];
    $query = $conexion->prepare("SELECT IdProducto, Nombre, Descripcion, Stock, PrecioVenta FROM producto WHERE Nombre LIKE '%$nombre%'");
} else {
    $query = $conexion->prepare("SELECT IdProducto, Nombre, Descripcion, Stock, PrecioVenta FROM producto");
}

$query->execute();
$resultado = $query->get_result();


// Cerramos la conexión
desconectar($conexion);

?>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/9cdb1aeb59.js" crossorigin="anonymous"></script>
</head>
<body>
    

<div class="col-8 p-4">
    <table  class="table table-striped">
        <thead class="bg-secondary">
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Stock</th>
            <th scope="col">Precio de venta</th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
        <?php
            // Mostrar el set de los registros que hay en la BD
            while($producto = $resultado->fetch_assoc()){
                echo '<tr>';
                echo '<td>'.$producto['IdProducto'].'</td>';
                echo '<td>'.$producto['Nombre'].'</td>';
                echo '<td>'.$producto['Descripcion'].'</td>';
                echo '<td>'.$producto['Stock'].'</td>';
                echo '<td>'.$producto['PrecioVenta'].'</td>';
                echo '<td><a href="editar_producto.php?IdProducto='.$producto['IdProducto'].'" class="btn btn-small btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>';
                echo '<a href="eliminar_producto.php?IdProducto='.$producto['IdProducto'].'" class="btn btn-small btn-danger"><i class="fa-solid fa-trash"></i></a></td>';
                echo '</tr>';
            }
        ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>