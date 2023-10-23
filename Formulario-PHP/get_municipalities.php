<?php
$selectedProvinciaId = $_GET['id'];

$conexion = mysqli_connect("localhost", "root", "", "usuario") or die("Problemas con la conexión");

$municipalities = [];
$query = "SELECT idMunicipio, Municipio FROM municipios WHERE idProvincia = $selectedProvinciaId";
$result = mysqli_query($conexion, $query);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $municipalities[] = $row;
    }
}

mysqli_close($conexion);

header('Content-Type: application/json');
echo json_encode($municipalities);
?>




