<?php

// Incluye las funciones necesarias del archivo "funciones.php"
include("funciones.php");

// Requiere el archivo de configuración "config.php" que contiene los datos de conexión a la base de datos
require('config.php');

// Establece una conexión con la base de datos utilizando los valores de "config.php"
$conexion = mysqli_connect($host, $user, $password, $database);

// Verifica si la solicitud HTTP es de tipo GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Obtiene el valor del parámetro "usuario" desde la URL
    $usuario = $_GET['usuario'];
    
    // Obtiene el valor del parámetro "contraseña" desde la URL
    $contraseña = $_GET['contraseña'];

    // Verifica si alguno de los campos de usuario o contraseña está vacío
    if (empty($usuario) || empty($contraseña)) {
        echo "Por favor, completa tanto el usuario como la contraseña.";
    } else {
        // Si ambos campos están completos, intenta autenticar al usuario
        if (autenticarUsuario($usuario, $contraseña)) {
            // Obtener el ID del usuario autenticado
            $registrar_id = obtenerUsuarioID($conexion, $usuario);

            if ($registrar_id !== false) {
                // Redirige al usuario a la página de inicio con su ID de registro
                header("Location: index.php?registrar_id=" . $registrar_id);
                exit;
            } else {
                echo "Inicio de sesión fallido. Verifica tus credenciales.";
            }
        } else {
            echo "Inicio de sesión fallido. Verifica tus credenciales.";
        }
    }
}

?>

<br>
<a href="registro.php">Registrarse</a>
