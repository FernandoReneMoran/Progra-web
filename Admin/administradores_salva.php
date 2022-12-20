<?php
require "funciones/conecta.php";
$con = conecta();

//recibe variables
$nombre = $_REQUEST['nombre'];
$apellidos = $_REQUEST['apellidos'];
$correo = $_REQUEST['correo'];
$pass = $_REQUEST['pass'];
$rol = $_REQUEST['rol'];
$passEnc = md5($pass);

$archivo_n = $_FILES['archivo']['name']; //nombre real del archivo;
$file_tmp = $_FILES['archivo']['tmp_name']; //nombre temporal del archivo
$cadena = explode(".",$archivo_n); //Separa el nombre
$ext = $cadena[1]; //Extension
$dir = "archivos/"; //carpeta en la que se almacena
$archivo = md5_file($file_tmp); //nombre generado y almacenado
$fileName1 = "$archivo.$ext";
copy($file_tmp,$dir.$fileName1);

$sql = "INSERT INTO administradores
        (nombre,apellidos,correo,pass,rol,archivo_n,archivo)
        VALUES ('$nombre','$apellidos','$correo','$passEnc',$rol,
        '$archivo_n','$archivo')";

$res = $con->query($sql);
header("Location: administradores_lista.php");
?>