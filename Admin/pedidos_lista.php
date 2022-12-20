<!DOCTYPE html>
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" type="text/css" href="estilos/pedidos_lista.css">
            
        </head>
        <body><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        </body>
       
<?php
//banners_lista.php
require "funciones/conecta.php";
$con = conecta();

$sql = "SELECT * FROM pedidos
        WHERE status = 1";

$res = $con->query($sql);
echo "<div class =\"encabezado\">";
echo "<h1 class =\"titulo-listado\">Listado de Pedidos</h1>";
echo "</div>";
include 'adminNavBar.php';
echo "<div class =\"tabla-completa\">";
echo "<div class =\"contenedor-fila\">";
echo "<p class =\"titulo-n\">Detalles</p>";
echo "<p class =\"titulo-n\">ID</p>";
echo "<p class =\"titulo-n\">Usuario</p>";
echo "<p class =\"titulo-final\">Fecha del pedido</p>";
echo "</div>";


while($row = $res->fetch_array()){
    
    $id     =$row["id"];
    $fecha     =$row["fecha"];
    $usuario     =$row["usuario"];

    echo "<div id = \"contenedor-fila{$id}\" class =\"contenedor-fila\">";
    echo "<a href=\"pedidos_detalle.php?id=$id\" class =\"detalle-n\">Informacion</a>";
    echo "<p id=\"{$id}\" class =\"dato-n\">$id</p>";
    echo "<p class =\"dato-n\">$usuario</p>";
    echo "<p class =\"dato-final\">$fecha</p>";
    echo "</div>";
}
echo "</div>";
?>