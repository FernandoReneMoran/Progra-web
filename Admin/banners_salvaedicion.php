<?php
require "funciones/conecta.php";
$con = conecta();

//recibe variables
$id = $_REQUEST['id'];
$nombre = $_REQUEST['nombre'];

$archivo_n = $_FILES['archivo']['name']; //nombre real del archivo;
$file_tmp = $_FILES['archivo']['tmp_name']; //nombre temporal del archivo


$sql = "UPDATE banners SET nombre = '$nombre' WHERE id = $id";       
$res = $con->query($sql);

if($archivo_n != ""){
        $cadena = explode(".",$archivo_n); //Separa el nombre
        $ext = $cadena[1]; //Extension
        $dir = "archivos/"; //carpeta en la que se almacena
        $archivo = md5_file($file_tmp); //nombre generado y almacenado
        $sql = "UPDATE banners SET archivo = '$archivo' WHERE id = '$id'";  
        $fileName1 = "$archivo.$ext";
        copy($file_tmp,$dir.$fileName1);
        $dir = "../archivos/"; //carpeta en la que se almacena
        copy($file_tmp,$dir.$fileName1);
}
$res = $con->query($sql);
header("Location: banners_lista.php");
?>