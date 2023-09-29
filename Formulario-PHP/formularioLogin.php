<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesion</title>
    
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

            <div class="col-md-4 text-end" >
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
              if(isset($_GET['mail']) && $_GET['mail']==1){
                echo "<div class='alert alert-danger' id='mailAlert' role='alert'>El Usuario no Existe - Correo Incorrecto</div>";
                echo
                '<script>
                  setTimeout(function(){
                    document.getElementById("mailAlert").remove();
                  },5000)
                </script>';
              }else if(isset($_GET['pass']) && $_GET['pass']==1){
                echo "<div class='alert alert-danger' id='passAlert' role='alert'>El Usuario no Existe - Password Incorrecto</div>";
                echo
                '<script>
                  setTimeout(function(){
                    document.getElementById("passAlert").remove();
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

            <p  class="fs-6 p-1 mt-3">¿Aún no te has Registrado? <a href="formularioRegistro.html">Registrate</a>
            </p>
            <button class="btn btn-dark w-100 mt-3" type="submit" value="login">Iniciar Sesión 
        </form>
      </div>

      <div class="col-md-4">
        <img class="img-fluid mt-5 mb-5" src="imagenes/icon-login.png" alt="login">
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