<?php

include('../conexion/conexion.php');

// Obtenemos los valores del formulario
$Nombre = $_POST['Nombre'];
$Descripcion = $_POST['Descripcion'];
$Stock = $_POST['Stock'];
$PrecioVenta = $_POST['PrecioVenta'];

// Abrimos la conexión a la base de datos
$conexion = conectar();

// Consulta a la base de datos
$query = $conexion->prepare("INSERT INTO producto (Nombre, Descripcion, Stock, PrecioVenta) VALUES (?,?,?,?)");
$query->bind_param('ssii', $Nombre, $Descripcion, $Stock, $PrecioVenta); //match tipo de dato con el dato
$msg = '';
if ($query->execute()){
    $msg = 'producto registrado';
}
else {
    $msg = 'No se pudo registrar el producto';
}
header('Location: productos.php?msg=' . urlencode($msg));

// Cerramos la conexión a la BD
desconectar($conexion);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso Producto</title>
</head>
<body>
    <h1>Ingreso Producto</h1>
    <h3><?php echo $msg ?></h3>
    <a href="productos.php" class="btn btn-primary">Regresar</a>

</body>
</html>