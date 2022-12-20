<?php
require "funciones/conecta.php";
$con = conecta();

$id = $_REQUEST['id'];

$sql = "SELECT * FROM productos
        WHERE id = $id";

$res = $con->query($sql);



echo "<div class =\"encabezado\">";
echo "<h1 class =\"titulo-listado\">Detalles del Producto</h1>";
echo "</div>";
include 'adminNavBar.php';
echo "<a class =\"link-lista\" href=\"productos_lista.php\" >Regresar al listado de productos</a><br><br>";

echo '
        <!DOCTYPE html>
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" type="text/css" href="estilos/administradores_detalle.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        </head>';
echo "<div class =\"tabla-completa\">";
echo "<div class =\"contenedor-fila\">";
echo "<p class =\"titulo-n\">Nombre del producto</p>";
echo "<p class =\"titulo-n\">Codigo</p>";
echo "<p class =\"titulo-n\">Descripcion</p>";
echo "<p class =\"titulo-n\">Costo</p>";
echo "<p class =\"titulo-final\">Stock</p>";
echo "</div>";

while($row = $res->fetch_array()){
    $nombre     =$row["nombre"];
    $codigo     =$row["codigo"];
    $descripcion = $row["descripcion"];
    $costo =$row["costo"];
    $stock =$row["stock"];
    $archivo_n = $row["archivo_n"];
    $archivo = $row["archivo"];
    $separacion = explode(".",$archivo_n);
    $nombre_archivo = $separacion[0];


    echo "<div id = \"contenedor-fila\" class =\"contenedor-fila\">";
    echo "<p class =\"dato-n\">$nombre</p>";
    echo "<p class =\"dato-n\">$codigo</p>";
    echo "<p class =\"dato-n\">$descripcion</p>";
    echo "<p class =\"dato-n\">$costo</p>";
    echo "<p class =\"dato-final\">$stock</p>";
    echo "</div>";
    echo "<div id = \"contenedor-imagen\" class =\"contenedor-imagen\">";
    echo "<div id = \"marco-imagen\" class =\"marco-imagen\">";
    echo "<div class =\"contenedor-imagenNombre\">";
    echo "<p class =\"nombre-imagen\">$nombre_archivo</p>";
    echo "</div>";
    echo "<img class =\"imagen\" src = \"archivos/$archivo.jpg\">";
    echo "</div>";
    echo "</div>";
    echo "</div>";
}
?>