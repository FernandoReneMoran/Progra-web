<?php
require "funciones/conecta.php";
$con = conecta();
session_start();
//recibe variables
$id = $_REQUEST['id'];
$nombre = $_REQUEST['nombre'];
$apellidos = $_REQUEST['apellidos'];
$correo = $_REQUEST['correo'];
$pass = $_REQUEST['pass'];
$rol = $_REQUEST['rol'];
$passEnc = md5($pass);

$archivo_n = $_FILES['archivo']['name']; //nombre real del archivo;
$file_tmp = $_FILES['archivo']['tmp_name']; //nombre temporal del archivo


$sql = "UPDATE administradores SET nombre = '$nombre', apellidos = '$apellidos', correo = '$correo', rol = '$rol' WHERE id = $id";       
$res = $con->query($sql);

if ($pass != ""){
        $sql = "UPDATE administradores SET pass = '$passEnc' WHERE id = '$id'";             
}

if($archivo_n != ""){
        $cadena = explode(".",$archivo_n); //Separa el nombre
        $ext = $cadena[1]; //Extension
        $dir = "archivos/"; //carpeta en la que se almacena
        $archivo = md5_file($file_tmp); //nombre generado y almacenado
        $sql = "UPDATE administradores SET archivo_n = '$archivo_n', archivo = '$archivo' WHERE id = '$id'";  
        $fileName1 = "$archivo.$ext";
        copy($file_tmp,$dir.$fileName1);
}
$res = $con->query($sql);
header("Location: administradores_lista.php");
?>