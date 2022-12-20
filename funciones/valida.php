<?php
session_start();
require "conecta.php";
$con = conecta();
$user = $_REQUEST['usuario'];
$contrasenia = $_REQUEST['contrasenia'];
$passenc = md5($contrasenia);

$sql = "SELECT * FROM clientes WHERE correo = '$user' and eliminado = 0 and pass ='$passenc' and status = 1";

$res = $con->query($sql);
$count = mysqli_num_rows($res);

if($count == 1){
    while($row = $res->fetch_array()){
        $idC = $row["id"];
        $nombre = $row["nombre"].' '.$row["apellidos"];
        $correo = $row["correo"];
        $_SESSION['idC'] = $idC;
        $_SESSION['nombreC'] = $nombre;
        $_SESSION['correoC'] = $correo;
    }
}
echo $count;
?>