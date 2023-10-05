<?php

  $conexion = mysqli_connect("localhost", "root", "", "usuario") 
    or die("Problemas con la conexión");

  $registros = mysqli_query($conexion, "SELECT Usuario_id FROM Usuarios WHERE Usuario_id=".$_GET['codigoBorrar']) 
    or die("Problemas en el select:" . mysqli_error($conexion));

  if ($reg = mysqli_fetch_array($registros)) {
    mysqli_query($conexion, "DELETE FROM usuarios WHERE Usuario_id=".$_GET['codigoBorrar']) 
        or die("Problemas en el select:" . mysqli_error($conexion));

    header('Location:listadoUsuarios.php');
  } 

  mysqli_close($conexion);

  ?>