<?php

function conectar(){
    $conexion = mysqli_connect('localhost','root','usbw','eval02');
    return $conexion;
}

function desconectar($conexion){
    mysqli_close($conexion);
}

?>