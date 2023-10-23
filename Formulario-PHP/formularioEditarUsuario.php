<?php
    session_start();

    if(!isset($_SESSION['email']) ){
      header('Location:formularioLogin.php');
    }else if($_SESSION['perfil']!='administrador'){
      header('Location:formularioLogin.php');
    }

    $conexion = mysqli_connect("localhost", "root", "", "usuario") 
    or die("Problemas con la conexión");

    $id=$_GET['codigoEditar'];

    $busqueda=mysqli_query($conexion,"SELECT * FROM usuarios WHERE Usuario_id='$id'")
    or die("Problemas en el select" . mysqli_error($conexion));
    
    if(mysqli_num_rows($busqueda) != 0){
        $row = mysqli_fetch_assoc($busqueda); 
        $Id=$row['Usuario_id'];
        $Nombre=$row['Usuario_nombre'];
        $Apellido1=$row['Usuario_apellido1'];
        $Apellido2=$row['Usuario_apellido2'];
        $Nif=$row['Usuario_nif'];
        $Telefono=$row['Usuario_numero_telefono'];
        $Nick=$row['Usuario_nick'];
        $Poblacion=$row['Usuario_poblacion'];
        $Provincia=$row['Usuario_provincia'];
        $Domicilio=$row['Usuario_domicilio'];
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil Usuario</title>
    
    <link rel="stylesheet" href="estilos/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="estilos/estilos.css">
</head>

<body>
    <header class="pt-3 bg-secondary container-fluid header">
      <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-md-4 text-center">
                <h1 class="text-white titulo">
                  Editar Usuario - <?php echo $Nombre; ?>
                </h1>
            </div>

            <div class="col-md-6 text-md-end text-center" >
            <a class="fs-6 fw-bold text-uppercase text-white me-5 enlace"  href="paginaAdministrador.php">Perfil Administrador</a>
              <a class="fs-6 fw-bold text-uppercase text-white me-5 enlace"  href="listadoUsuarios.php">Listado</a>
              <a class="fs-6 fw-bold text-uppercase text-white enlace"  href="logout.php">Logout</a>

          </div>
        </div> 
    </header>

  <main class="container p-2 contenido">
    <div class="row g-0 align-items-center justify-content-around">

      <div class="col-md-4">
        <form class="bg-light rounded p-3 m-5 shadow formulario" action="editarUsuario.php?codigoEditar=<?php echo $id; ?>" method="post">

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

                  $provincias = mysqli_query($conexion, "SELECT  * FROM provincias")
                              or die("Problemas en el select:" . mysqli_error($conexion));

                  $municipios = mysqli_query($conexion, "SELECT  * FROM municipios")
                              or die("Problemas en el select:" . mysqli_error($conexion));

                  mysqli_close($conexion);
            ?>

            <label class="fs-6 p-1">Introduzca Nombre:</label>
            <input class="form-control" id="nombre" type="text" pattern="^[A-ZÁÉÍÓÚÑ][A-ZÁÉÍÓÚÑa-záéíóúñ\s]*$" maxlength="40" name="nombre"
            value="<?php echo $Nombre; ?>">

            <label class="fs-6 p-1">Introduzca Primer Apellido:</label>
            <input class="form-control" id="apellido1" type="text" pattern="^[A-ZÁÉÍÓÚÑ][A-ZÁÉÍÓÚÑa-záéíóúñ\s]*$" maxlength="40" name="apellido1" value="<?php echo $Apellido1; ?>">

            <label class="fs-6 p-1">Introduzca Segundo Apellido:</label>
            <input class="form-control" id="apellido2" type="text" pattern="^[A-ZÁÉÍÓÚÑ][A-ZÁÉÍÓÚÑa-záéíóúñ\s]*$" maxlength="40" name="apellido2" value="<?php echo $Apellido2; ?>">

            <label class="fs-6 p-1">Introduzca DNI:</label>
            <input class="form-control" id="nif" type="text" pattern="[0-9]{8}[A-Za-z]{1}" maxlength="40" name="nif" value="<?php echo $Nif; ?>">

            <label class="fs-6 p-1">Introduzca Telefono:</label>
            <input class="form-control" id="telefono" type="tel" pattern="[0-9]{9}" maxlength="9" name="telefono" value="<?php echo $Telefono; ?>">

            <label class="fs-6 p-1">Introduzca Nick:</label>
            <input class="form-control" id="nick" type="text"  maxlength="40" name="nick" value="<?php echo $Nick; ?>">

            <label class="fs-6 p-1">Introduzca Domicilio:</label>
            <input class="form-control" id="domicilio" type="text"  maxlength="40" name="domicilio" value="<?php echo $Domicilio; ?>">

            <label class="fs-6 p-1">Introduzca Provincia:</label>
            <select name="provincia" class="form-control" id="provinciaSelect">
                <option value="">Seleccionar</option>';
                <?php
                  while ($reg = mysqli_fetch_array($provincias)) {
                    if($reg['idProvincia']!=''){
                      $provincia = $reg['Provincia'];
                      $idProvincia = $reg['idProvincia'];

                      if ($idProvincia==$Provincia){
                        echo "<option value='$idProvincia' selected>$provincia</option>";
                      }else{
                        echo "<option value='$idProvincia'>$provincia</option>";
                      }
                    }
                  }
                ?>
            </select>
            <!--
            <input class="form-control" id="provincia" type="text" pattern="^[A-ZÁÉÍÓÚÑ][A-ZÁÉÍÓÚÑa-záéíóúñ\s]*$" maxlength="40" name="provincia" value="<?php echo $Provincia; ?>">
            -->

            <label class="fs-6 p-1">Introduzca Poblacion:</label>
            <select name="poblacion" class="form-control" id="poblacionSelect">
                <option value="">Seleccionar</option>';
                <?php
                  while ($reg = mysqli_fetch_array($municipios)) {
                    if($reg['idMunicipio']!=''){
                      $municipio = $reg['Municipio'];
                      $idMunicipio = $reg['idMunicipio'];

                      if ($municipio==$Poblacion){
                        echo "<option value='$municipio' selected>$municipio</option>";
                      }else{
                        echo "<option value='$municipio'>$municipio</option>";
                      }
                    }
                  }
                ?>
            </select>
            <!--
            <input class="form-control" id="poblacion" type="text" pattern="^[A-ZÁÉÍÓÚÑ][A-ZÁÉÍÓÚÑa-záéíóúñ\s]*$" maxlength="40" name="poblacion" value="<?php echo $Poblacion; ?>">
            -->

            
            <button class="btn btn-dark w-100 mt-3" type="submit" value="editar">Actualizar 
        </form>
      </div>

      <div class="col-md-4">
        <img class="img-fluid mt-5 mb-5 p-md-0 p-5" src="imagenes/icon-perfil.png" alt="login">
      </div>

    </div>
  </main>

  <footer class="p-3 bg-secondary footer">
    <p class="text-center fs-6 fw-bold text-uppercase text-white m-0">
      Diseño Interfaces Web - 
      <span class="text-center fs-5 fw-normal text-capitalize text-white m-0"> Fernando Garcia Berraquero</span>
    </p>
  </footer>

  <script>
    const provinciaSelect = document.getElementById('provinciaSelect');
    const poblacionSelect = document.getElementById('poblacionSelect');

    provinciaSelect.addEventListener('change', function () {
        const selectedProvinciaId = provinciaSelect.value;

        poblacionSelect.innerHTML = '<option value="">Seleccionar</option>';

        fetch('get_municipalities.php?id=' + selectedProvinciaId)
            .then(response => response.json())
            .then(data => {
                if (Array.isArray(data)) {
                    data.forEach(municipio => {
                        const option = document.createElement('option');
                        option.value = municipio.Municipio;
                        option.textContent = municipio.Municipio;
                        poblacionSelect.appendChild(option);
                    });
                } else {
                    console.error('Los datos recibidos no son un array válido.');
                }
            })
            .catch(error => console.error('Error:', error));
    });
</script>

</body>

</html>
