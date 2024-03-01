<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['index']) && isset($_POST['quantity'])) {
        $index = $_POST['index'];
        $newQuantity = (int)$_POST['quantity'];

        if (isset($_SESSION['carrito'][$index])) {
            $_SESSION['carrito'][$index]['cantidad'] = $newQuantity;
        }
    }
}
?>