<!DOCTYPE html>
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" type="text/css" href="estilos/administradores_detalle.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        </head>
<?php
require "funciones/conecta.php";
$con = conecta();

$id = $_REQUEST['id'];

echo "<div class =\"encabezado\">";
echo "<h1 class =\"titulo-listado\">Detalles del Pedido</h1>";
echo "</div>";
include 'adminNavBar.php';
echo "<a class =\"link-lista\" href=\"pedidos_lista.php\" >Regresar al listado de pedidos</a><br><br>";

echo "<div class =\"tabla-completa\">";
echo "<div class =\"contenedor-fila\">";
echo "<p class =\"titulo-n\">Id del producto</p>";
echo "<p class =\"titulo-n\">Cantidad</p>";
echo "<p class =\"titulo-n\">Costo Unitario</p>";
echo "<p class =\"titulo-final\">Subtotal</p>";
echo "</div>";
$sql = "SELECT * FROM pedidos_productos
        WHERE id_pedido = $id";
$res = $con->query($sql);
$total = 0;
while($row = $res->fetch_array()){
    $id_producto     =$row["id_producto"];
    $cantidad     =$row["cantidad"];
    $precio = $row["precio"];
    $subtotal = $cantidad * $precio;
    $total+= $subtotal;
    echo "<div id = \"contenedor-fila\" class =\"contenedor-fila\">";
    echo "<p class =\"dato-n\">$id_producto</p>";
    echo "<p class =\"dato-n\">$cantidad</p>";
    echo "<p class =\"dato-n\">$precio</p>";
    echo "<p class =\"dato-final\">$subtotal</p>";
    echo "</div>";
}
echo "<div id = \"contenedor-fila\" class =\"contenedor-fila\">";
echo "<p class =\"titulo-n\">Total</p>";
echo "<p class =\"dato-n\"></p>";
echo "<p class =\"dato-n\"></p>";
echo "<p class =\"dato-final\">$total</p>";
echo "</div>";
echo "</div>";

?>