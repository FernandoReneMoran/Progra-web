<!DOCTYPE html>
    <head>
      <meta charset="UTF-8">
      <link rel="stylesheet" type="text/css" href="estilos/navBar.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <head>
<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
$idC =$_SESSION['idC'];
echo "<div class =\"iconNavBarContainer\">";
echo "<a href=\"index.php\">";
echo "<img class =\"icon\" src=\"imagenes/EzShop.png\" alt=\"Logo\">";
echo "</a>";
echo "<div class =\"homeNavBarContainer\">";
echo "<a class =\"nNavBarInfo\" href=\"index.php\">Home</a>";
echo "<a class =\"nNavBarInfo\" href=\"productos.php\">Productos</a>";
echo "<a class =\"nNavBarInfo\" href=\"contacto.php\">Contacto</a>";
echo "<a class =\"nNavBarInfo\" href=\"carrito01.php\">Carrito</a>";
if ($idC == '') {
  echo "<a class =\"lastNavBarInfo\" href=\"login.php\">Iniciar Sesion</a>";
} else {
  echo "<a class =\"lastNavBarInfo\" href=\"funciones/eliminarSesion.php\">Cerrar Sesion</a>";
}
echo "</div>";
echo "</div>";

?>