<?php
include 'src/assets/conexion.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tramitar_pedido'])) {
    // Insertar el pedido en la tabla 'pedido'
    $fecha_pedido = date('Y-m-d');
    $idusuario = $_SESSION["idUsuario"];
    $sql_insert_pedido = "INSERT INTO pedido (fecha_pedido, idusuario) VALUES ('$fecha_pedido','$idusuario')";
    $result_insert_pedido = $conexion->query($sql_insert_pedido);
    
    if ($result_insert_pedido) {
        // Obtener el ID del pedido recién insertado
        $sql_max_pedido_id = "SELECT MAX(idPedido) FROM pedido";
        $result_max_pedido_id = $conexion->query($sql_max_pedido_id);

        if ($result_max_pedido_id && $result_max_pedido_id->num_rows > 0) {
            $row = $result_max_pedido_id->fetch_assoc();
            $id_pedido = $row['MAX(idPedido)']; 
    
            // Verificar si hay productos en el carrito antes de continuar
            if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {

                foreach ($_SESSION['carrito'] as $producto) {
                    $id_guitarra = $producto['id'];
                    $precio = $producto['precio'];
                    $cantidad = $producto['cantidad'];
                    
                    // Insertar la información del producto en 'pedidoinfo' con el mismo idpedido
                    $sql_insert_pedidoinfo = "INSERT INTO pedidoinfo (idpedido, idGuitarra, precio, cantidad) VALUES ($id_pedido, $id_guitarra, $precio, $cantidad)";
                    $result_insert_pedidoinfo = $conexion->query($sql_insert_pedidoinfo);

                    // Actualizar la cantidad disponible del producto en la tabla 'guitarras'
                    $sql_update_cantidad = "UPDATE guitarras SET Cantidad = Cantidad - $cantidad WHERE idGuitarras = $id_guitarra";
                    $result_update_cantidad = $conexion->query($sql_update_cantidad);
                }
            }
        } else {
            echo "No hay productos en el carrito.";
        }

        // Limpiar el carrito de compras
        unset($_SESSION['carrito']);

        // Cerramos sesion
        session_destroy();

        // Redireccionar a la página de confirmación del pedido
        header("Location: tramitar.php");
        exit();
    } else {
        // Manejar el error si no se puede insertar el pedido en 'pedido'
        echo "Error al insertar el pedido en pedido: " . $conexion->error;
    }
}
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
                </nav>
            </div> <!-- row -->
        </div>

        <img class="header-guitarra" src="build/img/header_guitarra.png" alt="imagen header">
    </header>

    <main class="container-xl mt-5">
        <div class="row mt-5">
            <p class="d-block px-2 py-1 fs-6 fw-bold text-uppercase text-center">Su pedido se ha tramitado correctamente. Sesión Cerrada</p>
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
