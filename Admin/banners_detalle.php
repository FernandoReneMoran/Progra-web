<?php
require "funciones/conecta.php";
$con = conecta();

$id = $_REQUEST['id'];

$sql = "SELECT * FROM banners
        WHERE id = $id";

$res = $con->query($sql);



echo "<div class =\"encabezado\">";
echo "<h1 class =\"titulo-listado\">Detalles de Banners</h1>";
echo "</div>";
include 'adminNavBar.php';
echo "<a class =\"link-lista\" href=\"banners_lista.php\" >Regresar al listado de banners</a><br><br>";

echo '
        <!DOCTYPE html>
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" type="text/css" href="estilos/banners_detalle.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        </head>';
echo "<div class =\"tabla-completa\">";
echo "<div class =\"contenedor-fila\">";
echo "<p class =\"titulo-n\">Nombre del banner</p>";
echo "</div>";

while($row = $res->fetch_array()){
    $nombre     =$row["nombre"];
    $archivo = $row["archivo"];


    echo "<div id = \"contenedor-fila\" class =\"contenedor-fila\">";
    echo "<p class =\"dato-n\">$nombre</p>";
    echo "</div>";
    echo "<div id = \"contenedor-imagen\" class =\"contenedor-imagen\">";
    echo "<div id = \"marco-imagen\" class =\"marco-imagen\">";
    echo "<img class =\"imagen\" src = \"archivos/$archivo.jpg\">";
    echo "</div>";
    echo "</div>";
    echo "</div>";
}
?>