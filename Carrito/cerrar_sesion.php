<?php
// Inicia la sesión
session_start();

// Destruye todas las variables de sesión
$_SESSION = array();

// Destruye la sesión
session_destroy();

// Redirige a la página de inicio o a donde desees después de cerrar sesión
header("Location: index.php");
exit();
?>
