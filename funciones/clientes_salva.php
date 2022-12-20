<?php
require "conecta.php";
$con = conecta();

//recibe variables
$nombre = $_REQUEST['nombre'];
$apellidos = $_REQUEST['apellidos'];
$correo = $_REQUEST['correo'];
$pass = $_REQUEST['pass'];
$passEnc = md5($pass);

$sql = "INSERT INTO clientes
        (nombre,apellidos,correo,pass)
        VALUES ('$nombre','$apellidos','$correo','$passEnc')";

$res = $con->query($sql);
header("Location: ../login.php");
?>