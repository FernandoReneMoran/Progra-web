<?php
require "funciones/conecta.php";
$con = conecta();

//recibe variables
$nombre = $_REQUEST['nombre'];
$codigo = $_REQUEST['codigo'];
$descripcion = $_REQUEST['descripcion'];
$costo = $_REQUEST['costo'];
$stock = $_REQUEST['stock'];

$archivo_n = $_FILES['archivo']['name']; //nombre real del archivo;
$file_tmp = $_FILES['archivo']['tmp_name']; //nombre temporal del archivo
$cadena = explode(".",$archivo_n); //Separa el nombre
$ext = $cadena[1]; //Extension
$dir = "archivos/"; //carpeta en la que se almacena
$archivo = md5_file($file_tmp); //nombre generado y almacenado
$fileName1 = "$archivo.$ext";
copy($file_tmp,$dir.$fileName1);
$dir = "../archivos/"; //carpeta en la que se almacena
copy($file_tmp,$dir.$fileName1);

$sql = "INSERT INTO productos
        (nombre,codigo,descripcion,costo,stock,archivo_n,archivo)
        VALUES ('$nombre','$codigo','$descripcion','$costo',$stock,
        '$archivo_n','$archivo')";

$res = $con->query($sql);
header("Location: productos_lista.php");
?>