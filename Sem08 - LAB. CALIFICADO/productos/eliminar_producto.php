<?php

include('../conexion/conexion.php');

// obtenemos el id de productos.php
if (isset($_GET['IdProducto'])) {
  $IdProducto = $_GET['IdProducto'];
} else {
  header('Location: productos.php');
}


// abrimos conexion
$conexion = conectar();

// usamos prepared statement y eliminamos el prodcuto que tenga el mismo id del producto a eliminar
$query = $conexion->prepare("DELETE FROM producto WHERE IdProducto = ?");

// asociamos los valores con los parametros
$query->bind_param('i', $IdProducto);

// ejercutamos la consulta y damos un mensaje en el url
$msg = '';
if ($query->execute()) {
  $msg = 'Producto eliminado';
} else {
  $msg = 'No se pudo eliminar el producto';
}

// cerramos la conexión a la base de datos
desconectar($conexion);

// redirigir al usuario a la página de autores.php.
header('Location: productos.php?msg=' . urlencode($msg));
?>
