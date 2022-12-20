<?php
//administradores_lista.php

echo '
        <!DOCTYPE html>
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" type="text/css" href="estilos/administradores_lista.css">
            
        </head>
        <body><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
            <script>
                function eliminar(id){
                    if(confirm("Eliminar registro?")){
                        if(id){
                            $.ajax({
                                url : \'administradores_elimina.php\',
                                type : \'post\',
                                dataType : \'text\',
                                data : \'id=\'+id,
                                success : function(res){
                                    if(res){
                                        $(\'#contenedor-fila\' + res).hide();
                                    }else{
                                        alert("No se encontro el registro");
                                    }
                                },error: function(){
                                    alert(\'Error archivo no encontrado...\');
                                }
                            });
                        }else{

                        }
                    }
                }
        </script>
        </body>
            
    ';

require "funciones/conecta.php";
$con = conecta();

$sql = "SELECT * FROM administradores
        WHERE status = 1 AND eliminado = 0";

$res = $con->query($sql);
echo "<div class =\"encabezado\">";
echo "<h1 class =\"titulo-listado\">Listado de Administradores</h1>";
echo "</div>";
include 'adminNavBar.php';
echo "<a class =\"link-administradoresAlta\" href=\"administradores_alta.php\" >Insertar Nuevo registro</a><br><br>";
echo "<div class =\"tabla-completa\">";
echo "<div class =\"contenedor-fila\">";
echo "<p class =\"titulo-n\">Detalles</p>";
echo "<p class =\"titulo-n\">ID</p>";
echo "<p class =\"titulo-n\">Nombre y apellidos</p>";
echo "<p class =\"titulo-n\">Correo</p>";
echo "<p class =\"titulo-n\">Rol</p>";
echo "<p class =\"titulo-n\">Editar Administrador</p>";
echo "<p class =\"titulo-final\">Eliminar admin</p>";
echo "</div>";


while($row = $res->fetch_array()){
    
    $id     =$row["id"];
    $nombre     =$row["nombre"];
    $apellidos     =$row["apellidos"];
    $correo = $row["correo"];
    $rol =$row["rol"];
    if($rol == 1){
        $rol = "Gerente";
    }elseif($rol == 2){
        $rol = "Ejecutivo";
    }
    echo "<div id = \"contenedor-fila{$id}\" class =\"contenedor-fila\">";
    echo "<a href=\"administradores_detalle.php?id=$id\" class =\"detalle-n\">Informacion</a>";
    echo "<p id=\"{$id}\" class =\"dato-n\">$id</p>";
    echo "<p class =\"dato-n\">$nombre $apellidos</p>";
    echo "<p class =\"dato-n\">$correo</p>";
    echo "<p class =\"dato-n\">$rol</p>";
    echo "<a href=\"administradores_editar.php?id=$id\" class =\"detalle-n\">Editar</a>";
    echo  "<button class =\"boton\">";
    echo  "<a class =\"dato-final\" href=\"javascript:void(0);\" onClick=\"eliminar($id);\">Eliminar</a>";
    echo "</button>";
    echo "</div>";
}
echo "</div>";
?>