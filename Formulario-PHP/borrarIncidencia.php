<?php
    session_start();

    if(!isset($_SESSION['email']) ){
    header('Location:formularioLogin.php');
    }else if($_SESSION['perfil']!='administrador'){
    header('Location:formularioLogin.php');
    }

    $codigo=$_GET['codigoIncidencia'];

    $conexion = mysqli_connect("localhost", "root", "", "usuario") 
        or die("Problemas con la conexión");

    $registros = mysqli_query($conexion, "SELECT * FROM incidencias WHERE codigo=$codigo") 
        or die("Problemas en el select:" . mysqli_error($conexion));

    if ($reg = mysqli_fetch_array($registros)) {
        mysqli_query($conexion, "DELETE FROM incidencias WHERE codigo=$codigo") 
            or die("Problemas en el select:" . mysqli_error($conexion));

        header('Location:listadoIncidencias.php');
    } 

    mysqli_close($conexion);

?>