<?php
session_start();
$idU =$_SESSION['idU'];
$nombreU =$_SESSION['nombre'];
$correoU =$_SESSION['correo'];
if($idU == ''){
    header("Location: index.php");
}
echo '
        <!DOCTYPE html>
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" type="text/css" href="estilos/adminNavBar.css">
        </head>';
echo "<div class =\"navBar-container\">";
echo "<div class =\"titles-container\">";
echo "<a href = \"bienvenido.php\" class =\"text-url\">Inicio</a>";
echo "<a href = \"administradores_lista.php\" class =\"text-url\">Administradores</a>";
echo "<a href = \"productos_lista.php\" class =\"text-url\">Productos</a>";
echo "<a href = \"banners_lista.php\" class =\"text-url\">Banners</a>";
echo "<a href = \"pedidos_lista.php\" class =\"text-url\">Pedidos</a>";
echo "<p class =\"nombre-admin\">$nombreU</p>";
echo "<a href = \"funciones/eliminarSesion.php\" class =\"text-url-red\">Cerrar Sesion</a>";
echo"</div>";
echo"</div>";
?>