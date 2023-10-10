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

    <!-- Filtrado -->
        <div class="row align-items-center justify-content-around mt-5 border border-info" >
          <div class="col-md-12 text-center pb-3 bg-light">
            <form action="listadoUsuarios.php" method="post" name="filtrado">
              <?php
                $conexion = mysqli_connect("localhost", "root", "", "usuario") 
                or die("Problemas con la conexión");


                $registros = mysqli_query($conexion, "SELECT DISTINCT Usuario_poblacion FROM usuarios ORDER BY Usuario_poblacion")
                              or die("Problemas en el select:" . mysqli_error($conexion));
              ?>
              <label class="fs-6 p-1 mt-3">Seleccione la Poblacion:</label>
              <select name="poblacion">
                <option value="">Seleccionar</option>';
                <?php
                  while ($reg = mysqli_fetch_array($registros)) {
                    if($reg['Usuario_poblacion']!=''){
                      $poblacion = $reg['Usuario_poblacion'];
                      echo "<option value='$poblacion'>$poblacion</option>";
                    }
                  }
                ?>
              </select>

              <label class="fs-6 p-1 ms-5 mt-3">Seleccione Bloqueado:</label>
              <select name="bloqueado">
                <option value="">Seleccionar</option>
                <option value="0">Desbloqueados</option>
                <option value="1">Bloqueados</option>
              </select>

              <input class='btn btn-dark ms-5' type="submit" value="Filtrar">
            </form>

            <?php
              if(isset($_POST['poblacion'])){
                $poblacion=$_POST['poblacion'];
              }else{
                $poblacion='';
              }

              if(isset($_POST['bloqueado'])){
                $bloqueado=$_POST['bloqueado'];
              }else{
                $bloqueado='';
              }


          //PAGINACION FILTRADA
              if(isset($_GET['filtro'])){
                if($_GET['filtro']==0){

                  $registrosPorPagina=5;
                  if(isset($_GET['pagina'])){
                    $paginaActual=$_GET['pagina'];
                  }else{
                    $paginaActual=1;
                  }
                  $inicio =($paginaActual - 1) * $registrosPorPagina;

                  $sql="SELECT * FROM usuarios WHERE Usuario_perfil='usuario'  
                  LIMIT $inicio, $registrosPorPagina";

                  $queryTotal="SELECT count(*) AS total FROM usuarios Where Usuario_perfil='usuario'";

                  $filtro=0;

                }else if ($_GET['filtro']==1){

                  $registrosPorPagina=5;
                  if(isset($_GET['pagina'])){
                    $paginaActual=$_GET['pagina'];
                  }else{
                    $paginaActual=1;
                  }
                  $inicio =($paginaActual - 1) * $registrosPorPagina;

                  $sql="SELECT * FROM usuarios WHERE Usuario_bloqueado='$bloqueado' AND Usuario_perfil='usuario' 
                  LIMIT $inicio, $registrosPorPagina";
                  
                  $queryTotal="SELECT count(*) AS total FROM usuarios WHERE Usuario_bloqueado='$bloqueado' AND Usuario_perfil='usuario'";

                  $filtro=1;

                }else if ($_GET['filtro']==2){
                  
                  $registrosPorPagina=5;
                  if(isset($_GET['pagina'])){
                    $paginaActual=$_GET['pagina'];
                  }else{
                    $paginaActual=1;
                  }
                  $inicio =($paginaActual - 1) * $registrosPorPagina;
                  
                  $sql="SELECT * FROM usuarios WHERE Usuario_poblacion='$poblacion' AND Usuario_perfil='usuario'
                  LIMIT $inicio, $registrosPorPagina";

                  $queryTotal="SELECT count(*) AS Total FROM usuarios WHERE Usuario_poblacion='$poblacion' AND Usuario_perfil='usuario'";

                  $filtro=2;

                }else if ($_GET['filtro']==3){

                  $registrosPorPagina=5;
                  if(isset($_GET['pagina'])){
                    $paginaActual=$_GET['pagina'];
                  }else{
                    $paginaActual=1;
                  }
                  $inicio =($paginaActual - 1) * $registrosPorPagina;

                  $sql="SELECT * FROM usuarios WHERE Usuario_poblacion='$poblacion' AND Usuario_bloqueado='$bloqueado' AND Usuario_perfil='usuario' LIMIT $inicio, $registrosPorPagina";

                  $queryTotal="SELECT count(*) AS total FROM usuarios WHERE Usuario_poblacion='$poblacion' AND Usuario_bloqueado='$bloqueado' AND Usuario_perfil='usuario'";

                  $filtro=3;
                }
          //FIN PAGINACION FILTRADA

              }else{

                //Paginacion Normal
                $registrosPorPagina=5;
                if(isset($_GET['pagina'])){
                  $paginaActual=$_GET['pagina'];
                }else{
                  $paginaActual=1;
                }
                $inicio =($paginaActual - 1) * $registrosPorPagina;
                //Fin Paginacion Normal

                if($poblacion=='' && $bloqueado==''){
                    $sql="SELECT * FROM usuarios WHERE Usuario_perfil='usuario'  
                      LIMIT $inicio, $registrosPorPagina";
                      /*Paginacion*/ $queryTotal="SELECT count(*) AS total FROM usuarios Where Usuario_perfil='usuario'";
                      $filtro=0;

                }else if($poblacion==''){
                    $sql="SELECT * FROM usuarios WHERE Usuario_bloqueado='$bloqueado' AND Usuario_perfil='usuario' 
                      LIMIT $inicio, $registrosPorPagina";
                      /*Paginacion*/ $queryTotal="SELECT count(*) AS total FROM usuarios WHERE Usuario_bloqueado='$bloqueado' AND Usuario_perfil='usuario' ";
                      $filtro=1;

                }else if($bloqueado==''){
                    $sql="SELECT * FROM usuarios WHERE Usuario_poblacion='$poblacion' AND Usuario_perfil='usuario'
                      LIMIT $inicio, $registrosPorPagina";
                      /*Paginacion*/ $queryTotal="SELECT count(*) AS Total FROM usuarios WHERE Usuario_poblacion='$poblacion' AND Usuario_perfil='usuario'";
                      $filtro=2;

                }else if ($poblacion!='' && $bloqueado!=''){
                    $sql="SELECT * FROM usuarios WHERE Usuario_poblacion='$poblacion' AND Usuario_bloqueado='$bloqueado' AND Usuario_perfil='usuario' LIMIT $inicio, $registrosPorPagina";
                    /*Paginacion*/ $queryTotal="SELECT count(*) AS total FROM usuarios WHERE Usuario_poblacion='$poblacion' AND Usuario_bloqueado='$bloqueado' AND Usuario_perfil='usuario'";
                    $filtro=3;
                }
            }

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

              $registros = mysqli_query($conexion,$sql) 
                or die("Problemas en el select:" . mysqli_error($conexion));
            ?>
          </div>
        </div>
  <!-- Fin Filtrado -->


      <form action="editarBloqueo.php" method="post" name="formulario">

        <table class="table table-striped mt-5 mb-2 p-5">
          <thead class="bg-info text-white text-center">
          <tr> 
            <th scope="col">Seleccionar Todos<input  class="align-middle ms-2" type='checkbox' name='check' 
            onclick="selectall(document.forms[1])"> </th>
            <th scope="col">Id</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido 1</th>
            <th scope="col">Apellido 2</th>
            <th scope="col">Nick</th>
            <th scope="col">Poblacion</th>
            <th scope="col">Bloqueado</th>
            <th scope="col"></th>
            <th scope="col"></th>
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
                $poblacion=$reg['Usuario_poblacion'];
                $bloqueado=$reg['Usuario_bloqueado'];

                echo "<tr>";

                echo "<td> <input class='marcar' type='checkbox' name='checkList[]' value='$id'> </td>";
                echo "<td> $id </td>";
                echo "<td> $nombre </td>";
                echo "<td> $apellido1 </td>";
                echo "<td> $apellido2 </td>";
                echo "<td> $nick </td>";
                echo "<td> $poblacion </td>";

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


    <!--Mostrar Paginacion-->
        <div class="col-md-12">
          <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">

              <?php  
                $paginaSuperior=$paginaActual;
                $paginaInferior=$paginaActual;
                
                  echo "<li class='page-item '> <a class='page-link' href='ListadoUsuarios.php?pagina=1&filtro=$filtro'> Inicio </a>";


                if($paginaActual==1){
                  echo "<li class='page-item '> <a class='page-link' href='ListadoUsuarios.php?pagina=$paginaActual&filtro=$filtro'> < </a>";
                }else {
                  $paginaInferior--;
                  echo "<li class='page-item '> <a class='page-link' href='ListadoUsuarios.php?pagina=$paginaInferior&filtro=$filtro'> < </a>";
                }

              
                for($i=1; $i <= $totalPaginas; $i++){
                  if($paginaActual == $i){
                    echo " <li class='page-item active'> <a class='page-link' href='ListadoUsuarios.php?pagina=$i&filtro=$filtro'> $i</a>";
                  }else{
                    echo " <li class='page-item '> <a class='page-link' href='ListadoUsuarios.php?pagina=$i&filtro=$filtro'> $i</a>";
                  }
                }
              
              
                if($paginaActual==$totalPaginas){
                  echo "<li class='page-item '> <a class='page-link' href='ListadoUsuarios.php?pagina=$paginaActual&filtro=$filtro'> > </a>";
                }else {
                  $paginaSuperior++;
                  echo "<li class='page-item '> <a class='page-link' href='ListadoUsuarios.php?pagina=$paginaSuperior&filtro=$filtro'> > </a>";
                }


                  echo "<li class='page-item '> <a class='page-link' href='ListadoUsuarios.php?pagina=$totalPaginas&filtro=$filtro'> Final </a>";
              ?>

            </ul>
          </nav>
        </div> 
    <!--Fin Mostrar Paginacion-->

        <div class="col-md-12 mt-5 text-center">
          <button class='btn btn-dark mb-5' type="submit" name="bloqueo">Bloquear/Desbloquear</a>
          <button class='btn btn-dark mb-5 ms-5' type="submit" name="borrar">Borrar</a>
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
      for (var i=0; i<formulario.elements.length; i++)  {  
          if ( formulario.elements[i].name == "checkList[]" )  {
            formulario.elements[i].checked = formulario.elements[0].checked  
          }  
        }
    }
    
    </script>

</body>

</html>