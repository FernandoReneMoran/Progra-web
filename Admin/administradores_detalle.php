<?php
require "funciones/conecta.php";
$con = conecta();

$id = $_REQUEST['id'];

$sql = "SELECT * FROM administradores
        WHERE id = $id";

$res = $con->query($sql);



echo "<div class =\"encabezado\">";
echo "<h1 class =\"titulo-listado\">Detalles del Administrador</h1>";
echo "</div>";
include 'adminNavBar.php';
echo "<a class =\"link-lista\" href=\"administradores_lista.php\" >Regresar al listado de administradores</a><br><br>";

echo '
        <!DOCTYPE html>
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" type="text/css" href="estilos/administradores_detalle.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        </head>';
echo "<div class =\"tabla-completa\">";
echo "<div class =\"contenedor-fila\">";
echo "<p class =\"titulo-n\">Nombre y apellidos</p>";
echo "<p class =\"titulo-n\">correo</p>";
echo "<p class =\"titulo-n\">Rol</p>";
echo "<p class =\"titulo-final\">Estado</p>";
echo "</div>";

while($row = $res->fetch_array()){
    $nombre     =$row["nombre"];
    $apellidos     =$row["apellidos"];
    $correo = $row["correo"];
    $rol =$row["rol"];
    $status =$row["status"];
    $archivo_n = $row["archivo_n"];
    $archivo = $row["archivo"];
    $separacion = explode(".",$archivo_n);
    $nombre_archivo = $separacion[0];

    if($status == 1){
        $status = "Activo";
    }elseif($rol == 0){ 
        $status = "Inactivo";
    }

    if($rol == 1){
        $rol = "Gerente";
    }elseif($rol == 2){
        $rol = "Ejecutivo";
    }

    echo "<div id = \"contenedor-fila\" class =\"contenedor-fila\">";
    echo "<p class =\"dato-n\">$nombre $apellidos</p>";
    echo "<p class =\"dato-n\">$correo</p>";
    echo "<p class =\"dato-n\">$rol</p>";
    echo "<p class =\"dato-final\">$status</p>";
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