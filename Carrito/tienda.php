<?php
include 'src/assets/conexion.php';
$sacaTodo = "SELECT * FROM guitarras";
$ejecutar = mysqli_query($conexion, $sacaTodo);
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
                    <!--<a class="d-block px-2 py-1 fs-6 fw-bold text-uppercase" href="nosotros.php">Nosotros</a>-->
                    <!--<a class="d-block px-2 py-1 fs-6 fw-bold text-uppercase" href="blog.php">Blog</a>-->
                    <a class="d-block px-2 py-1 fs-6 fw-bold text-uppercase" href="tienda.php">Tienda</a>
                    <a class="d-block px-2 py-1 fs-6 fw-bold text-uppercase" href="carrito.php">Carrito</a>
                </nav>
            </div> <!-- row -->
        </div>
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
