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


    $registros = mysqli_query($conexion, "SELECT * FROM usuarios WHERE Usuario_perfil='usuario' ")
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
      <form action="editarBloqueo.php" method="post">

        <table class="table table-striped mt-5 mb-5 p-5">
          <thead class="bg-info text-white text-center">
          <tr> 
            <th scope="col">Seleccionar Todos<input  class="align-middle ms-2" type='checkbox' name='checkList[]' 
            onclick="selectall(document.forms[0])"> </th>
            <th scope="col">Id</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido 1</th>
            <th scope="col">Apellido 2</th>
            <th scope="col">Nick</th>
            <th scope="col">Bloqueado</th>
          </tr>
          </thead>
          <tbody class="text-center">
            <?php  
              while ($reg = mysqli_fetch_array($registros)) {
                $id=$reg['Usuario_id'];
                $nombre=$reg['Usuario_nombre'];
                $apellido1=$reg['Usuario_apellido1'];
                $apellido2=$reg['Usuario_apellido2'];
                $nick=$reg['Usuario_nick'];
                $bloqueado=$reg['Usuario_bloqueado'];

                echo "<tr>";

                echo "<td> <input type='checkbox' name='checkList[]' value='$id'> </td>";
                echo "<td> $id </td>";
                echo "<td> $nombre </td>";
                echo "<td> $apellido1 </td>";
                echo "<td> $apellido2 </td>";
                echo "<td> $nick </td>";

                if ($bloqueado==0) {
                  echo "<td> <input type='checkbox' name='bloqueado' value='$bloqueado' disabled> </td>";
                }else{
                  echo "<td> <input type='checkbox' name='bloqueado' value='$bloqueado' checked disabled> </td>";
                }
  
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
        <div class="col-md-12 text-center">
          <button class='btn btn-dark mb-5' type="submit">Bloquear/Desbloquear</a>
        </div>

      </form>
      
  </main>

  <footer class="p-3 bg-secondary footer">
    <p class="text-center fs-6 fw-bold text-uppercase text-white m-0">
      Diseño Interfaces Web - 
      <span class="text-center fs-5 fw-normal text-capitalize text-white m-0"> Fernando Garcia Berraquero</span>
    </p>
  </footer>

  <script>
    function selectall(form)  {  
      var formulario = eval(form)  
      for (var i=0, len=formulario.elements.length; i<len ; i++)  {  
          if ( formulario.elements[i].name == "checkList[]" )  {
            formulario.elements[i].checked = formulario.elements[0].checked  
          }  
        }
    }
    </script>

</body>

</html>