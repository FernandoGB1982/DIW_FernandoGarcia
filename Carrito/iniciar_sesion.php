<?php
session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $conn = new mysqli("localhost", "root", "", "proyecto_guitarra");

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $query = "SELECT idusuario FROM usuarios WHERE usuario = ? AND passwordUsuario = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($idUsuario);
        $stmt->fetch();
        $_SESSION["idUsuario"] = $idUsuario;
        $_SESSION["nombreUsuario"] = $username;
        
        header("Location: index.php");
        exit();

    } else {
        ?>
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

                    <!-- <link rel="stylesheet" href="build/css/app.css"> -->
                    <link rel="stylesheet" href="build/css/app.min.css">
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
                                <?php
                                // Verificar si el idUsuario está presente en la sesión
                                if (isset($_SESSION["idUsuario"])) {
                                    echo '<a class="d-block px-2 py-1 fs-6 fw-bold text-uppercase" href="carrito.php">Carrito</a>';
                                    echo '<button class="d-block px-2 py-1 fs-6 fw-bold text-uppercase" id="cerrarSesionBtn">Cerrar Sesión</button>';
                                } else {
                                    // Si no está presente, puedes mostrar un enlace de inicio de sesión
                                    echo '<a class="d-block px-2 py-1 fs-6 fw-bold text-uppercase" href="login.php">Inicia Sesión</a>';
                                }
                                ?>
                                </nav>
                            </div> <!-- row -->
                        </div>

                        <img class="header-guitarra" src="build/img/header_guitarra.png" alt="imagen header">
                    </header>

                    <main class="container-xl mt-5">
                        <div class="row mt-5">
                            <p class="d-block px-2 py-1 fs-6 fw-bold text-uppercase text-center">Sus Credenciales son incorrectas</p>
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
                    
                </body>
                </html>
        <?php
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: index.php");
    exit();
}
?>
