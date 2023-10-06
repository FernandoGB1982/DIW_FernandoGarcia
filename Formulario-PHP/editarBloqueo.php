<?php

session_start();

if(!isset($_SESSION['email']) ){
  header('Location:formularioLogin.php');
}else if($_SESSION['perfil']!='administrador'){
  header('Location:formularioLogin.php');
}

$conexion = mysqli_connect("localhost", "root", "", "usuario") 
  or die("Problemas con la conexión");


if(!empty($_POST['checkList'])) {
    foreach($_POST['checkList'] as $checked) {

        $busqueda=mysqli_query($conexion, 
        "SELECT Usuario_bloqueado
        FROM usuarios
        WHERE Usuario_id='$checked'")
        or die("Problemas en el update" . mysqli_error($conexion));

        if(mysqli_num_rows($busqueda) != 0){
            $row = mysqli_fetch_assoc($busqueda); 
            $bloqueado=$row['Usuario_bloqueado'];
        }
        echo $bloqueado;


        switch ($bloqueado) {
            case 0:
                $actualiza=mysqli_query($conexion, 
                "UPDATE usuarios  
                SET Usuario_bloqueado = 1
                WHERE Usuario_id='$checked'")
                or die("Problemas en el update" . mysqli_error($conexion));
               
                break;
            case 1:
                $actualiza=mysqli_query($conexion, 
                "UPDATE usuarios  
                SET Usuario_bloqueado = 0
                WHERE Usuario_id='$checked'")
                or die("Problemas en el update" . mysqli_error($conexion));
                break; 
        }

    }
}

header('Location:ListadoUsuarios.php');
?>
