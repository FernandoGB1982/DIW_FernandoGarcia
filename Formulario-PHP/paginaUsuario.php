<?php
  /*
  //Localizacion de Trebujena
  $ubicacion_deseada = array(
    'latitud' => 36.924196,
    'longitud' => -6.166927
  );
  */
  /*
  //Localizacion Jerez
  $ubicacion_deseada = array(
    'latitud' => 36.6850,
    'longitud' => -6.1266
  );
  */

  session_start();

  if(!isset($_SESSION['email']) && $_SESSION['administrador']) {
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
    <title>Inicio de Sesion</title>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAK4PKDT4ASOivyIgRqB52BgMdUNSadjm0&callback=myMap" defer></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAK4PKDT4ASOivyIgRqB52BgMdUNSadjm0&callback=initMap&libraries=&v=weekly" defer></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAK4PKDT4ASOivyIgRqB52BgMdUNSadjm0&libraries=geometry" defer></script>
    
    <link rel="stylesheet" href="estilos/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="estilos/estilos.css">

    <style>
        #googleMap {
          height: 25%;
          width: 90%;
          display:block;
          margin:auto;
        } 

        html,
        body {
          height: 100%;
          margin: 0;
          padding: 0;
        }
    </style>
</head>

<body>

  <header class="pt-3 bg-secondary container-fluid header">
    <div class="container">
      <div class="row align-items-center justify-content-between">
          <div class="col-md-4 text-center">
              <h1 class="text-white titulo">
                Usuario <?php echo $nombre; ?>
              </h1>
          </div>

          <div class="col-md-4 text-md-end text-center" >
            <a class="fs-6 fw-bold text-uppercase text-white enlace me-5"  href="logout.php">Logout</a>
        </div>
      </div> 
  </header>

  <div id="googleMap" class="mt-5"></div>

  <main class="container p-2 contenido pb-md-0 pb-5">
    <div class="row g-0 align-items-center justify-content-around">
      <div class="col-md-4">
        <img class="img-fluid mt-5 mb-5 p-md-0 p-5 " src="data:image/png;base64,<?php echo $foto; ?>" alt="usuario">
      </div>

      <div class="col-md-4">
        <p class="text-black text-center fs-1">
          <?php
            echo $email=$_SESSION['email'];
          ?>
        </p>

        <form class="bg-light rounded p-3 m-5 shadow formulario" action="actualizarFotoPerfil.php" method="post" enctype="multipart/form-data">

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
          
          <label class="fs-6 p-1 mt-3">Foto de Perfil:</label>
          <input class="form-control" placeholder="Imagen" id="file" type="file"  name="foto"   required>

          <button class="btn btn-dark w-100 mt-3" type="submit" value="actualizar">Actualizar</button>
        </form>
 
          <a class="btn btn-secondary w-100 mt-3 mb-3"  href="formularioUsuario.php">Editar Perfil</a>

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
    function myMap(position) {
            var userLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

            /*
            // Definir las coordenadas de la ubicación deseada
            var ubicacionDeseada = new google.maps.LatLng(<?php echo $ubicacion_deseada['latitud']; ?>, <?php echo $ubicacion_deseada['longitud']; ?>);

            // Calcular la distancia entre la ubicación del usuario y la ubicación deseada
            var distancia = google.maps.geometry.spherical.computeDistanceBetween(userLocation, ubicacionDeseada);

            if (distancia > 3000) { // Cambia el valor según tu preferencia en metros
                alert("No estás en la ubicación deseada.");
                window.location = 'formularioLogin.php'; // Redirige al usuario si no está en la ubicación deseada
            }
            */
            
            var mapProp = {
                center: userLocation,
                zoom: 15
            };
            var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

            var marker = new google.maps.Marker({
                position: userLocation,
                icon:'imagenes/icon.png',
                map: map,
                title: 'Tu ubicación'
            });


            var userLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
        }

    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(myMap);
      } else {
        alert("La geolocalización no está disponible en tu navegador.");
      }
    }

    window.onload = getLocation; // Obtener la ubicación al cargar la página.
  </script>
</body>

</html>
