<?php
  session_start();

  if(!isset($_SESSION['email'])) {
      header('Location:formularioLogin.php');
  }else if($_SESSION['perfil']!='administrador'){
    header('Location:formularioLogin.php');
  }

  $conexion = mysqli_connect("localhost", "root", "", "usuario") 
  or die("Problemas con la conexión");

  $email=$_SESSION['email'];
  
  $imagen_temporal = $_FILES['foto']['tmp_name'];
  $imagen_usuario = addslashes(file_get_contents($imagen_temporal));

  

  $actualiza=mysqli_query($conexion, 
  "UPDATE usuarios  
  SET Usuario_fotografia = '$imagen_usuario'
  WHERE Usuario_email='$email'")
  or die("Problemas en el update" . mysqli_error($conexion));

  header('Location:paginaAdministrador.php?actu=1');

  mysqli_close($conexion);
?>