<!DOCTYPE html>
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" type="text/css" href="estilos/productos_editar.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
            <script>
            var codigoRepe = true;
            var camposllenos = false;
            function revisarCodigo(){
                var codi = $('.input-codigo').val();
                var ide = $('.input-id').val();
                if(codi){
                    $.ajax({
                        url : 'funciones/codigoRepetidoEdicion.php?codigo='+codi+'&id='+ide,
                        type : 'post',
                        dataType : 'text',
                        data : '',
                        success : function(res){
                            console.log(res);
                            if(res == 1){
                                $('.codigo-repetido').html('El codigo ' + codi + ' ya existe.');
                                codigoRepe = true;
                            }else{
                                codigoRepe = false;
                            }
                            setTimeout("$('.codigo-repetido').html('');",5000);
                        },error: function(){
                            alert('Error archivo no encontrado...');
                        }
                    });
                }
            }

            function recibe(){  
                camposllenos = true;      
                if(document.forma01.nombre.value == ""){
                    camposllenos = false;    
                }
                if(document.forma01.stock.value == ""){
                    camposllenos = false;    
                }
                if(document.forma01.codigo.value == ""){
                    camposllenos = false;    
                }
                if(document.forma01.descripcion.value == ""){
                    camposllenos = false;    
                }
                if(document.forma01.costo.value == ""){
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
                if(camposllenos == true && codigoRepe == false){
                    document.forma01.method = "post";
                    document.forma01.action = "productos_salvaedicion.php";
                    document.forma01.submit();
                }  
            }
            
        </script>
        </head>
<?php
//productos_editar.php
require "funciones/conecta.php";
$con = conecta();
$id = $_REQUEST['id'];

$sql = "SELECT * FROM productos
        WHERE id = $id";

$res = $con->query($sql);
while($row = $res->fetch_array()){
    $nombre     =$row["nombre"];
    $codigo     =$row["codigo"];
    $descripcion = $row["descripcion"];
    $costo =$row["costo"];
    $stock =$row["stock"];
}

echo "<div class =\"encabezado\">";
echo "<h1 class =\"titulo-listado\">Edicion de productos</h1>";
echo "</div>";
include 'adminNavBar.php';
echo "<a class =\"link-lista\" href=\"productos_lista.php\" >Regresar al listado de productos</a><br><br>";
echo  "<div class =\"contenedor-form-principal\">";
echo "<form name=\"forma01\" enctype =\"multipart/form-data\">";
echo "<label>";
echo "Nombre: <input id=\"campo1\" type=\"text\" name=\"nombre\" placeholder=\"Nombre del producto\" value ='$nombre'>";
echo "</label><br>";
echo "<div class = \"agrupacion-codigo\"><label>Codigo:</label><input class = \"input-codigo\"type=\"text\" name=\"codigo\"  onblur=\"revisarCodigo();\" value ='$codigo' placeholder=\"Codigo del producto\"> <div class = \"codigo-repetido\"></div></div>";          
echo "<label> Descripcion: <br> <textarea id=\"campo2\" name=\"descripcion\" placeholder=\"Escribe la descripcion del producto\"cols = 40 rows = 10 style=\"resize: none;\">$descripcion</textarea> </label> <br>";
echo "<label for=\"costo\">Costo:</label> <input type=\"number\" name=\"costo\" value ='$costo'> <br>";
echo "<input type=\"hidden\" class = \"input-id\" name=\"id\" value ='$id'>";
echo "<label for=\"stock\">Stock:</label> <input type=\"number\" name=\"stock\" value ='$stock'> <br>";
echo "<label for=\"archivo\">Archivo</label> <input type=\"file\" id =\"archivo\" name =\"archivo\"> <br>";
echo "<input onClick=\"recibe(); return false;\" type=\"submit\" value=\"Salvar Registro\" class = \"boton-envio\"> </form> <div id =\"campos-vacios\"></div> </div>";
?>
