<?php
    $conexion = mysqli_connect("localhost", "root", "", "usuario") 
    or die("Problemas con la conexión");

    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $incidencia = $_POST['incidencia'];
    $fechaAltaIncidencia = date('Y-m-d');

    $inserta=mysqli_query($conexion, 
        "INSERT INTO incidencias (nombre, email, fecha_alta_incidencia, incidencia) 
        VALUES 
        ('$nombre','$email','$fechaAltaIncidencia', '$incidencia')")
        or die("Problemas en el insert" . mysqli_error($conexion));
    if($inserta!=0){
        header('Location:contactanos.php?incidencia=1');
    }

  mysqli_close($conexion);
?>