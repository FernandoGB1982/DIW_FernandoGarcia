<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GuitarLA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;700;900&display=swap" rel="stylesheet"> 

    <link rel="stylesheet" href="build/css/app.css">
    
</head>

<body>
    <header class="py-5 header">
        <div class="container-xl">
            <div class="row justify-content-center justify-content-md-between">
                <div class="col-8 col-md-3">
                    <a href="index.php">
                        <img class="img-fluid" src="build/img/logo.svg" alt="imagen logo">
                    </a>
                </div>
                <nav class="col-md-6 text-center d-flex flex-column align-items-center mt-5 mt-md-0 flex-md-row justify-content-md-end navegacion">
                    <a class="d-block px-2 py-1 fs-6 fw-bold text-uppercase" href="index.php">Inicio</a>
                    <a class="d-block px-2 py-1 fs-6 fw-bold text-uppercase" href="nosotros.php">Nosotros</a>
                    <a class="d-block px-2 py-1 fs-6 fw-bold text-uppercase" href="blog.php">Blog</a>
                    <a class="d-block px-2 py-1 fs-6 fw-bold text-uppercase" href="tienda.php">Tienda</a>
                    <!-- <a class="d-block px-2 py-1 fs-6 fw-bold text-uppercase" href="carrito.php">Carrito</a>-->
                </nav>
            </div> <!-- row -->
        </div>

        <img class="header-guitarra" src="build/img/header_guitarra.png" alt="imagen header">
    </header>
    <main>
        <div class="container-xl col-md-4">
            <h2 class="text-center m-4">Crear Cuenta</h2>
            <!-- Formulario de Crear Cuenta (inicialmente oculto) -->
            <div class="create-account-form">
                
                <form id="createAccountForm" method="post" action="registrar_usuario.php">
                    <!-- Campos para crear cuenta -->
                    <div class="form-group">
                        <label for="newUsername">Nombre de usuario:</label>
                        <input type="text" id="newUsername" name="newUsername" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="newPassword">Contraseña:</label>
                        <input type="password" id="newPassword" name="newPassword" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="newConfirmPassword">Repetir Contraseña:</label>
                        <input type="password" id="newConfirmPassword" name="newConfirmPassword" class="form-control" required>
                        <span id="newPasswordError" class="error-message"></span>
                    </div>

                    <!-- Otros campos para crear cuenta -->
                    <div class="form-group">
                        <label for="newPhone">Número de teléfono:</label>
                        <input type="tel" id="newPhone" name="newPhone" class="form-control" required>
                        <span id="newTelefonoError" class="error-message"></span>
                    </div>

                    <div class="form-group">
                        <label for="newEmail">Correo Electrónico:</label>
                        <input type="email" id="newEmail" name="newEmail" class="form-control">
                    </div>

                    
                    
                    <!-- Botón para crear cuenta -->
                    <div class="container-xl text-center">
                        <button type="submit" class="btn btn-success text-white text-uppercase fs-6 mt-4" >Crear Cuenta</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </main>

    <footer class="bg-dark mt-5 py-5">
        <div class="container-xl d-md-flex justify-content-md-between">
            <nav class="d-flex flex-column flex-md-row align-items-center">
                <a class="text-white fs-4 me-md-2" href="index.php">Inicio</a>
                <a class="text-white fs-4 me-md-2" href="nosotros.php">Nosotros</a>
                <a class="text-white fs-4 me-md-2" href="blog.php">Blog</a>
                <a class="text-white fs-4 me-md-2" href="tienda.php">Tienda</a>
            </nav>
            <p class="text-white text-center fs-4 mt-4 mt-md-0">Todos los Derechos Reservados</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function () {
            // Mostrar el formulario de Crear Cuenta al hacer clic en el botón
            $("#showCreateAccountButton").click(function () {
                $(".create-account-form").toggle();
            });

            // Validación de campos de Crear Cuenta
            $("#newConfirmPassword").on("input", function () {
                var newPassword = $("#newPassword").val();
                var newConfirmPassword = $(this).val();
                if (newPassword !== newConfirmPassword) {
                    $("#newPasswordError").text("Las contraseñas no coinciden");
                } else {
                    $("#newPasswordError").text("");
                }
            });

            $("#newPhone").on("input", function () {
                var pattern = /^[0-9]{9}$/;
                var newTelefono = $(this).val();
                if (!pattern.test(newTelefono)) {
                    $("#newTelefonoError").text("El telefono es incorrecto");
                } else {
                    $("#newTelefonoError").text("");
                }
            });
        });
    </script>
</body>


</html>
