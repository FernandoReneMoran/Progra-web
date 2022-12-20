<!DOCTYPE html>
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" type="text/css" href="estilos/banners_lista.css">
            
        </head>
        <body><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
            <script>
                function eliminar(id){
                    if(confirm("Eliminar registro?")){
                        if(id){
                            $.ajax({
                                url : 'banners_elimina.php',
                                type : 'post',
                                dataType : 'text',
                                data : 'id='+id,
                                success : function(res){
                                    if(res){
                                        $('#contenedor-fila' + res).hide();
                                    }else{
                                        alert("No se encontro el registro");
                                    }
                                },error: function(){
                                    alert('Error archivo no encontrado...');
                                }
                            });
                        }else{

                        }
                    }
                }
        </script>
        </body>
       
<?php
//banners_lista.php
require "funciones/conecta.php";
$con = conecta();

$sql = "SELECT * FROM banners
        WHERE status = 1 AND eliminado = 0";

$res = $con->query($sql);
echo "<div class =\"encabezado\">";
echo "<h1 class =\"titulo-listado\">Listado de Banners</h1>";
echo "</div>";
include 'adminNavBar.php';
echo "<a class =\"link-administradoresAlta\" href=\"banners_alta.php\" >Insertar Nuevo registro</a><br><br>";
echo "<div class =\"tabla-completa\">";
echo "<div class =\"contenedor-fila\">";
echo "<p class =\"titulo-n\">Detalles</p>";
echo "<p class =\"titulo-n\">ID</p>";
echo "<p class =\"titulo-n\">Nombre del banner</p>";
echo "<p class =\"titulo-n\">Editar Banner</p>";
echo "<p class =\"titulo-final\">Eliminar Banner</p>";
echo "</div>";


while($row = $res->fetch_array()){
    
    $id     =$row["id"];
    $nombre     =$row["nombre"];

    echo "<div id = \"contenedor-fila{$id}\" class =\"contenedor-fila\">";
    echo "<a href=\"banners_detalle.php?id=$id\" class =\"detalle-n\">Informacion</a>";
    echo "<p id=\"{$id}\" class =\"dato-n\">$id</p>";
    echo "<p class =\"dato-n\">$nombre</p>";
    echo "<a href=\"banners_editar.php?id=$id\" class =\"detalle-n\">Editar</a>";
    echo  "<button class =\"boton\">";
    echo  "<a class =\"dato-final\" href=\"javascript:void(0);\" onClick=\"eliminar($id);\">Eliminar</a>";
    echo "</button>";
    echo "</div>";
}
echo "</div>";
?>