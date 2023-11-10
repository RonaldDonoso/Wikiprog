<?php
// Incluir las funciones necesarias del archivo "funciones.php"
include("funciones.php");

// Requerir el archivo de configuración "config.php" que contiene los datos de conexión a la base de datos
require('config.php');

// Obtener el ID del usuario y del curso desde la URL
$registrar_id = $_GET['registrar_id'];
$usuario_id = $registrar_id;
$curso_id = $_GET['curso_id'];

// Establecer una conexión a la base de datos
$conexion = mysqli_connect($host, $user, $password, $database);

// Obtener la ID de la categoría para un curso específico
$categoria_id = consulta_categoria($conexion, $curso_id);

// Verificar si se encontró una categoría
if ($categoria_id != "Usuario no encontrado.") {
    // Llamar a la función categoria para obtener la descripción
    $categoria_id = categoria($conexion, $categoria_id);
}

// Mostrar información del curso y comentarios
$resultado = llamar_tabla_curso($conexion, $curso_id );
$resultado .= categoria($conexion, $curso_id). "<br>";
$resultado .= Comentarios($conexion, $curso_id). "<br>". "<br>";

// Obtener el ID de la lección de la URL
$resultado .= MostrarLeccion($conexion, $curso_id);

// Comprobar si se ha enviado el formulario (POST request)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se ha enviado el campo 'descripcion' y no está vacío
    if (isset($_POST['descripcion']) && !empty($_POST['descripcion'])) {
        $descripcion = $_POST['descripcion'];
        
        // Agregar el comentario a la base de datos
        agregar_comentario($conexion, $curso_id, $usuario_id, $descripcion);
        
        // Redirigir a la misma página con registrar_id y curso_id en la URL
        header('Location: ' . $_SERVER['PHP_SELF'] . '?registrar_id=' . $registrar_id . '&curso_id=' . $curso_id);
        exit;
    } elseif (isset($_POST['descripcion']) && empty($_POST['descripcion'])) {
        // Mostrar un mensaje si el campo de comentario está vacío
        $resultado .= "El comentario no puede estar vacío";
    }
}

// Mostrar un formulario para agregar comentarios
echo "<form action='' method='post'>
    <input type='text' name='descripcion' placeholder='Agrega tu comentario'>
    <input type='submit' value='Enviar'>
</form>";

// Mostrar los resultados
echo $resultado;

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
