<!DOCTYPE html>
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" type="text/css" href="estilos/index.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
            <script>
                var camposllenos = false;
                function revisarUsuario() {
                    var user = $('#campo1').val();
                    var pass = $('#campo2').val();
                    if (user){
                        $.ajax({
                            url: 'funciones/valida.php?usuario='+user+'&contrasenia='+pass,
                            type : 'post',
                        dataType : 'text',
                        data : '',
                        success : function(res) {
                                if(res == 1) {
                                    window.location.href = 'bienvenido.php';
                                } else {
                                    $('#campos-vacios').html('El usuario no existe');
                                }
                                setTimeout("$('#campos-vacios').html('');", 5000);
                            }, error: function () {
                                alert('Error archivo no encontrado...');
                        }
                        });
                    }
                }

                function recibe() {
                    camposllenos = true;
                    if (document.forma01.usuario.value == "") {
                        camposllenos = false;
                    }
                    if (document.forma01.contrasenia.value == "") {
                        camposllenos = false;
                    }
                    if (camposllenos == false) {
                        $('#campos-vacios').html('Faltan campos por llenar');
                    setTimeout("$('#campos-vacios').html('');", 5000);
                    } else {
                        revisarUsuario();
                    }
                }
            </script>
        </head>
<?php
//index.php
session_start();
error_reporting(E_ERROR | E_PARSE);
$idU =$_SESSION['idU'];
if($idU != ''){
    header("Location: bienvenido.php");
}

echo "<div class =\"encabezado\">";
echo "<h1 class =\"titulo-listado\">Login de Administradores</h1>";
echo "</div>";
echo "<div class =\"contenedor-form-principal\">";
echo "<form name=\"forma01\" enctype =\"multipart/form-data\">";
echo "<label class=\"texto-input\">";
echo "Ingrese su usuario: </label><br><input id=\"campo1\" type=\"text\" name=\"usuario\" class=\"inputs\" placeholder=\"Escribe tu usuario\">";
echo "<br> <br>";
echo "<label class=\"texto-input\"> Ingrese su contraseña:</label><br> <input id=\"campo2\" type=\"password\" class=\"inputs\" name=\"contrasenia\" placeholder=\"Escribe tu contraseña\"><br>";
echo "<input onClick=\"recibe(); return false;\" type=\"submit\" value=\"Enviar\" class = \"boton-envio\"> </form> <div id =\"campos-vacios\"></div> </div>";
?>