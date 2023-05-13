<?php 

include('../conexion/conexion.php');

// Abrimos la conexión a la BD
$conexion = conectar();

// Consulta a la BD con prepared statement
$query = $conexion->prepare("SELECT IdProducto, Nombre, Descripcion, Stock, PrecioVenta FROM producto");
$query->execute();
$resultado = $query->get_result();

// Cerramos la conexion
desconectar($conexion);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/9cdb1aeb59.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-dark block-top bg-warning flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="../index.html"><h1>CRUD - Laboratorio 8</h1></a>
    </nav>
    <h1 class="text-center p-3">CRUD - Productos</h1>
    
    <div class="container-fluid row">
        <!-- Este es el formulario para registrar nuevos productos -->
    <form  action="agregar_producto.php" name="formulario" method="post" class="col-4 p-3">
        <h3 class="text-center text-secondary">Registro de Productos</h3>
        <div class="mb-3">
            <label for="" class="form-label">Nombre del Producto</label>
            <input type="text" class="form-control" name="Nombre" required>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Descripción</label>
            <input type="text" class="form-control" name="Descripcion" required>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Stock</label>
            <input type="text" class="form-control" name="Stock" required>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Precio de Venta</label>
            <input type="number" class="form-control" placeholder="Hasta 3 decimales" step="0.001" name="PrecioVenta" required>
        </div>
        <button type="submit" class="btn btn-primary" name="botonregistrar" value="Ok">Registrar</button>
        
    </form>
    
    
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
    <!-- Este es el formulario para buscar los productos, te lleva a consulta_de_productos.php y halla los productos que tienen el texto insertado -->
    <form  action="consulta_de_productos.php" name="buscador" method="post" class="col-4 p-3">
        <h3 class="text-center text-secondary">Buscador de productos</h3>
        <div class="mb-3">
            <label for="" class="form-label">Nombre del Producto</label>
            <input type="text" class="form-control" name="Nombre" required>
        </div>
        <button type="submit" class="btn btn-secondary" name="botonbuscador" value="Ok"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>