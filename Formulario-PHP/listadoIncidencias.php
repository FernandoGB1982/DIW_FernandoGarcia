<?php
    session_start();

    if(!isset($_SESSION['email']) ){
      header('Location:formularioLogin.php');
    }else if($_SESSION['perfil']!='administrador'){
      header('Location:formularioLogin.php');
    }

    $conexion = mysqli_connect("localhost", "root", "", "usuario") 
    or die("Problemas con la conexión");

    $registros = mysqli_query($conexion, "SELECT * FROM incidencias ORDER BY codigo")
                              or die("Problemas en el select:" . mysqli_error($conexion));

    $email=$_SESSION['email'];

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
      </div> 
    </header>

  <main class="container p-2 contenido">
      <form action="editarBloqueo.php" method="post" name="formulario">

        <table class="table table-striped mt-5 mb-5 p-5">
          <thead class="bg-info text-white text-center">
          <tr> 
            <th scope="col">Código</th>
            <th scope="col">Nombre</th>
            <th scope="col">Email</th>
            <th scope="col">Fecha Alta Incidencia</th>
            <th scope="col">Fecha Baja incidencia</th>
            <th scope="col">Incidencia</th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
          </thead>
          <tbody class="text-center">
            <?php 

              //Paginacion Normal
              $registrosPorPagina=5;

              if(isset($_GET['pagina'])){
                $paginaActual=$_GET['pagina'];
              }else{
                $paginaActual=1;
              }

              $inicio =($paginaActual - 1) * $registrosPorPagina;
              //Fin Paginacion Normal
              

              $conexion = mysqli_connect("localhost", "root", "", "usuario") 
              or die("Problemas con la conexión");

              $queryTotal="SELECT count(*) AS total FROM incidencias";


              //Paginacion
              $resultadoTotal = mysqli_query($conexion, $queryTotal);
              $rowTotal = mysqli_fetch_assoc($resultadoTotal);

              if(isset($rowTotal['total'])){
                $totalRegistros = $rowTotal['total'];
              }else{
                $totalRegistros = 0;
              }

              $totalPaginas = ceil($totalRegistros / $registrosPorPagina);         
              //Fin Paginacion


              $sql="SELECT * FROM incidencias LIMIT $inicio, $registrosPorPagina";
              $registros = mysqli_query($conexion,$sql) 
                or die("Problemas en el select:" . mysqli_error($conexion));

                
              //FIN PAGINACION INCIDENCIAS

              while ($reg = mysqli_fetch_array($registros)) {
                $codigo=$reg['codigo'];
                $nombre=$reg['nombre'];
                $email=$reg['email'];
                $alta=$reg['fecha_alta_incidencia'];
                $baja=$reg['fecha_baja_incidencia'];
                $incidencia=$reg['incidencia'];

                echo "<tr>";

                echo "<td> $codigo </td>";
                echo "<td> $nombre </td>";
                echo "<td> $email </td>";
                echo "<td> $alta </td>";
                echo "<td> $baja </td>";
                echo "<td> $incidencia </td>";


                echo "<td> <a href='borrarIncidencia.php?codigoIncidencia=$reg[codigo]'>
                <img src='imagenes/borrar.png' alt='Borrar' width='30'/>
                </a> </td>";

                echo "<td>  <a href='resolverIncidencia.php?codigoIncidencia=$reg[codigo]'>
                <input type='button' class='btn btn-success text-white' value='Resolver'></input>
                </a> </td>"; 

                echo "</tr>";
              }
            ?>
          </tbody>
        </table>

        <!--Mostrar Paginacion-->
        <div class="col-md-12 mb-5">
          <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">

              <?php  
                $paginaSuperior=$paginaActual;
                $paginaInferior=$paginaActual;
                
                  echo "<li class='page-item '> <a class='page-link' href='ListadoIncidencias.php?pagina=1'> Inicio </a>";


                if($paginaActual==1){
                  echo "<li class='page-item '> <a class='page-link' href='ListadoIncidencias.php?pagina=$paginaActual'> < </a>";
                }else {
                  $paginaInferior--;
                  echo "<li class='page-item '> <a class='page-link' href='ListadoIncidencias.php?pagina=$paginaInferior'> < </a>";
                }

              
                for($i=1; $i <= $totalPaginas; $i++){
                  if($paginaActual == $i){
                    echo " <li class='page-item active'> <a class='page-link' href='ListadoIncidencias.php?pagina=$i'> $i</a>";
                  }else{
                    echo " <li class='page-item '> <a class='page-link' href='ListadoIncidencias.php?pagina=$i'> $i</a>";
                  }
                }
              
              
                if($paginaActual==$totalPaginas){
                  echo "<li class='page-item '> <a class='page-link' href='ListadoIncidencias.php?pagina=$paginaActual'> > </a>";
                }else {
                  $paginaSuperior++;
                  echo "<li class='page-item '> <a class='page-link' href='ListadoIncidencias.php?pagina=$paginaSuperior'> > </a>";
                }


                  echo "<li class='page-item '> <a class='page-link' href='ListadoIncidencias.php?pagina=$totalPaginas'> Final </a>";
              ?>

            </ul>
          </nav>
        </div> 
        <!--Fin Mostrar Paginacion-->
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
      for (var i=0; i<formulario.elements.length; i++)  {  
          if ( formulario.elements[i].name == "checkList[]" )  {
            formulario.elements[i].checked = formulario.elements[0].checked  
          }  
        }
    }

    
    
    </script>

</body>

</html>