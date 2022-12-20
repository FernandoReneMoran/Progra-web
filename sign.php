<!DOCTYPE html>
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" type="text/css" href="estilos/sign.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
            <script>
                var correoRepe = true;
                var camposllenos = false;
                function revisarCorreo(){
                    var corre = $('.input-correo').val();
                    if(corre){
                        $.ajax({
                            url : 'funciones/correoRepetido.php',
                            type : 'post',
                            dataType : 'text',
                            data : 'correo='+corre,
                            success : function(res){
                                if(res == 1){
                                    $('.correo-repetido').html('El correo ' + corre + ' ya esta existe.');
                                    correoRepe = true;
                                }else{
                                    correoRepe = false;
                                }
                                setTimeout("$('.correo-repetido').html('');",5000);
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
                    if(document.forma01.apellidos.value == ""){
                        camposllenos = false;    
                    }
                    if(document.forma01.correo.value == ""){
                        camposllenos = false;    
                    }
                    if(document.forma01.pass.value == ""){
                        camposllenos = false;    
                    }
                    if(camposllenos == false){
                        $('#campos-vacios').html('Faltan campos por llenar');
                        setTimeout("$('#campos-vacios').html('');",5000);

                    }else{
                        revisionFinal();
                    }
                    console.log(camposllenos);
                    
                }
                function revisionFinal(){
                    if(camposllenos == true && correoRepe == false){
                        document.forma01.method = "post";
                        document.forma01.action = "funciones/clientes_salva.php";
                        document.forma01.submit();
                    }  
                }
                
        </script>
        <head>
<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
$idC =$_SESSION['idC'];
if($idC != ''){
    header("Location: index.php");
}
include 'navBar.php';
echo "<div class =\"encabezado\">";
echo "<h1 class =\"titulo-listado\">Creacion de Usuarios</h1>";
echo "</div>";
echo "<div class =\"contenedor-form-principal\">";
echo "<form name=\"forma01\" enctype =\"multipart/form-data\">";
echo "<label class=\"texto-input\">";
echo "Ingresa tu nombre: </label><br><input id=\"campo1\" type=\"text\" name=\"nombre\" class=\"inputs\" placeholder=\"Escribe tu nombre\">";
echo "<br>";
echo "<label class=\"texto-input\">";
echo "Ingresa tus apellidos: </label><br><input type=\"text\" name=\"apellidos\" class=\"inputs\" placeholder=\"Escribe tus apellidos\">";
echo "<label class=\"texto-input\">";
echo "<div class = \"agrupacion-correo\"><label class=\"texto-input\">Correo:</label><input class = \"input-correo\"type=\"email\" name=\"correo\"  onblur=\"revisarCorreo();\" value=\"@gmail.com\"> <div class = \"correo-repetido\"></div></div>";          
echo "<br>";
echo "<label class=\"texto-input\"> Ingrese su contraseña:</label><br> <input id=\"campo2\" type=\"password\" class=\"inputs\" name=\"pass\" placeholder=\"Escribe tu contraseña\"><br>";
echo "<input onClick=\"recibe(); return false;\" type=\"submit\" value=\"Enviar\" class = \"boton-envio\"> </form> <div id =\"campos-vacios\"></div>";
echo "</div>";
include 'footer.php';
?>