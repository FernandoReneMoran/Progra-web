<?php
require "conecta.php";
$con = conecta();
$id = $_REQUEST['id'];
$idCarrito = $_REQUEST['idCarrito'];
$sql = "DELETE FROM pedidos_productos WHERE id_producto = '$id' AND id_pedido ='$idCarrito'";       
$res = $con->query($sql);
$sql = "SELECT * FROM pedidos_productos WHERE id_pedido = $idCarrito";
    $res = $con->query($sql);
$total = 0;
while($row = $res->fetch_array()){
    $costo =$row["precio"];
    $cantidad =$row["cantidad"];
    $subtotal = $costo * $cantidad;
    $total+= $subtotal;
}
echo $total;
?>