<?php
require "conecta.php";
$con = conecta();
$id = $_REQUEST['id'];
$idCarrito = $_REQUEST['idCarrito'];
$sql = "UPDATE pedidos SET status = 1 WHERE id = '$idCarrito'";       
$res = $con->query($sql);
?>