<?php
    session_start();

    mysqli_query($conexion,
    "UPDATE usuarios 
    SET Usuario_numero_intentos='0' 
    WHERE  Usuario_email= '$dbEmail'");

    session_destroy();
    
    header('Location:formularioLogin.php');
?>