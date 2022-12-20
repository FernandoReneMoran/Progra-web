<?php
//administradores_alta.php
require "funciones/conecta.php";
$con = conecta();

echo "<div class =\"encabezado\">";
echo "<h1 class =\"titulo-listado\">Alta de Administradores</h1>";
echo "</div>";
include 'adminNavBar.php';
echo "<a class =\"link-lista\" href=\"administradores_lista.php\" >Regresar al listado de administradores</a><br><br>";
echo  "<div class =\"contenedor-form-principal\">";
echo "<form name=\"forma01\" enctype =\"multipart/form-data\">";
echo "<label>";
echo "Nombre: <input id=\"campo1\" type=\"text\" name=\"nombre\" placeholder=\"Escribe tu nombre\">";
echo "</label><br>";
echo "<label> Apellidos: <input id=\"campo2\" type=\"text\" name=\"apellidos\" placeholder=\"Escribe tus apellidos\"> </label> <br>";
echo "<div class = \"agrupacion-correo\"><label>Correo:</label><input class = \"input-correo\"type=\"email\" name=\"correo\"  onblur=\"revisarCorreo();\" value=\"@gmail.com\"> <div class = \"correo-repetido\"></div></div>";          
echo "<label for=\"pass\">Contraseña:</label> <input type=\"password\" name=\"pass\"> <br>";
echo "<label for=\"rol\">Rol:</label> <select name=\"rol\"> <option value=\"0\" selected>Selecciona</option> <option value=\"1\">Gerente</option> <option value=\"2\">Ejecutivo</option> </select> <br>";
echo "<label for=\"archivo\">Archivo</label> <input type=\"file\" id =\"archivo\" name =\"archivo\"> <br>";
echo "<input onClick=\"recibe(); return false;\" type=\"submit\" value=\"Salvar Registro\" class = \"boton-envio\"> </form> <div id =\"campos-vacios\"></div> </div>";
echo '
        <!DOCTYPE html>
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" type="text/css" href="estilos/administradores_alta.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
            <script>
            var correoRepe = true;
            var camposllenos = false;
            function revisarCorreo(){
                var corre = $(\'.input-correo\').val();
                if(corre){
                    $.ajax({
                        url : \'funciones/correoRepetido.php\',
                        type : \'post\',
                        dataType : \'text\',
                        data : \'correo=\'+corre,
                        success : function(res){
                            if(res == 1){
                                $(\'.correo-repetido\').html(\'El correo \' + corre + \' ya esta existe.\');
                                correoRepe = true;
                            }else{
                                correoRepe = false;
                            }
                            setTimeout("$(\'.correo-repetido\').html(\'\');",5000);
                        },error: function(){
                            alert(\'Error archivo no encontrado...\');
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
                if(document.forma01.rol.value == "0"){
                    camposllenos = false;    
                }
                if(document.forma01.pass.value == ""){
                    camposllenos = false;    
                }
                if(document.forma01.archivo.value == ""){
                    camposllenos = false;    
                }
                if(camposllenos == false){
                    $(\'#campos-vacios\').html(\'Faltan campos por llenar\');
                    setTimeout("$(\'#campos-vacios\').html(\'\');",5000);

                }else{
                    revisionFinal();
                }
                console.log(camposllenos);
                
            }
            function revisionFinal(){
                if(camposllenos == true && correoRepe == false){
                    document.forma01.method = "post";
                    document.forma01.action = "administradores_salva.php";
                    document.forma01.submit();
                }  
            }
            
        </script>
        </head>';
?>
