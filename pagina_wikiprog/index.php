<?php
// Va a incluir las funciones necesarias del archivo "funciones.php"
include("funciones.php");

// Va a requerir el archivo de configuración "config.php" que contiene los datos de conexión a la base de datos
require('config.php');

// Establece una conexión con la base de datos utilizando los valores de "config.php"
$conexion = mysqli_connect($host, $user, $password, $database);

// Obtiene el valor del parámetro "registrar_id" desde la URL para identificar al usuario
$registrar_id = $_GET['registrar_id'];
?>

<!-- Enlaces a otras páginas que utilizan el parámetro "registrar_id" -->
<a href="cursos.php?registrar_id=<?php echo $registrar_id?>">Cursos</a>
<a href="perfil.php?registrar_id=<?php echo $registrar_id?>">Perfil</a>
