<?php
    //banners_elimina.php
require "funciones/conecta.php";
$con = conecta();

//Recibe variables
$id = $_REQUEST['id'];

//Consulta para eliminar de manera completa
//$sql = "DELETE FROM banners WHERE id = $id";
$sql = "UPDATE banners
        SET eliminado = 1
        WHERE id = $id";
        

$res = $con->query($sql);

echo $id;
?>