<?php
include("funciones.php");
require('config.php');

$conexion = mysqli_connect($host, $user, $password, $database);

$registrar_id = $_GET['registrar_id'];

if (borrar($conexion, $registrar_id)) {
    echo "Usuario eliminado con éxito.";
} else {
    echo "No se pudo eliminar el usuario.";
}

mysqli_close($conexion);

?>
