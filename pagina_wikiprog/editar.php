<?php
// Incluye las funciones necesarias del archivo "funciones.php"
include("funciones.php");

// Requiere el archivo de configuración "config.php" que contiene los datos de conexión a la base de datos
require('config.php');

// Establece una conexión con la base de datos utilizando los valores de "config.php"
$conexion = mysqli_connect($host, $user, $password, $database);

// Obtiene el valor del parámetro "registrar_id" desde la URL para identificar al usuario
$registrar_id = $_GET['registrar_id'];

// Verifica si se ha enviado un formulario de edición mediante una solicitud GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    // Recopila los datos del formulario, si están disponibles en la URL
    $usuario = isset($_GET['usuario']) ? $_GET['usuario'] : '';
    $correo = isset($_GET['correo']) ? $_GET['correo'] : '';
    $contraseña = isset($_GET['contraseña']) ? $_GET['contraseña'] : '';
    $biografia = isset($_GET['biografia']) ? $_GET['biografia'] : '';

    // Comprueba si alguno de los datos está vacío antes de realizar las actualizaciones
    if (!empty($usuario) || !empty($correo) || !empty($contraseña) || !empty($biografia)) {
        // Realiza la actualización en la base de datos
        $actualizar = editarUsuario($conexion, $registrar_id, $usuario, $correo, $contraseña, editarBiografia($conexion, $registrar_id, $biografia));

        if ($actualizar) {
            echo "Usuario actualizado con éxito.";
            header("Location: perfil.php?registrar_id=" . $registrar_id);
        } else {
            echo "Error al actualizar el usuario.";
        }
    } else {
        echo "No se han proporcionado datos para actualizar.";
    }
}

// Obtiene información sobre el usuario y su biografía
$resultados = "<br>" . consulta_ID($conexion, $registrar_id);
$resultados .= biografia($conexion, $registrar_id);

// Cierra la conexión a la base de datos
mysqli_close($conexion);

// Muestra los resultados
echo $resultados;
?>

<!-- Enlace para volver a la página de perfil -->
<a href="perfil.php?registrar_id=<?php echo $registrar_id ?>">Volver</a>
