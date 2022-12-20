<!DOCTYPE html>
    <head>
      <meta charset="UTF-8">
      <link rel="stylesheet" type="text/css" href="estilos/contact.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
      <script>
        var camposllenos = false;
        function enviar(){
          camposllenos = true;      
          if(document.forma01.nombre.value == ""){
              camposllenos = false;    
          }
          if(document.forma01.correo.value == ""){
              camposllenos = false;    
          }
          if(camposllenos == false){
              $('#campos-vacios').html('Faltan campos por llenar');
          }
          if(camposllenos == true){
            var nombre = $('.contactInfo').val();
            var correo = $('.producInfo').val();
            var comentarios = $('.contactComments').val();
            if(document.forma01.mensaje.value == ""){
              comentarios = " ";
            }
            $.ajax({
                  url : 'contactoCorreo.php',
                  type : 'post',
                  dataType : 'text',
                  data : 'nombre='+nombre+'&correo='+correo+'&comentarios='+comentarios,
                  success : function(res){
                    alert('Correo enviado correctamente');
                    window.location.href = 'index.php';
                  },error: function(){
                      alert('Error a la hora de enviar correo...');
                  }
              });
          }else{
            setTimeout("$(\'#campos-vacios\').html(\'\');",5000);
          }
        }
      </script>
    <head>
<?php
include 'navBar.php';
require "funciones/conecta.php";
echo "<h2 class =\"infoTitle\">Si deseas que te avisemos de nuestras ofertas o si necesitas ayuda no dudes en contactarnos</h2>";
echo "<Form class =\"contactContainer\" method=\"post\" name =\"forma01\">";
echo "<label>Nombre:</label><input class =\"contactInfo\" type=text placeholder=\"Escribe tu nombre\" name =\"nombre\">";
echo "<label>Correo:</label><input class =\"producInfo\" type=text placeholder=\"Escribe tu correo\" name =\"correo\">";
echo "<label>Comentarios:</label><textarea class =\"contactComments\" placeholder=\"Escribe tus comentarios\"cols = 40 rows = 10 style=\"resize: none;\" name =\"mensaje\"></textarea>";
echo "<button class =\"contactButton\" onClick=\"enviar();return false;\">Enviar</button>";
echo "</Form>";
echo "<p id =\"campos-vacios\" class =\"campos\"></p>";
include 'footer.php';
?>