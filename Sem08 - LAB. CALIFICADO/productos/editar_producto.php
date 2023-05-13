<?php

include('../conexion/conexion.php');

// obtenemos el id desde productos.php o consulta_de_productos.php, si no llega el id, se queda el productos.php
if (isset($_GET['IdProducto'])) {
  $IdProducto = $_GET['IdProducto'];
} else {
  header('Location: productos.php');
}

// Vemos si se envió el formulario para editar el producto
if (isset($_POST['submit'])) {
  // obtenemos los datos del formulario de productos
  $Nombre = $_POST['Nombre'];
  $Descripcion = $_POST['Descripcion'];
  $Stock = $_POST['Stock'];
  $PrecioVenta = $_POST['PrecioVenta'];

  // abrimos la conexion
  $conexion = conectar();

  // preparamos la consulta con prepared statement, esta es de edicion
  $query = $conexion->prepare("UPDATE producto SET Nombre = ?, Descripcion = ?, Stock = ?, PrecioVenta = ? WHERE IdProducto = ?");

  // asociamos los valores con los parametros usando bind_param
  $query->bind_param('ssiii', $Nombre, $Descripcion, $Stock, $PrecioVenta, $IdProducto);

  // ejecutamos la consulta
  $msg = '';
  if ($query->execute()) {
    $msg = 'Producto actualizado';
  } else {
    $msg = 'No se pudo actualizar el Producto';
  }

  // cerramos conexion
  desconectar($conexion);

  // redirigimos a productos.php.
  header('Location: productos.php?msg=' . urlencode($msg));
}

// obtenemos los datos del producto para mostrar en el formulario
$conexion = conectar();
$query = $conexion->prepare("SELECT Nombre, Descripcion, Stock, PrecioVenta FROM producto WHERE IdProducto = ?");
$query->bind_param('i', $IdProducto);
$query->execute();
$query->bind_result($Nombre, $Descripcion, $Stock, $PrecioVenta);
$query->fetch();
desconectar($conexion);

?>

<!DOCTYPE html>
<html>
<head>
  <title>Editar Producto</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
  <h1>Editar Producto</h1>
  <form method="post" class="col-4 p-3">
    <h3 class="text-center text-secondary">Edición de Productos</h3>
    <label class="form-label">Nombre:</label>
    <input type="text" class="form-control" name="Nombre" maxlength="80" value="<?php echo $Nombre; ?>" required><br><br>
    <label class="form-label">Descripcion:</label>
    <input type="text" class="form-control" name="Descripcion" maxlength="250" value="<?php echo $Descripcion; ?>" required><br><br>
    <label class="form-label">Stock:</label>
    <input type="number" class="form-control" name="Stock" value="<?php echo $Stock; ?>"><br><br>
    <label class="form-label">Precio de Venta:</label>
    <input type="number" placeholder="Hasta 3 decimales" step="0.001" class="form-control" name="PrecioVenta" value="<?php echo $PrecioVenta; ?>"><br><br>
    

    <input type="submit" class="btn btn-primary" name="submit" value="Actualizar">
  </form>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>
