<?php
include 'src/assets/conexion.php';
$entrada = intval($_GET['entrada']);

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
                    <a class="d-block px-2 py-1 fs-6 fw-bold text-uppercase" href="nosostros.php">Nosotros</a>
                    <a class="d-block px-2 py-1 fs-6 fw-bold text-uppercase" href="blog.php">Blog</a>
                    <a class="d-block px-2 py-1 fs-6 fw-bold text-uppercase" href="tienda.php">Tienda</a>
                </nav>
            </div> <!-- row -->
        </div>
    </header>

    <main class="container-xl mt-5">
        <h2 class="text-center">Como elegir tu primera Guitarra</h2>
        
        <div class="row justify-content-center mt-5">
            <div class="col-md-7">
                <?php 
                if ($entrada === 1) { ?>
                        <div class="card">
                            <img class="card-img-top" src="build/img/blog_1.jpg" alt="imagen blog">
                            <div class="card-body">
                                <h3 class="text-black fw-normal fs-4">Cómo elegir tu primera guitarra</h3>
                                <p class="text-primary">20 de Septiembre de 2023</p>
                                <p>Comprar tu primera guitarra puede ser emocionante, pero también abrumador. ¿Acústica o eléctrica? ¿Clásica o de estilo moderno? Con tantas opciones disponibles, es comprensible sentirse indeciso. En esta guía completa, te llevaremos de la mano a través del proceso de selección de tu primera guitarra. Exploraremos los diferentes tipos de guitarras, desde las clásicas acústicas hasta las versátiles eléctricas, y te ayudaremos a entender qué características son más importantes según tu estilo musical y preferencias personales. Ya sea que estés buscando un sonido cálido y tradicional o un tono potente y distorsionado, aquí encontrarás la información que necesitas para tomar una decisión informada y encontrar el instrumento perfecto para ti.</p>

                            </div>
                        </div>
                <?php 
                } elseif ($entrada === 2) { ?>
                        <div class="card">
                            <img class="card-img-top" src="build/img/blog_2.jpg" alt="imagen blog">
                            <div class="card-body">
                                <h3 class="text-black fw-normal fs-4">Cómo mejorar tu técnica de guitarra</h3>
                                <p class="text-primary">12 de Julio de 2023</p>
                                <p>Perfeccionar tu técnica de guitarra es fundamental para convertirte en un músico habilidoso y expresivo. En este artículo exhaustivo, te sumergirás en un mundo de consejos prácticos y ejercicios efectivos diseñados para ayudarte a mejorar tu habilidad en la guitarra. Desde ejercicios de digitación que fortalecen tus dedos hasta estrategias para desarrollar tu velocidad y precisión, explorarás una amplia gama de técnicas y conceptos que te ayudarán a llevar tu juego al siguiente nivel. Además, aprenderás cómo aplicar estos principios a tu práctica diaria para obtener resultados tangibles y medibles. Ya sea que estés buscando dominar escalas y arpegios o desafiar tu creatividad con nuevas técnicas de improvisación, encontrarás todo lo que necesitas para alcanzar tus metas musicales en este completo recurso de desarrollo de habilidades.</p>

                            </div>
                        </div>
                <?php
                } elseif ($entrada === 3) {
                ?>
                        <div class="card">
                            <img class="card-img-top" src="build/img/blog_3.jpg" alt="imagen blog">
                            <div class="card-body">
                                <h3 class="text-black fw-normal fs-4">Cómo componer tu primera canción</h3>
                                <p class="text-primary">5 de Noviembre de 2023</p>
                                <p>La composición de música es una expresión única de tu creatividad y visión artística. Si alguna vez has soñado con escribir tu propia música pero te has sentido abrumado por el proceso, estás en el lugar adecuado. En este detallado blog, te llevaremos de la mano a través del emocionante viaje de componer tu primera canción en guitarra. Desde los conceptos básicos de la estructura de la canción hasta los secretos para crear melodías que se queden en la mente de tus oyentes, explorarás cada paso del proceso de composición de manera clara y accesible. Aprenderás cómo seleccionar acordes que transmitan la emoción que deseas, cómo construir progresiones armónicas convincentes y cómo añadir elementos como ritmos y arreglos para dar vida a tu música. Con ejemplos prácticos y consejos útiles, este blog te equipará con las herramientas necesarias para convertirte en un compositor de guitarra seguro y creativo. ¡Prepárate para dar rienda suelta a tu inspiración y dejar una marca duradera en el mundo de la música!</p>

                            </div>
                        </div>
                <?php
                } elseif ($entrada === 4) {
                ?>
                        <div class="card">
                            <img class="card-img-top" src="build/img/blog_4.jpg" alt="imagen blog">
                            <div class="card-body">
                                <h3 class="text-black fw-normal fs-4">Los mejores accesorios para guitarristas</h3>
                                <p class="text-primary">18 de Abril de 2023</p>
                                <p>Si estás buscando llevar tu experiencia como guitarrista al siguiente nivel, estás en el lugar correcto. En este artículo exhaustivo, te llevaremos a través de una selección cuidadosamente curada de los mejores accesorios para guitarristas disponibles en el mercado. Desde los indispensables afinadores y capos hasta los emocionantes pedales de efectos y las cómodas correas de guitarra, encontrarás todo lo que necesitas para potenciar tu sonido y rendimiento en el escenario. Explora cómo cada accesorio puede influir en tu estilo de tocar y cómo puedes integrarlos de manera efectiva en tu práctica diaria y actuaciones en vivo. Con consejos expertos sobre cómo seleccionar los accesorios adecuados para tus necesidades y preferencias, este artículo te ayudará a construir un arsenal de herramientas que te permitirá expresarte plenamente como guitarrista. Desde mejorar la afinación de tu instrumento hasta experimentar con nuevos sonidos y efectos, estos accesorios te brindarán una nueva dimensión de creatividad y versatilidad en tu música. ¡Descubre cómo estos accesorios pueden llevar tu música al siguiente nivel y elevar tu experiencia como guitarrista a nuevas alturas!</p>

                            </div>
                        </div>
                <?php
                }
                ?>

                
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