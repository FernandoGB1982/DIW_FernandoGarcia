<?php
  session_start();
  
  $conexion = mysqli_connect("localhost", "root", "", "usuario") 
    or die("Problemas con la conexión");

  $email= $_POST['email'];
  $contraseña = $_POST['contraseña1'];
  $captcha = $_POST['captcha'];
  $dbNumeroIntentos=0;

  $busqueda=mysqli_query($conexion,"SELECT * FROM usuarios WHERE Usuario_email='$email'")
  or die("Problemas en el select" . mysqli_error($conexion));
    
  if( mysqli_num_rows($busqueda) != 0){
      $row = mysqli_fetch_assoc($busqueda); 
      $dbEmail=$row['Usuario_email'];
      $dbContraseña=$row['Usuario_clave'];
      $dbBloqueado=$row['Usuario_bloqueado'];
      $dbNumeroIntentos=$row['Usuario_numero_intentos'];

      if($dbBloqueado==1){
        header('Location:formularioLogin.php?bloq=1');
      }else{
        if (password_verify($contraseña, $dbContraseña)) {
          $_SESSION['email']=$email;

          if ($_SESSION['captcha_code'] == $captcha) {
              mysqli_query($conexion,
              "UPDATE usuarios 
              SET Usuario_numero_intentos='0' 
              WHERE  Usuario_email= '$dbEmail'");
              header('Location:paginaUsuario.php');
          }else {
              $dbNumeroIntentos++;
              $intentos=(3-$dbNumeroIntentos);
              if($dbNumeroIntentos!=3){
                mysqli_query($conexion,
                "UPDATE usuarios 
                SET Usuario_numero_intentos='$dbNumeroIntentos' 
                WHERE  Usuario_email= '$dbEmail'");
                header('Location:formularioLogin.php?captcha=1&inte='.$intentos);
              }else
              if($dbNumeroIntentos==3){
                mysqli_query($conexion,
                "UPDATE usuarios 
                SET Usuario_bloqueado='1', Usuario_numero_intentos='0' 
                WHERE  Usuario_email= '$dbEmail'");
                header('Location:formularioLogin.php?bloq=1');
              }
              
          }
          //header('Location:formularioLogin.php?login=1');
        }else{
          $dbNumeroIntentos++;
          $intentos=(3-$dbNumeroIntentos);
          if($dbNumeroIntentos!=3){
            mysqli_query($conexion,
            "UPDATE usuarios 
            SET Usuario_numero_intentos='$dbNumeroIntentos' 
            WHERE  Usuario_email= '$dbEmail'");
            header('Location:formularioLogin.php?pass=1&inte='.$intentos);
          }else
          if($dbNumeroIntentos==3){
            mysqli_query($conexion,
            "UPDATE usuarios 
            SET Usuario_bloqueado='1', Usuario_numero_intentos='0' 
            WHERE  Usuario_email= '$dbEmail'");
            header('Location:formularioLogin.php?bloq=1');
          }
          
        }
      }
  }else{
      header('Location:formularioLogin.php?mail=1');
  }

  mysqli_close($conexion);
?>