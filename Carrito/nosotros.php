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
                </nav>
            </div> <!-- row -->
        </div>
    </header>

    <main class="container-xl mt-5">
    <h2 class="text-center">Nuestra Tienda</h2>
    <div class="row mt-5 align-items-center">
        <div class="col-md-6">
            <img class="img-fluid" src="build/img/nosotros.jpg" alt="imagen tienda">
        </div>

        <div class="col-md-6 mt-5 mt-md-0">
            <p class="fs-5">Explora nuestra amplia selección de guitarras, accesorios y equipos de música. Desde guitarras eléctricas y acústicas hasta amplificadores, cuerdas y más, tenemos todo lo que necesitas para llevar tu música al siguiente nivel.</p>
            <p class="fs-5">Nuestro equipo de expertos en música está aquí para ayudarte a encontrar el instrumento perfecto para ti. Ya seas un principiante que busca su primera guitarra o un músico experimentado en busca de equipo profesional, ¡estamos aquí para satisfacer todas tus necesidades musicales!</p>
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
    
</body>
</html>