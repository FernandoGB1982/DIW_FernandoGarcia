<?php
include 'src/assets/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar datos del formulario
    $usuario = $_POST["newUsername"];
    $telefono = $_POST["newPhone"];
    $correo = $_POST["newEmail"];
    $password = $_POST["newPassword"];

    // Preparar la consulta SQL para la inserción
    $insertarUsuario = "INSERT INTO usuarios (idusuario,usuario, telefono, correo, passwordUsuario) VALUES (0,'$usuario', '$telefono', '$correo', '$password')";

    // Imprimir la consulta SQL (para depurar)
    echo "Consulta SQL: " . $insertarUsuario . "<br>";

    // Ejecutar la consulta
    $resultado = mysqli_query($conexion, $insertarUsuario);

    if ($resultado) {
        // Inserción exitosa
        header("Location: login.php");
        exit();
    } else {
        // Error en la inserción
        echo "Error al registrar el usuario: " . mysqli_error($conexion);
    }
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
