<?php
    session_start();

    if(!isset($_SESSION['email'])) {
        header('Location:formularioLogin.php');
    }

    $conexion = mysqli_connect("localhost", "root", "", "usuario") 
    or die("Problemas con la conexión");

    $email=$_SESSION['email'];


    $registros = mysqli_query($conexion, "SELECT * FROM usuarios ")
    or die("Problemas en el select" . mysqli_error($conexion));

    mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfiles Usuarios</title>
    
    <link rel="stylesheet" href="estilos/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="estilos/estilos.css">
</head>

<body>
    <header class="pt-3 bg-secondary container-fluid header">
      <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-md-4 text-center">
                <h1 class="text-white titulo">
                  Editar Perfiles de Usuarios
                </h1>
            </div>

            <div class="col-md-4 text-md-end text-center" >
              <a class="fs-6 fw-bold text-uppercase text-white me-5 enlace"  href="paginaAdministrador.php">Perfil Administrador</a>
              <a class="fs-6 fw-bold text-uppercase text-white enlace"  href="logout.php">Logout</a>
          </div>
        </div> 
    </header>

  <main class="container p-2 contenido">
      <table class="table table-striped mt-5 mb-5 p-5">
        <thead class="bg-info text-white">
        <tr> 
          <th scope="col">Id</th>
          <th scope="col">Nombre</th>
          <th scope="col">Apellido 1</th>
          <th scope="col">Apellido 2</th>
          <th scope="col">Email</th>
          <th scope="col">Bloqueado</th>
          <th scope="col">Nick</th>

        </tr>
        </thead>
        <tbody>
          <?php  
            while ($reg = mysqli_fetch_array($registros)) {
              echo "<tr>";
              echo "<td>". $reg['Usuario_id'] . "</td>";
              echo "<td>". $reg['Usuario_nombre'] . "</td>";
              echo "<td>". $reg['Usuario_apellido1'] . "</td>";
              echo "<td>". $reg['Usuario_apellido2'] . "</td>";
              echo "<td>". $reg['Usuario_email'] . "</td>";
              echo "<td>". $reg['Usuario_bloqueado'] . "</td>";
              echo "<td>". $reg['Usuario_nick'] . "</td>";

              
              echo "<td>  <a href='formularioEditarUsuario.php?codigoEditar=$reg[Usuario_id]'>
              <img src='imagenes/editar.png' alt='Editar' width='30'/>
              </a> </td>";
              echo "<td> <a href='borrarUsuario.php?codigoBorrar=$reg[Usuario_id]'>
              <img src='imagenes/borrar.png' alt='Borrar' width='30'/>
              </a> </td>";
              echo "</tr>";
            }
          ?>
        </tbody>
      </table>
  </main>

  <footer class="p-3 bg-secondary footer">
    <p class="text-center fs-6 fw-bold text-uppercase text-white m-0">
      Diseño Interfaces Web - 
      <span class="text-center fs-5 fw-normal text-capitalize text-white m-0"> Fernando Garcia Berraquero</span>
    </p>
  </footer>

</body>

</html>