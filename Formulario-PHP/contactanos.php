
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contáctanos</title>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAK4PKDT4ASOivyIgRqB52BgMdUNSadjm0&callback=initMap" defer></script>

    <link rel="stylesheet" href="estilos/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="estilos/estilos.css">

    <style>
        #googleMap {
          height:300px;
          display:flex;
          margin:auto;
        } 
    </style>
</head>

<body>

  <header class="pt-3 bg-secondary container-fluid header">
    <div class="container">
      <div class="row align-items-center justify-content-between">
          <div class="col-md-4 text-center">
              <h1 class="text-white titulo">Contacta con nosotros</h1>
          </div>

          <div class="col-md-4 text-md-end text-center" >
            <a class="fs-6 fw-bold text-uppercase text-white enlace me-5"  href="index.html">Inicio</a>
        </div>
      </div> 
  </header>

  <main class="container p-2 contenido pb-md-0 pb-5">
    <div class="row g-0 align-items-center justify-content-around">
        <div class="col-md-4 bg-light rounded p-3 m-5 shadow contacto">
            <h2 class="fs-3 fw-bold text-center">Información de contacto</h2>
            <p class="pt-3">¡Estamos encantados de que te pongas en contacto con nosotros! Puedes hacerlo a través de los siguientes métodos:</p>
                
            <ul>
                <li><strong>Teléfono:</strong> 123 - 456789</li>
                <li><strong>Correo Electrónico:</strong> <a href="mailto:correo@correo.com">correo@correo.com</a></li>
                <li><strong>Dirección:</strong> 
                  <p class="m-0">Av. de Chipiona, s/n</p>
                  <p class="m-0">11560 Trebujena</p>
                  <p class="m-0">Cádiz</p>
                  <p class="m-0">España</p>
                </li>
            </ul>

            <div class="col-md-4" id="googleMap"></div>
        </div>

        <div class="col-md-4 bg-light rounded p-3 m-5 shadow formulario">
            <h2 class="fs-3 fw-bold text-center">Formulario de contacto</h2>
            <p class="pt-3">Si prefieres, puedes enviarnos un mensaje a través de este formulario:</p>

            <form action="incidencias.php" method="post">
              
                <?php
                  if(isset($_GET['incidencia']) && $_GET['incidencia']==1){
                    echo "<div class='alert alert-success' id='incidenciaAlert' role='alert'>Se ha agregado una incidencia</div>";
                    echo
                    '<script>
                      setTimeout(function(){
                        document.getElementById("incidenciaAlert").remove();
                      },5000)
                    </script>';
                  }
                ?> 

                <label class="fs-6 p-1">Introduzca Nombre:</label>
                <input class="form-control" id="nombre" type="text" pattern="^[A-ZÁÉÍÓÚÑ][A-ZÁÉÍÓÚÑa-záéíóúñ\s]*$" maxlength="40" name="nombre" required>

                <label class="fs-6 p-1 mt-3">Introduzca Email:</label>
                <input class="form-control" id="email" type="email" placeholder="*****@*****.***" pattern="[a-zñ0-9._%+-]+@[a-z0-9.-]+\.[a-zñ]{2,3}$"  maxlength="40" name="email"  required>

            
                <label class="fs-6 p-1 mt-3" for="nombre">Incidencia:</label>
                <textarea class="form-control" id="incidencia" name="incidencia" rows="4" cols="52" maxlength="100"required></textarea>

                <button class="btn btn-dark w-100 mt-3" type="submit">Enviar</button>
            </form>
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
    function initMap() {
        var trebujenaLocation = { lat: 36.867089191798755, lng: -6.178597334558331};
        var map = new google.maps.Map(document.getElementById("googleMap"), {
            center: trebujenaLocation,
            mapTypeId: 'roadmap',
            zoom: 16
        });

        var marker = new google.maps.Marker({
            position: trebujenaLocation,
            map: map,
            title: 'Trebujena, España'
        });
    }
  </script>

</body>

</html>