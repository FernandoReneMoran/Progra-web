<!DOCTYPE html>
    <head>
      <meta charset="UTF-8">
      <link rel="stylesheet" type="text/css" href="estilos/detalle.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
      <script>
        function agregarProducto(id){
          if(id){
            quan = $('#quantity' + id).val();
            $.ajax({
                url : 'funciones/agregar.php',
                type : 'post',
                dataType : 'text',
                data : 'id='+id+'&quan='+quan,
                success : function(res){
                    $('#purchased' + id).html('Producto agregado');
                    setTimeout("$('#purchased"+id+"').html('')",5000);
                },error: function(){
                    alert('Error datos no encontrados...');
                }
            });
          }else{
          }
        }        
      </script>
    <head>
<?php
include 'navBar.php';
require "funciones/conecta.php";
$idP = $_REQUEST['id'];
$con = conecta();
  $sql = "SELECT * FROM productos
  WHERE id = $idP";

  $res = $con->query($sql);
  while($row = $res->fetch_array()){
    $nombre     =$row["nombre"];
    $archivo = $row["archivo"];
    $costo =$row["costo"];
    $codigo     =$row["codigo"];
    $id     =$row["id"];
    $descripcion =$row["descripcion"];
    echo "<div class =\"productContainer\">";
    echo "<p id = \"purchased$id\" class =\"producInfo\"></p>";
    echo "<img class =\"productImgSample\" src=\"archivos/$archivo.jpg\" alt=\"$nombre\">";
    echo "<a class =\"producInfo\" href=\"detalle.php?id=$id\">$nombre</a>";
    echo "<p class =\"producInfo\">Codigo: $codigo</p>";
    echo "<p class =\"producInfo\">$$costo</p>";
    echo "<p class =\"producInfo\">Descripcion: $descripcion</p>";
    if ($idC == '') {
      echo "<a class =\"producInfo\" href=\"login.php\">Comprar</a>";
    } else {
      echo "<input id = \"quantity$id\" class =\"producInfo\" type=number min = \"1\" value = \"1\";>";
      echo "<button href=\"javascript:void(0);\" onClick=\"agregarProducto($id);\" class =\"producButton\">Agregar</button>";
    }
    echo "</div>";
  }
  include 'footer.php';
  ?>