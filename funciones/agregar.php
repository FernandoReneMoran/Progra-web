<?php
session_start();
require "conecta.php";
$con = conecta();
$quan = $_REQUEST['quan'];
$id = $_REQUEST['id'];
$correo = $_SESSION['correoC'];

$sql = "SELECT COUNT(*) as count FROM pedidos WHERE usuario = '$correo' and status = 0";
$stmt = mysqli_stmt_init($con);
mysqli_stmt_prepare($stmt, $sql);

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$count = mysqli_fetch_assoc($result)['count'];

if($count == 0){
    $sql = "INSERT INTO pedidos
        (fecha,usuario)
        VALUES (NOW(),'$correo')";
    $res = $con->query($sql);


    $sql = "SELECT * FROM pedidos ORDER BY id DESC LIMIT 1";
    $res = $con->query($sql);
    while($row = $res->fetch_array()){
        $idL =$row["id"];
    }
    $sql = "SELECT costo FROM productos
            WHERE id = $id";
    $res = $con->query($sql);
    while($row = $res->fetch_array()){
        $costo =$row["costo"];
    }
    $sql = "INSERT INTO pedidos_productos
            (id_pedido,id_producto,cantidad,precio)
            VALUES ('$idL','$id','$quan','$costo')";
    $res = $con->query($sql);
}else{
    $sql = "SELECT * FROM pedidos
    WHERE usuario = '$correo' AND status = 0";
    $res = $con->query($sql);
    while($row = $res->fetch_array()){
    $idCarrito =$row["id"];
    }
    if($count == 1){
        $sql = "SELECT COUNT(*) as count FROM pedidos_productos WHERE id_producto = '$id' AND id_pedido = '$idCarrito'";
        $stmt = mysqli_stmt_init($con);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $count2 = mysqli_fetch_assoc($result)['count'];
        echo $count2;
        if($count2 == 0){
            $sql = "SELECT costo FROM productos
            WHERE id = $id";
            $res = $con->query($sql);
            while($row = $res->fetch_array()){
                $costo =$row["costo"];
            }
            $sql = "INSERT INTO pedidos_productos
            (id_pedido,id_producto,cantidad,precio)
            VALUES ('$idCarrito','$id','$quan','$costo')";
            $res = $con->query($sql);
        }else {
            if($count2 >= 1){
                $sql = "UPDATE pedidos_productos SET cantidad = cantidad + '$quan' WHERE id_producto = '$id' AND id_pedido = '$idCarrito'";       
                $res = $con->query($sql);
            }
        }
    }
}
?>