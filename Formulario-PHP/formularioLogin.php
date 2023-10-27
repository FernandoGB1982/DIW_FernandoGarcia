<?php
  /*
  //Localizacion de Trebujena
  $ubicacion_deseada = array(
    'latitud' => 36.867089191798755,
    'longitud' => -6.178597334558331
  );
  */
  
  //Localizacion Jerez
  $ubicacion_deseada = array(
    'latitud' => 36.70432705932596,
    'longitud' => -6.112493271385153
  );
  
  /*
  Si la recarga de la página solo funciona correctamente la primera vez que se muestra la alerta, es posible que se deba a un problema de caché en el navegador. Puedes intentar desactivar el almacenamiento en caché en el encabezado de la respuesta HTTP del servidor para asegurarte de que la página se recargue cada vez. Para hacer esto, puedes agregar el siguiente encabezado a tu página PHP:
  */
  header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
  header("Cache-Control: post-check=0, pre-check=0", false);
  header("Pragma: no-cache");
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
</head>

<body>
    <header class="pt-3 bg-secondary container-fluid header">
      <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-md-4 text-center">
                <h1 class="text-white titulo">
                  Iniciar Sesión
                </h1>
            </div>

            <div class="col-md-4 text-md-end text-center" >
              <a class="fs-6 fw-bold text-uppercase text-white me-5 enlace"  href="index.html">Inicio</a>
              <a class="fs-6 fw-bold text-uppercase text-white enlace"  href="formularioRegistro.php">Registrate</a>
          </div>
        </div> 
    </header>

  <main class="container p-2 contenido">
    <div class="row g-0 align-items-center justify-content-around">
      <div class="col-md-4">

        <form class="bg-light rounded p-3 m-5 shadow formulario" action="login.php" method="post">

            <?php
              if(isset($_GET['bloq']) && $_GET['bloq']==1){
                echo "<div class='alert alert-danger' id='bloqAlert' role='alert'>Usuario Bloqueado !!</div>";
                echo
                '<script>
                  setTimeout(function(){
                    document.getElementById("bloqAlert").remove();
                  },5000)
                </script>';
              }else if(isset($_GET['mail']) && $_GET['mail']==1){
                echo "<div class='alert alert-danger' id='mailAlert' role='alert'>El Usuario no Existe - Correo Incorrecto</div>";
                echo
                '<script>
                  setTimeout(function(){
                    document.getElementById("mailAlert").remove();
                  },5000)
                </script>';
              }else if(isset($_GET['pass']) && $_GET['pass']==1){
                echo "<div class='alert alert-danger' id='passAlert' role='alert'>El Usuario no Existe - Password Incorrecto</div>
                <div class='alert alert-info' id='passAlert2' role='alert'>Le quedan ".$_GET['inte']." intentos</div>";
                echo
                '<script>
                  setTimeout(function(){
                    document.getElementById("passAlert").remove();
                    document.getElementById("passAlert2").remove();
                  },5000)
                </script>';
              }else if(isset($_GET['captcha']) && $_GET['captcha']==1){
                echo "<div class='alert alert-danger' id='captchaAlert' role='alert'>Captcha Incorrecto</div>
                <div class='alert alert-info' id='captchaAlert2' role='alert'>Le quedan ".$_GET['inte']." intentos</div>";
                echo
                '<script>
                  setTimeout(function(){
                    document.getElementById("captchaAlert").remove();
                    document.getElementById("captchaAlert2").remove();
                  },5000)
                </script>';
              }else if(isset($_GET['login']) && $_GET['login']==1){
              echo "<div class='alert alert-success' id='loginAlert' role='alert'>Usuario Logueado con exito!!</div>";
              echo
              '<script>
                setTimeout(function(){
                  document.getElementById("loginAlert").remove();
                  window.location.href = "paginaUsuario.php";
                },5000)
              </script>';
              }
            ?>

            <label class="fs-6 p-1 mt-3">Introduzca Email:</label>
            <input class="form-control" id="email" type="email" placeholder="*****@*****.***" pattern="[a-zñ0-9._%+-]+@[a-z0-9.-]+\.[a-zñ]{2,3}$"  maxlength="40" name="email"  required>

            <label class="fs-6 p-1 mt-3">Introduzca Password:</label>
            <input class="form-control" id="pass1" type="password" placeholder="Contraseña"  minlength="5" name="contraseña1" required>

            <label class="fs-6 fw-bold p-1 mt-5">Captcha:</label>
            <div class="row align-items-center">
              <div class="col-md-6">
                <input class="form-control" id="captcha" type="text" placeholder="Código" minlength="6" name="captcha" required>
              </div>

              <div class="col-md-4">
                <img class="mx-auto d-block" src="captcha.php"/>
              </div>
            </div>
            

            <p  class="fs-6 p-1 mt-5">¿Aún no te has Registrado? <a href="formularioRegistro.html">Registrate</a>
            </p>
            
            <!-- <p  class="fs-6 p-1 mt-0">¿Has Olvidado tu Contraseña? <a href="formularioContraseña.php">Pulse aquí</a>
            </p> -->
            
            <button class="btn btn-dark w-100 " type="submit" id="iniciarSesion" value="login" onclick="getLocation()">Iniciar Sesión 
        </form>
      </div>

      <div class="col-md-4">
        <img class="img-fluid mt-5 mb-5 p-md-0 p-5" src="imagenes/icon-login.png" alt="login">
      </div>
    </div>
  </main>

  <footer class="p-3 bg-secondary footer">
    <div class="container row align-items-center">
      <div class="col-md-6 text-start">
        <p class="text-end fs-6 fw-bold text-uppercase text-white m-0">
          Diseño Interfaces Web - 
          <span class="text-center fs-5 fw-normal text-capitalize text-white m-0"> Fernando Garcia Berraquero</span>
        </p>
      </div>
      <div class="col-md-6 text-end">
          <a class="fs-6 fw-bold text-uppercase text-white enlace"  href="contactanos.php">Contáctanos</a>
      </div>
    </div>  
  </footer>

  <script>

    
    function myMap(position) {
            var userLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

            //AQUI esta la forma de ver si se esta en una localizacion para poder logearte

            // Definir las coordenadas de la ubicación deseada
            var ubicacionDeseada = new google.maps.LatLng(<?php echo $ubicacion_deseada['latitud']; ?>, <?php echo $ubicacion_deseada['longitud']; ?>);

            // Calcular la distancia entre la ubicación del usuario y la ubicación deseada
            var distancia = google.maps.geometry.spherical.computeDistanceBetween(userLocation, ubicacionDeseada);

            if (distancia > 1000) { // Cambia el valor según tu preferencia en metros
                alert("No estás en la ubicación deseada - NO puedes Iniciar Sesión");
                location.reload();
            }
            //Fin de localizacion para logearte

            var mapProp = {
                center: userLocation,
                zoom: 15
            };
            var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

            var marker = new google.maps.Marker({
                position: userLocation,
                map: map,
                title: 'Tu ubicación'
            });
        }

    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(myMap);
      } else {
        alert("La geolocalización no está disponible en tu navegador.");
      }
    }
  </script>

</body>

</html>