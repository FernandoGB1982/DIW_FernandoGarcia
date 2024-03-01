<?php
include 'src/assets/conexion.php';
$sacaTodo = "SELECT * FROM guitarras";
$ejecutar = mysqli_query($conexion, $sacaTodo);

// Consulta para obtener los detalles de la guitarra con el precio máximo
$sacaMax = "SELECT * FROM guitarras WHERE Precio = (SELECT MAX(Precio) FROM guitarras)";
$ejecutarMax = mysqli_query($conexion, $sacaMax);
$arrayMax = mysqli_fetch_array($ejecutarMax);

session_start();
//echo $_SESSION["idUsuario"];
?>
<style>
    #confirmacionModal {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: white;
    padding: 20px;
    z-index: 1000;
    text-align: center;
}

#confirmacionContenedor {
    margin-top: 20px; /* Add margin for better appearance */
}

#overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 999;
}

#overlay.active {
    display: block;
}
</style>

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
                    <?php
                    // Verificar si el idUsuario está presente en la sesión
                    if (isset($_SESSION["idUsuario"])) { 
                        echo '<button style="margin-left: 10px;" class="px-2 py-1 btn btn-primary text-white text-uppercase fs-6 ml-4" id="cerrarSesionBtn">Cerrar Sesión</button>';
                    } else {
                        // Si no está presente, puedes mostrar un enlace de inicio de sesión
                        echo '<a class="d-block px-2 py-1 fs-6 fw-bold text-uppercase" href="login.php">Inicia Sesión</a>';
                    }
                    ?>
                </nav>
            </div> <!-- row -->

            <div class="row mt-5">
                <div class="col-md-6 text-center text-md-start pt-5">
                    <h1 class="display-2 fw-bold"><?php echo $arrayMax['Nombre']; ?></h1>
                    <p class="mt-5 fs-5 text-white"><?php echo $arrayMax['Descripcion']; ?></p>
                    <p class="text-primary fs-1 fw-black"><?php echo $arrayMax['Precio']; ?>€</p>
                    <a class="btn fs-4 bg-primary text-white py-2 px-5" href="producto.php?id=<?php echo $arrayMax['idGuitarras']; ?>">Ver Producto</a>
                </div>
            </div> <!-- row -->
        </div>

        <img class="header-guitarra" src="build/img/header_guitarra.png" alt="imagen header">
    </header>

    <main class="container-xl mt-5">
        <h2 class="text-center">Nuestros Productos</h2>

        <div class="row mt-5">
            <?php while ($rs = mysqli_fetch_array($ejecutar)){ ?>
            <div class="col-md-6 col-lg-4 my-4 row align-items-center">
                <div class="col-4">
                    <img class="img-fluid" src="src/img/<?php echo $rs["Portada"];?>.jpg" alt="imagen guitarra">
                </div>
                <div class="col-8">
                    <h3 class="text-black fs-5 fw-bold text-uppercase"><?php echo $rs['Nombre']; ?></h3>
                    <p class=""><?php echo $rs['Descripcion']; ?></p>
                    <p class="fw-black text-primary fs-3"><?php echo $rs['Precio']; ?>€</p>

                    <a class="bg-black d-block text-center p-2 text-uppercase fw-black" href="producto.php?id=<?php echo $rs["idGuitarras"];?>">Ver Producto</a>
                </div>
            </div><!-- guitarras-->
            <?php }?>
        </div>
    </main>


    <section class="cursos">
        <div class="container-xl">
            <div class="row justify-content-md-end">
                <div class="col-md-6 text-center">
                    <h3>Aprende a tocar Guitarra</h3>
                    <p class="text-white mt-3 fs-5">¿Siempre has querido aprender a tocar la guitarra pero no sabes por dónde empezar? ¡No te preocupes! En nuestros cursos, te enseñamos desde lo básico hasta técnicas avanzadas para que puedas convertirte en un experto guitarrista. Nuestros profesores altamente calificados te guiarán en tu viaje musical para que puedas tocar tus canciones favoritas en poco tiempo.</p>
                    <!-- <a class="bg-primary text-white py-2 px-5 mt-2 fw-black text-uppercase" href="#">Descubre Nuestros Cursos</a> -->
                </div>
            </div>
        </div>
    </section>


    <section class="container-xl mt-5">
        <h2 class="text-center">Nuestro Blog</h2>

        <div class="row mt-5">
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card">
                    <img class="card-img-top" src="build/img/blog_1.jpg" alt="imagen blog">
                    <div class="card-body">
                        <h3 class="text-black fw-normal fs-4">Cómo elegir tu primera guitarra</h3>
                        <p class="text-primary">20 de Septiembre de 2023</p>
                        <p>¿Estás listo para comprar tu primera guitarra pero no estás seguro por dónde empezar? En esta guía te explicamos todo lo que necesitas saber para tomar la mejor decisión. Desde los diferentes tipos de guitarras hasta qué características considerar al elegir tu instrumento ideal. Exploraremos técnicas de armonización.</p>
                        <a class="btn btn-primary d-block text-white text-uppercase fs-6 mt-4" href="entrada.php?entrada=1">Leer Entrada</a>
                    </div>
                </div>
            </div><!-- col-md-6-->

            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card">
                    <img class="card-img-top" src="build/img/blog_2.jpg" alt="imagen blog">
                    <div class="card-body">
                        <h3 class="text-black fw-normal fs-4">Cómo mejorar tu técnica de guitarra</h3>
                        <p class="text-primary">12 de Julio de 2023</p>
                        <p>¿Quieres perfeccionar tu técnica de guitarra? En este artículo, te proporcionamos consejos prácticos y ejercicios efectivos para ayudarte a mejorar tu habilidad en la guitarra. Desde ejercicios de digitación básica hasta consejos avanzados para desarrollar tu velocidad y precisión, ¡encuentra todo lo que necesitas para llevar tu técnica al siguiente nivel!</p>
                        <a class="btn btn-primary d-block text-white text-uppercase fs-6 mt-4" href="entrada.php?entrada=2">Leer Entrada</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card">
                    <img class="card-img-top" src="build/img/blog_3.jpg" alt="imagen blog">
                    <div class="card-body">
                        <h3 class="text-black fw-normal fs-4">Cómo componer tu primera canción</h3>
                        <p class="text-primary">5 de Noviembre de 2023</p>
                        <p>¿Alguna vez has querido escribir tu propia música pero no sabes por dónde empezar? En este blog, te guiamos a través del proceso de composición de tu primera canción en guitarra. Desde la estructura de la canción hasta cómo crear melodías pegajosas, ¡descubre todos los pasos para convertirte en un compositor de guitarra!</p>
                        <a class="btn btn-primary d-block text-white text-uppercase fs-6 mt-4" href="entrada.php?entrada=3">Leer Entrada</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card">
                    <img class="card-img-top" src="build/img/blog_4.jpg" alt="imagen blog">
                    <div class="card-body">
                        <h3 class="text-black fw-normal fs-4">Los mejores accesorios para guitarristas</h3>
                        <p class="text-primary">18 de Abril de 2023</p>
                        <p>¿Buscas mejorar tu experiencia como guitarrista? En este artículo, te presentamos una selección de los mejores accesorios para guitarristas, desde afinadores y capos hasta pedales de efectos y correas de guitarra. Descubre cómo estos accesorios pueden ayudarte a potenciar tu sonido y rendimiento en el escenario.</p>
                        <a class="btn btn-primary d-block text-white text-uppercase fs-6 mt-4" href="entrada.php?entrada=4">Leer Entrada</a>
                    </div>
                </div>
            </div>

    </section>

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

    <div id="overlay"></div>

    <div id="confirmacionModal">
        <div id="confirmacionContenedor">
            <p>¿Estás seguro de que quieres cerrar la sesión?</p>

            
            <button class="btn btn-primary text-white text-uppercase fs-6 mt-4" id="confirmarCerrarSesionBtn">Sí, cerrar sesión</button>
            <button class="btn btn-primary text-white text-uppercase fs-6 mt-4" id="cancelarCerrarSesionBtn">Cancelar</button>
        </div>
    </div>

    <script>
        document.getElementById("cerrarSesionBtn").addEventListener("click", function() {
            // Muestra el modal de confirmación y activa el overlay
            console.log("Cerrar sesión button clicked");
            document.getElementById("confirmacionModal").style.display = "block";
            document.getElementById("overlay").classList.add("active");
        });

        document.getElementById("confirmarCerrarSesionBtn").addEventListener("click", function() {
            // Redirige a cerrar_sesion.php al confirmar
            console.log("Confirmar cerrar sesión button clicked");
            window.location.href = "cerrar_sesion.php";
        });

        document.getElementById("cancelarCerrarSesionBtn").addEventListener("click", function() {
            // Oculta el modal y desactiva el overlay si se cancela
            console.log("Cancelar cerrar sesión button clicked");
            document.getElementById("confirmacionModal").style.display = "none";
            document.getElementById("overlay").classList.remove("active");
        });
    </script>
</body>
</html>
