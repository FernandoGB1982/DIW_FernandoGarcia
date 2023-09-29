<?php
  session_start();

  if(!isset($_SESSION['email'])) {
      header('Location:formularioLogin.php');
  }

  $conexion = mysqli_connect("localhost", "root", "", "usuario") 
  or die("Problemas con la conexión");

  $nombre = $_POST['nombre'];
  $apellido1 = $_POST['apellido1'];
  $apellido2 = $_POST['apellido2'];
  $nif = $_POST['nif'];
  $nick = $_POST['nick'];
  $poblacion = $_POST['poblacion'];
  $provincia = $_POST['provincia'];
 

  $email=$_SESSION['email'];
  $actualiza=mysqli_query($conexion, 
  "UPDATE usuarios  
  SET Usuario_nombre = '$nombre', Usuario_apellido1 = '$apellido1', Usuario_apellido2 = '$apellido2', Usuario_nif = '$nif', Usuario_Nick = '$nick', Usuario_Poblacion = '$poblacion', Usuario_Provincia = '$provincia'
  WHERE Usuario_email='$email'")
  or die("Problemas en el update" . mysqli_error($conexion));

  header('Location:formularioUsuario.php?actu=1');

  mysqli_close($conexion);
?>