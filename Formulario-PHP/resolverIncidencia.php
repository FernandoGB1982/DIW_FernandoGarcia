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

$fechaBajaIncidencia=date('Y-m-d');


$actualiza=mysqli_query($conexion, 
  "UPDATE incidencias 
  SET fecha_baja_incidencia = '$fechaBajaIncidencia'
  WHERE codigo='$codigo'")
  or die("Problemas en el update" . mysqli_error($conexion));

header('Location:listadoIncidencias.php');
  

?>
