<?php
  session_start();

  if(!isset($_SESSION['email']) ){
    header('Location:formularioLogin.php');
  }else if($_SESSION['perfil']!='administrador'){
    header('Location:formularioLogin.php');
  }

  $conexion = mysqli_connect("localhost", "root", "", "usuario") 
  or die("Problemas con la conexión");

  $email=$_SESSION['email'];

  $busqueda=mysqli_query($conexion,"SELECT * FROM usuarios WHERE Usuario_email='$email'")
  or die("Problemas en el select" . mysqli_error($conexion));
  
  if(mysqli_num_rows($busqueda) != 0){
          $row = mysqli_fetch_assoc($busqueda);   
  }
  $foto = base64_encode($row['Usuario_fotografia']);
  $nombre = $row['Usuario_nombre'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    
    <link rel="stylesheet" href="estilos/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="estilos/estilos.css">
</head>

<body>

    <header class="pt-3 bg-secondary container-fluid header">
      <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-md-4 text-center">
                <h1 class="text-white titulo">
                  Administrador - <?php echo $nombre; ?>
                </h1>
            </div>

            <div class="col-md-4 text-md-end text-center" >
              <a class="fs-6 fw-bold text-uppercase text-white enlace me-5"  href="logout.php">Logout</a>
          </div>
        </div> 
    </header>

  <main class="container p-2 contenido pb-md-0 pb-5">
    <div class="row g-0 align-items-center justify-content-around">
      <div class="col-md-4">
        <img class="img-fluid mt-5 mb-5 p-md-0 p-5" src="data:image/png;base64,<?php echo $foto; ?>" alt="usuario">
      </div>

      <div class="col-md-4">
        <p class="text-black text-center fs-1">
          <?php
            echo $email=$_SESSION['email'];
          ?>
        </p>

        <form class="bg-light rounded p-3 m-5 shadow formulario" action="actualizarFotoPerfilAdministrador.php" method="post" enctype="multipart/form-data">

          <?php
            if(isset($_GET['actu']) && $_GET['actu']==1){
              echo "<div class='alert alert-success' id='actuAlert' role='alert'>Actualizado Correctamente!!</div>";
              echo
              '<script>
                setTimeout(function(){
                  document.getElementById("actuAlert").remove();
                },5000)
              </script>';
            }
          ?>
          
          <label class="fs-6 p-1 mt-3">Foto de Perfil del Administrador:</label>
          <input class="form-control" placeholder="Imagen" id="file" type="file"  name="foto"   required>

          <button class="btn btn-dark w-100 mt-3" type="submit" value="actualizar">Actualizar</button>
        </form>
 
          <a class="btn btn-secondary w-100 mt-3"  href="formularioAdministrador.php">Editar Perfil Administrador</a>
          <a class="btn btn-secondary w-100 mt-3"  href="listadoUsuarios.php">Editar Perfiles Usuarios</a>

      </div>
    </div>
  </main>

  <footer class="p-3 bg-secondary footer">
    <p class="text-center fs-6 fw-bold text-uppercase text-white m-0">
      Diseño Interfaces Web - 
      <span class="text-center fs-5 fw-normal text-capitalize text-white m-0"> Fernando Garcia Berraquero</span>
    </p>
  </footer>
</body>

</html>