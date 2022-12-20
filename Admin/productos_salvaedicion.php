<?php
require "funciones/conecta.php";
$con = conecta();

//recibe variables
$id = $_REQUEST['id'];
$nombre = $_REQUEST['nombre'];
$codigo = $_REQUEST['codigo'];
$descripcion = $_REQUEST['descripcion'];
$costo = $_REQUEST['costo'];
$stock = $_REQUEST['stock'];

$archivo_n = $_FILES['archivo']['name']; //nombre real del archivo;
$file_tmp = $_FILES['archivo']['tmp_name']; //nombre temporal del archivo


$sql = "UPDATE productos SET nombre = '$nombre', codigo = '$codigo', descripcion = '$descripcion', costo = '$costo' , stock = '$stock' WHERE id = $id";       
$res = $con->query($sql);

if($archivo_n != ""){
        $cadena = explode(".",$archivo_n); //Separa el nombre
        $ext = $cadena[1]; //Extension
        $dir = "archivos/"; //carpeta en la que se almacena
        $archivo = md5_file($file_tmp); //nombre generado y almacenado
        $sql = "UPDATE productos SET archivo_n = '$archivo_n', archivo = '$archivo' WHERE id = '$id'";  
        $fileName1 = "$archivo.$ext";
        copy($file_tmp,$dir.$fileName1);
        $dir = "../archivos/"; //carpeta en la que se almacena
        copy($file_tmp,$dir.$fileName1);
}
$res = $con->query($sql);
header("Location: productos_lista.php");
?>