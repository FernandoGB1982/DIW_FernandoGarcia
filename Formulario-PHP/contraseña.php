<?php
  $conexion = mysqli_connect("localhost", "root", "", "usuario") 
    or die("Problemas con la conexión");

    $contraseña1 = $_POST['contraseña1'];
    $contraseña2 = $_POST['contraseña2'];

    if($contraseña1==$contraseña2){
        $hash_contraseña = password_hash($contraseña1, PASSWORD_DEFAULT);
        
        if(mysqli_num_rows($busquedaEmail) > 0){
          header('Location:formularioRegistro.php?mail=1');
        }else{
          $inserta=mysqli_query($conexion, 
          "INSERT INTO usuarios (Usuario_nombre, Usuario_email, Usuario_clave, Usuario_bloqueado, Usuario_token_aleatorio, Usuario_fecha_alta, Usuario_fotografia, Usuario_perfil) 
          VALUES 
          ('$nombre','$email','$hash_contraseña','$bloqueado','$token','$fechaAlta','$imagen_usuario','$perfil')")
          or die("Problemas en el select" . mysqli_error($conexion));
          /*
          $to      = $email;
          $subject = 'the subject';
          $message = 'hello';
          $headers = 'From: webmaster@example.com' . "\r\n" .
            'Reply-To: webmaster@example.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

          mail($to, $subject, $message, $headers);
          */
          header('Location:formularioRegistro.php?register=1');
        }
    }else{
      header('Location:formularioRegistro.php?pass=1');
    }
  mysqli_close($conexion);
?>
