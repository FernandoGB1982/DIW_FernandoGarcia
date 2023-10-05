<?php
  session_start();

  $id=$_GET['codigoEditar'];

  $conexion = mysqli_connect("localhost", "root", "", "usuario") 
  or die("Problemas con la conexión");

  $nombre = $_POST['nombre'];
  $apellido1 = $_POST['apellido1'];
  $apellido2 = $_POST['apellido2'];
  $bloqueado = $_POST['bloqueado'];
  $nif = $_POST['nif'];
  $telefono =$_POST['telefono'];
  $nick = $_POST['nick'];
  $poblacion = $_POST['poblacion'];
  $provincia = $_POST['provincia'];
  $domicilio = $_POST['domicilio'];

  
  $actualiza=mysqli_query($conexion, 
  "UPDATE usuarios  
  SET Usuario_nombre = '$nombre', Usuario_apellido1 = '$apellido1', Usuario_apellido2 = '$apellido2', Usuario_bloqueado = '$bloqueado',
  Usuario_nif = '$nif', Usuario_numero_telefono = '$telefono', Usuario_Nick = '$nick', Usuario_domicilio = '$domicilio' ,Usuario_Poblacion = '$poblacion', Usuario_Provincia = '$provincia'
  WHERE Usuario_id='$id'")
  or die("Problemas en el update" . mysqli_error($conexion));

  header('Location:formularioEditarUsuario.php?actu=1&codigoEditar='.$_GET['codigoEditar']);

  mysqli_close($conexion);
?>