<!DOCTYPE html>
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" type="text/css" href="estilos/productos_alta.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
            <script>
            var codigoRepe = true;
            var camposllenos = false;

            function recibe(){  
                camposllenos = true;      
                if(document.forma01.nombre.value == ""){
                    camposllenos = false;    
                }
                if(document.forma01.archivo.value == ""){
                    camposllenos = false;    
                }
                if(camposllenos == false){
                    $('#campos-vacios').html('Faltan campos por llenar');
                    setTimeout("$('#campos-vacios').html('');",5000);

                }else{
                    revisionFinal();
                }
                
            }
            function revisionFinal(){
                    document.forma01.method = "post";
                    document.forma01.action = "banners_salva.php";
                    document.forma01.submit();
            }
            
        </script>
        </head>
<?php
//banners_alta.php
require "funciones/conecta.php";
$con = conecta();

echo "<div class =\"encabezado\">";
echo "<h1 class =\"titulo-listado\">Alta de Banners</h1>";
echo "</div>";
include 'adminNavBar.php';
echo "<a class =\"link-lista\" href=\"banners_lista.php\" >Regresar al listado de banners</a><br><br>";
echo  "<div class =\"contenedor-form-principal\">";
echo "<form name=\"forma01\" enctype =\"multipart/form-data\">";
echo "<label>";
echo "Nombre: <input id=\"campo1\" type=\"text\" name=\"nombre\" placeholder=\"Nombre del banner\">";
echo "</label><br>";
echo "<label for=\"archivo\">Archivo</label> <input type=\"file\" id =\"archivo\" name =\"archivo\"> <br>";
echo "<input onClick=\"recibe(); return false;\" type=\"submit\" value=\"Salvar Registro\" class = \"boton-envio\"> </form> <div id =\"campos-vacios\"></div> </div>";
?>
