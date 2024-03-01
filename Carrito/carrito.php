
<?php
include 'src/assets/conexion.php';

session_start();
$cantidad_disponible = 0;
$cantidad_disponible_bd = 0;
$error_message="";

if (isset($_SESSION["idUsuario"])) {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['clear_all'])) {
            unset($_SESSION['carrito']);
        }

        if (isset($_POST['remove'])) {
            $removeIndexes = $_POST['remove'];
            if (isset($_SESSION['carrito'])) {
                foreach ($removeIndexes as $index) {
                    unset($_SESSION['carrito'][$index]);
                }
            }
        }
        

        if (isset($_POST['nombre'])) {
            $nombre = $_POST['nombre'];
            $cantidad = (int)$_POST['cantidad_seleccionada'];
            $precio = $_POST['precio'];
            $portada = $_POST["portada"];
            $id = $_POST['idGuitarra'];

            // Consulta a la base de datos para obtener la cantidad disponible del producto
            $sql = "SELECT Cantidad FROM guitarras WHERE idGuitarras = $id";
            $result = $conexion->query($sql);
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $cantidad_disponible_bd = $row['Cantidad']; // Cantidad disponible en la base de datos
                $cantidad_disponible = $cantidad_disponible_bd; // Inicialmente la cantidad disponible es la de la base de datos

                // Resta la cantidad seleccionada anteriormente de la cantidad disponible en la base de datos
                if (isset($_SESSION['carrito'])) {
                    foreach ($_SESSION['carrito'] as $item) {
                        if ($item['id'] == $id) {
                            $cantidad_disponible -= $item['cantidad'];
                        }
                    }
                }

                // Verifica si la cantidad seleccionada es mayor que la cantidad disponible
                if ($cantidad <= $cantidad_disponible) {
                    // El producto puede ser agregado al carrito
                    if (!isset($_SESSION['carrito'])) {
                        $_SESSION['carrito'] = [];
                    }

                    $productIndex = array_search($id, array_column($_SESSION['carrito'], 'id'));

                    if ($productIndex !== false) {
                        $_SESSION['carrito'][$productIndex]['cantidad'] += $cantidad;
                    } else {
                        $_SESSION['carrito'][] = [
                            'nombre' => $nombre,
                            'cantidad' => $cantidad,
                            'precio' => $precio,
                            'portada' => $portada,
                            'id' => $id
                        ];
                    }
                } else {
                    // La cantidad seleccionada excede la cantidad disponible, no agregues el producto al carrito
                    $error_message = "Lo sentimos, la cantidad seleccionada excede la cantidad disponible y no se puede añadir al carrito.";
                }
            }
        }
    }
}else{
    header("Location: mensaje_login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<style>
        img.table-image {
            max-width: 50px;
            height: auto; 
            display: block; 
            margin: 0 auto; 
        }
        td{
            max-width:50px;
        }
        p{
            color:red;
            text-align: center;
        }
        
    .quantity-cell {
        display: flex;
        align-items: center;
    }

    .quantity-buttons {
        display: flex;
        gap: 5px;
        align-items: center;
    }

    .quantity-input {
        width: 40px;
        text-align: center;
    }

    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GuitarLA - Carrito de Compras</title>
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
    <!--<a class="d-block px-2 py-1 fs-6 fw-bold text-uppercase" href="carrito.php">Carrito</a>-->
</nav>
            </div> 
        </div>
    </header>

    <main class="container-xl mt-5">
        <h2 class="text-center mb-4">Carrito de Compras</h2>
        <form action="" method="post">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Eliminar</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
if (isset($_SESSION['carrito'])) {
    foreach ($_SESSION['carrito'] as $index => $item) {
        $total = doubleval($item['cantidad']) * doubleval($item['precio']);
        ?>
        <tr>
            <td>
                <input type="checkbox" name="remove[]" value="<?php echo $index; ?>">
            </td>
            <td><?php echo $item['nombre']; ?></td>
            <td><img class="table-image" src="src/img/<?php echo $item['portada']; ?>.jpg" alt=""></td>
            <td class="quantity-cell">
                <div class="quantity-buttons">
                <button type="button" class="btn btn-sm btn-secondary" onclick="updateQuantity(<?php echo $index; ?>, -1, <?php echo $cantidad_disponible_bd; ?>)">-</button>

                    <input type="number" name="quantity[<?php echo $index; ?>]" value="<?php echo $item['cantidad']; ?>" min="1" max="10" class="quantity-input">


                    <button type="button" class="btn btn-sm btn-secondary" onclick="updateQuantity(<?php echo $index; ?>, 1, <?php echo $cantidad_disponible_bd; ?>)">+</button>
                </div>
            </td>
            <td precio="<?php echo $index; ?>"><?php echo $item['precio']; ?>€</td>
            <td total="<?php echo $index; ?>"><?php echo $total; ?>€</td>
        </tr>
        <?php
    }
}
?>
                    </tbody>
                    </table>
            </div>

            <!-- Muestra el mensaje de error debajo de la tabla JavaScript-->
            <div>
                <p class="error"></p>
            </div>

            <!-- Muestra el mensaje de error debajo de la tabla PHP-->
            <?php if (!empty($error_message)) { ?>
                <p ><?php echo $error_message; ?></p>
            <?php }else{ ?>
                <p></p>
            <?php } ?>

            <button class="btn btn-danger text-white text-uppercase fs-6 mt-4" type="" name="remove_selected">Eliminar Seleccionados</button>
            <button class="btn btn-danger text-white text-uppercase fs-6 mt-4" type="" name="clear_all">Vaciar Carrito</button>

            <?php if (!empty($_SESSION['carrito'])) { ?>
    <button class="btn btn-success text-white text-uppercase fs-6 mt-4" type="submit" formaction="tramitar.php" name="tramitar_pedido">Tramitar Pedido</button>
<?php } ?>
        </form>

        <script>
            function updateQuantity(index, change, maxQuantity) {
                var input = document.querySelector('input[name="quantity[' + index + ']"]');
                var currentQuantity = parseInt(input.value);
                var newQuantity = currentQuantity + change;

                // Verifica si el cambio está dentro de los límites permitidos
                if (newQuantity >= 1 && newQuantity <= maxQuantity) {
                    var error_message = "";
                    document.querySelector('.error').innerText = error_message;

                    input.value = newQuantity;
                    updateTotal(index);
                    updateQuantityInSession(index, newQuantity); 
                }else if (newQuantity < 1){
                    var error_message = "La cantidad seleccionada debe ser al menos 1. Si no quieres el producto seleccionelo y pulse eliminar seleccionados";
                    document.querySelector('.error').innerText = error_message;
                } else {
                    var error_message = "Lo sentimos, la cantidad seleccionada excede la cantidad disponible y no se puede añadir al carrito.";
                    document.querySelector('.error').innerText = error_message;
                }
            }

            function updateTotal(index) {
                // Obtiene el precio y la cantidad actual
                var priceCell = document.querySelector('td[precio="' + index + '"]');
                var price = parseFloat(priceCell.textContent); // Obtiene el precio
                var quantityInput = document.querySelector('input[name="quantity[' + index + ']"]');
                var quantity = parseInt(quantityInput.value); // Obtiene la cantidad

                // Calcula el nuevo total
                var total = price * quantity;

                // Actualiza el contenido de la celda de total
                var totalCell = document.querySelector('td[total="' + index + '"]');
                totalCell.textContent = total + "€";
            }

            function updateQuantityInSession(index, newQuantity) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'actualizar_carrito.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                    }
                };
                xhr.send('index=' + index + '&quantity=' + newQuantity);
            }
        </script>
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