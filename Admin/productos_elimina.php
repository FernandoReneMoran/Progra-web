<?php
    //productos_elimina.php
require "funciones/conecta.php";
$con = conecta();

//Recibe variables
$id = $_REQUEST['id'];

//Consulta para eliminar de manera completa
//$sql = "DELETE FROM productos WHERE id = $id";
$sql = "UPDATE productos
        SET eliminado = 1
        WHERE id = $id";
        

$res = $con->query($sql);

echo $id;
?>