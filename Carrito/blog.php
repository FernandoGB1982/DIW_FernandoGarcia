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