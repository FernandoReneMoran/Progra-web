<!DOCTYPE html>
    <head>
      <meta charset="UTF-8">
      <link rel="stylesheet" type="text/css" href="estilos/index.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
      <script>
        function agregarProducto(id){
          if(id){
            quan = $('#quantity' + id).val();
            if(quan >0){
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
            }
          }else{
          }
        }        
      </script>
    <head>
<?php
  include 'navBar.php';
  require "funciones/conecta.php";
  $con = conecta();
  $sql = "SELECT * FROM banners
        ORDER BY RAND()
        LIMIT 1";
  $res = $con->query($sql);
  echo "<div class =\"homeContainer\">";
  while($row = $res->fetch_array()){
    $nombre     =$row["nombre"];
    $archivo = $row["archivo"];
    echo "<img class =\"bannerImg\" src=\"archivos/$archivo.jpg\" alt=\"$nombre\">";
  }
  echo "<div class =\"sampleProducts\">";
  $sql = "SELECT * FROM productos
  ORDER BY RAND()
  LIMIT 6";
  $res = $con->query($sql);
  while($row = $res->fetch_array()){
    $nombre     =$row["nombre"];
    $archivo = $row["archivo"];
    $costo =$row["costo"];
    $codigo     =$row["codigo"];
    $id     =$row["id"];
    echo "<div class =\"productContainer\">";
    echo "<p id = \"purchased$id\" class =\"producInfo\"></p>";
    echo "<img class =\"productImgSample\" src=\"archivos/$archivo.jpg\" alt=\"$nombre\">";
    echo "<a class =\"producInfo\" href=\"detalle.php?id=$id\">$nombre</a>";
    echo "<p class =\"producInfo\">Codigo: $codigo</p>";
    echo "<p class =\"producInfo\">$$costo</p>";
    if ($idC == '') {
      echo "<a class =\"producInfo\" href=\"login.php\">Comprar</a>";
    } else {
      echo "<input id = \"quantity$id\" class =\"producInfo\" type=number min = \"1\" value = \"1\";>";
      echo "<button href=\"javascript:void(0);\" onClick=\"agregarProducto($id);\" class =\"producButton\">Agregar</button>";
    }
    echo "</div>";
  }
  echo "</div>";
  echo "</div>";
  include 'footer.php';
?>