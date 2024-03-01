
<?php
include 'src/assets/conexion.php';
$id = intval($_GET['id']);
$sacaTodo = "SELECT * FROM guitarras WHERE idGuitarras = $id";
$ejecutar = mysqli_query($conexion, $sacaTodo);
//session_start();
//session_destroy();
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
    <a class="d-block px-2 py-1 fs-6 fw-bold text-uppercase" href="nosotros.php">Nosotros</a>
    <a class="d-block px-2 py-1 fs-6 fw-bold text-uppercase" href="blog.php">Blog</a>
    <a class="d-block px-2 py-1 fs-6 fw-bold text-uppercase" href="tienda.php">Tienda</a>
    <a class="d-block px-2 py-1 fs-6 fw-bold text-uppercase" href="carrito.php">Carrito</a>
</nav>
            </div> 
        </div>
    </header>

    <main class="container-xl mt-5">
    <?php if($rs = mysqli_fetch_array($ejecutar)){ 
        
        ?>

        <div class="row justify-content-center align-items-center">
            <div class="col-4 col-md-2">
                <img class="img-fluid" src="src/img/<?php echo $rs["Portada"];?>.jpg" alt="imagen guitarra">
            </div>
            <div class="col-8 col-md-4">
                
                <h3 class="text-black fs-5 fw-bold text-uppercase"><?php echo $rs["Nombre"];?> </h3>
                <p class=""><?php echo $rs["Nombre"];?></p>
                <p class="fw-black text-primary fs-3"><?php echo $rs["Precio"];?>€</p>
               
                <form class="row" action="carrito.php" method="post">
    <div class="col-12">
        <div class="form-group">
            <label class="form-label">Cantidad:</label>
            <select class="form-control" name="cantidad" id="cantidad">
                <?php 
                    $portada = $rs["Portada"];
                    $nombre = $rs['Nombre'];
                    $idGuitarra = $rs['idGuitarras'];
                    $precio = $rs['Precio'];
                    $cantidad_disponible = $rs["Cantidad"];
                    $max_cantidad = ($cantidad_disponible >= 10) ? 10 : $cantidad_disponible;

                    for ($i = 1; $i <= $max_cantidad; $i++) { 
                ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>

    <div class="col-12 d-grid">
        <input type="hidden" name="nombre" value="<?php echo $nombre; ?>">
        <input type="hidden" name="precio" value="<?php echo $precio; ?>">
        <input type="hidden" name="idGuitarra" value="<?php echo $idGuitarra; ?>">
        <input type="hidden" name="portada" value="<?php echo $portada; ?>">
        <input type="hidden" name="cantidad_seleccionada" id="cantidad_seleccionada" value="1">
        <?php if($cantidad_disponible >=1){?>
            <input class="btn btn-primary text-white text-uppercase fs-6 mt-4 d-block" type="submit" value="Agregar al Carrito">
        <?php }else{ ?>
            <p class="btn btn-danger text-white text-uppercase fs-6 mt-4 d-block">AGOTADO</p>
        <?php } ?>
    </div>
</form>

<script>
    document.getElementById('cantidad').addEventListener('change', function() {
        document.getElementById('cantidad_seleccionada').value = this.value;
    });
</script>

            </div>
        </div>
        <?php } ?> 
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