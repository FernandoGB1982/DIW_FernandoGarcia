<?php
  session_start();
  
  $conexion = mysqli_connect("localhost", "root", "", "usuario") 
    or die("Problemas con la conexión");

  $email= $_POST['email'];
  $contraseña = $_POST['contraseña1'];

  $busqueda=mysqli_query($conexion,"SELECT * FROM usuarios WHERE Usuario_email='$email'")
  or die("Problemas en el select" . mysqli_error($conexion));

  if(mysqli_num_rows($busqueda) != 0){
          $row = mysqli_fetch_assoc($busqueda); 
          $dbEmail=$row['Usuario_email'];
          $dbContraseña=$row['Usuario_clave'];

      if (password_verify($contraseña, $dbContraseña)) {
          $_SESSION['email']=$email;

          header('Location:paginaUsuario.php');
          //header('Location:formularioLogin.php?login=1');
      }else{
          header('Location:formularioLogin.php?pass=1');
      }
  }else{
      header('Location:formularioLogin.php?mail=1');
  }
  mysqli_close($conexion);
?>